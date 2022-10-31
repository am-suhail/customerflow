@extends('layouts.app')

@section('content')
<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
    <!-- Main content header -->
    <div class="flex flex-col items-start pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <a href="{{ route('service.index') }}" class="mr-4 btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
            Go Back
        </a>
        <h1 class="text-2xl font-semibold text-blue-800 font-base whitespace-nowrap">{{ $pageTitle }}</h1>
    </div>

    @include('layouts.app.flash')

    <div class="flex items-start justify-center w-full pt-4">
        <div class="w-full p-5 bg-white rounded-lg shadow-xl md:w-10/12 lg:w-3/4">
            {!! Form::open([
            'route' => ['service.update', $service],
            'method' => 'PUT'
            ]) !!}

            <div class="form-control">
                {!! Form::label('name', 'Service Name', ['class' => 'label font-semibold uppercase']) !!}
                {!! Form::text('name', old('name', $service->name), ['class' => 'input input-primary input-bordered'
                . ($errors->has('name') ? 'border-2 border-red-600' : '')]) !!}
                @error('name')
                <label class="label">
                    <span class="text-red-600 label-text-alt">{{ $message }}</span>
                </label>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="col-start-1 col-end-2 form-control">
                    {!! Form::label('code', 'Service Code', ['class' => 'label font-semibold uppercase']) !!}
                    {!! Form::text('code', old('code', $service->code), ['class' => 'input input-bordered
                    input-primary'
                    . ($errors->has('code') ? 'border-2 border-red-600' : '') ]) !!}
                    @error('code')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>

            <div>
                <livewire:category-sub-category
                    :selectedSubCategory="old('sub_category_id', $service->sub_category_id)">
            </div>

            <div class="grid grid-cols-2 mt-4">
                <div class="form-control">
                    {!! Form::label('description', 'Service Description', ['class' => 'label font-semibold
                    uppercase']) !!}
                    {!! Form::textarea('description', old('description', $service->description), ['class' =>
                    'textarea h-12
                    textarea-bordered
                    textarea-primary'
                    . ($errors->has('description') ? 'border-2 border-red-600' : '')]) !!}
                    @error('description')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 mt-4">
                <div class="form-control">
                    {!! Form::label('unit_id', 'Service Unit', ['class' => 'label font-semibold
                    uppercase']) !!}
                    {!! Form::select('unit_id', $units, old('unit_id', $service->unit_id), ['class' => 'select
                    select-bordered
                    select-primary'
                    . ($errors->has('unit_id') ? 'border-2 border-red-600' : '')]) !!}
                    @error('unit_id')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="form-control">
                    {!! Form::label('min_price', 'Minimum Price', ['class' => 'label font-semibold uppercase'])
                    !!}
                    {!! Form::number('min_price', old('min_price', $service->min_price), ['step' => '.01', 'class'
                    => 'input
                    input-bordered
                    input-primary'
                    . ($errors->has('min_price') ? 'border-2 border-red-600' : '')]) !!}
                    @error('min_price')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                <div class="form-control">
                    {!! Form::label('max_price', 'Maximum Price', ['class' => 'label font-semibold uppercase'])
                    !!}
                    {!! Form::number('max_price', old('max_price', $service->max_price), ['step' => '.01', 'class'
                    =>
                    'input
                    input-bordered
                    input-primary'
                    . ($errors->has('max_price') ? 'border-2 border-red-600' : '')]) !!}
                    @error('max_price')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>

            <div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
                <div>
                    <a href={{ route('service.index') }} class="btn">Cancel</a>
                    <button type="submit" class='btn btn-accent'>Update</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</main>
@endsection