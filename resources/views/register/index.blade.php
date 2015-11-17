@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <p class="headline">Tu ai pasiunea, prietenii îți oferă echipamentul.</p>
    <p class="normal-text">Înscrie-ți fotografiile, adună voturile prietenilor și poți câștiga un Canon EOS 7D Mark II, obiectivul de Canon EF-S 17-55mm f/2.8 USM IS, pentru cadre generale, și obiectivul Canon EF 70-300mm f/4-5.6 USM IS, pentru a surprinde acțiunea de oriunde ai fi.</strong></p>
    <p class="normal-text">
        Prietenii tăi știu deja cât de mult îți place să fotografiezi, iar acum au ocazia să te susțintă!
        Încarcă până la 5 fotografii din portofoliul tău, scrie-ne de ce te pasionează fotografia și apoi da sfară-n țară!
        Prietenii au un singur lucru de facut: să încarce în contul tău orice fotografie realizată de ei. Fotografiile încărcate se transformă în puncte pentru tine. Cu cât mai multe puncte strânse, cu atât mai multe șanse de a câștiga echipamentul visat.
    </p>
    <p class="normal-text">Aici încarci până la 5 poze cool pe care le-ai făcut oriunde, oricând, oricum.</p>

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
        <p class="normal-text">Spune-ne în câteva cuvinte de ce te pasionează fotografia:</p>
        <div class="register-description register-description-border">
            <textarea class="register-description" name="description" id="description"></textarea>
        </div>

        <p class="normal-text">Avem nevoie de numărul tău de telefon; nu te speria, nu te vom spama. Vrem să luăm legătura cu tine cât mai repede, în cazul în care câștigi.</p>
        <input type="text" class="register-phone" name="phone" id="phone">

        <p class="normal-text red-button" style="margin-top: 10px; margin-bottom: 10px; width: 660px; margin-left: auto; margin-right: auto; display: none;" id="registerFeedback"></p>
        <div class="clearfix"></div>

        <div style="margin-top: 80px; margin-bottom: 150px; width: 100%; text-align: center;">
            <a class="red-button red-button-border" id="submitExtraInfo"> Preview galeria ta</a>
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