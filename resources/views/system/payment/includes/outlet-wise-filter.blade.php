@if(is_null(Auth::user()['outlet_id']))
    <div class="filter-group" style="margin-left: 8px">
        <label><strong>Outlet</strong></label>
        <select wire:model="outletData" class="form-control" style="width: 150px">
            <option value="">All Outlets</option>
            @foreach(getAllWarehouses() as $outletId)
                <option value="{{$outletId->id}}">
                    {{$outletId->name}}
                </option>
                @foreach ($outletId->children as $child)
                    <option value="{{$child->id}}">
                        &nbsp; → {{$child->name}}
                    </option>
                @endforeach
            @endforeach
        </select>
    </div>
@endif
