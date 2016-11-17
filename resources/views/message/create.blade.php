@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
          <img src="{{ url('upload/'.$user->photo) }}" class="img img-rounded img-responsive" style="width:100%;background-color:#fff;">
          <h3>Name : {{ ucwords($user->name) }}</h3>
          <h4>Email : {{ $user->email }}</h4>
        </div>          
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Send message to {{ ucwords($user->name) }}</div>

                <div class="panel-body">
                  {!! Form::open(['route' => ['profile.message.store', $user->id]])!!}
                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            {!! Form::label('subject', 'Subject') !!}
                            {!! Form::text('subject', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('subject') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            {!! Form::label('message', 'Message') !!}
                            {!! Form::textarea('message', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('message') }}</small>
                        </div>

                        {!! Form::submit('Send message', ['class' => 'btn btn-primary pull-right']) !!}
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
