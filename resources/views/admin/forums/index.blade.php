@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <a href="{{ route('admin.forums.create') }}">Create new forum</a>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($forums as $forum)
                        <tr>
                          <td>{{ $forum->name }}</td>
                          <td>
                            {!! Form::model($forum, ['route' => ['admin.forums.destroy', $forum], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                             <a href="{{ route('admin.forums.edit', $forum->id)}}" class="btn btn-sm btn-info">Edit</a> |
                              {!! Form::submit('Delete', ['class'=>'btn btn-sm btn-danger']) !!}
                            {!! Form::close()!!}
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
