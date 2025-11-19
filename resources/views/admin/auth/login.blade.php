<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Fashion</title>

    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" type="image/x-icon">

    <link rel="apple-touch-icon" href="{{ asset('admin/assets/images/favicon.png') }}">

    <link rel="stylesheet" href="{{asset('admin/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/styles/main.css') }}">
</head>

<body>
    <div class="main-content_area bg-img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="authentication_item">
                        <div class="authentication_item_logo">
                            <a href="">
                                <img src="{{ asset('admin/assets/images/logo/footer-logo.png') }}" alt="icon">
                            </a>
                        </div>
                        <div class="authentication_item_title mb-30">
                            <h2>Sign In</h2>
                        </div>
                        <div class="authentication_item_content">
                            <form action="{{ route('admin.login.submit') }}" method="post">
                                @csrf
                                <div class="input_group mb-25">
                                    <label>Email Address</label>
                                    <div class="input-overlay">
                                        <input type="text" name="email" id="email" value=""
                                            placeholder="Enter email">
                                        <div class="overlay">
                                            <img src="{{ asset('admin/assets/images/mail.svg') }}" alt="icon">
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                                <div class="input_group mb-20">
                                    <label>Password</label>
                                    <div class="input-overlay">
                                        <input type="password" name="password" id="pass" value=""
                                            placeholder="Enter password">
                                        <div class="overlay">
                                            <img src="{{ asset('admin/assets/images/lock.svg') }}" alt="icon">
                                        </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    {{-- <div class="password-visibility">
                                        <img src="{{ asset('admin/assets/images/eye.svg') }}" alt="icon">
                                    </div> --}}

                                    <div class="input_group mb-27 mt-3">
                                        <button type="submit" class="btn btn-blue">Sign In</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/password-show.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/sweetalert/sweetalert.all.js') }}"></script>
</body>

</html>
