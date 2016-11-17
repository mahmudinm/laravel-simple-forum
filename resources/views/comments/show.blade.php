@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12">

        <a href="{{ route('topics.comments.create', $topic->slug) }}" class="btn btn-default " style="">Comment</a>
        <br><br>

        <div class="panel panel-default change-panel">
          <div class="panel-heading">
            <img src="http://i.kaskus.id/e3.1/images/banner-kasads-new.png" alt="" style="width:90px;height:70px;" class="pull-left img-rounded">  
            <div class="topic-panel">
              
              @if(Auth::check() && Auth::user()->id == $topic->user->id)
                <a href="{{ route('topics.edit', $topic->slug) }}" class="btn btn-default pull-right" style="padding:3px 10px;">Edit</a>
              @endif
              <h4>&nbsp;&nbsp;{{ $topic->title }}</h4>
              <h5>&nbsp;&nbsp;&nbsp;<a href="#" style="color:#777;" >nan</a></h5>
            </div>
            <!-- <span class="pull-right glyphicon glyphicon-list"></span> -->
          </div>
          <ul class="list-group">
              <li class="list-group-item">
                {!! $topic->body !!}
              </li>
          </ul>
        </div>

      </div>
    </div>
</div>
@endsection
