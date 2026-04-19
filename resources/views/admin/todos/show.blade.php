<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Task Details
            </h2>
            <a href="{{ route('admin.todos') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Tasks
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Task Details -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Task Information</h3>

                        <form method="POST" action="{{ route('admin.todos.update', $todo) }}">
                            @csrf
                            @method('PATCH')

                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" value="{{ $todo->title }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="4"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $todo->description }}</textarea>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" name="completed" id="completed" value="1"
                                           {{ $todo->completed ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="completed" class="ml-2 block text-sm text-gray-900">
                                        Mark as completed
                                    </label>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Update Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Task Metadata -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Task Metadata</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <p class="text-gray-900">
                                    @if($todo->completed)
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Completed</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded-full">Pending</span>
                                    @endif
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Assigned to</label>
                                <div class="flex items-center mt-1">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-gray-700">{{ substr($todo->user->name, 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $todo->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $todo->user->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Created</label>
                                <p class="text-gray-900">{{ $todo->created_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                <p class="text-gray-900">{{ $todo->updated_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>

                            @if($todo->completed && $todo->created_at != $todo->updated_at)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Completed At</label>
                                    <p class="text-gray-900">{{ $todo->updated_at->format('F j, Y \a\t g:i A') }}</p>
                                    <p class="text-sm text-gray-500">
                                        Completed in {{ $todo->created_at->diffInHours($todo->updated_at) }} hours
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Task -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-red-600">Danger Zone</h3>
                    <form method="POST" action="{{ route('admin.todos.destroy', $todo) }}">
                        @csrf
                        @method('DELETE')
                        <p class="text-sm text-gray-600 mb-4">
                            Once you delete this task, there is no going back. Please be certain.
                        </p>
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                onclick="return confirm('Are you sure you want to delete this task? This action cannot be undone.')">
                            Delete Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>