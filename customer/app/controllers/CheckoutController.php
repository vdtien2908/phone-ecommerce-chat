<?php

class CheckoutController extends BaseController
{
    private $cartDetailModel;
    private $orderModel;
    private $orderDetailModel;
    private $productModel;

    public function __construct()
    {
        $this->cartDetailModel = $this->model('CartDetailModel');
        $this->orderModel = $this->model('OrderModel');
        $this->productModel = $this->model('ProductModel');
        $this->orderDetailModel = $this->model('OrderDetailModel');
        $this->promotionModel = $this->model('PromotionModel');
    }

    public function index()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /phone-ecommerce-chat/customer/auth/login');
            return;
        }

        $this->view(
            'app',
            [
                'page' => 'checkout/index',
                'title' => 'checkout'
            ]
        );
    }

    public function processCheckout()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /phone-ecommerce-chat/customer/auth/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_items'])) {
            if (is_array($_POST['selected_items'])) {
                $list_cartDetailId = $_POST['selected_items'];
            } else {
                $list_cartDetailId = explode(',', $_POST['selected_items']);
            }

            $listData = [];

            foreach ($list_cartDetailId as $item) {
                $existingCartDetail = $this->cartDetailModel->getCartDetail($item);
                $listData[] = $existingCartDetail;
            }

            $result = [
                'status' => 200,
                'message' => "Tiến hành thanh toán!",
                'data' => $listData
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function store()
    {
        try {
            $nameReceiver = $_POST['name_receiver'];
            $phoneReceiver = $_POST['phone_receiver'];
            $addressReceiver = $_POST['address_receiver'];
            $notes = $_POST['notes'];
            $totalPrice = $_POST['total_price'];
            $customerId = $_SESSION['auth']['customer_id'];
            $listProductDetail = $_POST['listProductDetail'];
            $email = $_SESSION['auth']['email'];
  

          

            $dataOrder = [
                'customer_id' => $customerId,
                'name_receiver' => $nameReceiver,
                'phone_receiver' => $phoneReceiver,
                'address_receiver' => $addressReceiver,
                'notes' => $notes,
                'total_price' => $totalPrice,
            ];

              // Handle order when has promotion
              if(isset($_POST['promotion_code'])){
                $promotion_code = $_POST['promotion_code'];
                $promotion = $this->promotionModel->getPromotionByCode($promotion_code);
                $dataOrder['promotion_id'] = $promotion['promotion_id'];
                $dataOrder['total_price'] = $totalPrice - ($totalPrice * ($promotion['value'] / 100));
              }

            $this->orderModel->createOrder($dataOrder);

            $order = $this->orderModel->getLastestOrder();
            foreach ($listProductDetail as $item) {
                $this->orderDetailModel->createOrderDetail($order['order_id'], $item['product_id'], $item['cartQuantity'], $item['price']);

                $this->cartDetailModel->destroyCart($item['cart_detail_id']);

                $this->productModel->updateQuantity($item['product_id'], $item['cartQuantity']);
            }

            $result = [
                'status' => 200,
                'message' => 'Đặt hàng thành công'
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 200,
                'message' => $th->getMessage()
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function success()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /phone-ecommerce-chat/customer/auth/login');
            return;
        }

        $this->view(
            'app',
            [
                'page' => 'checkout/success',
                'title' => 'checkout'
            ]
        );
    }
}
