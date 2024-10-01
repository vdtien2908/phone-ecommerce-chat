<?php

class AuthController extends BaseController
{

    private $userModel;
    private $customerModel;
    private $cartModel;
    private $permissionModel;
    /**
     * Lớp AuthController này xử lý các thao tác cơ bản về xác thực người dùng như đăng nhập,
     *  đăng ký, quên mật khẩu, thay đổi mật khẩu và đăng xuất.
     */

    /**
     * Khởi tạo các model cần thiết cho controller.
     */
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->customerModel = $this->model('CustomerModel');
        $this->cartModel = $this->model('CartModel');
        $this->permissionModel = $this->model('PermissionModel');
    }

    /**
     * Phương thức mặc định.
     */
    public function index()
    {
    }

    /**
     * Hiển thị trang đăng nhập.
     */
    public function login()
    {
        $this->view('app', [
            'page' => 'auth/login',
            'title' => 'Đăng nhập',
        ]);
    }

    /**
     * Hiển thị trang đăng ký.
     */
    public function register()
    {
        $this->view('app', [
            'page' => 'auth/register',
            'title' => 'Đăng ký',
        ]);
    }

    /**
     * Xử lý quên mật khẩu, chuyển hướng nếu người dùng chưa đăng nhập.
     */
    public function forgotpassword()
    {
        if (!isset($_SESSION['auth_admin'])) {
            header('Location: /phone-ecommerce-chat/admin/auth/login');
            return;
        }

        $this->view('app', [
            'page' => 'auth/forgot-password',
            'title' => 'Lấy lại mật khẩu',
        ]);
    }

    /**
     * Xử lý đăng nhập, kiểm tra thông tin người dùng và trả về kết quả qua JSON.
     */
    public function signIn()
    {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $result = $this->userModel->findEmail($email);

        if ($result) {
            if (password_verify($pass, $result['password'])) {
                $_SESSION['auth_admin'] = $result;
                $_SESSION['authenticated_admin'] = true;

                $permissions = $this->permissionModel->getPermissionByUser($result['user_id']);
                $permission_codes = array_column($permissions, 'permission_code');
                $_SESSION['permissions'] = $permission_codes;

                $result = [
                    'status' => 200,
                    'message' => "Đăng nhập thành công!"
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
            } else {
                $result = [
                    'status' => 404,
                    'message' => "Mật khẩu không chính xác!",
                    'data' => $result,
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
            }
        } else {
            $result = [
                'status' => 204,
                'message' => "Email không tồn tại!"
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    /**
     * Xử lý đăng ký, tạo mới khách hàng và giỏ hàng, trả về kết quả qua JSON.
     */
    public function signUp()
    {
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fullname = $_POST['customer_name'];

            $customer = $this->customerModel->findEmail($email);

            if ($customer) {
                $result = [
                    'status' => 204,
                    'message' => "Email đã tồn tại!"
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            }

            var_dump($password);

            if (!isset($password)) {
                $result = [
                    'status' => 404,
                    'message' => "Mật khẩu hoặc email không hợp lệ."
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
            }

            $data = [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'customer_name' => $fullname
            ];

            $this->customerModel->createCustomer($data);

            $createdCustomer = $this->customerModel->getLastCustomer();

            // Tạo khóa ngoại
            $data = [
                'customer_id' => $createdCustomer['customer_id']
            ];

            $this->cartModel->createCart($data);

            $result = [
                'status' => 200,
                'message' => "Tạo tài khoản thành công!"
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (Exception $e) {
            $_SESSION['success'] = $e->getMessage();
            header('Location: /phone-ecommerce-chat/admin/auth/register');
        }
    }

    /**
     * Xử lý thay đổi mật khẩu cho khách hàng, cập nhật mật khẩu và đăng xuất.
     */
    public function changePassword()
    {
        try {
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $id = $_SESSION['auth_admin']['customer_id'];

            $result = $this->customerModel->findEmail($email);

            if ($result) {
                $data = [
                    'password' => password_hash($pass, PASSWORD_DEFAULT),
                ];


                $this->customerModel->updateCustomer($id, $data);

                $_SESSION['auth_admin'] = null;
                $_SESSION['authenticated_admin'] = false;


                $result = [
                    'status' => 200,
                    'message' => "Đổi mật khẩu thành công vui lòng đăng nhập lại!"
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
            } else {
                $result = [
                    'status' => 204,
                    'message' => "Email không tồn tại!"
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
            }
        } catch (\Throwable $th) {
            $result = [
                'status' => 204,
                'message' => $th->getMessage()
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    /**
     * Xử lý đăng xuất, xóa thông tin người dùng khỏi session và chuyển hướng.
     */
    public function logout()
    {
        if ($_SESSION['auth_admin']) {
            unset($_SESSION['auth_admin']);
            unset($_SESSION['authenticated_admin']);
            header('Location: /phone-ecommerce-chat/admin/auth/login');
        }
    }
}
