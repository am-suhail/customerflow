<a href="{{ route($route ?? 'home') }}"
    class="p-4 transition-shadow {{ $color ?? 'bg-blue-300' }} border rounded-lg shadow-sm group hover:shadow-lg">
    <div class="flex items-start">
        <div class="flex flex-col flex-shrink-0 space-y-2">
            <span class="font-extrabold text-gray-800">{{ $title }}</span>
            <span class="text-lg font-semibold">{{ $number ?? 0 }}</span>
        </div>
        <div class="relative min-w-0 ml-auto h-14">
            {{ $slot }}
        </div>
    </div>
    <!--<div>
        <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
        <span>from 2020</span>
    </div>-->
    <div class="mt-1">
        <span class="flex mt-3 text-sm text-gray-900 rounded">
            More Info
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </span>
    </div>
</a>