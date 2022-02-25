@extends('layouts.app')
<script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 100,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>

@section('content')
          <h1>Create Post</h1>
          {!! Form::open(['action' => 'NewsController@store','method'=>'POST',
            'enctype'=>'multipart/form-data']) !!}
              <div class="form-group">
                {{Form::label('title','Title')}}
                {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
              </div>
              <div class="form-group">
                {{Form::label('body','Body')}}
                {{Form::textarea('body','',['class'=>'form-control tinymce-editor','placeholder'=>'body'])}}
              </div>
              <div class="form-group">
                {{Form::label('date','Date')}}
              {{Form::Date('date','',['class'=>'form-control','placeholder'=>'date'])}}
              </div>

              <div class="form-group">
                {{Form::file('img1')}}
              </div>
              {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
          {!! Form::close() !!}

@endsection
