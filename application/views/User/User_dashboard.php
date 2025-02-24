<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle with Popper -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</head>

</head>
<body>
    
<div class="main-container d-flex">
    
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h2 class="fw-bold mb-4">Categories</h2>
            <ul class="list-group mb-4">
                <li class="list-group-item category-item" data-category="mouse">Mouse</li>
                <li class="list-group-item category-item" data-category="motherboard">MotherBoard</li>
                <li class="list-group-item category-item" data-category="keyboard">Keyboard</li>
                <li class="list-group-item category-item" data-category="monitor">Monitor</li>
                <li class="list-group-item category-item" data-category="Battery">Battery</li>
            </ul>
            <h2 class="fw-bold mb-4">Filters</h2>
<div class="mb-4">
    <label class="form-label">Price Range</label>
    <ul class="list-group price-filter">
        <li class="list-group-item">
            <input type="radio" name="priceFilter" value="500-600" id="price-500-600">
            <label for="price-500-600">500 - 600</label>
        </li>
        <li class="list-group-item">
            <input type="radio" name="priceFilter" value="600-700" id="price-600-700">
            <label for="price-600-700">600 - 700</label>
        </li>
        <li class="list-group-item">
            <input type="radio" name="priceFilter" value="700-800" id="price-700-800">
            <label for="price-700-800">700 - 800</label>
        </li>
        <li class="list-group-item">
            <input type="radio" name="priceFilter" value="800-900" id="price-800-900">
            <label for="price-800-900">800 - 900</label>
        </li>
        <li class="list-group-item">
            <input type="radio" name="priceFilter" value="900-1000" id="price-900-1000">
            <label for="price-900-1000">900 - 1000</label>
        </li>
        <li class="list-group-item">
            <input type="radio" name="priceFilter" value="below-500" id="price-below-500">
            <label for="price-below-500">Below 500</label>
        </li>
    </ul>
    <button id="applyFilter" class="btn btn-primary mt-3">Apply Filter</button>
</div>


            <div class="mb-4">
                <label class="form-label">Rating</label>
                <select class="form-select" id="ratingFilter">
                    <option value="">All Ratings</option>
                    <option value="4">4 Stars & Up</option>
                    <option value="3">3 Stars & Up</option>
                    <option value="2">2 Stars & Up</option>
                    <option value="1">1 Star & Up</option>
                </select>
            </div>
        </div>

        <!-- Product List -->
        <div class="container py-5">
            <!-- Carousel -->
            <div id="advertiserCarousel" class="carousel slide mb-4" data-bs-ride="carousel" style="position: relative;">
                <button class="close-btn" onclick="removeCarousel()">✖</button>

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#advertiserCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#advertiserCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#advertiserCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#advertiserCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="<?php echo base_url('application/views/User/images/offer1.jpg'); ?>" class="d-block w-100" alt="Offer 1">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('application/views/User/images/offer2.jpg'); ?>" class="d-block w-100" alt="Offer 2">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('application/views/User/images/offer3.jpg'); ?>" class="d-block w-100" alt="Offer 3">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('application/views/User/images/offer4.jpg'); ?>" class="d-block w-100" alt="Offer 4">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#advertiserCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#advertiserCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

<div class="d-flex justify-content-center align-items-center gap-3 my-4">
  <button type="button" class="btn btn-primary btn-lg custom-btn">Lenon</button>
  <button type="button" class="btn btn-success btn-lg custom-btn">HCL</button>
  <button type="button" class="btn btn-info btn-lg custom-btn">Zoho</button>
  <button type="button" class="btn btn-warning btn-lg custom-btn">TCS</button>
</div>


<!-- Product List -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="product-list"></div>
        </div>
    </div>

<script>
    function removeCarousel() {
        document.getElementById('advertiserCarousel').remove();
    }
    
    var myCarousel = document.querySelector('#myCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 3000, // 3 seconds
        ride: 'carousel'
        });
</script>

<script>
    $(document).ready(function () {
        function load_products() {
                $.ajax({
                    url: "<?php echo site_url('Admin/get_all_products'); ?>",
                    method: "GET",
                    success: function(response) {
                        var products = JSON.parse(response).data;
                        $("#product-list").empty();
                        if (products.length !== 0) {
                            $.each(products, function(index, product) {
                                let productCard = `
                                <div class="col-md-3 mb-4">
                                    <div class="card product-card shadow-sm">
                                        <img src="<?php echo base_url('/'); ?>${product.product_image}" class="card-img-top" alt="${product.product_name}">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">${product.product_name}</h5>
                                            <p class="card-text price-text">Price: <span>$${product.product_price} (<strike>$${product.product_price}</strike>) Discount(${product.product_discount}%)</span></p>
                                            Quantity
                                            <div class="quantity-control d-flex justify-content-center align-items-center mb-3">
                                                <button class="btn btn-sm btn-outline-secondary decrease-quantity" data-index="${product.id}">-</button>
                                                <span class="quantity mx-2">0</span>
                                                
                                                <button class="btn btn-sm btn-outline-secondary increase-quantity" data-index="${product.id}">+</button>
                                            </div>
                                            <div class="btn-group product-buttons" role="group">
                                                <button class="btn order-product" data-id="${product.id}" data-name="${product.product_name}" data-price="${product.product_price}">
                                                    <i class="fas fa-shopping-cart"></i> Order
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            $("#product-list").append(productCard);
                        });
                    }
                }
            });
        }

        load_products();

        // Order Product Button
        $(document).on('click', '.order-product', function() {
            <?php if (!$this->session->userdata('user_id')): ?>
                Swal.fire({
                    title: 'You must sign in to order product',
                    icon: 'warning',
                    confirmButtonText: 'Sign In',
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                       $('#loginModal').modal('show');
                    }
                });
            <?php else: ?>
                var quantityElement = $(this).closest(".product-buttons").prev(".quantity-control").find(".quantity");
                var quantity = parseInt(quantityElement.text().trim(), 10);

                console.log(quantityElement);
                console.log(quantity);

                if (isNaN(quantity) || quantity === 0) {
                    Swal.fire({
                        icon: "warning",
                        title: "Add Quantity",
                        text: "Please add at least one quantity before ordering!",
                    });
                    return;
                }

                var productName = $(this).data('name');
                var productPrice = $(this).data('price');
                var companyName = $(this).data('company');
                
                Swal.fire({
                    title: 'Order This Product',
                    html: `
    <div class="mb-3 border rounded p-3 bg-light shadow-sm">
    <div class="d-flex align-items-center mb-3">
        <i class="fas fa-box-open me-2 text-primary fs-4"></i>
        <label class="form-label fw-bold mb-0">Product Name</label>
    </div>
    <input type="text" class="form-control border-primary" value="${productName}" readonly>
</div>

<div class="mb-3 border rounded p-3 bg-light shadow-sm">
    <div class="d-flex align-items-center mb-3">
        <i class="fas fa-dollar-sign me-2 text-success fs-4"></i>
        <label class="form-label fw-bold mb-0">Price</label>
    </div>
    <input type="text" class="form-control border-success" value="$${productPrice}" readonly>
</div>

<div class="mb-3 border rounded p-3 bg-light shadow-sm">
    <div class="d-flex align-items-center mb-2">
        <i class="fas fa-map-marker-alt me-2 text-danger fs-4"></i>
        <label class="form-label fw-bold mb-0">Address</label>
    </div>
    <textarea class="form-control border-danger" id="orderAddress" placeholder="Enter your address" rows="3"></textarea>
</div>

                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Submit Order',
                    cancelButtonText: 'Cancel',
                    preConfirm: () => {
                        const address = document.getElementById('orderAddress').value;
                        if (!address) {
                            Swal.showValidationMessage('Address is required');
                        }
                        return { address: address };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Order Placed!', 'Your order has been placed successfully.', 'success');
                    }
                });
            <?php endif; ?>
        });
    });


    // Event delegation to handle dynamic elements
    document.addEventListener('click', function (event) {
        // Increase quantity
        if (event.target.classList.contains('increase-quantity')) {
            let quantityElement = event.target.closest('.quantity-control').querySelector('.quantity');
            let currentQuantity = parseInt(quantityElement.textContent, 10);
            quantityElement.textContent = currentQuantity + 1;
        }

        // Decrease quantity
        if (event.target.classList.contains('decrease-quantity')) {
            let quantityElement = event.target.closest('.quantity-control').querySelector('.quantity');
            let currentQuantity = parseInt(quantityElement.textContent, 10);
            if (currentQuantity > 0) {
                quantityElement.textContent = currentQuantity - 1;
            }
        }
    });
</script>



</body>
</html>
