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
		<!--div class="circle">
			<div class="camera">
				<img src="img/camera.png">
			</div>
			<div class="fiveD">
				<p>Un kit format din <br>Canon EOS 7D Mark II <br>+ 17-55mm + 70 300mm + <br> 430EX poate fi al tău!  </p>
			</div>
		</div-->
        <div class="bulina_noua">
            <img style="width: 400px" src="img/bulina_noua.png">
        </div>
	</a>

	<div style="position:absolute; top: 640px; width: 100%; text-align: center; ">
		<a class="red-button red-button-border" href="/register" > Înscrie-te!</a>
	</div>
@endsection

@section('javascript')
	<script type="text/javascript">
		var timeMin = 6000;
		var timeMax = 10000;

		$.fn.pulseSize = function(pulseTime, pulseDiffX, pulseDiffY, ratio)
		{
			this.animate({height:'+='+pulseDiffY, width:'+='+pulseDiffX, marginLeft:'-='+pulseDiffX/2, marginTop:'-='+pulseDiffY/2 },pulseTime*ratio,
				function(){
					$(this).animate( {height:'-='+pulseDiffY, width:'-='+pulseDiffX, marginLeft:'+='+pulseDiffX/2, marginTop:'+='+pulseDiffY/2},pulseTime *ratio,
						function(){
							var $this = $(this);
							setTimeout(
								function()
								{
									// debugger;
									$this.pulseSize(_.random(timeMin, timeMax), pulseDiffX, pulseDiffY, ratio)
								},
								1000
							);
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

			positionPopupImage('popImg1',230,578);
			positionPopupImage('popImg2',551,630);
			positionPopupImage('popImg3',1444,630);
			positionPopupImage('popImg4',634,883);
			positionPopupImage('popImg5',578,1036);
			positionPopupImage('popImg6',1613,736);
			positionPopupImage('popImg7',1761,988);
			positionPopupImage('popImg8',1408,1023);
			positionPopupImage('popImg9',1365,866);
			positionPopupImage('popImg10',345,958);
			positionPopupImage('popImg11',488,985);
			positionPopupImage('popImg12',298,1098);

			$("#popImg1").pulseSize(_.random(timeMin, timeMax), 50, 47, 0.2);
			$("#popImg2").pulseSize(_.random(timeMin, timeMax), 15, 15, 0.2);
			$("#popImg3").pulseSize(_.random(timeMin, timeMax), 10, 10, 0.2);
			$("#popImg4").pulseSize(_.random(timeMin, timeMax), 10, 10, 0.2);
			$("#popImg5").pulseSize(_.random(timeMin, timeMax), 30, 27, 0.2);
			$("#popImg6").pulseSize(_.random(timeMin, timeMax), 40, 40, 0.2);
			$("#popImg7").pulseSize(_.random(timeMin, timeMax), 50, 47, 0.2);
			$("#popImg8").pulseSize(_.random(timeMin, timeMax), 30, 30, 0.2);
			$("#popImg9").pulseSize(_.random(timeMin, timeMax), 10, 10, 0.2);
			$("#popImg10").pulseSize(_.random(timeMin, timeMax), 10, 10, 0.2);
			$("#popImg11").pulseSize(_.random(timeMin, timeMax), 25, 23, 0.2);
			$("#popImg12").pulseSize(_.random(timeMin, timeMax), 40, 40, 0.2);
			return true;
		});
	</script>
@endsection
