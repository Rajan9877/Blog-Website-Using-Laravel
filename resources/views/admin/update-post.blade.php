@if(session()->has('username'))
@include('admin.header')
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        @foreach($posts as $post)
        <form action="{{route('updateposts')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="{{$post->post_id}}" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                   {{$post->description}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category" id="category">
                    @foreach ($categories as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="newimage">
                <img  src="/storage/{{$post->post_img}}" height="150px">
                <input type="hidden" name="old-image" value="">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
       
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
@include('footer')
<script>
    // Get the select element
    const roleSelect = document.getElementById("category");
    
    // Set the selected option based on the user's role value
    const roleValue = "{{$post->category}}"; // Replace with the actual role value from your backend
    
    roleSelect.value = roleValue;
  </script>
   @endforeach
@else
<script>
    window.location.href = "{{route('admin')}}";
</script>
@endif