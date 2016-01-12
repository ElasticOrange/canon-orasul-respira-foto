<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/favicon.ico">

        <title>Canon Pay with Photo - Admin panel</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('/admin/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('/admin/css/style.css') }}" rel="stylesheet" />

        <script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
        <script src="/js/vendor/jquery.lazyload.js"></script>
    </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/admin/index">Home</a></li>
                    <li><a href="/admin/votes">Voturi</a></li>
                    <li><a href="/admin/logout">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div><!-- /.container -->

  </body>
</html>
