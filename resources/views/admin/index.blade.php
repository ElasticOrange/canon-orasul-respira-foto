@extends('admin/layouts/master')

@section('content')
    <div class="row">
        <div class="col-m-12">
            <h1>
                Profile ce trebuie aprobate
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-m-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th>
                        Descriere
                    </th>
                    <th>
                        Poze
                    </th>
                    <th>
                        Actiuni
                    </th>
                </tr>
                @foreach($profiles as $profile)
                    <tr>
                        <td>
                            {{ $profile->description }}
                        </td>
                        <td>
                            {{ $profile->photo1 }}
                            {{ $profile->photo2 }}
                            {{ $profile->photo3 }}
                            {{ $profile->photo4 }}
                            {{ $profile->photo5 }}
                        </td>
                        <td>
                            no way
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>



@endsection
