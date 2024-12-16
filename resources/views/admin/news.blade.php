@include('admin/layout-header')

<div class="be-wrapper">
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Danh sách bài viết</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
                    <li class="breadcrumb-item active">Danh sách bài viết</li>
                </ol>
            </nav>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-header">
                            <a href="{{route('news.add')}}" class="btn btn-space btn-primary" id="btn-add-product"><i class="icon icon-left mdi mdi-plus-circle"></i><span>Thêm mới</span></a>
                            <button class="btn btn-space btn-danger" id="delete-all"><i class="icon icon-left mdi mdi-delete"></i><span>Xóa tất cả</span></button>
                        </div>

                        <div class="form-group row px-5">
                            <label class="col-12 col-sm-2" style="display: flex; align-items: center;">Danh mục cấp 1:</label>
                            <div class="col-12 col-sm-8 col-lg-3">
                                <select class="form-control" id="select-parent">
                                    <option value="All">Tất cả</option>
                                    @if(isset($selectmenu) && $selectmenu->count())
                                    @foreach($selectmenu as $m)
                                    <option value="{{$m->id}}">{{$m->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row px-5">
                            <label class="col-12 col-sm-2" style="display: flex; align-items: center;">Danh mục cấp 2</label>
                            <div class="col-12 col-sm-8 col-lg-3">
                                <select class="form-control select2" id="select-child">

                                </select>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-striped table-hover table-fw-widget" id="table1">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>ID</th>
                                        <th>Tiêu đề bài viết</th>
                                        <th>Hình ảnh</th>
                                        <th>Danh mục</th>
                                        <th>Hiển thị</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($news as $n)
                                    <tr class="odd gradeX a">
                                        <td class="col-1"><input type="checkbox" class="select-item" value="{{ $n->id }}"></td>
                                        <td class="col-1">{{$n->id}}</td>
                                        <td class="col-2">{{$n->title}}</td>
                                        <td class="col-2"><img src="{{asset('images/'. $n->image)}}" style="width: 90%" alt=""></td>
                                        <td class="col-1">
                                            @foreach($menu as $m)
                                            @if($n->menu_id == $m->id)
                                            <span style="display: none;">{{$m->id}}</span>
                                            {{$m->name}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td class="col-2 product-status" data-product-id="{{ $n->id }}">
                                            <div class="form-group row" style="justify-content: space-between; align-items: center;">
                                                <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Hiển thị</strong></label>
                                                <div style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                                    <div class="switch-button switch-button-success switch-button-xs">
                                                        <input type="checkbox" class="status-checkbox" {{ $n->display ? 'checked' : '' }} name="display" id="display{{$n->id}}"><span>
                                                            <label for="display{{$n->id}}"></label></span>
                                                    </div>
                                                </div>
                                            </div>
                        </div>
                        <div class="form-group row" style="justify-content: space-between; align-items: center;">
                            <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Mới</strong></label>
                            <di style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                <div class="switch-button switch-button-success switch-button-xs">
                                    <input type="checkbox" class="status-checkbox" {{ $n->new ? 'checked' : '' }} name="is_new" id="is_new{{$n->id}}"><span>
                                        <label for="is_new{{$n->id}}"></label></span>
                                </div>
                            </di>
                        </div>

                        </td>

                        <td class="center col-2">
                            <a href="/admin/news-detail/{{$n->id}}" class="btn btn-space btn-warning" id="btn-add-product"><i class="icon icon-left mdi mdi-edit"></i><span>Chỉnh sửa</span></a>
                            <button class="btn btn-space btn-danger delete-btn" data-id="{{ $n->id }}" type="submit"><i class=" icon icon-left mdi mdi-delete"></i><span>Xóa</span></button>
                        </td>
                        </tr>
                        @endforeach

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@include('admin/layout-footer')
<script src="{{asset('assets\lib\jquery\jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\perfect-scrollbar\js\perfect-scrollbar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\bootstrap\dist\js\bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\js\app.js')}}" type="text/javascript"></script>

<script src="{{asset('assets\lib\datatables\datatables.net\js\jquery.dataTables.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\datatables.net-bs4\js\dataTables.bootstrap4.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\datatables.net-buttons\js\dataTables.buttons.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\datatables.net-buttons\js\buttons.flash.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\jszip\jszip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\pdfmake\pdfmake.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\pdfmake\vfs_fonts.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\datatables.net-buttons\js\buttons.colVis.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\datatables.net-buttons\js\buttons.print.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\datatables.net-buttons\js\buttons.html5.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\datatables.net-buttons-bs4\js\buttons.bootstrap4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\datatables.net-responsive\js\dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\datatables\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js\feature.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script type="text/javascript">
    $(document).ready(function() {
        //-initialize the javascript
        selectMenu('{{$selectmenu}}')
        table('{{$selectmenu}}', [0, 3, 4, 5, 6]);
        statusProduct('/admin/news-status/');
        deleteItem('/admin/news/');
        deleteAll('/admin/delete-all-news');
        App.init();
        App.dataTables();
    });
</script>
</body>

</html>