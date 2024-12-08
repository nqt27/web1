@include('admin/layout-header')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Danh mục con của {{$menu->name}}</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
                <li class="breadcrumb-item active">Menu</li>
            </ol>
        </nav>
    </div>

    <div class="main-content container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div id="column-1">
                    <div class="card">
                        <div class="card-header card-header-divider">
                            <button class="btn btn-space btn-primary" id="btn-add-submenu"><i class="icon icon-left mdi mdi-plus-circle"></i><span>Thêm menu</span></button>
                        </div>

                    </div>
                    @foreach($submenu as $m)
                    <div class="card menu-item" id="menu-{{$m->id}}">
                        <div class="card-header card-header-divider">{{$m->name}}
                            <!-- <button class="btn btn-space btn-primary btn-submenu" data-id="{{$m->id}}" data-name="{{$m->name}}" data-url="{{$m->url}}" type="button" style="float: right;"><i class="icon icon-left mdi mdi-view-list-alt"></i><span>Danh mục con</span></button> -->
                            <button class="btn btn-space btn-success edit-btn" data-id="{{$m->id}}" data-name="{{$m->name}}" data-url="{{$m->url}}" type="button" style="float: right;"><i class="icon icon-left mdi mdi-edit"></i><span>Sửa danh mục</span></button>
                            <button class="btn btn-space btn-danger delete-btn" data-id="{{$m->id}}" data-name="{{$m->name}}" data-url="{{$m->url}}" type="button" style="float: right;"><i class="icon icon-left mdi mdi-delete"></i><span>Xóa danh mục</span></button>
                        </div>

                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

</div>
</div>




<script src="{{asset('assets\lib\jquery\jquery.min.js')}}" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('assets\lib\perfect-scrollbar\js\perfect-scrollbar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\bootstrap\dist\js\bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jquery.nestable\jquery.nestable.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets\js\app.js')}}" type="text/javascript"></script>
<script src="{{asset('js\feature.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\dragula\dragula.min.js')}}" type="text/javascript"></script>




<script type="text/javascript">
    $(document).ready(function() {
        App.init();
        drag();
        addMenu($('#btn-add-submenu'), '/admin/addsubmenu', 'POST', '{{$menu->id}}');
        editMenu($('.edit-btn'), `/admin/menu`);
        deleteMenu();
    });
</script>
</body>

</html>