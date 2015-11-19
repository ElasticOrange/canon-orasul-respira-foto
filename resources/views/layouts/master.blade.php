<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="apple-touch-icon" href="apple-touch-icon.png">
		<!-- Place favicon.ico in the root directory -->

		<link rel="stylesheet" href="/css/normalize.css">
		<link rel="stylesheet" href="/css/main.css">
		<link rel="stylesheet" href="/css/style.css">

        @yield('css')

        @yield('fbTags')
	</head>

	<body >
        <div style="position: fixed; width: 100%; height: 100%; top:0; left: 0; background: rgba(0,0,0,0.6); z-index: 9998; display: none;" id="overlay"></div>

		<div class="wrapper {{$selectedPage==0 ? 'wrapper1' : 'wrapper2'}}">
			<div class="layer"></div>		
			<div class="content">
				<div class="header">
					@include('partials.header')
				</div>

				<div class="main">
					@yield('content')
				</div>

				<div class="footer">
                    <div style="width: 740px; margin-left: auto; margin-right: auto;">
					@include('partials.footer')
                    </div>
				</div>
			</div>
		</div>

		<!-- Scripts -->
		<script src="/js/vendor/modernizr-2.8.3.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
		<script src="/js/plugins.js"></script>
		<script src="/js/main.js"></script>

		@yield('javascript')
		
		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>
            /*
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='https://www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','UA-XXXXX-X','auto');ga('send','pageview');
              */

            $(document).ready(function()
            {
                console.log('master');
                var mainWrapper = $(".wrapper").first();
                var mainLayer = $(".layer").first();
                var mainContent = $(".content").first();

                function scaleBG(){
                    var ws = $(window).width();
                    var hs = $(window).height();
                    var wi = 2048;
                    var hi = 1313;
                    var rs = ws/rs;
                    var ri = wi/ri;

                    var wnew = 0;
                    var hnew = 0;
                    if (rs>ri){
                        wnew = wi * hs/hi;
                        hnew = hs;
                    }
                    else{
                        wnew = ws;
                        hnew = hi * ws/wi;
                    }

                    mainWrapper.css('backgroundSize',wnew+"px "+hnew+"px");
                    mainWrapper.css('backgroundPositionX',(ws-wnew)/2)
                    mainWrapper.css('backgroundPositionY',(hs-hnew)/2)

                    mainWrapper.width(ws);
                    mainWrapper.height(hs);

                    mainContent.width(ws);
                    mainContent.height(hs);

                    mainLayer.width(ws);
                    mainLayer.height(hs);
                }
                scaleBG();

                $(window).resize(function(){
                    scaleBG();
                })
            })
		</script>
		<!-- /Scripts -->

	</body>
</html>
