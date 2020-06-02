@extends("main")

@section("pagename")Каталог @endsection

@section("content")
<section class="sub-page">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="mybreadcrumb">
                    <a href="{{ route('home') }}">Головна /</a>
                    <a href="{{ route('catalog') }}">Каталог</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class="section__title">
                    Каталог
                </h2>
            </div>
        </div>
        <div class="row">

        	@foreach($catalog as $item)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="product">
                    <img src="{{ asset('img/products/'.$item->code.'.jpg') }}" class="img-fluid" alt="{{ $item->name }}">
                    <div class="product__img"></div>
                    <div class="product__text-below">
                        <div class="product__title">
                            @if($item->discounted)
                        		<span style="color: red">Акція! </span>
                        	@endif
                        	{{ $item->name }}
                        </div>
                        <div onclick="addProductToCart('{{$item->code}}');" class="product__button add_to_cart_button <?php if (in_array($item->code, $_SESSION['cart'])) echo 'add_to_cart_button_disabled' ?>">
                            <div class="button__price">
                                {{ $item->price }} грн
                            </div>
                            <img src="img/cart.png" alt="Cart">
                        </div>
                    </div>

                </div>
            </div>
            @endforeach


        </div>

    </div>
<br/>
<br/>
<br/>
</section>
@endsection
