@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="/css/jasny-bootstrap.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">Update Profile</div>

                <div class="panel-body">
                {!! Form::model($user, ['route' => ['profile.update'], 'method' => 'patch', 'files'  => true])!!}
                          
                          <input type="hidden" name="id" value="{{ $user->id }}">
                          {{-- Jasny bootstrap file input --}}
                          <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="{{ url('upload/'.$user->photo) }}" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                            <div>
                              <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                {!! Form::file('photo') !!}
                              </span>
                              <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                              <small class="text-danger">{{ $errors->first('photo') }}</small>
                            </div>
                          </div>
 


                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              {!! Form::label('name', 'Name') !!}
                              {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('name') }}</small>
                          </div>

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              {!! Form::label('email', 'Email address') !!}
                              {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'disabled']) !!}
                              <small class="text-danger">{{ $errors->first('email') }}</small>
                          </div>
                          {!! Form::submit('Update', ['class' => 'btn btn-info btn-block']) !!}


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
