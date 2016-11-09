@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  {!! Form::model($forum, ['route' => ['admin.forums.update', $forum], 'method' => 'patch'])!!}
                        @include('admin.forums._form', ['model' => $forum])
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
