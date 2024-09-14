<?php
class CartDetailModel extends BaseModel
{
    const TableName = 'cart_details';

    public function getAllCart($cus_id)
    {
        $sql = "SELECT cd.cart_detail_id,cd.quantity as cart_quantity , p.* FROM cart_details AS cd
                JOIN carts AS c ON cd.cart_id = c.cart_id
                JOIN customers AS cu ON c.customer_id = cu.customer_id
                JOIN products AS p ON cd.product_id = p.product_id
                WHERE cu.customer_id = ${cus_id}";

        $result = $this->querySql($sql);

        if ($result) {
            $cartDetail = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $cartDetail;
        }

        return [];
    }

    public function getCartDetail($id)
    {
        $sql = "SELECT cd.*,p.*,cd.quantity as cartQuantity FROM cart_details  AS cd
            JOIN products as p ON cd.product_id = p.product_id
            WHERE cd.cart_detail_id = '${id}'";
        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    public function countCart($cus_id, $cart_id)
    {
        $sql = "SELECT COUNT(cd.cart_detail_id) AS 'countCart' FROM cart_details AS cd
                JOIN carts AS c ON c.cart_id = cd.cart_id
                JOIN customers AS cs ON c.customer_id = cs.customer_id
                WHERE cs.customer_id = '${cus_id}' AND c.cart_id = '${cart_id}'
        ";

        $result = $this->querySql($sql);
        $row = mysqli_fetch_assoc($result);
        return (int) $row['countCart'];
    }

    public function existingCartDetail($cart_id, $product_id)
    {
        $sql = "SELECT cd.* , p.* FROM cart_details AS cd
                JOIN carts AS c ON cd.cart_id = c.cart_id
                JOIN products AS p ON cd.product_id = p.product_id
                WHERE cd.cart_id = ${cart_id} 
                AND p.product_id = ${product_id}";

        $result = $this->querySql($sql);

        return mysqli_fetch_assoc($result);
    }

    public function createCart($data)
    {
        return $this->create(self::TableName, $data);
    }

    public function updateCart($cartDetailId, $data)
    {
        $updateData = [];
        foreach ($data as $key => $value) {
            $updateData[] = "$key = '$value'";
        }
        $updateData = implode(', ', $updateData);

        $sql = "UPDATE cart_details SET $updateData WHERE cart_detail_id = ${cartDetailId}";
        $result = $this->querySql($sql);
        return $result;
    }

    public function updateQuantityCart($cartDetailId)
    {
        $sql = "UPDATE cart_details SET quantity = quantity + 1 WHERE cart_detail_id = ${cartDetailId}";
        $result = $this->querySql($sql);
        return $result;
    }

    public function destroyCart($id)
    {
        $sql = "DELETE c.* FROM cart_details as c WHERE c.cart_detail_id = {$id}";
        $result = $this->querySql($sql);
        return $result;
    }
}
