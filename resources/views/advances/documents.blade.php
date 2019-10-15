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
      Edit Advance - {{ $contact->company->name }}
    </h1>
    
    <ol class="breadcrumb">
      <li><a href="{{route('contact')}}"><i class="fa fa-dashboard"></i> Contacts</a></li>
      <li class="active">Dashboard</li>
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif          
        
        <div class="box">

          <div class="box-header with-border">                
            <div class="pull-right">
              <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
            </div>              
          </div>               

          <div class="box-body">
            <div class="row">
              <section class="col-lg-3 connectedSortable ui-sortable">
                @include('advances.includes.side_menu')
              </section>

              <section class="col-lg-9 connectedSortable ui-sortable">
                <div class="">
                  <div class="row">
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3>0.00</h3>
                          <p>Balance</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3>0.00</h3>
                          <p>Payments Made</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>0.00</h3>
                          <p>Return</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>0.00</h3>
                          <p>Last Payment</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>0<sup style="font-size: 20px">%</sup></h3>
                          <p>Performance</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>

                {{ Form::open(array('url' => 'contact_advance/update_advance', 'class' => 'edit-advance-form-application', 'id' => 'edit-advance-form-application')) }}
                <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="{{ $contact->id }}">  

                @include('advances.includes.edit_advance_fields')

                {!! Form::close() !!}

                <div class="box box-primary">
                  <div id="" class="form-group">

                    <div class="row">
                      <div class="col-xs-12 calendar-events-header" style="padding-top: 10px;">
                        <div class="pull-left"><strong>DOCUMENTS</strong></div>
                        <div class="pull-right">
                            <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddDocs">
                                <i class="fa fa-plus"></i> Add Docs
                            </a>          
                            <a href="javascript:location.reload();" class="btn btn-primary">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <?php if( $group_id == 3 ){ ?>
                        {{ Form::open(array('url' => 'advance_documents/', 'class' => '', 'method' => 'get')) }}
                      <?php }else{ ?>
                        {{ Form::open(array('url' => 'advance_documents/'.$hash_id, 'class' => '', 'method' => 'get')) }}
                      <?php } ?>
                        <div class="col-xs-12">
                          <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Search By: </label><br />
                                <select name="search_by_documents" class="form-control select2" style="width: 30%; float: left;">
                                  <option value="document_title" selected="selected">Document Title</option>              
                                </select>            
                                <input class="form-control" type="text" value="<?php //echo $search_field_documents; ?>" name="search_field_documents" placeholder="Default Search" style="width: 70%; float: right;">
                              </div>
                              <!-- /.form-group -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>&nbsp;</label><br />
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <?php if( $group_id == 3 ){ ?>
                                  <a class="btn btn-success" href="{{url('dashboard')}}">Refresh</a>
                                <?php }else{ ?>
                                  <a class="btn btn-success" href="{{url('advance_documents/'.$hash_id)}}">Refresh</a>
                                <?php } ?>            
                              </div>
                              <!-- /.form-group -->
                            </div>
                          </div>                

                        </div>                      
                      {!! Form::close() !!}         
                    </div>

                    <table class="table table-bordered table-hover">
                      <tr>    
                        <th>Document Title</th>
                        <th>Date Created</th>
                        <th>Created By</th>
                        <th style="width:10%;">Action</th>
                      </tr>
                        @foreach($contactDocs as $doc)
                        <tr>
                          <td>{{ $doc->document_title }}</td>
                          <td>{{ $doc->created_at }}</td>
                          @if(isset($doc->user->firstname) && isset($doc->user->lastname))
                            <td>{{ $doc->user->firstname }} {{ $doc->user->lastname }}</td>
                          @else
                            <td>-</td>
                          @endif
                          <td>  
                            <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalViewDoc-<?php echo $doc->id; ?>">
                                <i class="fa fa-search-plus"></i>
                            </a>
                            <a href="{{ URL::asset('uploads/contact_docs/' . $doc->filename) }}" class="btn btn-xs btn-primary" id="">
                                <i class="fa fa-download"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalDeleteDoc-<?php echo $doc->id; ?>">
                                <i class="fa fa-trash"></i>
                            </a> 

                            <div id="modalViewDoc-<?php echo $doc->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                              <div class="modal-dialog modal-lg" style="width: 400px !important;">
                                <div class="modal-content">

                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">View Doc</h4>
                                    </div>

                                    <div class="modal-body">
                                      <table class="table table-bordered">
                                        <tr>
                                          <td>Document Title</td>
                                          <td>: <b>{{ $doc->document_title }}</b></td>
                                        </tr>                    
                                        <tr>
                                          <td>Document Type</td>
                                          <td>: <?= $documentTypes[$doc->document_type]; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Description</td>
                                          <td>: {{ $doc->description }}</td>
                                        </tr>
                                      </table> 
                                    </div>

                                    <div class="modal-footer"> 
                                      <a href="{{ URL::asset('uploads/contact_docs/' . $doc->filename) }}" class="btn btn-primary" id="">
                                          <i class="fa fa-download"></i> Download
                                      </a>                 
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>

                                </div>            
                              </div>
                            </div>

                            <div id="modalDeleteDoc-<?= $doc->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">

                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                  </div>
                                  <div class="modal-body">
                                    Are you sure you want to delete selected document?
                                  </div>
                                  <div class="modal-footer">
                                    {{ Form::open(array('url' => 'contact_docs/destroy')) }}
                                      <?php echo Form::hidden('id', Hashids::encode($doc->id) ,[]); ?>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                      <button type="submit" class="btn btn-danger">Yes</button>
                                    {!! Form::close() !!}
                                  </div>

                                </div>
                              </div>
                          </div>  

                          </td>
                        </tr> 
                        @endforeach 

                    </table>

                    <div style="text-align: center;" class="box-footer clearfix">
                        {{ $contactDocs->links() }}
                    </div>                    


                    <div id="modalAddDocs" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                        {{ Form::open(array('url' => 'contact_docs/store', 'class' => '', 'id' => 'add-call-log-form', 'enctype' => 'multipart/form-data')) }}
                          <input type="hidden" id="" name="contact_id" value="<?php echo Hashids::encode($contact->id); ?>">
                          <div class="modal-dialog modal-lg" style="width: 800px !important;">
                            <div class="modal-content">

                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Add Docs</h4>
                              </div>
                              <div class="modal-body">

                                <div class="row">
                                  <div class="col-xs-4">
                                    <div class="form-group">
                                      <label for="inputTime">Filename</label>
                                      <input type="file" class="form-control" id="filename" name="filename" placeholder="Click to Select File" required="">
                                    </div>                
                                  </div>
                                  <div class="col-xs-3">
                                    <div class="form-group">
                                      <label for="inputCallType">Document Type</label>
                                      <select name="document_type" id="document_type" class="form-control">
                                        <?php foreach($documentTypes as $key => $value){ ?>
                                          <option value="<?= $key; ?>"><?= $value; ?></option>
                                        <?php } ?>
                                      </select>  
                                    </div>                
                                  </div>
                                  <div class="col-xs-5">
                                    <div class="form-group">
                                      <label for="inputTime">Description</label>
                                      <input type="text" class="form-control" name="description" required="">
                                    </div>                
                                  </div>           

                                </div>

                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Upload</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        {!! Form::close() !!}        
                    </div>

                  </div>
                </div>

                <div class="pull-right">
                  <button type="button" id="btn-update-advance-in-document-form" class="btn btn-primary btn-update-advance-in-document-form">Update</button>
                </div>     
                              
              </section>
            </div>
          </div>

        </div>   

    </section>
  <!-- /.content -->
@endsection

@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>';

  $(function () {

    $( "#btn-update-advance-in-document-form" ).click(function() {
      $( "#edit-advance-form-application" ).submit();
    });    

    $( "#advance_amount" ).change(function() {
      compute_payback_payment();
    });

    $( "#remit" ).change(function() {
      compute_payback_payment();
    });

    $( "#payment_period" ).change(function() {
      compute_payback_payment();
    });

    $('#factor_rate').on('input',function(e){
      compute_payback_payment();
    });        

  });

  function compute_payback_payment() {
    $.get(base_url + '/contact_advance/ajax_load_payback_payment_computation_edit', $('#edit-advance-form-application').serialize(), function (o) {
      $('#payback-payment-container-edit').html('<br><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br>');

      setTimeout(function () {
        $('#payback-payment-container-edit').html(o);
      }, 250);
    });    
  } 
 
</script>

@endsection

