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
}
