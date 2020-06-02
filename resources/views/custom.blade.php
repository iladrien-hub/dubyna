@extends("main")

@section("pagename")Каталог @endsection

@section("content")
<section class="sub-page">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="mybreadcrumb">
                    <a href="{{ route('home') }}">Головна /</a>
                    <a href="{{ route('custom_request_form') }}">Створити дизайн</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class="section__title">
                    Створити дизайн
                </h2>
            </div>
        </div>
        <div class="form-block">
            <div class="row justify-content-center">
                <div class="justify-content-center">
                    <form method="post" action="{{ route('custom_request_commit') }}" id="form"  enctype="multipart/form-data">
                        @csrf
                        <h3 class="form__title">Оберіть деревину</h3>
                        <input checked type="radio" name="wood" value="birch" price="{{ $services['birch']->price }}"> {{ $services['birch']->name }}<Br>
                        <input type="radio" name="wood" value="ash" price="{{ $services['ash']->price }}"> {{ $services['ash']->name }}<Br>
                        <input type="radio" name="wood" value="apple" price="{{ $services['apple']->price }}"> {{ $services['apple']->name }}<Br>
                        <input type="radio" name="wood" value="other_wood" price="{{ $services['other_wood']->price }}"> {{ $services['other_wood']->name }}<Br>

                        <h3 class="form__title">Оберіть спосіб обробки</h3>
                        <input checked type="radio" name="handling" value="oil" price="{{ $services['oil']->price }}"> {{ $services['oil']->name }}<Br>
                        <input type="radio" name="handling" value="varnish" price="{{ $services['varnish']->price }}"> {{ $services['varnish']->name }}<Br>
                        <input type="radio" name="handling" value="other_handling" price="{{ $services['other_handling']->price }}">  {{ $services['other_handling']->name }}<Br>
                        <input type="radio" name="handling" value="no" price="{{ $services['no']->price }}"> {{ $services['no']->name }}<Br>

                        <h3 class="form__title">Які ще матеріали мають бути використані</h3>
                        <input checked type="radio" name="material" value="resin" price="{{ $services['resin']->price }}"> {{ $services['resin']->name }}<Br>
                        <input type="radio" name="material" value="metal" price="{{ $services['metal']->price }}"> {{ $services['metal']->name }}<Br>
                        <input type="radio" name="material" value="wood_material" price="{{ $services['wood_material']->price }}"> {{ $services['wood_material']->name }}<Br>
                        <input type="radio" name="material" value="other_material" price="{{ $services['other_material']->price }}">  {{ $services['other_material']->name }}<Br>
                        <input type="radio" name="material" value="no" price="{{ $services['no']->price }}">  {{ $services['no']->name }}<Br>

                        <div class="text-file">
                            <textarea class="input-wishes" name="comment" placeholder="Вкажіть особливі побажання" cols="40" rows="1"></textarea>
                            <div class="form-group">
                                <label class="label">
                                    <img src="img/school-paper-clip.svg" alt="file-icon">
                                    <input type="file" multiple name="file[]" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </form>

                    <button type="submit" form="form" style="padding: 0; background-color: transparent; border: none; width: 100%; margin-top: 30px;">
                        <div class="product__button" style="margin: 0">
                            <div class="button__price">
                                Приблизна ціна: <span class="total"></span> грн
                            </div>
                            <img src="img/cart.png" alt="Cart">
                        </div>
                    </button>

                </div>



            </div>

        </div>

    </div>
<br/>
<br/>
</section>
<script>
    function calculate() {
        var total = 0;
        $(".form-block").find("input:radio:checked").each(function() {
            total += parseInt($(this).attr('price'));
        });
        $(".total").html(total);
    }
    calculate();
    $("input:radio").click(function(){
        calculate();
    });
</script>
@endsection
