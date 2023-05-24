<!-- Sidemenu -->
<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="{{route('home')}}">
            <img src="{{getCmsConfigFile('cms logo')}}" class="header-brand-img desktop-logo"
                 alt="{{getCmsConfigText('title')}}" width="100" height="40">
            <img src="{{ getShortIconFromConfig() }}" class="header-brand-img icon-logo"
                 alt="{{getCmsConfigText('title')}}" width="100" height="40">
            <img src="{{getCmsConfigFile('logo1')}}"
                 class="header-brand-img desktop-logo theme-logo" alt="logo" width="100" height="40">

            <img src="{{getCmsConfigFile('logo2')}}"
                 class="header-brand-img icon-logo theme-logo"
                 alt="{{getCmsConfigText('title')}}" width="100" height="40">
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">


            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class='sidemenu-icon ti-home'></i>
                    <span class="sidemenu-label">Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('config.index')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class='sidemenu-icon ti-settings'></i>
                    <span class="sidemenu-label">Configs</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('payment.index')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class='sidemenu-icon fa fa-money'></i>
                    <span class="sidemenu-label">Payment Mode</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('apiKey')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class='sidemenu-icon fa fa-key'></i>
                    <span class="sidemenu-label">Api Key</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('transactionLog.index')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class='sidemenu-icon fa fa-history'></i>
                    <span class="sidemenu-label">Transaction Log</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('system.logs')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class='sidemenu-icon fa fa-warning'></i>
                    <span class="sidemenu-label">System Log</span></a>
            </li>

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span--}}
{{--                        class="shape2"></span>--}}
{{--                    <i class='sidemenu-icon fa fa-history'></i>--}}
{{--                    <span class="sidemenu-label">Logs</span><i--}}
{{--                        class="angle fe fe-chevron-right"></i></a>--}}
{{--                <ul class="nav-sub">--}}
{{--                    <li class="nav-sub-item">--}}
{{--                        <a class="nav-sub-link"--}}
{{--                           href="{{ route('transactionLog.index') }}">Transaction Log</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-sub-item">--}}
{{--                        <a class="nav-sub-link"--}}
{{--                           href="{{ route('system.logs') }}">System Log</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>
<!-- End Sidemenu -->
