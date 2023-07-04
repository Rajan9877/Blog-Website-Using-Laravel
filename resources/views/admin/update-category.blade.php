@if(session()->has('username'))
@include('admin.header')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              @foreach($category as $cat)
              <div class="col-md-offset-3 col-md-6">
                  <form action="{{route('updatecat')}}" method ="POST">
                    @csrf
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="{{$cat->category_id}}" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="{{$cat->category_name}}"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  @endforeach
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