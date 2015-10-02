@extends('layouts.master')

@section('content')
	<div class="imagesTitle">
		<p>Inscrie-ti fotografia in concurs</p>
	</div>

	<div class="imagesDesc">
		<p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum </p>
	</div>

	<div class="imagesPics">
		<?php 
			for($i=0; $i<3; ++$i)
				echo "
					<div class='imagesPic'>
						<div>
							<img src='/img/remove-image.png'>
						</div>
					</div>
					";
		?>
	</div>

	<a href="" class="preSignUp">
		<div>
			<p>Inscrie-te in concurs</p>
		</div>
	</a>
@endsection

@section('javascript')

@endsection