<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Competition;
use App\User;
use App\Comment;

class BoardController extends Controller
{
    //
    public function index($title){
        $competition_id = Competition::select('id')->where('title', $title)->first()->id;
        $boards = Board::select('users.name as user_name', 'boards.title as title', 'boards.created_at as created_at')
        ->join('users', 'boards.user_id','=', 'users.id')
        ->where('competition_id', $competition_id)
        ->get();

        return view('boards.index')->with(['boards' => $boards, 'competition_id' => $competition_id]) ;
    }

    public function detail($title, $board_title){
        $competition_id = Competition::select('id')->where('title', $title)->first()->id;
        $board = Board::select('*')
            ->where('title', $board_title)
            ->where('competition_id', $competition_id)
            ->first();
        $comments = Comment::select('*')->where('board_id', $board->id)
            ->orderBy('created_at', 'asc')->get();

        return view('boards.detail')
            ->with(['comments'=> $comments, 
                    'competition_id' => $competition_id,
                    'board' => $board
                    ]);
    }

    public function register(Request $request, $title){
        $competition_id = $request->competition_id;
        $user_id = $request->user_id;
        $title = $request->text;

        $board = new Board;
        $board->competition_id = $competition_id;
        $board->user_id = $user_id;
        $board->title = $title;

        $board->save();

        return redirect()->back();
    }

    public function createNewComment(Request $request){
        $comment = new Comment();
        $comment->board_id = $request->board_id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->text;

        $comment->save();

        return back();

    }
}
