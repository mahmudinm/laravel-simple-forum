@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.partials._list')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <a href="{{ route('admin.forums.create') }}" class="btn btn-default btn-xs pull-right">Create new Forum</a></div>

                <div class="panel-body">
                  @if (count($forums) == null)
                    Have no forum
                  @else
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
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
