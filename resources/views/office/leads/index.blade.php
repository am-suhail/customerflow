@extends('layouts.app')

@section('content')
<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
    <!-- Main content header -->
    <x-headers.page-heading :title="$pageTitle" />

    <div class="p-2">
        <hr>
        <div class="py-4">
            <livewire:tables.market-leads-table>
        </div>
    </div>

</main>
@endsection