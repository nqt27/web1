@include('admin/layout-header')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row" style="justify-content: space-around;">
            @php
            $todayStats = $dailyStats->last();
            @endphp

            <div class="col-12 col-lg-6 col-xl-3">
                <div class="widget widget-tile">
                    <div class="chart sparkline" id="date">
                        <span class="mdi mdi-chart" style="font-size: 40px;    margin-left: 20px;"></span>
                    </div>
                    <div class="data-info">
                        <div class="desc">Lượt truy cập trong ngày</div>
                        <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="{{$todayStats->total_visits}}">0 </span>
                        </div>
                    </div>
                </div>
            </div>
            @php
            $todayStats = $weeklyStats->last();
            @endphp

            <div class="col-12 col-lg-6 col-xl-3">
                <div class="widget widget-tile">
                    <div class="chart sparkline" id="week">
                        <span class="mdi mdi-chart" style="font-size: 40px;    margin-left: 20px;"></span>
                    </div>
                    <div class="data-info">
                        <div class="desc">Lượt truy cập trong tuần</div>
                        <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="{{$todayStats->total_visits}}">0 </span>
                        </div>
                    </div>
                </div>
            </div>
            @php
            $todayStats = $monthlyStats->last();
            @endphp

            <div class="col-12 col-lg-6 col-xl-3">
                <div class="widget widget-tile">
                    <div class="chart sparkline" id="month">
                        <span class="mdi mdi-chart" style="font-size: 40px;    margin-left: 20px;"></span>
                    </div>
                    <div class="data-info">
                        <div class="desc">Lượt truy cập trong tháng</div>
                        <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="{{$todayStats->total_visits}}">0 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Biểu đồ Lượt Truy Cập</h3>

                <!-- Dropdown để chọn ngày, tuần, tháng -->
                <select class="form-control" id="chartType" onchange="updateChart()" style="width: 20%;">
                    <option value="daily">Ngày</option>
                    <option value="weekly">Tuần</option>
                    <option value="monthly">Tháng</option>
                </select>

                <!-- Biểu đồ -->
                <canvas id="myChart" width="400" height="200"></canvas>

                <script>
                    // Dữ liệu ngày, tuần, tháng từ Blade
                    var dailyDates = <?php echo json_encode($dailyDates); ?>;
                    var dailyVisits = <?php echo json_encode($dailyVisits); ?>;

                    var weeklyDates = <?php echo json_encode($weeklyDates); ?>;
                    var weeklyVisits = <?php echo json_encode($weeklyVisits); ?>;

                    var monthlyDates = <?php echo json_encode($monthlyDates); ?>;
                    var monthlyVisits = <?php echo json_encode($monthlyVisits); ?>;

                    // Biểu đồ mặc định là theo ngày
                    var currentDates = dailyDates;
                    var currentVisits = dailyVisits;

                    // Tạo biểu đồ
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line', // Loại biểu đồ
                        data: {
                            labels: currentDates, // Dữ liệu ngày
                            datasets: [{
                                label: 'Lượt Truy Cập',
                                data: currentVisits, // Dữ liệu số lượt truy cập
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: true,
                                tension: 0.4 // Độ cong của đường
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Ngày'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Số Lượt Truy Cập'
                                    }
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)', // Màu nền của tooltip
                            titleColor: '#fff', // Màu chữ tiêu đề
                            bodyColor: '#fff', // Màu chữ nội dung
                            borderColor: '#36A2EB', // Màu viền tooltip
                            borderWidth: 2, // Độ dày của viền
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.yLabel + ' lượt truy cập'; // Thêm text mô tả
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top', // Vị trí của chú giải
                                labels: {
                                    font: {
                                        size: 14, // Cỡ chữ của chú giải
                                        weight: 'bold',
                                        family: 'Arial'
                                    },
                                    color: '#36A2EB', // Màu chữ của chú giải
                                }
                            }
                        }
                    });

                    // Hàm cập nhật biểu đồ khi thay đổi lựa chọn
                    function updateChart() {
                        var selected = document.getElementById('chartType').value;

                        if (selected === 'daily') {
                            myChart.data.labels = dailyDates;
                            myChart.data.datasets[0].data = dailyVisits;
                        } else if (selected === 'weekly') {
                            myChart.data.labels = weeklyDates;
                            myChart.data.datasets[0].data = weeklyVisits;
                        } else if (selected === 'monthly') {
                            myChart.data.labels = monthlyDates;
                            myChart.data.datasets[0].data = monthlyVisits;
                        }

                        myChart.update();
                    }
                </script>
            </div>
        </div>
    </div>
</div>

</div>
@include('admin/layout-footer')
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