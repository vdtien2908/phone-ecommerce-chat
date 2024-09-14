<?php
class CartModel extends BaseModel
{
    const TableName = 'carts';

    public function getCartByCustomerId($id)
    {
        $sql = "SELECT c.* FROM carts as c
            WHERE c.customer_id = '${id}'";

        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    public function createCart($data)
    {
        return $this->create(self::TableName, $data);
    }
}
