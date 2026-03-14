<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a list of all staff users.
     */
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'receptionist'])
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,receptionist',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = $validated['role'] === 'admin';

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.users.created_success'));
    }

    /**
     * Show the form to edit another user (receptionist or admin).
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update an existing user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        // If editing own profile, redirect to profile page
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.profile.edit')
                ->with('success', __('messages.users.updated_success'));
        }

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.users.updated_success'));
    }

    /**
     * Delete a user (only receptionists can be deleted, not self or other admins).
     */
    public function destroy(User $user)
    {
        // Cannot delete yourself
        if ($user->id === auth()->id()) {
            return back()->with('error', __('messages.users.cannot_delete_self'));
        }

        // Cannot delete other admins
        if ($user->isAdmin()) {
            return back()->with('error', __('messages.users.cannot_delete_admin'));
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.users.deleted_success'));
    }

    /**
     * Show profile edit form for the current admin.
     */
    public function profile()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }

    /**
     * Update the current admin's profile.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.profile.edit')
            ->with('success', __('messages.users.profile_updated'));
    }
}
