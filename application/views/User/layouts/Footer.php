<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Grid Design</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Footer Layout */
        footer {
            background-color: #222;
            color: #fff;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 Equal Columns */
            gap: 20px;
            position: relative;
        }

        /* Hover Grid Lines */
        .footer-grid::before,
        .footer-grid::after {
            content: '';
            position: absolute;
            left: 0;
            width: 100%;
            height: 2px;
            background: transparent;
            transition: background 0.4s ease;
        }

        .footer-grid::before {
            top: 0;
        }

        .footer-grid::after {
            bottom: 0;
        }

        /* Hover Effect */
        footer:hover .footer-grid::before,
        footer:hover .footer-grid::after {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
        }

        /* Footer Links */
        .footer-item h5 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #fff;
        }

        .footer-item p,
        .footer-item a {
            color: #bbb;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-item a:hover {
            color: #feb47b;
        }

        /* Social Icons */
        .social-icons a {
            color: #bbb;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .social-icons a:hover {
            color: #ff7e5f;
            transform: translateY(-5px);
        }

        /* Copyright */
        .footer-bottom {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #bbb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr; /* Stack columns vertically */
                text-align: center;
            }

            .social-icons {
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <!-- Column 1: Company Info -->
                <div class="footer-item">
                    <h5>Your Company</h5>
                    <p>Delivering quality products worldwide with passion and care.</p>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="footer-item">
                    <h5>Quick Links</h5>
                    <p><a href="#">Home</a></p>
                    <p><a href="#">Products</a></p>
                    <p><a href="#">About Us</a></p>
                    <p><a href="#">Contact</a></p>
                </div>

                <!-- Column 3: Contact Info -->
                <div class="footer-item">
                    <h5>Contact Us</h5>
                    <p><i class="fas fa-map-marker-alt"></i> Coimbatore, Tamil Nadu</p>
                    <p><i class="fas fa-envelope"></i> info@yourcompany.com</p>
                    <p><i class="fas fa-phone"></i> +91 98765 43210</p>
                </div>
            </div>

            <!-- Social Media Icons -->
            <div class="social-icons d-flex justify-content-center mt-4">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>

            <!-- Copyright -->
            <div class="footer-bottom">
                &copy; 2024 Your Company. All Rights Reserved.
            </div>
        </div>
    </footer>

</body>
</html>
