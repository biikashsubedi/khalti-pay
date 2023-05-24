@extends('system.layouts.master')

@push('newStyles')
    <style>
        .customer-detail {
            padding: 30px;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .customer-detail-inner .title {
            width: 300px;
            line-height: 32px;
            font-size: 16px;
            font-weight: 600;
        }

        .wrapper {
            /* min-height: 100vh; */
            display: flex;
            /* justify-content: center;
            align-items: center; */
        }

        .steps {
            padding: 30px;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 8px;
            width: 100%;
        }

        .step {
            display: flex;
            position: relative;
        }

        .step::after {
            content: "";
            position: absolute;
            left: 125px;
            top: 32px;
            height: 97%;
            width: 2px;
            background-color: #20bf7a;
        }

        .step .info {
            margin: 8px 0 20px;
            width: 90%;
        }

        .step .title {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 8px;
            color: #000;
        }

        .step .text {
            font-size: 14px;
            color: rgba(white, 0.7);
            padding-bottom: 0;
            margin: 0;
        }

        .step:not(:last-child)::after {
            height: 100%;
        }

        .number {
            width: 32px;
            height: 32px;
            background-color: #20bf7a;
            border-radius: 50%;
            border: 2px solid #20bf7a;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 15px;
            font-weight: 600;
            margin-right: 14px;
        }

        .number.completed {
            background-color: #20bf7a;
        }

        .number.failed {
            background-color: #e3071a;
        }

        .number svg {
            width: 16px;
            height: 16px;
            object-fit: contain;
        }

        .number svg path {
            fill: white;
        }

        .step-time {
            width: 8%;
            font-size: 12px;
            flex-shrink: 0;
        }

        .step-time .d-time {
            font-size: 14px;
            font-weight: 600;
        }

        .copy-button {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')

    @php
        $isGiftCard = !is_null($item->gift_card_id);
    @endphp

    <div class="card">
        <div class="card-body">
            <h4><i class="fa fa-history pe-2"></i> Transaction Details</h4>
            <div class="row">
                <div class="col-sm-12">
                    <div class="customer-detail">
                        <div class="customer-detail-inner d-flex">
                            <span class="title">Name</span><span>
                                    {{ ucwords($item->name ?? "N/A") }}
                            </span>
                        </div>
                        <div class="customer-detail-inner d-flex">
                            <span class="title">Email</span><span>
                                    {{ $item->email ?? "N/A" }}
                            </span>
                        </div>
                        <div class="customer-detail-inner d-flex">
                            <span class="title">Number</span><span>
                                    {{ $item->number ?? "N/A" }}
                            </span>
                        </div>
                        <div class="customer-detail-inner d-flex">
                            <span class="title">Pay From</span><span>
                                {{ $item->payment ?? "N/A" }}
                            </span>
                        </div>
                        <div class="customer-detail-inner d-flex">
                            <span
                                class="title">Order Number</span>
                            <span>@include('system.transactionLogs.includes.order')</span>
                        </div>
                        <div class="customer-detail-inner d-flex">
                            <span
                                class="title">Order Amount</span><span>Rs. @include('system.transactionLogs.includes.amount')</span>
                        </div>
                        <div class="customer-detail-inner d-flex">
                            <span
                                class="title">Transaction Date</span><span>@include('system.transactionLogs.includes.date')</span>
                        </div>
                        <div class="customer-detail-inner d-flex">
                            <span
                                class="title">Payment Status</span><span>@include('system.transactionLogs.includes.status')</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class='wrapper'>
                        <div class='steps' id='steps'>
                            @php $count = 0; @endphp
                            @foreach($item->response as $key=>$response)

                                <div class='step'>
                                <span class="step-time ">
                                  <span
                                      class="d-time">{{ Carbon\Carbon::createFromTimestamp($key)->format('M d') }}</span>
                                    <br>
                                    <span>{{ Carbon\Carbon::createFromTimestamp($key)->format('h:i a') }}</span>
                                </span>
                                    @foreach($response as $key=>$res)
                                        @php $count++; @endphp
                                        <div class="number
                                            @if($key == 'initialize' && !$item->initialize_pass)
                                                {{'failed'}}
                                            @elseif($key == 'verification' && !$item->verification_pass)
                                                {{'failed'}}
                                            @else
                                                {{'completed'}}
                                           @endif
                                           ">
                                            <svg viewBox="0 0 512 512" width="100" title="check">
                                                <path
                                                    d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"/>
                                            </svg>
                                        </div>

                                        <div class='info'>
                                            <p class='title'>{{ucwords($key)}}</p>
                                            <pre class='text card card-body text-white' id="text{{$count}}"
                                                 style="background-color: #120F12">
                                                {{ json_encode($res, JSON_PRETTY_PRINT) }}
                                            </pre>
                                            <button id="copyButton" class="copy-button"
                                                    onclick="copyThisText({{$count}})"><i class="fa fa-copy"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                            @endforeach

                            <script>
                                function copyThisText(value) {
                                    text = $('#text' + value).text()
                                    navigator.clipboard.writeText(text);
                                    toastr.success("Response Copied.");
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
