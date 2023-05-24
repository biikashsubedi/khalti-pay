<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ ($title ?? '') . ' | ' .  getCmsConfigText('site_header')}}</title>
    @include('system.layouts.layoutHeader')
    @stack('newStyles')
    @yield('styles')
    @livewireScripts
    @yield('endstyles')
</head>

<body class="main-body leftmenu">

@include('system.layouts.loader')


<!-- Page -->
<div class="page">

    @include('system.layouts.partials.sidebar')
    @include('system.layouts.partials.header')

    <!-- Main Content-->
    <div class="main-content side-content pt-0"
         @if (!\Cache::get('businessOwnerIsPaid') && \Cache::has('businessOwnerPaymentDue') && \Cache::get('businessOwnerPaymentDue') < 8)
             style="margin-top: 2rem;"
        @endif>

        <div class="container-fluid">
            <div class="inner-body">

                @include('system.layouts.partials.breadcrumb')

                @yield('content')

            </div>
        </div>
    </div>
    <!-- End Main Content-->

    @include('system.layouts.layoutFooter')

</div>
<!-- End Page -->

@include('system.layouts.scriptJs')
@yield('Scripts')
@stack('newScripts')
</body>
</html>
