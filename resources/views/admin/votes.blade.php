@extends('admin/layouts/master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>
                Voturi ce trebuie aprobate
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th>
                        <span class="glyphicon glyphicon-glyphicon glyphicon-picture" aria-hidden="true"></span>
                    </th>
                    <th class="col-md-3">
                        Actiuni
                    </th>
                </tr>
                @foreach($votes as $vote)
                    <tr>
                        <td>
                            @if ($vote->photo)
                                <img src="{{generatePhotoURL('thumb_132',$vote->photo, true)}}" />
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="/admin/approve-vote/{{ $vote->id }}" type="button" class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                    Aproba
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="/admin/disapprove-vote/{{ $vote->id }}" type="button" class="btn btn-danger">
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
