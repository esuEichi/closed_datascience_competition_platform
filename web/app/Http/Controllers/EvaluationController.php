<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Result;
use App\Competition;
use App\User;
use Illuminate\Routing\Redirector;

use Illuminate\Support\Facades\Auth; 

class EvaluationController extends Controller
{
    //
    public function index(Request $request){
        //TODO ファイルを受け取ってスコア計算して結果を受け取る
        $this->validFile();
        $score = $this->evaluate();        
        $result = new Result;
        $result['score'] = $score;
        $result['user_id'] = $request["user_id"];
        $result['competition_id'] = $request["competition_id"];
        $result->save();

        //return redirect()->to(url()->current());
        $this->redirectToResult($request->competition_id);
    }

    //file を受け取って形式があっているかをチェックする関数
    private function validFile(){
        //git 連携していないvalidation用の関数を作る
        return true;
    }

    private function evaluate(){
        //スコア計算のメソッドを作る
        //当てで乱数を生成する
        return rand(60, 100);
    }

    private function redirectToResult($competition_id){
        $title = Competition::where('id', $competition_id)->pluck('title')->first();
        $url = '/competitions/'.$title.'/results';
        //var_dump($url);
        echo '<a href="'.$url.'">'.'result'.'</a>';
        //redirect()->to($url)->withInput()->withInput();
    }
}
