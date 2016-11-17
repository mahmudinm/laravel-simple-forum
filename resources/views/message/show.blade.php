@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <h1>{!! $thread->subject !!}</h1>

          @foreach($thread->messages as $message)
              <div class="media">
                  <a class="pull-left" href="#">
                      <img src="/upload/{{ $message->user->photo }}" alt="{!! $message->user->name !!}" class="img img-responsive img-rounded" style="width:100px;">
                  </a>
                  <div class="media-body">
                      <h5 class="media-heading"><a href="{{ route('profile.show', $message->user->id) }}">{!! $message->user->name !!}</a></h5>
                      <p>{!! $message->body !!}</p>
                      <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                  </div>
              </div>
          @endforeach

          <h2>Add a new message</h2>
          {!! Form::open(['route' => ['profile.message.update', $profileId, $thread->id], 'method' => 'PUT']) !!}
          <!-- Message Form Input -->
          <div class="form-group">
              {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
          </div>


          <!-- Submit Form Input -->
          <div class="form-group">
              {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
          </div>
          {!! Form::close() !!}
      </div>    
    </div>
  </div>
@stop