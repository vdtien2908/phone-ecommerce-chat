<?php
class UserModel extends BaseModel
{
    const TableName = 'users';

    public function getUserId()
    {
        return isset($_SESSION['auth_admin']['user_id']) ? $_SESSION['auth_admin']['user_id'] : 1;
    }
    public function getUsers()
    {
        $sql = "SELECT u.* FROM users as u ORDER BY u.created_at DESC";
        $result = $this->querySql($sql);

        if ($result) {
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $users;
        }

        return [];
    }

    public function getUser($id)
    {
        $sql = "SELECT u.* FROM users as u WHERE u.user_id = '${id}'";
        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    public function findEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = '${email}'";
        $result =  $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    public function createUser($data)
    {
        return $this->create(self::TableName, $data);
    }

    public function updateUser($id, $data)
    {
        return $this->update(self::TableName, 'user_id', $id, $data);
    }

    public function deleteUser($id)
    {
        $sql = "DELETE c.* FROM users as c WHERE c.user_id = '{$id}'";
        $result = $this->querySql($sql);
        return $result;
    }

    public function getTotalUser()
    {
        $sql = "SELECT COUNT(*) AS totalUser FROM users ORDER BY users.created_at DESC";
        $result = $this->querySql($sql);
        return 10;
    }
}
