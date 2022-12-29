@extends('agency/layout')

@section('body')
	@yield('navigation', View::make('agency/partials/navigation'))
	@yield('content')
	@yield('footer', View::make('agency/partials/footer'))
@endsection