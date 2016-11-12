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
            @foreach ($forums as $forum)
              <a href="{{ route('forums.show', $forum) }}" class="list-group-item">{{ $forum->name }}</a>
            @endforeach
          </div>
        </div>
        <div class="col-md-10">
          
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

