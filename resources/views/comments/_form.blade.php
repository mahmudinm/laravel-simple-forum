<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    {!! Form::label('body', 'Body') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control ckeditor']) !!}
    <small class="text-danger">{{ $errors->first('body') }}</small>
</div>



@if (!isset($model))
<div class="form-group">
  {!! Recaptcha::render() !!}
  @if ($errors->has('g-recaptcha-response'))
      <span class="help-block">
          <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
      </span>
  @endif
</div> 
@endif


{!! Form::submit(isset($model) ? 'Update' : 'Create', ['class'=>'btn btn-primary btn-block']) !!}

