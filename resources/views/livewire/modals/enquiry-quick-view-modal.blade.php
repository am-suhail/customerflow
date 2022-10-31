<div>
    <div class="p-4">
        <h1 class="text-center text-blue-600">PROJECT ENQUIRY QUICK VIEW</h1>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-3">
            <div class="flex col-span-3">
                <span class="mr-2 font-semibold">
                    Job Type:
                </span>
                <h6 class="px-1 text-center text-black bg-green-400 rounded">
                    {{ $enquiry->category->name ?? 'unassigned' }}
                </h6>
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex col-span-3">
                <span class="mr-2 font-semibold">
                    Assigned Team Leader:
                </span>
                <h6 class="px-1 text-center text-black bg-blue-400 rounded">
                    {{ $enquiry->assigned_user->name ?? 'unassigned' }}
                </h6>
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col">
                <span class="font-bold">
                    Project Enquiry Name
                </span>
                {{ $enquiry->name }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    Enquiry Code
                </span>
                {{ $enquiry->code }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    Date
                </span>
                {{ $enquiry->date->format('d-m-Y') }}
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col">
                <span class="font-bold">
                    Customer
                </span>
                {{ $enquiry->vendor->name }}
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col">
                <span class="font-bold">
                    Building Name
                </span>
                {{ $enquiry->building_name }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    State
                </span>
                {{ $enquiry->city->state->name ?? '' }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    City
                </span>
                {{ $enquiry->city->name ?? '' }}
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col">
                <span class="font-bold">
                    Area
                </span>
                {{ $enquiry->area ?? '' }}
            </div>

            <div class="flex flex-col">
                <span class="font-bold">
                    Street
                </span>
                {{ $enquiry->street ?? '' }}
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5">
            <div class="flex flex-col col-span-3">
                <span class="font-bold">
                    Job Description / Requirement Brief
                </span>
                {{ $enquiry->requirement ?? '' }}
            </div>
        </div>
    </div>
</div>