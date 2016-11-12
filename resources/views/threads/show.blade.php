@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12">
          
          
          <a href="{{ route('threads.comments.create', [$thread->slug]) }}" 
             class="btn btn-default pull-left 
             {{ count($comments->total() >= 50) ? 'disabled' : '' }}">Comment</a>
          <span class="pull-right" style="margin-top:-20px;height:70px;">          
            {!! $comments->links() !!}
          </span>
          <br><br>

        <div class="panel panel-default change-panel">
          <div class="panel-heading">
            <img src="http://i.kaskus.id/e3.1/images/banner-kasads-new.png" alt="" style="width:90px;height:70px;" class="pull-left img-rounded">  
            <div class="thread-panel">
              
              @if(Auth::check() && Auth::user()->id == $thread->user->id)
                <a href="{{ route('threads.edit', $thread->slug) }}" class="btn btn-default pull-right" style="padding:3px 10px;">Edit</a>
              @endif
              <h4>&nbsp;&nbsp;{{ $thread->title }}</h4>
              <h5>&nbsp;&nbsp;&nbsp;<a href="#" style="color:#777;" >{{ ucwords($thread->user->name) }}</a></h5>
            </div>
          </div>
          <ul class="list-group">
              <li class="list-group-item">
                {!! $thread->body !!}
              </li>
          </ul>
        </div>

        @foreach ($comments as $comment)
          <div class="panel panel-default change-panel">
            <div class="panel-heading" style="padding-bottom:15px;">
              <img src="http://i.kaskus.id/e3.1/images/banner-kasads-new.png"  style="width:90px;height:70px;" class="pull-left img-rounded">  
              <div class="thread-panel">                
                @if(Auth::check() && Auth::user()->id == $thread->user->id)
                  <a href="{{ route('threads.comments.edit', [$thread->slug, $comment->id, 'page' => $comments->currentPage()]) }}" class="btn btn-default pull-right" style="padding:3px 10px;">Edit Comment</a>
                @endif
                <h5>&nbsp;&nbsp;&nbsp;<a href="#" style="color:#777;" >{{ ucwords($comment->user->name) }}</a></h5>
                <h5>&nbsp;&nbsp;{{ $comment->created_at }}</h5>
              </div>
            </div>

            <ul class="list-group">
                <li class="list-group-item">
                  {!! $comment->body !!}
                </li>
            </ul>
          </div>
        @endforeach
        
        <span class="pull-right">          
          {!! $comments->links() !!}
        </span>
    

      </div>
    </div>
</div>
@endsection
