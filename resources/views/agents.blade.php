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

                @if(session()->has('success'))
                    <div class="alert-box success">
                        <h2>{!! Session::get('success') !!}</h2>
                    </div>
                @endif

                @include('flash::message')
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

                            {!! Form::open(array('url'=>'store','method'=>'POST', 'files'=>true)) !!}
                                <div class="form-group col-md-4">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <img class="img-responsive profile-img margin-bottom-20"  alt="" name="avatar" id="avatarID">
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
                                    {{Form::select('category',
                                                   array(
                                                            '' => 'Select category that best describes what you do',
                                                            'gas' => 'Cooking Gas',
                                                            'cleaners' => 'Home Cleaning Services',
                                                            'laundry' => 'Laundry Services',
                                                            'houses' => 'Housing Services',
                                                            'plumbing' => 'Plumbing Services',
                                                            'electricity' => 'Electrical Services',
                                                            'fundi' => 'Fundi (General) Services',
                                                            'pest' => 'Pest Control Services',
                                                            'painting' => 'Painting Services',
                                                            'appliance' => 'Appliance Repair Services',
                                                            'relocation' => 'Relocation & Transport Services',
                                                            'crane' => 'Towing (Crane) Services',
                                                            'mechanic' => 'Mechanical Services',
                                                        )
                                        )}}
                                </div>

                                <div class="form-group col-md-12">
                                    {{Form::select('heard_of_us',
                                               array(
                                                        ''=> 'How did you hear about us',
                                                        'Facebook' => 'Through Facebook',
                                                        'Google' => 'Through Google',
                                                        'Friend' => 'Through a Friend',
                                                        'Not_Saying' => 'Prefer not to say',
                                                        'Dont_Know' => 'I cant remember'
                                                    )
                                    )}}
                                </div>

                                <div class="form-group col-md-12">
                                    <textarea name="about" id="message" required="required" class="form-control" rows="8" placeholder="About You / Company"></textarea>
                                </div>

                                <p class="errors">{!!$errors->first('image')!!}</p>
                                @if(Session::has('error'))
                                    <p class="errors">{!! Session::get('error') !!}</p>
                                @endif

                                <div class="form-group col-md-12">
                                    {!! Form::submit('Register', array('class'=>'btn btn-primary pull-right')) !!}
                                </div>
                                <div id="success"> </div>
                            {{Form::close()}}
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
                                        <a href="https://www.facebook.com/spotpata.co.ke/"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/spotpata"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-youtube"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/spotpata/"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
