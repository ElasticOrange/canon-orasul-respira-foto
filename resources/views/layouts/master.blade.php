<!doctype html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/style.css?date=2015120401"> @yield('css') @yield('fbTags')
</head>

<body class="wrapper {{$selectedPage==0 ? 'wrapper1' : 'wrapper2'}}">
    @include('partials.header')

    @if ($selectedPage == 0)
        <div class="popup_img_container">
            <div class="popup_img popup_img1" id="popImg1"></div>
            <div class="popup_img popup_img2" id="popImg2"></div>
            <div class="popup_img popup_img3" id="popImg3"></div>
            <div class="popup_img popup_img4" id="popImg4"></div>
            <div class="popup_img popup_img5" id="popImg5"></div>
            <div class="popup_img popup_img6" id="popImg6"></div>
            <div class="popup_img popup_img7" id="popImg7"></div>
            <div class="popup_img popup_img8" id="popImg8"></div>
            <div class="popup_img popup_img9" id="popImg9"></div>
            <div class="popup_img popup_img10" id="popImg10"></div>
            <div class="popup_img popup_img11" id="popImg11"></div>
            <div class="popup_img popup_img12" id="popImg12"></div>
        </div>
    @endif

    <div class="container">
        @yield('content')

        @if ($selectedPage==0)
            <div class="footer">
                <div class="regulament">
                    <a href="/pdf/Regulament.pdf" target="_blank">Regulament</a>
                </div>
                <div style="width: 740px; margin-left: auto; margin-right: auto;">
                     @include('partials.footer')
                </div>
            </div>
        @endif
    </div>

    <!-- Scripts -->
    <script src="/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/vendor/lodash.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')
    </script>
    <script src="/js/plugins.js"></script>
    <script src="/js/main.js"></script>

    @yield('javascript')

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-55513824-9', 'auto');
        ga('send', 'pageview');
    </script>


    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1059827974029585',
                xfbml      : true,
                version    : 'v2.4',
                cookie : true
            });

            FB.Canvas.setSize({height:600});

            setTimeout(
                function() {
                    FB.Canvas.setAutoGrow();
                },
                500
            );

        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- /Scripts -->

</body>

</html>
