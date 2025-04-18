<style>
    :root {
        --rose-gold: #bd8c7d;
        --rose-gold-light: #d4b2a7;
        --rose-gold-dark: #a67c6e;
        --grey: #808080;
        --light-grey: #f0f0f0;
    }

    .footer {
        background-color: white;
        padding: 60px 0 30px;
        border-top: 1px solid var(--light-grey);
    }

    .footer h5 {
        color: var(--rose-gold);
        font-weight: 600;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }

    .footer h5:after {
        content: '';
        position: absolute;
        width: 40px;
        height: 2px;
        background-color: var(--rose-gold-light);
        bottom: -8px;
        left: 0;
    }

    .footer p {
        color: var(--grey);
        line-height: 1.8;
    }

    .footer ul li {
        margin-bottom: 10px;
    }

    .footer ul li a {
        color: var(--grey);
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer ul li a:hover {
        color: var(--rose-gold);
        transform: translateX(5px);
    }

    .social-icons {
        margin-top: 15px;
    }

    .social-icons li {
        margin-right: 15px;
    }

    .social-icons a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--light-grey);
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        background-color: var(--rose-gold-light);
        transform: translateY(-3px);
    }

    .social-icons i {
        font-size: 18px;
        color: var(--grey);
        transition: color 0.3s ease;
    }

    .social-icons a:hover i {
        color: white;
    }

    .footer hr {
        border-color: var(--light-grey);
        margin: 30px 0;
    }

    .footer .copyright {
        color: var(--grey);
        font-size: 14px;
    }

    .newsletter-form {
        display: flex;
        margin-top: 15px;
    }

    .newsletter-input {
        flex: 1;
        border: 1px solid var(--light-grey);
        padding: 10px 15px;
        border-radius: 4px 0 0 4px;
        outline: none;
    }

    .newsletter-btn {
        background-color: var(--rose-gold);
        color: white;
        border: none;
        padding: 0 20px;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .newsletter-btn:hover {
        background-color: var(--rose-gold-dark);
    }
</style>

<footer class="mt-5 footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <h5>About Blossom</h5>
                <p>Discover the finest collection of fashion and lifestyle products. We bring you quality, style, and elegance all in one place.</p>
                <div class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Your email">
                    <button class="newsletter-btn">Subscribe</button>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('index') }}" class="text-decoration-none">Home</a></li>
                    <li><a href="{{ route('shop') }}" class="text-decoration-none">Shop</a></li>
                    <li><a href="#" class="text-decoration-none">About Us</a></li>
                    <li><a href="#" class="text-decoration-none">Contact</a></li>
                    <li><a href="#" class="text-decoration-none">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none">My Account</a></li>
                    <li><a href="#" class="text-decoration-none">Order Tracking</a></li>
                    <li><a href="#" class="text-decoration-none">Wishlist</a></li>
                    <li><a href="#" class="text-decoration-none">Returns & Exchanges</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Connect With Us</h5>
                <p>Follow us on social media for updates, promotions, and more.</p>
                <ul class="list-inline social-icons">
                    <li class="list-inline-item "><a href="#"><i class="bi bi-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="bi bi-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="bi bi-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="bi bi-pinterest"></i></a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="copyright">&copy; 2025 Blossom. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <img src="/placeholder.svg?height=30&width=200" alt="Payment Methods" class="img-fluid" style="max-height: 30px;">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</footer>