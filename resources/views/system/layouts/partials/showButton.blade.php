@if(hasPermission('/'.basename($indexUrl).'/'.$item->id))
    <a href="{{url($indexUrl.'/'.$item->id)}}" class="btn btn-pink btn-sm"><em
                class="fas fa-shower"></em> {{$buttonName ?? 'Show'}}</a>
@endif
