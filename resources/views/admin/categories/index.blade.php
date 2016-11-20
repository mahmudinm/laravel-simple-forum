@extends('layouts.app')


@section('content')


<div class="container">
    <div class="row">
        @include('admin.partials._list')

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Categories 
                  <a href="{{ route('admin.categories.create') }}" class="btn btn-default btn-xs pull-right">Create new Category</a> 
                  <a href="{{ route('admin.categories.pdf') }}" class="btn btn-default btn-xs pull-right">Export To Pdf</a>
                </div>

                <div class="panel-body">
                  @if (count($categories) == null)
                     Have no category
                  @else
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Forum</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                          <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->forum->name }}</td>
                            <td>
                              {!! Form::model($category, ['route' => ['admin.categories.destroy', $category], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                               <a href="{{ route('admin.categories.edit', $category->id)}}" class="btn btn-sm btn-info">Edit</a> |
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
