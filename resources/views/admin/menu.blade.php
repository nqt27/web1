@include('admin/layout-header')
<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Quản lý menu</h2>
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
                <div class="card">
                    <div class="card-header card-header-divider">Danh sách menu
                        <button class="btn btn-space btn-primary" id="btn-add-menu" style="float: right;"><i class="icon icon-left mdi mdi-plus-circle"></i><span>Thêm menu</span></button>
                        <button class="btn btn-space btn-primary" id="saveOrder" style="float: right;"><i class="icon icon-left mdi mdi-save"></i><span>Lưu menu</span></button>
                        <div class="form-add" id="div-form-add-menu" style="display:none">
                            <form method="post" action="{{ route('menu.store') }}" enctype="multipart/form-data" id="form-add-menu">
                                @csrf
                                <div class="form-group pt-2">
                                    <label for="inputEmail">Tên menu</label>
                                    <input class="form-control" id="inputName" name="name" type="text" placeholder="Tên menu">
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">URL</label>
                                    <input class="form-control" id="inputUrl" name="url" type="text" placeholder="URL">
                                </div>
                                <div class="row pt-3">
                                    <div class="col-lg-6 pb-4 pb-lg-0">
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-right">
                                            <button class="btn btn-space btn-primary" type="submit">Submit</button>
                                            <button class="btn btn-space btn-secondary" type="button" id="btn-cancel-add">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dd" id="list1">
                            <ol class="dd-list">
                                @foreach($menu as $m)
                                <li class="dd-item" data-id="{{$m->id}}" id="menu-item-{{$m->id}}">
                                    <div class="dd-handle">{{$m->name}}</div>
                                    <div class="dd-content">
                                        <button class="btn btn-space btn-social btn-color btn-evernote button-menu edit-btn" data-id="{{$m->id}}" data-name="{{$m->name}}" data-url="{{$m->url}}" type="button"><i class="icon mdi mdi-edit"></i></button>
                                        <button class="btn btn-space btn-social btn-color btn-pinterest button-menu delete-btn" data-id="{{$m->id}}" type="submit"><i class="icon mdi mdi-delete"></i></button>
                                    </div>
                                    <ol class="dd-list">
                                        @foreach($m->submenu as $sm)
                                        <li class="dd-item" data-id="{{$sm->id}}">
                                            <div class="dd-handle">{{$sm->name}}</div>
                                            <div class="dd-content">
                                                <button class="btn btn-space btn-social btn-color btn-evernote button-menu edit-btn" data-id="{{$sm->id}}" data-name="{{$sm->name}}" data-url="{{$sm->url}}" type="button"><i class="icon mdi mdi-edit"></i></button>
                                                <button class="btn btn-space btn-social btn-color btn-pinterest button-menu delete-btn" data-id="{{$sm->id}}" type="submit"><i class="icon mdi mdi-delete"></i></button>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ol>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
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


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: "{{ session('success') }}",
        timer: 1500
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Thất bại!',
        text: "{{ session('erorr') }}",
        timer: 1500
    });
</script>
@endif

<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('.dd').nestable('serialize');

            // Xử lý khi nhấn nút "Lưu thứ tự"
            $("#saveOrder").click(function() {
                var order = $('.dd').nestable('serialize'); // Lấy thứ tự
                console.log("Thứ tự mới:", order); // In ra thứ tự mới

                // Hiển thị hộp thoại xác nhận trước khi lưu
                Swal.fire({
                        title: "Xác nhận lưu?",
                        text: "Bạn có chắc chắn muốn lưu thứ tự này không?",
                        showCancelButton: true,
                        confirmButtonText: "Lưu",
                        cancelButtonText: `Hủy`
                    })
                    .then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            // Nếu người dùng chọn "Lưu", gửi thứ tự mới qua Ajax
                            $.ajax({
                                url: '/admin/updateOrder', // Đường dẫn đến API của bạn
                                method: 'POST',
                                data: {
                                    order: order, // Gửi mảng thứ tự mới
                                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token cho Laravel
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "Saved",
                                        text: "Menu đã được lưu",
                                        icon: "success"
                                    });
                                    console.log("Thứ tự đã được cập nhật thành công:", response);
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        title: "Cancelled",
                                        text: "Menu chưa được lưu",
                                        icon: "error"
                                    });
                                    console.log("Có lỗi xảy ra khi cập nhật thứ tự:", xhr);
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Cancelled",
                                text: "Menu chưa được lưu",
                                icon: "error"
                            });
                        }
                    });
            });
        });

    });
</script>
<script>
    //thêm
    $(document).ready(function() {

        // Sự kiện click cho nút "Add Menu"
        $('#btn-add-menu').on('click', function() {
            $('#div-form-add-menu').slideDown(500); // Hiển thị form thêm menu
        });
        $('#btn-cancel-add').on('click', function() {
            $('#div-form-add-menu').slideUp(500); // Ẩn form với hiệu ứng slide-up
        });
        $('#form-add-menu #inputName').on('input', function() {
            let menuName = $(this).val();

            // Chuyển đổi tên thành URL-friendly
            let menuUrl = menuName.toLowerCase()
                .normalize('NFD') // Chuẩn hóa ký tự
                .replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu tiếng Việt
                .replace(/[^a-z0-9\s-]/g, '') // Xóa ký tự không phải chữ cái và số
                .trim() // Xóa khoảng trắng ở đầu và cuối
                .replace(/\s+/g, '-'); // Thay khoảng trắng bằng dấu gạch ngang

            $('#form-add-menu #inputUrl').val(menuUrl); // Gán URL vào trường
        });
    });

    // Sự kiện click cho tất cả các nút "Edit"
    $(document).ready(function() {
        $('.edit-btn').on('click', function() {
            // Lấy thông tin menu từ thuộc tính data của nút
            let menuId = $(this).data('id');
            let menuName = $(this).data('name');
            let menuUrl = $(this).data('url');

            // Sử dụng SweetAlert2 để hiển thị form chỉnh sửa
            Swal.fire({
                title: 'Chỉnh sửa menu',
                html: `
                <form id="editMenuForm">
                    <div class="form-group">
                        <label style="width: 30%" for="menu-name">Tên menu</label>
                        <input type="text" id="menu-name" class="swal2-input" value="${menuName}">
                    </div>
                    <div class="form-group">
                        <label  style="width: 30%" for="menu-url">URL</label>
                        <input type="text" id="menu-url" class="swal2-input" value="${menuUrl}">
                    </div>
                </form>
            `,
                showCancelButton: true,
                confirmButtonText: 'Lưu',
                cancelButtonText: 'Hủy',
                preConfirm: () => {
                    // Lấy giá trị từ các trường nhập liệu
                    const updatedName = $('#menu-name').val();
                    const updatedUrl = $('#menu-url').val();

                    // Kiểm tra nếu các trường không để trống
                    if (!updatedName || !updatedUrl) {
                        Swal.showValidationMessage('Vui lòng điền đầy đủ thông tin!');
                        return false;
                    }
                    return {
                        name: updatedName,
                        url: updatedUrl
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gửi dữ liệu cập nhật qua AJAX
                    $.ajax({
                        url: `/admin/menu/${menuId}`, // Đường dẫn cập nhật
                        method: 'POST',
                        data: {
                            name: result.value.name,
                            url: result.value.url,
                            _method: 'PUT',
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token cho Laravel
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Saved",
                                text: "Menu đã được lưu",
                                icon: "success"
                            });

                            window.location.href = '/admin/menu';

                            // Tùy chọn: Tải lại trang hoặc cập nhật DOM để phản ánh thay đổi
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cập nhật thất bại',
                                text: 'Có lỗi xảy ra trong quá trình cập nhật.'
                            });
                            console.log("Lỗi:", xhr);
                        }
                    });
                }
            });
        });



        // Xóa
        $('.delete-btn').on('click', function() {
            // Lấy thông tin menu từ thuộc tính data của nút
            let menuId = $(this).data('id');

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
                        url: `/admin/menu/${menuId}`, // Đường dẫn cập nhật
                        method: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token cho Laravel
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Saved",
                                text: "Menu đã được lưu",
                                icon: "success"
                            });

                            $(`#menu-item-${menuId}`).hide();

                            // Tùy chọn: Tải lại trang hoặc cập nhật DOM để phản ánh thay đổi
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cập nhật thất bại',
                                text: 'Có lỗi xảy ra trong quá trình cập nhật.'
                            });
                            console.log("Lỗi:", xhr);
                        }
                    });
                }
            });
        });
    });


    // Sự kiện click cho nút "Cancel" trong form chỉnh sửa
    $('.cancel-btn').on('click', function() {
        const listItem = $(this).closest('li'); // Tìm thẻ li chứa nút "Cancel"
        const editForm = listItem.find('#form-edit'); // Tìm form chỉnh sửa bên trong li đó

        editForm.slideUp(500); // Ẩn form chỉnh sửa
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        App.init();
        App.uiNestableLists();
    });
</script>
</body>

</html>