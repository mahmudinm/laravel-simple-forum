@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12">
          

        <a href="{{ route('topics.comments.create', [$topic->slug]) }}" 
           class="btn btn-default pull-left">Comment</a>
           
        <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
            {!! Form::label('rating', 'Give Rating', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-9">
            {!! Form::hidden('rating', null, ['class' => 'rating', 'id' => 'rating']) !!}  
          </div>
        </div>

        <span class="pull-right" style="margin-top:-45px;height:70px;">          
          {!! $comments->links() !!}
        </span>
        <br>
        <br>


        {{-- Post page --}}

        @if (!request('page') == 1 or request('page') == 1)
          <div class="panel panel-default change-panel">
            <div class="panel-heading">
              <img src="http://i.kaskus.id/e3.1/images/banner-kasads-new.png" alt="" style="width:90px;height:70px;" class="pull-left img-rounded">  
              <div class="topic-panel">
                
                @if(Auth::check() && Auth::user()->id == $topic->user->id)
                  <a href="{{ route('topics.edit', $topic->slug) }}" class="btn btn-default pull-right" style="padding:3px 10px;">Edit</a>
                @endif
                <h4>&nbsp;&nbsp;{{ $topic->title }}</h4>
                <h5>&nbsp;&nbsp;&nbsp;<a href="#" style="color:#777;" >{{ ucwords($topic->user->name) }}</a></h5>
              </div>
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                  {!! $topic->body !!}
                </li>
            </ul>
          </div>
        @endif


        {{-- Comment page --}}

        @foreach ($comments as $comment)
          <div class="panel panel-default change-panel">
            <div class="panel-heading" style="padding-bottom:15px;">
              <img src="http://i.kaskus.id/e3.1/images/banner-kasads-new.png"  style="width:90px;height:70px;" class="pull-left img-rounded">  
              <div class="topic-panel">                
                @if(Auth::check() && Auth::user()->id == $comment->user_id)
                  <a href="{{ route('topics.comments.edit', [$topic->slug, $comment->id, 'page' => $comments->currentPage()]) }}" class="btn btn-default pull-right" style="padding:3px 10px;">Edit Comment</a>
                @endif
                <h5>&nbsp;&nbsp;&nbsp;<a href="#" style="color:#777;" >{{ ucwords($comment->user->name) }}</a></h5>
                <h5>&nbsp;&nbsp;{{ $comment->created_at }}</h5>
              </div>
            </div>

            <ul class="list-group">
                <li class="list-group-item">
                  {!! $comment->body !!}
                </li>
            </ul>
          </div>
        @endforeach
        
        <span class="pull-right">          
          {!! $comments->links() !!}
        </span>
    

      </div>
    </div> {{-- end col-12 --}}
</div>
@endsection

@section('style')
  <link rel="stylesheet" href="{{ url('css/bootstrap-rating.css') }}">
  <style>
    .rating-symbol{
      color: #f6e729;
      height: 20px;
    }
    .glyphicon {
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: 400;
        font-size: 21px;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
  </style>
@endsection

@section('script')
  <script src="{{ url('js/bootstrap-rating.js') }}"></script>
  <script>
    $('#rating').rating('rate', {{ $topic->averageRating ? $topic->averageRating : 0 }});
    $('#rating').on('change', function () {
      var token = '{{ csrf_token() }}';

      $.ajax({
          url: '{{ route('topics.star', $topic->slug) }}',
          type:"POST",
          data: { 
            'rating' : this.value,
            '_token' : token
          },
          success: function(result){
              alert(result);
          },
          statusCode: {
            401 : function (){
              alert('You must login first');
            }
          }
      });

    });   
  </script>
@stop

