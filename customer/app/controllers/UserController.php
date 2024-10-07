<?php
class UserController extends BaseController
{

    private $orderModel;
    private $customerModel;

    public function __construct()
    {
        $this->orderModel = $this->model('OrderModel');
        $this->customerModel = $this->model('CustomerModel');
    }

    public function profile()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /phone-ecommerce-chat/customer/auth/login');
            return;
        }

        $customer = $this->customerModel->getCustomer($_SESSION['auth']['customer_id']);





        $this->view('app', [
            'page' => 'profile/index',
            'title' => 'Thông tin cá nhân',
            'customer' => $customer,
        ]);
    }

    public function orderHistory()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /phone-ecommerce-chat/customer/auth/login');
            return;
        }
        $this->view(
            'app',
            [
                'page' => 'checkout/history',
                'title' => 'Profile',
            ]
        );
    }

    public function getOrderHistory()
    {
        $orderDetail = $this->orderModel->getOrderHistory($_SESSION['auth']['customer_id']);

        if ($orderDetail) {
            $result = [
                'status' => 200,
                'message' => "success",
                'data' => $orderDetail,
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            $result = [
                'status' => 200,
                'message' => "Fail to fetch orderDetail"
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function updateProfile()
    {
        try {
            $id = $_SESSION['auth']['customer_id'];
            $existCustomer = $this->customerModel->getCustomer($id);

            if ($existCustomer) {

                $data = [
                    'address' => $_POST['address'],
                    'birthday' => $_POST['birthday'],
                    'customer_name' => $_POST['customer_name'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                ];

                $this->customerModel->updateCustomer($id, $data);

                $_SESSION['auth'] = $this->customerModel->getCustomer($id);

                $result = [
                    'status' => 200,
                    'message' => 'Cập nhật người dùng thành công'
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            }
        } catch (\Throwable $th) {
            $result = [
                'status' => 404,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function receiveOrder($id)
    {
        try {
            $existOrder = $this->orderModel->getOrder($id);

            if ($existOrder) {
                $this->orderModel->updateStatusCompleted($id);

                $result = [
                    'status' => 200,
                    'message' => 'Cập nhật order thành công'
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            }
        } catch (\Throwable $th) {
            $result = [
                'status' => 404,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function cancleOrder($id)
    {
        try {
            $existOrder = $this->orderModel->getOrder($id);

            if ($existOrder) {
                $this->orderModel->updateStatusCancle($id);

                $result = [
                    'status' => 200,
                    'message' => 'Hủy order thành công'
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            }
        } catch (\Throwable $th) {
            $result = [
                'status' => 404,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }
}
