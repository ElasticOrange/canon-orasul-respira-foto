@extends('layouts.master')

@section('content')
	<div style="margin-top: 220px;  width: 100%; text-align: center;">
		<a class="red-button red-button-border" style="line-height: 30px;" href="{{$fbLink}}" id="login-fb-js"><img src="/img/fb-logo.png" height="30px"> Login with Facebook </a>
	</div>
@endsection

@section('javascript')
<script>
$(document).ready(function(){
	$('#login-fb-js').click(function(){
		FB.login(function(response) {
			// handle the response
		}, {scope: 'email'});
	});
});
</script>
@endsection
