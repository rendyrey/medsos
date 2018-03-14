@include('layout.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Graphic Data
      <small>graphic data for media social analysis</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            {{Form::open(array('route'=>'graphic_detail','method'=>'post'))}}
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Date range:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    {{-- <input type="text" class="form-control pull-right" id="reservation"> --}}
                    {{Form::text('date_range','',['class'=>'form-control pull-right','id'=>'reservation'])}}
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Keyword</label>
                  {{-- {{Form::text('keyword','')}} --}}
                  {{Form::select('keyword',$keyword_opt,'',['class'=>'form-control select2','data-placeholder'=>'Select Keyword'])}}
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Class</label>
                  {{Form::select('class',$class_opt,'',['class'=>'form-control select2','data-placeholder'=>'Select Class'])}}
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  {{Form::submit('Submit',['class'=>'btn btn-info'])}}
                </div>
              </div>
            </div>
            {{Form::close()}}

            <div id="{{$chart}}" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>



            <script type="text/javascript">

            Highcharts.chart('container', {
              chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
              },
              title: {
                text: '{{$judul_grafik}}'
              },
              tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
              },
              plotOptions: {
                pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                      color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                  }
                }
              },
              series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                  name: 'Positive',
                  y: {{$jml_positif}},
                  color: '#1ce790'
                }, {
                  name: 'Negative',
                  y: {{$jml_negatif}},
                  color: '#f93c75'
                }, {
                  name: 'Neutral',
                  y: {{$jml_netral}},
                  color: '#fff16a'
                }]
              }]
            });
            </script>

            <script type="text/javascript">

            Highcharts.chart('bar', {
              chart: {
                type: 'bar'
              },
              title: {
                text: '{{$judul_grafik}}'
              },
              xAxis: {
                categories: [
                  @if(isset($username))
                    @foreach ($username as $key => $value)
                    '{{$value->username}}',
                    @endforeach
                  @endif
                ],
                title: {
                  text: null
                }
              },
              yAxis: {
                min: 0,
                title: {
                  text: 'Tweet(s)',
                  align: 'high'
                },
                labels: {
                  overflow: 'justify'
                }
              },
              tooltip: {
                valueSuffix: ' tweets'
              },
              plotOptions: {
                bar: {
                  dataLabels: {
                    enabled: true
                  }
                }
              },
              // legend: {
              //   layout: 'vertical',
              //   align: 'right',
              //   verticalAlign: 'top',
              //   x: 0,
              //   y: 80,
              //   floating: false,
              //   borderWidth: 0,
              //   backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
              //   shadow: true
              // },
              credits: {
                enabled: false
              },
              series: [{
                name: 'Tweets count',
                data: [
                  @if (isset($username))
                    @foreach ($username as $key => $value)
                    {{$value->jml_username}},
                    @endforeach
                  @endif
                ]
              }]
            });
            </script>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('layout.footer')
