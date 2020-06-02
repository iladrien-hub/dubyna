<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dubyna - @yield('pagename')</title>
    <link href="https://fonts.googleapis.com/css2?family=Scada:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

    <script src="https://kit.fontawesome.com/8ecc921254.js" crossorigin="anonymous"></script>
</head>
<body style="display:flex; flex-direction: column; min-height: 100vh;">


<header>
    
    <div class="container">
        
        <div class="header_inner">
            
            <a href="{{route('home')}}"><div class="logo"><img src="{{asset('img/logo.png')}}" alt="Logo"></div></a>

            <div class="navbar_wrapper">
                <div class="navbar">
                    
                    <ul>
                        <li><a href="{{ route('home') }}#about">Про нас</a></li>
                        <li><a href="{{ route('catalog') }}">Каталог</a></li>
                        <li><a href="{{ route('gallery') }}">Галерея</a></li>
                        <li><a href="{{ route('sale') }}">Акції</a></li>
                        <li><a href="{{ route('custom_request_form') }}">Створити дизайн</a></li>
                        <li><a href="{{ route('home') }}#reviews">Відгуки</a></li>
                        <li><a href="{{ route('home') }}#contact">Контакти</a></li>
                        <li class="cart_text_ref"><a href="{{ route('cart') }}">Кошик</a></li>
                    </ul>
                    <div class="gamburger_wrapper">
                        <div class="gamburger">
                            <i class="fas fa-bars"></i>
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="header__cart">
                        <a href="{{ route('cart') }}">
                            <img src="{{ asset('img/basket.png') }}" alt="Basket">
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>


</header>

<script>
    $('.gamburger_wrapper').click(function(event) {
        $(this).parent('.navbar').toggleClass('navbar_active');
    });
</script>


<section class="cart_animation_wrapper">
</section>

<div style="flex-grow: 1; position: relative;">
@yield('content')
</div>

<script>
    function addProductToCart(code) {
        target = event.currentTarget
        $.ajax({
            url: '{{ route("cart_add_product") }}',
            type: 'POST',
            dataType: 'json',
            data: { "_token" : '<?php echo csrf_token() ?>', code : code},
        })
        .done(function(data) {
            if (data.msg) {
                src = '{{ asset("img/products") }}/' + code + ".jpg";
                $(".cart_animation_wrapper").append('<div class="cart_animation"><img src="' + src + '" alt=""></div>');
                $(".cart_animation_wrapper").find('.cart_animation').last().animate({top : "20px", right : "55px", top : "20px", opacity : 0, width : "20px", height : "20px"}, 1500, function(){ $(this).remove() });
                target.classList.add('add_to_cart_button_disabled');
            }
        })
    }
</script>

<footer class="footer" id="contact" style="flex-grow: 0;">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-5 col">
                <div class="socials">


                    <img src="{{ asset('img/viber.svg') }}" alt="Social icon">
                    <img src="{{ asset('img/google.svg') }}" alt="Social icon">
                    <img src="{{ asset('img/instagram.svg') }}" alt="Social icon">
                    <img src="{{ asset('img/telegram.svg') }}" alt="Social icon">
                </div>
            </div>
        </div>
    </div>
</footer>
<script src = "{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src = "{{ asset('js/bootstrap.min.js') }}"></script>
<script src = "{{ asset('js/main.js') }}"></script>
</body>
</html>