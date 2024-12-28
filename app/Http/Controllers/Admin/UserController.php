<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentUserId = auth()->id();
        $users = User::query();

        $users->where('id', '!=', $currentUserId);

        // Filter by role
        if ($request->filled('role')) {
            $users->where('role', $request->role);
        }

        // Search by name or email
        if ($request->filled('search')) {
            $users->where(function ($query) use ($request) {
                $query->where('username', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Mengambil data user dengan pagination
        $users = $users->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.partials.create-modal');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        // Create new user
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Session::flash('success', 'User created successfully.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.partials.edit-modal', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:8|confirmed',
            'captcha' => 'sometimes|required_with:password|captcha',
        ]);

        $user = User::findOrFail($id);

        // Update data user
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Set pesan sukses
        Session::flash('success', 'User berhasil diperbarui.');
        return redirect()->route('admin.users.index');
    }


    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Validasi CAPTCHA
        $validator = Validator::make($request->all(), [
            'captcha' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Captcha tidak valid.');
            return redirect()->route('admin.users.index');
        }

        $user = User::findOrFail($id);

        // Prevent deleting the admin user
        if ($user->role === 'admin') {
            Session::flash('error', 'Cannot delete admin user.');
            return redirect()->route('admin.users.index');
        }

        $user->delete();
        Session::flash('success', 'User deleted successfully.');
        return redirect()->route('admin.users.index');
    }
}
