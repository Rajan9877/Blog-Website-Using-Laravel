@if(session()->has('username'))
@include('admin.header')
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="{{route('addcategory')}}">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class='id'>{{$category->category_id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->post}}</td>
                            <td class='edit'><a href='{{route('updatecategory', ['category_id' => $category->category_id])}}'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='{{route('deletecategory', ['category_id' => $category->category_id])}}'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul> --}}
                {{$categories->links()}}
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