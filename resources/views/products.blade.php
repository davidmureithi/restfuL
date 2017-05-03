@extends('layouts.app')
@section('content')
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Add  a<strong>Product</strong></h2>
                </div>
            </div>

            <div class="alert-success">
                @if(session()->has('success'))
                    <h2>{!! Session::get('success') !!}</h2>
                @endif
            </div>
            <div id="success">
                @include('flash::message')
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Product Details</h2>
                        <div class="status alert alert-success" style="display: none"></div>

                        {!! Form::open(array('url'=>'store','method'=>'POST', 'files'=>true)) !!}
                        <div class="col-lg-12">
                            <div class="form-group col-md-4">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <img class="img-responsive profile-img margin-bottom-20"  alt="" name="avatar" id="avatarID">
                                <input type="file" class="btn btn-sm btn-info" value="Edit Image" name="image" id="image">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-4">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                            </div>

                            <div class="form-group col-md-2">
                                {{Form::select('category',
                                   array(
                                            '' => 'Quantity',
                                            '0.5L' => '500ML',
                                            '0.75L' => '750ML',
                                            '1L' => '1L',
                                            '5L' => '5L',
                                            'extras' => 'Extras',
                                        )
                                    )
                                }}
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="price" class="form-control" required="required" placeholder="Price">
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" name="discount_price" class="form-control" required="required" placeholder="Discount Price">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                {{Form::select('category',
                                               array(
                                                        '' => 'Select a category',
                                                        'spirits' => 'Spirits',
                                                        'wines' => 'Wines',
                                                        'beers' => 'Beers',
                                                        'extras' => 'Extras',
                                                    )
                                    )}}
                            </div>

                            <div class="form-group col-md-6">
                                {{Form::select('sub_category',
                                           array(
                                                    ''=> 'Sub Category',
                                                    'whiskey' => 'Whiskey',
                                                    'red_wine' => 'Red Wine'
                                                )
                                )}}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <textarea name="description" id="message" required="required" class="form-control" rows="8" placeholder="About Product"></textarea>
                            </div>
                            <p class="errors">{!!$errors->first('image')!!}</p>
                            @if(Session::has('error'))
                                <p class="errors">{!! Session::get('error') !!}</p>
                            @endif

                            <div class="form-group col-md-12">
                                {!! Form::submit('Add Product', array('class'=>'btn btn-primary pull-right')) !!}
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
