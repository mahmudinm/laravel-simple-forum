@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.partials._list')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <a href="{{ route('admin.forums.create') }}" class="btn btn-default btn-xs pull-right">Create new Forum</a></div>

                <div class="panel-body">
                  Dashboard
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
