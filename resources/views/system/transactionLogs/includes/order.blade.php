@if(!$item->order_id)
    {{$item->card->code ?? 'N/A'}}
    <span class="badge badge-secondary">Gift Card</span>
@else
    <a target="_blank" href="{{route('orders.index').'/'. $item->order_id}}">{{$item->order->order_number}}</a>
@endif
