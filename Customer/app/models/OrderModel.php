<?php
class OrderModel extends BaseModel
{
    const TableName = 'orders';

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

    public function getOrder($id)
    {
        $sql = "SELECT o.* FROM orders as o WHERE o.order_id = '{$id}'";
        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    public function updateStatuShipping($id)
    {
        $sql = "UPDATE " . self::TableName . " SET status = 'đang giao' WHERE order_id = '{$id}'";
        $result = $this->querySql($sql);
        return $result;
    }

    public function updateStatusCompleted($id)
    {
        $sql = "UPDATE " . self::TableName . " SET status = 'đã giao' WHERE order_id = '{$id}'";
        $result = $this->querySql($sql);
        return $result;
    }

    public function updateStatusCancle($id)
    {
        $sql = "UPDATE " . self::TableName . " SET status = 'đã hủy' WHERE order_id = '{$id}'";
        $result = $this->querySql($sql);
        return $result;
    }

    public function getRevenueToday()
    {
        $today = (new DateTime())->format('Y-m-d');
        $sql = "SELECT SUM(total_price) AS revenueToday FROM orders WHERE DATE(created_at) = '{$today}'";

        $result = $this->querySql($sql);
        return mysqli_fetch_array($result);
    }

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

    public function getOrderHistory($cus_id)
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
                p.price AS product_price
            FROM orders AS o
            JOIN order_details AS od ON o.order_id = od.order_id
            JOIN products AS p ON od.product_id = p.product_id
            WHERE o.customer_id = ${cus_id}
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

    public function getChartData()
    {
        $default_start_date = (new DateTime())->format('Y-m-d H:i:s');
        $default_end_date = (new DateTime())->format('Y-m-d 23:59:59');

        $sql = "SELECT DATE(created_at) as date, COUNT(*) as total_orders, SUM(total_price) as total_revenue 
        FROM orders 
        WHERE created_at BETWEEN '{$default_start_date}' AND '{$default_end_date}' 
        GROUP BY date 
        ORDER BY date";

        $result = $this->querySql($sql);
        if ($result) {
            $chartData = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $chartData;
        }
        return [];
    }

    public function getChartDataFiltered($startDate, $endDate)
    {
        $sql = "SELECT DATE(created_at) as date, COUNT(*) as total_orders, SUM(total_price) as total_revenue 
        FROM orders 
        WHERE created_at BETWEEN '{$startDate}' AND '{$endDate}' 
        GROUP BY date 
        ORDER BY date";

        $result = $this->querySql($sql);
        if ($result) {
            $chartData = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $chartData;
        }
        return [];
    }

    public function getLastestOrder()
    {
        $sql = "SELECT o.* FROM orders as o ORDER BY o.order_id DESC LIMIT 1";
        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    public function createOrder($data)
    {
        return $this->create(self::TableName, $data);
    }
}
