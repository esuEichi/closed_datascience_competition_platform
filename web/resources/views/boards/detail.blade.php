@extends('layouts.app')

@section('content')
<?php
use \App\User;
use \App\Board;
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">{{$board->title}}</div>
            <div class="card-body">
                <h5>opened by: {{User::where('id', $board->user_id)->pluck('name')[0]}}</h5>
                <p><span style="font-size: 14px">{{$board->created_at}}</span></p>
            </div>


            <div class="card">
                @component('common.comment')
                    @slot('title')
                    add new comment
                    @endslot
                    @slot('url')
                    {{url()->current()}}
                    @endslot
                    @slot('competition_id')
                    {{$competition_id}}
                    @endslot
                    @slot('board_id')
                    {{$board->id}}
                    @endslot
                    @slot('placeholder')
                    new comment
                    @endslot
                @endcomponent
                @foreach ($comments as $comment)
                
                <div class="card-body">
                    <p>{!!preg_replace('/\r\n|\r|\n/', '</br>', $comment->comment)!!}</p>
                    <p><span style="font-size: 12px; color:gray;">posted by: {{User::where('id', $comment->user_id)->pluck('name')[0]}}<span style="font-size: 14px"></p>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
