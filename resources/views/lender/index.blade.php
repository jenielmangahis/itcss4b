@extends('layouts.backend.master')

@section('header-php')
  <?php
  $body_id = '';
  $body_class = '';
  ?>
@endsection 

@section('meta-dynamic')
  <title>coreCMS</title>  
  <meta name="description" content="-">    
@endsection

@section('main')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lenders Management
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

        <div class="row">
          <div class="col-xs-7">
            <div class="box box-danger">
              <div class="box-header with-border">
                test xxx
              </div>
            </div>
          </div>
          <div class="col-xs-5">
            <div class="box box-danger">
              <div class="box-header with-border">
                <canvas id="pieChart" style="height:250px"></canvas>
              </div>
            </div>
          </div>
        </div>          

        @if(Session::has('message'))
            <div class="alert {{ Session::get('alert_class') }}">
              <button type="button" class="close" data-dismiss="alert">&times</button>
              {{ Session::get('message') }}
            </div>
        @endif    

        @if ($errors->any())
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times</button>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div><!--/.alert.alert-danger-->
        @endif {{-- end of @if ($errors->any()) @if ($errors->any()) --}}         
        
        <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Lenders List</h3>
                    <div class="pull-right">
                        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddLender">
                            <i class="fa fa-plus"></i> Add Lender
                        </a>                           
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                  <div class="row">
                    {{ Form::open(array('url' => 'lender', 'class' => '', 'method' => 'get')) }}

                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Search By: </label><br />
                              <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
                                <option value="company_name" selected="selected">Company Name</option>
                                <option value="email" selected="selected">Email</option>
                              </select>
                              <input class="form-control" type="text" value="<?php echo $search_field; ?>" name="search_field" placeholder="Default Search" style="width: 70%; float: right;">
                            </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>&nbsp;</label><br />
                              <button type="submit" class="btn btn-primary">Filter</button>
                              <a class="btn btn-success" href="{{route('lender')}}">Refresh</a>
                            </div>
                            <!-- /.form-group -->
                          </div>
                        </div>                

                      </div>                      
                    {!! Form::close() !!}         
                  </div>

                  <!-- Table here-->
                  <table class="table table-bordered">
                    <tr>
                      <th >#</th>
                      <th>Company</th>
                      <th>Street</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Zip</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Url</th>
                      <th>ADV Count</th>
                      <th>Funded</th>
                      <th>Action</th>
                    </tr>
                    @foreach($lenders as $lender)
                        <tr>
                            <td>-</td>
                            <td>{{$lender->company_name}}</td>
                            <td>{{$lender->street}}</td>
                            <td>{{$lender->city}}</td>
                            <td>{{$lender->state}}</td>
                            <td>{{$lender->zip_code}}</td>
                            <td>{{$lender->phone}}</td>
                            <td>{{$lender->email}}</td>
                            <td>{{$lender->url_site}}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDelete-<?= $lender->id; ?>" >
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                <a href="{{route('contact/edit',[Hashids::encode($lender->id)])}}" class="btn btn-xs btn-primary">
                                    <i class="fa fa-edit"></i> Edit
                                </a>                                                           
                            </td>
                        </tr>

                        <div id="modalDelete-<?= $lender->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete selected lender?
                                </div>
                                <div class="modal-footer">
                                  {{ Form::open(array('url' => 'lender/destroy')) }}
                                    <?php echo Form::hidden('id', Hashids::encode($lender->id) ,[]); ?>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                  {!! Form::close() !!}
                                </div>

                              </div>
                            </div>
                        </div>   

                    @endforeach
                  </table>                  

                </div>
                <!-- /.box-body -->

                <div style="text-align: center;" class="box-footer clearfix">
                    {{ $lenders->links() }}
                </div>

              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>

  <div id="modalAddLender" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
      {{ Form::open(array('url' => 'lender/store', 'class' => '', 'id' => 'add-lender-form')) }}
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Add Lender</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="inputTitle">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="" required="">
              </div>
              <div class="form-group">
              <label><strong>Lender Address</strong></label>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="street" name="street" placeholder="Street" required="">
              </div>

              <div class="row">
                <div class="col-xs-4">
                  <div class="form-group">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City">
                  </div>                
                </div>
                <div class="col-xs-4">
                  <div class="form-group">
                    <input type="text" class="form-control" id="state" name="state" placeholder="State">
                  </div>                
                </div>
                <div class="col-xs-4">
                  <div class="form-group">
                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" required="">  
                  </div>                
                </div>
              </div>

              <div class="row">
                <div class="col-xs-4">
                  <div class="form-group">
                    <label for="inputPhone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="" required="">
                  </div>                
                </div>
                <div class="col-xs-4">
                  <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="" required="">
                  </div>                
                </div>
                <div class="col-xs-4">
                  <div class="form-group">
                    <label for="inputUrl">Url</label>
                    <input type="text" class="form-control" id="url_site" name="url_site" placeholder="">  
                  </div>                
                </div>
              </div>              

              <div class="form-group">
                <label for="inputDescription">Notes</label>
                <textarea rows="4" cols="50" class="form-control" id="notes" name="notes" required=""></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-default">Add</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>

          </div>
        </div>
      {!! Form::close() !!}        
  </div>

  <!-- /.content -->
@endsection

@section('page-footer-scripts')

<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : 700,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Chrome'
      },
      {
        value    : 500,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'IE'
      },
      {
        value    : 400,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'FireFox'
      },
      {
        value    : 600,
        color    : '#00c0ef',
        highlight: '#00c0ef',
        label    : 'Safari'
      },
      {
        value    : 300,
        color    : '#3c8dbc',
        highlight: '#3c8dbc',
        label    : 'Opera'
      },
      {
        value    : 100,
        color    : '#d2d6de',
        highlight: '#d2d6de',
        label    : 'Navigator'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)

  })  
</script>

@endsection

