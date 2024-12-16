<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{asset('assets/img/logo.png')}}">
    <title>Admin</title>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/dragula/dragula.min.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/dropzone/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}" type="text/css">
</head>

<body>

    </script>
    <div class="be-wrapper be-fixed-sidebar">
        <nav class="navbar navbar-expand fixed-top be-top-header">
            <div class="container-fluid">
                <div class="be-navbar-header"><a class="navbar-brand" href="{{route('admin')}}"></a>
                </div>
                <div class="be-right-navbar">
                    <ul class="nav navbar-nav float-right be-user-nav">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{asset('assets\img\avatar.png')}}" alt="Avatar"><span class="user-name">Túpac Amaru</span></a>
                            <div class="dropdown-menu" role="menu">
                                <div class="user-info">
                                    <div class="user-name">Túpac Amaru</div>
                                    <div class="user-position online">Hoạt động</div>
                                </div>
                                <a class="dropdown-item" href="pages-profile.html"><span class="icon mdi mdi-face"></span>Thông tin tài khoản</a>
                                @auth
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="icon mdi mdi-power"></span>Đăng xuất</a>
                                @endauth
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right be-icons-nav">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><span class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
                            <ul class="dropdown-menu be-notifications">
                                <li>
                                    <div class="title">Thông báo<span class="badge badge-pill">3</span></div>
                                    <div class="list">
                                        <div class="be-scroller-notifications">
                                            <div class="content">
                                                <ul>
                                                    <li class="notification notification-unread"><a href="#">
                                                            <div class="image"><img src="assets\img\avatar2.png" alt="Avatar"></div>
                                                            <div class="notification-info">
                                                                <div class="text"><span class="user-name">Jessica Caruso</span> accepted your invitation to join the team.</div><span class="date">2 min ago</span>
                                                            </div>
                                                        </a></li>
                                                    <li class="notification"><a href="#">
                                                            <div class="image"><img src="assets\img\avatar3.png" alt="Avatar"></div>
                                                            <div class="notification-info">
                                                                <div class="text"><span class="user-name">Joel King</span> is now following you</div><span class="date">2 days ago</span>
                                                            </div>
                                                        </a></li>
                                                    <li class="notification"><a href="#">
                                                            <div class="image"><img src="assets\img\avatar4.png" alt="Avatar"></div>
                                                            <div class="notification-info">
                                                                <div class="text"><span class="user-name">John Doe</span> is watching your main repository</div><span class="date">2 days ago</span>
                                                            </div>
                                                        </a></li>
                                                    <li class="notification"><a href="#">
                                                            <div class="image"><img src="assets\img\avatar5.png" alt="Avatar"></div>
                                                            <div class="notification-info"><span class="text"><span class="user-name">Emily Carter</span> is now following you</span><span class="date">5 days ago</span></div>
                                                        </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer"> <a href="#">Tất cả thông báo</a></div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="be-left-sidebar">
            <div class="left-sidebar-wrapper"><a class="left-sidebar-toggle" href="#">Bảng điều khiển</a>
                <div class="left-sidebar-spacer">
                    <div class="left-sidebar-scroll">
                        <div class="left-sidebar-content">
                            <ul class="sidebar-elements">
                                <li class="divider">Menu</li>
                                <li><a href="{{route('admin')}}"><i class="icon mdi mdi-home"></i><span>Bảng điều khiển</span></a>
                                </li>
                                <!-- <li><a href="{{route('menu.index')}}"><i class="icon mdi mdi-dns"></i>Quản lý menu</a></li> -->
                                <li class="parent"><a href="#"><i class="icon mdi mdi-shopping-cart"></i>Sản phẩm</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('product.index')}}"></i>Quản lý sản phẩm</a>
                                        </li>
                                        <li><a href="{{route('menu.index')}}">Menu sản phẩm</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-view-subtitles"></i><span>Bài viết</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('news.index')}}"></i>Bài viết</a>
                                        </li>
                                        <li><a href="{{route('menu-news.index')}}">Menu bài viết</a>
                                        </li>
                                    </ul>
                                </li>


                                <li class="parent"><a href="#"><i class="icon mdi mdi-layers"></i><span>Quản lý trang</span></a>
                                    <ul class="sub-menu">

                                        <li><a href="pages-blank.html">Slogan</a>
                                        </li>
                                        <li><a href="pages-blank.html">Liên hệ</a>
                                        </li>
                                        <li><a href="pages-blank.html">Copyright</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="divider">Chức năng</li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-collection-folder-image"></i><span>Hình ảnh-Video</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('logo')}}">Logo</a>
                                        </li>
                                        <li><a href="email-read.html">Banner</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-view-list"></i><span>Danh mục</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="email-inbox.html">Danh mục cấp 1</a>
                                        </li>
                                        <li><a href="email-read.html">Danh mục cấp 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-assignment"></i><span>SEO Page</span></a>
                                    <ul class="sub-menu">
                                        
                                        <li><a href="{{route('seo')}}">Trang chủ</a>
                                        <li><a href="{{route('seo')}}">Sản phẩm</a>
                                        <li><a href="{{route('seo')}}">Giới thiệu</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>