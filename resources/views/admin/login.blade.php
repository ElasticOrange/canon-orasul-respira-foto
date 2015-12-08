@extends('admin/layouts/master')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form class="form-signin" action="/admin/login" method="post">
            <h2 class="form-signin-heading">Trebuie sa te loghezi</h2>

            <div class="form-group">
                <label for="inputEmail" class="">Adresa de email</label>
                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="">Parola</label>
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
    </div>
</div>

@endsection
