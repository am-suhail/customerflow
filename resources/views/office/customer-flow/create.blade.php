@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
		<!-- Main content header -->
		<div class="grid grid-rows-1 grid-cols-3 pb-6 mb-4 border-b items-center space-y-0">
			<div class="">
				<a href="{{ route('company.index') }}" class="mr-4 btn btn-primary btn-sm md:btn-md">
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

		<div class="flex items-start justify-center w-full pt-4">
			<div class="w-full p-5 bg-white rounded-lg shadow-xl xl:w-3/4">
				<form action="{{ route('customer-flow.store') }}" method="POST">
					@csrf

				

					<div class="mt-8 mb-4 divider">CUSTOMER DETAILS</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('branch_id', 'branch', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::select('branch_id', $branches, old('branch_id'), [
							    'placeholder' => '--choose--',
							    'class' => 'select select-bordered select-primary' . ($errors->has('branch_id') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('branch_id')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
							</div>

						<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('date', 'Date', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::date('date', old('date'), [
							    'class' => 'input input-bordered input-primary' . ($errors->has('inc_date') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('date')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
							</div>

					

						<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('invoices', 'Invoices', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('invoices', old('invoices'), [
							    'class' => 'input input-bordered input-primary' . ($errors->has('inc_number') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('invoices')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
							{!! Form::label('loyalty_cards', 'Loyalty Cards', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('loyalty_cards', old('loyalty_cards'), [
							    'class' => 'input input-bordered input-primary' . ($errors->has('loyalty_cards') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('loyalty_cards')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

			

					<div class="grid grid-cols-1 md:grid-cols-2 mt-4">
						<div class="form-control">
							{!! Form::label('remark', 'Remark', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::textarea('remark', old('remark'), [
							    'class' => 'textarea textarea-bordered	textarea-primary' . ($errors->has('remark') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('remark')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4 md:w-1/2'>
						<button type="submit" class='btn btn-accent'>Create</button>
						<a href={{ route ('customer-flow.index') }} class="btn">Cancel</a>
					</div>
				</form>
			</div>
		</div>

	</main>
@endsection
