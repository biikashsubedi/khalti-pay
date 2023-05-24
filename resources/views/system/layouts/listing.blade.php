@extends('system.layouts.master')
<link rel="shortcut icon" href="{{getFavIconFromConfig()}}" type="image/x-icon"/>


@section('createButton')
    <div class="ml-auto">
        @include('system.layouts.partials.createButton')
    </div>
@endsection

@section('content')
    <div class="custom-container-fluid">
        @section('title')

    </div><!-- ends page-head -->
@show
@include('system.layouts.partials.message')
<div class="content-display clearfix">
    @yield('header')
    <div class="panel">
        <div class="panel-box">
            <div class="table-responsive mt-3">
                <div class="custom-card">
                    <div class="card-body">
                        @yield('extra-filter')
                        <div class="table-responsive">
                            <table class="table table-bordered" id="forDataTable">
                                <caption></caption>
                                <thead>
                                @yield('table-heading')
                                </thead>
                                <tbody>
                                @if($items->isEmpty())
                                    <tr>
                                        <td colspan="100%"
                                            class="text-center">{{translate('No Data Available')}}</td>
                                    </tr>
                                @else
                                    @yield('table-data')
                                @endif
                                </tbody>
                            </table>
                        </div>
                        @include('system.layouts.partials.pagination')
                    </div>
                </div>
            </div>
        </div>
    </div><!-- panel -->
</div><!-- ends content-display -->
</div>
@endsection

@yield('scripts')
</body>

</html>
