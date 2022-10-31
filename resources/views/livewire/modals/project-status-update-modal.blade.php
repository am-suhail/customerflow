<div class="flex flex-col items-center justify-center py-5">
    <h3 class="text-lg font-medium leading-6 text-gray-900">
        Change Project Status
    </h3>
    <div class="mt-2 border-b-2 w-ful">
        <h1 class="text-2xl text-blue-700">{{ Str::limit($project->name, 50, '...') }}</h1>
    </div>
    <div class="flex flex-col items-center mt-4">
        <h6 class="my-4">Set the current status below:</h6>
        {!! Form::open([
        'route' => 'project.status_update',
        'method' => 'POST'
        ]) !!}

        <div class="flex justify-center w-full">
            {!! Form::hidden('id', $project->id) !!}

            <div class="mx-2">
                {!! Form::select('badge', $statuses, old('badge'), ['class' => 'select select-bordered
                select-primary']) !!}
            </div>

            <div class="mx-2">
                <button class="btn" type="submit">Update</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>