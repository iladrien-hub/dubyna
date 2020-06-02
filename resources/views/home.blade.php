@extends("main")

@section("pagename")Вітаємо! @endsection

@section("content")
<section class="main d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="main__heading">
                    <h1 class="main__title">
                        Dubyna
                    </h1>
                    <h3 class="main__title-sub">
                        handmade
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about" id="about">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="section__title">
                    Про нас
                </h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 ">
                <div class="about__text">
                    DUBYNA - це проект творчих та небайдужих людей, які мріють втілювати ваші креативні ідеї в життя. Ми створюємо унікальні вироби з дерева та враховуємо всі ваші побажання, такі як вид деревини, спосіб її обробки та дизайн виробу. Наша компанія має сертифікацію FSC, а також впровадила повністю безвідходне виробництво. Наші майстри мають багаторічний досвід роботи у сфері обробки деревини, різьби та випалюванні по дереву. Тому ви можете бути впевнені в походженні та екологічності деревини, та в якості готового виробу.
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <a href="{{route('custom_request_form')}}" class="button create-button">
                    Сворити власний </br>виріб
                </a>
            </div>
        </div>
    </div>
</section>

<section class="products">
    <div class="container">
        <div class="products__tabs">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-6">
                    <ul class="tabs__caption">
                        <li>
                            <h2 class="products__title">
                                Каталог
                            </h2>
                        </li>
                        <li class = "active">
                            <h2 class="products__title ">
                                Галерея
                            </h2>
                        </li>
                        <li>
                            <h2 class="products__title">
                                Акція
                            </h2>
                        </li>
                    </ul>
                </div>
            </div>

            <!--  Каталог       -->

            <div class="tabs__content">
                <div class="row">

                    @foreach($catalog as $item)
                    <div class="col-lg-3">
                        <div class="product">
                            <img src="{{ asset('img/products/'.$item->code.'.jpg') }}" class="img-fluid" alt="Product">
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
                                    <img src="{{ asset('img/cart.png') }}" alt="Cart">
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{ route('catalog') }}" class="products-more d-flex align-items-center justify-content-center">
                            <div>Дивитись ще</div>
                            <img class="arrow" src="img/right-arrow.svg" alt="Arrow">
                        </a>
                    </div>
                </div>
            </div>

            <!--  Галерея          -->

            <div class="tabs__content active">
                <div class="row">
                    @foreach($gallery as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product">
                            <img src="{{ asset('img/products/'.$item->code.'.jpg') }}" class="img-fluid" alt="Product">
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
                <div class="row">
                    <div class="col">
                        <a href="#" class="products-more d-flex align-items-center justify-content-center">
                            <div>Дивитись ще</div>
                            <img class="arrow" src="img/right-arrow.svg" alt="Arrow">
                        </a>
                    </div>
                </div>
            </div>

            <!--   Акции         -->

            <div class="tabs__content">
                <div class="row">


                    @foreach($sale as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product">
                            <img src="{{ asset('img/products/'.$item->code.'.jpg') }}" class="img-fluid" alt="Product">
                            <div class="product__img"></div>
                            <div class="product__text-below">
                                <div class="product__title">
                                    {{ $item->name }}
                                </div>
                                <div onclick="addProductToCart('{{$item->code}}');" class="product__button add_to_cart_button <?php if (in_array($item->code, $_SESSION['cart'])) echo 'add_to_cart_button_disabled' ?>">
                                    <div class="button__price">
                                        {{ $item->price }} грн
                                    </div>
                                    <img src="{{ asset('img/cart.png') }}" alt="Cart">
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{ route('sale') }}" class="products-more d-flex align-items-center justify-content-center">
                            <div>Дивитись ще</div>
                            <img class="arrow" src="img/right-arrow.svg" alt="Arrow">
                        </a>
                    </div>
                </div>
            </div>


        </div>



    </div>
</section>

<section class="comments" id="reviews">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="section__title">
                    Відгуки
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="comment">
                    <img src="{{ asset('img/comment_1.png') }}" alt="Comment">
                    <div class="comment__text">
                        Дуже гарний магазин. Товари дійсно якісні, сертифіковані та супер екологічні. Ціни відповідають якості. Замовляв уже не один раз, усе прийшло вчасно, як і писали мені продавці. Сама ж упаковка екологічна, як і зазначено в продавця. З упевненістю можу рекомендувати усім знайомим та друзям.
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="comment">
                    <img src="{{ asset('img/comment_2.png') }}" alt="Comment">
                    <div class="comment__text">
                        Знайшла ваш магазин геть випадково і жодного разу не пожалкувала. Дуже порадував ваш індивідуальний підхід до клієнта. Консультанти вислухали усі мої побажання щодо виробу. В обумовлений термін мені надіслали ескіз, а ще через деякий час - мій виріб уже пакували та надсилали мені. Зі мною тримали зв'язок протягом усього часу. Результат роботи мене дуже позитивно вразив своєю якість та відповідністю до усіх моїх побажань. Дуже вдячна за вашу працю.
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="comment">
                    <img src="{{ asset('img/comment_3.png') }}" alt="Comment">
                    <div class="comment__text">
                        З-поміж багатьох магазинів зі схожим напрямком ваш - на голову вищий. Моє замовлення від початку і до самої відправки супроводжувалося грамотною підтримкою вашої команди. Ви врахували усі мої вимоги та побажання, відповіли на усі запитання. Сам товар відповідає усім стандартам якості та своїй ціні. Дякую за вашу працю, обов'язково замовлю у вас ще.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection