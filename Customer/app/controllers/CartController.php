<?php
class CartController extends BaseController
{
    private $cartDetailModel;
    private $cartModel;

    public function __construct()
    {
        $this->cartDetailModel = $this->model('CartDetailModel');
        $this->cartModel = $this->model('CartModel');
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
                'page' => 'cart/index',
                'title' => 'Shop',
            ]
        );
    }

    public function getAll()
    {
        try {
            $cus_id = $_SESSION['auth']['customer_id'];

            $cart = $this->cartDetailModel->getAllCart($cus_id);

            if (!$cart) {
                $result = [
                    'status' => 204,
                    'message' => "Lỗi fetch sản phẩm!"
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            }

            $result = [
                'status' => 200,
                'message' => "success",
                'data' => $cart,
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
            return;
        } catch (\Throwable $th) {
            $result = [
                'status' => 200,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function store()
    {
        try {
            $cart = $this->cartModel->getCartByCustomerId($_SESSION['auth']['customer_id']);

            $existingCartDetail = $this->cartDetailModel->existingCartDetail($cart['cart_id'], $_POST['product_id']);

            if ($existingCartDetail) {
                $newQuantity = intval($existingCartDetail['quantity']) + intval($_POST['quantity']);
                $data = ['quantity' => $newQuantity];
 
                $this->cartDetailModel->updateQuantityCart($existingCartDetail['cart_detail_id']);

                $result = [
                    'status' => 200,
                    'message' => "Đã cập nhật số lượng sản phẩm trong giỏ hàng"
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            } else { 
                $data = [
                    'quantity' => $_POST['quantity'],
                    'cart_id' => $cart['cart_id'],
                    'product_id' => $_POST['product_id'],
                ];

                $this->cartDetailModel->createCart($data);
            }

            $result = [
                'status' => 201,
                'message' => "Thêm vào giỏ hàng thành công!"
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 404,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function update()
    {
        try {
            $cartDetails = $_POST['cartDetails'];

            $cart = $this->cartModel->getCartByCustomerId($_SESSION['auth']['customer_id']);

            if (is_array($cartDetails)) {
                foreach ($cartDetails as $detail) {
                    $existingCartDetail = $this->cartDetailModel->existingCartDetail($cart['cart_id'], $detail['product_id']);

                    if ($existingCartDetail) {
                        $data = ['quantity' => $detail['quantity']];
                        $this->cartDetailModel->updateCart($existingCartDetail['cart_detail_id'], $data);
                    }
                }
            }

            $result = [
                'status' => 200,
                'message' => "Đã cập nhật giỏ hàng thành công!"
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 404,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function destroy($id)
    {
        try {
            $this->cartDetailModel->destroyCart($id);

            $result = [
                'status' => 204,
                'message' => "Đã xóa sản phẩm khỏi giỏ hàng!"
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
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
