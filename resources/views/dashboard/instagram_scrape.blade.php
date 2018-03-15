@include('layout.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <style>
  #loading{
    background: rgba(0,0,0,.5);
    /* url('../Images/ajax-loader-bright.gif') no-repeat; */
    width:100%;
    height:100%;
    position:fixed;
    top:0;
    left:0;
    z-index:999;
  }
  </style>
  <div id="loading" style="display:none;">
  </div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Instagram Sentiment Analysis
      {{-- <small>Preview</small> --}}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{route('twitter_scrape')}}">Instagram Scrape</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            {{Form::open(array('action'=>'TwitterController@store','method'=>'post','files'=>TRUE,'id'=>'form_twitter'))}}
            <div class="form-group">
              <label>Keyword</label>
              {{Form::text('keyword','',['class'=>'form-control','placeholder'=>'Keyword','required'])}}
              {{-- <select class="form-control select2" style="width: 100%;">
              <option selected="selected">Alabama</option>
              <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select> --}}
          </div>
          <div class="form-group">
            <label>Location</label>
            {{Form::text('lokasi','',['class'=>'form-control','placeholder'=>'Location','required'])}}
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Date range:</label>

            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {{-- <input type="text" class="form-control pull-right" id="reservation"> --}}
              {{Form::text('date_range','',['class'=>'form-control pull-right','id'=>'reservation'])}}
            </div>
          </div>
          <!-- /.form-group -->
          <!-- /.form-group -->
          <div class="form-group">
            <label>File Instagram:</label>
            {{Form::file('file')}}
          </div>
          <!-- /.form-group -->
          <div class="form-group col-md-6">
            {{Form::submit('Submit',['class'=>'btn btn-block btn-primary'])}}
          </div>
          <div class="form-group col-md-6">
            {{-- {{Form::cancel('Cancel' )}} --}}
            <button type="reset" class="btn btn-block btn-danger" id="coba">Cancel</button>
          </div>
        </div>
        {{Form::close()}}
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      {{-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
      the plugin. --}}
      All rights reserverd. <a href="http://www.ratisamedia.com">PT. Ratisa Media Citra</a>
    </div>
  </div>
  <!-- /.box -->


  <!-- /.row -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('layout.footer')
