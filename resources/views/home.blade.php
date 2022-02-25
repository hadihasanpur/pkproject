@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  {{-- {{ __('You are logged in!') }} --}}
                    <a href="posts/create" class="btn btn-primary">Create Post</a>
                    <h1>Your Posts:</h1>
                    @if (count($posts) > 0)
                              <table class="table table-striped">
                                <tr>
                                   <td>Title</td>
                                   <td></td>
                                   <td></td>
                                </tr>
                                @foreach($posts as $post)
                                      <tr>
                                         <td>{{$post->title}}</td>
                                         <td><a href="/posts/{{$post->id}}/edit">Edit</a></td>
                                         <td></td>
                                      </tr>
                                @endforeach
                              </table>
                    @else
                         <p>You have no Post</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
