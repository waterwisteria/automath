@extends('agency/page')

@section('content')
	<section class="page-section">
		<div class="row m-5 p-5">
			@foreach($units as $k => $unit)
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">{{ $unit['title'] }}</h5>
							<p class="card-text">{{ $unit['description'] }}</p>
							<a href="{{ $unit['url'] }}" class="btn btn-primary">Practice</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</section>
@endsection