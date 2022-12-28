@extends('layout.admin')
@section('title', 'Trang chủ')
@section('content')
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: General Report -->
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Tổng quan</h2>
        </div>
        <div>
            <canvas id="myChart"></canvas>
        </div>
        <input type="hidden" id="month1" value="{{$month1}}">
        <input type="hidden" id="month2" value="{{$month2}}">
        <input type="hidden" id="month3" value="{{$month3}}">
        <input type="hidden" id="month4" value="{{$month4}}">
        <input type="hidden" id="month5" value="{{$month5}}">
        <input type="hidden" id="month6" value="{{$month6}}">
        <input type="hidden" id="month7" value="{{$month7}}">
        <input type="hidden" id="month8" value="{{$month8}}">
        <input type="hidden" id="month9" value="{{$month9}}">
        <input type="hidden" id="month10" value="{{$month10}}">
        <input type="hidden" id="month11" value="{{$month11}}">
        <input type="hidden" id="month12" value="{{$month12}}">
        <div class="title-chart">Biểu đồ thể hiện số lượng người truy cập website trong năm 2022.</div>

        <div style="padding-top: 60px">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Tổng tháng trước</th>
                    <th scope="col">Tổng tháng này</th>
                    <th scope="col">Tổng năm qua</th>
                    <th scope="col">Tất cả</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>{{$visitor_last_month}}</td>
                    <td>{{$visitor_this_month}}</td>
                    <td>{{$visitor_year}}</td>
                    <td>{{$all}}</td>
                    </tr>
                </tbody>
            </table>
        <div class="title-chart">Bảng thống kê số lượng truy cập Website .</div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        var month1 = $('#month1').val();
        var month2 = $('#month2').val();
        var month3 = $('#month3').val();
        var month4 = $('#month4').val();
        var month5 = $('#month5').val();
        var month6 = $('#month6').val();
        var month7 = $('#month7').val();
        var month8 = $('#month8').val();
        var month9 = $('#month9').val();
        var month10 = $('#month10').val();
        var month11 = $('#month11').val();
        var month12 = $('#month12').val();
        

        new Chart(ctx, {
            type: 'line',
            data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: '# Số lượng người truy cập',
                data: [month1, month2, month3, month4, month5, month6, month7, month8, month9, month10, month11, month12],
                borderWidth: 3
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    </script>
@endsection