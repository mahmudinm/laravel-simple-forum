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

{!! Form::submit(isset($model) ? 'Update thread' : 'Create new thread', ['class'=>'btn btn-primary btn-block']) !!}
{!! Form::submit('Create new thread', ['class'=>'btn btn-primary btn-block']) !!}