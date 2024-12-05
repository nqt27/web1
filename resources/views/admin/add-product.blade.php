@include('admin/layout-header')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Thêm sản phẩm</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Quản lý sản phẩm</a></li>
                <li class="breadcrumb-item active">Thêm sản phẩm</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-body" style="flex-direction: row; justify-content: normal">
                        <button type="button" id="submit-all" class="btn btn-primary mt-3" style="margin: 0 10px;">Lưu sản phẩm</button>
                        <button type="button" class="btn btn-secondary mt-3"><a href="{{route('product.index')}}">Trở về</a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">Thông tin sản phẩm</div>
                    <div class="card-body">
                        <form style="width: 100%;" id="product-info-form" method="post" action="{{ route('product.store') }}">
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
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Tên sản phẩm</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" required="" placeholder="Tên sản phẩm" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Mô tả</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <textarea id="editor1" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Giá</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" required="" placeholder="Giá" name="price">
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
                                    <select class="form-control" id="select-child" name="menu_id">
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
                            <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Khuyến mãi</strong></label>
                            <di style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                <div class="switch-button switch-button-success switch-button-xs">
                                    <input type="checkbox" class="status-checkbox" name="discount" id="discount"><span>
                                        <label for="discount"></label></span>
                                </div>
                            </di>
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
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">Hình ảnh sản phẩm</div>
                    <div class="card-body">
                        <div id="custom-preview1" class="custom-preview" style="margin: 20px;display: flex;flex-wrap: wrap;justify-content: center;">
                            <!-- Các ảnh preview sẽ hiển thị ở đây -->
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



<script src="{{asset('assets\lib\summernote\summernote-bs4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\summernote\summernote-ext-beagle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\parsley\parsley.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\dropzone\dropzone.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- submenu -->
<script>
    // Tạo đối tượng menu và submenu từ dữ liệu PHP
    var menuData = '{{$menu}}';
    var cleanStr = menuData.replace(/&quot;/g, '"'); // Thay thế &quot; bằng dấu ngoặc kép "
    var array = JSON.parse(cleanStr);
    $('#select-parent').on('change', function() {
        let parentId = $(this).val(); // Lấy giá trị menu cha đã chọn
        let $submenuSelect = $('#select-child');
        $submenuSelect.empty(); // Xóa các option cũ

        // Kiểm tra nếu menu có submenu và hiển thị các submenu tương ứng
        var hasSubmenu = false;

        // Duyệt qua tất cả các menu
        array.forEach(function(menu) {
            if (menu.id == parentId) {
                hasSubmenu = true;
                // Duyệt qua các submenu của menu cha
                if (menu.submenu && menu.submenu.length > 0) {
                    menu.submenu.forEach(function(submenu) {
                        $submenuSelect.append('<option value="' + submenu.id + '">' + submenu.name + '</option>');
                    });
                    $submenuSelect.show(); // Hiển thị dropdown submenu
                }
            }
        });

        // Nếu không có submenu thì ẩn dropdown submenu
        if (!hasSubmenu) {
            $submenuSelect.hide();
        }
    });
</script>
<!-- SEO -->
<script>
    function checkSEO() {

        let results = [];
        let focusKeyword = document.getElementById("keyword_focus").value;
        //Keyword Focus
        let checkFocusKeyword = (!focusKeyword) ?
            `<div class="alert alert-danger alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Đặt từ khóa chính cho nội dung.
                    </div>
                </div>` :
            `<div class="alert alert-success alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-check"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Đã thêm từ khóa chính.
                    </div>
                </div>`;
        //Keyword Focus nằm trong Title SEO
        let titleSeo = document.getElementById("seo_title").value;
        let checkFocusKeywordTitle = (titleSeo && focusKeyword && (titleSeo.toLowerCase().includes(focusKeyword.toLowerCase()))) ?

            `<div class="alert alert-success alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-check"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Tiêu đề SEO bao gồm từ khóa chính.
                    </div>
                </div>` :
            `<div class="alert alert-danger alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Thêm Từ khóa chính vào tiêu đề SEO.
                    </div>
            </div>`;
        //Vị trí Keyword Focus
        let position = titleSeo.toLowerCase().indexOf(focusKeyword.toLowerCase());
        let checkPosition = (titleSeo && focusKeyword && position >= 0 && position <= 20) ?
            `<div class="alert alert-success alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-check"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Sử dụng từ khóa chính gần đầu tiêu đề SEO.
                    </div>
            </div>` :
            `<div class="alert alert-danger alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Sử dụng từ khóa chính gần đầu tiêu đề SEO.
                    </div>
            </div>`;
        //Ký tự tiêu đề
        if (titleSeo.length < 10) {
            checkTitleLength =
                `<div class="alert alert-danger alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Tiêu đề quá ngắn. Tiêu đề nên từ 10 đến 70 ký tự
                    </div>
            </div>`;
        } else if (titleSeo.length > 70) {
            checkTitleLength =
                `<div class="alert alert-danger alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Tiêu đề quá dài. Tiêu đề nên từ 10 đến 70 ký tự
                    </div>
            </div>`;
        } else {
            checkTitleLength =
                `<div class="alert alert-success alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-check"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Tiêu đề đã có độ dài tối ưu.
                    </div>
            </div>`;
        }

        //Keyword Focus nằm trong Mô tả SEO
        let desSeo = document.getElementById("seo_description").value;
        let checkFocusKeywordDes = (desSeo && focusKeyword && (desSeo.toLowerCase().includes(focusKeyword.toLowerCase()))) ?

            `<div class="alert alert-success alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-check"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Mô tả SEO bao gồm từ khóa chính.
                    </div>
                </div>` :
            `<div class="alert alert-danger alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Thêm Từ khóa chính vào mô tả SEO.
                    </div>
            </div>`;
        //Ký tự tiêu đề
        if (desSeo.length < 10) {
            checkDesLength =
                `<div class="alert alert-danger alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Mô tả quá ngắn. Mô tả nên từ 10 đến 160 ký tự
                    </div>
            </div>`;
        } else if (desSeo.length > 160) {
            checkDesLength =
                `<div class="alert alert-danger alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Mô tả quá dài. Mô tả nên từ 10 đến 160 ký tự
                    </div>
            </div>`;
        } else {
            checkDesLength =
                `<div class="alert alert-success alert-icon alert-dismissible check-seo" role="alert">
                    <div class="icon"><span class="mdi mdi-check"></span></div>
                    <div class="message">
                        <button class="close" type="button" data-dismiss="alert"></button>Mô tả đã có độ dài tối ưu.
                    </div>
            </div>`;
        }



        results.push(`
        ${checkFocusKeyword}
        ${checkFocusKeywordTitle}
        ${checkPosition}
        ${checkTitleLength}
        ${checkFocusKeywordDes}
        ${checkDesLength}
        `);
        // Hiển thị kết quả bằng SweetAlert2
        Swal.fire({
            title: 'Kết quả kiểm tra SEO',
            html: results.join('<br>'),
            icon: 'info',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'custom-swal-width' // Áp dụng lớp CSS tùy chỉnh
            },
        });
    }
</script>
<!-- url -->
<script>
    const baseUrl = window.location.origin + "/";
    document.getElementById("url-simple").innerText = baseUrl;
    document.getElementById("product-url").addEventListener("input", function(event) {
        // Lấy giá trị người dùng nhập
        let value = event.target.value;

        // Xử lý: Thay thế dấu cách bằng dấu gạch ngang, loại bỏ ký tự đặc biệt, chuyển chữ hoa thành chữ thường
        value = value
            .normalize('NFD') // Chuyển chuỗi thành dạng phân tách (NFD)
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase() // Chuyển chữ hoa thành chữ thường
            // .trim() // Xóa khoảng trắng đầu và cuối
            .replace(/[^a-z0-9\s-]/g, '') // Loại bỏ ký tự đặc biệt
            .replace(/\s+/g, '-') // Thay dấu cách bằng dấu '-'
        // .replace(/-+/g, '-'); // Xóa bớt dấu '-' thừa nếu có

        // Cập nhật giá trị ô input
        event.target.value = value;
        const baseUrl = window.location.origin + "/";
        document.getElementById("url-simple").innerText = baseUrl + value;
    });
</script>
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
        var myDropzone1 = new Dropzone("#my-dropzone1", {
            autoProcessQueue: false, // Tắt tự động gửi Dropzone
            paramName: "images", // Đặt paramName cho ảnh
            addRemoveLinks: true, // Thêm link xóa ảnh
            autoDiscover: false,
            previewTemplate: `
                <div class="dz-preview dz-image-preview">
                    <div class="dz-image"><img data-dz-thumbnail /></div>
                    
                </div>
            `,
            previewsContainer: "#custom-preview1",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },


        });

        // Xử lý sự kiện khi nhấn nút submit
        $('#submit-all').on('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động submit mặc định

            console.log(myDropzone1.getAcceptedFiles());
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
            myDropzone1.getAcceptedFiles().forEach(function(file, i) {
                formData.append('images[]', file);


            });


            // Hiển thị tất cả các key trong FormData(tùy chọn)
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]); // pair[0] là key, pair[1] là value
            }

            // Gửi request AJAX với FormData đã gộp
            $.ajax({
                url: '/admin/addProduct', // Đường dẫn route
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
                        window.location.href = '/admin/product';
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
        App.init();
        App.textEditors();
        $('form').parsley();
    });
</script>
</body>

</html>