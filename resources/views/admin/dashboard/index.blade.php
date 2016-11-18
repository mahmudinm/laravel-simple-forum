@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.partials._list')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Dashboard
                </div>
                <div class="panel-body">
                  Welcome To  Dashboard
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
