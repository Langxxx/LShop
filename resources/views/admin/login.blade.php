<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>登陆</title>

    <!-- Bootstrap Core CSS -->
    {{--<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    {{--<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">--}}
    <link href="//cdn.bootcss.com/metisMenu/2.5.2/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/admin/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    {{--<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">--}}
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
    <script src="//cdn.bootcss.com/html5shiv/3.7.0/html5shiv-printshiv.min.js"></script>
    {{--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    {!! Form::open(['url' => '/admin/login']) !!}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <a onclick="$('form').submit()" class="btn btn-lg btn-success btn-block">Login</a>
                        </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
{{--<script src="../vendor/jquery/jquery.min.js"></script>--}}
<script src="//cdn.bootcss.com/jquery/3.1.1/jquery.slim.js"></script>
<!-- Bootstrap Core JavaScript -->
{{--<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>--}}
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
{{--<script src="../vendor/metisMenu/metisMenu.min.js"></script>--}}
<script src="//cdn.bootcss.com/metisMenu/2.5.2/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/js/admin/sb-admin-2.min.js"></script>

</body>

</html>
