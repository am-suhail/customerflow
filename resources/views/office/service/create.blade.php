@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
		<!-- Main content header -->
		<div class="grid grid-rows-1 grid-cols-3 pb-6 mb-4 border-b items-center space-y-0">
			<div class="">
				<a href="{{ route('service.index') }}" class="mr-4 btn btn-primary btn-sm md:btn-md">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
					</svg>
					<span class="hidden sm:block">
						Go Back
					</span>
				</a>
			</div>
			<div class="col-start-2 col-end-3">
				<h1 class="text-lg sm:text-2xl text-center font-semibold text-blue-800 font-base whitespace-nowrap uppercase">
					{{ $pageTitle }}</h1>
			</div>
		</div>

		@include('layouts.app.flash')

		<div class="flex items-start justify-center w-full pt-4" x-data="{ sellingPrice: '', costOne: 0, costTwo: 0 }">
			<div class="w-full p-5 bg-gray-200 rounded-lg shadow-xl md:w-10/12 lg:w-3/4">
				<form action="{{ route('service.store') }}" method="POST">
					@csrf

					<div class="form-control">
						{!! Form::label('name', 'Service Name', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::text('name', old('name'), [
						    'class' => 'input input-primary input-bordered' . ($errors->has('name') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('name')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div>
						<livewire:category-sub-category :selectedSubCategory="$errors ? old('sub_category_id') : null">
					</div>

					<div class="grid grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('unit_id', 'Service Unit', [
							    'class' => 'label font-semibold uppercase',
							]) !!}
							{!! Form::select('unit_id', $units, old('unit_id'), [
							    'class' => 'select select-bordered select-primary' . ($errors->has('unit_id') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('unit_id')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
						<div class="form-control">
							{!! Form::label('selling_price', 'Selling Price', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('selling_price', old('selling_price'), [
							    'x-model.number' => 'sellingPrice',
							    'step' => '.01',
							    'class' => 'input input-bordered input-primary' . ($errors->has('selling_price') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('selling_price')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class="grid grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('cost_one', 'Cost 1', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('cost_one', old('cost_one'), [
							    'x-model.number' => 'costOne',
							    'step' => '.01',
							    'class' => 'input input-bordered input-primary' . ($errors->has('cost_one') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('cost_one')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
						<div class="form-control">
							{!! Form::label('cost_one_desc', 'Description for Cost 1', [
							    'class' => 'label font-semibold uppercase',
							]) !!}
							{!! Form::textarea('cost_one_desc', old('cost_one_desc'), [
							    'class' =>
							        'textarea h-12 textarea-bordered textarea-primary' .
							        ($errors->has('cost_one_desc') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('cost_one_desc')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class="grid grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('cost_two', 'Cost 2', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('cost_two', old('cost_two'), [
							    'x-model.number' => 'costTwo',
							    'step' => '.01',
							    'class' => 'input input-bordered input-primary' . ($errors->has('cost_two') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('cost_two')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
						<div class="form-control">
							{!! Form::label('cost_two_desc', 'Description for Cost 2', [
							    'class' => 'label font-semibold uppercase',
							]) !!}
							{!! Form::textarea('cost_two_desc', old('cost_two_desc'), [
							    'class' =>
							        'textarea h-12 textarea-bordered textarea-primary' .
							        ($errors->has('cost_two_desc') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('cost_two_desc')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class="grid grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('max_price', 'Gross Profit', ['class' => 'label font-semibold uppercase']) !!}
							<span class="text-lg font-bold label" x-text="sellingPrice - (costOne + costTwo)"></span>
						</div>

						<div class="form-control">
							{!! Form::label('max_price', 'Profit Percentage', ['class' => 'label font-semibold uppercase']) !!}
							<span class="text-lg font-bold" x-text="sellingPrice - (costOne + costTwo)"></span>
						</div>
					</div>

					<div class="grid grid-cols-2 mt-4">
					</div>

					<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4 w-1/2'>
						<button type="submit" class='btn btn-accent'>Create</button>
						<a href={{ route('service.index') }} class="btn">Cancel</a>
					</div>
				</form>
			</div>
		</div>

	</main>
@endsection
