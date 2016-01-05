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
                                <img src="{{generatePhotoURL('thumb_180',$profile->photo1)}}" />
                            @endif

                            @if ($profile->photo2)
                                <img src="{{generatePhotoURL('thumb_180',$profile->photo2)}}" />
                            @endif

                            @if ($profile->photo3)
                                <img src="{{generatePhotoURL('thumb_180',$profile->photo3)}}" />
                            @endif

                            @if ($profile->photo4)
                                <img src="{{generatePhotoURL('thumb_180',$profile->photo4)}}" />
                            @endif

                            @if ($profile->photo5)
                                <img src="{{generatePhotoURL('thumb_180',$profile->photo5)}}" />
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="/admin/approve-profile/{{ $profile->id }}" type="button" class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                    Aproba
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="/admin/disapprove-profile/{{ $profile->id }}" type="button" class="btn btn-danger">
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



@endsection
