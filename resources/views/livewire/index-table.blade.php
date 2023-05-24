<div>
    <div wire:offline>
        <x-network-not-available/>
    </div>
    <x-loading-indicator/>

    <div class="card-body">
        <div class="">
            @include('system.layouts.partials.message')
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('error-message'))
                <div class="alert alert-danger">
                    {{ session('error-message') }}
                </div>
            @endif

            @if (session()->has('deleteMessage'))
                <div class="alert alert-danger">
                    <p style="margin-bottom: 0px;">{{ session('deleteMessage') }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </p>
                </div>
            @endif
        </div>
        <div class="row table-filter" style="margin-left: 0; margin-right: 0">
            <div class="col-lg-12">
                <div class="row ml-auto">
                    {{-- show are must used fiter so, this are listed manually --}}
                    @include('system.layouts.livewire.show-list')

                    {{-- This is filter where you need seperately --}}
                    @php
                        $filterLists = [];
                        foreach (explode(',', $showFilters) as $item) {
                            $filterLists[] = $item;
                        }
                    @endphp

                    @if (!empty($showFilters))
                        @foreach ($filterLists as $sh)
                            @include($sh)
                        @endforeach
                    @endif

                    @if ($checked)
                        @include('system.layouts.livewire.bulk-action')
                    @endif
                    @if(!$removeSearchInput)
                        @include('system.layouts.livewire.search-input')
                    @endif
                </div>
            </div>
        </div>

        @if ($selectPage)
            <div class="col-md-10 mb-2">
                @if ($selectAll)
                    <kbd>You have selected all <strong>{{ count($checked) }}
                            Items.</strong></kbd>
                @else
                    <kbd>Bulk Select Detected:: Only<strong>{{ count($checked) }}</strong>
                        chosen, Would you like to select all
                        <strong>{{ $items->total() }} </strong> Items?</kbd>
                    <a wire:click="selectAll" class="btn btn-sm btn-primary">Select All</a>
                @endif
            </div>
        @endif

        <div class="table-responsive border">
            <table class="table mb-0 text-nowrap text-md-nowrap" style="border: 10px">
                <caption></caption>
                <thead>
                <tr class="bg-gray-300">
                    @if ($dragAndDrop)
                        <th scope="col"></th>
                    @endif
                    @if ($showCheckBox)
                        <th scope="col"><input wire:model="selectPage" type="checkbox"></th>
                    @endif
                    {{-- <th scope="col">S.N.</th> --}}
                    @foreach ($table as $title => $value)
                        <th scope="col">{{ $title }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody @if ($dragAndDrop) wire:sortable="updateDataOrder" @endif>
                @foreach ($items as $key => $item)
                    <tr class="@if ($this->isChecked($item->id)) table-primary @endif"
                        @if ($dragAndDrop) wire:sortable.item="{{ $item->id }}" wire:key="task-{{ $item->id }}" @endif>
                        @if ($dragAndDrop)
                            <td wire:sortable.handle style="width: 10px; cursor: move;"><em
                                    class="fa fa-arrows-alt text-muted"></em></td>
                        @endif
                        @if ($showCheckBox)
                            <td><input type="checkbox" class="form-checkbox" value="{{ $item->id }}"
                                       wire:model="checked"></td>
                        @endif
                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                        @foreach ($table as $title => $value)
                            <td
                                @if ($value['value'] == 'answer') style="white-space:normal; min-width: 200px" @endif>

                                @if (is_array($value) && is_array($value['value']))
                                    @if ($value['type'] == 'property')
                                        @php
                                            $props = array_reduce(
                                                $value['value'],
                                                function ($carry, $props) {
                                                    return $carry->$props ?? 'N/A';
                                                },
                                                $item,
                                            );
                                        @endphp
                                        {{ $props }}
                                    @elseif($value['type'] == 'include')
                                        @foreach ($value['value'] as $bladeName)
                                            @include($bladeName, [
                                                'indexUrl' => $indexUrl,
                                                'item' => $item,
                                                'key' => $key,
                                            ])
                                        @endforeach
                                    @else
                                        {{ isset($item->{$value[0]}) ? $item->{$value[0]} : 'N/A' }}
                                    @endif
                                @elseif(is_array($value) && !is_array($value['value']))
                                    {{ $item->{$value['value']} }}
                                @else
                                    {{ $item->{$value} }}
                                @endif

                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
                @if ($items->isEmpty())
                    <tr>
                        <td colspan="100%" class="text-center">No Data Available</td>
                    </tr>
                @endif
            </table>
        </div>
        <br>
        @include('system.layouts.partials.pagination')
        <br>
    </div>

    <style>
        .draggable-mirror {
            background-color: #43ee14;
            width: 1320px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(196, 16, 16, 0.05);
        }
    </style>
</div>
