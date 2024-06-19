<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function store($id, Request $request)
    {
        $body = $request->get('body');
        $user_id = auth()->id();
        $post_id = $request->get('post_id');
        DB::table('comments')->insert([
            'body' => $body,
            'user_id' => $user_id,
            'post_id' => $id,
            'created_at' => now(),
        ]);
        return redirect()->back();
    }
}
