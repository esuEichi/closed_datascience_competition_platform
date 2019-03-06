<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\Result;

class CompetitionController extends Controller
{
    //
    public function index(){
        return view('competitions.index')->with('competitions', Competition::all());
    }

    public function detail(string $title){
        $competition = Competition::where('title','LIKE', $title)->firstOrFail();
        return view('competitions.detail')->with('competition', $competition);
    }

    public function register(Request $request){
        $competition = Array();
        $competition["registered_user_id"] = $request['user_id'];
        $competition["title"]              = $request['title'];
        $competition["about"]              = $request['about'];
        $competition["evaluate"]           = $request['evaluate'];
        $competition["data_url"]           = $request['data_url'];
        $competition["other"]              = $request['other'];
        
        Competition::insert($competition);
        return redirect('competitions/'.$competition["title"]);
    }

    public function results($title){
        $competition = Competition::where('title','LIKE', $title)->firstOrFail();
        $competition_id = $competition["id"];
        $title = $competition["title"];
        $results = Result::where('competition_id' ,$competition_id)->join('users','users.id','results.user_id')->orderBy('score', 'desc')->get();
        return view('competitions.result')->with(['results'=>$results, 'title'=>$title]);
    }
}
