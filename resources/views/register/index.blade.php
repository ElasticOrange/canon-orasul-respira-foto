@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <p class="big-text">Inscrie-te in concurs si poti castiga echipament Canon in valoare de<br> <strong>3000 &#8364;</strong></p>
    <p class="normal-text">Lorem ipsum dolor sit amet, ne ridens ornatus reprimique vix, ius errem laudem accommodare ne, eum et soleat libris. Mea dolorum abhorreant necessitatibus id. Tale viderer eripuit nam at. An quot iusto qui. Mel rebum altera reprimique eu, nibh viderer sea ad, an vix case integre prompta.</p>
    <p class="normal-text">Urca maxim 5 fotografii in portofoliul tau</p>

    <div style="text-align: center; padding-top: 20px; padding-bottom: 20px;">
        <a class="register-add-photo" data-field-id="1">
            <img src="/img/add_photo.png" id="photo1">
            <img src="/img/remove_photo.png" data-field-id="1" id="remove1" class="register-remove-photo" style="display: none" />
        </a>
        <a class="register-add-photo" data-field-id="2">
            <img src="/img/add_photo.png" id="photo2">
            <img src="/img/remove_photo.png" data-field-id="2" id="remove2" class="register-remove-photo" style="display: none" />
        </a>
        <a class="register-add-photo" data-field-id="3">
            <img src="/img/add_photo.png" id="photo3">
            <img src="/img/remove_photo.png" data-field-id="3" id="remove3" class="register-remove-photo" style="display: none" />
        </a>
        <a class="register-add-photo" data-field-id="4">
            <img src="/img/add_photo.png" id="photo4">
            <img src="/img/remove_photo.png" data-field-id="4" id="remove4" class="register-remove-photo" style="display: none" />
        </a>
        <a class="register-add-photo" data-field-id="5">
            <img src="/img/add_photo.png" id="photo5">
            <img src="/img/remove_photo.png" data-field-id="5" id="remove5" class="register-remove-photo" style="display: none" />
        </a>
    </div>

    <div style="display: none;">
        <form id="upload-form-1">
            <input type="file" id="file1" class="file-upload" data-field-id="1" name='image'>
            <input type="hidden" name="imageId" value="1">
        </form>
        <form id="upload-form-2">
            <input type="file" id="file2" class="file-upload" data-field-id="2" name='image'>
            <input type="hidden" name="imageId" value="2">
        </form>
        <form id="upload-form-3">
            <input type="file" id="file3" class="file-upload" data-field-id="3" name='image'>
            <input type="hidden" name="imageId" value="3">
        </form>
        <form id="upload-form-4">
            <input type="file" id="file4" class="file-upload" data-field-id="4" name='image'>
            <input type="hidden" name="imageId" value="4">
        </form>
        <form id="upload-form-5">
            <input type="file" id="file5" class="file-upload" data-field-id="5" name='image'>
            <input type="hidden" name="imageId" value="5">
        </form>
    </div>

    <form action="/register/save-info" method="post" id="form-info">
        <p class="normal-text">Spune povestea ta</p>
        <div class="register-description register-description-border">
            <textarea class="register-description" name="description" id="description"></textarea>
        </div>

        <p class="normal-text">Lasa-ne numarul tau de telefon</p>
        <input type="text" class="register-phone" name="phone" id="phone">

        <p class="normal-text red-button" style="margin-top: 10px; margin-bottom: 10px; width: 660px; margin-left: auto; margin-right: auto; display: none;" id="registerFeedback"></p>
        <div class="clearfix"></div>

        <div style="margin-top: 80px; margin-bottom: 150px; width: 100%; text-align: center;">
            <a class="red-button red-button-border" id="submitExtraInfo"> Vezi cum arata profilul tau</a>
        </div>
    </form>
</div>

@endsection

@section('javascript')
    <script type="text/javascript">
        var uploadCount=0;

        $(document).ready(function()
        {
            $(".register-add-photo").click(function(e){
                $("#file"+$(this).attr("data-field-id")).trigger("click");
            });

            $("#submitExtraInfo").click(function(e){
                if (uploadCount <= 0){
                    $("#registerFeedback").html("Trebuie sa urci minim o fotografie").show();
                    return false;
                }
                if ($("#description").val()==""){
                    $("#registerFeedback").html("Trebuie sa ne spui povestea ta").show();
                    return false;
                }
                if ($("#phone").val()==""){
                    $("#registerFeedback").html("Trebuie sa ne lasi numarul de telefon pentru a  te contacta").show();
                    return false;
                }

                $("#form-info").submit();
            });

            $(".register-remove-photo").click(function(e){
                $.post( "/upload-image/remove", { imageId: $(this).attr("data-field-id") }, function( data ) {
                    if(data.message=="removed"){
                        $("#remove"+data.imageId).hide();
                        $("#photo"+data.imageId).attr("src",'img/add_photo.png').removeClass("photo-border");
                        uploadCount--;
                    }
                }, "json");
                return false;
            });

            $('.file-upload').on( "change", function(){ upload( $(this).attr('data-field-id') ); } );

            function upload(field){
                console.log("submit event");
                var fd = new FormData(document.getElementById("upload-form-"+field));
                $.ajax({
                    url: "/upload-image",
                    type: "POST",
                    data: fd,
                    enctype: 'multipart/form-data',
                    processData: false,  // tell jQuery not to process the data
                    contentType: false   // tell jQuery not to set contentType
                }).done(function( data ) {
                    if (data.message == 'created'){
                        $("#photo"+data.imageId).attr("src",data.path).addClass("photo-border");
                        $("#remove"+data.imageId).show();
                        uploadCount++;
                    }

                });
                return false;
            }
        });
    </script>
@endsection