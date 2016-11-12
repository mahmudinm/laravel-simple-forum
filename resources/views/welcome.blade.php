@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="#" class="btn btn-default">Create new thread</a>
            <br>
            <br>
        </div>
        
        <div class="col-md-2">
          <div class="list-group">
            <a class="list-group-item active">Forum</a>
            <a href="#" class="list-group-item">Item 2</a>
            <a href="#" class="list-group-item">Item 3</a>
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

