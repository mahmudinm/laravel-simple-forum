@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          
            <div class="panel panel-default">
                <div class="panel-heading">Create new topic</div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'home.store_topic'])!!}
                          <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                              {!! Form::label('category_id', 'Categories') !!}
                              {!! Form::select('category_id', $data, null, ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('category_id') }}</small>
                          </div>

                          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              {!! Form::label('title', 'Title') !!}
                              {!! Form::text('title', null, ['class' => 'form-control']) !!}
                              <small class="text-danger">{{ $errors->first('title') }}</small>
                          </div>

                          <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                              {!! Form::label('body', 'Body') !!}
                              {!! Form::textarea('body', null, ['class' => 'form-control ckeditor']) !!}
                              <small class="text-danger">{{ $errors->first('body') }}</small>
                          </div>

                          <div class="form-group">
                            {!! Recaptcha::render() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                </span>
                            @endif
                          </div> 

                          {!! Form::submit('Create new topic', ['class'=>'btn btn-primary btn-block']) !!}
        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script src="js/ckeditor/ckeditor.js"></script>
  <script src="js/ckeditor/config.js"></script>
  
@endsection