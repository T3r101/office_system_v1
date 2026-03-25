<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'is_active' => 'boolean',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable',
            'password' => 'nullable|min:8',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => $request->boolean('is_active', $user->is_active ?? true),
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        $oldData = $user->getOriginal();
        $user->update($updateData);

        // Log update
        \App\Models\SystemLog::create([
            'user_id' => auth()->id(),
            'action' => 'user_updated',
            'description' => 'Updated user: ' . $user->name,
            'details' => [
                'user_id' => $user->id,
                'changes' => array_diff_assoc($user->getAttributes(), $oldData)
            ]
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function toggleStatus(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        \App\Models\SystemLog::create([
            'user_id' => auth()->id(),
            'action' => 'user_status_toggled',
            'description' => 'Toggled status for user: ' . $user->name,
            'details' => ['user_id' => $user->id, 'new_status' => $user->is_active]
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User status updated.');
    }
}

