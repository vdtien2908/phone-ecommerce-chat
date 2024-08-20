<style>
    .custom-button-cart {
        font-size: 18px;
        color: #111111;
        display: block;
        height: 45px;
        width: 45px;
        background: #ffffff;
        line-height: 48px;
        text-align: center;
        border-radius: 50%;
        -webkit-transition: all, 0.5s;
        -o-transition: all, 0.5s;
        transition: all, 0.5s;
    }

    .custom-button-cart:hover {
        background: #ca1515;
    }

    .custom-button-cart:hover span {
        color: #ffffff;
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
</style>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="<?php echo URL_APP . '/home' ?>"><i class="fa fa-home"></i> Home</a>
                    <a href=""><?php echo $product['category_name'] ?></a>
                    <span><?php echo $product['product_name'] ?> </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <input type="hidden" value="<?php echo $product['product_id'] ?>" id="hiddenProductId">
    <input type="hidden" value="<?php echo $product['cat_id'] ?>" id="hiddenCatId">
    <div class="container">
        <div id="product_detail"></div>

        <h2 class="text-dark font-weight-bold mb-3">Các sản phẩm cùng loại</h2>
        <div class="row" id="related_products"></div>
    </div>
</section>
<!-- Product Details Section End -->
<script>
    const productId = document.getElementById('hiddenProductId').value;
    const catId = document.getElementById('hiddenCatId').value;

    const URL = 'http://localhost/phone-ecommerce-chat/customer/shop';
    const IMAGES_URL = 'http://localhost/phone-ecommerce-chat/storages/public';

    const fetchProductDetail = () => {
        $.ajax({
            url: `${URL}/showProductDetailData/${productId}`,
            method: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                renderProductDetail(res.data);
            },
            error: function(error) {
                console.error('Lỗi khi lấy dữ liệu sản phẩm:', error);
            }
        });
    }

    const renderProductDetail = (product) => {
        const productDetailHtml = `
            <div class="row">
                <div class="col-lg-6">
                    <a class="pt active" href="#product-1">
                        <img loading="lazy" src="${IMAGES_URL}/${product.image}" alt="">
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                    <h3>${product.product_name} <span>Danh mục: ${product.category_name}</span></h3>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span>( 138 reviews )</span>
                    </div>
                    <div class="product__details__price">${formatPrice(product.price)} VND <span>${formatPrice(Number(product.price + 250000))} VND</span></div>
                    <p>${product.description.substring(0, 250)}...</p>
                    <div class="product__details__button">
                    <div class="quantity">
                        <span>Số lượng:</span>
                        <div class="pro-qty">
                        <span class="dec qtybtn" style="${parseInt(product.quantity) === 0 ? 'pointer-events: none;' : ''}">-</span>
                        <input type="text" value="1" id="addCartQt" name="quantity" ${parseInt(product.quantity) === 0 ? 'disabled' : ''} />
                        <span class="inc qtybtn" style="${parseInt(product.quantity) === 0 ? 'pointer-events: none;' : ''}">+</span>
                        </div>
                    </div>
                    <input type="hidden" class="addCartPId" value="${product.product_id}">
                    <button type="button" class="addCartButton cart-btn outline-none" style="${parseInt(product.quantity) === 0 ? 'pointer-events: none;' : ''}">
                        <span class="icon_bag_alt mr-2"></span>${parseInt(product.quantity) === 0 ? "Đã hết hàng" : "Thêm vào giỏ hàng"}
                    </button>
                    <ul>
                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                        <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                    </ul>
                    </div>
                    <div class="product__details__widget">
                        <ul>
                        <li>
                            <span>Còn lại:</span>
                            ${renderStockStatus(parseInt(product.quantity))}
                        </li>
                        <li>
                            <span>Khuyến mãi:</span>
                            <p>Miễn phí vận chuyển</p>
                        </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Mô tả</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <h6>Mô tả</h6>
                        <p>${product.description}.</p>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                        <h6>Chỉ định</h6>
                        <p>${product.description}.</p>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                        <h6>Đánh giá ( 200 )</h6>
                        <p>${product.description}.</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        `;

        $('#product_detail').html(productDetailHtml);
    }

    const renderStockStatus = (quantity) => {
        console.log(quantity);
        if (quantity === 0) {
            return `<div class="stock__checkbox text-danger">Hết hàng</div>`;
        } else {
            return `
                <div class="stock__checkbox">
                    <label for="stockin">
                    ${quantity}
                    <input type="checkbox" id="stockin" checked>
                    <span class="checkmark"></span>
                    </label>
                </div>
            `;
        }
    }

    const formatPrice = (price) => {
        return `${Number(price).toLocaleString('vi-VN')} VND`;
    }

    const fetchRelatedProducts = () => {
        $.ajax({
            url: `${URL}/getRelatedProducts/${productId}/${catId}`,
            method: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                renderRelatedProducts(res.data);
            },
            error: function(error) {
                console.error('Lỗi khi lấy dữ liệu sản phẩm:', error);
            }
        });
    }

    const renderRelatedProducts = (products) => {
        console.log(products);
        const relatedProductsContainer = document.getElementById("related_products");

        if (products === undefined) {
            relatedProductsContainer.innerHTML = `
            <h4 class="text-center fs-4 mx-auto mt-5 font-weight-bold w-75">
                Không có sản phẩm nào được tìm thấy!
            </h4>
            `;
            return;
        }

        const productHtml = products.map((product, index) => (`
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="${IMAGES_URL}/${product.image}" style="background-image:url('${IMAGES_URL}/${product.image}'); background-size: contain; background-position: center center; background-repeat:no-repeat">
                            ${index % 3 === 0 ? '<div class="label new">New</div>' : ''}
                            <ul class="product__hover">
                                <li><a href="${IMAGES_URL}/${product.image}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li>
                                <a href="${URL}/detail/${product.product_id}"><span class="icon_search"></span></a>
                                </li>
                                <li>
                                <form action="#">
                                    <input type="hidden" value="${product.product_id}" name="product_id">
                                    <input type="hidden" value="1" name="quantity">
                                    <button type="submit" class="border-0 outline-none custom-button-cart"><span class="icon_bag_alt"></span></button>
                                </form>
                                </li>
                            </ul>
                            </div>
                            <div class="product__item__text">
                            <h6><a href="${URL}/detail/${product.product_id}">${product.product_name}</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">
                                <a href="${URL}/detail/${product.product_id}" class="text-dark">
                                ${formatPrice(product.price)} VND
                                </a>
                            </div>
                            </div>
                        </div>
                    </div>
                `));

        relatedProductsContainer.innerHTML = productHtml;
    }

    $(document).ready(function() {
        fetchProductDetail()
        fetchRelatedProducts()

        $(document).on('click', '.addCartButton', function() {
            const quantity = $('#addCartQt').val();
            const product_id = $('#addCartPId').val();

            // Actions
            $.ajax({
                url: `http://localhost/phone-ecommerce-chat/customer/cart/store`,
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: quantity
                },
                success: function(res) {
                    console.log(res);
                    if (res.status === 201) {
                        showToast(res.message, true);
                    } else if (res.status === 200) {
                        showToast(res.message, true);
                    }
                },
                error: function(error) {
                    console.log(error);
                    showToast("Vui lòng đăng nhập trước khi thêm sản phẩm", false);
                    // window.location.href = URL + '/auth/login';
                }
            });
        });

        $('#product_detail').on('click', '.pro-qty .qtybtn', function() {
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