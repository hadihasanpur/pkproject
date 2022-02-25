@extends('layouts.app')
@section('content')
<a href="/news" class="btn btn-default">Go Back</a>
          <h1>{{$news->title}}</h1>
          <div class="row">
            <div class="col-md-4">
              <img style="width: 100%"; src="/storage/News_images/{{$news->img1}}" alt="">
            </div>
          </div>

          <p>{{$news->body}}</p>
         <hr>
          <small>Created on: {{$news->created_at}}</small>
          <hr>
      @if(!Auth::guest())
        @if(Auth::user()->id==$news->user_id)
                   <a href="{{$news->id}}/edit" class="btn btn-success mb-1">Edit</a/>
                   {!!Form::open(['action'=>['NewsController@destroy',$news->id],
                     'method'=>'POST','class'=>'pull-right'])!!}
                   {{Form::hidden('_method','DELETE')}}
                   {{Form::submit('Delt',['class'=>'btn btn-danger'])}}
                   {!!Form::close()!!}
          @endif
      @endif
@endsection
