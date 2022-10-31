@extends('layouts.app')

@section('content')
<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
    <!-- Main content header -->
    <x-headers.button-page-heading :title="$pageTitle" :route="'leads.index'" />

    @include('layouts.app.flash')

    <div class="flex items-start justify-center w-full pt-4">
        <div class="w-full p-5 bg-white rounded-lg shadow-xl md:w-10/12 lg:w-3/4">
            <form action="{{ route('leads.store')  }}" method="POST" id="add_vehicle_form">
                @csrf

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="form-control">
                        {!! Form::label('name', 'Lead\'s Name', ['class' => 'label font-semibold uppercase']) !!}
                        {!! Form::text('name', old('name'), ['class' => 'input input-primary input-bordered'
                        . ($errors->has('name') ? 'border-2 border-red-600' : '')]) !!}
                        @error('name')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        {!! Form::label('designation', 'Lead\'s Designation', ['class' => 'label font-semibold
                        uppercase'])
                        !!}
                        {!! Form::text('designation', old('designation'), ['class' => 'input input-bordered
                        input-primary'
                        . ($errors->has('designation') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('designation')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
                    <div class="col-start-1 col-end-2 form-control">
                        {!! Form::label('country_id', 'Lead\'s Nationality', [
                        'class' => 'label font-semibold uppercase'
                        ])!!}
                        {!! Form::select('country_id', $countries, old('country_id'), [
                        'placeholder' => '--choose--',
                        'class' => 'input input-bordered input-primary'
                        . ($errors->has('country_id') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('country_id')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
                    <div class="form-control">
                        {!! Form::label('company_name', 'Company Name', ['class' => 'label font-semibold uppercase'])
                        !!}
                        {!! Form::text('company_name', old('company_name'), ['class' => 'input input-bordered
                        input-primary'
                        . ($errors->has('company_name') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('company_name')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                    <div class="form-control">
                        {!! Form::label('industry_id', 'Industry', ['class' => 'label font-semibold uppercase'])
                        !!}
                        {!! Form::select('industry_id', $industries, old('industry_id'), [
                        'placeholder' => '--choose industry--',
                        'class' => 'select select-bordered select-primary'
                        . ($errors->has('industry_id') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('industry_id')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="form-control">
                        {!! Form::label('email', 'Email', ['class' => 'label font-semibold uppercase'])
                        !!}
                        {!! Form::email('email', old('email'), ['class' => 'input input-bordered
                        input-primary'
                        . ($errors->has('email') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('email')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        {!! Form::label('mobile', 'Mobile', ['class' => 'label font-semibold uppercase'])
                        !!}
                        {!! Form::number('mobile', old('mobile'), ['class' => 'input input-bordered
                        input-primary'
                        . ($errors->has('mobile') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('mobile')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
                    <div class="form-control">
                        {!! Form::label('landline', 'Landline', ['class' => 'label font-semibold uppercase'])
                        !!}
                        {!! Form::number('landline', old('landline'), ['class' => 'input input-bordered
                        input-primary'
                        . ($errors->has('landline') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('landline')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        {!! Form::label('alternate_number', 'Alternate Number',
                        ['class' => 'label font-semibold
                        uppercase'])
                        !!}
                        {!! Form::number('alternate_number', old('alternate_number'), ['class' => 'input input-bordered
                        input-primary'
                        . ($errors->has('alternate_number') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('alternate_number')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class="my-8 divider">Address</div>

                <div class="mt-4">
                    <livewire:state-city :selectedCity="$errors ? old('city_id') : NULL">
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="form-control">
                        {!! Form::label('area', 'Area', ['class' => 'label font-semibold uppercase']) !!}
                        {!! Form::text('area', old('area'), ['class' => 'input input-primary input-bordered'
                        . ($errors->has('area') ? 'border-2 border-red-600' : '')]) !!}
                        @error('area')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        {!! Form::label('street', 'Street', ['class' => 'label font-semibold
                        uppercase'])
                        !!}
                        {!! Form::text('street', old('street'), ['class' => 'input input-bordered
                        input-primary'
                        . ($errors->has('street') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('street')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
                    <div class="col-start-1 col-end-2 form-control">
                        {!! Form::label('address', 'Address', ['class' => 'label font-semibold
                        uppercase'])
                        !!}
                        {!! Form::textarea('address', old('address'), [
                        'class' => 'input input-bordered input-primary'
                        . ($errors->has('address') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('address')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class="my-8 divider">Office</div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="form-control">
                        {!! Form::label('executive', 'Executive', ['class' => 'label font-semibold
                        uppercase'])
                        !!}
                        {!! Form::text('executive', old('executive', Auth::user()->name), [
                        'disabled',
                        'class' => 'input input-bordered input-primary' ]) !!}
                    </div>

                    <div class="form-control">
                        {!! Form::label('date', 'Visited Date', ['class' => 'label font-semibold
                        uppercase']) !!}
                        {!! Form::date('date', old('date'), [
                        'required' => 'required',
                        'class' => 'input input-bordered input-primary'
                        . ($errors->has('date') ? 'border-2 border-red-600' : '')]) !!}
                        @error('date')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <livewire:category-sub-category :selectedSubCategory="$errors ? old('sub_category_id') : NULL">
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="form-control">
                        <label class="bg-blue-300 rounded cursor-pointer label">
                            <span class="font-semibold uppercase label">Product Demo Presented</span>
                            <input type="checkbox" name="demo_presented" class="checkbox">
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="col-start-1 col-end-2 form-control">
                        {!! Form::label('feedback', 'Product Suggestions/Feedback', ['class' => 'label
                        font-semibold
                        uppercase'])
                        !!}
                        {!! Form::textarea('feedback', old('feedback'), [
                        'class' => 'input input-bordered input-primary'
                        . ($errors->has('feedback') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('feedback')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="col-start-1 col-end-2 form-control">
                        {!! Form::label('remarks', 'Executive Comments', ['class' => 'label font-semibold
                        uppercase'])
                        !!}
                        {!! Form::textarea('remarks', old('remarks'), [
                        'class' => 'input input-bordered input-primary'
                        . ($errors->has('remarks') ? 'border-2 border-red-600' : '') ]) !!}
                        @error('remarks')
                        <label class="label">
                            <span class="text-red-600 label-text-alt">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <hr>
                </div>

                <div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
                    <div>
                        <a href={{ route('leads.index') }} class="btn">Cancel</a>
                        <input type="submit" class='btn btn-accent' value="Create">
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection