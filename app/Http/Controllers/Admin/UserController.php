<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller {
    public function index() {
        $users = User::with('roles')->latest()->get();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->syncRoles($validated['roles']);

        return back()->with('success', 'تم إضافة المستخدم بنجاح');
    }

    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        $user->syncRoles($validated['roles']);

        return back()->with('success', 'تم تحديث بيانات المستخدم بنجاح');
    }

    public function destroy(User $user) {
        // منع حذف المدير العام لنفسه أو للمستخدم الرئيسي
        if ($user->hasRole('Super Admin') && $user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الحالي');
        }

        $user->delete();
        return back()->with('success', 'تم حذف المستخدم بنجاح');
    }
}
