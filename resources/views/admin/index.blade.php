@extends('admin/layouts/master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Statistici</h2>
            <h3>Profile active: {{ $total_active_profiles }}</h3>
            <h3>Voturi active: {{ $total_active_votes }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h1>
                Profile ce trebuie aprobate
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th>
                        Nume
                    </th>
                    <th>
                        Descriere
                    </th>
                    <th>
                        <span class="glyphicon glyphicon-glyphicon glyphicon-picture" aria-hidden="true"></span>
                    </th>
                    <th class="col-md-3">
                        Actiuni
                    </th>
                </tr>
                @foreach($profiles as $profile)
                    <tr>
                        <td>
                            {{ $profile->user->name }}
                        </td>
                        <td>
                            {{ $profile->description }}
                        </td>
                        <td>
                            @if ($profile->photo1)
                                <img data-original="{{generatePhotoURL('thumb_180',$profile->photo1)}}" width="180" data-lazyload="true" />
                            @endif

                            @if ($profile->photo2)
                                <img data-original="{{generatePhotoURL('thumb_180',$profile->photo2)}}" width="180" data-lazyload="true" />
                            @endif

                            @if ($profile->photo3)
                                <img data-original="{{generatePhotoURL('thumb_180',$profile->photo3)}}" width="180" data-lazyload="true" />
                            @endif

                            @if ($profile->photo4)
                                <img data-original="{{generatePhotoURL('thumb_180',$profile->photo4)}}" width="180" data-lazyload="true" />
                            @endif

                            @if ($profile->photo5)
                                <img data-original="{{generatePhotoURL('thumb_180',$profile->photo5)}}" width="180" data-lazyload="true" />
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="/admin/approve-profile/{{ $profile->id }}" data-httprequest="true" type="button" class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                    Aproba
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="/admin/disapprove-profile/{{ $profile->id }}" data-httprequest="true" type="button" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Ascunde
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-httprequest=true]').click(function(e){
        e.preventDefault();

        var $current_row = $(this).closest('tr');
        $current_row.addClass('info');

        $.ajax(
            $(this).attr('href'),
            {
                complete: function(s, t){
                    if (t === "success" && s.status === 200) {
                        $current_row.hide();
                    }
                }
            }
        );
    });

    $('[data-lazyload=true]').lazyload();
});
</script>

@endsection
