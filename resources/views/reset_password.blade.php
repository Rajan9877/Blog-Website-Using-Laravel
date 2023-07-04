@php
    $message = request()->query('message');
    $email = request()->query('email');
    $token = request()->query('token');
@endphp
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>User | Password Reset</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            @isset($message1)
            <p style="text-align: center; color: rgb(255, 0, 0);">{{$message1}}</p>
            @endisset
            @isset($message)
            <p style="text-align: center; color: rgb(255, 0, 0);">{{$message}}</p>
            @endisset
            <div class="container" style="margin-bottom: 70px;">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <a href="/" id="logo" style="color: #ff0000; font-size: 50px;">Our Blogs</a>
                        <h3 class="heading">New Password Creation</h3>
                        <!-- Form Start -->
                        <form  action="{{route('reset_password')}}" method ="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="email" class="form-control" value="{{$email}}">
                              </div>
                              <div class="form-group">
                                <input type="hidden" name="token" class="form-control" value = {{$token}}>
                              </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="newpassword" class="form-control" placeholder="New Password" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="conpassword" class="form-control" placeholder="Confirm Password" required>
                            </div>
                            <input type="submit" class="btn btn-danger" value="Change Password"/>
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
