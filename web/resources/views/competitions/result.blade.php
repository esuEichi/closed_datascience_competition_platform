@extends('layouts.app')

@section('content')
<?php //$competition = $competition[0]
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$title}} ranking</div>
                <div class="card-body">
                </div>
                @foreach ($results as $result)
                <div class="card-body">
                    <p><a href='/users/{{$result->name}}'>{{$result->name}}</a>
                        score: {{$result->score}}
                        @if(!empty($result->opt_score1))
                        <br/>opt_score1 : {{$result->opt_score1}}
                        @endif
                        @if(!empty($result->opt_score2))
                        <br/>opt_score2 : {{$result->opt_score2}}
                        @endif
                        @if(!empty($result->opt_score3))
                        <br/>opt_score3 : {{$result->opt_score3}}
                        @endif
                        @if(!empty($result->opt_score4))
                        <br/>opt_score4 : {{$result->opt_score4}}
                        @endif
                        @if(!empty($result->opt_score5))
                        <br/>opt_score5 : {{$result->opt_score5}}
                        @endif
                        @if(!empty($result->opt_score6))
                        <br/>opt_score6 : {{$result->opt_score6}}
                        @endif
                        @if(!empty($result->opt_score7))
                        <br/>opt_score7 : {{$result->opt_score7}}
                        @endif
                        @if(!empty($result->opt_score8))
                        <br/>opt_score8 : {{$result->opt_score8}}
                        @endif
                        {{$result->createdAt}}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
