@extends('system.layouts.master')

@section('createButton')
    <div class="ml-auto">
        @include('system.layouts.partials.createButton')
    </div>
@endsection

@section('content')

    @livewireStyles
    @livewireScripts

    @livewire('index-table', [
        'tableFields' => [
            "Title"=>'include:system.payment.includes.title',
            'Code'=>'code',
            "Web Status" => 'include:system.payment.includes.webStatus',
            "Api Status" => 'include:system.payment.includes.apiStatus',
            "Mode" => 'include:system.payment.includes.mode',
            'Action' => 'include:system.layouts.partials.editButton,system.payment.includes.deleteButton,system.payment.includes.configureButton'
        ],
        'showFilters' => '',
        'filter' => [
            'search' => null,
            'orderBy' => 'id',
            'sort' => "desc",
            'status' => null
        ],
        'searchFields' => [
            'title',
            'code',
        ],
        'indexUrl' => route('payment.index'), // Index url of page
        'modal' => '\App\Models\Payment',
    ])
@endsection
