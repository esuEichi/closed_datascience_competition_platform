@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">competitions</div>
                <div class="card-body">
                    @foreach ($competitions as $competition)
                    <p><a href="/competitions/{{$competition->title}}">{{$competition->title}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
