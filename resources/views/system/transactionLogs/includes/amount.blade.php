@if(!$item->order_id)
    {{ucwords($item->card->reload->amount ?? 'N/A')}}
@else
    {{$item->order->total/getDefaultCurrecyRate()}}
@endif

