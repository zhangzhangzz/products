<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台大布局 - Layui</title>
    <!-- <link rel="stylesheet" href="./static/admin/layui/css/layui.css"> -->
    <link rel="stylesheet" href="{{ asset('static/admin/layui/css/layui.css') }}">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('static/admin/layui/layui.js') }}"></script>
    <style>
        .errors{
            width: 100%;
            color:white;
            text-align: center;
            font-size: 15px;
            background-color: red;
            border: 1px solid red;
        }
        .error{
            color:green;
        }
    </style>
    <script>
        $(function () {
            $(".errors").fadeToggle(10000);
        });
    </script>
</head>
@yield('css')
<body class="layui-layout-body">
@include("admin.template._header")

@include("admin.template._menu")

<div class="layui-body">
    <!-- 内容主体区域 -->
    <div>

    @yield('content')


    <!-- <iframe src="__HTML_ADMIN__/view/index/main1.html" frameborder="0"></iframe> -->
    </div>
</div>

</div>
@include("admin.template._footer")
</body>
@yield('js')
</html>
