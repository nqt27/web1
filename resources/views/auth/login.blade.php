<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="assets\img\logo.png" />
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="assets\lib\perfect-scrollbar\css\perfect-scrollbar.css" />
    <link rel="stylesheet" type="text/css" href="assets\lib\material-design-icons\css\material-design-iconic-font.min.css" />
    <link rel="stylesheet" href="assets\css\app.css" type="text/css" />
</head>

<body class="be-splash-screen">
    <div class="be-wrapper be-login">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="splash-container">
                    <div class="card card-border-color card-border-color-primary">
                        <div class="card-header">
                            <img class="logo-img" src="assets\img\logo.jpg" alt="logo" width="102" height="#{conf.logoHeight}" />
                        </div>
                        <div class="card-body">

                            @if (session('error'))

                            <div class="alert alert-danger alert-dismissible" style="width:100%;" role="alert">
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
                                <div class="icon"> <span class="mdi mdi-close-circle-o"></span></div>
                                <div class="message">{{ session('error') }} <span id="count" style="display: none;">Vui lòng thử lại sau <span id="countdown"></span> giây hoặc liên hệ kỹ thuật viên </span> </div>
                                @if (session('lockout_time'))
                                <script>
                                    document.getElementById("count").style.display = 'inline';
                                    // Lấy thời gian khóa từ server (được truyền từ controller)
                                    var countdownTime = {{session('lockout_time')}};

                                    // Cập nhật đếm ngược mỗi giây
                                    var countdownInterval = setInterval(function() {
                                        countdownTime--; // Giảm thời gian còn lại

                                        // Cập nhật thời gian hiển thị
                                        document.getElementById("countdown").textContent = countdownTime;

                                        // Khi thời gian đếm ngược về 0, dừng lại
                                        if (countdownTime <= 0) {
                                            clearInterval(countdownInterval);
                                        }
                                    }, 1000); // Cập nhật mỗi giây
                                </script>
                                @endif
                            </div>
                            @endif
                            @error('username')
                            <div class="alert alert-danger alert-dismissible" style="width:100%;" role="alert">
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
                                <div class="icon"> <span class="mdi mdi-close-circle-o"></span></div>
                                <div class="message">Vui lòng nhập tên đăng nhập</div>
                            </div>
                            @enderror
                            @error('password')
                            <div class="alert alert-danger alert-dismissible" style="width:100%;" role="alert">
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
                                <div class="icon"> <span class="mdi mdi-close-circle-o"></span></div>
                                <div class="message">Vui lòng nhập mật khẩu</div>
                            </div>
                            @enderror
                            <form method="post" action="{{ route('login.login') }}" style="width: 80%">
                                @csrf
                                <div class=" form-group">
                                    <input class="form-control" id="username" name="username" type="text" placeholder="Tên người dùng" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Mật khẩu" />
                                </div>

                                <!-- <div class="form-group row login-tools">
                                    <div class="col-6 login-remember">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="checkbox1" />
                                            <label class="custom-control-label" for="checkbox1">Remember Me</label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group pt-2">
                                    <button class="btn btn-block btn-primary btn-xl" type="submit">
                                        Đăng nhập
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="splash-footer">&copy; 2024 Snake Team</div>
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