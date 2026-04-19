<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Details: {{ $user->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Users
                </a>
                @if($user->role !== 'admin')
                    <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                onclick="return confirm('Make this user an admin?')">
                            Make Admin
                        </button>
                    </form>
                @else
                    @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="return confirm('Remove admin privileges from this user?')">
                                Remove Admin
                            </button>
                        </form>
                    @endif
                @endif
            </div>
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- User Info -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">User Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <p class="text-gray-900">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                <p class="text-gray-900">
                                    @if($user->role === 'admin')
                                        <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Administrator</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded-full">Regular User</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Joined</label>
                                <p class="text-gray-900">{{ $user->created_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                <p class="text-gray-900">{{ $user->updated_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Task Statistics</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Tasks:</span>
                                <span class="font-semibold">{{ $stats['total_tasks'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Completed:</span>
                                <span class="font-semibold text-green-600">{{ $stats['completed_tasks'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pending:</span>
                                <span class="font-semibold text-orange-600">{{ $stats['pending_tasks'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Completion Rate:</span>
                                <span class="font-semibold">{{ $stats['completion_rate'] }}%</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Days Active:</span>
                                <span class="font-semibold">{{ $stats['days_active'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Actions</h3>
                        <div class="space-y-3">
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                            onclick="return confirm('Are you sure you want to delete this user and all their tasks? This action cannot be undone.')">
                                        Delete User
                                    </button>
                                </form>
                            @else
                                <p class="text-sm text-gray-500">You cannot delete your own account.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Tasks -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Tasks</h3>
                    <div class="space-y-3">
                        @forelse($user->todos as $todo)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <input type="checkbox"
                                           {{ $todo->completed ? 'checked' : '' }}
                                           class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500"
                                           disabled>
                                    <span class="ml-3 {{ $todo->completed ? 'line-through text-gray-500' : 'text-gray-900' }}">
                                        {{ $todo->title }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    @if($todo->completed)
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Completed</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded-full">Pending</span>
                                    @endif
                                    <span class="text-xs text-gray-500">{{ $todo->created_at->diffForHumans() }}</span>
                                    <a href="{{ route('admin.todos.show', $todo) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No tasks found for this user.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>