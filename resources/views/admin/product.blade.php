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
                            <label class="col-12 col-sm-2" style="display: flex; align-items: center;">Chọn danh mục:</label>
                            <div class="col-12 col-sm-8 col-lg-3">
                                <select class="form-control select2">
                                    <option value="All">Tất cả</option>
                                    @foreach($menu as $m)
                                    <option value="{{$m->name}}">{{$m->name}}</option>
                                    @endforeach
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
                                        <th>Hiển thị</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $p)
                                    <tr class="odd gradeX a">
                                        <td class="col-1"><input type="checkbox" class="select-item" value="{{ $p->id }}"></td>
                                        <td class="col-1">{{$p->id}}</td>
                                        <td class="col-2">{{$p->name}}</td>
                                        <td class="col-2"><img src="{{asset('images/'. $p->image)}}" style="width: 90%" alt=""></td>
                                        <td class="col-1">{{ number_format($p->price, 0, ',', '.') }} VND</td>
                                        <td class="col-1">
                                            @foreach($menu as $m)
                                            @if($p->menu_id == $m->id)
                                            {{$m->name}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td class="col-2 product-status" data-product-id="{{ $p->id }}">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        var table = $('#table1').DataTable({
            order: [
                [1, 'asc']
            ],
            columnDefs: [{
                    orderable: false,
                    targets: [0, 3, 4, 5, 6, 7]
                } // Chỉ định các cột không sắp xếp, theo chỉ mục (bắt đầu từ 0)
            ]
        });

        // Hàm lọc tùy chỉnh
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var l = $(".select2").val(); // Giá trị option đã chọn
                var s = data[5]; // '2' là chỉ số của cột "Danh mục" trong bảng
                // Nếu không chọn gì (giá trị rỗng), hiển thị tất cả
                if (l == s || "All" == l) {
                    return true;
                }
                return false;
            }
        );

        // Sự kiện thay đổi khi chọn option trong select
        $('.select2').on('change', function() {
            table.draw(); // Cập nhật DataTable để áp dụng bộ lọc
        });
    });
</script>
<!-- STATUS -->
<script>
    $(document).ready(function() {
        // Lắng nghe sự kiện thay đổi của tất cả checkbox
        $('.status-checkbox').on('change', function() {
            var productDiv = $(this).closest('.product-status'); // Tìm div chứa checkbox của sản phẩm
            var productId = productDiv.data('product-id'); // Lấy ID sản phẩm từ data attribute của div

            console.log("Product ID: " + productId);
            if (!productId) {
                console.log(productId);
                return; // Nếu không có productId, không gửi yêu cầu AJAX
            }
            // Lấy trạng thái các checkbox trong div này
            var display = productDiv.find('input[name="display"]').prop('checked') ? 1 : 0;
            var discount = productDiv.find('input[name="discount"]').prop('checked') ? 1 : 0;
            var is_new = productDiv.find('input[name="is_new"]').prop('checked') ? 1 : 0;

            // Gửi yêu cầu AJAX để cập nhật các trạng thái
            $.ajax({
                url: '/admin/product-status/' + productId, // Đường dẫn route cho update
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                    display: display, // Trạng thái display
                    discount: discount, // Trạng thái discount
                    is_new: is_new, // Trạng thái is_new
                    _method: 'PUT'
                },
                success: function(response) {
                    console.log('Cập nhật trạng thái thành công cho sản phẩm ID: ' + productId);
                    // Tùy chọn: Cập nhật DOM hoặc thông báo thành công
                },
                error: function(xhr) {
                    console.log("Lỗi khi cập nhật trạng thái:", xhr);
                }
            });
        });
    });
</script>
<!-- DELETE -->
<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            // Lấy thông tin menu từ thuộc tính data của nút
            let productId = $(this).data('id');
            var row = $(this).closest('tr'); // Lấy dòng chứa nút xóa

            // Sử dụng SweetAlert2 để hiển thị form chỉnh sửa
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gửi dữ liệu cập nhật qua AJAX
                    $.ajax({
                        url: `/admin/product/${productId}`, // Đường dẫn cập nhật
                        method: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token cho Laravel
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Đã xóa",
                                text: "Dã xóa sản phẩm",
                                icon: "success"
                            });

                            row.remove();

                            // Tùy chọn: Tải lại trang hoặc cập nhật DOM để phản ánh thay đổi
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thất bại',
                                text: 'Có lỗi xảy ra trong quá trình xóa.'
                            });
                            console.log("Lỗi:", xhr);
                        }
                    });
                }
            });
        });
    });
</script>
<!-- DELETE ALL -->
<script>
    $(document).ready(function() {
        $('#select-all').on('click', function() {
            $('.select-item').prop('checked', this.checked);
        });
        $('#delete-all').on('click', function() {
            var selectedIds = [];
            $('.select-item:checked').each(function() {
                selectedIds.push($(this).val());
            });
            if (selectedIds.length > 0) {
                Swal.fire({
                    title: 'Bạn có chắc muốn xóa tất cả sản phẩm?',
                    text: "Hành động này không thể khôi phục!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi yêu cầu AJAX
                        $.ajax({
                            url: '/admin/delete-all',
                            type: 'POST',
                            data: {
                                ids: selectedIds,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // Xóa các hàng đã chọn khỏi giao diện
                                $('.select-item:checked').closest('tr').remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Đã xóa tất cả!',
                                    text: "Dữ liệu không thể khôi phục!",
                                    timer: 3000,
                                })
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi',
                                    text: 'Có lỗi xảy ra. Vui lòng thử lại.'
                                });
                            }
                        });
                    }
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Chưa có mục nào được chọn',
                    text: 'Chọn một mục để xóa'
                });
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        //-initialize the javascript
        App.init();
        App.dataTables();
    });
</script>
</body>

</html>