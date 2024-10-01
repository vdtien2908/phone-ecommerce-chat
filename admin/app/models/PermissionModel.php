<?php
class PermissionModel extends BaseModel
{
    const TableName = 'permissions';
    const PermissionRoleTable = 'role_permissions';

    public function createPermission($data)
    {
        return $this->create(self::TableName, $data);
    }

    public function getPermissions()
    {
        $sql = "SELECT p.* FROM permissions as p Where p.status=1  ORDER BY p.status DESC";
        $result = $this->querySql($sql);
        if ($result) {
            $permissions = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $permissions;
        }
        return [];
    }

    public function associatePermissionWithRole($roleId, $permissionId)
    {
        $sql = "
            INSERT INTO role_permissions(role_id, permission_id) 
            VALUE(${roleId}, ${permissionId})
        ";
        return $this->querySql($sql);
    }

    public function getPermissionsByRoleId($id)
    {
        $sql = "SELECT * FROM role_permissions  WHERE role_id = ${id}";
        $result = $this->querySql($sql);
        if ($result) {
            $permissions = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $permissions;
        }
        return [];
    }

    public function getPermissionByUser($user_id)
    {
      $sql ="SELECT p.permission_code
            FROM users u
            JOIN roles r ON u.role_id = r.role_id
            JOIN role_permissions rp ON r.role_id = rp.role_id
            JOIN permissions p ON rp.permission_id = p.permission_id
            WHERE u.user_id = ${user_id}";
        $result = $this->querySql($sql);
        if ($result) {
            $permissions = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $permissions;
        }
        return [];  
    }
}
