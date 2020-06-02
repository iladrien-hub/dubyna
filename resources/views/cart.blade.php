@extends("main")

@section("pagename")Кошик @endsection

@section("content")
<section class="sub-page cart">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="mybreadcrumb">
                    <a href="{{ route('home') }}">Головна /</a>
                    <a href="{{ route('cart') }}">Кошик</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class="section__title">
                    Кошик
                </h2>
            </div>
        </div>
        <form action="{{ route('cart_commit') }}" method="post" id="form">
            @csrf
            @foreach($catalog as $item)
            <div class="good-block {{ $item->code }}_form_item" price="{{ $item->price }}" style="margin-bottom: 20px;">
                <div class="row align-items-center row-relative">
                    <div class="col-sm-1 col-0 offset-sm-0 order-1 order-sm-0 cart_remove" code="{{ $item->code }}" style="cursor: pointer;">
                        <img src="{{ asset('img/cancel-button.svg') }}" alt="Cancel">
                    </div>
                    <div class="col-sm-3 col-6 mr-auto ml-auto order-0 order-sm-1 ">
                        <img src="{{ asset('img/products/'.$item->code.'.jpg') }}" class="img-fluid" alt="{{ $item->name }}">
                    </div>
                    <div class="col-sm-3 col-12 order-2 good__value">
                        <div class="good__text-mob">Товар</div>
                        <div class="good__name">{{ $item->name }}</div>
                    </div>
                    <div class="col-sm-2 col-12 order-3 good__value">
                        <div class="good__text-mob">Ціна</div>
                        <div class="good__price ">{{ $item->price }} грн</div>
                    </div>
                    <div class="col-sm-1 col-12 order-4 good__value" style="display: flex;">
                        <div class="good__text-mob" style="flex-grow: 1; width: 100%;">К-сть</div>
                        <input type="number" value="1" required min="1" class="good__amount" oninput="correctSumm('{{ $item->code }}')" style="margin-bottom: -5px;" name="{{$item->code}}_count">
                    </div>
                    <div class="ml-auto col-sm-2 col-12 order-5 good__value">
                        <div class="good__text-mob">Всього</div>
                        <div class="good__price-whole">
                            <span>{{ $item->price }}</span> грн
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach($special as $key => $i)
                <div class="good-block" price="0" style="margin-bottom: 20px;">
                <div class="row align-items-center row-relative">
                    <div class="col-sm-1 col-0 offset-sm-0 order-1 order-sm-0 special_cart_remove" key="{{$key}}" style="cursor: pointer;">
                        <img src="{{ asset('img/cancel-button.svg') }}" alt="Cancel">
                    </div>
                    @if(isset($i->files[0]))
                        <div class="col-sm-3 col-6 mr-auto ml-auto order-0 order-sm-1 ">
                            <img src="{{ asset('storage/'.$i->files[0]) }}" class="img-fluid" alt="{{ $i->files[0] }}">
                        </div>
                    @else 
                        <div class="col-sm-3 col-6 mr-auto ml-auto order-0 order-sm-1 ">
                            Без зображення
                        </div>
                    @endif

                    <div class="col-sm-3 col-12 order-2 good__value">
                        <div class="good__text-mob">Товар</div>
                        <div class="good__name">Власний дизайн</div>
                    </div>
                    <div class="col-sm-2 col-12 order-3 good__value">
                        <div class="good__text-mob">Опис</div>
                        <div class="good__price ">{{ $i->descr }}</div>
                    </div>
                    <div class="col-sm-1 col-12 order-4 good__value" style="display: flex;">
                    </div> 
                    <div class="ml-auto col-sm-2 col-12 order-5 good__value">
                        <div class="good__text-mob">Всього</div>
                        <div class="good__price-whole">
                            <span>{{ $i->price }}</span> грн
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="cart__data">
                <div class="row">
                    <div class="col-md-5 col-sm-6 offset-md-1">
                        <h3 class="cart__title">
                            Персональні дані
                        </h3>
                        <input type="text" required name="pib" placeholder="ПІБ*" ><Br>
                        <input type="text" required name="email" placeholder="E-mail*" ><Br>
                        <input type="text" required name="phone" placeholder="Номер телефону*" ><Br>
                        <input type="text" required name="adress" placeholder="Адреса доставки/пошти відділення*" ><Br>
                        <input type="text" name="comment" placeholder="Коментар замовлення" ><Br>
                        <p>Поля з <span style="color: red">*</span> обов'язкові для заповнення</p>
                    </div>
                    <div class="col-md-5 col-sm-6 offset-md-1 offset-lg-1">
                        <h3 class="cart__title">
                            Сума замовлення
                        </h3>
                        <div class="coupon">
                            <input oninput="checkCoupon()" type="text" name="name" placeholder="Код купону" ><Br>
                            <i class="fas fa-spinner d-none"></i>
                            <i class="fas fa-check d-none"></i>
                            <i class="fas fa-times d-none"></i>                            
                        </div>
                        <div class="cart__summary d-flex justify-content-between">
                            <div>Загальна сума</div>
                            <div id="total-sum"><span>2000</span> грн</div>
                        </div>
                        <button type="submit" form="form" style="padding: 0; background-color: transparent; border: none; width: 100%; margin-top: 30px;">
                            <div class="product__button" style="margin: 0; font-size: 20px;">
                                Замовити!
                            </div>
                        </button>

                    </div>
                </div>

            </div>
        </form>
    </div>
<br/>
<br/>
<br/>
</section>

<script>
    function summ() {
        total = 0;
        $(".good-block").each(function() {
            total += parseInt($(this).find('.good__price-whole').find('span').html());
        });
        $("#total-sum").find("span").html(total);
    }
    summ();

    $(".cart_remove").click(function() {
        console.log("asd");
    	el = $(this);
        $.ajax({
            url: '{{ route("cart_remove_product") }}',
            type: 'POST',
            dataType: 'json',
            data: { "_token" : '<?php echo csrf_token() ?>', code : el.attr('code')},
        })
        .done(function(data) {
        	if (data.msg)
        		el.parent().parent().animate({
                    opacity: 0 },
                    1000, function() {
                    $(this).remove();
                    summ();
                });;
        })
    });

    $(".special_cart_remove").click(function() {
        el = $(this);
        $.ajax({
            url: '{{ route("special_cart_remove_product") }}',
            type: 'POST',
            dataType: 'json',
            data: { "_token" : '<?php echo csrf_token() ?>', key : el.attr('key')},
        })
        .done(function(data) {
            if (data.msg)
                el.parent().parent().animate({
                    opacity: 0 },
                    1000, function() {
                    $(this).remove();
                    summ();
                });;
        })
    });

    function checkCoupon() {
        spinner = $('.fa-spinner').removeClass('d-none');
        check = $('.fa-check').addClass('d-none');
        times = $('.fa-times').addClass('d-none');
        $.ajax({
            url: '{{ route("validate_coupon") }}',
            type: 'POST',
            dataType: 'json',
            data: { "_token" : '<?php echo csrf_token() ?>', code : $(".coupon").find("input").val() },
        })
        .done(function(data) {
            spinner = $('.fa-spinner').addClass('d-none');
            if (data.msg) {
                check = $('.fa-check').removeClass('d-none');
                times = $('.fa-times').addClass('d-none');
            } else {
                check = $('.fa-check').addClass('d-none');
                times = $('.fa-times').removeClass('d-none');
            }
        })
    }

    function correctSumm(code){
        par = $("."+code+"_form_item");
        price = parseInt(par.attr('price'));
        input = par.find('.good__amount');
        if (parseInt(input.val()) < 1)
            input.val(1);
        par.find('.good__price-whole').find('span').html(parseInt(input.val())*price);
        summ()
    }
</script>

@endsection