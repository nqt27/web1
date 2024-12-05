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
                    <div class="card">
                        <div class="card-header card-header-divider">{{$m->name}}
                            <button class="btn btn-space btn-primary btn-submenu" data-id="{{$m->id}}" data-name="{{$m->name}}" data-url="{{$m->url}}" type="button" style="float: right;"><i class="icon icon-left mdi mdi-view-list-alt"></i><span>Danh mục con</span></button>
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
<script src="{{asset('assets\lib\dragula\dragula.min.js')}}" type="text/javascript"></script>


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
    //thêm
    $(document).ready(function() {

        // Sự kiện click cho nút "Add Menu"
        $('#btn-add-submenu').on('click', function() {
            // Sử dụng SweetAlert2 để hiển thị form chỉnh sửa
            Swal.fire({
                title: 'Chỉnh sửa menu',
                html: `
                <form id="editMenuForm">
                    <div class="form-group">
                        <label style="width: 30%" for="menu-name">Tên menu</label>
                        <input type="text" id="menu-name" class="swal2-input">
                    </div>
                    <div class="form-group">
                        <label  style="width: 30%" for="menu-url">URL</label>
                        <input type="text" id="menu-url" class="swal2-input">
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
                        url: `/admin/addsubmenu`, // Đường dẫn cập nhật
                        method: 'POST',
                        data: {
                            name: result.value.name,
                            url: result.value.url,
                            parent_id: "{{$menu->id}}",
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
    //Thêm submenu
    $(document).ready(function() {
        $('.btn-add-submenu').on('click', function() {
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
                        <input type="text" id="menu-name" class="swal2-input">
                    </div>
                    <div class="form-group">
                        <label  style="width: 30%" for="menu-url">URL</label>
                        <input type="text" id="menu-url" class="swal2-input">
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
        // App.uiNestableLists();
        dragula([$("#column-1")[0], $("#column-2")[0]]);
    });
</script>
</body>

</html>