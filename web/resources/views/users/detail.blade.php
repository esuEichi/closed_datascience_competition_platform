@extends('layouts.app')

@section('content')
<?php $user = $user[0]?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user['name']}}</div>

                <div class="card-body">
                    <?php $title = ''?>
                    @foreach ($results as $result)
                        @if($result->title !== $title)
                        <h4>{{$result->title}}</h4>
                        <?php $title = $result->title?>
                        @endif
                        <p>{{$result->score}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
