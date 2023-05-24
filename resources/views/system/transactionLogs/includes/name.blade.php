@if(!$item->order_id)
    {{ucwords($item->card->name ?? 'N/A')}}
@else
    {{ucwords($item->user->name)}}
@endif

