@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-end">
            <p class="text-gray font-normal">
                <a href="/projects">My projects</a> / {{ $project->title }}</p>
            <a href="/projects/create" class="button">New project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-gray font-normal text-lg mb-3">Tasks</h2>

                    {{-- tasks --}}
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="post" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf

                                <div class="flex">
                                    <input name="body" type="text" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray' : '' }}">
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}/>
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks'}}" method="post">
                            @csrf
                            <input name="body" type="text" class="w-full" placeholder="Add a new task...">
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-gray font-normal text-lg mb-3">General Notes</h2>
                    <textarea class="card w-full" style="min-height: 200px">Lorem ipsum</textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>

@endsection
