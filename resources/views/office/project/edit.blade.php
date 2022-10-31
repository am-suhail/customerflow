@extends('layouts.app')

@section('content')
<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
    <!-- Main content header -->
    <div class="flex flex-col items-start pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <a href="{{ route('project.index') }}" class="mr-4 btn btn-primary btn-sm">
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
            'route' => ['project.update', $project],
            'method' => 'PUT'
            ]) !!}

            <div class="form-control">
                {!! Form::label('name', 'Project Name', ['class' => 'label font-semibold uppercase']) !!}
                {!! Form::text('name', old('name', $project->name), ['class' => 'input input-primary input-bordered'
                . ($errors->has('name') ? 'border-2 border-red-600' : '')]) !!}
                @error('name')
                <label class="label">
                    <span class="text-red-600 label-text-alt">{{ $message }}</span>
                </label>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="form-control">
                    {!! Form::label('inward', 'Received Date', ['class' => 'label font-semibold uppercase']) !!}
                    {!! Form::date('inward', old('inward', $project->inward), ['class' => 'input input-bordered
                    input-primary'
                    . ($errors->has('inward') ? 'border-2 border-red-600' : '') ]) !!}
                    @error('inward')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                <div class="form-control">
                    {!! Form::label('code', 'Project Code', ['class' => 'label font-semibold uppercase']) !!}
                    {!! Form::text('code', old('code', $project->code), ['class' => 'input input-bordered input-primary'
                    . ($errors->has('code') ? 'border-2 border-red-600' : '') ]) !!}
                    @error('code')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>

            <div class="my-8 divider">Vendor Details</div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="form-control">
                    {!! Form::label('vendor_id', 'Vendor', ['class' => 'label font-semibold
                    uppercase']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id', $project->vendor_id), ['class' => 'select
                    select-bordered select-primary'
                    . ($errors->has('vendor_id') ? 'border-2 border-red-600' : '')]) !!}
                    @error('vendor_id')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                <div class="form-control">
                    {!! Form::label('referral_no', 'Project Referral Number', ['class' => 'label font-semibold
                    uppercase'])
                    !!}
                    {!! Form::text('referral_no', old('referral_no', $project->referral_no), ['class' => 'input
                    input-bordered input-primary'
                    . ($errors->has('referral_no') ? 'border-2 border-red-600' : '')]) !!}
                    @error('referral_no')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>

            <div class="my-8 divider">Location</div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="col-start-1 col-end-2 form-control">
                    {!! Form::label('building_name', 'Building Name', ['class' => 'label font-semibold
                    uppercase'])
                    !!}
                    {!! Form::text('building_name', old('building_name', $project->building_name), ['class' => 'input
                    input-bordered input-primary'
                    . ($errors->has('building_name') ? 'border-2 border-red-600' : '')]) !!}
                    @error('building_name')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>

            <div>
                <livewire:state-city :selectedCity="$errors ? old('city_id', $project->city_id) : NULL">
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="form-control">
                    {!! Form::label('area', 'Area', ['class' => 'label font-semibold
                    uppercase']) !!}
                    {!! Form::text('area', old('area', $project->area), ['class' => 'input
                    input-bordered input-primary'
                    . ($errors->has('area') ? 'border-2 border-red-600' : '')]) !!}
                    @error('area')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                <div class="form-control">
                    {!! Form::label('street', 'Street', ['class' => 'label font-semibold
                    uppercase']) !!}
                    {!! Form::text('street', old('street', $project->street), ['class' => 'input
                    input-bordered input-primary'
                    . ($errors->has('street') ? 'border-2 border-red-600' : '')]) !!}
                    @error('street')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>

            <div class="mt-8 mb-4 divider">Services</div>

            <div>
                <livewire:project-services :services="$project->services->toArray()">
            </div>

            <div class="grid grid-cols-2 mt-4">
                <div class="fomr-control">
                    {!! Form::label('remarks', 'Remarks', ['class' => 'label font-semibold uppercase']) !!}
                    {!! Form::textarea('remarks', old('remarks', $project->remarks), ['class' => 'textarea
                    textarea-bordered textarea-primary'
                    . ($errors->has('remarks') ? 'border-2 border-red-600' : '')]) !!}
                    @error('remarks')
                    <label class="label">
                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>

            <div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
                <div>
                    <a href={{ route('project.index') }} class="btn">Cancel</a>
                    <button type="submit" class='btn btn-accent'>Update</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</main>
@endsection