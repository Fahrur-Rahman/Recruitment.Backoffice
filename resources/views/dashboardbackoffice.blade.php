<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ URL::asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ URL::asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ URL::asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">
</head>
@extends('dashboard/header')

@section('home')
<body>
<!-- Content Wrapper. Contains page content -->
<div class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Overview</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$jmlcandidate}}</h3>

                <p>Queue</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$statusaccpet}}</h3>

                <p>Approve</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-round"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$statuspurpose}}</h3>

                <p>Proposed</p>
              </div>
              <div class="icon">
                <i class="ion ion-thumbsup"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$statusreject}}</h3>

                <p>Rejected</p>
              </div>
              <div class="icon">
                <i class="ion ion-close-round"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-lg-6 col-12">
             <!-- title list -->
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">Last Interview</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach($candidate as $cddt)
                <li class="item">
                    <div class="product-img">
                        <i class="ion ion-document" style="font-size:50px; "></i>
                    </div>
                      <div class="product-info row">
                        <div class="col-10">
                            <a href="javascript:void(0)" class="product-title">{{$cddt->nik}} - {{$cddt->fullname}}</a>
                            <span class="product-description">{{$cddt->applydate}}</span>
                        </div>
                        @if($cddt->statusid == 5)
                            @if($cddt->anotherstatus == 1)
                              <div style="text-align:right;">
                                  <button type="button" class="btn btn-warning btn-sm" style="border-radius:2em;">Propose</button>
                              </div>
                            @elseif($cddt->anotherstatus == 2)
                              <div style="text-align:right;">
                                  <button type="button" class="btn btn-success btn-sm" style="border-radius:2em;">Approved</button>
                              </div>
                            @else
                            <div style="text-align:right;">
                                <button type="button" class="btn btn-danger btn-sm" style="border-radius:2em;">Rejected</button>
                            </div>
                            @endif         
                        @elseif($cddt->statusid == 1)
                            <div style="text-align:right;">
                                <button type="button" class="btn btn-warning btn-sm" style="border-radius:2em;">Propose</button>
                            </div>
                        @elseif($cddt->statusid == 2)
                            <div style="text-align:right;">
                                <button type="button" class="btn btn-success btn-sm" style="border-radius:2em;">Approved</button>
                            </div>
                          @else
                          <div style="text-align:right;">
                            <button type="button" class="btn btn-danger btn-sm" style="border-radius:2em;">Rejected</button>
                        </div>
                        @endif                        
                      </div>
                  </li>
                  @endforeach
                  <!-- /li -->
                </ul>
              </div>
             
              <!-- /.card-body -->
            </div>
            </div>
          <!-- ./col -->
          <div class="col-lg-6 col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Browser Usage</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8" style="text-align:center;">
                    <div class="chart-responsive">
                        <div id="donutchart" style="width: 350px; height: 275px;"></div>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <li><i class="fas fa-circle" style="color:blue;"></i> Candidate</li>
                      <li><i class="fas fa-circle" style="color:green;"></i> Approve</li>
                      <li><i class="fas fa-circle" style="color:orange;"></i> Proposed</li>
                      <li><i class="fas fa-circle" style="color:red;"></i> Rejected</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
          @endsection

</body>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ URL::asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ URL::asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ URL::asset('plugins/chart.js/Chart.min.js') }}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ URL::asset('dist/js/pages/dashboard2.js') }}"></script>

<!-- jQuery -->
<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ URL::asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ URL::asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ URL::asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ URL::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ URL::asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('dist/js/demo.js') }}"></script>
<!-- Google Chart -->
<script type="text/javascript" src="{{ URL::asset('https://www.gstatic.com/charts/loader.js') }}"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Status', 'Jumlah'],
                ['Candidate',     {{$jmlcandidate}}],
                ['Rejected',      {{$statusreject}}],
                ['Proposed',      {{$statuspurpose}}],
                ['Approve',     {{$statusaccpet}}],
            ]);
              
            var options = {
                tooltip: {
                text: 'value'
                },  
                pieHole: 0.5,
                pieSliceText: 'none',
                legend: 'none',
                colors: ['blue', 'red', 'orange', 'green']
                };
              
            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
</script>
</html>