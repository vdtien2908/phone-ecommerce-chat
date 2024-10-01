<?php
class PermissionController extends BaseController
{

    private $permissionModel;
    private $roleModel;

    public function __construct()
    {
        $this->permissionModel = $this->model('PermissionModel');
        $this->roleModel = $this->model('RoleModel');
    }

    

    public function index()
    {
        $this->view(
            'app',
            [
                'page' => 'permissions/index',
                'title' => 'Phân quyền',
            ]
        );
    }

    public function all()
    {
        $roles = $this->roleModel->getRoles();


        $result = [
            'status' => 200,
            'data' => $roles
        ];
        header('Content-Type: application/json');
        echo json_encode($result);
    }
    
    public function create()
    {
        $permissions = $this->permissionModel->getPermissions();
        $this->view(
            'app',
            [
                'page' => 'permissions/create',
                'title' => 'Tạo quyền',
                'permissions'=> $permissions
            ]
        );
    }

    public function store()
    {
        try {
            $roleName = $_POST['permission_name'];
            $functions = isset($_POST['functions']) ? $_POST['functions'] : [];

            if ($roleName) {
                // Create the role
                $roleId = $this->roleModel->createRole(['role_name' => $roleName]);

                // Associate permissions with the role
                if ($roleId && !empty($functions)) {
                    foreach ($functions as $permissionId) {
                        $this->permissionModel->associatePermissionWithRole($roleId, $permissionId);
                    }
                }

                $result = [
                    'status' => 201,
                    'message' => "Tạo quyền thành công",
                ];
                header('Content-Type: application/json');
                echo json_encode($result);
            } else {
                $result = [
                    'status' => 400,
                    'message' => "Vui lòng cung cấp tên quyền"
                ];
                header('Content-Type: application/json');
                echo json_encode($result);
            }
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => "Đã xảy ra lỗi: " . $th->getMessage()
            ];
            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    
    public function edit($id)
    {
        $roles = $this->roleModel->getPermissionsByRoleId($id);
        $role = $this->roleModel->getRole($id);
        $permissions = $this->permissionModel->getPermissions();
        $permission_ids = array_column($roles, 'permission_id');
        if (!$role) {
            $_SESSION['success'] = 'Không tìm thấy quyền';
            header('Location: /phone-ecommerce-chat/admin/permission');
        }

        $this->view(
            'app',
            [
                'page' => 'permissions/edit',
                'title' => 'Thống kê',
                'role' => $role,
                'permissions' => $permissions,
                'permission_ids' => $permission_ids
            ]
        );
    }

    public function update($id)
    {
        try {
            $roleName = $_POST['permission_name'];
            $functions = isset($_POST['functions']) ? $_POST['functions'] : [];

            if ($roleName) {
                $data = ['role_name' => $roleName];
                $this->roleModel->updateRole($id, $data);

                $this->roleModel->deleteRolePermission($id);
               // Associate permissions with the role
               if ($id && !empty($functions)) {
                    foreach ($functions as $permissionId) {
                        $this->permissionModel->associatePermissionWithRole($id, $permissionId);
                    }
                }

                $result = [
                    'status' => 200,
                    'message' => "Cập nhật quyền thành công"
                ];
                header('Content-Type: application/json');
                echo json_encode($result);
            } else {
                $_SESSION['role_name'] = 'Vui lòng cung cấp tên quyền';
                $result = [
                    'status' => 201,
                    'message' => "Cập nhật quyền thất bại"
                ];
                header('Content-Type: application/json');
                echo json_encode($result);
            }
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }


    public function destroy($id)
    {
        try {
            $this->roleModel->deleteRole($id);

            $result = [
                'status' => 204,
                'message' => "Xóa quyền thành công"
            ];

            header('Location: /phone-ecommerce-chat/admin/permission');
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => "Xóa quyền thất bại: " . $th->getMessage()
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }
}
