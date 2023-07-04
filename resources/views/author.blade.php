@php
    use App\Models\Category;
    $categories = Category::all();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Author - Our Blogs</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="/css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="/css/style.css">
    <style>
        #login:hover{
         color: black !important;
        }
        #signup:hover{
         color: black !important;
        }
     </style>
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="/" id="logo" style="color: white; font-size: 50px;">Our Blogs</a>
            </div>
            <!-- /LOGO -->
        </div>
        <div class="authen">
            @if(!(session()->has('username')))
            <a id="login" href="{{route('user_login')}}" style="font-size: 20px; font-weight: bold; margin-right: 10px; color: white;">Login</a>
            <a id="signup" href="{{route('user_signup')}}" style="font-size: 20px; font-weight: bold; color: white;">Sign Up</a>
            @else
            <a id="login" href="{{route('user_logout')}}" style="font-size: 20px; font-weight: bold; margin-right: 10px; color: white;">Logout</a>
            @endif
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    @foreach ($categories as $category)    
                    <li><a href='{{route('categories', ['categories' => $category->category_name])}}'>{{$category->category_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <h2 class="page-heading">{{$author}}</h2>
                    @if(!$posts->isEmpty())
                    @foreach ($posts as $post)
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="{{route('single', ['post_id' => $post->post_id])}}"><img src="/storage/{{$post->post_img}}" alt=""/></a>
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
                                            <a href='{{route('author', ['author' => $post->author])}}'>{{$post->author}}</a>
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
                    {{$posts->links()}}
                </div><!-- /post-container -->
            </div>
            @php
            use App\Models\Post;
            $posts = Post::latest()->limit(3)->get();
        @endphp
        <div id="sidebar" class="col-md-4">
            <!-- search box -->
            <div class="search-box-container">
                <h4>Search</h4>
                <form class="search-post" action="{{route('search')}}" method ="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search .....">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-danger">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- /search box -->
            <!-- recent posts box -->
            <div class="recent-post-container">
                <h4>Recent Posts</h4>
                @foreach ($posts as $post)
                <div class="recent-post">
                    <a class="post-img" href="{{route('single', ['post_id' => $post->post_id])}}">
                        <img src="/storage/{{$post->post_img}}" alt=""/>
                    </a>
                    <div class="post-content">
                        <h5><a href="{{route('single', ['post_id' => $post->post_id])}}">{{$post->title}}</a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='{{route('categories', ['categories' => $post->category])}}'>{{$post->category}}</a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            {{$post->post_date}}
                        </span>
                        <a class="read-more" href="{{route('single', ['post_id' => $post->post_id])}}">read more</a>
                    </div>
                </div>
                @endforeach
                </div></div>
               
            <!-- /recent posts box -->
        </div>
        </div>
      </div>
    </div>
@include('footer')
