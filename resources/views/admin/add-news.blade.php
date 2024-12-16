@include('admin/layout-header')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Thêm bài viết</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('news.index')}}">Quản lý bài viết</a></li>
                <li class="breadcrumb-item active">Thêm bài viết</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-body" style="flex-direction: row; justify-content: normal">
                        <button type="button" id="submit-all" class="btn btn-primary mt-3" style="margin: 0 10px;">Lưu bài viết</button>
                        <button type="button" class="btn btn-secondary mt-3"><a href="{{route('news.index')}}">Trở về</a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">Thông tin bài viết</div>
                    <div class="card-body">
                        <form style="width: 100%;" id="product-info-form" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Đường dẫn mẫu</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <label class="col-12 col-sm-3 col-form-label" id="url-simple"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"></label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" required="" placeholder="Đường dẫn" name="url" id="product-url">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Tên bài viết</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" required="" placeholder="Tên bài viết" name="title" id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Nội dung</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <textarea id="editor1" name="content"></textarea>
                                </div>
                            </div>
                            <div class="form-group row pt-1">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Danh mục cấp 1</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <select class="form-control" id="select-parent" name="menu_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach($menu as $m)
                                        @if(is_null($m->parent_id))
                                        <option value="{{$m->id}}">{{$m->name}}</option>

                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row pt-1">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Danh mục cấp 2</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <select class="form-control" id="select-child" name="menu_id2">
                                    </select>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">Thiết lập SEO
                        <button class="btn btn-space btn-primary" onclick="checkSEO()" style="float: right;"><span>Kiểm tra SEO</span></button>
                    </div>

                    <div class="card-body">
                        <form style="width: 100%;" id="product-seo-form" method="post" action="{{ route('product.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Keywword chính: </label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" placeholder="Keywword chính" id="keyword_focus" name="keyword_focus">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">SEO Title:</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" placeholder="SEO Title" name="seo_title" id="seo_title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">SEO Keywords:</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" placeholder="SEO Keywords" name="seo_keywords">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">SEO Description:</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <textarea name="seo_description" style="width: 100%; height: 120px; padding: 10px;" id="seo_description" placeholder="SEO Description"></textarea>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">Trạng thái</div>
                    <div class="card-body" id="product-status-form">
                        <div class="form-group row" style="justify-content: space-between; align-items: center; width: 35%;">
                            <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Hiển thị</strong></label>
                            <div style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                <div class="switch-button switch-button-success switch-button-xs">
                                    <input type="checkbox" class="status-checkbox" name="display" id="display"><span>
                                        <label for="display"></label></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" style="justify-content: space-between; align-items: center; width: 35%;">
                            <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Mới</strong></label>
                            <di style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                <div class="switch-button switch-button-success switch-button-xs">
                                    <input type="checkbox" class="status-checkbox" name="is_new" id="is_new"><span>
                                        <label for="is_new"></label></span>
                                </div>
                            </di>
                        </div>
                    </div>
                </div>
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">Ảnh đại diện sản phẩm</div>
                    <div class="card-body">
                        <div id="custom-preview" class="custom-preview" style="margin: 20px">
                            <!-- Các ảnh preview sẽ hiển thị ở đây -->
                        </div>
                        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data" class="dropzone dz-clickable col-12 col-sm-8 col-lg-8" id="my-dropzone">
                            @csrf
                            <div class="dz-message">
                                <div class="icon"><span class="mdi mdi-cloud-upload"></span></div>
                                <h4>Kéo thả hình vào đây</h4>
                                <div class="dropzone-mobile-trigger needsclick"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">Hình ảnh sản phẩm</div>
                    <div class="card-body">
                        <div id="custom-preview1" class="custom-preview" style="margin: 20px;display: flex;flex-wrap: wrap;justify-content: center;">

                        </div>
                        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data" class="dropzone dz-clickable col-12 col-sm-8 col-lg-8" id="my-dropzone1">
                            @csrf
                            <div class="dz-message">
                                <div class="icon"><span class="mdi mdi-cloud-upload"></span></div>
                                <h4>Kéo thả hình vào đây</h4>
                                <div class="dropzone-mobile-trigger needsclick"></div>
                            </div>
                        </form>
                    </div>
                </div> -->
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



<script src="{{asset('assets\lib\summernote\summernote-bs4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\summernote\summernote-ext-beagle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\parsley\parsley.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\dropzone\dropzone.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js\feature.js')}}" type="text/javascript"></script>


<!-- Dropzone -->
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {

        // Khởi tạo Dropzone cho phần tử đầu tiên
        var myDropzone = new Dropzone("#my-dropzone", {
            maxFiles: 1, // Chỉ cho phép tải lên một ảnh
            autoProcessQueue: false, // Ngừng tự động tải lên khi có ảnh
            paramName: "image", // Tên trường khi gửi lên server
            uploadMultiple: false,
            autoDiscover: false,
            previewsContainer: "#custom-preview",
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

        // Khởi tạo Dropzone cho phần tử thứ hai
        // var myDropzone1 = new Dropzone("#my-dropzone1", {
        //     autoProcessQueue: false, // Tắt tự động gửi Dropzone
        //     paramName: "images", // Đặt paramName cho ảnh
        //     addRemoveLinks: true, // Thêm link xóa ảnh
        //     autoDiscover: false,
        //     previewTemplate: `
        //         <div class="dz-preview dz-image-preview">
        //             <div class="dz-image"><img data-dz-thumbnail /></div>

        //         </div>
        //     `,
        //     previewsContainer: "#custom-preview1",
        //     headers: {
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //     },


        // });

        // Xử lý sự kiện khi nhấn nút submit
        $('#submit-all').on('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động submit mặc định

            // console.log(myDropzone1.getAcceptedFiles());
            // Tạo đối tượng FormData từ form1
            var formData = new FormData($('#product-info-form')[0]);

            // Lấy dữ liệu từ form SEO
            $('#product-seo-form').find('input, select, textarea').each(function() {
                if (this.name) {
                    formData.append(this.name, $(this).val());
                }
            });
            // Lấy dữ liệu từ form trạng thái
            $('#product-status-form').find('input').each(function() {
                if (this.name) {
                    formData.append(this.name, $(this).prop('checked') ? 1 : 0);
                }
            });
            // Lấy dữ liệu ảnh chính từ Dropzone
            var file = myDropzone.getAcceptedFiles()[0];

            if (file) {
                formData.append("image", file);
            }


            // Duyệt qua tất cả các file được chọn trong Dropzone1 và thêm vào FormData
            // myDropzone1.getAcceptedFiles().forEach(function(file, i) {
            //     formData.append('images[]', file);


            // });


            // Hiển thị tất cả các key trong FormData(tùy chọn)
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]); // pair[0] là key, pair[1] là value
            }

            // Gửi request AJAX với FormData đã gộp
            $.ajax({
                url: '/admin/addNews', // Đường dẫn route
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
                        window.location.href = '/admin/news';
                    });

                    // Xóa tất cả các tệp sau khi gửi thành công
                    myDropzone.removeAllFiles();
                    myDropzone1.removeAllFiles();

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
        urlProduct();
        selectMenu('{{$menu}}');
        App.init();
        App.textEditors();
        $('form').parsley();
    });
</script>
</body>

</html>