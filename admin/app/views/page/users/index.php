<style>
    .disabled-button {
        pointer-events: none;
        opacity: 0.6;
    }
</style>

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Quản lý nhân viên</h5>
                        </div>
                        <a href=" <?php echo URL_APP . '/users/create' ?>" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tạo nhân viên</a>
                    </div>
                </div>
                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            <?php echo $_SESSION['success']; ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    <?php
                    unset($_SESSION['success']);
                    ?>
                <?php endif; ?>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-4">
                        <table class="table align-items-center mb-0 stripe hover" id="usersTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Họ và tên
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Hình ảnh
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Địa chỉ
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        SĐT
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Giới tính
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phân quyền
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ngày tạo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const URL_GLOBAL = "http://localhost/phone-ecommerce-chat/admin/users";
    const URL_APP = "http://localhost/phone-ecommerce-chat/admin";
    const IMAGES_PATH = "http://localhost/phone-ecommerce-chat/storages/public";

    const initial = () => {
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: `${URL_GLOBAL}/all`,
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#usersTable').DataTable({
                        data: res.data,
                        columns: [{
                                data: "ID",
                                render: function(data, type, row, meta) {
                                    return meta.row + 1;
                                }
                            },
                            {
                                data: "fullname",
                                render: function(data, type, row) {
                                    return '<div><p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 100px;">' + data + '</p></div>';
                                }
                            },
                            {
                                data: "image",
                                render: function(data, type, row) {
                                    return '<td class="d-flex justify-content-center">' +
                                        '<img src="' + IMAGES_PATH + '/' + data + '" alt="user Image" class="img-responsive avatar avatar-md me-3">' + '</td>';
                                }
                            },
                            {
                                data: "email",
                                render: function(data, type, row) {
                                    return '<div><p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 100px;">' + data + '</p></div>';
                                }
                            },
                            {
                                data: "address",
                                render: function(data, type, row) {
                                    return '<div><p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 100px;">' + data + '</p></div>';
                                }
                            },
                            {
                                data: "phone",
                                render: function(data, type, row) {
                                    return '<div><p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 100px;">' + data + '</p></div>';
                                }
                            },
                            {
                                data: "gender",
                                render: function(data, type, row) {
                                    return '<div><p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 100px;">' + (data == true ? 'Nam' : 'Nữ') + '</p></div>';

                                }
                            },

                            {
                                data: "role",
                                render: function(data, type, row) {
                                    return '<div><p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 100px;">' + data + '</p></div>';
                                }
                            },
                            {
                                data: "created_at",
                                render: function(data, type, row) {
                                    return '<td class="text-center">' +
                                        '<span class="text-secondary text-xs font-weight-bold">' + data + '</span>' +
                                        '</td>';
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var editUrl = URL_APP + '/users/edit/' + row.user_id;
                                    var deleteUrl = URL_APP + '/users/destroy/' + row.user_id;
                                    var deleteModalId = 'deleteModal' + row.user_id;

                                    return `<td class="text-center">
                                            <a href="${editUrl}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <span type="button" data-bs-toggle="modal" data-bs-target="#deleteModal${row.user_id}" ${row.role === 'admin' ? 'class="disabled-button"' : ''}>
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </span>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal${row.user_id}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn có chắc chắn muốn xóa nhân viên: ${row.fullname}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở về</button>
                                                            <form method="POST" id="delete_form" action="${URL_APP}/users/destroy/${row.user_id}">
                                                                <button type="submit" class="btn btn-danger">Xóa nhân viên</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>`;

                                }
                            }
                        ],
                        "aaSorting": []
                    });
                },
                error: function(xhr, status, error) {
                    showToast('Có lỗi xảy ra: ' + error, false);
                }
            });

            $('#delete_form').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: form.serialize(),
                    success: function(res) {
                        if (res.status === 204) {
                            $('#usersTable').DataTable().ajax.reload();
                            $('#deleteModal').modal('hide');
                            showToast(res.message, true);
                        } else {
                            showToast(res.message, false);
                        }
                    },
                    error: function(xhr, status, error) {
                        showToast('Có lỗi xảy ra: ' + error, false);
                    }
                });
            });
        });
    }

    initial()
</script>