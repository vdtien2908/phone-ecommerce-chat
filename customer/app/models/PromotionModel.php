<?php
class PromotionModel extends BaseModel
{
    const TableName = 'promotions';

    public function createPromotion($data){
        return $this->create(self::TableName, $data);
    }

    public function getPromotionByCode($code){
        $sql = "SELECT promotions.promotion_id,promotions.promotion_code,promotions.value FROM promotions WHERE promotions.promotion_used = 0 AND promotions.status = 1 AND promotions.promotion_code = '${code}'";
    
        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }
}
