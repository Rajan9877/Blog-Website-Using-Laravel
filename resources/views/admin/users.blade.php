@if(session()->has('username'))
@include('admin.header')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="{{route('add_usr')}}">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class='id'>{{$user->user_id}}</td>
                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                            <td>{{$user->username}}</td>
                            <td>
                                @if($user->role == 1)
                                    Admin
                                @else
                                    Normal
                                @endif

                            </td>
                            <td class='edit'><a href='{{route('updateuser',['user_id'=>$user->user_id])}}'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='{{route('deleteuser',['user_id'=>$user->user_id])}}'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  {{-- <ul class='pagination admin-pagination'>
                      <li class="active"><a>1</a></li>
                      <li><a>2</a></li>
                      <li><a>3</a></li>
                  </ul> --}}
                  {{$users->links()}}
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
