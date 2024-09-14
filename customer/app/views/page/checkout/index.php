<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Thanh toán</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 contact__content">
                <h3 class="font-weight-bold mb-5">Thông tin người mua</h3>
                <div class="row contact__address">
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                        <div>
                            <span>Tên người nhận<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" placeholder="Anh(Chị) ABC" name="name_receiver" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                        <div>
                            <span>Số điện thoại<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" placeholder="" name="phone_receiver" required>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="mb-3">
                            <span>Địa chỉ <span class="text-danger">*</span></span>
                            <input type="text" class="form-control" placeholder="Tên đường, phường, xã" name="address_receiver" required>
                        </div>
                        <div>
                            <span>Mô tả <span>(Không bắt buộc)</span></span>
                            <textarea class="w-100" rows="3" name="notes" class="form-control" placeholder=" Nội dung mô tả"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="checkout__order">
                    <h5>Đơn đặt hàng của bạn</h5>
                    <div class="checkout__order__product">
                        <ul>
                            <li>
                                <span class="top__text">Sản phẩm</span>
                                <span class="top__text__right">Giá thành</span>
                            </li>
                        </ul>
                    </div>
                    <span id="productCheckout"></span>
                    <hr>
                    <div class="checkout__order__total">
                        <ul>
                            <!-- <li>Tổng phụ <span id="subtotalPrice"></span></li> -->
                            <li>Tổng tiền <span id="totalPrice"></span></li>
                            <!-- hidden total price -->
                            <input type="hidden" name="totalPrice" value="{{$totalPrice}}">
                        </ul>
                    </div>
                    <button type="button" id="submitButton" class="site-btn w-100">Đặt hàng</button>
                </div>
            </div>
        </div>

        <h4 class="text-dark font-weight-bold my-5">Chi tiết sản phẩm</h4>
        <div class="row">
            <table class="table table-striped border rounded-lg">
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>Hình ảnh</td>
                        <td>Tên SP</td>
                        <td>Số lượng</td>
                        <td>Tổng tiền</td>
                    </tr>
                </thead>
                <tbody id="productDetailCheckout">
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<script>
    const IMAGES_PATH = "http://localhost/phone-ecommerce-chat/storages/public"

    $(document).ready(function() {
        const cartDetailsString = localStorage.getItem("cartDetails");
        let cartDetails = [];
        let totalPriceCheckout = 0;

        if (cartDetailsString) {
            cartDetails = JSON.parse(cartDetailsString);
            console.log(cartDetails);
        }

        if (cartDetails !== undefined || cartDetails !== null) {
            const productCheckoutContainer = document.getElementById('productCheckout');
            const productDetailContainer = document.getElementById("productDetailCheckout");

            const productElement = cartDetails.map((item, index) => {
                const totalPrice = item.price * item.cartQuantity
                totalPriceCheckout += totalPrice;
                return `
                    <li class="d-flex justify-content-between flex-column flex-md-row" style="gap:10px;">
                        <span class="text-truncate float-start" style="max-width: 230px;"> ${item.product_name}</span>
                        <span class="float-end font-weight-bold">${Number(item.price).toLocaleString('vi-VN')} VND</span>
                    </li>

                    <!-- add product to hidden input -->
                    <input type="hidden" name="productDetail[${index}${item.product_id}]" value="${item.product_id}">
                    <input type="hidden" name="productDetail[${index}${item.cartQuantity}]" value="${item.cartQuantity}">
                    <input type="hidden" name="productDetail[${index}${item.price}]" value="${item.price}">
                    <input type="hidden" name="productDetail[${index}${item.cart_detail_id}]" value="${item.cart_detail_id}">
                `
            })

            const productDetailElement = cartDetails.map((item, index) => {
                return `
                    <tr>
                        <td>
                            ${index+1}
                        </td>
                        <td>
                            <img src="${IMAGES_PATH}/${item.image}" alt="" width="50" height="50">
                        </td>
                        <td>
                            ${item.product_name}
                        </td>
                        <td>
                            ${item.cartQuantity}
                        </td>
                        <td>${Number(item.cartQuantity * item.price).toLocaleString('vi-VN')} VND</td>
                    </tr>
                `;
            });


            productCheckoutContainer.innerHTML = productElement.join(' ');
            productDetailContainer.innerHTML = productDetailElement.join(' ');

            // document.getElementById('subtotalPrice').innerText = Number(totalPriceCheckout).toLocaleString('vi-VN') + ' VND';
            document.getElementById('totalPrice').innerText = Number(totalPriceCheckout).toLocaleString('vi-VN') + ' VND';
        };

        // Actions
        const validatePhoneNumber = (phoneNumber) => {
            var regex = /^\d{10}$/;
            return regex.test(phoneNumber);
        }

        $('#submitButton').click(function(e) {
            e.preventDefault();

            $('.error-message').remove();

            var name = $('input[name="name_receiver"]').val().trim();
            var phone = $('input[name="phone_receiver"]').val().trim();
            var address = $('input[name="address_receiver"]').val().trim();
            var notes = $('textarea[name="notes"]').val().trim();

            var error = false;

            if (name === '') {
                $('<span class="error-message text-danger">Vui lòng nhập tên người nhận</span>').insertAfter('input[name="name_receiver"]');
                error = true;
            }

            if (phone === '') {
                $('<span class="error-message text-danger">Vui lòng nhập số điện thoại</span>').insertAfter('input[name="phone_receiver"]');
                error = true;
            } else if (!validatePhoneNumber(phone)) {
                $('<span class="error-message text-danger">Số điện thoại không hợp lệ</span>').insertAfter('input[name="phone_receiver"]');
                error = true;
            }

            if (address === '') {
                $('<span class="error-message text-danger">Vui lòng nhập địa chỉ</span>').insertAfter('input[name="address_receiver"]');
                error = true;
            }

            if (!error) {
                handleCheckout(name, phone, address, notes);
                console.log('Form submitted successfully');
            }
        });

        const handleCheckout = (name, phone, address, notes) => {

            // Filter data for better request data
            let desiredFields = ['cart_detail_id', 'product_id', 'cartQuantity', 'price'];

            let filteredData = [];

            cartDetails.forEach(item => {
                let filteredItem = {};
                desiredFields.forEach(field => {
                    if (item.hasOwnProperty(field)) {
                        filteredItem[field] = item[field];
                    }
                });
                filteredData.push(filteredItem);
            });

            $.ajax({
                url: `http://localhost/phone-ecommerce-chat/customer/checkout/store`,
                type: 'POST',
                data: {
                    name_receiver: name,
                    phone_receiver: phone,
                    address_receiver: address,
                    notes: notes,
                    total_price: totalPriceCheckout,
                    listProductDetail: filteredData
                },
                success: function(res) {
                    console.log(
                        res
                    );

                    if (res.status === 200) {
                        showToast(res.message, true);
                        localStorage.removeItem("cartDetails")
                        window.location.href = "http://localhost/phone-ecommerce-chat/customer/checkout/success";
                    }
                },
                error: function(xhr, error) {
                    showToast('Error: ' + 'error', false);
                }
            });
        }
    });
</script>