<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Result;
use App\Competition;
use DB;

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
        $results = Result::select('title', 'score')
            ->select('title', 'score','results.created_at as created_at')
            ->where('user_id', $user[0]['id'])
            ->join('competitions', 'competitions.id', '=' , 'results.competition_id')
            ->orderBy('title')
            ->orderBy('score','desc')
            ->get()
            ;

        return view('users.detail')->with(['user' => $user, 'results'=>$results]);
    }
//    public function update(string $name, $id){
    public function update(Request $request){

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->save();
        echo '<p><a href="/users/'.$user->name.'">go your new page</a></p>';
    }

}
