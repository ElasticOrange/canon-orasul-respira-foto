@extends('layouts.master')

@section('content')
	<div class="motto">
		<p>Tu ai pasiunea, prietenii îți oferă echipamentul.</p>
		<p class="normal-text" style="line-height: 27px; font-size: 20px;">Cu sprijinul lor, echipamentul foto mult visat poate fi al tău. Invită-ti prietenii să te ajute și fotografiile lor se transformă în puncte pentru tine.</p>
	</div>

	<a href="/register" style="cursor: pointer" class="bulina_noua_container">
		<div class="bulina_noua">
			<img style="width: 400px" src="img/bulina_noua.png">
		</div>
	</a>

	<div style="position:absolute; top: 640px; width: 100%; text-align: center; margin-bottom: 50px;">
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

			positionPopupImage('popImg1',230,378);
			positionPopupImage('popImg2',551,430);
			positionPopupImage('popImg3',1444,430);
			positionPopupImage('popImg4',634,683);
			positionPopupImage('popImg5',578,836);
			positionPopupImage('popImg6',1613,536);
			positionPopupImage('popImg7',1761,788);
			positionPopupImage('popImg8',1408,823);
			positionPopupImage('popImg9',1365,666);
			positionPopupImage('popImg10',345,758);
			positionPopupImage('popImg11',488,785);
			positionPopupImage('popImg12',298,898);

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
