<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dark Matters | Khalti Payment</title>
    @include('system.layouts.layoutHeader')
</head>

<body class="main-body leftmenu">

@include('system.layouts.loader')


<!-- Page -->
<div class="page">

    @include('system.layouts.partials.header')
    @include('system.layouts.partials.sidebar')

    <!-- Page -->
    <div class="page main-signin-wrapper bg-primary construction">

        <div class="container ">
            <div class="construction1 text-center details text-white">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h1 class="tx-140 mb-0">404</h1>
                    </div>
                    <div class="col-lg-12 ">
                        <h1>Oops.The Page you are looking for doesn't exit..</h1>
                        <h6 class="tx-15 mt-3 mb-4 text-white-50">You may have mistyped the address or the page may
                            have
                            moved. Try searching below.</h6>
                        <a class="btn ripple btn-success text-center"
                           href="{{route('home')}}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- End Page -->
    @include('system.layouts.layoutFooter')

</div>
<!-- End Page -->

@include('system.layouts.scriptJs')
</body>
</html>

