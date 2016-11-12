@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <a href="{{ route('forums.categories.threads.create', [$forumId, $categoryId]) }}" class="btn btn-default pull-right">Create new thread</a>
          <br>
          <br>

          <div class="panel panel-default change-panel">
            <div class="panel-heading">
              <b>{{ $category->name }}</b><span class="pull-right glyphicon glyphicon-pushpin"></span>
            </div>
            @foreach($category->threads as $thread)
                <ul class="list-group">
                  <a href="{{ route('threads.show', $thread->slug) }}" class="list-group-item" style="padding:10px 1px">
                    <div class="col-md-10 col-xs-9">
                      {{ $thread->title }} <br>
                      @for ($i = 1; $i < 10; $i++)
                        {{ 'A' }}
                      @endfor
                    </div>
                    <p style="font-size:12px;margin-top:2px;" class="">
                      <span class="fa fa-comments"></span> : 1 <br>
                      <span class="glyphicon glyphicon-eye-open"></span> : 1
                    </p>
                  </a>
                </ul>
            @endforeach
          </div>



        </div>
    </div>
</div>
@endsection

