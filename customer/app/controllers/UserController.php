<?php
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/PHPMailer/src/Exception.php';
require './vendor/PHPMailer/src/PHPMailer.php';
require './vendor/PHPMailer/src/SMTP.php';

class UserController extends BaseController
{

    private $orderModel;
    private $customerModel;
    private $promotionModel;


    public function __construct()
    {
        $this->orderModel = $this->model('OrderModel');
        $this->customerModel = $this->model('CustomerModel');
        $this->promotionModel = $this->model('PromotionModel');
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
            $email = $_SESSION['auth']['email'];

            if ($existOrder) {
                $customer = $this->customerModel->getCustomer($existOrder['customer_id']);
                $this->orderModel->updateStatusCompleted($id);

                // Handle send promotion code when pay 20.000.000tr
                //  Thay 20.000.000 thành số khác
                if($customer['customer_points'] > 500){
                    // Random code promotion
                    $promotion_code = rand(000000, 999999);

                    $data_promotion =[
                        'promotion_code'=>$promotion_code, 
                        'value'=>10,
                    ];

                    if($customer['customer_points'] > 2000){
                        $data_promotion['value'] = 20;
                    } elseif($customer['customer_points'] > 1000){
                        $data_promotion['value'] = 15;
                    }
                    
                    // Save promotion code from database
                    $this->promotionModel->createPromotion($data_promotion);

                    // handle send Email
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    // sử dụng gmail SMTP của google
                    $mail->Username = 'kongtu2x@gmail.com';
                    $mail->Password = 'dwljfcmjigtcbymb';
                    $mail->Port = 465;
                    $mail->SMTPSecure = 'ssl';

                    // Config header
                    $mail->setFrom('kongtu2x@gmail.com', 'Augentern-shop');
                    $mail->addAddress($email);

                    $promotion_value = $data_promotion['value'];

                    // Config content
                    $mail->isHTML(true);   //Set email format to HTML
                    $mail->Subject = 'Augentern-shop: Voucher';
                    $mail->Body    = "Chúng tôi tặng bạn mã giảm giá ${promotion_value}% tương đương với số điểm tích lũy mã bạn có khi mua thành công đơn hàng: 
                    <b>${promotion_code}</b>";

                    $mail->send();
                }

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
