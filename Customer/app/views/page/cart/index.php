<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="#"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Giỏ hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table id="cartTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá thành</th>
                                <th>Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cartTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="<?php echo URL_APP . '/shop' ?>">Tiếp tục mua sắm</a>
                </div>
            </div> -->
            <div class="col-12">
                <div class="cart__btn update__btn">
                    <button type="button" class="outline-none border-0" style="padding: 14px 30px 12px;"><span class="icon_loading"></span> <span>Cập nhật giỏ hàng</span></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced" id="cart__total__procced">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Cart Section End -->

<script>
    const URL = 'http://localhost/phone-ecommerce-chat/customer/cart';
    const IMAGES_URL = 'http://localhost/phone-ecommerce-chat/storages/public';
    let generalTotalPrice = 0;

    const fetchCart = () => {
        $.ajax({
            url: `${URL}/getAll`,
            method: 'GET',
            dataType: 'json',
            success: function(res) {
                renderCart(res.data);
            },
            error: function(error) {
                console.error('Lỗi khi lấy dữ liệu sản phẩm:', error);
            }
        });
    }

    const renderCart = (data) => {
        let totalPrice = 0
        const cartElement = document.getElementById('cartTableBody');

        if (data === undefined) {
            cartElement.innerHTML = `
                <h4 class="text-dark w-full w-100 text-center font-weight-bold mx-auto my-5">Không có sản phẩm trong giỏ hàng!</h4>
            `;

            return;
        }

        const categoryHTML = data.map((cart, index) => {
            totalPrice += parseInt(cart.price) * parseInt(cart.quantity);

            console.log(Number(cart.cart_quantity));
            if (Number(cart.cart_quantity) === 0) {
                console.log('delete');
                deleteCartItem(cart.cart_detail_id);
            }

            return `
                <tr>
                    <td class="cart__price">
                        <input type="checkbox" class="item_selected" name="selected_items[${index}]" value="${cart.cart_detail_id}" style="transform: scale(1.5);">
                    </td>
                    <td class="cart__price">
                        <span class="text-dark">
                            ${index+1}
                        </span>
                    </td>
                    <td class="cart__product__item">
                        <img src="${IMAGES_URL}/${cart.image}" style="width: 100px;height:100px;" alt="">
                        <div class="cart__product__item__title">
                            <h6>${cart.product_name}</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </td>
                    <td class="cart__quantity">
                        <div class="pro-qty">
                            <span class="dec qtybtn">-</span>
                            <input type="text" value="${cart.cart_quantity}" class="cart-item-quantity" data-cart-detail-id="${cart.cart_detail_id}" data-product-id="${cart.product_id}">
                            <span class="inc qtybtn">+</span>
                        </div>
                    </td>
                    <td class="cart__price">${Number(cart.price).toLocaleString('vi-VN')} VND</td>
                    <td class="cart__total"> ${Number(parseInt(cart.price) * parseInt(cart.cart_quantity)).toLocaleString('vi-VN')} VND</td>
                    <td class="cart__close">
                        <button type="button" onclick="deleteCartItem('${cart.cart_detail_id}')" class="cart__close outline-none rounded-circle border-0">
                            <span class="icon_close"></span>
                        </button>
                    </td>
                </tr>
            `
        }).join('');

        cartElement.innerHTML = categoryHTML;

        renderGeneralCart(data);
    };

    const renderGeneralCart = (data) => {
        let generalTotalPrice = 0;
        data.map((cart, index) => {
            generalTotalPrice += parseInt(cart.price) * parseInt(cart.cart_quantity);
        });
        const cartTotalProcessElement = document.getElementById('cart__total__procced');
        const cartProcessHTMl = `
        <h6>Tổng quan giỏ hàng</h6>
        <ul>
        <li>Tổng tiền <span id="generalTotalPrice">${Number(generalTotalPrice).toLocaleString('vi-VN')} VND</span></li>
        </ul>
        <button type="button" onClick="processCheckout()" class="site-btn w-100">Tiến hành thanh toán</button>
        `

        cartTotalProcessElement.innerHTML = cartProcessHTMl;
    }

    const updateCartItem = () => {
        var cartItems = [];
        $('.cart-item-quantity').each(function() {
            var cartDetailId = $(this).data('cart-detail-id');
            var productId = $(this).data('product-id');
            var quantity = $(this).val();
            cartItems.push({
                cart_detail_id: cartDetailId,
                quantity: quantity,
                product_id: productId
            });
        });

        $.ajax({
            url: `${URL}/update`,
            type: 'POST',
            data: {
                cartDetails: cartItems
            },
            success: function(res) {
                // console.log(
                //     res
                // );

                if (res.status === 200) {
                    showToast(res.message, true);
                    fetchCart();
                }
            },
            error: function(xhr, error) {
                showToast('Lỗi khi cập nhật giỏ hàng', false);
            }
        });
    }

    const deleteCartItem = (cartDetailId) => {
        $.ajax({
            url: `${URL}/destroy/` + cartDetailId,
            type: 'POST',
            data: {
                _method: 'DELETE',
            },
            success: function(res) {
                // console.log(res);
                if (res.status === 204) {
                    showToast(res.message, true);
                    fetchCart();
                }
                // location.reload();
            },
            error: function(xhr, status, error) {
                showToast(error, false);
            }
        });
    }

    const processCheckout = () => {
        const selected_items = getSelectedItems();
        if (selected_items.length === 0) {
            showToast('Vui lòng chọn ít nhất một sản phẩm', false);
            return;
        }

        $.ajax({
            url: `http://localhost/phone-ecommerce-chat/customer/checkout/processCheckout`,
            type: 'POST',
            data: {
                selected_items: selected_items
            },
            success: function(res) {
                if (res.status === 200) {
                    // console.log(res);
                    localStorage.setItem("cartDetails", JSON.stringify(res.data));
                    window.location.href = "http://localhost/phone-ecommerce-chat/customer/checkout"
                }
            },
            error: function(xhr, status, error) {
                showToast(error, false);
            }
        });
    }

    const getSelectedItems = () => {
        const selectedCheckboxes = document.querySelectorAll('input.item_selected:checked');
        const selectedItems = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);
        return selectedItems;
    }

    $(document).ready(function() {
        fetchCart()

        // Actions
        $('.update__btn button').click(function() {
            updateCartItem();
        });

        const updateTotalPrice = () => {
            totalPrice = 0;
            $('.cart-item-quantity').each(function() {
                const cartId = $(this).data('cart-detail-id');
                const quantity = parseInt($(this).val());
                const price =
                    totalPrice += price * quantity;
            });
            $('#generalTotalPrice').text(Number(generalTotalPrice).toLocaleString('vi-VN') + ' VND');
        }

        $('#cartTableBody').on('click', '.pro-qty .qtybtn', function() {
            var $button = $(this);
            var $input = $button.parent().find("input");
            var oldValue = $input.val();
            if ($button.hasClass("inc")) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $input.val(newVal);
        });
    });
</script>