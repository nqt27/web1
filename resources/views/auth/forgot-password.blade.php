<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets\img\logo.png">
    <title>Beagle</title>
    <link rel="stylesheet" type="text/css" href="assets\lib\perfect-scrollbar\css\perfect-scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets\lib\material-design-icons\css\material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets\css\app.css" type="text/css">
</head>

<body class="be-splash-screen">
    <div class="be-wrapper be-login">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="splash-container forgot-password">
                    <div class="card card-border-color card-border-color-primary">
                        <div class="card-header"><img class="logo-img" src="assets\img\logo.png" alt="logo" width="102" height="#{conf.logoHeight}"></div>
                        <div class="card-body">
                            <form>
                                <p>Don't worry, we'll send you an email to reset your password.</p>
                                <div class="form-group pt-4">
                                    <input class="form-control" type="email" name="email" required="" placeholder="Your Email" autocomplete="off">
                                </div>
                                <div class="form-group pt-1"><a class="btn btn-block btn-primary btn-xl" href="index.html">Reset Password</a></div>
                            </form>
                        </div>
                    </div>
                    <div class="splash-footer">&copy; 2024 Snake Team</div>
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