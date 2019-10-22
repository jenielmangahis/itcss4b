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

                <div class="box box-primary">
                  <div id="" class="form-group">

                    <div class="row">
                      <div class="col-xs-12 calendar-events-header" style="padding-top: 10px;">
                        <div class="pull-left"><strong>FUNDING INFO</strong></div>
                        <div class="pull-right">         
                            <a href="javascript:location.reload();" class="btn btn-primary">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </div>
                      </div>
                    </div>

                    <br />
                    <div class="row">
                      <div class="col-xs-12">
                        <h4>MERCHANT BANK ACCOUNT</h4><hr />
                      </div> 
                    </div> 

                    <div class="row">
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label for="inputField">Routing Number</label>
                          <input type="text" class="form-control" id="routing_number" name="routing_number" value="{{ isset($funding_info->routing_number) ? $funding_info->routing_number : '' }}" placeholder="">
                        </div>                             
                      </div>
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label for="inputField">Account Number</label>
                          <input type="text" class="form-control" id="account_number" name="account_number" value="{{ isset($funding_info->account_number) ? $funding_info->account_number : '' }}" placeholder="">
                        </div>                             
                      </div>
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label for="inputField">Name of Account</label>
                          <input type="text" class="form-control" id="name_of_account" name="name_of_account" value="{{ isset($funding_info->name_of_account) ? $funding_info->name_of_account : '' }}" placeholder="">
                        </div>                             
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label for="input">Account Type</label>
                          <select name="account_type" id="account_type" class="form-control">
                            <?php 
                              $selected = '';
                              if(isset($funding_info->account_type)) {
                                $selected = $funding_info->account_type;
                              }
                            ?>
                            <option value="">Please select</option>
                            <option <?php echo $selected == 'Checking Account' ? 'selected="selected"' : ''; ?> value="Checking Account">Checking Account</option>
                            <option <?php echo $selected == 'Savings Account' ? 'selected="selected"' : ''; ?> value="Savings Account">Savings Account</option>
                            <option <?php echo $selected == 'Certificate of Deposit' ? 'selected="selected"' : ''; ?> value="Certificate of Deposit">Certificate of Deposit</option>
                            <option <?php echo $selected == 'Money Market Account' ? 'selected="selected"' : ''; ?> value="Money Market Account">Money Market Account</option>
                            <option <?php echo $selected == 'Individual Retirement Accounts (IRAs)' ? 'selected="selected"' : ''; ?> value="Individual Retirement Accounts (IRAs)">Individual Retirement Accounts (IRAs)</option>
                          </select>
                        </div>                             
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label for="input">ACH Gateway</label>
                          <?php 
                            $selected = '';
                            if(isset($funding_info->ach_gateway)) {
                              $selected = $funding_info->ach_gateway;
                            }
                          ?>                          
                          <select name="ach_gateway" id="ach_gateway" class="form-control">
                            <option value="">Please select</option>
                            <option <?php echo $selected == 'Other' ? 'selected="selected"' : ''; ?> value="Other">Other</option>
                          </select>
                        </div>                             
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-12">
                        <h4>FUNDING DETAILS</h4><hr />
                      </div> 
                    </div>  

                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label for="inputField">Contract Date</label>
                          <input type="text" class="form-control" id="contract_date" name="contract_date" value="{{ isset($funding_info->contract_date) ? $funding_info->contract_date : '' }}" placeholder="">
                        </div>                             
                      </div>   
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label for="inputField">Contract Number</label>
                          <input type="text" class="form-control" id="contract_number" name="contract_number" value="{{ isset($funding_info->contract_number) ? $funding_info->contract_number : '' }}" placeholder="">
                        </div>                             
                      </div>                    
                    </div>    

                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label for="inputField">Funding Date</label>
                          <input type="text" class="form-control" id="funding_date" name="funding_date" value="{{ isset($funding_info->funding_date) ? $funding_info->funding_date : '' }}" placeholder="">
                        </div>                             
                      </div>   
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label for="inputField">Wire/Conf Number</label>
                          <input type="text" class="form-control" id="wire_conf_number" name="wire_conf_number" value="{{ isset($funding_info->wire_conf_number) ? $funding_info->wire_conf_number : '' }}" placeholder="">
                        </div>                             
                      </div>                    
                    </div>               

                  </div>
                </div>

                {!! Form::close() !!}

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

    $('#contract_date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    }) 

    $('#funding_date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    })          

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

