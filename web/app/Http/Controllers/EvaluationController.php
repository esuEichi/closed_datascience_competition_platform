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

        $result['user_id'] = $request["user_id"];
        $result['competition_id'] = $request["competition_id"];
        // for competition 1
//        $result = $this->evaluate($result, $file);
        // for competition2
        $result = $this->evaluateCompetition2($result, $file);

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

    private function evaluate($result, $file){
        $answer = new \SplFileObject(database_path('answer.csv'));
        $answer = $this->file2array($answer);
        $result_array = $this->file2array($file);

        $result['score'] = $this->calcAccuracy($answer, $result_array);

        return $result; 
    }

    private function evaluateCompetition2($result, $file){
        $answer = new \SplFileObject(database_path('answer.csv'));
        $answer = $this->csv2array($answer);
        $answer_index_0 = $this->getDataByCsvWithIndex($answer,0);
        $answer_index_1 = $this->getDataByCsvWithIndex($answer,1);
        $answer_index_2 = $this->getDataByCsvWithIndex($answer,2);
        $answer_index_3 = $this->getDataByCsvWithIndex($answer,3);
        $answer_index_4 = $this->getDataByCsvWithIndex($answer,4);

        $result_array = $this->file2array($file);
        $result_index_0 = $this->getDataByCsvWithIndex($result_array, 0);    
        $result_index_1 = $this->getDataByCsvWithIndex($result_array, 1);    
        $result_index_2 = $this->getDataByCsvWithIndex($result_array, 2);    
        $result_index_3 = $this->getDataByCsvWithIndex($result_array, 3);    
        $result_index_4 = $this->getDataByCsvWithIndex($result_array, 4);    

        $result['opt_score1'] = $this->calcFMeasureWithArrays($answer_index_0, $result_index_0);
        $result['opt_score2'] = $this->calcFMeasureWithArrays($answer_index_1, $result_index_1);
        $result['opt_score3'] = $this->calcFMeasureWithArrays($answer_index_2, $result_index_2);
        $result['opt_score4'] = $this->calcFMeasureWithArrays($answer_index_3, $result_index_3);
        $result['opt_score5'] = $this->calcFMeasureWithArrays($answer_index_4, $result_index_4);

        $result['score'] = ($result['opt_score1'] + $result['opt_score2'] + $result['opt_score3'] + $result['opt_score4'] + $result['opt_score5']) / 5;

        return $result; 
        //return ($score/$i) * 100;
    }


    private function calcAccuracy($answer, $result_array){
        $i = 0;
        $score = 0;
        while($i < count($answer)){
            if($i < count($result_array) ){
                if((int)$answer[$i] == (int)$result_array[$i][0]){
                    $score++;
                }
            }
            $i++;
        }
        return ($score/$i) * 100;
    }

    private function calcFMeasureWithPrecisionAndRecall($precision, $recall){

        return (2 * $recall * $precision) / ($recall + $precision);
    }

    private function calcFMeasureWithArrays($answerArr, $resultArr){
        $recall = $this->calcRecall($answerArr, $resultArr);
        $precision = $this->calcPrecision($answerArr, $resultArr);

        return $this->calcFMeasureWithPrecisionAndRecall($precision, $recall);
    }

    private function calcPrecision($answer, $result_array){
        $i = 0;
        $score = 0;
        $results = 0;
        while($i < count($answer)){
            if($i < count($result_array) ){
                if((int)$result_array[$i] == 1){
                    $results++;
                    if((int)$answer[$i] == (int)$result_array[$i]){
                        $score++;
                    }
                }
            }
            $i++;
        }
        if($results == 0){
            return 0;
        }
        return ($score/$results);

    }

    private function calcRecall($answer, $result_array){
        $i = 0;
        $score = 0;
        $results = 0;
        while($i < count($answer)){
            if($i < count($result_array)) {
                if((int)$answer[$i] == 1){
                    $results++;

                    if((int)$answer[$i] == (int)$result_array[$i]){
                        $score++;
                    }    
                }
            }
            $i++;
        }

        if($results == 0){
            return 0;
        }
        return ($score/$results);

    }

    private function file2array($file){
        $arr = Array();
        foreach($file as $line){
            array_push($arr, $line);
        }
        return $arr;

    }

    private function csv2array($file){
        $temp = $this->file2array($file);
        $arr = Array();

        foreach($temp as $line){
            array_push($arr, explode(',', $line));
        }

        return $arr;

    }

    private function getDataByCsvWithIndex($csv_array, $index){
        $arr = Array();
        foreach($csv_array as $data){
            
            if(!is_null($data)){
                array_push($arr, $data[$index]);
            }else{
                array_push($arr, "");
            }
            
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
