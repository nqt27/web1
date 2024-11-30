<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="assets\img\logo.png" />
    <title>Đăng ký</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets\lib\perfect-scrollbar\css\perfect-scrollbar.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets\lib\material-design-icons\css\material-design-iconic-font.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets\css\app.css')}}" type="text/css" />
</head>

<body class="be-splash-screen">
    <div class="be-wrapper be-login be-signup">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="splash-container sign-up">
                    <div class="card card-border-color card-border-color-primary">
                        <div class="card-header">
                            <img class="logo-img" src="assets\img\logo.png" alt="logo" width="102" height="80" style="margin-bottom: 5px" />
                        </div>
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
                            <div class="icon"> <span class="mdi mdi-close-circle-o"></span></div>
                            <div class="message error-message">{{ $error }}</div>

                        </div>

                        @endforeach
                        @endif

                        <div class="message error-message"></div>

                        <div class="card-body">
                            <form method="post" action="{{ route('signup.store') }}" id="registerForm">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" name="username" required="" placeholder="Tên người dùng" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" required="" placeholder="E-mail" autocomplete="off" />
                                </div>
                                <div class="form-group row signup-password">
                                    <div class="col-6">
                                        <input class="form-control" id="password" name="password" type="password" required="" placeholder="Mật khẩu" />
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" type="password" name="password_confirmation" required="" placeholder="Xác nhận mật khẩu" />
                                    </div>
                                </div>
                                <div class="form-group pt-2">
                                    <button class="btn btn-block btn-primary btn-xl" type="submit">
                                        Đăng ký
                                    </button>
                                </div>

                            </form>
                            <div class="splash-footer">
                                <span>Bạn đã có tài khoản?
                                    <a href="{{route('login')}}">Đăng nhập</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="splash-footer">
                        &copy; 2024 Snake Team
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets\lib\jquery\jquery.min.js" type="text/javascript"></script>
    <script src="assets\lib\perfect-scrollbar\js\perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="assets\lib\bootstrap\dist\js\bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="assets\js\app.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //-initialize the javascript
            App.init();
        });
    </script>
</body>

</html>