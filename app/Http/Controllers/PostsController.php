<?php

namespace App\Http\Controllers;

use App\Http\AuthHelper\PostAuthorCheck;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class PostsController extends Controller
{
    public function latest()
    {
        $posts = DB::select('select *, posts.id as post_id from posts join users on posts.user_id = users.id ORDER BY posts.created_at DESC');
        return view("posts.index", [
            'posts' => $posts
        ]);
    }

    public function following()
    {
        $posts = DB::select('select *, posts.id as post_id from posts join users on posts.user_id = users.id where users.id in (select follows.followed_id from follows where follows.follower_id = ?) ORDER BY posts.created_at DESC', [auth()->id()]);
        return view("posts.index", [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $date = now();
        $user_id = auth()->id();
        DB::table('posts')->insert([
            'user_id' => $user_id,
            'title' => $title,
            'body' => $body,
            'created_at' => $date
        ]);
        return redirect('/posts');
    }

    public function show($id)
    {
        $post = DB::select('select *,posts.id as post_id from posts join users on users.id = posts.user_id where posts.id = ?', [$id]);
        $comments = DB::select('select * from comments join users on comments.user_id = users.id where post_id = ? order by comments.created_at DESC', [$id]);
        $vote_num = DB::select('select sum(status) as vote_num from votes where post_id = ?', [$id]);
        $is_voted = DB::select('select status from votes where post_id = ?', [$id]);
        $vote_type = 0;
        if (empty($is_voted) || $is_voted[0]->status == 0) {
            $voteType = 0;
        } else if ($is_voted[0]->status == 1) {
            $vote_type = 1;
        } else if ($is_voted[0]->status == -1) {
            $vote_type = -1;
        }
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments,
            'vote_num' => $vote_num,
            'vote_type' => $vote_type,
        ]);
    }

    public function edit($post_id)
    {
        $checkValidAuthor = PostAuthorCheck::checkValidAuthor($post_id);
        if (!$checkValidAuthor) {
            return redirect('/posts');
        }
        $post = DB::select('select * from posts where id = ?', [$post_id]);
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, $post_id)
    {
        $checkValidAuthor = PostAuthorCheck::checkValidAuthor($post_id);
        if (!$checkValidAuthor) {
            return redirect('/posts');
        }
        $title = $request->input('title');
        $body = $request->input('body');
        $date = now();
        $user_id = auth()->id();
        DB::table('posts')
            ->where('id', $post_id)
            ->update([
                'user_id' => $user_id,
                'title' => $title,
                'body' => $body,
                'created_at' => $date
            ]);
        return redirect('/users/' . $user_id);
    }

    public function delete($post_id)
    {
        $checkValidAuthor = PostAuthorCheck::checkValidAuthor($post_id);
        if (!$checkValidAuthor) {
            return redirect('/posts');
        }
        DB::table('posts')->where('id', $post_id)->delete();
        return redirect()->back();
    }

}
