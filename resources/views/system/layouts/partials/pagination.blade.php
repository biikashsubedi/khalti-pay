@if(!$items->isEmpty())
    @if(method_exists($items, 'perPage') && method_exists($items, 'currentPage'))
        <div class="mx-auto text-center">
            <div class="pagination-tile ">
                <label class="pagination-sub">
                    Showing {{($items->currentpage()-1)*$items->perpage()+1}} to {{(($items->currentpage()-1)*$items->perpage())+$items->count()}} {{'of'}} {{$items->total()}} {{'entries'}}
                </label>
                <ul class="pagination justify-content-center">
                    {!! str_replace('/?', '?',$items->appends([
                        'keyword'=>Request::get('keyword'),
                        'status'=>Request::get('status'),
                        'warehouse_id'=>Request::get('warehouse_id'),
                        'view'=>Request::get('view'),
                        'group'=>Request::get('group'),
                        'locale'=>Request::get('locale'),
                        'from'=>Request::get('from'),
                        'to'=>Request::get('to'),
                        'role'=>Request::get('role'),
                        'user'=>Request::get('user'),
                        'payment_status'=>Request::get('payment_status'),
                        'platform'=>Request::get('platform'),
                        'date'=>Request::get('date'),
                        'sale_of'=>Request::get('sale_of'),
                        'category'=>Request::get('category'),
                        'stock'=>Request::get('stock'),
                        'sort'=>Request::get('sort'),
                       ])->render()) !!}
                </ul>
            </div>
        </div>
    @endif
@endif
