<?php
class CartModel extends BaseModel
{
    const TableName = 'carts';

    public function createCart($data)
    {
        return $this->create(self::TableName, $data);
    }
}
