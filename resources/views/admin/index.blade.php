@extends('admin.layout.main')
@section('title')
    -Index
@stop
@section('content')
    <div class="content_ch">
        Home Page
    </div>
@stop
@section('script')
    <script>
        var __seajs_debug = 1;
        seajs.use("/admin/js/app.js", function (app) {
            app.bootstrap();
            app.load('index/index');
        });

    </script>
@stop