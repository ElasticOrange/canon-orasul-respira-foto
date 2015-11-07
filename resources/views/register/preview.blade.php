@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="/css/lightbox/css/lightbox.css">
@endsection

@section('content')

<div class="content-wrapper" style="position: relative;">
    <div style="position: fixed; width: 700px; height: 500px; background-color: #cf2026; z-index: 9999; border: 1px dashed #ffffff; border-radius: 5px; display: none" id="infoModal">
        <p class="big-text" style="padding-top: 50px;">Felicitari !</p>
        <p class="normal-text" style="margin-top: 10px;">
            Te-ai inscris in concurs si poti castiga echipament foto Canon <br>
            Promoveaza-ti portofoliul si aduna cat mai multe poze de la prieteni<br><br>
            <strong>O poza primita = o sansa in plus de a castiga</strong>

            <div style="margin-top: 30px; margin-bottom: 10px; width: 100%; text-align: center;">
                <a class="white-button" id="shareOnFacebook"> Share on facebook</a>
            </div>
        </p>
        <p class="normal-text">
            Sau distribuie linkul:
            <div style="margin-top: 30px; margin-bottom: 30px; width: 100%; text-align: center;">
                <span style="color: #ffffff; border: 1px dashed #ffffff; padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px;" >{{$redirectUrl}}</span>
            </div>
        </p>
        <div style="margin-top: 30px; margin-bottom: 30px; width: 100%; text-align: center;">
            <a class="white-button" href="/profile/index/{{$profile->id}}"> Profilul Meu</a>
        </div>
    </div>

    <div style="position: fixed; text-align: center; line-height: 500px; width: 700px; height: 500px; display: none; z-index: 9999;" id="loader">
        <img src="/img/loader.gif">
    </div>

    <p class="big-text">Inscrie-te in concurs si poti castiga echipament Canon in valoare de<br> <strong>3000 &#8364;</strong></p>

    <div class="container-dotted-border">
        <div class="user-red-circle"></div>
        <img class="user-photo" src="/images/profilePhotos/thumb_100_{{md5($user->id)}}.jpg" >
        
        <p class="big-text" style="padding-top: 75px;">{{$user->name}}</p>

        <a class="red-button">Donatii stranse 0</a>

        <p class="normal-text" style="margin-top: 30px;">Despre mine</p>

        <div style="text-align: right; width: 150px; float: right; margin-top: -20px; margin-right: 20px; cursor: pointer;" id="edit-user-description">
            <img src="/img/edit-description.png" style="margin-top: -6px;">
            <span style="color: #d00000; font-weight: bold;">EDIT TEXT</span>
        </div>

        <div style="text-align: right; width: 150px; float: right; margin-top: -20px; margin-right: 20px; cursor: pointer; display: none;" id="save-user-description">
            <img src="/img/edit-description.png" style="margin-top: -6px;">
            <span style="color: #d00000; font-weight: bold;">SAVE</span>
        </div>

        <p class="normal-text" id="user-description">{{$profile->description}}</p>

        <div class="register-description register-description-border" id="text-user-description" style="width: 680px; margin-left: 10px; display: none;">
            <textarea class="register-description" style="width: 670px;" id="textarea-user-description">{{$profile->description}}</textarea>
        </div>

        <p class="normal-text">Imagini portofoliu</p>

        <div style="text-align: center;">
            <div class="wide-thumbnail" style="margin-left: 50px">
                <a href="{{generatePhotoURL('full',$profile->photo1)}}" data-lightbox="portofoliu" id="photo1">
                    <img src="{{generatePhotoURL('thumb_180',$profile->photo1)}}">
                </a>

                <a class="gallery-zoom" data-photo='photo1'>
                    <img src="/img/search.png">
                </a>
            </div>

            <div class="wide-thumbnail">
                <a href="{{generatePhotoURL('full',$profile->photo2)}}" data-lightbox="portofoliu" id="photo2">
                    <img src="{{generatePhotoURL('thumb_180',$profile->photo2)}}">
                </a>

                <a class="gallery-zoom" data-photo='photo2'>
                    <img src="/img/search.png">
                </a>
            </div>

            <div class="wide-thumbnail">
                <a href="{{generatePhotoURL('full',$profile->photo3)}}" data-lightbox="portofoliu" id="photo3">
                    <img src="{{generatePhotoURL('thumb_180',$profile->photo3)}}">
                </a>

                <a class="gallery-zoom" data-photo='photo3'>
                    <img src="/img/search.png">
                </a>
            </div>

            <div class="clearfix"></div>

            <div class="wide-thumbnail" style="margin-left: 170px;">
                <a href="{{generatePhotoURL('full',$profile->photo4)}}" data-lightbox="portofoliu" id="photo4">
                    <img src="{{generatePhotoURL('thumb_180',$profile->photo4)}}">
                </a>

                <a class="gallery-zoom" data-photo='photo4'>
                    <img src="/img/search.png">
                </a>
            </div>

            <div class="wide-thumbnail">
                <a href="{{generatePhotoURL('full',$profile->photo5)}}" data-lightbox="portofoliu" id="photo5">
                    <img src="{{generatePhotoURL('thumb_180',$profile->photo5)}}">
                </a>

                <a class="gallery-zoom" data-photo='photo5'>
                    <img src="/img/search.png">
                </a>
            </div>

            <div class="clearfix"></div>

        </div>

        <div style="margin-top: 80px; margin-bottom: 150px; width: 100%; text-align: center;">
            <a class="red-button red-button-border" id="register"> Inscrie-te in concurs </a>
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
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })

            $(".gallery-zoom").click(function(e){
                e.preventDefault();
                $("#"+$(this).attr("data-photo")).trigger("click");
            });

            $("#edit-user-description").click(function(e){
                $("#user-description").hide();
                $("#edit-user-description").hide();
                $("#save-user-description").show();
                $("#text-user-description").show();
            });

            $("#save-user-description").click(function(e){
                $("#user-description").show();
                $("#edit-user-description").show();
                $("#save-user-description").hide();
                $("#text-user-description").hide();

                $("#user-description").html($("#textarea-user-description").val());
            });

            $("#register").click(function(e){
                showModal();
            });

            function showModal(){
                /*
                $('body').on('wheel.modal mousewheel.modal', function () {
                    return false;
                });
                */

                //$('body').off('wheel.modal mousewheel.modal');

                $("#overlay").css("display","block");
                $("#loader").css("display","block");
                $("#loader").css("left",$(window).width()/2-361);
                $("#loader").css("top", (634-$("#loader").height() )/2);

                console.log( $("#textarea-user-description").val() );
                $.post( "/register/submit-entry", { description: $("#textarea-user-description").val() }, function( data ) {
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
                FB.ui(
                    {
                        method: 'share',
                        href: '{{$pageUrl}}'
                    }, function(response){ console.log(response); });
            });
        });
    </script>
@endsection