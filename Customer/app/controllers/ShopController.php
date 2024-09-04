<?php
class ShopController extends BaseController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
    }

    public function index()
    {
        $this->view(
            'app',
            [
                'page' => 'shop/index',
                'title' => 'Shop',
            ]
        );
    }

    public function all()
    {
        $products = $this->productModel->getProducts();

        if (!$products) {
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
            'data' => $products,
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
        return;
    }

    public function detail($id)
    {
        $product = $this->productModel->getProduct($id);

        $this->view(
            'app',
            [
                'page' => 'shop/detail',
                'title' => 'Shop',
                'product' => $product
            ]
        );
    }

    public function showProductDetailData($id)
    {
        $product = $this->productModel->getProduct($id);
        $reviews = $this->productModel->getProductReviews($id);

        if (!$product) {
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
            'data' => $product,
            'reviews' => $reviews,
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
        return;
    }

    public function getRelatedProducts($id, $cat_id)
    {
        $product = $this->productModel->getRelatedProducts($id, $cat_id);

        if (!$product) {
            $result = [
                'status' => 204,
                'message' => "Lỗi fetch related sản phẩm!"
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
            return;
        }

        $result = [
            'status' => 200,
            'message' => "success",
            'data' => $product,
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
        return;
    }

    public function filterByCategory($id)
    {
        try {
            $products = $this->productModel->getProductsByCategory($id);

            $result = [
                'status' => 200,
                'message' => "Tìm sản phẩm theo danh mục thành công",
                'data' => $products,
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

    public function filterByPrice($minPrice, $maxPrice)
    {
        // Assuming prices are sent as query parameters
        $minPrice = isset($minPrice) ? str_replace('$', '', $minPrice) : 1000000;
        $maxPrice = isset($maxPrice) ? str_replace('$', '', $maxPrice) : 45000000;

        $products = $this->productModel->getProductsByPrice($minPrice, $maxPrice);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'message' => 'Filtered products by price successfully',
            'data' => $products
        ]);
    }

    // Lấy danh sách đánh giá sản phẩm
    public function getProductReviews($productId)
    {
        $reviews = $this->productModel->getProductReviews($productId);

        $result = [
            'status' => 200,
            'message' => "Lấy danh sách đánh giá thành công",
            'data' => $reviews,
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    // Thêm đánh giá sản phẩm mới
    public function addProductReview()
    {
        $productId = $_POST['product_id'] ?? null;
        $email = $_POST['email'] ?? null;
        $content = $_POST['content'] ?? null;
        $rate = $_POST['rate'] ?? null;

        if (!$productId || !$email || !$content || !$rate) {
            $result = [
                'status' => 400,
                'message' => "Thiếu thông tin đánh giá",
            ];
        } else {
            $success = $this->productModel->addProductReview($productId, $email, $content, $rate);
            
            if ($success) {
                $result = [
                    'status' => 201,
                    'message' => "Thêm đánh giá thành công",
                ];
            } else {
                $result = [
                    'status' => 500,
                    'message' => "Lỗi khi thêm đánh giá",
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    // Cập nhật đánh giá sản phẩm
    public function updateProductReview()
    {
        $reviewId = $_POST['review_id'] ?? null;
        $content = $_POST['content'] ?? null;
        $rate = $_POST['rate'] ?? null;

        if (!$reviewId || !$content || !$rate) {
            $result = [
                'status' => 400,
                'message' => "Thiếu thông tin cập nhật đánh giá",
            ];
        } else {
            $success = $this->productModel->updateProductReview($reviewId, $content, $rate);
            
            if ($success) {
                $result = [
                    'status' => 200,
                    'message' => "Cập nhật đánh giá thành công",
                ];
            } else {
                $result = [
                    'status' => 500,
                    'message' => "Lỗi khi cập nhật đánh giá",
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    // Xóa đánh giá sản phẩm
    public function deleteProductReview($reviewId)
    {
        $success = $this->productModel->deleteProductReview($reviewId);

        if ($success) {
            $result = [
                'status' => 200,
                'message' => "Xóa đánh giá thành công",
            ];
        } else {
            $result = [
                'status' => 500,
                'message' => "Lỗi khi xóa đánh giá",
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function getUserReview($productId)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['auth'])) {
            $result = [
                'status' => 401,
                'message' => "Người dùng chưa đăng nhập",
                'status' => false
            ];
        } else {
            $userEmail = $_SESSION['auth']['email'];
            $review = $this->productModel->getUserProductReview($productId, $userEmail);
            
            if ($review) {
                $result = [
                    'status' => 200,
                    'message' => "Lấy đánh giá người dùng thành công",
                    'data' => $review,
                    'status' => true
                ];
            } else {
                $result = [
                    'status' => 204,
                    'message' => "Người dùng chưa đánh giá sản phẩm này",
                    'status' => false
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
