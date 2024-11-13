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
                            <input type="text" class="form-control" placeholder="Anh(Chị) ABC" name="name_receiver"
                                required>
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
                            <div class="row">
                                <div class="col-lg-4">
                                    <select class="form-control" id="city" name="city" aria-label=".form-select-sm">
                                        <option value="" selected>Chọn tỉnh thành
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-control" id="district" name="district"
                                        aria-label=".form-select-sm">
                                        <option value="" selected>Chọn quận huyện</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-control" id="ward" name="ward" aria-label=".form-select-sm">
                                        <option value="" selected>Chọn phường xã</option>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <textarea id="address_detail" name="address_detail" class="w-100 mt-3" rows="3"
                                    class="form-control" placeholder="Số nhà tên đuờng"></textarea>
                            </div>
                            <!-- Address input start -->
                            <input type="text" hidden class="form-control" placeholder="Tên đường, phường, xã"
                                name="address_receiver" required>
                            <!-- Address input start -->
                        </div>
                        <div>
                            <span>Mô tả <span>(Không bắt buộc)</span></span>
                            <textarea class="w-100" rows="3" name="notes" class="form-control"
                                placeholder=" Nội dung mô tả"></textarea>
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
                    <div class="">
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Mã giảm giá:</span>
                                    <span class="top__text__right" id="promotion">Không có</span>
                                </li>
                            </ul>
                        </div>
                        <div class="row mt-2">
                            <input id="promotion_add" type="text" class="form-control col-lg-10" placeholder="Mã giảm giá" name="promotion_add">
                            <button class="btn btn-primary col-lg-2" id="promotion_submit">
                                <i class="fa fa-check"></i>
                            </button>
                        </div>
                    </div>
                    <div class="checkout__order__total">
                        <ul>
                            <!-- <li>Tổng phụ <span id="subtotalPrice"></span></li> -->
                            <li>Tổng tiền <span id="totalPrice"></span></li>
                            <!-- hidden total price -->
                            <input type="hidden" name="totalPrice" value="{{$totalPrice}}">
                            <input type="hidden" name="promotion_id" id="promotion_id">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

<!-- Bắt đầu địa chỉ -->
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    // API https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json
    // Author: https://github.com/kenzouno1/DiaGioiHanhChinhVN
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Id);
        }
        citis.onchange = function () {
            district.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Id === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Id);
                }
            }
        };
        district.onchange = function () {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Id);
                }
            }
        };
    }
</script>
<!-- Kết thúc địa chỉ -->

<script>
    const IMAGES_PATH = "http://localhost/phone-ecommerce-chat/storages/public"

   
    $(document).ready(function () {
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
                            ${index + 1}
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

        $("#promotion_submit").click(function(e){
            const promotion_code = $('#promotion_add').val();

            if(!promotion_code){
                return showToast('Vui lòng nhập mã giảm giá', false);
            }

            $.ajax({
                url: `http://localhost/phone-ecommerce-chat/customer/checkout/getPromotionByCode`,
                type: 'POST',
                data: {
                    promotion_code
                },
                success: function (res) {
                    if(!res.data){
                        return showToast('Mã giảm giá không đúng hoặc đã được sử dụng', true);
                    }

                    $('#promotion').text(`Giảm ${res.data.value}% - Mã: ${res.data.promotion_code}`)
                    $('#promotion_add').val('')
                    $('#promotion_id').val(res.data.promotion_id)

                    // Handle add promotion with total price
                    totalPriceCheckout = totalPriceCheckout - (totalPriceCheckout*parseInt(res.data.value))/100;
                    let total_price_promotion = Number(totalPriceCheckout).toLocaleString('vi-VN') + ' VND';
                    $('#totalPrice').text(total_price_promotion)

                    

                    if (res.status === 200) {
                        showToast('Áp mã giảm giá thành công', true);
                    }
                },
                error: function (xhr, error) {
                    showToast('Error: ' + 'error', false);
                }
            });

        })


        $('#submitButton').click(function (e) {
            e.preventDefault();
            $('.error-message').remove();
            var name = $('input[name="name_receiver"]').val().trim();
            var phone = $('input[name="phone_receiver"]').val().trim();
            var city = $('#city option:selected').text();
            var district = $('#district option:selected').text();
            var ward = $('#ward option:selected').text();
            var address_detail = $('textarea[name="address_detail"]').val().trim()
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

            // city/district/ward/address_detail
            // 1. city
            if (city === '') {
                $('<span class="error-message text-danger">Vui lòng chọn thành phố</span>').insertAfter('input[name="address_receiver"]');
                error = true;
            } else if (district === '') {
                $('<span class="error-message text-danger">Vui chọn quận/huyện</span>').insertAfter('input[name="address_receiver"]');
                error = true;
            } else if (ward === '') {
                $('<span class="error-message text-danger">Vui lòng chọn phuờng xã</span>').insertAfter('input[name="address_receiver"]');
                error = true;
            } else if (address_detail === '') {
                $('<span class="error-message text-danger">Vui lòng nhập số nhà hoặc tên đuờng</span>').insertAfter('input[name="address_receiver"]');
                error = true;
            }

            if (!error) {
                let address = `${address_detail}, ${ward}, ${district}, ${city}`;
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

            const orderData = {
                name_receiver: name,
                phone_receiver: phone,
                address_receiver: address,
                notes: notes,
                total_price: totalPriceCheckout,
                listProductDetail: filteredData
            }

            if($('#promotion_id').val()){
                orderData.promotion_id = $('#promotion_id').val();
            }

            $.ajax({
                url: `http://localhost/phone-ecommerce-chat/customer/checkout/store`,
                type: 'POST',
                data: orderData,
                success: function (res) {
                    if (res.status === 200) {
                        showToast(res.message, true);
                        localStorage.removeItem("cartDetails")
                        window.location.href = "http://localhost/phone-ecommerce-chat/customer/checkout/success";
                    }
                },
                error: function (xhr, error) {
                    showToast('Error: ' + 'error', false);
                }
            });
        }
    });
</script>