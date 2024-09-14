<?php
class ProductModel extends BaseModel
{
    const TableName = 'products';

    /**
     * Lấy danh sách tất cả sản phẩm kèm thông tin danh mục của chúng.
     * Sản phẩm được sắp xếp theo trạng thái và ngày tạo giảm dần.
     * 
     * @return array Danh sách sản phẩm hoặc mảng rỗng nếu không có sản phẩm nào.
     */
    public function getProducts()
    {
        $sql = "SELECT p.* ,c.category_name,c.cat_id FROM products as p
        JOIN categories as c 
        ON p.cat_id = c.cat_id
        ORDER BY p.status DESC, p.created_at DESC";
        $result = $this->querySql($sql);
        if ($result) {
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $products;
        }
        return [];
    }

    /**
     * Lấy thông tin chi tiết của một sản phẩm dựa trên ID.
     * 
     * @param int $id ID của sản phẩm cần lấy thông tin.
     * @return array|null Thông tin sản phẩm hoặc null nếu không tìm thấy.
     */
    public function getProduct($id)
    {
        $sql = "SELECT c.* FROM products as c WHERE c.product_id = '{$id}'";
        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    /**
     * Đếm tổng số sản phẩm có trạng thái hoạt động (status = 1).
     * 
     * @return int Tổng số sản phẩm hoạt động.
     */
    public function getTotalProduct()
    {
        $sql = "SELECT COUNT(*) AS totalProduct FROM products WHERE status = 1";
        $result = $this->querySql($sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalProduct'];
        }
        return 0;
    }

    /**
     * Lấy danh sách 10 sản phẩm bán chạy nhất.
     * Sản phẩm được sắp xếp theo số lượng bán ra giảm dần.
     * 
     * @return array Danh sách 10 sản phẩm bán chạy nhất hoặc mảng rỗng nếu không có dữ liệu.
     */
    public function getTop10Seller()
    {
        $sql = "SELECT products.*, SUM(order_details.quantity) AS total_quantity
        FROM products
        JOIN order_details ON order_details.product_id = products.product_id
        JOIN orders ON orders.order_id = order_details.order_id
        -- WHERE orders.status = 'completed'
        GROUP BY products.product_id, products.cat_id, products.product_name, products.price, products.quantity, products.description, products.image, products.status, products.created_at, products.updated_at
        ORDER BY total_quantity DESC
        LIMIT 6";

        $result = $this->querySql($sql);

        if ($result) {
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $products;
        }

        return [];
    }

    /**
     * Tạo mới một sản phẩm.
     * 
     * @param array $data Mảng dữ liệu sản phẩm.
     * @return mixed Kết quả thực thi câu lệnh SQL.
     */
    public function createProduct($data)
    {
        return $this->create(self::TableName, $data);
    }

    /**
     * Lấy danh sách sản phẩm theo danh mục.
     * 
     * @param int $cat_id ID của danh mục.
     * @return mysqli_result Kết quả truy vấn.
     */
    public function getProductsByCategory($cat_id)
    {
        $sql = "SELECT * FROM products WHERE products.cat_id = ${cat_id} AND products.status=1";
        return $this->querySql($sql);
    }

    /**
     * Cập nhật thông tin sản phẩm.
     * 
     * @param int $id ID của sản phẩm cần cập nhật.
     * @param array $data Mảng dữ liệu cập nhật.
     * @return mixed Kết quả thực thi câu lệnh SQL.
     */
    public function updateProduct($id, $data)
    {
        return $this->update(self::TableName, 'product_id', $id, $data);
    }

    /**
     * Tìm kiếm sản phẩm theo tên.
     * 
     * @param string $name Tên sản phẩm cần tìm kiếm.
     * @return mysqli_result Kết quả truy vấn.
     */
    public function searchProduct($name)
    {
        $sql = " SELECT * FROM products 
        WHERE products.Status = 1 
        AND products.name like '%${name}%'";
        return $this->querySql($sql);
    }

    /**
     * Đảo trạng thái kích hoạt của sản phẩm (từ hoạt động sang không hoạt động và ngược lại).
     * 
     * @param int $id ID của sản phẩm cần đổi trạng thái.
     * @return mixed Kết quả thực thi câu lệnh SQL.
     */
    public function deleteProduct($id)
    {
        $sql = "UPDATE " . self::TableName . " SET status = NOT status WHERE product_id = '{$id}'";
        $result = $this->querySql($sql);
        return $result;
    }

    /**
     * Đếm tổng số sản phẩm có trạng thái hoạt động.
     * 
     * @return int Tổng số sản phẩm hoạt động.
     */
    public function totalProduct()
    {
        $sql = "SELECT COUNT(*) as productNumber FROM products WHERE products.Status = 1";
        $result = mysqli_fetch_array($this->querySql($sql));;
        return $result;
    }

    // Lấy danh sách đánh giá sản phẩm
    public function getProductReviews()
    {
        $sql = "SELECT * FROM product_reviews WHERE `status` = 1 ORDER BY created_at ASC";
        $result = $this->querySql($sql);
        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return [];
    }

    // Xóa đánh giá sản phẩm
    public function deleteProductReview($reviewId)
    {
        $sql = "UPDATE product_reviews SET status = NOT status WHERE product_review_id = '{$reviewId}'";
        $result = $this->querySql($sql);
        return $result;
    }
}
