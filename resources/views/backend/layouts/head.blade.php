<!-- Title -->
<title>@yield('title')</title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('public/assets/img/brand/dev.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('public/assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('public/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('public/assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">


@if(LaravelLocalization::getCurrentLocale() ==='ar')
<!-- start rtl arabic -->
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{URL::asset('public/assets/css-rtl/sidemenu.css')}}">
@yield('css')
<!--- Style css -->
<link href="{{URL::asset('public/assets/css-rtl/style.css')}}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{URL::asset('public/assets/css-rtl/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('public/assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
<!-- end rtl arabic -->
@else


<!-- start ltr english -->
<link rel="stylesheet" href="{{URL::asset('public/assets/css/sidemenu.css')}}">
@yield('css')
<!--- Style css -->
<link href="{{URL::asset('public/assets/css/style.css')}}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{URL::asset('public/assets/css/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('public/assets/css/skin-modes.css')}}" rel="stylesheet">
<!-- end ltr english -->
@endif
