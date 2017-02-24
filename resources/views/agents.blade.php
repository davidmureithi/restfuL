
    {{--{{Form::open(array('url'=>'/','method'=>'post'))}}--}}

    {{--{{Form::text('link',Input::old('link'),array('placeholder'=>'Insert your URL here and press enter!'))}}--}}
    {{----}}
    {{--{{Form::close()}}--}}

    @extends('layouts.master')
    @section('content')
        <div id="contact-page" class="container">
            <div class="bg">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="title text-center">Become an <strong>Agent</strong></h2>
                        {{--<div id="gmap" class="contact-map">--}}
                        {{--</div>--}}
                    </div>
                </div>
                @include('flash::message')

                @if(session()->has('success'))
                    <h3 class="error">
                        The Agent was successfully Added.
                    </h3>
                @endif
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif



                <div class="row">
                    <div class="col-sm-8">
                        <div class="contact-form">
                            <h2 class="title text-center">Agent Details</h2>
                            <div class="status alert alert-success" style="display: none"></div>
                            {{--{{Form::open(array('url'=>'/','action' => 'store', 'method'=>'post', 'id' => 'main-contact-form', 'class' => 'contact-form row', 'name' => 'contact-form'))}}--}}
                            <form action="store" id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                                <div class="form-group col-md-4">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <img class="img-responsive profile-img margin-bottom-20"  alt="" name="avatar" id="avatar">
                                    <input type="file" class="btn btn-sm btn-info" value="Edit Image" name="image" id="image">
                                </div>

                                <div class="form-group col-md-4">
                                    <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="tel" name="mobile" class="form-control" required="required" placeholder="Phone Number">
                                </div>

                                <div class="form-group col-md-6">
                                    <input type="text" name="location" class="form-control" required="required" placeholder="Location">
                                </div>

                                <div>
                                    <input type="hidden" name="lat" class="form-control" value="9.82551700">
                                </div>

                                <div>
                                    <input type="hidden" name="lng" class="form-control" value="-31.82551700">
                                </div>

                                <div class="form-group col-md-12">
                                    <input type="text" name="category" class="form-control" required="required" placeholder="Service Category">
                                    {{Form::select('size', array('L' => 'Large', 'S' => 'Small'))}}
                                </div>

                                <div class="form-group col-md-12">
                                    <input type="text" name="about" class="form-control" required="required" placeholder="How did you hear about us">
                                </div>

                                <div class="form-group col-md-12">
                                    <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="About You / Company"></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <input type="submit" name="submit" class="btn btn-primary pull-right" value="Register">
                                </div>
                            </form>
                            {{--{{Form::close()}}--}}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contact-info">
                            <h2 class="title text-center">Talk to Us</h2>
                            <address>
                                <p>Spotpata Inc.</p>
                                <p>Ngong Lane Plaza, 3rd Floor, NBI</p>
                                <p>Nairobi, Kenya</p>
                                <p>Mobile: +254 (700) 49 45 47</p>
                                <p>E-mail: info@spotpata.co.ke</p>
                                <p>Website: www@spotpata.co.ke</p>
                            </address>
                            <div class="social-networks">
                                <h2 class="title text-center">Find us Online</h2>
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection