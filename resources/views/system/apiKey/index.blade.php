@extends('system.layouts.master')

@section('content')

    @livewireStyles
    @livewireScripts

    @livewire('index-table', [
        'tableFields' => [
            "Key",
            "Hits",
            "Type",
            "Status"=>'include:system.layouts.partials.status',
//            'Action' => 'include:system.layouts.partials.editButton,system.layouts.partials.deleteButton'
        ],
        'showFilters' => false,
        'filter' => [
            'search' => null,
            'orderBy' => 'key',
            'sort' => "asc",
            'status' => null
        ],
        'searchFields' => [
            'type',
            'key'
        ],
        'indexUrl' => route('apiKey'),
        'modal' => '\App\Models\ApiKey',
        'showDeleteButton'=>false,
    ])
@endsection
