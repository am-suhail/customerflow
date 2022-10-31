<div>
    <div class="p-4">
        <h1 class="text-center text-blue-600 uppercase">Market Lead QUICK VIEW</h1>
    </div>
    <div class="p-6">

        <div class="grid grid-cols-3 mb-3 mt-2">
            <div class="flex col-span-3">
                <span class="mr-2 font-semibold">
                    Marketing Executive:
                </span>
                <h6 class="px-1 text-center text-black bg-blue-400 rounded">
                    {{ $lead->user->name ?? 'unassigned' }}
                </h6>
            </div>
        </div>

        <div class="grid grid-cols-3 my-3">
            <div class="flex col-span-3">
                <span class="mr-2 font-semibold">
                    Visited Date:
                </span>
                <h6 class="px-1 text-center text-black bg-green-400 rounded">
                    {{ !is_null($lead->date) ? $lead->date->format('d-m-Y') : 'NA' }}
                </h6>
            </div>
        </div>

        <div class="grid grid-cols-3 my-3">
            <div class="flex col-span-3">
                <span class="mr-2 font-semibold">
                    Concerned Product:
                </span>
                <h6 class="px-1 text-center text-black bg-green-400 rounded">
                    {{ $lead->sub_category->name ?? 'NA' }}
                </h6>
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col">
                <span class="font-bold">
                    Name
                </span>
                {{ $lead->name ?? '--' }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    Designation
                </span>
                {{ $lead->designation ?? '--' }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    Nationality
                </span>
                {{ $lead->country->name ?? '--' }}
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col">
                <span class="font-bold">
                    Company
                </span>
                {{ $lead->company_name ?? '--' }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    Mobile
                </span>
                {{ $lead->mobile ?? '--' }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    Email
                </span>
                {{ $lead->email ?? '--' }}
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col">
                <span class="font-bold">
                    Landline Number
                </span>
                {{ $lead->landline ?? '--' }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    Alternate Number
                </span>
                {{ $lead->alternate_number ?? '--' }}
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col">
                <span class="font-bold">
                    State
                </span>
                {{ $lead->city->state->name ?? '--' }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    City
                </span>
                {{ $lead->city->name ?? '--' }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    Area
                </span>
                {{ $lead->area ?? '--' }}
            </div>

            <div class="flex flex-col mt-5">
                <span class="font-bold">
                    Street
                </span>
                {{ $lead->street ?? '--' }}
            </div>

            <div class="flex flex-col mt-5">
                <span class="font-bold">
                    Address
                </span>
                {{ $lead->address ?? '--' }}
            </div>
        </div>

        {{-- <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col col-span-3">
                <span class="font-bold">
                    Job Description / Requirement Brief
                </span>
                {{ $lead->requirement ?? '' }}
            </div>
        </div> --}}
    </div>
</div>