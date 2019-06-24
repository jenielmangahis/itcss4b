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
      Contacts : Campaign
    </h1>
    
    <ol class="breadcrumb">
      <li><a href="{{route('contact')}}"><i class="fa fa-dashboard"></i> Contacts</a></li>
      <li class="active">Campaign</li>
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

        <div class="box box-primary">
          <div class="box-body btn-add-campaign">
            <div class="box-header ">
                <div class="pull-left">
                    <a href="javascript:unhide_add_campaign_form();" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Create New
                    </a>
                </div>
                </div>
          </div>

          <div class="box-body" id="add-new-container-form" style="display: none;">
            {{ Form::open(array('url' => 'contact_campaign/store', 'class' => '', 'id' => 'add-contact-campaign-form')) }}
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Campaign Title <span class="required">*</span></label>
                  <?php echo Form::text('title', old('title') ,['class' => 'form-control', 'required' => '']); ?>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Status <span class="required"></span></label>
                  <select name="status" class="form-control" id="status">
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                  </select>                    
                </div>  
              </div>              
            </div>   
            <!-- /.row --> 

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label><i class="fa fa-calendar"></i> Start Date <span class="required"></span></label>
                  <?php echo Form::text('start_date', old('start_date') ,['class' => 'form-control', 'id' => 'datepicker_start_date']); ?>                 
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label><i class="fa fa-calendar"></i> End Date <span class="required"></span></label>
                  <?php echo Form::text('end_date', old('end_date') ,['class' => 'form-control', 'id' => 'datepicker_end_date']); ?>
                </div>
              </div>              
            </div>   
            <!-- /.row -->            

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Source <span class="required"></span></label>
                  <select name="source_id" class="form-control" id="source_id">
                    <option value="0">-</option>
                    @foreach($sources as $source)
                      <option value="{{ $source->id }}">{{ $source->name }}</option>
                    @endforeach                    
                  </select>                    
                </div>   
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Media Type <span class="required"></span></label>
                  <select name="media_type_id" class="form-control" id="media_type_id">
                    <option value="0">-</option>
                    @foreach($media_types as $media_type)
                      <option value="{{ $media_type->id }}">{{ $media_type->name }}</option>
                    @endforeach
                  </select>                    
                </div>  
              </div>
            </div>         
            <!-- /.row --> 

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Campaign Cost <span class="required"></span></label>
                  <?php echo Form::number('campaign_cost', old('campaign_cost') ,['class' => 'form-control', 'step' => 'any']); ?>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Purchase Amount <span class="required"></span></label>
                  <?php echo Form::number('purchase_amount', old('purchase_amount') ,['class' => 'form-control', 'step' => 'any']); ?>
                </div>
              </div>              
            </div>   
            <!-- /.row -->              

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Priority <span class="required"></span></label>
                  <?php echo Form::number('priority', old('priority') ,['class' => 'form-control']); ?>                 
                </div>   
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  
                </div>
              </div>
            </div>        
            <!-- /.row -->    

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Add</button>
              <a class="btn btn-primary" href="javascript:hide_add_campaign_form();">Cancel</a>
            </div> 
            {!! Form::close() !!} 
          </div>

          <div class="box-body" id="edit-new-container-form" style="display: none;">
            {{ Form::open(array('url' => 'contact_campaign/update', 'class' => '', 'id' => 'edit-contact-campaign-form')) }}
            <div id="edit-campaign-container-fields"></div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Update</button>
              <a class="btn btn-primary" href="javascript:hide_edit_campaign_form();">Cancel</a>
            </div>
            {!! Form::close() !!} 
          </div>

        </div>  

        <div class="box box-primary">

          <div class="box-body">
            <div class="row">
              {{ Form::open(array('url' => 'contact_campaign', 'class' => '', 'method' => 'get')) }}

                <div class="col-xs-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Search By: </label><br />
                        <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
                          <option value="title" selected="selected">Title</option>
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
                        <a class="btn btn-success" href="{{route('contact_campaign')}}">Refresh</a>
                      </div>
                      <!-- /.form-group -->
                    </div>
                  </div>                

                </div>                      
              {!! Form::close() !!}         
            </div>  

            <table class="table table-bordered">
              <tr>
                <th>Status</th>
                <th>Created At</th>
                <th>Created By</th>
                <th>Title</th>
                <th>Source</th>
                <th>Cost</th>
                <th>Priority</th>
                <th>Media</th>
                <th>Purchase Amount</th>
                <th>Action</th>
              </tr>
              @foreach($campaigns as $camp)
                  <tr>
                      <?php $camp->status == 1 ? $status = 'Active' : $active = 'Inactive'; ?>
                      <td>{{ $status }}</td>
                      <td>{{ date("m/d/Y g:i a", strtotime($camp->created_at)) }}</td>
                      @if($camp->company_id > 0 )
                        <td>{{ $camp->company->name }}</td>
                      @else
                        <td>-</td>
                      @endif
                      <td>{{ $camp->title }}</td>
                      @if($camp->source_id > 0 )
                        <td>{{ $camp->source->name }}</td>
                      @else
                        <td>-</td>
                      @endif
                      <td>{{ number_format($camp->campaign_cost,2) }}</td>
                      <td>{{ $camp->priority }}</td>
                      @if($camp->media_type_id > 0 )
                        <td>{{ $camp->media_type->name }}</td>
                      @else
                        <td>-</td>
                      @endif
                      <td>{{ number_format($camp->purchase_amount,2) }}</td>
                      <td>
                          <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDelete-<?= $camp->id; ?>">
                              <i class="fa fa-trash"></i> Delete
                          </a>
                          <a href="javascript:show_edit_campaign_form('<?= Hashids::encode($camp->id); ?>');" class="btn btn-xs btn-primary">
                              <i class="fa fa-edit"></i> Edit
                          </a>                                                              
                      </td>
                  </tr>

                  <div id="modalDelete-<?= $camp->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete selected campaign?
                          </div>
                          <div class="modal-footer">
                            {{ Form::open(array('url' => 'contact_campaign/destroy')) }}
                              <?php echo Form::hidden('id', Hashids::encode($camp->id) ,[]); ?>
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

          <div style="text-align: center;" class="box-footer clearfix">
              {{ $campaigns->links() }}
          </div>          

        </div>    
        

    </section>
  <!-- /.content -->
@endsection

@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>'; 
  function unhide_add_campaign_form() {
    $("#add-new-container-form").show('250');
    $('.btn-add-campaign').hide();
  }
  function hide_add_campaign_form() {
    $("#add-new-container-form").hide('250');
    $('.btn-add-campaign').show();
  }

  function show_edit_campaign_form(id) {
    $("#edit-new-container-form").show('250');
    $('.btn-add-campaign').hide();

    $('#edit-campaign-container-fields').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
    
    var url = base_url + '/contact_campaign/ajax_load_edit_fields'
    $.ajax({
         type: "GET",
         url: url,               
         data: {"id":id}, 
         success: function(o)
         {
            $('#edit-campaign-container-fields').html(o);
         }
    });

  }

  function hide_edit_campaign_form() {
    $("#edit-new-container-form").hide('250');
    $('.btn-add-campaign').show();
  }

  $(function () {

    //Date picker
    $('#datepicker_start_date').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    })  

    $('#datepicker_end_date').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    })    

  });

 
</script>
@endsection


