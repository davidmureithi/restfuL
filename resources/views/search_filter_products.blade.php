{!! Form::open(array('url'=>'search/results','method'=>'GET')) !!}

    <label for="">Search Here</label>

    <br>
    Search: <input type="text" name="search" value="{{Input::get('search')}}">

    <br>    <br>
    <label for="">Price</label>

    <br>
    min: <input type="text" name="min_price" value="{{Input::get('min_price')}}">

    <br>
    max: <input type="text" name="max_price" value="{{Input::get('max_price')}}">

    <?php $category = Input::has('category') ? Input::get('category'): [] ?>
    <?php $sub_category = Input::has('sub_category') ? Input::get('sub_category'): [] ?>

    <?php $price_asc = Input::has('price_asc') ? Input::get('price_asc'): [] ?>
    <?php $price_desc = Input::has('price_desc') ? Input::get('price_desc'): [] ?>

    <br><br>
    <input type="checkbox" name="category[]" value="spirits" {{in_array(1, $category ) ? 'checked' :'' }}>
    Spirits

    <input type="checkbox" name="category[]" value="extras" {{in_array(5, $category ) ? 'checked' :'' }}>
    Extras

<br><br>
{{--{{in_array(whiskey, $sub_brands ) ? 'checked' :'' }}--}}
    <input type="checkbox" name="sub_category[]" value="whiskey" >
    Whiskey
{{--{{in_array(vodka, $sub_brands ) ? 'checked' :'' }}--}}
    <input type="checkbox" name="sub_category[]" value="vodka" >
    Vodka
{{--{{in_array(whiskey, $sub_brands ) ? 'checked' :'' }}--}}
    <input type="checkbox" name="sub_category[]" value="soda" >
    Soda
{{--{{in_array(vodka, $sub_brands ) ? 'checked' :'' }}--}}
    <input type="checkbox" name="sub_category[]" value="water" >
    Water

    <br><br>
    <input type="checkbox" name="name_asc" value="whiskey" >
    Name Asc

    <input type="checkbox" name="name_desc" value="vodka" >
    Name Desc

    <input type="checkbox" name="price_asc" value="soda" >
    Price Asc

    <input type="checkbox" name="price_desc" value="water" >
    Price Desc

    <br>
    <button>Go</button>

{{Form::close()}}
<hr>