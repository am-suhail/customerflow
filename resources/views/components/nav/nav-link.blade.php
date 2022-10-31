@props(['path', 'disabled'])

@php
if (Request::routeIs($route)) {
$el_class = 'bg-gray-200';
$icon_class = 'text-indigo-600';
$text_class = 'text-blue-600';
} else {
$el_class = '';
$icon_class = '';
$text_class = '';
}
@endphp

<li class="font-normal">
    <a href="{{ route($route) }}" {{ $attributes->merge(['class' => "flex items-center p-2 space-x-2 rounded-md
        hover:bg-gray-100 group {$el_class}"]) }}
        :class="{'justify-center': !isSidebarOpen}">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => "w-6 h-6 text-gray-400
                group-hover:text-indigo-700 {$icon_class}"]) }}
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                {{ $path }}
            </svg>
        </span>
        <span :class="{ 'lg:hidden': !isSidebarOpen }" {{ $attributes->merge(['class' => "text-gray-100
            group-hover:text-blue-700 {$text_class}"]) }}>
            {{ $slot }}
        </span>
    </a>
</li>