
@extends('system.layouts.master')

@section('content')
    <br>
    <form action="{{route('payment.mode.config.store')}}" method="post">
        @csrf

        <div class="row row-sm">
            <div class="col-lg-6 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-1">SandBox for {{$item->title}}</h6>
                        </div>
                        <hr>
                        <div class="">
                            @forelse($fields as $field)
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="mg-b-0">{{ucwords(fromCamelCase($field))}}</label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input class="form-control"
                                               placeholder="Enter your {{ucwords(fromCamelCase($field))}}"
                                               name="sandbox[{{$field}}]"
                                               value="{{isset($sandbox) && isset($sandbox[$field]) ? $sandbox[$field] : ''}}"
                                               type="text">
                                    </div>
                                </div>
                            @empty
                                <div class="ml-4" style="margin-left: 60px; margin-top: 20px;">
                                    <h6 class="text-center">No any Product available</h6>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-1">Live for {{$item->title}}</h6>
                        </div>
                        <hr>
                        <div class="">
                            @forelse($fields as $field)
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="mg-b-0">{{ucwords(fromCamelCase($field))}}</label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input class="form-control"
                                               placeholder="Enter your {{ucwords(fromCamelCase($field))}}"
                                               name="live[{{$field}}]"
                                               value="{{isset($live) && isset($live[$field]) ? $live[$field] : ''}}"
                                               type="text">
                                    </div>
                                </div>
                            @empty
                                <div class="ml-4" style="margin-left: 60px; margin-top: 20px;">
                                    <h6 class="text-center">No any Product available</h6>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="pay_id" value="{{$item->id}}">

        <div class="" style="height: 45px">
            <div class="form-group row justify-content-end mb-0 text-right">
                <div class="col-md-12">
                    <button type="submit" class="btn ripple btn-primary pd-x-30 mg-l-5">Submit</button>
                    <a href="{{route('payment.index')}}"
                       class="btn ripple btn-secondary pd-x-30">Cancel</a>
                </div>
            </div>
        </div>
    </form>

@endsection

