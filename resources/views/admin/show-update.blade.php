@include('admin/layout-header')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Chỉnh sửa sản phẩm</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Quản lý sản phẩm</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa sản phẩm</li>
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
                    <div class="card-header card-header-divider">Thông tin sản phẩm
                    </div>
                    <div class="card-body">
                        <form style="width: 100%;" id="product-info-form" method="post" action="{{ route('product.update', $product->id) }}">
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
                                    <input class="form-control" type="text" required="" placeholder="Đường dẫn" value="{{$product->url}}" name="url" id="product-url">
                                </div>
                            </div>
                            <div class=" form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Tên sản phẩm</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" required="" placeholder="Tên sản phẩm" value="{{$product->name}}" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Mô tả</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <textarea id="editor1" name="description">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Giá</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" required="" value="{{$product->price}}" placeholder="Giá" name="price">
                                </div>
                            </div>
                            <div class="form-group row pt-1">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Danh mục</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <select class="form-control" id="select-parent" name="menu_id">
                                        @foreach($menu as $m)
                                        <option value="{{ $m->id }}"
                                            {{ $selectedMenu && $m->id == $selectedMenu->parent_id ? 'selected' : '' }}>
                                            {{ $m->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pt-1">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Danh mục cấp 2</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <select class="form-control" id="select-child" name="menu_id2">
                                        @if($selectedMenu)
                                        @foreach($menu->where('id', $selectedMenu->parent_id)->first()->submenu ?? [] as $child)
                                        <option value="{{ $child->id }}"
                                            {{ $child->id == $selectedMenu->id ? 'selected' : '' }}>
                                            {{ $child->name }}
                                        </option>
                                        @endforeach
                                        @endif
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
                                    <input class="form-control" type="text" placeholder="Keywword chính" name="keyword_focus" id="keyword_focus" value="{{$product->keyword_focus}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">SEO Title:</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" placeholder="seo_title" name="seo_title" id="seo_title" value="{{$product->seo_title}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">SEO Keywords:</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <input class="form-control" type="text" placeholder="seo_keywords" name="seo_keywords" value="{{$product->seo_keywords}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">SEO Description:</label>
                                <div class="col-12 col-sm-8 col-lg-8">
                                    <textarea name="seo_description" style="width: 100%; height: 120px; padding: 10px;" id="seo_description" placeholder="SEO Description">{{$product->seo_keywords}}</textarea>
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
                                    <input type="checkbox" class="status-checkbox" name="display" id="display" {{ $product->display ? 'checked' : '' }}><span>
                                        <label for="display"></label></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" style="justify-content: space-between; align-items: center; width: 35%;">
                            <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Khuyến mãi</strong></label>
                            <div style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                <div class="switch-button switch-button-success switch-button-xs">
                                    <input type="checkbox" class="status-checkbox" name="discount" id="discount" {{ $product->discount ? 'checked' : '' }}><span>
                                        <label for="discount"></label></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" style="justify-content: space-between; align-items: center; width: 35%;">
                            <label style="padding: 0" class="col-12 col-sm-3 col-form-label"><strong>Mới</strong></label>
                            <div style="padding: 0" class="col-12 col-sm-8 col-lg-6">
                                <div class="switch-button switch-button-success switch-button-xs">
                                    <input type="checkbox" class="status-checkbox" name="is_new" id="is_new" {{ $product->new ? 'checked' : '' }}><span>
                                        <label for="is_new"></label></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">Hình ảnh đại diện
                    </div>
                    <div class="card-body">
                        <!-- Khu vực hiển thị preview -->
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
    console.log('{{$product->menu_id}}');

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
                        $submenuSelect.append('<option value="' + submenu.id + '"' +
                            (submenu.id == '{{$product->menu_id}}' ? ' selected' : '') +
                            '>' + submenu.name + '</option>');
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
<script>
    const baseUrl = window.location.origin + "/" + "{{$product->url}}";
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
<script>
    document.getElementById("product-url").addEventListener("input", function(event) {
        // Lấy giá trị người dùng nhập
        let value = event.target.value;

        // Xử lý: Thay thế dấu cách bằng dấu gạch ngang, loại bỏ ký tự đặc biệt, chuyển chữ hoa thành chữ thường
        value = value
            .toLowerCase() // Chuyển chữ hoa thành chữ thường
            .trim() // Xóa khoảng trắng đầu và cuối
            .replace(/[^a-z0-9\s-]/g, '') // Loại bỏ ký tự đặc biệt
            .replace(/\s+/g, '-') // Thay dấu cách bằng dấu '-'
            .replace(/-+/g, '-'); // Xóa bớt dấu '-' thừa nếu có

        // Cập nhật giá trị ô input
        event.target.value = value;
        console.log(value);

    });
</script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {


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

                // Thêm ảnh từ cơ sở dữ liệu (nếu có)
                var existingImage = "{{ asset('images/' . $product->image) }}";
                if (existingImage) {
                    var previewContainer = document.getElementById("custom-preview");

                    // Tạo phần tử img cho preview của ảnh cũ
                    var previewImage = document.createElement("img");
                    previewImage.src = existingImage; // URL ảnh preview
                    previewImage.className = "custom-preview-image";
                    previewImage.alt = "Current Image";

                    // Thêm ảnh vào vùng custom preview
                    previewContainer.appendChild(previewImage);
                }

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

            // init: function() {

            //     // myDropzone1.getAcceptedFiles().forEach(function(file, i) {
            //     // console.log(myDropzone1.getAcceptedFiles());

            //     // });
            // }
        });

        // Thêm ảnh từ cơ sở dữ liệu (nếu có)
        var str = "{{$product->images}}";

        const cleanStr = str.replace(/&quot;/g, '"'); // Thay thế &quot; bằng dấu ngoặc kép "
        const array = JSON.parse(cleanStr);

        array.forEach(function(imageName) {

            // Lấy ảnh từ URL và tạo mock file từ dữ liệu
            fetch("{{ asset('images') }}/" + imageName)
                .then(response => response.blob())
                .then(blob => {
                    const mockFile = new File([blob], imageName, blob);
                    myDropzone1.addFile(mockFile); // Thêm mock file vào Dropzone
                });


            console.log(myDropzone1);


        });

        $('#submit-all').on('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động submit mặc định

            // Tạo đối tượng FormData từ form1
            var formData = new FormData($('#product-info-form')[0]);
            formData.append('_method', 'PUT');
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
            // Lấy dữ liệu từ form thứ hai và thêm vào formData
            var file = myDropzone.getAcceptedFiles()[0];
            if (file) {
                formData.append("image", file);
            }

            // Duyệt qua tất cả các file được chọn trong Dropzone1 và thêm vào FormData
            myDropzone1.getAcceptedFiles().forEach(function(file, i) {
                formData.append('images[]', file);


            });

            formData.forEach(function(value, key) {
                console.log(key + ": " + value);
            });
            var productId = "{{ $product->id }}"; // Lấy ID sản phẩm từ PHP
            //Gửi request AJAX với FormData đã gộp
            $.ajax({
                url: `/admin/product/${productId}`, // Đường dẫn route
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
                        timer: 1000, // Thời gian tự động đóng sau 3 giây
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        window.location.href = '/admin/product';
                    });
                    myDropzone.removeAllFiles(); // Xóa tất cả các tệp sau khi gửi thành công

                    // Load lại trang khác (ví dụ chuyển đến trang danh sách sản phẩm)
                },
                error: function(xhr) {
                    // Xử lý khi lỗi xảy ra
                    alert('Error submitting form');
                    console.log(xhr);

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