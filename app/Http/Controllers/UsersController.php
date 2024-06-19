<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function show($id)
    {
        $user = DB::select('select * from users where id = ?', [$id]);
        $posts = DB::select('select * from posts where user_id = ? order by created_at desc ', [$id]);
        $numberOfFollowers = DB::select('select count(*) as count from follows where followed_id = ?', [$id]);
        $isFollowing = DB::select('select count(*) as count from follows where followed_id = ? and follower_id = ?', [$id, auth()->id()]);
        $followers = DB::select('select * from users where id in (select follower_id from follows where followed_id = ?)', [$id]);
        return view('users.profile', [
            'user' => $user,
            'posts' => $posts,
            'numberOfFollowers' => $numberOfFollowers,
            'isFollowing' => $isFollowing,
            'followers' => $followers
        ]);
    }

    public function edit($id)
    {
        if ($id != auth()->id()) {
            return redirect('/posts');
        }
        $user = DB::select('select * from users where id = ?', [$id]);
        return view('users.edit', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        // Validate and update user profile
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect("users/".auth()->id()."/edit/profile")->with('success', 'Profile updated successfully.');
    }


    public function updateEmail(Request $request)
    {
        // Validate and update user email
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        return redirect("users/".auth()->id()."/edit/email")->with('success', 'Email updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        // Validate and update user password
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
        if ($request->get('password') !== $request->get('password_confirmation')) {
            return back()->withErrors(['password_confirmation' => 'Password confirmation does not match']);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect("/users/".auth()->id()."/edit/password")->with('success', 'Password updated successfully.');
    }

    public function updateAvatar(Request $request){
        $request->validate([
            'avatar' => 'required|image',
        ]);

        $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('avatars'), $avatarName);

        Auth()->user()->update(['avatar'=>$avatarName]);

        return back()->with('success', 'Avatar updated successfully.');
    }

}
