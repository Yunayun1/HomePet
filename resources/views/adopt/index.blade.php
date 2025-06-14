<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Pet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>

    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <p class="mb-0 phone pl-md-2">
                        <a href="tel:+012345678" class="mr-2"><span class="fa fa-phone mr-1"></span> +012345678</a>
                        <a href="mailto:homepet@email.com"><span class="fa fa-paper-plane mr-1"></span> homepet@email.com</a>
                    </p>
                </div>
                <div class="col-md-6 d-flex justify-content-md-end">
                    <div class="social-media">
                        <p class="mb-0 d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center" aria-label="Facebook"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center" aria-label="Twitter"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center" aria-label="Instagram"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html"><span class="flaticon-pawprint-1 mr-2"></span>HomePet</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
                    <li class="nav-item active"><a href="{{ url('/Adopt') }}" class="nav-link">Adopt</a></li>
                    <li class="nav-item"><a href="{{ url('/search') }}" class="nav-link">Search</a></li>
                    <li class="nav-item"><a href="{{ url('/gallery') }}" class="nav-link">Gallery</a></li>
                    <li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center flex-nowrap justify-content-end">
                    <a href="{{ url('/signup') }}" class="btn text-white py-2 px-3" style="background-color: #28A745; border: none; border-radius: 50px 0 0 50px; white-space: nowrap;">Sign Up</a>
                    <a href="{{ url('/login') }}" class="btn py-2 px-3" style="background-color: #D4EFDF; color: #28A745; border: none; border-radius: 0 50px 50px 0; border-left: 1px solid #28A745; white-space: nowrap;">Log In</a>
                    <a href="{{ url('/add-pet') }}" class="btn text-white ml-2 py-2 px-3" style="background-color: #28A745; border: none; border-radius: 50px; white-space: nowrap;"><span style="font-weight: bold;">+</span> Add a Pet</a>
                </div>
            </div>
        </div>
    </nav>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-0 bread">Adopt</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-8"> <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($pets as $pet)
                <a href="{{ route('adopt.show', $pet->id) }}" class="block">
                    <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <img src="{{ asset('images/' . $pet->image) }}" alt="Image of {{ $pet->name }}" class="w-full h-48 object-cover object-center rounded-t-lg"
                             onerror="this.onerror=null;this.src='https://placehold.co/400x300/a78bfa/ffffff?text=No+Image';">

                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-1">{{ $pet->name }}</h2>

                            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                View Details
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if($pets->isEmpty())
            <div class="text-center text-gray-500 mt-12 text-xl">
                No pets available for adoption right now. Check back soon!
            </div>
        @endif
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <h2 class="footer-heading">Petsitting</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    <ul class="ftco-footer-social p-0">
                        <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter" aria-label="Twitter"><span class="fa fa-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook" aria-label="Facebook"><span class="fa fa-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram" aria-label="Instagram"><span class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <h2 class="footer-heading">Latest News</h2>
                    <div class="block-21 mb-4 d-flex">
                        <a class="img mr-4 rounded" style="background-image: url(images/image_1.jpg);"></a>
                        <div class="text">
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> April 7, 2020</a></div>
                                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="block-21 mb-4 d-flex">
                        <a class="img mr-4 rounded" style="background-image: url(images/image_2.jpg);"></a>
                        <div class="text">
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> April 7, 2020</a></div>
                                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 pl-lg-5 mb-4 mb-md-0">
                    <h2 class="footer-heading">Quick Links</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" class="py-2 d-block">Home</a></li>
                        <li><a href="#" class="py-2 d-block">About</a></li>
                        <li><a href="#" class="py-2 d-block">Services</a></li>
                        <li><a href="#" class="py-2 d-block">Works</a></li>
                        <li><a href="#" class="py-2 d-block">Blog</a></li>
                        <li><a href="#" class="py-2 d-block">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <h2 class="footer-heading">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon fa fa-map"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                            <li><a href="tel:+23923929210"><span class="icon fa fa-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                            <li><a href="mailto:info@yourdomain.com"><span class="icon fa fa-paper-plane"></span><span class="text">info@yourdomain.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p class="copyright">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
        </svg>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('js/google-map.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>