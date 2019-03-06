@extends('layouts.app')

@section('content')
<?php //$competition = $competition[0]
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$title}} lanking</div>
                <div class="card-body">
                </div>
                <div class="card-body">
                    @foreach ($results as $result)
                    <p>{{$result->name}}: {{$result->score}} : {{$result->createdAt}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
