@if(session()->has('username'))
@include('admin.header')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  @foreach ($user as $usr)
                  <form  action="{{route('updateusr')}}" method ="POST">
                    @csrf
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="{{$usr->user_id}}" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="{{$usr->first_name}}" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="{{$usr->last_name}}" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="{{$usr->username}}" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" id="roleSelect">
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
@include('footer')
<script>
    // Get the select element
    const roleSelect = document.getElementById("roleSelect");
    
    // Set the selected option based on the user's role value
    const roleValue = "{{$usr->role}}"; // Replace with the actual role value from your backend
    
    roleSelect.value = roleValue;
  </script>
  @endforeach
@else
<script>
    window.location.href = "{{route('admin')}}";
</script>
@endif