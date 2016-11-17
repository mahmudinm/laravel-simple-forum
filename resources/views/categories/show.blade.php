@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <a href="{{ route('forums.categories.threads.create', [$forumId, $categoryId]) }}" class="btn btn-default pull-right">Create new thread</a>
          <br>
          <br>

          <div class="panel panel-default">
            <div class="panel-heading">
              <b>{{ $category->name }}</b><span class="pull-right glyphicon glyphicon-pushpin"></span>
            </div>

            @if (count($threads) == null)
                <div class="panel-body">
                    Have no post 
                </div>
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
          <span class="pull-right">{!! $threads->links() !!}</span>
        </div>
    </div>
</div>
@endsection
