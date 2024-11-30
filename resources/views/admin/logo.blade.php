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
        <form method="post" action="{{route('logo.store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
            @csrf
            <div class="dz-message">
                <div class="icon"><span class="mdi mdi-cloud-upload"></span></div>
                <h2>Drag and Drop files here</h2><span class="note">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                <div class="dropzone-mobile-trigger needsclick"></div>

        </form>
    </div>
    <button class="btn btn-space btn-primary" type="submit">Lưu</button>
    <button class="btn btn-space btn-secondary">Hủy</button>
</div>
</div>
</div>
</div>

<script src="{{asset('assets\lib\jquery\jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\perfect-scrollbar\js\perfect-scrollbar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\bootstrap\dist\js\bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\js\app.js')}}" type="text/javascript"></script>

<script src="{{asset('assets\lib\dropzone\dropzone.js')}}" type="text/javascript"></script>



<script type="text/javascript">
    $(document).ready(function() {
        //-initialize the javascript
        App.init();
    });
</script>
</body>

</html>