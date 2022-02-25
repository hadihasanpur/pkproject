@extends('layouts.app')

@section('content')
          <h1>اخبار سازمان</h1>
    @if (count($news) > 0)
      <div class="row">
                 @foreach($news as $new)
                        <div class="row">
                               <div class="col-md-4">
                                 <img  style="width: 100%"; src="/storage/news_images/{{$new->img1}}" alt=""
                                 class="img-thumbnail float-right">
                               </div>
                               <div class="col-md-8">
                                     <h3>
                                       <a href="/news/{{$new->id}}">
                                        <p class="lead text-sm-right font1 text-dark">
                                          {{str_replace("&zwnj;"," ", strip_tags($new->title))}} </p>
                                       </a>
                                     </h3>
                                </div>
                          </div>
                        @endforeach
      </div>
      <hr>
                <?php echo $news->links(); ?>
            @else

            @endif
@endsection
