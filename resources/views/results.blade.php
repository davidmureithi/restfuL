

@foreach($products as $product)

    <ul>
        <li>{{$product->name}} || {{$product->price}} || category = {{$product->category}}  ||  Sub category = {{$product->sub_category}}</li>
    </ul>

@endforeach



{{--public function comments()--}}
{{--{--}}
{{--return $this->hasMany('Comment');--}}
{{--}--}}

{{--public function getCommentsAttribute()--}}
{{--{--}}
{{--$comments = $this->comments()->getQuery()->orderBy('created_at', 'desc')->get();--}}
{{--return $comments;--}}
{{--}--}}

{{--$product = Product::query()->where('categolry', 1)->orderBy('price', 'desc');--}}
