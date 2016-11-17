@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <a href="{{ route('home.create_thread') }}" class="btn btn-default pull-right">Create new thread</a>
          <br>
          <br>
        </div>
        
        <div class="col-md-2">
          <div class="list-group">
            <a class="list-group-item active">Forum</a>
            @if (count($forums) == null)
              <a href="#" class="list-group-item">Have no forum</a>
            @endif
            @foreach ($forums as $forum)
              <a href="{{ route('forums.show', $forum) }}" class="list-group-item">{{ $forum->name }}</a>
            @endforeach
          </div>
        </div>
        <div class="col-md-10">
          

          <div class="panel panel-default">
            <div class="panel-heading">
              <b>Recent Post</b><span class="pull-right glyphicon glyphicon-pushpin"></span>
            </div>

            @if (count($threads) == null)
                <ul class="list-group"> 
                  <a href="#" class="list-group-item" style="padding:10px 1px">
                    Have no post
                  </a>
                </ul>
            @endif

            @foreach($threads as $thread)
                <ul class="list-group">
                  <a href="{{ route('threads.show', $thread->slug) }}" class="list-group-item" style="padding:10px 1px">
                    <div class="col-md-10 col-xs-9">
                      {{ $thread->title }} <br>
                      @if (count($thread->ratings))
                        @for ($i = 0; $i < $thread->averageRating ; $i++)
                          <i class="glyphicon glyphicon-star" style="color:#f6e729;"></i>
                        @endfor
                      @else
                        @for ($i = 0; $i < 5; $i++)
                          <i class="glyphicon glyphicon-star-empty" style="color:#f6e729;"></i>
                        @endfor
                      @endif
                    </div>
                    <p style="font-size:12px;margin-top:2px;" class="">
                      <span class="fa fa-comments"></span> : {{ count($thread->comments) }} Replies <br>
                      <span class="glyphicon glyphicon-eye-open"></span> : {{ $thread->views }} Views
                    </p>
                  </a>
                </ul>
            @endforeach
          </div>

        </div>
    </div>
</div>
@endsection

