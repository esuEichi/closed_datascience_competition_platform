@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registering Competition</div>
                <div class="card-body">
                    <?php
                    $size = 'size=80';
                    $rows = 'rows=10';
                    $cols = 'cols=80'
                    ?>
                    
                    {{Form::open(['url' => '/api/competition/register'])}}

                    <input name="user_id" type="hidden" value="{{Auth::user()->id}}">

                    <div>
                    <p>competition title</p>
                    <input name="title" type="text" {{$size}}></input>
                    </div>
                </br>
                    <div>
                    <p>about this competition</p>
                    <textarea name="about" type="text" {{$cols}} {{$rows}}></textarea>
                    </div>
                </br>

                    <div>
                    <p>how to evaluate</p>
                    <textarea name="evaluate" type="text" {{$cols}} {{$rows}}></textarea>
                    </div>
                </br>

                    <div>
                    <p>data(url)</p>
                    <input name="data_url" type="text" {{$size}}></input>
                    </div>
                </br>

                    <div>
                    <p>other notices</p>
                    <textarea name="other" type="text" {{$cols}} {{$rows}}></textarea>
                    </div>
                    {{Form::submit('submit')}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
