@extends('system.layouts.master')


@section('styles')
    <style>
        .card-new {
            background-color: #8b8383;
            border: 5px solid #38e45d;
        }

        .form-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            margin-bottom: 10px;
            padding: 5px;
        }

        .field-button label {
            margin-bottom: 0 !important;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 32px;
            width: 32px;
            left: 0;
            bottom: 1px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #38e45d;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #38e45d;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
@endsection

@section('content')

    <div class="content-display clearfix">
        <div class="panel">
            <div class="panel-box">
                @include('system.layouts.partials.message')
                @if( ($errors->first('alert-success') || $errors->first('alert-danger') || $errors->first('alert-warning')))
                @else
                    @if($errors->first('value'))
                        <div class="alert alert-danger" style="width: 100%;">
                            <p style="margin-bottom: 0px;">{{$errors->first('value')}}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </p>
                        </div>
                    @endif
                    @if($errors->first('delivery_pickup'))
                        <div class="alert alert-danger" style="width: 100%;">
                            <p style="margin-bottom: 0px;">{{$errors->first('delivery_pickup')}}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </p>
                        </div>
                    @endif
                @endif
            </div>
        </div>


        <div class="panel">
            <div class="panel-box">
                <div class="table-responsive">

                    {{--  boolean field --}}
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-3">Boolean Field</h6>
                        </div>
                        <div class="row">
                            @foreach($items as $key=>$item)
                                @if($item->isBoolean($item->type))
                                    <div class="col-sm-6">
                                        <form method="post" action="{{url($indexUrl.'/'.$item->id)}}"
                                              id="form{{$item->id}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-content">
                                                <div class="text-field ml-3">
                                                    <h6>{{str_contains($item->label, '_') ? ucwords(str_replace('_', ' ', $item->label)) : ucwords($item->label)}}</h6>
                                                </div>
                                                <div class="field-button mr-2">
                                                    <label class="switch">
                                                        <input type='checkbox' placeholder='Value' name='value'
                                                               onchange="submit()"
                                                               class='form-control'
                                                               @if($item->value) checked @endif>
                                                        <span class="slider round"></span>
                                                        <input type="hidden" name="dataFromCheckBox"
                                                               value="{{$item->value}}">
                                                    </label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                @endif
                            @endforeach

                        </div>
                    </div>


                    {{--  Input Field --}}
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-3">Input Field</h6>
                        </div>
                        <div class="row">
                            @forelse($items as $key=>$item)
                                @if($item->isText($item->type))
                                    <div class="col-sm-6">
                                        <form method="post" action="{{url($indexUrl.'/'.$item->id)}}"
                                              id="form{{$item->id}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-content">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text ml-2"
                                                          id="inputGroup-sizing-default">
                                                        {{str_contains($item->label, '_') ? ucwords(str_replace('_', ' ', $item->label)) : ucwords($item->label)}}
                                                    </span>

                                                    <input type='text' placeholder='Value' name='value'
                                                           value="{{$item->value}}"
                                                           onchange="submit()"
                                                           class='form-control mr-2' required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @empty
                                <h6 class="text-center">No Data Available</h6>
                            @endforelse
                        </div>
                    </div>


                    {{--  Input Field --}}
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-3">Image Field</h6>
                        </div>
                        <div class="row">
                            @forelse($items as $key=>$item)
                                @if($item->isFile($item->type))
                                    <div class="col-sm-6">
                                        <form method="post" action="{{url($indexUrl.'/'.$item->id)}}"
                                              id="form{{$item->id}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-content">
                                                <div class="text-field ml-3">
                                                    <h6>{{str_contains($item->label, '-') ? ucwords(str_replace('-', ' ', $item->label)) : ucwords($item->label)}}</h6>
                                                    @if ($item->label == "avatar" && isset($isRatioEnabled) && !!$isRatioEnabled)
                                                        <span
                                                            class="tx-danger"><small>{{str_replace('/', ':',$value)}}</small></span>
                                                    @endif
                                                </div>

                                                <div style="display:flex;">
                                                    <img src="{{ $item->url }}"
                                                         class="img-thumbnail mr-2"
                                                         alt="{{$item->value}}"
                                                         style="max-width:100px; max-height: 40px">
                                                    <div class="custom-file form-control mr-2">
                                                        <input type="file" class="custom-file-input"
                                                               name="value"
                                                               id="customFile{{$item->id}}"
                                                               onchange="submit()"
                                                               accept="image/*">
                                                        <label class="custom-file-label"
                                                               for="customFile{{$item->id}}">
                                                            Choose file
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @empty
                                <h6 class="text-center">No Data Available</h6>
                            @endforelse
                        </div>
                    </div>


                </div>
            </div><!-- panel -->
        </div><!-- panel -->
    </div><!-- panel -->

@endsection
