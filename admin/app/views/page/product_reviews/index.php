<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Quản lý đánh giá sản phẩm</h5>
                        </div>
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
                        <table class="table align-items-center mb-0" id="categoriesTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nội dung đánh giá
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Emai 
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Số sao 
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ngày đánh giá
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
    const URL_GLOBAL = "http://localhost/phone-ecommerce-chat/admin/product_review";

    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: `${URL_GLOBAL}/all`,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res.data);
                $('#categoriesTable').DataTable({
                    data: res.data,
                    columns: [{
                            data: "product_review_id",
                            className: "ps-4"
                        },
                        {
                            data: "content",
                            render: function(data, type, row) {
                                return '<div><p class="text-xs font-weight-bold mb-0">' + data + '</p></div>';
                            }
                        },
                        {
                            data: "email",
                            render: function(data, type, row) {
                                return '<div><p class="text-xs font-weight-bold mb-0">' + data + '</p></div>';
                            }
                        },
                        {
                            data: "rate",
                            render: function(data, type, row) {
                                let stars = '';
                                for (let i = 0; i < data; i++) {
                                    stars += '<i class="fas fa-star text-warning"></i>';
                                }
                                for (let i = data; i < 5; i++) {
                                    stars += '<i class="far fa-star text-warning"></i>';
                                }
                                return '<div>' + stars + ' <span class="text-xs font-weight-bold ml-1">(' + data + ')</span></div>';
                            }
                        },
                        {
                            data: "created_at",
                            className: "text-center",
                            render: function(data, type, row) {
                                return '<span class="text-secondary text-xs font-weight-bold">' + data + '</span>';
                            }
                        },
                        {
                            data: null,
                            className: "text-center",
                            render: function(data, type, row) {
                                var deleteUrl = '<?php echo URL_APP; ?>/product_review/destroy/' + row.product_review_id;
                                var deleteModalId = 'deleteModal' + row.product_review_id;
                                return '<span type="button" data-bs-toggle="modal" data-bs-target="#' + deleteModalId + '">' +
                                    '<i class="cursor-pointer fas fa-trash text-secondary"></i>' +
                                    '</span>' +
                                    '<div class="modal fade" id="' + deleteModalId + '" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">' +
                                    '<div class="modal-dialog">' +
                                    '<div class="modal-content">' +
                                    '<div class="modal-header">' +
                                    '<h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>' +
                                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                    '</div>' +
                                    '<div class="modal-body">' +
                                    'Bạn có chắc chắn muốn xóa đánh giá này?' +
                                    '</div>' +
                                    '<div class="modal-footer">' +
                                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>' +
                                    '<form method="POST" class="delete_form" action="' + deleteUrl + '">' +
                                    '<button type="submit" class="btn btn-danger">Xóa</button>' +
                                    '</form>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
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
                    showToast(res.message, true);
                    $('#categoriesTable').DataTable().ajax.reload();
                    $('#deleteModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    showToast('Có lỗi xảy ra: ' + error, false);
                }
            });
        });
    });

    initial()
</script>