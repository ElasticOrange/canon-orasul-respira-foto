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
                        Nume
                    </th>
                    <th>
                        Vot pentru
                    </th>
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
                            {{ $vote->user->name }}
                        </td>
                        <td>
                            {{ $vote->profile->user->name }}
                        </td>
                        <td>
                            @if ($vote->photo)
                                <img data-original="{{ generatePhotoURL('thumb_132', $vote->photo, true) }}" width="132" data-lazyload="true" />
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="/admin/approve-vote/{{ $vote->id }}" type="button" data-httprequest="true" class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                    Aproba
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="/admin/disapprove-vote/{{ $vote->id }}" type="button" data-httprequest="true" class="btn btn-danger">
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
