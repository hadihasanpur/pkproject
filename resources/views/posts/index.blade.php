@extends('layouts.app')
@section('content')
          <h1>post Model</h1>
            @if (count($posts) > 0)
                <ul class="list-group list-grup-flush">
      @foreach($posts as $post)
                   <div class="card">
                        <div class="row">
                               <div class="col-md-4">
                                 <img style="width: 100%"; src="/storage/cover_images/{{$post->cover_image}}" alt="">
                               </div>
                               <div class="col-md-8">
                                     <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                     <small>writen on {{$post->created_at}}</small>
                                </div>
                          </div>
                   </div>
        @endforeach
                </ul>
            @else
            @endif
@endsection
