<!-- resources/views/cart.blade.php -->
@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <header class="header">
        <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
            <div class="container">
                <div class="header-left col-lg-2 w-auto pl-0">
                    <a href="" class="logo">
                        <img src="{{ asset('assets/images/amby-logo.png') }}" width="111" height="44" alt="Porto Logo">
                    </a>
                </div><!-- End .header-left -->
                <div class="header-right w-lg-max">
                    <div
                        class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    </div>
                    <a href="{{ route('login') }}" class="header-icon" title="login"><i class="icon-user-2"></i></a>
                    <a href="{{ route('dashboard') }}" class="btn btn-dark">Dashboard</a>
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-middle -->
    </header><!-- End .header -->

    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="active">
                    <a href="cart.html">Shopping Cart</a>
                </li>
                <li>
                    <a href="">Checkout</a>
                </li>
                <li class="disabled">
                    <a href="">Order Complete</a>
                </li>
            </ul>
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col"></th>
                                    <th class="product-col">Product</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Quantity</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="product-row">
                                    <td>
                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{ asset('assets/images/products/product-4.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                        </figure>
                                    </td>
                                    <td class="product-col">
                                        <h5 class="product-title">
                                            <a href="product.html">Men School Bag</a>
                                        </h5>
                                    </td>
                                    <td>₦1000.00</td>
                                    <td>
                                        <div class="number-input">
                                            <button
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                            <input class="quantity" min="1" name="quantity" value="1"
                                                type="number">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                class="plus"></button>
                                        </div><!-- End .product-single-qty -->
                                    </td>
                                    <td class="text-right"><span class="subtotal-price">₦1000.00</span></td>
                                </tr>
                                <tr class="product-row">
                                    <td>
                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{ asset('assets/images/products/product-3.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                        </figure>
                                    </td>
                                    <td class="product-col">
                                        <h5 class="product-title">
                                            <a href="product.html">Men Boom Player</a>
                                        </h5>
                                    </td>
                                    <td>₦3000.20</td>
                                    <td>
                                        <div class="number-input">
                                            <button
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                            <input class="quantity" min="1" name="quantity" value="1"
                                                type="number">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                class="plus"></button>
                                        </div><!-- End .product-single-qty -->
                                    </td>
                                    <td class="text-right"><span class="subtotal-price">₦3000.20</span></td>
                                </tr>
                                <tr class="product-row">
                                    <td>
                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{ asset('assets/images/products/product-6.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                        </figure>
                                    </td>
                                    <td class="product-col">
                                        <h5 class="product-title">
                                            <a href="product.html">Men Black Gentle Belt</a>
                                        </h5>
                                    </td>
                                    <td>₦580.30</td>
                                    <td>
                                        <div class="number-input">
                                            <button
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                            <input class="quantity" min="1" name="quantity" value="1"
                                                type="number">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                class="plus"></button>
                                        </div><!-- End .product-single-qty -->
                                    </td>
                                    <td class="text-right"><span class="subtotal-price">₦580.30</span></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="5" class="clearfix">
                                        <div class="float-left">
                                            <button type="submit" class="btn btn-shop btn-update-cart">
                                                Update Order
                                            </button>
                                        </div><!-- End .float-left -->
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- End .cart-table-container -->
                </div><!-- End .col-lg-8 -->
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h3>YOUR ORDER</h3>
                        <table class="table table-mini-cart">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td>
                                        <h4>Subtotal</h4>
                                    </td>
                                    <td class="price-col">
                                        <span></span>
                                    </td>
                                </tr>
                                <tr class="order-shipping">
                                    <td class="text-left">
                                        <h4>Shipping</h4>
                                    </td>
                                    <td class="price-col">
                                        <span></span>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <b class="total-price"></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <form id="checkout-form" action="{{ route('pay') }}" method="POST">
                            @csrf

                            <input type="hidden" name="total_amount" id="totalAmount" value="">

                            <div class="payment-methods">
                                <h4 class="">Payment methods</h4>
                                <div class="info-box with-icon p-0">
                                    <p>Select any payment method.</p>
                                </div>
                                <div class="payment-options">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentMethod"
                                            id="flutterwave" value="flutterwave" required>
                                        <label class="form-check-label" for="flutterwave">
                                            <img src="{{ asset('assets/images/flutterwave-logo.png') }}" alt="Flutterwave"
                                                style="width: 100px;">
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentMethod"
                                            id="paystack" value="paystack" required>
                                        <label class="form-check-label" for="paystack">
                                            <img src="{{ asset('assets/images/paystack-logo.png') }}" alt="Paystack"
                                                style="width: 100px;">
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-place-order" form="checkout-form"
                                style="background-color: #08C; color: #fff;">
                                Place order
                            </button>

                        </form>
                    </div><!-- End .order-summary -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </main><!-- End .main -->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            function updateOrderSummary() {

                var products = [];
                $('.table-cart tbody tr').each(function() {
                    var product = {
                        name: $(this).find('.product-title a').text(),
                        quantity: parseInt($(this).find('.quantity').val()),
                        price: parseFloat($(this).find('.price-col').text().replace('₦', '')),
                        subtotal: parseFloat($(this).find('.subtotal-price').text().replace('₦', ''))
                    };
                    products.push(product);
                });

                // Step 2: Update the order summary section
                $('.table-mini-cart tbody').empty();
                products.forEach(function(product) {
                    $('.table-mini-cart tbody').append(
                        '<tr>' +
                        '<td class="product-col">' +
                        '<h3 class="product-title">' + product.name + ' × <span class="product-qty">' +
                        product.quantity + '</span></h3>' +
                        '</td>' +
                        '<td class="price-col"><span>₦' + product.subtotal.toFixed(2) + '</span></td>' +
                        '</tr>'
                    );
                });

                var subtotal = 0;
                products.forEach(function(product) {
                    subtotal += product.subtotal;
                });
                var shippingCost = 10;
                var total = subtotal + shippingCost;

                $('.cart-subtotal .price-col span').text('₦' + subtotal.toFixed(2));
                $('.order-shipping .price-col span').text('₦' + shippingCost.toFixed(2));
                $('.order-total .total-price').text('₦' + total.toFixed(2));
                $('#totalAmount').val(total.toFixed(2));
            }

            updateOrderSummary();

            function updateSubtotal(input) {
                var quantity = parseInt(input.val());
                var price = parseFloat(input.closest('tr').find('.product-col').next().text().replace('₦', ''));
                var subtotal = price * quantity;
                input.closest('tr').find('.subtotal-price').text('₦' + subtotal.toFixed(2));
            }

            $('.number-input input').on('input', function() {
                updateSubtotal($(this));
                updateOrderSummary();
            });

            $('.number-input button').on('click', function() {
                updateSubtotal($(this).siblings('input'));
                updateOrderSummary();
            });

            $('.btn-update-cart').on('click', function() {
                var products = [];
                $('.table-cart tbody tr').each(function() {
                    var product = {
                        name: $(this).find('.product-title a').text(),
                        quantity: parseInt($(this).find('.quantity').val()),
                        price: parseFloat($(this).find('.price-col').text().replace('₦', '')),
                        subtotal: parseFloat($(this).find('.subtotal-price').text().replace('₦',
                            ''))
                    };
                    products.push(product);
                });

                $('.table-mini-cart tbody').empty();
                products.forEach(function(product) {
                    $('.table-mini-cart tbody').append(
                        '<tr>' +
                        '<td class="product-col">' +
                        '<h3 class="product-title">' + product.name +
                        ' × <span class="product-qty">' + product.quantity + '</span></h3>' +
                        '</td>' +
                        '<td class="price-col"><span>₦' + product.subtotal.toFixed(2) +
                        '</span></td>' +
                        '</tr>'
                    );
                });

                var subtotal = 0;
                products.forEach(function(product) {
                    subtotal += product.subtotal;
                });
                var shippingCost = 10;
                var total = subtotal + shippingCost;

                $('.cart-subtotal .price-col span').text('₦' + subtotal.toFixed(2));
                $('.order-shipping .price-col span').text('₦' + shippingCost.toFixed(2));
                $('.order-total .total-price').text('₦' + total.toFixed(2));
                $('#totalAmount').val(total.toFixed(2));
            });
        });
    </script>



@endsection
