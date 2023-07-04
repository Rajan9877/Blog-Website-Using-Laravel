@php
    use App\Models\Category;
    $categorieg = Category::all();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Single - Our Blogs</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="/css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="/css/style.css">
    <style>
        #commentmsg{
            display: none;
        }
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
                    @foreach ($categorieg as $category)    
                    <li><a href='{{route('categories', ['categories' => $category->category_name])}}'>{{$category->category_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="commentmsg">
    
</div>
<!-- /Menu Bar -->
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                  @foreach ($posts as $post)
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3>{{$post->title}}</h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    {{$post->category}}
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php'>
                                        {{$post->author}}
                                    </a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    {{$post->post_date}}
                                </span>
                            </div>
                            <img class="single-feature-image" src="/storage/{{$post->post_img}}" alt=""/>
                            <p class="description">
                                {{$post->description}}
                            </p>
                        </div>
                    </div>
                   
                    <!-- /post-container -->
                    <div>
                        <form action="" method="get" id="commentForm" style="display:flex; justify-content:center; align-items:center; flex-direction:column;">
                            @csrf
                            <h3 style="color: red;">Add a new comment</h3>
                            <input type="hidden" id="hidden" value="{{$post->post_id}}">
                            <textarea style="border-radius: 15px; padding: 15px; outline-color: red; color: red;" name="comment" id="comment" cols="65" rows="7" placeholder="Type your comment" required></textarea><br>
                            <button class="btn">Post Comment</button>
                        </form>
                    </div>
                    @endforeach
                    @php
                                use App\Models\Comment;
                                foreach($posts as $post){
                                // $comments = Comment::where('post_id',strval($post->post_id))->get();
                                $comments = Comment::where('post_id', strval($post->post_id))
    ->orderBy('id', 'desc')
    ->get();
                            }
                    @endphp
                    <div class="comments">
                        <h3 style="color: red;">Comments:</h3>
                        <div id="comments">
                            @foreach ($comments as $comment)
                            <div style="background-color: white; padding: 15px; border-radius: 15px; margin-bottom: 15px;"><h4><img style="margin-bottom: 5px; margin-right: 5px;" src="/storage/image/user.png" alt="User" width="35px;">{{$comment->username}}</h4><span style ="font-size: 12px; color: grey;">{{$comment->date}}</span><br><p style="color: red;">{{$comment->comment}}</p></div>
                            @endforeach
                        </div>
                    </div>
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
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
    $('#commentForm').submit(function(e){
        e.preventDefault();
        var comment = $('#comment').val();
        var hidden = $('#hidden').val();
        $.ajax({
            type: "GET",
            url: "{{route('comment')}}",
            data: {comment : comment,
            hidden : hidden
            },
            success:function(data){
               $("#commentmsg").fadeIn();
               var comments = document.getElementById("comments");
               var commentmsg = document.getElementById("commentmsg");
               comments.innerHTML = '';
               var commentss = data.comments;
               var message = data.message; 
               commentss.forEach(element => {
                    comments.innerHTML += '<div style="background-color: white; padding: 15px; border-radius: 15px; margin-bottom: 15px;"><h4><img style="margin-bottom: 5px;  margin-right: 5px;" src="/storage/image/user.png" alt="User" width="35px;">'+ element['username']+'</h4><span style="font-size: 12px; color: grey;"">'+element['date']+'</span><br><p style="color: red;">'+element['comment']+'</p>'; 
               });
               commentmsg.innerHTML = '<h4 style="background-color: white; position: fixed; top: 10px;right: 0px; padding-top: 15px; padding: 10px; border-radius: 15px; color: red; z-index: 5;">'+message+'</h4>';
               document.getElementById("commentForm").reset();
               setTimeout(()=>{
                   $("#commentmsg").fadeOut();
               }, 3000);
            }
        });
    });
});
</script>