@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<div class="flex flex-col items-start pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
			<h1 class="text-2xl font-semibold text-blue-800 font-base whitespace-nowrap">{{ $pageTitle }}</h1>
		</div>

		@include('layouts.app.flash')

		<div class="flex justify-center p-2">
			<div class="w-3/4 px-10 py-8 bg-gray-100 rounded-md shadow-md md:px-8">

				<div class="flex flex-col">
					<div class="flex flex-col items-center justify-center gap-6 md:flex-row md:gap-8">
						<svg xmlns="http://www.w3.org/2000/svg" class="text-blue-500 w-28 h-28" fill="none" viewBox="0 0 24 24"
							stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
								d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
						<div class="flex flex-col text-center md:text-left">
							<div class="text-lg font-medium text-gray-800">{{ $user->name }}</div>
							<div class="text-gray-500 whitespace-nowrap">{{ $user->mobile }}</div>
							<div class="mb-3 text-gray-500 whitespace-nowrap">{{ $user->email }}</div>
							<div class="flex flex-row gap-4 mx-auto my-auto text-2xl text-gray-800 md:mx-0">
								<a class="hover:cursor-pointer hover:text-blue-500"><i class="fab fa-linkedin"></i></a>
								<a class="hover:cursor-pointer hover:text-blue-500"><i class="fab fa-facebook-square"></i></a>
								<a class="hover:cursor-pointer hover:text-blue-500"><i class="fab fa-github-square"></i></a>
							</div>
						</div>
					</div>
				</div>

				<div class="divider">Manage Role of the User</div>

				<div class="my-12">
					{!! Form::open([
					    'route' => ['user.update', $user],
					    'method' => 'PUT',
					]) !!}

					<div class="grid grid-cols-3 gap-4 my-4">
						@foreach ($roles as $role)
							<div class="p-2 rounded-lg form-control bg-base-300">
								<label class="cursor-pointer label">
									{!! Form::label('roles', $role->name, ['class' => 'label-text']) !!}
									<input type="checkbox" name="roles[]" value="{{ $role->id }}"
										{{ $user->roles->contains($role->id) ? 'checked' : '' }} class="checkbox checkbox-accent">
								</label>
							</div>
						@endforeach
					</div>

					<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
						<div>
							<a href={{ route('user.index') }} class="btn">Cancel</a>
							<button type="submit" class='btn btn-accent'>Create</button>
						</div>
					</div>
					{!! Form::close() !!}
				</div>

				<div class="divider">
					<span class="text-sm font-light">refer below for information on the roles and it's permissions</span>
				</div>

				<div class="grid grid-cols-2 gap-4">
					<div class="col-span-2 mt-4 place-self-start">
						<h3 class="font-bold">All Roles & it's Permissions info:</h3>
					</div>
					@foreach ($roles as $role)
						<div class="p-4 bg-green-200 rounded-lg">
							<div class="mb-2">
								<h6 class="font-bold">
									{{ Str::upper($role->name) }}
								</h6>
							</div>
							<div class="grid grid-cols-2 gap-2">
								@forelse ($role->permissions as $permission)
									<span class="px-2 text-sm rounded bg-base-200">
										{{ $permission->name }}
									</span>
								@empty
									<span class="col-span-2 p-2 text-sm rounded bg-base-100">No permissions set for this role</span>
								@endforelse
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>

	</main>
@endsection
