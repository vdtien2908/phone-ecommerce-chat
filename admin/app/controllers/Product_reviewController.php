<?php
class Product_reviewController extends BaseController
{

    private $categoryModel;

    /**
     * Lớp Product_reviewController này giúp quản lý các thao tác liên quan
     *  đến danh mục như xem, tạo, cập nhật và xóa. 
     */
    /**
     * Khởi tạo controller và liên kết với model productModel.
     */
    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
    }

    /**
     * Hiển thị trang danh sách các sản phẩm.
     * Trang được render là 'product_review/index' với tiêu đề 'Đánh giá sản phẩm'.
     */
    public function index()
    {
        $this->view(
            'app',
            [
                'page' => 'product_reviews/index',
                'title' => 'Đánh giá sản phẩm',
            ]
        );
    }

    /**
     * Lấy tất cả đánh giá sản phẩm và trả về dưới dạng JSON.
     * Kết quả trả về bao gồm trạng thái HTTP và dữ liệu danh mục.
     */
    public function all()
    {
        $reviews = $this->productModel->getProductReviews();

        $result = [
            'status' => 200,
            'data' => $reviews
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }
    
    

    

    /**
     * Xóa đánh giá dựa trên ID.
     * Nếu đánh giá không tồn tại, trả về lỗi không tìm thấy.
     * Nếu tồn tại, xóa đánh giá và chuyển hướng người dùng về trang danh sách đánh giá.
     */
    public function destroy($id)
    {
        try {
            $this->productModel->deleteProductReview($id);

            $result = [
                'status' => 200,
                'message' => "Xóa đánh giá thành công"
            ];

            header('Location: /phone-ecommerce-chat/admin/product_review');
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => "Xóa đánh giá thất bại"
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }
}
