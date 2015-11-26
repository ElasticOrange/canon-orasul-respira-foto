@extends('layouts.master')

@section('content')
	<div class="motto">
		<p>Tu ai pasiunea, prietenii îți oferă echipamentul.</p>
        <p class="normal-text" style="line-height: 27px; font-size: 20px;">Cu sprijinul lor, echipamentul foto mult visat poate fi al tău. Invită-ti prietenii să te ajute și fotografiile lor se transformă în puncte pentru tine.</p>
	</div>

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

    <a href="/register" style="cursor: pointer">
        <div class="circle">
            <div class="camera">
                <img src="img/camera.png">
            </div>
            <div class="fiveD">
                <p>Un kit format din <br>Canon EOS 7D Mark II <br>+ 17-55mm + 70 300mm + <br> 430EX poate fi al tău!  </p>
            </div>
        </div>
    </a>

    <div style="position:absolute; top: 580px; width: 100%; text-align: center; ">
        <a class="red-button red-button-border" href="/register" > Înscrie-te!</a>
    </div>
@endsection

@section('javascript')
    <script src="/js/vendor/jquery.pulse.min.js"></script>

	<script type="text/javascript">
        $.fn.pulseSize = function(pulseTime, pulseDiffX, pulseDiffY, ratio) {
            this.animate({height:'+='+pulseDiffY, width:'+='+pulseDiffX, marginLeft:'-='+pulseDiffX/2, marginTop:'-='+pulseDiffY/2 },pulseTime*ratio,
                function(){
                    $(this).animate( {height:'-='+pulseDiffY, width:'-='+pulseDiffX, marginLeft:'+='+pulseDiffX/2, marginTop:'+='+pulseDiffY/2},pulseTime *ratio,
                        function(){
                            $(this).pulseSize(pulseTime, pulseDiffX, pulseDiffY, ratio);
                        }
                    );
                }
            );
        };

        $(document).ready(function()
        {
            console.log('index');
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

            function positionPopupImage(id,origX,origY){
                var img=$("#"+id);
                img.css('left',(wnew*origX/wi)+(ws-wnew)/2);
                img.css('top',(hnew*origY/hi)+(hs-hnew)/2)
            }

            positionPopupImage('popImg1',630,578);
            positionPopupImage('popImg2',551,630);
            positionPopupImage('popImg3',1444,630);
            positionPopupImage('popImg4',634,683);
            positionPopupImage('popImg5',578,736);
            positionPopupImage('popImg6',1313,736);
            positionPopupImage('popImg7',761,788);
            positionPopupImage('popImg8',1208,823);
            positionPopupImage('popImg9',1365,866);
            positionPopupImage('popImg10',945,958);
            positionPopupImage('popImg11',788,985);
            positionPopupImage('popImg12',998,998);

            $("#popImg1").pulseSize(10000, 50, 47, 0.2);
            $("#popImg2").pulseSize(6000, 15, 15, 0.2);
            $("#popImg3").pulseSize(5000, 10, 10, 0.2);
            $("#popImg4").pulseSize(4000, 10, 10, 0.2);
            $("#popImg5").pulseSize(8000, 30, 27, 0.2);
            $("#popImg6").pulseSize(8000, 40, 40, 0.2);
            $("#popImg7").pulseSize(10000, 50, 47, 0.2);
            $("#popImg8").pulseSize(6000, 30, 30, 0.2);
            $("#popImg9").pulseSize(5000, 10, 10, 0.2);
            $("#popImg10").pulseSize(4000, 10, 10, 0.2);
            $("#popImg11").pulseSize(10000, 25, 23, 0.2);
            $("#popImg12").pulseSize(8000, 40, 40, 0.2);
            return true;
        });
	</script>
@endsection
