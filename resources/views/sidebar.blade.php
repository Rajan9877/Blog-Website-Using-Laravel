@php
    use App\Models\Post;
    $posts = Post::latest()->limit(3)->get();;
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
                <img src="storage/{{$post->post_img}}" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="{{route('single', ['post_id' => $post->post_id])}}"> @php
                    if(strlen($post->title)>25){
                        echo substr($post->title, 0, 25)."...";
                    }else{
                        echo $post->title;
                    }
                    @endphp</a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php'>{{$post->category}}</a>
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
