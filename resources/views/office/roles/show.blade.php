@extends('layouts.app')

@section('content')
<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
    <!-- Main content header -->
    <div class="flex flex-col items-start pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold text-blue-800 font-base whitespace-nowrap">{{ $pageTitle }}</h1>
    </div>

    @include('layouts.app.flash')

    <div class="p-2">
        <div class="py-4">
            <div class="grid grid-cols-4 gap-4 pb-8">
                <div class="col-span-4 mb-4">
                    <h2 class="font-bold">Available Permissions</h2>
                </div>
                @foreach ($role->permissions as $permission)
                <div class="p-2 bg-green-300 rounded-lg shadow-sm">
                    <h6 class="text-center">
                        {{ $permission->name }}
                    </h6>
                </div>
                @endforeach
            </div>
            <hr>
            <div class="grid grid-cols-4 gap-4 mt-6">
                <div class="col-span-4 mb-4">
                    <h2 class="font-bold">Users with the Role</h2>
                </div>
                @forelse ($role->users as $user)
                <div class="col-span-4 p-2 mb-1 bg-yellow-200 rounded-lg shadow-sm">
                    <div class="flex justify-between px-4">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-600">
                                Name:
                            </span>
                            <h6 class="text-center">
                                {{ $user->name }}
                            </h6>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-600">
                                Mobile:
                            </span>
                            <h6 class="text-center">
                                {{ $user->mobile ?? '--' }}
                            </h6>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-600">
                                Email:
                            </span>
                            <h6 class="text-center">
                                {{ $user->email ?? '--' }}
                            </h6>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-600">
                                Sex:
                            </span>
                            <h6 class="text-center">
                                {{ $user->user_detail->sex ?? '--'}}
                            </h6>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-600">
                                City:
                            </span>
                            <h6 class="text-center">
                                {{ $user->user_detail->city->name ?? '--' }}
                            </h6>
                        </div>
                    </div>
                </div>
                @empty
                <div class="flex justify-center col-span-4">
                    <h6 class="w-1/2 p-2 text-center bg-gray-200 rounded-lg shadow-sm">
                        No users with this role.
                    </h6>
                </div>
                @endforelse
            </div>
        </div>
        <div class="divider"></div>
        <div class="mt-6">
            <a class="btn" href="{{ route('roles.index') }}">Cancel</a>
        </div>
    </div>

</main>
@endsection