@if(session()->has('username'))
@include('admin.header')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="{{route('add_post')}}">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td class='id'>{{$post->post_id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category}}</td>
                            <td>{{$post->post_date}}</td>
                            <td>{{$post->author}}</td>
                            <td class='edit'><a href='{{route('updatepost', ['post_id' => $post->post_id])}}'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='{{route('delete', ['post_id' => $post->post_id])}}'><i class='fa fa-trash-o'></i></a></td>
                        </tr>  
                        @endforeach
                      </tbody>
                  </table>
                  {{-- <ul class='pagination admin-pagination'>
                      <li class="active"><a>1</a></li>
                      <li><a>2</a></li>
                      <li><a>3</a></li>
                  </ul> --}}
                  {{$posts->links()}}
              </div>
          </div>
      </div>
  </div>
@include('footer')   
@else
<script>
    window.location.href = "{{route('admin')}}";
</script>
@endif
