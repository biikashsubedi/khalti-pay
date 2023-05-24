@extends('system.layouts.master')

@if(Auth::user()->role_id == 1)
    @if($current_file)
        @section('createButton')
            <div class="ml-auto">

                <button class="btn btn-success"
                        onclick="location.reload()">
                    <em class="fa fa-recycle"></em> {{translate('Refresh Page')}}
                </button>

                <button class="btn btn-info"
                        onclick="confirm('Are you sure, you want to Download File?', function(){
                        window.location='?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}'
                        }) || event.stopImmediatePropagation()">
                    <em class="fa fa-arrow-circle-down"></em> {{translate('Download File')}}
                </button>

                <button class="btn btn-danger" id="clean-log"

                        onclick="confirm('Are you sure, you want to Clean File?', function(){
                        window.location='?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}'
                        }) || event.stopImmediatePropagation()">

                    <em class="fa fa-shower"></em> {{translate('Clean File')}}
                </button>
                <button class="btn btn-pink" id="delete-log"
                        onclick="confirm('Are you sure, you want to Delete File?', function(){
                        window.location='?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}'
                        }) || event.stopImmediatePropagation()">
                    <em class="fa fa-trash-alt"></em> {{translate('Delete File')}}
                </button>
                @if(count($files) > 1)
                    <button class="btn btn-pink" id="delete-all-log"
                            onclick="confirm('Are you sure, you want to Delete All File?', function(){
                            window.location='?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}'
                            }) || event.stopImmediatePropagation()">
                        <em class="fa fa-trash-alt"></em> {{translate('Delete All File')}}
                    </button>
                @endif
            </div>
        @endsection
    @endif
@endif

@php
    $breadcrumbs = [[
            "title" => "Dashboard",
            "link" => route('home'),
        ], [
            "title" => "Log Viewer ",
            "link" => "/system/system-logs",
            "active" => true,
        ],];
$title = 'Log Viewer';
@endphp

@section('styles')
    <style>
        body {
            padding: 25px;
        }

        #table-log {
            font-size: 0.85rem;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <h4>Files</h4>
            <div class=" overflow-auto">
                <div class="list-group" style="max-height: 500px">
                    @foreach($files as $file)
                        <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
                           class="list-group-item @if ($current_file == $file) llv-active @endif">
                            <em class="fa fa-file"></em> {{$file}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-10 table-container">
            @if ($logs === null)
                <div>
                    Log file >50M, please download it.
                </div>
            @else
                <table id="table-log" class="table table-striped"
                       data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
                    <caption></caption>
                    <thead>
                    <tr>
                        @if ($standardFormat)
                            <th scope="col">Level</th>
                            <th scope="col">Context</th>
                            <th scope="col">Date</th>
                        @else
                            <th>Line number</th>
                        @endif
                        <th>Content</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($logs as $key => $log)
                        <tr data-display="stack{{{$key}}}">
                            @if ($standardFormat)
                                <td class="nowrap text-{{{$log['level_class']}}}">
                                    <span class="fa fa-{{{$log['level_img']}}}"
                                          aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                                </td>
                                <td class="text">{{$log['context']}}</td>
                            @endif
                            <td class="date">{{{$log['date']}}}</td>
                            <td class="text" style="white-space:normal;">
                                @if ($log['stack'])
                                    <button type="button"
                                            class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                                            data-display="stack{{{$key}}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                @endif
                                {{{$log['text']}}}
                                @if (isset($log['in_file']))
                                    <br/>{{{$log['in_file']}}}
                                @endif
                                @if ($log['stack'])
                                    <div class="stack" id="stack{{{$key}}}"
                                         style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection

@section('Scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function () {
            $('.table-container tr').on('click', function () {
                $('#' + $(this).data('display')).toggle();
            });
            $('#table-log').DataTable({
                "order": [$('#table-log').data('orderingIndex'), 'desc'],
                "stateSave": true,
                "stateSaveCallback": function (settings, data) {
                    window.localStorage.setItem("datatable", JSON.stringify(data));
                },
                "stateLoadCallback": function (settings) {
                    var data = JSON.parse(window.localStorage.getItem("datatable"));
                    if (data) data.start = 0;
                    return data;
                }
            });
            $('#delete-log, #clean-log, #delete-all-log').click(function () {
                return window.confirm('Are you sure?');
            });
        });
    </script>
@endsection
