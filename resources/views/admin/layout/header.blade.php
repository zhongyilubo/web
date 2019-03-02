<head>
    <meta charset="utf-8">
    <title>租客管理后台@yield('title')
    </title>
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="/admin/css/style-min.css">
    <link rel="stylesheet" href="https://at.alicdn.com/t/font_904289_101i8t6l9zn.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/admin/css/theme.css">
    <link rel="stylesheet" href="/admin/css/flex.css">
    <link rel="stylesheet" href="/admin/css/ModifyNew.css">
    <script src="/vendor/seajs/1.3.1/sea.js" id="seajsnode"></script>
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    @yield('style')
</head>
