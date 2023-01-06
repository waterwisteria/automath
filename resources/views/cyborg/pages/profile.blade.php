@extends('cyborg/body')

@section('page')
	<div class="row">
		<div class="col-lg-6">
			<div class="main-profile ">
				@include('cyborg/partials/profile/update-profile-information-form')
			</div>
		</div>
	
		<div class="col-lg-6">
			<div class="main-profile ">
				@include('cyborg/partials/profile/update-password-form')
			</div>
		</div>
	</div>
@endsection