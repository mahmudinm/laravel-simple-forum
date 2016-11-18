@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Messages for you</div>

                <div class="panel-body">
                  @if (Session::has('error_message'))
                      <div class="alert alert-danger" role="alert">
                          {!! Session::get('error_message') !!}
                      </div>
                  @endif
                  @if($threads->count() > 0)
                      @foreach($threads as $thread)
                      <?php $class = $thread->isUnread($currentUserId) ? 'alert-info alert-important' : 'alert-important'; ?>
                      <div class="media alert {!!$class!!}">
                          <h4 class="media-heading"><a href="{{ route('profile.message.show', [$currentUserId, $thread->id]) }}">{!! $thread->subject !!}</a></h4>
                          <p>{!! $thread->latestMessage->body !!}</p>
                          <p><small><strong>From:</strong> {!! $thread->creator()->name !!}</small></p>
                      </div>
                      @endforeach
                  @else
                      <p>Sorry, no Messages.</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
