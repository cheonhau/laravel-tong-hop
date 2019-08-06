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
    <link rel="stylesheet" href="{{ asset('css/datatable.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection
@section('js_header')
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/datatable.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.js') }}"></script>
    <script src="//cdn.datatables.net/responsive/1.0.2/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('tinymce/tinymce_editor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript">
        editor_config.selector = "textarea.mceEditor";
        tinymce.init(editor_config);
        token = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
@section('content')
    <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
    <div class="row" id="page-wrapper">
        <div class="container">
            <div class="wrapper">
                <div class="ibox">
                    <div class="ibox-content">
                        <a class="btn btn-info pull-right" href="{{ URL::to('simple/create') }}">Create New</a>
                        <div class="clearfix"></div>
                        <div class="box-content">
                            <div class="clearfix"></div>
                            @include('_partial.notifications')
                            <div class="table-responsive">
                                <div class="clearfix"></div>
                                <table id="categorytable" class="table table-striped table-bordered table-hover" table-name="category">
                                    <thead>
                                        <tr>
                                            <th class="center" width="50">STT</th>
                                            <th class="center">Name</th>
                                            <th class="center">Note</th>
                                            <th class="center">Image</th>
                                            <th class="center" width="80">{{ Lang::get('table.edit') }}</th>
                                            <th class="center" width="80">{{ Lang::get('table.delete') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($simples as $key=>$item)
                                            <tr role="row" class="odd">
                                                <td class="center">{{ $key+1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{!! App\Services\SimpleService::_substr( strip_tags( $item->note ), 30 ); !!}</td>
                                                <td><img src="{{ asset('/') }}uploads/image/{{ $item->thumbnail }}" class="img_td_table"></td>
                                                
                                                <td class="center">
                                                    <a href="{{ URL::to('simple/edit') }}/{{ $item->id }}"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td class="center">
                                                    <a href="javascript:void(0);" class="btn-delete delete_simple" table="category" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection