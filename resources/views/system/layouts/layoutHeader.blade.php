<meta charset="utf-8">
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
<meta name="csrf-token" content="{{csrf_token() }}">
<meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff" http-equiv="Content-Type"/>

<meta name="google-site-verification" content="bZKPDsVS2ZO79MA5cGPmk1_3tYuoDB1HoPHav4ca5-8" />

<!-- Favicon -->
<link rel="shortcut icon" href="" type="image/x-icon"/>

<!-- Bootstrap css-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Icons css-->
<link href="{{asset('assets/plugins/web-fonts/icons.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/web-fonts/plugin.css')}}" rel="stylesheet"/>

<!-- Internal Daterangepicker css-->
<link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{asset("assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css")}}" rel="stylesheet">

<!-- Style css-->
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/skins.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/colors/default.css')}}" rel="stylesheet">

<!-- Sidemenu css-->
<link href="{{asset('assets/css/sidemenu/sidemenu.css')}}" rel="stylesheet">

<!-- Owl-carousel css-->
<link href="{{asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet"/>
<script type="text/javascript" src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

@yield('customStyle')

@livewireStyles
