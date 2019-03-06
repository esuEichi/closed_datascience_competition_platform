<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Result;
use App\Competition;


class UserController extends Controller
{
    //
    public function index(){
        $users = User::all();
        return view('users.index')->with('user', $users);
    }
    public function detail(string $user_name)
    {
        $user = User::where('name', $user_name)->get()->toArray();
        $results = Result::select('title', 'score', 'created_at')
            ->where('user_id', $user[0]['id'])
            ->join('competitions', 'competitions.id', '=' , 'results.competition_id')
            //->pluck('title', 'score')
            ->orderBy('title','asc')
            ->orderBy('score', 'desc')
            ->get();
        return view('users.detail')->with(['user' => $user, 'results'=>$results]);
    }
}
