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
      Contacts Management
    </h1>
    
    <ol class="breadcrumb">
      <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Contacts</a></li>
      <!-- <li class="active">Here</li> -->
    </ol> 

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
                <div class="box-header with-border">
                    <div class="pull-left">
                        <a href="{{route('contact/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create New
                        </a>
                    </div>                  
                    <div class="pull-left" style="margin-left: 5px;">
                      <a href="{{route('contact_datasource')}}" class="btn">
                          <i class="fa fa-database"></i> Data Source
                      </a>          
                    </div>
                    <div class="pull-left" style="margin-left: 5px;">
                      <a href="{{route('contact_campaign')}}" class="btn">
                          <i class="fa fa-database"></i> Campaigns
                      </a>          
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                  <div class="row">
                    {{ Form::open(array('url' => 'contact', 'class' => '', 'method' => 'get')) }}

                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Search By: </label><br />
                              <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
                                <option value="name" selected="selected">Name</option>
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
                              <a class="btn btn-success" href="{{route('contact')}}">Refresh</a>
                            </div>
                            <!-- /.form-group -->
                          </div>
                        </div>                

                      </div>                      
                    {!! Form::close() !!}         
                  </div>

                  <table class="table table-bordered">
                    <tr>
                      <th >#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <!-- <th>Work Number</th> -->
                      <!-- <th>Home Number</th> -->
                      <th>Stage</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    @foreach($contact as $con)
                        <?php 
                          $workflow_status = App\Workflow::where('id', '=', $con->status)->first();
                        ?>
                        <tr>
                            <td>{{ $con->id }}</td>
                            <td>{{ $con->firstname }} {{$con->lastname }}</td>
                            <td>{{ $con->email }}</td>
                            <td>{{ $con->mobile_number }}</td>
                            <!-- <td>{{ $con->work_number }}</td> -->
                            <!-- <td>{{ $con->home_number }}</td> -->
                            <td>{{  !empty($con->stage->name) ? $con->stage->name : '-' }}</td>
                            <td>{{ !empty($workflow_status->status) ? $workflow_status->status : '-' }}</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDelete-<?= $con->id; ?>">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                <a href="{{route('contact/edit',[Hashids::encode($con->id)])}}" class="btn btn-xs btn-primary">
                                    <i class="fa fa-edit"></i> Edit
                                </a> 
                                <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="javascript:load_update_status_field('<?php echo $con->id; ?>')" id="edit-modal-status-<?php echo $con->id; ?>" data-toggle="modal" data-target="#modalEdit">
                                    <i class="fa fa-edit"></i> Status
                                </a>                                                            
                            </td>
                        </tr>

                        <div id="modalDelete-<?= $con->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete selected contact?
                                </div>
                                <div class="modal-footer">
                                  {{ Form::open(array('url' => 'contact/destroy')) }}
                                    <?php echo Form::hidden('id', Hashids::encode($con->id) ,[]); ?>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                  {!! Form::close() !!}
                                </div>

                              </div>
                            </div>
                        </div>   

                    @endforeach
                  </table>

                  <div id="modalEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                      {{ Form::open(array('url' => 'contact/update_status', 'class' => '', 'id' => 'edit-contact-status-form')) }}
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel">Edit Status</h4>
                            </div>
                            <div class="modal-body">
                              <div id="stage-status-container"></div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-default">Update</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>

                          </div>
                        </div>
                      {!! Form::close() !!}        
                  </div>

                </div>
                <!-- /.box-body -->

                <div style="text-align: center;" class="box-footer clearfix">
                    {{ $contact->links() }}
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

  function load_update_status_field(id) {
    $('#stage-status-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
    var url = base_url + '/contact/ajax_load_update_status'
    $.ajax({
         type: "GET",
         url: url,               
         data: {"id":id}, 
         success: function(o)
         {
            $('#stage-status-container').html(o);
         }
    });
  }  

  $(function () { 
  });
  
</script>
@endsection