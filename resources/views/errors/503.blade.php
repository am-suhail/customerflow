@extends('errors::illustrated-layout')

@section('title', __('Under Maintenance'))
@section('code', 'HELLO')
@section('message', 'Sorry! The App is under a technical maintenance. Will be back soon!')
@section('image')
	<div style="background-image: url({{ asset('img/403.svg') }});"
		class="absolute bg-no-repeat bg-cover pin md:bg-left lg:bg-center">
	</div>
@endsection
