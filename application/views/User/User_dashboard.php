<!-- Product List -->
<div class="container mt-3">
    <div class="row" id="product-list"></div>
</div>

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
                                            <p class="card-text price-text">Price: <span>$${product.product_price}</span></p>
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
                var productName = $(this).data('name');
                var productPrice = $(this).data('price');

                Swal.fire({
                    title: 'Order This Product',
                    html: `
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" value="${productName}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" value="$${productPrice}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" id="orderAddress" placeholder="Enter your address"></textarea>
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