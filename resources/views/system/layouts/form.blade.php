@extends('system.layouts.master')
@yield('extraStyle')
@section('customStyle')
    <link href="{{asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---datepicker css-->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
    <link href="{{asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>

    <style>
        .ck-editor__editable {
            min-height: 150px !important;
        }

        .form-control {
            color: black;
        }

        .form-control:focus {
            color: black;
        !important;
        }
    </style>
@endsection

@section('content')
    <div class="content-display clearfix custom-border">
        <div class="panel panel-default custom-padding">
            <div class="panel-body">
                <div class="card custom-card">
                    <div class="card-body">
                        @include('system.layouts.partials.message')
                        <form method="post" action="{{isset($item) ? url($indexUrl.'/'.$item->id) : url($indexUrl)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @if(isset($item))
                                @method('PUT')
                            @endif
                            @yield('inputs')
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary"
                                            onclick="this.disabled=true;this.form.submit();">
                                        <em class="fa fa-plus-circle"
                                           aria-hidden="true"></em> {{ !isset($item) ? 'Create' : 'Update'}}
                                    </button>
                                    <a href="{{url($indexUrl)}}" class="btn btn-secondary">
                                        <em class="far fa-window-close"></em> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- panel -->
    </div><!-- ends content-display -->
    @endsection
    @yield('scripts')
