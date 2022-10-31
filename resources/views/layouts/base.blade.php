<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@hasSection('title')
		<title>@yield('title') - {{ config('app.name') }}</title>
	@else
		<title>{{ config('app.name') }}</title>
	@endif

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

	<!-- Fonts -->
	<link rel="stylesheet" href="https://rsms.me/inter/inter.css">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
	@livewireStyles
	@powerGridStyles

	<!-- Scripts -->
	<script src="{{ url(mix('js/app.js')) }}" defer></script>

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<style>
		[x-cloak] {
			display: none !important;
		}

		.sidebar-nav-custom::-webkit-scrollbar {
			width: 10px;
			height: 16px;
		}

		/* Track */
		.sidebar-nav-custom::-webkit-scrollbar-track {
			background: rgba(31, 41, 51, 1);
		}

		/* Handle */
		.sidebar-nav-custom::-webkit-scrollbar-thumb {
			background: #cbd5e0;
			border-radius: 100vh;
			border: 3px solid #edf2f7;
		}

		/* Handle on hover */
		.sidebar-nav-custom::-webkit-scrollbar-thumb:hover {
			background: #a0aec0;
		}
	</style>
</head>

<body>
	@yield('body')

	@stack('scripts')
	@livewireScripts
	@powerGridScripts
	@livewire('livewire-ui-modal')
</body>

</html>
