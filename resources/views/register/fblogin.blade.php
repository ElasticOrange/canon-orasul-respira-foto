@extends('layouts.master')

@section('content')
	<div style="margin-top: 220px;  width: 100%; text-align: center;">
		<a class="red-button red-button-border" style="line-height: 30px;" id="login-fb-js"><img src="/img/fb-logo.png" height="30px"> Login with Facebook </a>
	</div>
@endsection

@section('javascript')
<script>
$(document).ready(function(){
	$('#login-fb-js').click(function(){
		FB.login(function(response) {
            if (response.authResponse) {
                var access_token = response.authResponse.accessToken;
                window.location.replace("/facebook/js-callback/"+access_token);
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
		}, {scope: 'email'});
	});
});
</script>
@endsection
