<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Order Slip of {{env('APP_NAME')}}">
    <meta name="author" content="{{env('APP_NAME')}} Pvt. Ltd.">
    <meta name="keywords" content="Order Slip of {{env('APP_NAME')}}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{getFavIconFromConfig()}}" type="image/x-icon"/>
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


<!-- Large Invoice-->
<div class="order-invoice-content ">
    <div class="container">
        <div class="inner-body">
            <style>
                .order-invoice-content {
                    font-family: 'Roboto', serif;
                    background-color: #fff;
                }

                /* .order-date{
                    margin-bottom: 28px;
                } */
                .order-date h6 {
                    color: #2E2E2E;
                    font-size: 16px;
                    font-weight: 500;
                }

                .order-detail {
                    background-color: #FAFAFA;
                    padding-top: 10px;
                    padding-bottom: 10px;
                    text-align: left !important;
                    padding-left: 15px;
                    margin-bottom: 10px;
                }

                .order-detail .table tbody tr {
                    background-color: #FAFAFA;
                }

                .order-detail table thead td.h-top {
                    color: #2E2E2E !important;
                    font-size: 14px !important;
                    font-weight: 400 !important;
                    padding-top: 0;
                    padding-bottom: 0;
                    text-transform: capitalize;
                }

                .order-detail table td.c-detail {
                    color: #2E2E2E !important;
                    font-size: 14px !important;
                    font-weight: 500 !important;
                }

                .t-bg-color {
                    background-color: #F5F5F5;
                }

                .tbody-bg {
                    background-color: #fff;
                }

                .table tbody tr.t-bg-color {
                    background-color: #F5F5F5 !important;
                }

                .t-bold {
                    font-size: 18px !important;
                    color: #2E2E2E !important;
                    font-weight: 700 !important;
                }

                .g-total {
                    font-size: 16px !important;
                    color: #2E2E2E !important;
                    font-weight: 400 !important;
                }

                .t-price {
                    color: #2E2E2E !important;
                    font-size: 14px !important;
                    font-weight: 400 !important;
                }

                .order-invoice-content table tr.b-bottom {
                    border-bottom: 1px solid #F5F5F5;
                }

                .order-quantity .table thead th {
                    color: #2E2E2E;
                    font-size: 16px;
                    font-weight: 500;
                    text-transform: capitalize;
                    padding-top: 10px;
                    padding-bottom: 10px;
                }

                /*.order-quantity .table td {*/
                /*    font-size: 14px;*/
                /*    color: #707070;*/
                /*    font-weight: 400;*/
                /*}*/

                .order-quantity .table td {
                    vertical-align: middle;
                    padding: 0;
                    /* line-height: 1.462; */
                    line-height: 1.3;
                    border-top: 0;
                }

                .order-quantity .table tbody td {
                    padding-top: 2px !important;
                    padding-bottom: 5px !important;
                }

                .order-quantity .table thead th, .order-quantity .table thead td {
                    letter-spacing: .5px;
                    /* padding: 11px 0; */
                }

                table, th, td {
                    border-collapse: collapse;
                    border: none;
                }

                .order-detail td {
                    vertical-align: text-top;
                }
            </style>
            <!--Row Start-->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="order-receipt-wrapper">
                        <div class="company-logo">
                            <img src="" alt="">
                        </div>
                        <div class="order-date">
                            <h6 style="margin-bottom:10px">{{$order->created_at->isoFormat('YYYY MMM DD')}}
                                , {{translate('Order Slip')}}</h6>
                        </div>
                        <div class="order-detail">
                            <table class="table " style="width:100%">
                                <caption></caption>
                                <thead>
                                <tr>
                                    <td scope="col" class="h-top"><strong>{{translate('Order No:')}}</strong></td>
                                    <td scope="col" class="h-top"><strong>{{translate('Payment :')}}</strong></td>
                                    <td scope="col" class="h-top"><strong>{{translate('Payment Status:')}}</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="c-detail">{{$order->order_number}}</td>
                                    <td class="c-detail">{{$order->transaction ? ucwords($order->transaction->payment_method) : 'N/A'}}</td>
                                    <td class="c-detail">{{$order->transaction ? ucwords($order->delivery_status) : 'N/A'}}</td>
                                </tr>
                                </tbody>
                                <thead>
                                <tr>
                                    <td class="h-top" style="padding-top:10px;"><strong>{{translate('Purchased By')}}:</strong>
                                    </td>
                                    <td class="h-top" style="padding-top:10px;"><strong>{{translate('Recipient:')}}</strong>
                                    </td>
                                    <td class="h-top" style="padding-top:10px;"><strong>{{translate('Store Address:')}}</strong>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="c-detail">
                                        <span>{{$order->frontendUser ? ucwords($order->frontendUser->name) : 'N/A'}} {{$order->contact_number}}</span><br>
                                        <span style="max-width: 200px; word-wrap: break-word; display: inline-block">{{$order->address}}</span><br>
                                    </td>
                                    @php
                                        $detail = $order->warehouse->detail;
                                    @endphp
                                    <td class="c-detail">
                                        @if(!empty($order->detail['deliveryAddressId']) && $order->detail['deliveryAddressId'])
                                            @php
                                                $deliveryAddress = \App\Model\DeliveryAddress::find($order->detail['deliveryAddressId'])
                                            @endphp
                                            <span style="margin-top:-50px;">
                                                {{$deliveryAddress ? $deliveryAddress->name : 'N/A'}}
                                            </span><br>
                                            <span>
                                                {{$deliveryAddress ? $deliveryAddress->mobile_number : 'N/A'}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="c-detail">
                                        <span style="margin-top:-50px;">
                                            {{ucwords($order->warehouse->address)}}
                                        </span> <br>
                                        <span>
                                            @if(!empty($detail['phoneNumber']) && !is_null($detail['phoneNumber']))
                                                {{$detail['phoneNumber']}}
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="order-quantity">
                            <div class="table-responsive" style="width:100%">
                                <table class="table t-bg-color " style="width:99%">
                                    <caption></caption>
                                    <thead>
                                    <tr>
                                        <th scope="col" style="width:10%">S.N.</th>
                                        <th scope="col" style="text-align:left;width:50%;">{{translate('Product Name')}}</th>
                                        <th scope="col" style="text-align:left;width:10%;">{{translate('Size')}}</th>
                                        <th scope="col" style="text-align:left;width:10%;">{{translate('Qty')}}</th>
                                        <th scope="col" style="text-align:left;width:10%;">{{translate('Price')}}</th>
                                        <th scope="col" style="text-align:center;width:10%;">{{translate('Total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody-bg">
                                    @forelse($order->orderProducts as $key=>$product)
                                        <tr class="b-bottom">
                                            <th scope="row" style="text-align:center;">{{$key+1}}</th>
                                            <td style="text-align:left; vertical-align: text-top;">
                                                {{Str::limit(ucwords($product->title), 30)}}
                                            </td>
                                            <td style="text-align:left; vertical-align: text-top;">
                                                {{$product->productVariant && $product->productVariant->unit ? ucwords($product->productVariant->unit->title) : 'N/A'}}
                                            </td>
                                            <td style="text-align:left;vertical-align: text-top;">
                                                {{ $product->quantity }}
                                            </td>
                                            <td style="text-align:left;vertical-align: text-top;">
                                                {{ number_format($product->unit_price/getDefaultCurrecyRate(), 2)}}
                                            </td>
                                            <td style="text-align:center;vertical-align: text-top;">
                                                {{ number_format(($product->unit_price * $product->quantity)/getDefaultCurrecyRate(), 2) }}
                                            </td>
                                        </tr>
                                    @empty
                                        <p style="text-align: center">{{translate('No Data To Display!')}}</p>
                                    @endforelse

                                    <tr class="text-right">
                                        <td colspan="5" style="text-align:right; padding-right:80px;">
                                            Order Amount
                                        </td>
                                        <td colspan="2" class="t-price"
                                            style="text-align:right;padding-right:15px;">
                                            {{number_format($order->orderProducts->sum('total')/getDefaultCurrecyRate(), 2)}}
                                        </td>
                                    </tr>
                                    @if(!empty($order->detail['couponDiscount']) && $order->detail['couponDiscount'] > 0)
                                        <tr class="text-right">
                                            <td colspan="5" style="text-align:right; padding-right:80px;">
                                                {{translate('Coupon Discount')}}
                                            </td>
                                            <td colspan="2" class="t-price"
                                                style="text-align:right;padding-right:15px;">
                                                {{number_format($order->detail['couponDiscount']/getDefaultCurrecyRate(), 2)}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if(!empty($order->detail['discount']) && $order->detail['discount'] > 0)
                                        <tr class="text-right">
                                            <td colspan="5" style="text-align:right; padding-right:80px;">
                                                {{translate('Discount Amount')}}
                                            </td>
                                            <td colspan="2" class="t-price"
                                                style="text-align:right;padding-right:15px;">
                                                {{number_format($order->detail['discount']/getDefaultCurrecyRate(), 2)}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if(!empty($order->detail['subTotal']) && $order->detail['subTotal'] > 0)
                                        <tr class="text-right">
                                            <td colspan="5" style="text-align:right; padding-right:80px;">
                                                {{translate('Sub Total')}}
                                            </td>
                                            <td colspan="2" class="t-price"
                                                style="text-align:right;padding-right:15px;">
                                                {{number_format($order->detail['subTotal']/getDefaultCurrecyRate(), 2)}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if(!empty($order->detail['scheme']) && $order->detail['scheme'] > 0)
                                        <tr class="text-right">
                                            <td colspan="5" style="text-align:right;">
                                                {{translate('Scheme Amount')}}
                                            </td>
                                            <td colspan="2" class="t-price"
                                                style="text-align:right;padding-right:15px;">
                                                {{number_format($order->detail['scheme']/getDefaultCurrecyRate(), 2)}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if(!empty($order->detail['serviceCharge']) && $order->detail['serviceCharge'] > 0)
                                        <tr class="text-right">
                                            <td colspan="5" style="text-align:right; padding-right:80px;">
                                                {{translate('Service Charge')}}
                                            </td>
                                            <td colspan="2" class="t-price"
                                                style="text-align:right;padding-right:15px;">
                                                {{number_format($order->detail['serviceCharge']/getDefaultCurrecyRate(), 2)}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if(!empty($order->detail['taxAmount']) && $order->detail['taxAmount'] > 0)
                                        <tr class="text-right">
                                            <td colspan="5" style="text-align:right; padding-right:80px;">
                                                {{translate('Tax Amount')}}
                                            </td>
                                            <td colspan="2" class="t-price"
                                                style="text-align:right;padding-right:15px;">
                                                {{number_format($order->detail['taxAmount']/getDefaultCurrecyRate(), 2)}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if(!empty($order->detail['deliveryCharge']) && $order->detail['deliveryCharge'] > 0)
                                        <tr class="text-right">
                                            <td colspan="5" style="text-align:right; padding-right:80px;">
                                                {{translate('Delivery Charge')}}
                                            </td>
                                            <td colspan="2" class="t-price"
                                                style="text-align:right;padding-right:15px; padding-bottom: 15px;">
                                                {{number_format($order->detail['deliveryCharge']/getDefaultCurrecyRate(), 2)}}
                                            </td>
                                        </tr>
                                    @endif

                                    <tr class="text-right t-bg-color">
                                        <td colspan="5" class="g-total" style="text-align:right; padding-right:80px;">
                                            {{translate('Grand total:')}}
                                        </td>
                                        <td colspan="2" class="t-bold" style="text-align:right;padding-right:15px;">
                                            {{'Rs.'.round($order->total/getDefaultCurrecyRate())}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row End-->
        </div>
    </div>
</div>
<!-- Large Invoice End-->

</body>
</html>
