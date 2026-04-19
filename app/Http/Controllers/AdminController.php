<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Comprehensive admin dashboard data
        $totalUsers = User::count();
        $totalTodos = Todo::count();
        $completedTodos = Todo::where('completed', true)->count();
        $pendingTodos = $totalTodos - $completedTodos;
        $adminUsers = User::where('role', 'admin')->count();

        // Recent activity
        $recentUsers = User::latest()->take(5)->get();
        $recentTodos = Todo::with('user')->latest()->take(10)->get();
        // User engagement stats
        $activeUsers = User::whereHas('todos', function($query) {
            $query->where('created_at', '>=', now()->subDays(7));
        })->count();

        // Task completion trends
        $weeklyCompletions = Todo::where('completed', true)
            ->where('updated_at', '>=', now()->subDays(7))
            ->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTodos',
            'completedTodos',
            'pendingTodos',
            'adminUsers',
            'recentUsers',
            'recentTodos',
            'activeUsers',
            'weeklyCompletions'
        ));
    }

    public function users()
    {
        $users = User::withCount('todos')
            ->withCount(['todos as completed_todos_count' => function($query) {
                $query->where('completed', true);
            }])
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function showUser(User $user)
    {
        $user->load(['todos' => function($query) {
            $query->latest()->take(10);
        }]);

        $stats = [
            'total_tasks' => $user->todos()->count(),
            'completed_tasks' => $user->todos()->where('completed', true)->count(),
            'pending_tasks' => $user->todos()->where('completed', false)->count(),
            'completion_rate' => $user->todos()->count() > 0
                ? round(($user->todos()->where('completed', true)->count() / $user->todos()->count()) * 100, 1)
                : 0,
            'days_active' => $user->todos()->count() > 0
                ? $user->todos()->oldest()->first()->created_at->diffInDays(now())
                : 0,
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }

    public function toggleAdmin(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot modify your own admin status.');
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        $message = $user->role === 'admin' ? 'User has been granted admin privileges.' : 'Admin privileges have been removed from user.';

        return back()->with('success', $message);
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->todos()->delete(); // Delete associated todos
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User and their tasks have been deleted successfully.');
    }

    public function todos()
    {
        $todos = Todo::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.todos.index', compact('todos'));
    }

    public function showTodo(Todo $todo)
    {
        $todo->load('user');
        return view('admin.todos.show', compact('todo'));
    }

    public function updateTodo(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);

        $todo->update($request->only(['title', 'description', 'completed']));

        return back()->with('success', 'Task updated successfully.');
    }

    public function deleteTodo(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('admin.todos')->with('success', 'Task deleted successfully.');
    }

    public function createAdmin()
    {
        return view('admin.create-admin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Admin user created successfully.');
    }
}
