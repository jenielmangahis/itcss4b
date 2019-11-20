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

                @include('advances.includes.summary_block')

                {{ Form::open(array('url' => 'contact_advance/update_funding_info', 'class' => 'edit-advance-form-application', 'id' => 'edit-advance-form-application')) }}
                <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="{{ $contact->id }}">                
                
                @include('advances.includes.edit_advance_fields')

                {!! Form::close() !!}

                <div class="box box-primary">
                  <div id="" class="form-group">

                    <div class="row">
                      <div class="col-xs-12 calendar-events-header" style="padding-top: 10px;">
                        <div class="pull-left"><strong>PARTICIPATION</strong></div>
                        <div class="pull-right">  
                            <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddParticipation">
                                <i class="fa fa-plus"></i> Participation
                            </a>                                 
                            <a href="javascript:location.reload();" class="btn btn-primary">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </div>
                      </div>
                    </div> 
                    <br />

                    <div class="row">

                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Syndication</label>
                        </div>
                      </div>

                      <div class="col-xs-6">
                        <div class="form-group" style="text-align: right; margin-right: 10px;">
                          <label>{{ number_format($advance->amount,2) }}</label>
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <table class="table table-bordered table-hover">
                        <tr>    
                          <th>Syndicate Lender</th>
                          <th>Loan Amount</th>
                          <th>Loan %</th>
                          <th>Fee Amount</th>
                          <th>Fee %</th>
                          <th>Type</th>
                          <th style="width:10%;">Action</th>
                        </tr>
                        @foreach($participations as $participation)
                          <tr>    
                            <td>{{ $participation->lender->company_name }}</td>
                            <td>{{ number_format($participation->loan_amount,2) }}</td>
                            <td>{{ $participation->loan_amount_percent }}</td>
                            <td>{{ number_format($participation->fee_amount,2) }}</td>
                            <td>{{ $participation->fee_percent }}</td>
                            <td>{{ $participation->type }}</td>
                            <td>
                              
                              <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalEditParticipation-<?php echo $participation->id; ?>">
                                <i class="fa fa-edit"></i>
                              </a>

                              <a href="javascript:void(0);" class="btn btn-xs btn-danger" id="" data-toggle="modal" data-target="#modalDeleteParticipation-<?php echo $participation->id; ?>">
                                  <i class="fa fa-trash"></i>
                              </a>  

                              <div id="modalEditParticipation-<?php echo $participation->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                                {{ Form::open(array('url' => 'contact_advance/update_participation', 'class' => 'participation-form-edit-' . $participation->id, 'id' => 'participation-form-edit', 'enctype' => 'multipart/form-data')) }}
                                  <input type="hidden" id="" name="contact_id" value="<?php echo Hashids::encode($contact->id); ?>">
                                  <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                                  <input type="hidden" id="advance_amount" name="advance_amount" value="<?php echo $advance->amount; ?>">
                                  <input type="hidden" name="participation_id" id="participation_id" class="participation_id" value="{{ Hashids::encode($participation->id) }}">
                                  <div class="modal-dialog modal-lg" style="width: 600px !important;">
                                    <div class="modal-content">

                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Add Participation</h4>
                                      </div>
                                      <div class="modal-body">

                                       <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Syndicate Lender</label>
                                              <select name="lender_id" id="lender_id" class="form-control">
                                                @foreach($lenders as $lender)
                                                  <option <?php echo $participation->lender_id == $lender->id ? 'selected="selected"' : ''; ?> value="{{ $lender->id }}">{{$lender->company_name}}</option>
                                                @endforeach
                                              </select>   
                                            </div>                
                                          </div>      
                                        </div> 

                                        <div class="participation-loan-amoun-container-edit" id="participation-loan-amoun-container-edit-<?php echo $participation->id; ?>">
                                          <div class="row">
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label for="inputField">Loan Amount </label>
                                                <input type="number" step="0.01" class="form-control" id="loan_amount" name="loan_amount" value="{{ $participation->loan_amount }}" required placeholder=""> 
                                              </div>                
                                            </div>      
                                          </div>                                            
                                        </div>

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Loan % <a href="javascript:void(0);" onclick="javascript:compute_participation_loan_amount_edit(<?php echo $participation->id; ?>);">Compute Loan Amount</a></label>
                                              <input type="number" step="0.01" class="form-control loan_amount_percent_edit-<?php echo $participation->id; ?>" id="loan_amount_percent" name="loan_amount_percent" value="{{ $participation->loan_amount_percent }}" required placeholder=""> 
                                            </div>                
                                          </div>      
                                        </div>   

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Fee Amount</label>
                                              <input type="number" step="0.01" class="form-control" id="fee_amount" name="fee_amount" value="{{ $participation->fee_amount }}" required placeholder=""> 
                                            </div>                
                                          </div>      
                                        </div>  

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Fee Amount %</label>
                                              <input type="number" step="0.01" class="form-control" id="fee_percent" name="fee_percent" value="{{ $participation->fee_percent }}" required placeholder=""> 
                                            </div>                
                                          </div>      
                                        </div>                       

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Type</label>
                                              <select name="type" id="type" class="form-control">
                                                <option <?php echo $participation->type == 'advance' ? 'selected="selected"' : ''; ?> value="advance">Advance</option>
                                                <option <?php echo $participation->type == 'payback' ? 'selected="selected"' : ''; ?> value="payback">Payback</option>
                                                <option <?php echo $participation->type == 'per_payment' ? 'selected="selected"' : ''; ?> value="per_payment">Per Payment</option>
                                              </select>   
                                            </div>                
                                          </div>      
                                        </div>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-default">Update</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>

                                    </div>
                                  </div>
                                {!! Form::close() !!}                                       
                              </div>  

                              <div id="modalDeleteParticipation-<?php echo $participation->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                      Are you sure you want to delete selected participation?
                                    </div>
                                    <div class="modal-footer">
                                      {{ Form::open(array('url' => 'contact_advance/destroy_participation')) }}
                                        <?php echo Form::hidden('id', Hashids::encode($participation->id) ,[]); ?>
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
                    </div>

                    <div id="modalAddParticipation" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                        {{ Form::open(array('url' => 'contact_advance/store_participation', 'class' => 'participation-form', 'id' => 'add-participation-form', 'enctype' => 'multipart/form-data')) }}
                          <input type="hidden" id="" name="contact_id" value="<?php echo Hashids::encode($contact->id); ?>">
                          <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                          <input type="hidden" id="advance_amount" name="advance_amount" value="<?php echo $advance->amount; ?>">
                          <div class="modal-dialog modal-lg" style="width: 600px !important;">
                            <div class="modal-content">

                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Add Participation</h4>
                              </div>
                              <div class="modal-body">

                               <div class="row">
                                  <div class="col-xs-12">
                                    <div class="form-group">
                                      <label for="inputField">Syndicate Lender</label>
                                      <select name="lender_id" id="lender_id" class="form-control">
                                        @foreach($lenders as $lender)
                                          <option value="{{ $lender->id }}">{{$lender->company_name}}</option>
                                        @endforeach
                                      </select>   
                                    </div>                
                                  </div>      
                                </div> 

                                <div class="participation-loan-amoun-container" id="participation-loan-amoun-container">
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <div class="form-group">
                                        <label for="inputField">Loan Amount</label>
                                        <input type="number" disabled="" step="0.01" class="form-control" id="loan_amount" name="loan_amount" value="" required placeholder=""> 
                                      </div>                
                                    </div>      
                                  </div>   
                                </div>

                                <div class="row">
                                  <div class="col-xs-12">
                                    <div class="form-group">
                                      <label for="inputField">Loan %</label>
                                      <input type="number" step="0.01" class="form-control loan_amount_percent" id="loan_amount_percent" name="loan_amount_percent" value="" required placeholder=""> 
                                    </div>                
                                  </div>      
                                </div>   

                                <div class="row">
                                  <div class="col-xs-12">
                                    <div class="form-group">
                                      <label for="inputField">Fee Amount</label>
                                      <input type="number" step="0.01" class="form-control" id="fee_amount" name="fee_amount" value="" required placeholder=""> 
                                    </div>                
                                  </div>      
                                </div>  

                                <div class="row">
                                  <div class="col-xs-12">
                                    <div class="form-group">
                                      <label for="inputField">Fee Amount %</label>
                                      <input type="number" step="0.01" class="form-control" id="fee_percent" name="fee_percent" value="" required placeholder=""> 
                                    </div>                
                                  </div>      
                                </div>                       

                                <div class="row">
                                  <div class="col-xs-12">
                                    <div class="form-group">
                                      <label for="inputField">Type</label>
                                      <select name="type" id="type" class="form-control">
                                        <option value="advance">Advance</option>
                                        <option value="payback">Payback</option>
                                        <option value="per_payment">Per Payment</option>
                                      </select>   
                                    </div>                
                                  </div>      
                                </div>

                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Add</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        {!! Form::close() !!}        
                    </div>                      

                  </div>
                </div>

                <div class="pull-right">
                  <button type="button" id="btn-update-advance-in-underwriter-notes-form" class="btn btn-primary btn-update-advance-in-underwriter-notes-form">Update</button>
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
         
    $( "#btn-update-advance-in-underwriter-notes-form" ).click(function() {
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

    $('.loan_amount_percent').on('input',function(e){
      compute_participation_loan_amount();
    });   
            
    $('.loan_amount_percent_edit-<?php echo $participation->id; ?>').on('input',function(e){
      compute_participation_loan_amount_edit(<?php echo $participation->id; ?>);
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

  function compute_participation_loan_amount() {
    $.get(base_url + '/contact_advance/ajax_load_participation_loan_amount', $('.participation-form').serialize(), function (o) {
      $('#participation-loan-amoun-container').html('<br><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br>');

      setTimeout(function () {
        $('#participation-loan-amoun-container').html(o);
      }, 250);
    });    
  }  

  function compute_participation_loan_amount_edit(id) {
    $.get(base_url + '/contact_advance/ajax_load_participation_loan_amount', $('.participation-form-edit-' + id).serialize(), function (o) {
      $('#participation-loan-amoun-container-edit-' + id).html('<br><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br>');

      setTimeout(function () {
        $('#participation-loan-amoun-container-edit-' + id).html(o);
      }, 250);
    });    
  }
 
</script>

@endsection

