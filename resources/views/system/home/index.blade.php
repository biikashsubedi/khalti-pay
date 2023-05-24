@extends('system.layouts.master')

@section('customStyle')
    <link rel="stylesheet" href="{{asset('assets/css/home.css')}}">
    <script async type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection

@section('createButton')
    @include('system.layouts.partials.message')
    @include('system.home.includes.search-bar')
@endsection
@section('content')

    <div class="row row-sm font-family-mullish">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            @include('system.home.includes.sales-and-users')
        </div>
    </div>

@endsection


@section('Scripts')

@endsection
