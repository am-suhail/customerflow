@extends('layouts.app')

@section('content')
<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
    <!-- Main content header -->
    <div class="flex flex-col items-start pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <a href="{{ route('master-data') }}" class="mr-4 btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
            Go Back
        </a>
        <h1 class="text-2xl font-semibold text-blue-800 font-base whitespace-nowrap">{{ $pageTitle }}</h1>
    </div>

    <div class="p-2">

        <div x-data="{
            tabs: [ 'State', 'City'],
            activeTabIndex: 0
        }">
            <div class="justify-center my-6 font-bold tabs">
                <template x-for="(tab, index) in tabs" :key="index">
                    <a class="tab tab-lg tab-lifted " :class="{'tab-active': activeTabIndex == index}"
                        x-on:click="activeTabIndex = index" x-text=tab></a>
                </template>
            </div>

            <div class="p-6 my-6 card">
                <div x-show="activeTabIndex == 0">
                    <x-toggle-record-field>
                        <livewire:records.add-single-record :model="'\App\Models\State'" :recordLabel="'Add new State'">
                    </x-toggle-record-field>
                    <hr>
                    <div class="py-4">
                        <livewire:tables.state-table>
                    </div>
                </div>

                <div x-show="activeTabIndex == 1">
                    <x-toggle-record-field>
                        <livewire:records.add-city-record>
                    </x-toggle-record-field>
                    <hr>
                    <div class="py-4">
                        <livewire:tables.city-table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>
@endsection