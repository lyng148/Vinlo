<?php

namespace App\Http\AuthHelper;

use Illuminate\Support\Facades\DB;

class PostAuthorCheck
{
    public static function checkValidAuthor ($post_id)
    {
        $author_id = DB::table('posts')->where('id', $post_id)->value('user_id');
        if ($author_id != auth()->id()) {
            return 0;
        }
        return 1;
    }
}
