<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowsController extends Controller
{
    public function store(Request $request)
    {
        $follower_id = auth()->id();
        $followed_id = $request->get('followed');
        DB::table('follows')->insert([
                'followed_id' => $followed_id,
                'follower_id' => $follower_id]
        );
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $follower_id = auth()->id();
        $followed_id = $request->get('followed');
        DB::delete('delete from follows where followed_id = ? and follower_id = ?', [$followed_id, $follower_id]);
        return redirect()->back();
    }
}
