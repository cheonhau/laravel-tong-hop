@extends('frontend')
@section('description')
    A simple front end
@endsection
@section('keywords')
    A keyword for web
@endsection
@section('title_meta')
    A title meta for ceo web
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/clockpicker.css') }}">
    <link rel="stylesheet" href="http://cdn.datatables.net/responsive/1.0.2/css/dataTables.responsive.css"/>
@endsection
@section('js_header')
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.js') }}"></script>
    <script src="//cdn.datatables.net/responsive/1.0.2/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('tinymce/tinymce_editor.js') }}"></script>
    <script type="text/javascript">
        editor_config.selector = "textarea.mceEditor";
        tinymce.init(editor_config);
    </script>
    <script type="text/javascript" src="{{ asset('js/datepicker3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/clockpicker.js') }}"></script>
    <script src="{{ asset('js/simple.js') }}"></script>
@endsection
@section('content')
    <div class="row" id="page-wrapper">
        <div class="container">
            <div class="wrapper">
                <div class="ibox">
                    <div class="ibox-content">
                        <a class="btn btn-info pull-right" href="{{ URL::to('simple') }}">Back</a>
                        <div class="clearfix"></div>
                        <div class="box-content">
                            <div class="clearfix"></div>
                            <div class="table-responsive form_simple">
                                @include('_partial.notifications')
                                <div class="clearfix"></div>
                                <form action="create" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Your Name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', '') }}">
                                            @if ( $errors->has('name') )
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image" value="{{ old('image', '') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="video">Video</label>
                                            <input type="file" name="video" id="video" value="{{ old('video', '') }}">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group form-date">
                                        <div class="col-sm-2"><label for="">Start Date</label></div>
                                        <div class="clearfix"></div>
                                        <div class="col-sm-6 js-schedule-date" id="js-start-date">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input name="from_date" type="text" class="form-control js-start-date js-only-number" value="{{ old('from_date', '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group clockpicker" data-autoclose="true">
                                                <input name="from_hour" type="text" class="form-control js-nokeyboard" value="{{ old('from_hour', '00:00') }}">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="is_schedule_end_date">End Date </label>
                                            <input type="checkbox" name="is_schedule_end_date" id="is_schedule_end_date" value="1">
                                        </div>
                                    </div>
                                    <div class="form-group  form-date">
                                        <div class="clearfix"></div>
                                        <div class="col-sm-6 js-schedule-date" id="js-end-date">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input name="to_date" type="text" class="form-control js-end-date js-only-number" value="{{ old('to_date', '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group clockpicker" data-autoclose="true">
                                                <input name="to_hour" type="text" class="form-control js-nokeyboard" value="{{ old('to_hour', '00:00') }}">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" id="note" cols="30" rows="10" class="mceEditor">{{ old('note', '00:00') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12"><input type="submit" value="Create" class="btn btn-success"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection