@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <p class="register-teaser">Inscrie-te in concurs si poti castiga echipament Canon in valoare de<br> <strong>3000 &#8364;</strong></p>
    <p class="register-text">Lorem ipsum dolor sit amet, ne ridens ornatus reprimique vix, ius errem laudem accommodare ne, eum et soleat libris. Mea dolorum abhorreant necessitatibus id. Tale viderer eripuit nam at. An quot iusto qui. Mel rebum altera reprimique eu, nibh viderer sea ad, an vix case integre prompta.</p>
    <p class="register-text">Urca maxim 5 fotografii in portofoliul tau</p>

    <div style="text-align: center; padding-top: 20px; padding-bottom: 20px;">
        <a class="register-add-photo" data-field-id="1"> <img src="img/add_photo.png" id="photo1"> </a>
        <a class="register-add-photo" data-field-id="2"> <img src="img/add_photo.png" id="photo2"> </a>
        <a class="register-add-photo" data-field-id="3"> <img src="img/add_photo.png" id="photo3"> </a>
        <a class="register-add-photo" data-field-id="4"> <img src="img/add_photo.png" id="photo4"> </a>
        <a class="register-add-photo" data-field-id="5"> <img src="img/add_photo.png" id="photo5"> </a>
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

    <p class="register-text">Spune povestea ta</p>
    <div class="register-description register-description-border">
        <textarea class="register-description"></textarea>
    </div>

    <p class="register-text">Lasa-ne numarul tau de telefon</p>
    <input type="text" class="register-phone">
    <div style="margin-top: 80px; margin-bottom: 150px; width: 100%; text-align: center;">
        <a class="red-button"> Vezi cum arata profilul tau</a>
    </div>
</div>

@endsection

@section('javascript')
    <script type="text/javascript">


        $(document).ready(function()
        {
            $(".register-add-photo").click(function(e){
                $("#file"+$(this).attr("data-field-id")).trigger("click");
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
                        $("#photo1").attr("src",data.path);
                    }

                });
                return false;
            }
        });
    </script>
@endsection