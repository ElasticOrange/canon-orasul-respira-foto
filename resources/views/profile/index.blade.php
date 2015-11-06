@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="/css/lightbox/css/lightbox.css">
@endsection

@section('content')

<div class="content-wrapper" style="position: relative;">
    <div style="position: fixed; width: 700px; height: 500px; background-color: #cf2026; z-index: 9999; border: 1px dashed #ffffff; border-radius: 5px; display: none" id="infoModal">
        <p class="big-text" style="padding-top: 50px;">Ai donat o fotografie</p>
        <p class="normal-text" style="margin-top: 10px;">
            Fotograful tau preferat este acum mai aproape de echipamentul dorit <br>
            Aduna mai multe poze pentru el si ajuta-l sa castige<br><br>
            <strong>O poza primita = o sansa in plus ca el sa castige</strong>
        </p>
        <div style="margin-top: 30px; margin-bottom: 10px; width: 100%; text-align: center;">
            <a class="white-button" id="shareOnFacebook"> Share on facebook</a>
        </div>
        </p>
        <p class="normal-text">
            Sau distribuie linkul:
        <div style="margin-top: 30px; margin-bottom: 30px; width: 100%; text-align: center;">
            <span style="color: #ffffff; border: 1px dashed #ffffff; padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px;" >http://www.lorem.example.test/123/45/01.html</span>
        </div>
        </p>
        <div style="margin-top: 30px; margin-bottom: 30px; width: 100%; text-align: center;">
            <a class="white-button" href="/profile/clasament"> Portofolii </a>
        </div>
    </div>

    <div style="position: fixed; text-align: center; line-height: 500px; width: 700px; height: 500px; display: none; z-index: 9999;" id="loader">
        <img src="/img/loader.gif">
    </div>

    <div class="container-dotted-border" id="contentContainer">
        <div class="user-red-circle"></div>
        <img class="user-photo" src="/images/profilePhotos/thumb_100_{{md5($user->id)}}.jpg" >


        <p class="big-text" style="padding-top: 75px;">{{$user->name}}</p>

        <a class="red-button">Donatii stranse {{count($votes)}}</a>

        <p class="normal-text" style="margin-top: 30px;">Despre mine</p>

        <p class="normal-text" id="user-description" style="padding: 10px;" t>{{$profile->description}}</p>

        <p class="normal-text">Imagini portofoliu</p>

        <div style="text-align: center;">
            @for ($i = 0; $i < 3; $i++)
                @if (isset($photos[$i]))
                    <div class="wide-thumbnail photoRow1">
                        <a href="{{generatePhotoURL('full',$photos[$i])}}" data-lightbox="portofoliu" id="photo{{$i}}">
                            <img src="{{generatePhotoURL('thumb_180',$photos[$i])}}">
                        </a>

                        <a class="gallery-zoom" data-photo='photo{{$i}}'>
                            <img src="/img/search.png">
                        </a>
                    </div>
                @endif
            @endfor
            <div class="clearfix"></div>

            @for ($i = 3; $i < 5; $i++)
                @if (isset($photos[$i]))
                <div class="wide-thumbnail photoRow2">
                    <a href="{{generatePhotoURL('full',$photos[$i])}}" data-lightbox="portofoliu" id="photo{{$i}}">
                        <img src="{{generatePhotoURL('thumb_180',$photos[$i])}}">
                    </a>

                    <a class="gallery-zoom" data-photo='photo{{$i}}'>
                        <img src="/img/search.png">
                    </a>
                </div>
                @endif
            @endfor
            <div class="clearfix"></div>

        </div>

        <p class="big-text" style="font-size: 25px;">
            O fotografie urcata de tine reprezinta o sansa in plus
            pentru a-i indeplini visul, doneaza o fotografie aici
        </p>

        @if ($user->id != Auth::id())
            @if (!$voted)
                @if (Auth::user())
                    <div style="text-align: center; padding-top: 20px; padding-bottom: 20px;">
                        <a class="register-add-photo" data-field-id="1">
                            <img src="/img/add_photo.png" id="photoVote">
                            <img src="/img/remove_photo.png" data-field-id="1" id="removePhotoVote" class="register-remove-photo" style="display: none; z-index: 1000" />
                        </a>
                    </div>

                    <div style="display: none;">
                        <form id="upload-form-1">
                            <input type="file" id="file1" class="file-upload" data-field-id="1" name='image'>
                            <input type="hidden" name="profileId" value="{{$profile->id}}">
                        </form>
                    </div>

                    <div style="margin-top: 12px; margin-bottom: 30px; width: 100%; text-align: center;">
                        <a class="red-button red-button-border" id="vote"> Doneaza</a>
                    </div>
                @else
                    <div style="margin-top: 12px; margin-bottom: 30px; margin-top: 30px; width: 100%; text-align: center;">
                        <a class="red-button red-button-border" style="line-height: 30px;" href="{{$fbLink}}"><img src="/img/fb-logo.png" height="30px"> Login with Facebook </a>
                    </div>
                @endif
            @else
                <p class="normal-text" style="margin-top: 30px; margin-bottom: 30px;">{{$user->name}} iti multumeste pentru votul tau!</p>
            @endif
        @endif

        <p class="normal-text" style="margin-top: 30px; margin-bottom: 30px;">Donatii stranse {{count($votes)}}</p>

        <div style="text-align: center; margin-left: 10px; margin-bottom: 10px;">
        @foreach ($votes as $vote)
            <div class="wide-thumbnail vote-gallery">
                <a href="{{generatePhotoURL('full', $vote->photo, true)}}" data-lightbox="voturi" id="vote{{$vote->id}}">
                    <img src="{{generatePhotoURL('thumb_132', $vote->photo, true)}}">
                </a>

                <a class="gallery-zoom vote-gallery" data-photo='vote{{$vote->id}}'>
                    <strong>{{$vote->user->name}}</strong>
                </a>
            </div>
        @endforeach
            <div class="clearfix"></div>
        </div>

    </div>

</div>

@endsection

@section('javascript')
<script src="/js/vendor/lightbox.min.js"></script>

<script type="text/javascript">
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1059827974029585',
            xfbml      : true,
            version    : 'v2.4'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    $(document).ready(function()
    {
        console.log($("#contentContainer").width());
        console.log($(".photoRow1").length);
        $(".photoRow1").first().css("margin-left",($("#contentContainer").width()-$(".photoRow1").length*210)/2+15);
        $(".photoRow2").first().css("margin-left",($("#contentContainer").width()-$(".photoRow2").length*210)/2+15);
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })

        $(".gallery-zoom").click(function(e){
            e.preventDefault();
            $("#"+$(this).attr("data-photo")).trigger("click");
        });

        $(".register-add-photo").click(function(e){
            $("#file"+$(this).attr("data-field-id")).trigger("click");
        });

        $(".register-remove-photo").click(function(e){

            $.post( "/upload-image/remove-vote", { profileId: "{{$profile->id}}" }, function( data ) {
                if(data.message=="removed"){
                    $("#removePhotoVote").hide();
                    $("#photoVote").attr("src",'/img/add_photo.png');
                }
            }, "json");
            return false;
        });

        $('.file-upload').on( "change", function(){ upload( $(this).attr('data-field-id') ); } );

        function upload(field){
            console.log("submit event");
            var fd = new FormData(document.getElementById("upload-form-"+field));
            $.ajax({
                url: "/upload-image/vote",
                type: "POST",
                data: fd,
                enctype: 'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
                    if (data.message == 'created'){
                        $("#photoVote").attr("src",data.path);
                        $("#removePhotoVote").show();
                    }

                });
            return false;
        }

        $("#vote").click(function(e){
            showModal();
        });

        function showModal(){
            $("#overlay").css("display","block");
            $("#loader").css("display","block");
            $("#loader").css("left",$(window).width()/2-361);
            $("#loader").css("top", (634-$("#loader").height() )/2);

            console.log( $("#textarea-user-description").val() );
            $.post( "/profile/submit-vote", { profileId: "{{$profile->id}}" }, function( data ) {
                if(data.message=="validEntry"){
                    $("#loader").css("display","none");
                    $("#infoModal").css("display","block");
                    $("#infoModal").css("left",$(window).width()/2-361);
                    $("#infoModal").css("top", (634-$("#infoModal").height() )/2);
                }
            }, "json");
            return false;
        }

        $("#shareOnFacebook").click(function(e){
            e.preventDefault();
            FB.ui({
                method: 'share_open_graph',
                action_type: 'og.likes',
                action_properties: JSON.stringify({
                    object:'https://developers.facebook.com/docs/'
                })
            }, function(response){
                // Debug response (optional)
                console.log(response);
            });
        });
    });
</script>
@endsection