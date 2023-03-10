<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function delete($id)
    {
        $comment = Comment::find($id);
        if(Gate::allows('comment-delete', $comment)) {
            $comment->delete();
            return back()->with("info", "A comment was deleted.");
        }
        return back()->with("info", "Unauthorize to delete this comment.");
    }

    public function add()
    {
        $comment = new Comment;
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return back();
    }
}
