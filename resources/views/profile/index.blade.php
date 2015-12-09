@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="/css/lightbox/css/lightbox.css?date=2015120401">
@endsection

@section('fbTags')
<meta property="og:title" content="{{$user->name}}" />
<meta property="og:site_name" content="Canon Pay with Photo"/>
<meta property="og:url" content="{{URL::to('/profile/index/'.$profile->id)}}" />
<meta property="og:description" content="{{$profile->description}}" />
<meta property="fb:app_id" content="1059827974029585" />
<meta property="og:type" content="article" />
<meta property="og:image" content="{{URL::to(generatePhotoURL('full',$photos[0]))}}" />
@endsection

@section('content')

<div class="content-wrapper" style="position: relative;">
    <div style="position: fixed; width: 700px; height: 500px; background-color: #cf2026; z-index: 9999; border: 1px dashed #ffffff; border-radius: 5px; display: none" id="infoModal">
        <p class="big-text" style="padding-top: 50px;">Ai donat o fotografie</p>
        <p class="normal-text" style="margin-top: 10px;">
            Fotografia ta a fost încărcată!<br>
            Datorită ție, prietenul tău este mai aproape de a câstiga echipamentul visat.
            <br>Convinge-ți și alți prieteni să îl susțină!
        </p>
        <div style="margin-top: 30px; margin-bottom: 10px; width: 100%; text-align: center;">
            <a class="white-button shareOnFacebook"> Share on facebook</a>
        </div>
        </p>
        <p class="normal-text">
            Sau distribuie linkul:
        <div style="margin-top: 30px; margin-bottom: 30px; width: 100%; text-align: center;">
            <span style="color: #ffffff; border: 1px dashed #ffffff; padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px;" >{{$profile->shortLink}}</span>
        </div>
        </p>
        <div style="margin-top: 30px; margin-bottom: 30px; width: 100%; text-align: center;">
            <a class="white-button" href="/profile/clasament"> Portofolii </a>
        </div>
    </div>

    <div style="position: fixed; text-align: center; line-height: 500px; width: 700px; height: 500px; display: none; z-index: 9999;" id="loader">
        <img src="/img/loader.gif">
    </div>

    <div class="headline">Încarcă o fotografie pentru prietenul tău și ajută-l să câștige echipamentul pe care și-l dorește! </div>

    <div class="container-dotted-border" id="contentContainer">
        <div class="user-red-circle"></div>
        <img class="user-photo" src="/images/profilePhotos/thumb_100_{{md5($user->id)}}.jpg" >


        <p class="big-text" style="padding-top: 75px;">{{$user->name}}</p>

        <div class="clearfix"></div>
        <div style="margin-top: 10px;">
            <a class="red-button">Fotografii din partea prietenilor  {{count($votes)}}</a>
        </div>

        <p class="normal-text" style="margin-top: 30px;">Despre mine</p>

        <p class="normal-text" id="user-description" style="padding: 10px;">{{$profile->description}}</p>

        <p class="normal-text">Fotografiile mele</p>

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

        @if ($user->id != Auth::id())
            @if (!$voted)
                @if (Auth::user())
                    <p class="big-text" style="font-size: 25px;">
                        Încarcă aici o fotografie pentru prietenul tău
                    </p>

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

                    <p class="normal-text red-button" style="margin-top: 10px; margin-bottom: 10px; width: 660px; margin-left: auto; margin-right: auto; display: none;" id="voteFeedback"></p>
                    <div class="clearfix"></div>
                    <div style="margin-top: 12px; margin-bottom: 30px; width: 100%; text-align: center;">
                        <a class="red-button red-button-border" id="vote"> Susține-l cu o fotografie</a>
                    </div>
                @else
                    <div style="margin-top: 12px; margin-bottom: 30px; margin-top: 30px; width: 100%; text-align: center;">
                        <a class="red-button red-button-border" style="line-height: 30px;" href="{{$fbLink}}" id="login-fb-js"><img src="/img/fb-logo.png" height="30px"> Login with Facebook </a>
                    </div>
                @endif
            @else
                <p class="normal-text" style="margin-top: 30px; margin-bottom: 30px;">{{$user->name}} iti multumeste pentru votul tau!</p>
            @endif
        @else

        @endif

        <div style="margin-top: 30px; margin-bottom: 10px; width: 100%; text-align: center;">
            <a class="white-button shareOnFacebook"> Share on facebook</a>
        </div>
        <p class="normal-text">
            Sau distribuie linkul:
            <div style="margin-top: 30px; margin-bottom: 30px; width: 100%; text-align: center;">
                <span style="color: #ffffff; border: 1px dashed #ffffff; padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px;" >{{$profile->shortLink}}</span>
            </div>
        </p>

        <p class="normal-text" style="margin-top: 30px; margin-bottom: 30px;">Galerie foto susținători ({{count($votes)}})</p>

        <div style="text-align: center; margin-left: 10px; margin-bottom: 10px;">
        @foreach ($votes as $vote)
            <div class="wide-thumbnail vote-gallery">
                <a href="{{generatePhotoURL('full', $vote->photo, true)}}" data-lightbox="voturi" id="vote{{$vote->id}}">
                    <img src="{{generatePhotoURL('thumb_132', $vote->photo, true)}}">
                </a>

                <a class="vote-gallery gallery-zoom" data-photo='vote{{$vote->id}}'>
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
        var addedPhoto=false;

        $('#login-fb-js').click(function(){
            FB.login(function(response) {
                //window.location.replace("/facebook/js-callback");
            }, {scope: 'email'});
        });

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
                    $("#photoVote").attr("src",'/img/add_photo.png').removeClass("photo-border");
                    addedPhoto=false;
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
                        addedPhoto=true;
                        $("#photoVote").attr("src",data.path).addClass("photo-border");
                        $("#removePhotoVote").show();
                        $("#voteFeedback").html("").hide();
                    }
                });
            return false;
        }

        $("#vote").click(function(e){
            if ( addedPhoto ){
                showModal();
            }
            else{
                $("#voteFeedback").html("Pentru a vota trebuie sa urci o fotografie").show();
            }

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

        $(".shareOnFacebook").click(function(e){
            e.preventDefault();
            FB.ui({
                method: 'share_open_graph',
                action_type: 'og.likes',
                action_properties: JSON.stringify({
                    object:'{{$pageUrl}}'
                })
            }, function(response){
                // Debug response (optional)
                console.log(response);
            });
        });
    });
</script>
@endsection