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
        $result = new Result;

        $file = $this->getUploadedFileFromRequest($request);
        $this->validFile($file);
        $score = $this->evaluate($file);

        $result['score'] = $score;
        $result['user_id'] = $request["user_id"];
        $result['competition_id'] = $request["competition_id"];
        $result->save();

        $this->redirectToResult($request->competition_id, $result);
    }

    private function getUploadedFileFromRequest($request){
        $file_property = 'upload_file';

        $uploaded_file = $request->file($file_property);
        $file_path = $request->file($file_property)->path($uploaded_file);
        $file = new \SplFileObject($file_path);

        $file->setFlags(\SplFileObject::READ_CSV); 

        return $file;
    }

    private function validFile($file){
        return true;
    }

    private function evaluate($file){
        $answer = new \SplFileObject(database_path('answer.csv'));
        $answer = $this->file2array($answer);
        $result = $this->file2array($file);

        $i = 0;
        $score = 0;
        while($i < count($answer)){
            if($i < count($result) ){
                if((int)$answer[$i] == (int)$result[$i][0]){
                    $score++;
                }
            }
            $i++;
        }

        return ($score/$i) * 100;
    }

    private function file2array($file){
        $arr = Array();
        foreach($file as $line){
            array_push($arr, $line);
        }
        return $arr;
    }

    private function redirectToResult($competition_id, $result){
        $title = Competition::where('id', $competition_id)->pluck('title')->first();
        $url = '/competitions/'.$title.'/results';
        echo '<p>score is '.$result->score.'</p>';
        echo '<a href="'.$url.'">'.'other results'.'</a>';
    }
}
