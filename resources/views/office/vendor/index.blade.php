@extends('layouts.app')

@section('content')
<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
    <!-- Main content header -->
    <div class="flex flex-col items-start pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold text-blue-800 font-base whitespace-nowrap">{{ $pageTitle }}</h1>
    </div>
    <div class="flex flex-col items-start mb-4 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
        <a href="{{ route('vendor.create') }}" class="btn btn-primary">Add New</a>
    </div>

    @include('layouts.app.flash')

    <div class="p-2">
        <hr>
        <div class="py-4">
            <livewire:tables.vendor-table>
        </div>
    </div>

</main>
@endsection