@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="/css/jasny-bootstrap.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Change password</div>

                <div class="panel-body">
                {!! Form::open(['route' => ['profile.update_password']])!!}

                      <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                          {!! Form::label('password', 'Current Password') !!}
                          {!! Form::password('password', ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('password') }}</small>
                      </div>
                      
                      <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                          {!! Form::label('new_password', 'New Password') !!}
                          {!! Form::password('new_password', ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('new_password') }}</small>
                      </div>

                      <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                          {!! Form::label('new_password_confirmation', 'Confirm Password') !!}
                          {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('new_password_confirmation') }}</small>
                      </div>

                      {!! Form::submit('Change password', ['class' => 'btn btn-info btn-block']) !!}

                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')
  <script src="/js/jasny-bootstrap.js"></script>
@stop
