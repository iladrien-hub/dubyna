@extends("main")

@section("pagename")Галерея @endsection

@section("content")
<section class="sub-page">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="mybreadcrumb">
                    <a href="{{ route('home') }}">Головна /</a>
                    <a href="{{ route('gallery') }}">Галерея</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class="section__title">
                    Галерея
                </h2>
            </div>
        </div>

        <div class="row">

        	@foreach($catalog as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="product">
                    <img src="{{ asset('img/products/'.$item->code.'.jpg') }}" class="img-fluid" alt="{{ $item->name }}">
                    <div class="product__img"></div>
                    <div class="product__text-below">
                        <div class="product__title">
                            {{ $item->name }}
                        </div>
                        <div class="product__price">
                            {{ $item->price }} грн
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
