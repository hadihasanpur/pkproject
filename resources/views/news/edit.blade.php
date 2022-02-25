@extends('layouts.app')
@section('content')
          <h1>Edit News</h1>
          {!! Form::open(['action' => ['NewsController@update', $news->id],'method'=>'POST',
            'enctype'=>'multipart/form-data']) !!}

              <div class="form-group">
                {{Form::label('title','Title')}}
                {{Form::text('title',$news->title,['class'=>'form-control','placeholder'=>'Title'])}}
              </div>
              <div class="form-group">
                {{Form::label('body','Body')}}
                {{Form::textarea('body',$news->body,['class'=>'form-control','placeholder'=>'body'])}}
              </div>
              <div class="form-group">
                {{Form::file('News_images')}}
              </div>
              {{Form::hidden('_method','PUT')}}
              {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
          {!! Form::close() !!}

@endsection
