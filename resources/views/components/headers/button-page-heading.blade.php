@props(['title' => 'Page Heading', 'route' => 'home'])

<!-- Main content header -->
<div class="grid w-full grid-cols-3 py-2 mb-4 rounded-lg shadow-sm bg-blue-200">
    <div class="flex items-center pl-4">
        <a href="{{ route($route) }}" class="mr-2 md:mr-4 btn btn-outline btn-success btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
            <span class="hidden md:block">
                Go Back
            </span>
        </a>
    </div>
    <div class="flex items-center justify-center col-start-2 col-end-3">
        <h1 class="text-sm md:text-2xl font-semibold text-blue-800 uppercase font-base whitespace-nowrap">{{ $title }}
        </h1>
    </div>
</div>