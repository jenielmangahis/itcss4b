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
      Contacts : Datasource
    </h1>
    
    <ol class="breadcrumb">
      <li><a href="{{route('contact')}}"><i class="fa fa-dashboard"></i> Contacts</a></li>
      <li class="active">Data Source</li>
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

        {{ Form::open(array('url' => 'contact_datasource/store', 'class' => '', 'id' => 'add-contact-datasource-form')) }}
        <div class="box box-primary">

          <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-header with-border">
                      <div class="pull-left">
                          <a href="{{route('contact_datasource')}}" class="btn btn-primary">
                              <i class="fa fa-plus"></i> Create New
                          </a>
                      </div>                  
                      <div class="pull-left" style="margin-left: 5px;">
                        <select name="contact_source_list" id="contact_source_list" class="form-control select2" style="">
                          <option value="">-</option>
                          <optgroup label="Import">
                            @foreach($datasource_import as $imp)
                              <option value="{{ Hashids::encode($imp->id) }}">{{ $imp->source_name }}</option>
                            @endforeach
                          </optgroup>
                          <optgroup label="Webform">
                            @foreach($datasource_webform as $webf)
                              <option value="{{ Hashids::encode($webf->id) }}">{{ $webf->source_name }}</option>
                            @endforeach
                          </optgroup>
                        </select>                                
                      </div>
                  </div>
                </div>
              </div>
          </div>
          <!-- /.row -->          

          <div class="box-body">
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <label>Source Name <span class="required">*</span></label>
                  <?php echo Form::text('source_name', old('source_name') ,['class' => 'form-control', 'required' => '']); ?>
                </div>
              </div>
            </div>   
            <!-- /.row -->  

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Type <span class="required"></span></label>
                  <select name="type" class="form-control" id="type">
                    <option value="1">Import</option>
                    <option value="2">Webform</option>
                  </select>                    
                </div>   
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Campaign <span class="required"></span></label>
                  <select name="compaign_id" class="form-control" id="compaign_id">
                    <option value="1">Campaign 01</option>
                    <option value="2">Campaign 02</option>
                  </select>                    
                </div>  
              </div>
            </div>         
            <!-- /.row --> 

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Stage <span class="required"></span></label>
                  <select name="stage_id" class="form-control" id="stage_id">
                    @foreach($stages as $stage)
                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                    @endforeach
                  </select>                    
                </div>   
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <div id="stage-status-container"></div>
                </div>
              </div>
            </div>        
            <!-- /.row -->    

          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-success">Add</button>
            <a class="btn btn-primary" href="{{route('contact_datasource')}}">Cancel</a>
          </div> 

        </div>    
        {!! Form::close() !!}  

    </section>
  <!-- /.content -->
@endsection

@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>'; 

  function load_stage_status_dropdown() {
    var stage_id = $('#stage_id').val();
    $('#stage-status-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
    var url = base_url + '/contact_datasource/ajax_load_stage_status'
    $.ajax({
         type: "GET",
         url: url,               
         data: {"stage_id":stage_id}, 
         success: function(o)
         {
            $('#stage-status-container').html(o);
         }
    });
  }

  $(function () {

    load_stage_status_dropdown();
    $('#stage_id').change(function(){
      load_stage_status_dropdown();
    }); 

    $('#contact_source_list').change(function(){
      window.location = base_url + '/contact_datasource/edit/' + $('#contact_source_list').val(); // redirect
    });    

  });

</script>
@endsection


