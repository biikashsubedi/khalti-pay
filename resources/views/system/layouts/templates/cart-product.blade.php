<table style="width:100%;  border: 2px solid #E7E7E7;">
    <caption></caption>
    <tr class="detail-name" style="height:58px;">
        <th scope="col" class="pull-left"
            style="border-bottom: 2px solid #E7E7E7; font-size: 16px; color: #000000; font-weight: 500;">
            Item name
        </th>
        <th scope="col" style="border-bottom: 2px solid #E7E7E7; font-size: 16px; color: #000000; font-weight: 500;">
            Offer
        </th>
        <th scope="col" style="border-bottom: 2px solid #E7E7E7; font-size: 16px; color: #000000; font-weight: 500;">
            Price(unit)
        </th>
        <th scope="col" style="border-bottom: 2px solid #E7E7E7; font-size: 16px; color: #000000; font-weight: 500;">
            Total
        </th>
    </tr>
    @php $total = 0; @endphp
    @foreach($items as $item)
        <tr style="margin:22px;">
            <td style="vertical-align: middle;text-align: center;width: 50%;">
                <div class="detail-list clearfix" style="display: table;">
                    <img alt="cart Image" src="{{(new \App\Model\Config())->getSystemDefaultPlaceholderImage()}}"
                         style="padding: 10px;float: left;border: 1px solid #f2f2f2;display: inline-block;width: 73px;height: 75px;">
                    <p style="text-align: left;font-size: 16px;color: #000000;margin: 0;padding-left: 10px;vertical-align:  middle;display:  table-cell;">
                        {{ $item->product->name }}
                        <span style="display: block; color: #999999;">
                            {{ $item->productVariant->sku }}
                        </span>
                    </p>
                    <br>
                </div>
            </td>
            <td style="vertical-align: middle;text-align: center;"> 20% Off</td>
            <td style="vertical-align: middle;text-align: center;">{{ $item->quantity }}
                x {{'NPR. '. $item->unit_price/getDefaultCurrecyRate() }}/-
            </td>
            <td style="vertical-align: middle;text-align: center;"> {{'NPR. '. $item->quantity * ($item->unit_price/getDefaultCurrecyRate()) }}
                /-
            </td>
            @php $total += $item->unit_price * $item->quantity; @endphp
        </tr>
    @endforeach
</table>

<table style="width:100%;  border: 2px solid #E7E7E7;">
    <caption></caption>
    <tr>
        <th>
        </th>
        <td>
            <p style="float: right; margin-right: 50px">
                <strong>Total: </strong>{{' NPR. '.  $total/getDefaultCurrecyRate() }} /-
            </p>
        </td>
    </tr>
</table>
