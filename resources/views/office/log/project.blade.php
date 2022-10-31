@extends('layouts.app')

@section('content')
<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">

    <div class="">
        @foreach ($projects as $project)
        <ul>
            @forelse ($project->audits as $audit)
            <li>
                <ul>
                    <li>
                        {{ $audit->ip_address }}
                    </li>
                    <li>
                        {{ $audit->user->name }}
                    </li>
                </ul>

                @foreach ($audit->getModified() as $attribute => $modified)
                <ul>
                    <li>
                        {{ $audit->event }}
                        {{ $attribute }}
                        {{ var_dump($modified) }}
                    </li>
                    <li>
                        {{ $audit->created_at->diffForHumans() }}
                    </li>
                </ul>
                @endforeach
            </li>
            @empty
            @endforelse
        </ul>
        @endforeach
    </div>

</main>
@endsection