@include('admin/layout-header')

<div class="be-wrapper">
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Quản lý bài viết</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">Admin</a></li>
                    <li class="breadcrumb-item active">Quản lý bài viết</li>
                </ol>
            </nav>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-header">
                            <div class="tools">
                                <span class="icon mdi mdi-download" style="font-size: 25px;margin: 10px;"></span>
                                <a href="{{route('addNews')}}" role="button"><span class="icon mdi mdi-plus-circle" style="margin: 10px;"></span></a>

                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-fw-widget" id="table1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Feature</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>Trident</td>
                                        <td>
                                            Internet
                                            Explorer 4.0
                                        </td>
                                        <td>Win 95+</td>
                                        <td class="center">

                                            <a href="{{route('addNews')}}" role="button">
                                                <div class="icon-container">
                                                    <div class="icon"><span class="mdi mdi-edit"></span></div>
                                                </div>
                                            </a>
                                            <a href="{{route('addNews')}}" role="button">
                                                <div class="icon-container">
                                                    <div class="icon"><span class="mdi mdi-delete"></span></div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>Trident</td>
                                        <td>
                                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas, a! Delectus numquam dignissimos harum eum! Eius cumque hic expedita tenetur, quas alias. Laboriosam velit, eos facilis sed enim placeat aperiam.
                                        </td>
                                        <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati quibusdam sunt aperiam, quod officiis doloribus saepe maiores sit corrupti molestiae molestias distinctio, atque minima. Ex dolore corporis velit est ratione!</td>
                                        <td class="center">

                                            <a href="{{route('addNews')}}" role="button">
                                                <div class="icon-container">
                                                    <div class="icon"><span class="mdi mdi-edit"></span></div>
                                                </div>
                                            </a>
                                            <a href="{{route('addNews')}}" role="button">
                                                <div class="icon-container">
                                                    <div class="icon"><span class="mdi mdi-delete"></span></div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>
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



<script type="text/javascript">
    $(document).ready(function() {
        //-initialize the javascript
        App.init();
        App.dataTables();
    });
</script>
</body>

</html>