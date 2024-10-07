<?php
class OrderModel extends BaseModel
{
    const TableName = 'orders';

    public function getUserId()
    {
        return isset($_SESSION['auth_admin']['user_id']) ? $_SESSION['auth_admin']['user_id'] : 1;
    }

    /**
     * Lấy thông tin chi tiết của tất cả các đơn hàng cùng với chi tiết sản phẩm và danh mục liên quan.
     * 
     * Phương thức này thực hiện truy vấn đến cơ sở dữ liệu để lấy thông tin của các đơn hàng,
     * chi tiết đơn hàng, sản phẩm và danh mục sản phẩm. Kết quả trả về là một mảng các đơn hàng,
     * mỗi đơn hàng chứa thông tin chi tiết về người nhận, giá trị đơn hàng, trạng thái,
     * và danh sách chi tiết sản phẩm trong đơn hàng đó.
     *
     * @return array Mảng chứa thông tin của tất cả các đơn hàng.
     */
    public function getOrders()
    {
        $sql = "SELECT 
                o.order_id,
                o.customer_id,
                o.name_receiver,
                o.phone_receiver,
                o.address_receiver,
                o.notes,
                o.total_price AS order_total_price,
                o.status AS order_status,
                o.created_at AS order_created_at,
                o.updated_at AS order_updated_at,
                od.order_detail_id,
                od.product_id,
                od.quantity AS order_detail_quantity,
                od.price AS order_detail_price,
                od.create_at AS order_detail_created_at,
                od.update_at AS order_detail_updated_at,
                p.product_name,
                p.description AS product_description,
                p.image AS product_image,
                p.price AS product_price,
                c.cat_id,
                c.category_name
            FROM orders AS o
            JOIN order_details AS od ON o.order_id = od.order_id
            JOIN products AS p ON od.product_id = p.product_id
            JOIN categories AS c ON p.cat_id = c.cat_id
            ORDER BY FIELD(o.status, 'đang chờ', 'đang giao', 'đã giao', 'đã hủy') ASC, o.created_at DESC
            ";

        $result = $this->querySql($sql);

        if ($result) {
            $orders = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $order_id = $row['order_id'];

                // Tạo mới đối tượng order nếu chưa tồn tại
                if (!isset($orders[$order_id])) {
                    $orders[$order_id] = [
                        'order_id' => $order_id,
                        'customer_id' => $row['customer_id'],
                        'name_receiver' => $row['name_receiver'],
                        'phone_receiver' => $row['phone_receiver'],
                        'address_receiver' => $row['address_receiver'],
                        'notes' => $row['notes'],
                        'total_price' => $row['order_total_price'],
                        'status' => $row['order_status'],
                        'created_at' => $row['order_created_at'],
                        'updated_at' => $row['order_updated_at'],
                        'orderDetail' => []
                    ];
                }

                // Tạo mới đối tượng orderDetail
                $orderDetail = [
                    'order_detail_id' => $row['order_detail_id'],
                    'product_id' => $row['product_id'],
                    'quantity' => $row['order_detail_quantity'],
                    'price' => $row['order_detail_price'],
                    'created_at' => $row['order_detail_created_at'],
                    'updated_at' => $row['order_detail_updated_at'],
                    'product' => [
                        'product_name' => $row['product_name'],
                        'description' => $row['product_description'],
                        'price' => $row['product_price'],
                        'image' => $row['product_image'],
                        'categories' => [
                            'cat_id' => $row['cat_id'],
                            'category_name' => $row['category_name']
                        ]
                    ]
                ];

                // Thêm orderDetail vào order tương ứng
                $orders[$order_id]['orderDetail'][] = $orderDetail;
            }

            // Giải phóng bộ nhớ
            mysqli_free_result($result);

            // Chuyển đổi mảng kết quả thành mảng kết quả cuối cùng
            $final_orders = array_values($orders);

            return $final_orders;
        }

        return [];
    }

    /**
     * Lấy thông tin chi tiết của một đơn hàng dựa trên ID đơn hàng.
     * 
     * Phương thức này sử dụng ID đơn hàng để truy vấn cơ sở dữ liệu và lấy thông tin chi tiết của đơn hàng đó.
     * Kết quả trả về là một mảng kết hợp chứa thông tin của đơn hàng.
     *
     * @param string $id ID của đơn hàng cần lấy thông tin.
     * @return array|null Mảng kết hợp chứa thông tin của đơn hàng, hoặc null nếu không tìm thấy.
     */
    public function getOrder($id)
    {
        $sql = "SELECT o.* FROM orders as o WHERE o.order_id = '{$id}'";
        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    /**
     * Cập nhật trạng thái của đơn hàng thành 'đang giao'.
     * 
     * Phương thức này cập nhật trạng thái của đơn hàng trong cơ sở dữ liệu dựa trên ID đơn hàng được cung cấp.
     * Trạng thái của đơn hàng sẽ được cập nhật thành 'đang giao'.
     *
     * @param string $id ID của đơn hàng cần cập nhật trạng thái.
     * @return bool Trả về true nếu cập nhật thành công, false nếu thất bại.
     */
    public function updateStatuShipping($id)
    {
        $user_id = $this->getUserId();
        $sql = "UPDATE " . self::TableName . " SET status = 'đang giao', updated_by={$user_id} WHERE order_id = '{$id}'";
        $result = $this->querySql($sql);
        return $result;
    }

    /**
     * Cập nhật trạng thái của đơn hàng thành 'đã giao'.
     * 
     * Tương tự như phương thức updateStatuShipping, nhưng trạng thái được cập nhật thành 'đã giao'.
     *
     * @param string $id ID của đơn hàng cần cập nhật trạng thái.
     * @return bool Trả về true nếu cập nhật thành công, false nếu thất bại.
     */
    public function updateStatusCompleted($id)
    {
        $user_id = $this->getUserId();

        // Lấy số lượng order detail và customer_id từ orderID
        $sql_order = "SELECT o.customer_id, COUNT(od.order_detail_id) as detail_count 
                      FROM orders o 
                      JOIN order_details od ON o.order_id = od.order_id 
                      WHERE o.order_id = '{$id}'";
        $result_order = $this->querySql($sql_order);
        $order_info = mysqli_fetch_assoc($result_order);
        $detail_count = $order_info['detail_count'];
        $customer_id = $order_info['customer_id'];

        // Cập nhật trạng thái đơn hàng và thêm số lượng chi tiết đơn hàng
        $sql_update_order = "UPDATE " . self::TableName . " SET status = 'đã giao', updated_by={$user_id} WHERE order_id = '{$id}'";
        $result_update_order = $this->querySql($sql_update_order);

        // Tính toán và cập nhật điểm cho khách hàng
        $points_to_add = 20 * $detail_count;
        $sql_update_customer = "UPDATE customers SET customer_points = customer_points + {$points_to_add} WHERE customer_id = '{$customer_id}'";
        $result_update_customer = $this->querySql($sql_update_customer);

        return $result_update_order && $result_update_customer;
    }

    /**
     * Cập nhật trạng thái của đơn hàng thành 'đã hủy'.
     * 
     * Tương tự như các phương thức cập nhật trạng thái khác, nhưng trạng thái được cập nhật thành 'đã hủy'.
     *
     * @param string $id ID của đơn hàng cần cập nhật trạng thái.
     * @return bool Trả về true nếu cập nhật thành công, false nếu thất bại.
     */
    public function updateStatusCancle($id)
    {
        $user_id = $this->getUserId();
        $sql = "UPDATE " . self::TableName . " SET status = 'đã hủy', updated_by={$user_id} WHERE order_id = '{$id}'";
        $result = $this->querySql($sql);
        return $result;
    }

    /**
     * Tính toán và lấy tổng doanh thu từ các đơn hàng trong ngày hiện tại.
     * 
     * Phương thức này truy vấn cơ sở dữ liệu để tính tổng giá trị của tất cả các đơn hàng đã được tạo trong ngày hiện tại.
     * Kết quả trả về là tổng doanh thu.
     *
     * @return array Mảng chứa tổng doanh thu trong ngày hiện tại.
     */
    public function getRevenueToday()
    {
        $today = (new DateTime())->format('Y-m-d');
        $sql = "SELECT SUM(total_price) AS revenueToday FROM orders WHERE DATE(created_at) = '{$today}' AND orders.status = 'đã giao'";

        $result = $this->querySql($sql);
        return mysqli_fetch_array($result);
    }

    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(total_price) AS revenueToday FROM orders WHERE orders.status = 'đã giao'";

        $result = $this->querySql($sql);
        return mysqli_fetch_array($result);
    }

    /**
     * Lấy thông tin của các đơn hàng được tạo trong ngày hiện tại, giới hạn ở 6 đơn hàng.
     * 
     * Phương thức này truy vấn cơ sở dữ liệu để lấy thông tin của các đơn hàng được tạo trong ngày hiện tại.
     * Số lượng đơn hàng trả về được giới hạn là 6.
     *
     * @return array Mảng chứa thông tin của các đơn hàng trong ngày hiện tại.
     */
    public function getTransactionToday()
    {
        $today = (new DateTime())->format('Y-m-d');
        $sql = "SELECT o.*
            FROM orders as o
            WHERE DATE(o.created_at) = '{$today}'
            LIMIT 6
            ";
        $result = $this->querySql($sql);

        if ($result) {
            $transaction = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $transaction;
        }

        return [];
    }

    /**
     * Lấy dữ liệu biểu đồ cho các đơn hàng và doanh thu theo ngày.
     * 
     * Phương thức này truy vấn cơ sở dữ liệu để lấy số lượng đơn hàng và tổng doanh thu theo ngày.
     * Có thể lọc theo khoảng thời gian nếu cung cấp ngày bắt đầu và kết thúc.
     *
     * @param string|null $startDate Ngày bắt đầu của khoảng thời gian (nếu có).
     * @param string|null $endDate Ngày kết thúc của khoảng thời gian (nếu có).
     * @return array Mảng chứa dữ liệu biểu đồ theo ngày.
     */
    public function getChartData()
    {
        $default_start_date = (new DateTime())->format('Y-m-d H:i:s');
        $default_end_date = (new DateTime())->format('Y-m-d 23:59:59');

        $sql = "SELECT DATE(created_at) as date, COUNT(*) as total_orders, SUM(total_price) as total_revenue 
        FROM orders 
        WHERE created_at BETWEEN '{$default_start_date}' AND '{$default_end_date}' 
        AND orders.status = 'đã giao'
        GROUP BY date 
        ORDER BY date";

        $result = $this->querySql($sql);
        if ($result) {
            $chartData = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $chartData;
        }
        return [];
    }

    /**
     * Lấy dữ liệu biểu đồ cho các đơn hàng và doanh thu theo ngày.
     * 
     * Phương thức này truy vấn cơ sở dữ liệu để lấy số lượng đơn hàng và tổng doanh thu theo ngày.
     * Có thể lọc theo khoảng thời gian nếu cung cấp ngày bắt đầu và kết thúc.
     *
     * @param string|null $startDate Ngày bắt đầu của khoảng thời gian (nếu có).
     * @param string|null $endDate Ngày kết thúc của khoảng thời gian (nếu có).
     * @return array Mảng chứa dữ liệu biểu đồ theo ngày.
     */
    public function getChartDataFiltered($startDate, $endDate)
    {
        $sql = "SELECT DATE(created_at) as date, COUNT(*) as total_orders, SUM(total_price) as total_revenue 
        FROM orders 
        WHERE created_at BETWEEN '{$startDate}' AND '{$endDate}' AND orders.status = 'đã giao'
        GROUP BY date 
        ORDER BY date";

        $result = $this->querySql($sql);
        if ($result) {
            $chartData = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $chartData;
        }
        return [];
    }
}
