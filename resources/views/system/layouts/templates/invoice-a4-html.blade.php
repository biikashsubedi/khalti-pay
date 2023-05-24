<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Order Slip of {{env('APP_NAME')}}">
    <meta name="author" content="{{env('APP_NAME')}} Pvt. Ltd.">
    <meta name="keywords" content="Order Slip of {{env('APP_NAME')}}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ getFavIconFromConfig() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/eklogo.png') }}">
    <!-- Title -->
    <title>Order Slip of {{env('APP_NAME')}}</title>
    <!--Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&family=Roboto+Mono:wght@400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&family=Roboto:wght@400;500;700&display=swap"
          rel="stylesheet">

<body>
<!--POV invoice start-->
<div class="order-slip-pov">
    <div class="container">
        <style>
            *, ::after, ::before {
                box-sizing: border-box;
            }

            .title {
                font-size: 20px;
                font-weight: 700;
                font-family: 'Open Sans', serif !important;
                text-align: center;

            }

            .title span {
                margin-bottom: 9px !important;
            }

            .receipt__detail {
                width: 302px;
                margin-left: auto;
                margin-right: auto;
                font-size: 12px;
                background-color: #fff;
                font-family: 'Open Sans', serif !important;
                padding: 20px;
                color: #2E2E2E;
            }

            .company_detail {
                color: #2E2E2E;
                font-weight: 700;
                font-size: 12px;
                font-family: 'Open Sans', serif !important;
                text-align: center;
            }

            .company-detail p {
                margin-bottom: 0;
                text-transform: uppercase;
            }

            .customer__detail {
                margin-bottom: 20px;
            }

            .customer__detail p {
                margin-bottom: 4px !important;
            }

            .receipt__detail .table thead th {
                font-weight: 400;
                font-size: 12px;
                letter-spacing: .5px;
                border-bottom-width: 1px;
                border-top-width: 0;
                /* padding:2px 5px; */
                padding: 3px 0px;
                margin-top: 10px;
                margin-bottom: 10px;
                font-family: 'Open Sans', serif !important;
            }

            .receipt__detail table td {
                /* padding: 0.75rem; */
                vertical-align: middle;
                /* padding:2px 5px; */
                padding: 2px 0px;
                line-height: 0.7;
                border-top: 0;
                font-family: 'Open Sans', serif !important;
            }

            .table {
                width: 100%;

            }

            .border-top-bottom {
                border-top: 1px dashed grey;
            }

            .net-worth-border hr {
                width: 200px;
                border-bottom: 1px dashed grey;
                color: transparent;
                text-align: right;
                float: right;
                display: inline-block;

            }

            .grand-total-border hr {
                width: 100%;
                border-bottom: 1px dashed grey;
                color: transparent;
                text-align: right;
                float: right;
                display: inline-block;

            }

            .thankyou-note p {
                font-size: 14px;
                font-family: 'Open Sans', serif !important;
            }

            .item-detail {
                font-size: 10px;
            }
        </style>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="receipt__detail">
                    <div class="title"><span>{{env('APP_NAME')}}</span></div>
                    <div class="company_detail" style="margin-bottom: -10px !important;">
                        <p @if(!is_null(getPanNumber())) style="margin-bottom: -15px"
                           @else style="margin-bottom: -10px" @endif>
                            {{$order->warehouse->address ?? 'N/A'}}@if(!is_null(getWarehousePhoneNumber($order->warehouse->id ?? 11111)))
                                , PH: {{env('CLIENT_PHONE', 'N/A')}}
                            @endif
                        </p>
                        @if(!is_null(getPanNumber()))
                            <p style="margin-bottom: -10px">{{'PAN NO. '. getPanNumber()}}</p>
                        @endif
                        <p>{{translate('ORDER CONFIRMATION SLIP' )}}</p>
                    </div>
                    <div class="customer__detail">
                        <p style="margin-bottom: -15px !important;"> {{translate('Order No')}}
                            <span style="padding-left:50px;">:</span>
                            <span style="padding-left:10px;">
                                {{$order->order_number}}
                            </span>
                        </p>
                        <p style="margin-bottom: -15px !important;"> {{translate('Order Date')}}
                            <span style="padding-left:42px;">:</span>
                            <span style="padding-left:10px;">
                                {{$order->created_at->isoFormat('YYYY MMM DD')}}
                            </span>
                        </p>
                        <p style="margin-bottom: -15px !important;"> {{'Name'}}
                            <span style="padding-left:67px;">:</span>
                            <span style="padding-left:10px;">
                                {{ucwords($order->frontendUser->name)}}
                            </span>
                        </p>
                        <p style="margin-bottom: -15px !important;"> {{translate('Address')}}
                            <span style="padding-left:56px;">:</span>
                            <span style="padding-left:10px;">
                                {{Str::limit($order->address, 25)}}
                            </span>
                        </p>
                        <p style="margin-bottom: -15px !important;">{{translate('Tel No')}}
                            <span style="padding-left:61px;">:</span>
                            <span style="padding-left:10px;">
                                {{$order->contact_number}}
                            </span>
                        </p>
                        <p> {{translate('Payment Mode')}}

                            <span style="padding-left:22px;">:</span>
                            <span style="padding-left:10px;">
                                {{$order->transaction ? ucwords($order->transaction->payment_method) : 'N/A'}}
                                @if($order->transaction &&
                                    $order->transaction->paymentMethod &&
                                    $order->transaction->paymentMethod->code = \App\Model\PaymentMethod::$cashOnDelivery)
                                    @if(!is_null($order->delivery_status) && $order->delivery_status == \App\Model\Order::$paid)
                                        <strong>
                                            {{' ('.ucwords($order->delivery_status).')'}}
                                        </strong>
                                    @endif
                                @else
                                    @if(is_null($order->delivery_status))
                                        <strong>
                                    {{translate(' (Pending)')}}
                                    </strong>
                                    @else
                                        <strong>
                                    {{' ('.ucwords($order->delivery_status).')'}}
                                    </strong>
                                    @endif
                                @endif
                            </span>
                        </p>
                    </div>
                    <div class="order__detail" style="width:100%;">
                        <table class="table">
                            <caption></caption>
                            <thead>
                            <tr class="grand-total-border">
                                <td colspan="7">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col" style="text-align:left;width:50%;">{{translate('Particulars')}}</th>
                                <th scope="col" style="text-align:center;width:10%;">{{translate('Qty')}}</th>
                                <th scope="col" style="text-align:center;width:10%;">{{translate('Rate')}}</th>
                                <th scope="col" style="text-align:right;width:20%;">{{translate('Amt')}}</th>
                            </tr>
                            </thead>
                            <tbody class="border-top-bottom">
                            @forelse($order->orderProducts as $product)
                                <tr class="b-bottom">
                                    <td style="text-align: left;" class="item-detail">
                                        {{Str::limit(ucwords($product->title), 30)}}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ $product->quantity }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ round($product->unit_price/getDefaultCurrecyRate())}}
                                    </td>
                                    <td style="text-align: right;">
                                        {{ round(($product->unit_price * $product->quantity)/getDefaultCurrecyRate()) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <p style="text-align: center">{{translate('No Product To Display!')}}</p>
                                    </td>
                                </tr>
                            @endforelse

                            <tr class="grand-total-border">
                                <td colspan="7" style="padding-bottom:15px;">
                                    <hr>
                                </td>
                            </tr>
                            @if($order->orderProducts->isNotEmpty())
                                <tr class="text-right">
                                    <td colspan="3" style="text-align:right;">
                                        Order Amount
                                        <span style="padding-left:10px;">:</span>
                                    </td>
                                    <td colspan="2" class=""
                                        style="text-align:right;font-weight:bold; color:#2E2E2E; text-transform:uppercase;">
                                        {{number_format($order->orderProducts->sum('total')/getDefaultCurrecyRate(), 2)}}
                                    </td>
                                </tr>
                                @if(!empty($order->detail['couponDiscount']) && $order->detail['couponDiscount'] > 0)
                                    <tr class="text-right">
                                        <td colspan="3" style="text-align:right;">
                                            {{translate('Coupon Discount')}}
                                            <span style="padding-left:10px;">:</span></td>
                                        <td colspan="2" class=""
                                            style="text-align:right;font-weight:bold; color:#2E2E2E; text-transform:uppercase;">
                                            {{number_format($order->detail['couponDiscount']/getDefaultCurrecyRate(), 2)}}
                                        </td>
                                    </tr>
                                @endif
                                @if(!empty($order->detail['discount']) && $order->detail['discount'] > 0)
                                    <tr class="text-right">
                                        <td colspan="3" style="text-align:right;">
                                            {{translate('Discount')}}
                                            <span style="padding-left:10px;">:</span></td>
                                        <td colspan="2" class=""
                                            style="text-align:right;font-weight:bold; color:#2E2E2E; text-transform:uppercase;">
                                            {{number_format($order->detail['discount']/getDefaultCurrecyRate(), 2)}}
                                        </td>
                                    </tr>
                                @endif
                                @if((!empty($order->detail['couponDiscount']) && $order->detail['couponDiscount'] > 0) || !empty($order->detail['discount']) && $order->detail['discount'] > 0)
                                    @if(!empty($order->detail['subTotal']) && $order->detail['subTotal'] > 0)
                                        <tr class="text-right">
                                            <td colspan="3" style="text-align:right;">
                                                {{'Sub Total'}}
                                                <span style="padding-left:10px;">:</span></td>
                                            <td colspan="2" class=""
                                                style="text-align:right;font-weight:bold; color:#2E2E2E; text-transform:uppercase;">
                                                {{number_format($order->detail['subTotal']/getDefaultCurrecyRate(), 2)}}
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                @if(!empty($order->detail['scheme']) && $order->detail['scheme'] > 0)
                                    <tr class="text-right">
                                        <td colspan="3" style="text-align:right;">
                                            {{translate('Scheme')}}
                                            <span style="padding-left:10px;">:</span></td>
                                        <td colspan="2" class=""
                                            style="text-align:right;font-weight:bold; color:#2E2E2E; text-transform:uppercase;">
                                            {{number_format($order->detail['scheme']/getDefaultCurrecyRate(), 2)}}
                                        </td>
                                    </tr>
                                @endif
                                @if(!empty($order->detail['serviceCharge']) && $order->detail['serviceCharge'] > 0)
                                    <tr class="text-right">
                                        <td colspan="3" style="text-align:right;">
                                            {{translate('Service Charge')}}
                                            <span style="padding-left:10px;">:</span></td>
                                        <td colspan="2" class=""
                                            style="text-align:right;font-weight:bold; color:#2E2E2E; text-transform:uppercase;">
                                            {{number_format($order->detail['serviceCharge']/getDefaultCurrecyRate(), 2)}}
                                        </td>
                                    </tr>
                                @endif
                                @if(!empty($order->detail['taxAmount']) && $order->detail['taxAmount'] > 0)
                                    <tr class="text-right">
                                        <td colspan="3" style="text-align:right;">
                                            {{translate('Tax')}}
                                            <span style="padding-left:10px;">:</span></td>
                                        <td colspan="2" class=""
                                            style="text-align:right;font-weight:bold; color:#2E2E2E; text-transform:uppercase;">
                                            {{number_format($order->detail['taxAmount']/getDefaultCurrecyRate(), 2)}}
                                        </td>
                                    </tr>
                                @endif
                                @if(!empty($order->detail['deliveryCharge']) && $order->detail['deliveryCharge'] > 0)
                                    <tr class="text-right">
                                        <td colspan="3" style="text-align:right;">
                                            {{translate('Delivery Charge')}}
                                            <span style="padding-left:10px;">:</span></td>
                                        <td colspan="2" class=""
                                            style="text-align:right;font-weight:bold; color:#2E2E2E; text-transform:uppercase;">
                                            {{number_format($order->detail['deliveryCharge']/getDefaultCurrecyRate(), 2)}}
                                        </td>
                                    </tr>
                                @endif

                                <tr class="net-worth-border">
                                    <td colspan="7" style=" padding-bottom:10px;">
                                        <hr>
                                    </td>
                                </tr>
                                <tr class="text-right">
                                    <td colspan="3" class="" style="text-align:right;">
                                        {{'GRAND TOTAL'}}
                                        <span style="padding-left:10px;">:</span></td>
                                    <td colspan="2" class=""
                                        style="text-align:right;font-weight:bold; color:#2E2E2E; text-transform:uppercase;">
                                        {{'NRS.'.round($order->total/getDefaultCurrecyRate())}}
                                    </td>
                                </tr>
                                <tr class="grand-total-border">
                                    <td colspan="7" style=" padding-bottom:10px;">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7"
                                        style="letter-spacing:1px;text-align:center;">
                                        {{getDefaultCurrencyTitle()}} {{ucwords(convertDigitToText()->format(round($order->total/getDefaultCurrecyRate())))}} {{translate('Only')}}
                                    </td>
                                </tr>
                                <tr class="grand-total-border">
                                    <td colspan="7" style=" padding-bottom:10px;">
                                        <hr>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="thankyou-note">
                            <p style="text-align:center;">{{translate('Thankyou For Shopping!')}}</p>
                            <p style="text-align:center;">{{env('APP_URL')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--POV invoice end-->
</body>
</html>
