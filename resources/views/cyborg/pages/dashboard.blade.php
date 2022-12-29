@extends('cyborg/body')

@section('page')
		@include('cyborg/partials/dashboard')
		@include('cyborg/partials/pending-quizzes')
		@include('cyborg/partials/best-quizzes')
@endsection