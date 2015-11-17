@extends('layouts.master')

@section('content')
	<div class="motto">
		<p>Donezi o poza</p>
		<p>implinesti un vis</p>
	</div>

    <div class="popup_img1" id="popImg1"></div>
    <div class="popup_img2" id="popImg2"></div>
    <div class="popup_img3" id="popImg3"></div>
    <div class="popup_img4" id="popImg4"></div>
    <div class="popup_img5" id="popImg5"></div>
    <div class="popup_img6" id="popImg6"></div>
	<div class="circle">
		<div class="camera">
			<img src="img/camera.png">
		</div>
		<div class="fiveD">
			<p>Inscrie-te in concurs si</p>
            <p>poti castiga echipament</p>
			<p><strong>Canon de 3000 &#8364;</strong></p>
		</div>
	</div>
@endsection

@section('javascript')
	<script type="text/javascript">
        $.fn.pulseSize = function() {
            var pulseTime = 2000,
                pulseDiff = 10;

            this.animate({height:'+='+pulseDiff,
                width:'+='+pulseDiff},pulseTime*.2,function(){
                $(this).animate({height:'-='+pulseDiff,
                    width:'-='+pulseDiff},pulseTime*.2,function(){
                    $(this).pulseSize();
                });
            });
        };

        $(document).ready(function()
        {
            function positionPopupImage(id,origX,origY, origW, origH){
                var img=$("#"+id);
                var w_width=$(window).width();
                var w_height=$(window).height();
                img.css('left',(w_width*origX)/2048)
                img.css('top',(w_height*origY)/1313)
                img.css('width',(w_width*origW)/2048)
                img.css('height',(w_height*origH)/1313)
            }

            positionPopupImage('popImg1',499,604,27,25)
            positionPopupImage('popImg2',708,840, 28,26)
            positionPopupImage('popImg3',1234,866, 13,14)
            positionPopupImage('popImg4',184,866, 26, 26)
            positionPopupImage('popImg5',1313,735, 52,53)
            positionPopupImage('popImg6',422,681, 52,54)
            $("#popImg1").pulseSize();
            $("#popImg2").pulseSize();
            $("#popImg3").pulseSize();
            $("#popImg4").pulseSize();
            $("#popImg5").pulseSize();
            $("#popImg6").pulseSize();
        });
	</script>
@endsection
