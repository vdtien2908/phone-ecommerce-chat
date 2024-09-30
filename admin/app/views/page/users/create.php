<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Tạo mới nhân viên</h5>
                        </div>
                        <a href="<?php echo URL_APP . '/users'; ?>" class="btn bg-gradient-primary btn-sm mb-0 d-flex align-items-center" type="button"><i class="fas fa-arrow-left"></i>&nbsp; Trở về</a>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form method="POST" action="<?php echo URL_APP . '/users/store'; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fullname" class="form-control-label">Tên nhân viên</label>
                                    <div class="<?php if (isset($_SESSION['fullname'])) echo 'border border-danger rounded-3'; ?>">
                                        <input class="form-control" type="text" placeholder="Tên nhân viên" id="fullname" name="fullname">
                                        <?php if (isset($_SESSION['fullname'])) : ?>
                                            <p class="text-danger text-xs mt-2"><?php echo $_SESSION['fullname']; ?></p>
                                            <?php unset($_SESSION['fullname']); // Remove the message after displaying it 
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input class="form-control" type="email" placeholder="abc@gmail.com" id="email" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Mật khẩu</label>
                                    <input class="form-control" type="password" placeholder="12345" id="password" name="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="form-control-label">Địa chỉ</label>
                                    <input class="form-control" type="input" placeholder="TP.HCM" id="address" name="address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">SĐT</label>
                                    <input class="form-control" type="number" placeholder="097..." name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender" class="form-control-label">Giới tính</label>
                                    <div>
                                        <input type="radio" id="gender_male" name="gender" value="1">
                                        <label for="gender_male">Nam</label><br>
                                        <input type="radio" id="gender_female" name="gender" value="0">
                                        <label for="gender_female">Nữ</label><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role" class="form-control-label">Phân quyền</label>
                                    <div>
                                        <input type="radio" id="role_user" name="role" value="user">
                                        <label for="role_user">Nhân viên</label><br>
                                        <input type="radio" id="role_admin" name="role" value="admin">
                                        <label for="role_admin">Quản trị viên</label><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Tạo nhân viên mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const URL_GLOBAL = "http://localhost/phone-ecommerce-chat/admin/users"

    // Cái này là validate form lúc e demo không cần thiết nhưng nếu e muốn làm thì làm thế này
    // Nhờ con AI nó làm ba cái validate này không quan trọng có cx đưcọ ko có không sao
    // ok anh xem thử em tạo nhâ nvieen xem đc chưa


    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault();

            var isValid = true;
            var email = $('#email').val();
            var password = $('#password').val();


            // Simple email validation
            if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                showToast('Vui lòng nhập đúng định dạng email.', false);
                isValid = false;
            }


            // Check if password is empty
            if (password.length === 0) {
                showToast('Mật khẩu không được để trống.', false);
                isValid = false;
            } else if (password.length < 5) {
                showToast('Mật khẩu phải có ít nhất 5 ký tự.', false);
                isValid = false;
            }

            if (!isValid) {
                return; // Stop the form submission if validation fails
            }

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status === 200) {
                        showToast(res.message, true);
                    } else
                        showToast(res.message, false);

                },
                error: function(xhr, status, error) {
                    showToast('Có lỗi xảy ra: ' + error, false);
                }
            });
        });
    });
</script>