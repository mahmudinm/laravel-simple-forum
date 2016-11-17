@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          
            <div class="panel panel-default">
                <div class="panel-heading">Create new topic</div>

                <div class="panel-body">
                  {!! Form::model($comment, ['route' => ['topics.comments.update', $topic->slug, $comment->id], 'method' => 'patch'])!!}
                        {{-- to redirect to current page --}}
                        {!! Form::hidden('page', request('page')) !!}
                        @include('comments._form', ['model' => $comment])
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script src="{{ url('js/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ url('js/ckeditor/config.js') }}"></script>
  
@endsection