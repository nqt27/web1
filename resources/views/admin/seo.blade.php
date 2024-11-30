@include('admin/layout-header')
<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Thêm bài viết</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('news')}}">Quản lý bài viết</a></li>
                <li class="breadcrumb-item active">Thêm bài viết</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Tiêu đề</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input class="form-control" type="text" required="" placeholder="Tiêu đề" name="title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Nội dung</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <textarea id="editor1" name="content"></textarea>
                                </div>
                            </div>
                    </div>
                    <div class="form-group row text-right">
                        <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                            <button class="btn btn-space btn-primary" type="submit">Submit</button>
                            <button class="btn btn-space btn-secondary">Cancel</button>
                        </div>
                    </div>
                    </form>
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