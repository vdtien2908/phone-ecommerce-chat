<?php
class CategoryModel extends BaseModel
{
    const TableName = 'categories';

    private function getUserId()
    {
        return isset($_SESSION['auth_admin']['user_id']) ? $_SESSION['auth_admin']['user_id'] : 1;
    }

    public function getCategories()
    {
        // Giả sử trường thời gian tạo là `created_at`
        $sql = "SELECT c.* FROM categories as c ORDER BY c.status DESC, c.created_at DESC";
        $result = $this->querySql($sql);
        if ($result) {
            $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $categories;
        }
        return [];
    }

    public function getCategoriesByStatusTrue()
    {
        // Giả sử trường thời gian tạo là `created_at`
        $sql = "SELECT c.* FROM categories as c WHERE c.status = 1 ORDER BY c.status DESC, c.created_at DESC";
        $result = $this->querySql($sql);
        if ($result) {
            $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $categories;
        }
        return [];
    }

    public function getCategory($id)
    {
        $sql = "SELECT c.* FROM categories as c WHERE c.cat_id = '{$id}'";
        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }


    public function searchCategories($name)
    {
        $sql = "SELECT c.* FROM categories as c WHERE c.category_name LIKE '%${$name}'";
        $result = $this->querySql($sql);
        return mysqli_fetch_array($result);
    }

    public function createCategory($data)
    {
        return $this->create(self::TableName, $data);
    }

    public function updateCategory($id, $data)
    {   
        $user_id = $this->getUserId();
        $sql = "UPDATE " . self::TableName . " SET category_name = '{$data['category_name']}', updated_by={$user_id} WHERE cat_id = '{$id}'";
        $result = $this->querySql($sql);
        return $result;
    }

    public function deleteCategory($id)
    {
        $user_id = $this->getUserId();
        $sql = "UPDATE " . self::TableName . " SET status = NOT status, deleted_by={$user_id} WHERE cat_id = '{$id}'";
        $result = $this->querySql($sql);
        return $result;
    }
}
