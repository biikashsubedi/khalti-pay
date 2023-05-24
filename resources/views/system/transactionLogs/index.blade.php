@extends('system.layouts.master')

@section('createButton')
@show

@section('content')

    @livewire('index-table', [
        'tableFields' => [
            "Order Number"=>'include:system.transactionLogs.includes.order',
            "Name"=>'include:system.transactionLogs.includes.name',
            "payment",
            "Transaction Date"=>'include:system.transactionLogs.includes.date',
            "Amount"=>'include:system.transactionLogs.includes.amount',
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
    ])
@endsection
