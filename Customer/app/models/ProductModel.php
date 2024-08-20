<?php
class ProductModel extends BaseModel
{
    const TableName = 'products';

    public function getProducts()
    {
        $sql = "SELECT p.* ,c.category_name,c.cat_id FROM products as p
        JOIN categories as c 
        ON p.cat_id = c.cat_id
        WHERE p.status = 1
        ORDER BY p.status = 1 DESC, p.created_at DESC";
        $result = $this->querySql($sql);
        if ($result) {
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $products;
        }
        return [];
    }

    public function getProduct($id)
    {
        $sql = "SELECT p.* ,c.category_name,c.cat_id FROM products as p
        JOIN categories as c 
        ON p.cat_id = c.cat_id
        WHERE p.product_id = ${id} AND p.status = 1
        ORDER BY p.status = 1 DESC, p.created_at DESC";

        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getTop10NewProduct()
    {
        $sql = "SELECT p.* ,c.category_name,c.cat_id FROM products as p
        JOIN categories as c 
        ON p.cat_id = c.cat_id
        WHERE p.status = 1
        ORDER BY p.created_at DESC
        LIMIT 10
        ";
        $result = $this->querySql($sql);
        if ($result) {
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $products;
        }
        return [];
    }

    public function getHotTrend()
    {
        $sql = "SELECT * FROM products WHERE products.status = 1 ORDER BY products.created_at DESC LIMIT 5";
        $result = $this->querySql($sql);
        if ($result) {
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $products;
        }
        return [];
    }

    public function getTop10Seller()
    {
        $sql = "SELECT products.*, SUM(order_details.quantity) AS total_quantity
        FROM products
        JOIN order_details ON order_details.product_id = products.product_id
        JOIN orders ON orders.order_id = order_details.order_id
        WHERE products.status = 1 
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

    public function getProductsByCategory($cat_id)
    {
        $sql = "SELECT * FROM products WHERE products.cat_id = ${cat_id} AND products.status=1";
        $result = $this->querySql($sql);
        if ($result) {
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $products;
        }
        return [];
    }

    public function getProductsByPrice($minPrice, $maxPrice)
    {
        $sql = "SELECT * FROM products WHERE price BETWEEN ${minPrice} AND ${maxPrice} AND products.status = 1";
        $result = $this->querySql($sql);
        if ($result) {
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $products;
        }
        return [];
    }

    public function getRelatedProducts($id, $cat_id)
    {
        $sql = "SELECT * FROM products WHERE cat_id = ${cat_id} AND product_id != ${id} AND status = 1";
        $result = $this->querySql($sql);
        if ($result) {
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $products;
        }
        return [];
    }

    public function searchProduct($name)
    {
        $sql = " SELECT * FROM products 
        WHERE products.Status = 1 
        AND products.name like '%${name}%'";
        return $this->querySql($sql);
    }

    public function updateQuantity($productId, $quantityToDeduct)
    {
        $sql = "UPDATE products SET quantity = quantity - ${quantityToDeduct} WHERE product_id = ${productId}";
        return $this->querySql($sql);
    }
}
