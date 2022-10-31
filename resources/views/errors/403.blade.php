@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', 'Unauthorized Access')
@section('image')
<div style="background-image: url({{ asset('img/403.svg') }});"
    class="absolute bg-no-repeat bg-cover pin md:bg-left lg:bg-center">
</div>
@endsection