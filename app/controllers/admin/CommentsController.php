<?php

namespace Admin;

class CommentsController extends BaseController
{

    public function getIndex()
    {
        $this->setTitle('List of comments');

        $comments = \Comment::orderBy('id','desc')->get();

        return \View::make('admin.comments.index')
            ->with('comments', $comments);
    }

    public function getDelete($comment_id)
    {
        $comment = \Comment::find($comment_id);

        if( !is_null($comment) )
        {
            // ok - model loaded
            $comment->delete();

            \Session::flash('success', 'Comment deleted');
        }
        else
        {
            \Session::flash('error', 'Unknown comment ID');
        }

        return \Redirect::to('admin/comments');
    }

}
