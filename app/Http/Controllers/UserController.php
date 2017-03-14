<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listUser()
    {
        $users = User::get();
        return view('user.list')->with('users', $users);
    }

    public function showUser($id)
    {
        $user = User::find($id);
        return view('user.show')->with('user', $user);
    }

    public function createForm()
    {
        return view('user.create');
    }

    public function createUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'level' => 'required|in:ADMIN',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();

        return redirect()->action('UserController@showUser', [$user->id]);
    }

    public function updateForm($id)
    {
        $user = User::find($id);
        return view('user.update')->with('user', $user);
    }

    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'level' => 'required|in:ADMIN,SEKRE',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->save();

        return redirect()->action('UserController@showUser', [$user->id]);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->action('UserController@listUser');
    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->action('UserController@showUser', [$user->id]);
    }
}
