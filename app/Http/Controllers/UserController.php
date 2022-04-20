<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('user')) {
            abort(403);
        }

        $filter = $request->get('filter');
        $users = User::all();

        if ($filter) {
            $users = User::where('roles', 'ILIKE', $filter)->get();
        }
        
        return view('users.index', ['data' => $users]);
    }

    public function create()
    {
        if (Gate::denies('user')) {
            abort(403);
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        if (Gate::denies('user')) {
            abort(403);
        }

        Validator::make($request->all(), [
            "name" => "required|min:5|max:100",
            "username" => "required|min:5|max:20",
            "roles" => "required",
            "phone" => "required|digits_between:10,12",
            "address" => "required|min:20|max:200",
            "email" => "required|email",
            "password" => "required",
            "password_confirmation" => "required|same:password"
        ])->validate();

        $new_user = new User();

        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->roles = $request->get('roles');
        $new_user->address = $request->get('address');
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));
        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $new_user->avatar = $file;
        }
        $new_user->save();

        if ($new_user->roles == 'admin') {
            $new_user->assignRole('admin');
        } elseif($new_user->roles == 'staff') {
            $new_user->assignRole('staff');
        } else {
            $new_user->assignRole('guru');
        }
        

        return redirect()->route('users.index')->with('create', 'User successfully created');
    }

    public function show($id)
    {
        if (Gate::denies('user')) {
            abort(403);
        }

        $user = User::findOrFail($id);

        return view('users.show', [
            'user' => $user
        ]);
    }

    public function profile($id)
    {
        if ($id != Auth::user()->id) {
            return view('home');
        }
        
        $user = User::findOrFail($id);

        return view('users.profile', [
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        if (Gate::denies('user')) {
            abort(403);
        }

        $user = User::findOrFail($id);

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {

        if (Gate::denies('user')) {
            abort(403);
        }

        Validator::make($request->all(), [
            "name" => "required|min:5|max:100",
            "roles" => "required",
            "phone" => "required|digits_between:10,12",
            "address" => "required|min:20|max:200",
        ])->validate();

        $user = User::findOrFail($id);

        $user->name = $request->get('name');
        $user->roles = $request->get('roles');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->status = $request->get('status');

        if ($request->file('avatar')) {
            if($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                Storage::delete('public/'.$user->avatar);
            }
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }

        if ($request->get('old_password')) {
            if (Hash::check($request->get('old_password'), $user->password)) {
                $user->password = Hash::make($request->get('new_password'));
            } else {
                return redirect()->route('users.profile', $id)->with('failed', 'User failed updated');
            }
        }
       
        $user->save();

        if ($user->roles == 'admin') {
            $user->assignRole('admin');
        } elseif($user->roles == 'staff') {
            $user->assignRole('staff');
        } else {
            $user->assignRole('guru');
        }

        return redirect()->route('users.index')->with('update', 'User succesfully updated');
    }

    public function destroy($id)
    {
        if (Gate::denies('user')) {
            abort(403);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('delete', 'User succesfully deleted');
    }
}
