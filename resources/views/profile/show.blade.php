@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        @if (Auth::check())
          @if (Auth::id() == $user->id)
            <a href="{{ route('profile.edit') }}" class="btn btn-default btn-link pull-right">Update profile</a> 
            <a href="{{ route('profile.edit_password') }}" class="btn btn-default btn-link pull-right">Change password</a> 
          @endif
        @endif
          <br>
          <br>
        </div>
        
        <div class="col-md-3">
          <img src="{{ url('upload/'.$user->photo) }}" class="img img-rounded img-responsive" style="width:100%;background-color:#fff;">
          <h3>Name : {{ ucwords($user->name) }}</h3>
          <h4>Email : {{ $user->email }}</h4>
          @if (Auth::check() && Auth::id() != $user->id)  
            <a href="{{ route('profile.message.create', $user->id) }}" class="btn btn-primary btn-block">Send Message</a>
          @endif
        </div>

        <div class="col-md-9">
  
          <div class="panel panel-default">
            <div class="panel-heading">
              <b>Recent Post</b><span class="pull-right glyphicon glyphicon-pushpin"></span>
            </div>

            @if (count($topics) == null)
                <ul class="list-group"> 
                  <a href="#" class="list-group-item">
                    Have no post
                  </a>
                </ul>
            @endif

            @foreach($topics as $topic)
                <ul class="list-group">
                  <a href="{{ route('topics.show', $topic->slug) }}" class="list-group-item" style="padding:10px 1px">
                    <div class="col-md-10 col-xs-9">
                      {{ $topic->title }} <br>
                      @if (count($topic->ratings))
                        @for ($i = 0; $i < $topic->averageRating ; $i++)
                          <i class="glyphicon glyphicon-star" style="color:#f6e729;"></i>
                        @endfor
                      @endif
                    </div>
                    <p style="font-size:12px;margin-top:2px;" class="">
                      <span class="fa fa-comments"></span> : {{ count($topic->comments) }} Replies <br>
                      <span class="glyphicon glyphicon-eye-open"></span> : {{ $topic->views }} Views
                    </p>
                  </a>
                </ul>
            @endforeach
          </div>
          
          <span class="pull-right">{!! $topics->links() !!}</span>
        </div>

    </div>
</div>
@endsection

