@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <a href="{{ route('profile.edit', $user) }}" class="btn btn-default btn-link pull-right">Update profile</a> 
          <a href="{{ route('home.create_thread') }}" class="btn btn-default btn-link pull-right">Change password</a> 
          <br>
          <br>
        </div>
        
        <div class="col-md-3">
          <img src="{{ url('upload/'.$user->photo) }}" class="img img-rounded img-responsive" style="width:100%;background-color:#fff;">
          <h3>Name : {{ ucwords($user->name) }}</h3>
          <h4>Email : {{ $user->email }}</h4>
          <h4>No.hp : 081231233123</h4>
          <a href="#" class="btn btn-info btn-block">Send message</a>
        </div>
        <div class="col-md-9">
          
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

