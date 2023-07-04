{{-- @extends('header') --}}
@section('title', 'Search')
@include('header')
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading">Search : {{$search}}</h2>
                  @if(!$posts->isEmpty())
                  @foreach($posts as $post)
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="{{route('single', ['post_id' => $post->post_id])}}"><img src="storage/{{$post->post_img}}" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='{{route('single', ['post_id' => $post->post_id])}}'>@php
                                        if(strlen($post->title)>100){
                                            echo substr($post->title, 0, 100)."...";
                                        }else{
                                            echo $post->title;
                                        }
                                        @endphp</a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='{{route('categories', ['categories' => $post->category])}}'>{{$post->category}}</a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='{{route('author', ['author' => $post->author])}}'> {{$post->author}}
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{$post->post_date}}
                                        </span>
                                    </div>
                                    <p class="description">
                                        @php
                                             if(strlen($post->description)>100){
                        echo substr($post->description, 0, 100)."...";
                    }else{
                        echo $post->description;
                    }
                                            @endphp
                                    </p>
                                    <a class='read-more pull-right' href='{{route('single', ['post_id' => $post->post_id])}}'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <p style="text-align: center;">No Results Found</p>
                    @endif
                    {{-- <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul> --}}
                    {{-- {{$posts->links()}} --}}
                </div><!-- /post-container -->
            </div>
           @include('sidebar')
        </div>
      </div>
    </div>
@include('footer')
