<?php
class UsersController extends BaseController
{

    private $userModel;
    private $roleModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->roleModel = $this->model('RoleModel');
    }

    public function index()
    {
        $this->view(
            'app',
            [
                'page' => 'users/index',
                'title' => 'Khách hàng',
            ]
        );
    }

    public function all()
    {
        $users = $this->userModel->getUsers();

        $result = [
            'status' => 200,
            'data' => $users
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function create()
    {
        $roles = $this->roleModel->getRolesNoAdmin();
        $this->view(
            'app',
            [
                'page' => 'users/create',
                'title' => 'Khach hang',
                'roles' => $roles
            ]
        );
    }

    public function store()
    {
        try {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
            $address = isset($_POST['address']) ? $_POST['address'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $role = isset($_POST['role']) ? $_POST['role'] : '';

            if (!$fullname || !$email || !$password || !isset($gender)) {
                $result = [
                    'status' => 500,
                    'message' => 'Thiếu thông tin bắt buộc',
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            }

            $user = $this->userModel->findEmail($email);
            if($user){
                $result = [
                    'status' => 500,
                    'message' => 'Email đã tồn tại',
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            } 

           
            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'gender' => $gender,
                'address' => $address,
                'phone' => $phone,
                'role_id' => $role,
            ];

            $this->userModel->createUser($data);

            $result = [
                'status' => 200,
                'message' => 'Nhân viên đã được tạo thành công'
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function edit($id)
    {
        $roles = $this->roleModel->getRolesNoAdmin();
        $user = $this->userModel->getUser($id);

        if (!$user) {
            $_SESSION['success'] = 'Không tìm thấy nhân viên';
            header('Location: /phone-ecommerce-chat/admin/users');
        }

        $this->view(
            'app',
            [
                'page' => 'users/edit',
                'user' => $user,
                'roles' => $roles
            ]
        );
    }

    public function update($id)
    {
        try {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
            $address = isset($_POST['address']) ? $_POST['address'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $role = $_POST['role'];

            if (!$fullname || !$email) {
                $_SESSION['errors']['fullname'] = 'Thiếu thông tin bắt buộc';
                header('Location: /phone-ecommerce-chat/admin/users/edit/' . $id);
                exit();
            }

           

            $oldFileName = null;
            $user = $this->userModel->getUser($id);
         

            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'password' => $password == "" ? $user['password'] : password_hash($password, PASSWORD_DEFAULT),
                'gender' => $gender,
                'address' => $address,
                'phone' => $phone,
                'role_id' => $role,
            ];

            $this->userModel->updateUser($id, $data);

            $result = [
                'status' => 200,
                'message' => 'Cập nhật tài khoản thành công'
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 200,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function updateProfile($id)
    {
        try {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
            $address = isset($_POST['address']) ? $_POST['address'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

            if (!$fullname || !$email) {
                $result = [
                    'status' => 200,
                    'message' => 'Thiếu thông tin bắt buộc',
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;;
            }

            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'password' => $password == "" ? $user['password'] : password_hash($password, PASSWORD_DEFAULT),
                'gender' => $gender,
                'address' => $address,
                'phone' => $phone,
            ];

            $this->userModel->updateUser($id, $data);

            $result = [
                'status' => 200,
                'message' => 'Cập nhật tài khoản thành công'
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 200,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->userModel->getUser($id);

            if (!$user) {
                $result = [
                    'status' => 404,
                    'message' => 'Không tìm thấy nhân viên'
                ];
                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            }

            $this->userModel->deleteUser($id);

            $result = [
                'status' => 204,
                'message' => "Xóa nhân viên thành công"
            ];

            header('Location: /phone-ecommerce-chat/admin/users');

            // header('Content-Type: application/json');
            // echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }
}
