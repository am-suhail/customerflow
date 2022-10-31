@extends('errors::illustrated-layout')

@section('title', __('Under Maintenance'))
@section('code', '503')
@section('message', 'Sorry! The site is under maintenance. Will be back soon!')
@section('image')
<div style="background-image: url({{ asset('img/403.svg') }});"
    class="absolute bg-no-repeat bg-cover pin md:bg-left lg:bg-center">
</div>
@endsection