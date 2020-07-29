@extends('layouts.backend.master')

@section('header-php')
  <?php
  $body_id = '';
  $body_class = '';
  ?>
@endsection 

@section('meta-dynamic')
  <title>{{ config('app.name') }}</title>  
  <meta name="description" content="-">    
@endsection

@section('main')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Company/Merchants
    </h1>
    
    <!-- 
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol> 
    -->

  </section>

  <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->

        @if(Session::has('message'))
            <div class="alert {{ Session::get('alert_class') }}">
              <button type="button" class="close" data-dismiss="alert">&times</button>
              {{ Session::get('message') }}
            </div>
        @endif    
        
        <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- <div class="box-header with-border">
                    <h3 class="box-title">Users Log List</h3>
                    <div class="pull-right">
                        <a href="" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create New
                        </a>
                    </div>
                </div> -->
                <!-- /.box-header -->

                <div class="box-body">

                  <div class="row">
                    {{ Form::open(array('url' => 'report_merchants', 'class' => '', 'method' => 'get')) }}

                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Search By: </label><br />
                              <select name="search_by" class="form-control select2 search_by" id="search_by" style="width: 30%; float: left;">
                                <option value="name">Name</option>
                              </select>
                              <div id="search_field_container"><input class="form-control search_field" type="text" value="<?php echo $search_field; ?>" name="search_field" placeholder="Default Search" style="width: 70%; float: right;"></div>
                              <div style="display: none;" id="search_field_by_date_container"><input class="form-control login_date_search" disabled="disabled" type="text" id="login_date_search" value="<?php echo $search_field; ?>" name="search_field" placeholder="Search by Date" style="width: 70%; float: right;"></div>
                            </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>&nbsp;</label><br />
                              <button type="submit" class="btn btn-primary">Filter</button>
                              <a class="btn btn-success" href="{{route('report_merchants')}}">Refresh</a>
                            </div>
                            <!-- /.form-group -->
                          </div>
                    {!! Form::close() !!}    

                    {{ Form::open(array('url' => 'export_merchants', 'class' => '', 'method' => 'get')) }}
                          <input type="hidden" name="_search_by" value="{{ $search_by }}">
                          <input type="hidden" name="_search_field" value="{{ $search_field }}">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>&nbsp;</label><br />
                              <button style="float: right;" type="submit" class="btn btn-default">Export to Excel</button>
                            </div>                            
                          </div>
                    {!! Form::close() !!}    

                        </div>                

                      </div>                      
                         
                  </div>

                  <table class="table table-bordered table-hover">
                    <tr>
                      <th style="width: 1%;" >#</th>
                      <th>Company Name</th>
                      <th>Contact Name</th>
                      <th>Email</th>
                      <th>Contact Number</th>
                    </tr>
                    @foreach($merchants_log as $merchant_log)
                        <tr>
                            <td>{{ $merchant_log->id }}</td>
                            <td>{{ $merchant_log->name }}</td>
                            <td>{{ $merchant_log->firstname }} {{ $merchant_log->lastname }}</td>
                            <td>{{ $merchant_log->email }}</td>
                            <td>{{ $merchant_log->contact_number }}</td>
                        </tr>
                    @endforeach
                  </table>

                </div>
                <!-- /.box-body -->

                <div style="text-align: center;" class="box-footer clearfix">
                    {{ $merchants_log->appends(request()->except('page'))->links() }}
                </div>

              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
  <!-- /.content -->
@endsection

@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>';

  $(function () {
    

    $('.login_date_search').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    });

    $(".search_by").change(function(){
      if ($('#search_by').val() == "login_date"){
        $('.login_date_search').removeAttr("disabled")
        $(".search_field").attr("disabled", true);
        $("#search_field_container").hide();
        $("#search_field_by_date_container").show();
      } else {
        $(".login_date_search").attr("disabled", true);
        $('.search_field').removeAttr("disabled")
        $("#search_field_container").show();
        $("#search_field_by_date_container").hide();
      }
    });
  });

</script>
@endsection
