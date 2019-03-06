@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Users</div>

                @foreach ($user as $item)
                <div class="card-body">
                    <a href="/users/{{$item->name}}">{{$item->name}}</a>
                </div>                        
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
