<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online eCart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .error { color: red; }
        .profile-image { width: 50px; height: 50px; border-radius: 50%; cursor: pointer; position: relative; }
        .profile-menu { position: absolute; top: 60px; right: 0; background: white; border: 1px solid #ccc; border-radius: 5px; display: none; }
        .profile-menu a { display: block; padding: 5px 10px; text-decoration: none; color: black; }
        .profile-menu a:hover { background: #f0f0f0; }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-primary d-flex justify-content-between">
    <a class="navbar-brand" href="#"> Online Ecart </a>
    <div class="profile-wrapper">
    <img src="<?php echo base_url($this->session->userdata('user_image') ?: 'assets/user.png'); ?>" 
     class="profile-image" id="profileImage">
     
        <div class="profile-menu" id="profileMenu">
            <?php if ($this->session->userdata('user_id')): ?>
                <a href="#"><?php echo $this->session->userdata('user_name'); ?></a>
                <a href="<?php echo site_url('user/logout'); ?>">Logout</a>
            <?php else: ?>
                <a href="#" id="showRegister">Sign Up</a>
                <a href="#" id="showLogin">Sign In</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<style>
    .navbar {
    position: relative;
    padding-right: 20px;
}

.profile-wrapper {
    position: absolute;
    top: 10px;
    right: 20px;
    cursor: pointer;
}

.profile-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #fff;
    object-fit: cover;
}

.profile-menu {
    display: none;
    position: absolute;
    top: 50px;
    right: 0;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    z-index: 10;
    width: 150px;
    text-align: center;
}

.profile-menu a {
    display: block;
    padding: 10px;
    color: #333;
    text-decoration: none;
}

.profile-menu a:hover {
    background: #f0f0f0;
}

.cart-page {
    max-width: 1200px;
    margin: 0 auto;
}

.product-card {
    top: 50px;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.card-title {
    font-weight: 600;
    color: #333;
}

.price-text {
    font-weight: bold;
    color: #007bff;
}

.price-text span {
    font-size: 18px;
    color: #ff5722;
}

.quantity-control {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    width: 120px;
    margin: 0 auto;
}

.quantity-control button {
    border: none;
    background: #f1f1f1;
    padding: 6px 10px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quantity-control button:hover {
    background: #007bff;
    color: #fff;
}

.quantity {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    min-width: 30px;
    display: inline-block;
    text-align: center;
}

.product-buttons .btn {
    padding: 8px 12px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 8px;
    color: white;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.product-buttons .edit-product {
    background: #FFC107;
}

.product-buttons .delete-product {
    background: #DC3545;
}

.product-buttons .order-product {
    background: #28A745;
}

.product-buttons .btn:hover {
    filter: brightness(0.9);
}

.cart-summary {
    text-align: right;
    border-top: 1px solid #ddd;
    padding: 20px 0;
}

.cart-summary h4 {
    font-weight: bold;
    font-size: 24px;
    color: #333;
}

.checkout-btn {
    background: #007bff;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    font-weight: bold;
    padding: 12px 24px;
    transition: all 0.3s ease;
}

.checkout-btn:hover {
    background: #0056b3;
    color: #fff;
}


</style>



<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="registerModalLabel">User Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="post" action="<?php echo site_url('user/register'); ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="loginModalLabel">User Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" method="post" action="<?php echo site_url('user/login'); ?>">
                    <div class="mb-3">
                        <label for="login_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="login_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="login_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login_password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Product List -->
<div class="container mt-3">
    <div class="row" id="product-list"></div>
</div>

<script>


   $(document).ready(function () {
       // Show the registration modal when Sign Up is clicked
        $('#showRegister').click(function (e) {
        e.preventDefault();  // Prevent default link behavior
        $('#registerModal').modal('show');  // Show modal
        });

        $('#showLogin').click(function(e){
        e.preventDefault();
        $('#loginModal').modal('show');
        })
        $('#profileImage').hover(function () {
            $('#profileMenu').show();
        }, function () {
            $('#profileMenu').hide();
        });
        $('#profileMenu').hover(function () {
            $(this).show();
        }, function () {
            $(this).hide();
        });

   


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
                    <button class="btn edit-product" data-index="${product.id}" title="Edit">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn delete-product" data-index="${product.id}" title="Delete">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
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
                    title: 'You must go to sign in',
                    icon: 'warning',
                    confirmButtonText: 'Sign In',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
//                        $('#loginModal').modal('show');
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

</body>
</html>