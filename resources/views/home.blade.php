<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css">
    <title>Document</title>
</head>

<body>
    <button id="back-to-top" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>


    <header>
        <div class="container header">

            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <div class="logo">
                            <img src="{{asset('images/logo.jpg')}}" width="100%" alt="">
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Giới thiệu</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dịch vụ</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Tin tức</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Tuyển dụng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Liên hệ</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width: 25%;">
                            <li class="nav-item">
                                <a class="nav-link" aria-disabled="true">Login</a>
                            </li>
                            <button type="button" class="btn btn-primary">Start Free Trial</button>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

    </header>

    <div class="banner-video" id="banner-video">
        <video class="w-100 h-100" autoplay="" muted="" loop="">
            <source src="{{asset('images/banner1.mp4')}}" type="video/webm">
        </video>
    </div>
    <section class="banner">
        <div class="container banner1">
            <div class="banner-left">
                <div class="banner-title">
                    Kiểm tra <span style="background-color: #F9ED32; color: #27403E">tên miền</span>
                </div>
                <div class="banner-content">
                    Đăng ký tên miền là bước đầu tiên để xây dựng một thương hiệu mạnh mẽ trên Internet. Một tên miền tốt không chỉ là địa chỉ web, mà còn là chìa khóa để mở ra cánh cửa thành công cho doanh nghiệp.
                </div>

                <form method="post" action="{{ route('checkDomain') }}" class="input-group mb-3">
                    @csrf
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" name="domain">
                    <button type="submit" class="btn btn-primary">Primary</button>
                </form>
                @if (session('details'))
                <div class="alert alert-success" style="position:absolute;z-index: 9999999999;">
                    {{ session('details') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-success" style="position:absolute;z-index: 9999999999;">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>