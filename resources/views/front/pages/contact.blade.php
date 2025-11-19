@extends('front.layouts.app')

@section('title',$data->meta_title)
@section('description',$data->meta_description)
@section('keywords',$data->meta_keywords)
<!-- hero-section area start here  -->
@section('content')
 <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">{{ $data->title ?? "" }}</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a></li>
                    <li class="page-item">{{ $data->title ?? "" }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <!-- contact us area start here  -->
    <div class="contact-us-area section-bottom">
        <div class="container">
            <div class="row">
                <div class="contact-us-top">
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-contact-info border-0 text-center">
                                <img class="contact-info-icon" src="assets/images/contact-info-1.png"
                                    alt="contact-info" />
                                <h3 class="contact-info-title">Email</h3>
                                <p class="contact-info-content">
                                    {{ getSetting()->email ?? "" }}

                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-contact-info text-center">
                                <img class="contact-info-icon" src="assets/images/contact-info-2.png"
                                    alt="contact-info" />
                                <h3 class="contact-info-title">Address</h3>
                                <p class="contact-info-content">
                                  {{ getSetting()->address ?? "" }}
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-contact-info text-center">
                                <img class="contact-info-icon" src="assets/images/contact-info-3.png"
                                    alt="contact-info" />
                                <h3 class="contact-info-title">Phone</h3>
                                <p class="contact-info-content">
                                    {{ getSetting()->phone ?? "" }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="googlemap mb-5">

                       {!! getSetting('map_ifram') !!}


                </div>
                <div class="contact-form-area">
                    <div class="contct-form-top text-center">
                        <h2 class="form-title">Got any questions?</h2>
                        <p class="form-subtitle">Use the form below to get in touch with the sales team</p>
                    </div>
                    <form method="POST" action="{{ route('pages.contact') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="First Name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="Last Name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email Address" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="contact_number" name="contact_phone"
                                        placeholder="Contact Number" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control message-box" id="message" name="message" rows="3"
                                        placeholder="Type Message Here.."></textarea>
                                </div>
                                <div class="form-button text-center">
                                    <button type="submit" class="form-btn">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contact us area end here  -->

@endsection
