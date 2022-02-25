@extends('layouts.app')
@section('content')
          <h1>{{$title}}</h1>
    @if(count($Services)>0 )
          <ul>
                     @foreach($Services as $service)
                          <li>{{$service}}</li>
                     @endforeach
          </ul>
          @endif
@endsection
