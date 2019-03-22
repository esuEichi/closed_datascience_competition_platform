@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @component('common.comment')
                    @slot('title')
                    open new discusion
                    @endslot
                    @slot('url')
                    {{url()->current()}}
                    @endslot
                    @slot('competition_id')
                    {{$competition_id}}
                    @endslot
                    @slot('placeholder')
                    board title
                    @endslot
                @endcomponent
                <h3><boards of this competition/h3>
                @foreach ($boards as $board)
                <div class="card-header"><a href="{{url()->current()}}/{{$board->title}}">{{$board->title}}</a></div>
                <div class="card-body">
                    <h5>opened by: {{$board->user_name}}</h5>
                    <p><span style="font-size: 14px">{{$board->created_at}}</span></p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
