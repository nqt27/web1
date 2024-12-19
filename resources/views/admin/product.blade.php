@include('admin/layout-header')

<div class="be-wrapper">
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Danh sách sản phẩm</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
                    <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                </ol>
            </nav>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-header">
                            <a href="{{route('product.add')}}" class="btn btn-space btn-primary" id="btn-add-product"><i class="icon icon-left mdi mdi-plus-circle"></i><span>Thêm mới</span></a>
                            <button class="btn btn-space btn-danger" id="delete-all"><i class="icon icon-left mdi mdi-delete"></i><span>Xóa tất cả</span></button>
                        </div>

                        <div class="form-group row px-5">
                            <label class="col-12 col-sm-2" style="display: flex; align-items: center;">Danh mục cấp 1:</label>
                            <div class="col-12 col-sm-8 col-lg-3">
                                <select class="form-control" id="select-parent">
                                    <option value="All">Tất cả</option>
                                    @foreach($selectmenu as $m)
                                    <option value="{{$m->id}}">{{$m->name}}</option>
                                    @endforeach
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
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá</th>
                                        <th>Danh mục</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $p)
                                    <tr class="odd gradeX a">
                                        <td style="width: 0%;"><input type="checkbox" class="select-item" value="{{ $p->id }}"></td>
                                        <td style="width: 0%;">{{$p->id}}</td>
                                        <td class="col-2">{{$p->name}}</td>
                                        <td class="col-1"><img src="{{asset('uploads/images/'. $p->image)}}" style="width: 100%" alt=""></td>
                                        <td class="col-1">
                                            @if ($p->price)
                                            <span>{{ number_format($p->price, 0, ',', '.') }} VNĐ</span>
                                            @else
                                            <span>Liên hệ</span>
                                            @endif
                                        </td>
                                        <td class="col-1">
                                            @foreach($menu as $m)
                                            @if($p->menu_id == $m->id)
                                            <span style="display: none;">{{$m->id}}</span>
                                            {{$m->name}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td class="col-1 product-status" data-product-id="{{ $p->id }}">
                                            <div class="form-group row" style="justify-content: space-between; align-items: center;">
                                                <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Hiển thị</strong></label>
                                                <div style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                                    <div class="switch-button switch-button-success switch-button-xs">
                                                        <input type="checkbox" class="status-checkbox" {{ $p->display ? 'checked' : '' }} name="display" id="display{{$p->id}}"><span>
                                                            <label for="display{{$p->id}}"></label></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="justify-content: space-between; align-items: center;">
                                                <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Khuyến mãi</strong></label>
                                                <di style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                                    <div class="switch-button switch-button-success switch-button-xs">
                                                        <input type="checkbox" class="status-checkbox" {{ $p->discount ? 'checked' : '' }} name="discount" id="discount{{$p->id}}"><span>
                                                            <label for="discount{{$p->id}}"></label></span>
                                                    </div>
                                                </di>
                                            </div>
                                            <div class="form-group row" style="justify-content: space-between; align-items: center;">
                                                <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Mới</strong></label>
                                                <di style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                                    <div class="switch-button switch-button-success switch-button-xs">
                                                        <input type="checkbox" class="status-checkbox" {{ $p->new ? 'checked' : '' }} name="is_new" id="is_new{{$p->id}}"><span>
                                                            <label for="is_new{{$p->id}}"></label></span>
                                                    </div>
                                                </di>
                                            </div>

                                        </td>

                                        <td class="center col-2">
                                            <a href="/admin/product-detail/{{$p->id}}" class="btn btn-space btn-warning" id="btn-add-product"><i class="icon icon-left mdi mdi-edit"></i><span>Chỉnh sửa</span></a>
                                            <button class="btn btn-space btn-danger delete-btn" data-id="{{ $p->id }}" type="submit"><i class=" icon icon-left mdi mdi-delete"></i><span>Xóa</span></button>
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
        table('{{$selectmenu}}', [0, 3, 4, 5, 6, 7]);
        statusProduct('/admin/product-status/');
        deleteItem('/admin/product/');
        deleteAll('/admin/delete-all');
        App.init();
        App.dataTables();
    });
</script>
</body>

</html>