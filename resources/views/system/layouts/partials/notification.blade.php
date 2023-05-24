<div class="dropdown-menu">
    <div class="header-navheading">
        <p class="main-notification-text">You have <strong>{{count($items)}}</strong> unread notification</p>
    </div>
    <div class="main-notification-list">

        @if(\Cache::has('businessOwnerRestrict') && \Cache::get('businessOwnerRestrict'))
            <div class="text-center" style="
                padding: 10px;
                text-align: center;
                background-color: #f13333;
                font-weight: 600;
                color: rgba(255, 255, 255, .8);">
                {{translate('Your subscription has expired.')}}
            </div>
        @else
            @php $i = 0; @endphp
            @foreach($items as $item)
                @php $i++; @endphp
                @if($i<7)
                    <a href="{{route('orders.show', $item->id)}}">
                        <div class="media">
                        <div class="media-body">
                            <p>Order by <strong>{{$item->frontendUser->name}}</strong>  with Rs. {{$item->total/getDefaultCurrecyRate()}}</p>
                            <span>{{$item->created_at->isoFormat('YYYY MMM DD')}}</span>
                        </div>
                    </div>
                    </a>
                @endif
            @endforeach
        @endif
    </div>
        <div class="dropdown-footer">
            <a href="#">View All Feature Not Available</a>
        </div>
</div>
