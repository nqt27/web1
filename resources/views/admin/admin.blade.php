@include('admin/layout-header')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="widget widget-tile">
                    <div class="chart sparkline" id="spark1"></div>
                    <div class="data-info">
                        <div class="desc">Thông báo mới</div>
                        <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="113">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="widget widget-tile">
                    <div class="chart sparkline" id="spark2"></div>
                    <div class="data-info">
                        <div class="desc">Bài viết mới</div>
                        <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span class="number" data-toggle="counter" data-end="80" data-suffix="%">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="widget widget-tile">
                    <div class="chart sparkline" id="spark3"></div>
                    <div class="data-info">
                        <div class="desc">Impressions</div>
                        <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span class="number" data-toggle="counter" data-end="532">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="widget widget-tile">
                    <div class="chart sparkline" id="spark4"></div>
                    <div class="data-info">
                        <div class="desc">Downloads</div>
                        <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span class="number" data-toggle="counter" data-end="113">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget widget-fullwidth be-loading">
                    <div class="widget-head">
                        <div class="tools">
                            <div class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><span class="icon mdi mdi-more-vert d-inline-block d-md-none"></span></a>
                                <div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Week</a><a class="dropdown-item" href="#">Month</a><a class="dropdown-item" href="#">Year</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Today</a>
                                </div>
                            </div><span class="icon mdi mdi-chevron-down"></span><span class="icon toggle-loading mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span>
                        </div>
                        <div class="button-toolbar d-none d-md-block">
                            <div class="btn-group">
                                <button class="btn btn-secondary" type="button">Week</button>
                                <button class="btn btn-secondary active" type="button">Month</button>
                                <button class="btn btn-secondary" type="button">Year</button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-secondary" type="button">Today</button>
                            </div>
                        </div><span class="title">Recent Movement</span>
                    </div>
                    <div class="widget-chart-container">
                        <div class="widget-chart-info">
                            <ul class="chart-legend-horizontal">
                                <li><span data-color="main-chart-color1"></span> Purchases</li>
                                <li><span data-color="main-chart-color2"></span> Plans</li>
                                <li><span data-color="main-chart-color3"></span> Services</li>
                            </ul>
                        </div>
                        <div class="widget-counter-group widget-counter-group-right">
                            <div class="counter counter-big">
                                <div class="value">25%</div>
                                <div class="desc">Purchase</div>
                            </div>
                            <div class="counter counter-big">
                                <div class="value">5%</div>
                                <div class="desc">Plans</div>
                            </div>
                            <div class="counter counter-big">
                                <div class="value">5%</div>
                                <div class="desc">Services</div>
                            </div>
                        </div>
                        <div id="main-chart" style="height: 260px;"></div>
                    </div>
                    <div class="be-spinner">
                        <svg width="40px" height="40px" viewbox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                            <circle class="circle" fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                        </svg>
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
<script src="{{asset('assets\lib\jquery-flot\jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jquery-flot\jquery.flot.pie.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jquery-flot\jquery.flot.time.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jquery-flot\jquery.flot.resize.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jquery-flot\plugins\jquery.flot.orderBars.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jquery-flot\plugins\curvedLines.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jquery-flot\plugins\jquery.flot.tooltip.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jquery.sparkline\jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\countup\countUp.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jquery-ui\jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jqvmap\jquery.vmap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\jqvmap\maps\jquery.vmap.world.js')}}" type="text/javascript"></script>

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
<script src="{{asset('assets\lib\dropzone\dropzone.js')}}" type="text/javascript"></script>

<script src="{{asset('assets\lib\summernote\summernote-bs4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\lib\summernote\summernote-ext-beagle.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        //-initialize the javascript
        App.init();
        App.dashboard();
    });
</script>
</body>

</html>