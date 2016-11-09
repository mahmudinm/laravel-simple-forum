@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <a href="{{ route('admin.forums.create') }}">Create new forum</a>
                    <table class="table">
                      <thead>
                        <tr>
                          <td>Name</td>
                          <td></td>
                          <td></td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>asd</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
