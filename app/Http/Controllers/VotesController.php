<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotesController extends Controller
{

    public function upvote($post_id)
    {
        $user_id = auth()->id();
        $existingVote = DB::select('select * from votes where post_id = ? and user_id = ?', [$post_id, $user_id]);

        if (!empty($existingVote)) {
            DB::update('update votes set status = 1 where post_id = ? and user_id = ?', [$post_id, $user_id]);
        } else {
            // Bản ghi chưa tồn tại
            // Thêm bản ghi mới vào bảng votes
            DB::table('votes')->insert([
                'user_id' => $user_id,
                'post_id' => $post_id,
                'status' => '1'
            ]);
        }
        return redirect()->back();
    }

    public function downvote($post_id)
    {
        $user_id = auth()->id();

        $existingVote = DB::select('select * from votes where post_id = ? and user_id = ?', [$post_id, $user_id]);

        if ($existingVote) {
            DB::update('update votes set status = -1 where post_id = ? and user_id = ?', [$post_id, $user_id]);
        } else {
            // Bản ghi chưa tồn tại
            // Thêm bản ghi mới vào bảng votes
            DB::table('votes')->insert([
                'user_id' => $user_id,
                'post_id' => $post_id,
                'status' => '-1'
            ]);
        }
        return redirect()->back();
    }

    public function unvote($post_id)
    {
        $user_id = auth()->id();

        $existingVote = DB::select('select * from votes where post_id = ? and user_id = ?', [$post_id, $user_id]);

        if ($existingVote) {
            DB::update('update votes set status = 0 where post_id = ? and user_id = ?', [$post_id, $user_id]);
        } else {
            // Bản ghi chưa tồn tại
            // Thêm bản ghi mới vào bảng votes
            DB::table('votes')->insert([
                'user_id' => $user_id,
                'post_id' => $post_id,
                'status' => '0'
            ]);
        }
        return redirect()->back();
    }
}
