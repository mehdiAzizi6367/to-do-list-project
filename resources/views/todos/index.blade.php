<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Todos') }}
            </h2>
            <a href="{{ route('todos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Todo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($todos->count() > 0)
                        <div class="space-y-4">
                            @foreach($todos as $todo)
                                <div class="flex items-center justify-between p-4 border rounded-lg {{ $todo->completed ? 'bg-green-50' : 'bg-gray-50' }}">
                                    <div class="flex items-center space-x-4">
                                        <form action="{{ route('todos.update', $todo) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="completed" value="{{ $todo->completed ? 0 : 1 }}">
                                            <button type="submit" class="text-2xl {{ $todo->completed ? 'text-green-500' : 'text-gray-400' }}">
                                                {{ $todo->completed ? '✓' : '○' }}
                                            </button>
                                        </form>
                                        <div>
                                            <h3 class="font-semibold {{ $todo->completed ? 'line-through text-gray-500' : '' }}">{{ $todo->title }}</h3>
                                            @if($todo->description)
                                                <p class="text-sm text-gray-600">{{ $todo->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('todos.edit', $todo) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No todos yet. <a href="{{ route('todos.create') }}" class="text-blue-500">Create your first one!</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>