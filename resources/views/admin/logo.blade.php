@include('admin/layout-header')
<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Multi Upload</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
                <li class="breadcrumb-item">Hình ảnh - Logo</li>
                <li class="breadcrumb-item active">Logo</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">Thay đổi logo

                        <button class="btn btn-space btn-primary" style="float: right;" type="submit" id="submit">Lưu logo</button>
                        <button class="btn btn-space btn-secondary" style="float: right;">Hủy</button>
                    </div>
                    <div class="card-body" style="justify-content: center;">
                        <div id="custom-preview" class="custom-preview" style="margin: 20px;display: flex;flex-wrap: wrap;justify-content: center;">
                            <!-- Các ảnh preview sẽ hiển thị ở đây -->
                        </div>
                        <form method="post" action="{{route('logo.store')}}" enctype="multipart/form-data" class="dropzone" id="my-dropzone" style="width: 50%;">
                            @csrf
                            <div class="dz-message">
                                <div class="icon" style="width: 12%;"><span class="mdi mdi-cloud-upload"></span></div>
                                <h3>Kéo thả hình ảnh vào đây</h3><span class="note">hoặc bấm vào đây</span>
                                <div class="dropzone-mobile-trigger needsclick"></div>
                        </form>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('assets\lib\dropzone\dropzone.js')}}" type="text/javascript"></script>

<!-- Dropzone -->
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {

        // Khởi tạo Dropzone cho phần tử đầu tiên
        var myDropzone = new Dropzone("#my-dropzone", {
            maxFiles: 1, // Chỉ cho phép tải lên một ảnh
            autoProcessQueue: false, // Ngừng tự động tải lên khi có ảnh
            paramName: "logo", // Tên trường khi gửi lên server
            uploadMultiple: false,
            previewsContainer: "#custom-preview",
            autoDiscover: false,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            init: function() {
                var myDropzone = this;



                // Khi thêm một ảnh mới, xóa ảnh cũ nếu có
                myDropzone.on("addedfile", function(file) {
                    // Xóa ảnh cũ nếu có
                    var previewContainer = document.getElementById("custom-preview");
                    previewContainer.innerHTML = ""; // Xóa tất cả ảnh cũ trong preview

                    // Tạo phần tử img cho preview của ảnh mới
                    var previewImage = document.createElement("img");
                    previewImage.src = URL.createObjectURL(file); // URL ảnh preview
                    previewImage.alt = file.name;
                    previewImage.className = "custom-preview-image";

                    // Thêm ảnh mới vào vùng custom preview
                    previewContainer.appendChild(previewImage);
                    if (myDropzone.files.length > 1) {
                        myDropzone.removeFile(myDropzone.files[0]); // Xóa ảnh cũ
                    }
                });
            }

        });

        // Xử lý sự kiện khi nhấn nút submit
        $('#submit').on('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động submit mặc định

            // Tạo đối tượng FormData từ form1
            var formData = new FormData();


            // Lấy dữ liệu ảnh chính từ Dropzone
            var file = myDropzone.getAcceptedFiles()[0];
            if (!file) {
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Vui lòng tải lên ít nhất một file!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return; // Dừng xử lý nếu không có file
            }
            if (file) {
                formData.append("logo", file);
            }




            // Hiển thị tất cả các key trong FormData(tùy chọn)
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]); // pair[0] là key, pair[1] là value
            }

            // Gửi request AJAX với FormData đã gộp
            $.ajax({
                url: '/admin/logo', // Đường dẫn route
                method: 'POST',
                data: formData,
                processData: false, // Không xử lý dữ liệu
                contentType: false, // Không thiết lập kiểu content type
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Hiển thị thông báo thành công
                    Swal.fire({
                        title: 'Thành công!',
                        text: 'Dữ liệu đã được gửi thành công.',
                        icon: 'success',
                        timer: 1000, // Thời gian tự động đóng sau 1 giây
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        window.location.href = '/';
                    });

                    // Xóa tất cả các tệp sau khi gửi thành công
                    myDropzone.removeAllFiles();

                },
                error: function(xhr) {
                    // Xử lý khi lỗi xảy ra
                    alert('Error submitting form');
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        //-initialize the javascript
        App.init();
    });
</script>
</body>

</html>