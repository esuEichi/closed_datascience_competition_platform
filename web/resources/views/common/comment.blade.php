<?php 
$rows = 'rows=10';
$cols = 'cols=80'
?>
<div class="card-header">{{$title}}</div>
<div class="card-body">
    {{Form::open(['url' => $url])}}
    <input type="hidden" name="competition_id" value="{{$competition_id}}"/>
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/></br>
    @if(!empty($board_id))
    <input type="hidden" name="board_id" value="{{$board_id}}">
    @endif
    <textarea name="text" type="text" placeholder="{{$placeholder}}" {{$rows}}></textarea></br>
    {{Form::submit('submit')}}
    {{Form::close()}}
</div>
