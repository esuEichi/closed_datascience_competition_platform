@extends('layouts.app')

@section('content')
<?php $user = $user[0]?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user['name']}}</div>
                @if($user['id'] === Auth::id())
                {{Form::open(['url' => url()->current()])}}
                <p>change your name to <input type="text" name="name" value="{{$user['name']}}"/></p>
                <input type="hidden" name="id" value="{{$user['id']}}"/>
                {{Form::submit('update your information')}}
                {{Form::close()}}
                @endif
                <div class="card-body">
                    <?php $title = ''?>
                    @foreach ($results as $result)
                        @if($result->title !== $title)
                        <h4>{{$result->title}}</h4>
                        <?php $title = $result->title?>
                        @endif
                        <p>{{$result->score}}   :  <span style="color:gray;">{{$result->created_at}}</span></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
