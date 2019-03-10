@extends('layouts.app')

@section('content')
<?php //$competition = $competition[0]
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$competition->title}}</div>
                <div class="card-body">
                    <h4>about this competition</h4>
                    <p>{{$competition->about}}
                    <h4>how to evaluate</h4>
                    <p>{{$competition->evaluate}}
                    <h4>url to get data</h4>
                    <p>{{$competition->data_url}}
                    <h4>other notices</h4>
                    <p>{{$competition->other}}
                </div>
                <div class="card-header">submit result</div>
                <div class="card-body">
                    @if(Auth::check())
                    <h4>ここにテストのやつを作る</h4>
                    {{Form::open(['url' => '/api/competition/evaluation', 'files' => true])}}
                    <input type="hidden" name="competition_id" value="{{$competition->id}}"/>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/></br>
                    {{Form::label('file', 'upload result file', ['class' => 'control-label']) }}</br>
                    {{Form::file('upload_file') }}</br>
                    {{Form::submit('submit')}}
                    {{Form::close()}}
                    @else
                    <h4>ログインすると結果の投稿ができます</h4>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
