<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .error{
            color: red;
        }
        .profile-image { width: 50px; height: 50px; border-radius: 50%; cursor: pointer; position: relative; }
        .profile-menu { position: absolute; top: 60px; right: 0; background: white; border: 1px solid #ccc; border-radius: 5px; display: none; }
        .profile-menu a { display: block; padding: 5px 10px; text-decoration: none; color: black; }
        .profile-menu a:hover { background: #f0f0f0; }
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

        .navbar .input-group {
        width: 300px;
        }
        .search-input {
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
        }
        .search-btn {
            border-top-right-radius: 50px;
            border-bottom-right-radius: 50px;
        }
    </style>
</head>
<body>
    
<nav class="navbar navbar-dark bg-primary">
    <!-- Brand/logo section -->
    <a class="navbar-brand d-flex align-items-center" href="#" style="margin-left: 10px;">
        <img src="<?php echo base_url('/assets/logo/online_ecart_logo.png'); ?>" width="35" height="35" class="mr-2" alt="Site Logo">
        <span><?php echo env('SITE_NAME'); ?></span>
    </a>
    
    <!-- Improved Search form -->
    <form class="form-inline mx-auto" action="<?php echo site_url('search'); ?>" method="get">
        <div class="input-group">
            <input type="search" name="q" class="form-control search-input" placeholder="Search..." aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-outline-light search-btn" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    
    <!-- Profile section -->
    <div class="profile-wrapper">
        <img src="<?php echo $this->session->userdata('user_image') 
            ? $this->session->userdata('user_image') 
            : base_url('assets/default/user.jpg'); ?>" 
             class="profile-image" id="profileImage" alt="User Image">   
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
        });

        $('#profileImage').mouseenter(function () {
            $('#profileMenu').stop(true, true).fadeIn(200);
        });

        $('#profileMenu').mouseenter(function () {
            $(this).stop(true, true).fadeIn(200);
        });

        $('#profileImage, #profileMenu').mouseleave(function () {
            $('#profileMenu').stop(true, true).fadeOut(200);
        });
    });
</script>