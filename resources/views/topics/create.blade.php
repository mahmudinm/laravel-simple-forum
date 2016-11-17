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
                    {!! Form::open(['route' => ['forums.categories.topics.store', $forumId, $categoryId]])!!}
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
  <script src="{{ url('js/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ url('js/ckeditor/config.js') }}"></script>
  
@endsection