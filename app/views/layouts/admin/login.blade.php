<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Control Panel - {{ Config::get('site.sitename') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/template.css" rel="stylesheet">
    @yield('css_head')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    @yield('js_head')
</head>

<body>

<div class="container">

    <div class="col-xs-12 col-sm-9">
        <!-- will be used to show any messages -->
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
    </div><!--/span-->

    @yield('content')

</div> <!-- /container -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js-libraries/jquery-1.10.2.min.js"></script>
<script src="/js-libraries/bootstrap.min.js"></script>
@yield('js_foot')
</body>
</html>