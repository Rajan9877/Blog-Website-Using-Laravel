<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>User | Forgot Password</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            @isset($message1)
            <p style="text-align: center; color: rgb(255, 0, 0);">{{$message1}}</p>
            @endisset
            @isset($message2)
            <p style="text-align: center; color: green;">{{$message2}}</p>
            @endisset
            <div class="container" style="margin-bottom: 70px;">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <a href="/" id="logo" style="color: #ff0000; font-size: 50px;">Our Blogs</a>
                        <h3 class="heading">Reset Password</h3>
                        <!-- Form Start -->
                        <form  action="{{route('forgot_password')}}" method ="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
                            </div>
                            <input type="submit" class="btn btn-danger" value="Reset"/>
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
