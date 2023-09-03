@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<div class="grid grid-rows-1 grid-cols-3 pb-6 mb-4 border-b items-center space-y-0">
			<div class="">
				<a href="{{ route('expense.index') }}" class="mr-4 btn btn-primary btn-sm md:btn-md">
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

		<div class="p-2">
			<div class="p-4 bg-gray-100 rounded">
				<form action="{{ route('expense.import.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="grid grid-cols-1 md:grid-cols-1 gap-4 w-1/2">
						<div class="form-control">
							{!! Form::label('expense_file', 'Upload Revenue Sheet', ['class' => 'label font-semibold uppercase']) !!}
							<input name="expense_file" type="file" value="{{ old('expense_file') }}" @class([
								'input input-primary file-input file-input-bordered file-input-primary pl-0 h-8 text-lg',
								'border-2 border-red-600' => $errors->has('expense_file'),
							])>
							@error('expense_file')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4 w-1/2'>
						<button type="submit" class='btn btn-accent'>Create</button>
						<a href={{ route('expense.index') }} class="btn">Cancel</a>
					</div>
				</form>
			</div>
		</div>

	</main>
@endsection
