<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('view users')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $users = User::with('roles')->latest()->get();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('create users')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ], [
            'name.required' => __('messages.name_required'),

            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_invalid'),
            'email.unique' => __('messages.email_unique'),

            'password.required' => __('messages.password_required'),
            'password.min' => __('messages.password_min'),
            'password.confirmed' => __('messages.password_confirmed'),

            'roles.required' => __('messages.roles_required'),
            'roles.*.exists' => __('messages.role_invalid'),
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->syncRoles($validated['roles']);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => __('messages.user_updated_successfully'),
            ]);
        }

        return back()->with('success', __('messages.user_updated_successfully'));
    }

    public function update(Request $request, User $user)
    {

        if (!auth()->user()->can('edit users')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ], [
            'name.required' => __('messages.name_required'),

            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_invalid'),
            'email.unique' => __('messages.email_unique'),

            'password.min' => __('messages.password_min'),
            'password.confirmed' => __('messages.password_confirmed'),

            'roles.required' => __('messages.roles_required'),
            'roles.array' => __('messages.roles_array'),
            'roles.*.exists' => __('messages.role_invalid'),
        ]);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->update([
                'password' => Hash::make($validated['password'])
            ]);
        }

        $user->syncRoles($validated['roles']);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => __('messages.user_updated_successfully'),
            ]);
        }

        return back()->with(
            'success',
            __('messages.user_updated_successfully')
        );
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->can('delete users')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        if ($user->hasRole('Super Admin') && $user->id === auth()->id()) {
            return back()->with(
                'error',
                __('messages.cannot_delete_current_account')
            );
        }

        $user->delete();

        return back()->with(
            'success',
            __('messages.user_deleted_successfully')
        );
    }
}
