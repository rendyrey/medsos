@include('layout.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Twitter Data
      <small>tweet data</small>
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
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Twitter Data Sentiments</h3>
            @if($kosong)
              <h4><font color="red">Empty Result!</h4></font>
            @endif
          </div>
          <!-- /.box-header -->

          {{Form::open(array('url'=>'twitter_data/0'))}}
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
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Sentiment:</label>
              {{Form::select('sentiment',$sentiment_opt,'',['class'=>'form-control select2','style'=>'width:100%','data-placeholder'=>'Select Sentiment'])}}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Keyword:</label>
              {{Form::select('keyword',$keyword_opt,'',['class'=>'form-control select2','style'=>'width:100%','data-placeholder'=>'Select Keyword'])}}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>&nbsp;</label>
              {{Form::submit('Submit',['class'=>'form-control btn btn-info','name'=>'submit'])}}
            </div>
          </div>


          {{Form::close()}}
          <div class="box-body">
            <div class="col-md-2 col-md-offset-8">
              @if ($offset_prev>=0)
                <a href="{{url('twitter_data/'.$offset_prev)}}">
                  <button type="button" class="btn btn-block btn-warning">Prev 500</button>
                </a>
              @endif
            </div>

            <div class="col-md-2">
              <a href ="{{url('twitter_data/'.$offset_next)}}">
                <button type="button" class="btn btn-block btn-info">Next 500</button>
              </a>
            </div>
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Keyword</th>
                  <th>Date & Time</th>
                  <th>Timezone</th>
                  <th>Username</th>
                  <th>Tweet</th>
                  <th>Sentiment</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=0;?>
                @foreach ($tweet as $key => $value)
                  <tr>
                    <td>{{++$no}}</td>
                    <td>{{$value->keyword}}</td>
                    <td>{{$value->date}} | {{$value->time}}</td>
                    <td>{{$value->timezone}}</td>
                    <td>{{$value->username}}</td>
                    <td><?php echo strlen($value->tweet) >= 140 ?
                    substr($value->tweet, 0, 130) .'<a href="link/to/the/entire/text.htm">[Read more]</a>' :
                    $value->tweet; ?></td>
                    <td>
                      @if($value->sentiment == "negatif")
                        <?php $lbl = "danger"; ?>
                      @elseif ($value->sentiment == "positif")
                        <?php $lbl = "success"; ?>
                      @elseif ($value->sentiment == "netral")
                        <?php $lbl = "warning"; ?>
                      @endif
                      <button type="button" class="btn btn-block btn-{{$lbl}} btn-xs">{{$value->sentiment}}</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>

            </table>
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
