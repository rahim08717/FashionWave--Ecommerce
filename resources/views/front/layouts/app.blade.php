<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords"
        content="@yield('keywords')" />
    <meta name="author" content="Md Abdur Rahim Sana" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('meta')

    <!-- fonts file -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Allison&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- css file  -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/plugins.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/style.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/extra.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/cookie-consent.css') }}">


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('front/assets/images/'.getSetting()->favicon)}}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('front/assets/css/toastr.css') }}">

</head>

<body class="direction-ltr">
    <!-- Preloader Area Start -->
@include('front.layouts.partials.header')
<div class="main-content">
    @yield('content')
</div>


    <!-- footer area start here -->
@include('front.layouts.partials.footer')

<script>
    @if(Session::has('success'))
    toastr.success("{{ session('success') }}");
@endif

@if(Session::has('error'))
    toastr.error("{{ session('error') }}");
@endif

@if(Session::has('warning'))
    toastr.warning("{{ session('warning') }}");
@endif

@if(Session::has('info'))
    toastr.info("{{ session('info') }}");
@endif
</script>
 @stack('script')

</body>

</html>
