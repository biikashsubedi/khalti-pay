@extends('system.layouts.master')

@section('createButton')
@show

@section('content')

    @livewire('index-table', [
        'tableFields' => [
            "order",
            "name",
            "email",
            "number",
            "payment",
            "Transaction Date"=>'include:system.transactionLogs.includes.date',
            "Amount",
            "Status" => 'include:system.transactionLogs.includes.status',
            'Action' => 'include:system.transactionLogs.includes.showButton'
        ],
        'showFilters' => 'system.layouts.livewire.status-filter',
        'filter' => [
            'search' => null,
            'orderBy' => 'id',
            'sort' => "desc",
            'status' => null
        ],
        'searchFields' => [
        ],
        'indexUrl' => route('transactionLog.index'),
        'modal' => '\App\Models\TransactionLog',
        'showDeleteButton' => false
    ])
@endsection
