@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<div class="grid grid-rows-1 grid-cols-3 pb-6 mb-4 items-center space-y-0">
			<div class="">
				<a href="{{ route('master.index') }}" class="mr-4 btn btn-primary btn-sm">
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

		<div>
			<div x-data="{
    tabs: ['State', 'City'],
    activeTabIndex: {{ $type == 'state' ? 0 : 1 }}
}">
				<div class="justify-center my-6 font-bold tabs">
					<template x-for="(tab, index) in tabs" :key="index">
						<a :href="index == 0 ? '{{ route('master.location') }}' : '{{ route('master.location', 'city') }}'"
							class="tab tab-lifted " :class="{ 'tab-active': activeTabIndex == index }" x-text=tab></a>
					</template>
				</div>

				<div class="pt-4 my-6 card">
					<div x-show="activeTabIndex == 0">
						<x-toggle-record-field>
							<livewire:records.add-single-record :model="'\App\Models\State'" :recordLabel="'Add New State'">
						</x-toggle-record-field>
						<div class="py-4">
							<livewire:tables.master.state-table>
						</div>
					</div>

					<div x-show="activeTabIndex == 1">
						<x-toggle-record-field>
							<livewire:records.add-city-record>
						</x-toggle-record-field>
						<div class="py-4">
							<livewire:tables.master.city-table>
						</div>
					</div>
				</div>
			</div>

		</div>

	</main>
@endsection
