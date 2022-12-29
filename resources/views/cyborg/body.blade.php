@extends('cyborg/layout')

@section('body')
	@yield('preloader', View::make('cyborg/partials/preloader'))
	@yield('header', View::make('cyborg/partials/header'))
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-content">
					@yield('page')
				</div>
			</div>
		</div>
	</div>
	@yield('footer', View::make('cyborg/partials/footer'))
@endsection