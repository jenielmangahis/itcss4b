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

                {{ Form::open(array('url' => 'contact_advance/update_application', 'class' => 'edit-advance-form-application', 'id' => 'edit-advance-form-application')) }}
                <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="{{ $contact->id }}">                
                <div class="box box-primary">
                  <div class="row">
                    <div class="col-xs-3">
                      <div class="form-group">
                        <label for="inputLabel">Sales</label>
                        <select name="sales_user_id" id="sales_user_id" class="form-control">
                          <option value="0">Please select user</option>
                          @if(!$company_user->isEmpty())
                            @foreach($company_user as $cuser)
                              <option <?php echo $advance->sales_user_id == $cuser->user->id ? "selected" : ""; ?> value="{{ $cuser->user->id }}">{{ $cuser->user->firstname }} {{ $cuser->user->lastname }}</option>
                            @endforeach
                          @endif
                        </select>  
                      </div>                
                    </div>
                    <div class="col-xs-3">
                      <div class="form-group">
                        <label for="inputLabel">Lender</label>
                        <select name="lender_id" id="lender_id" class="form-control">
                          <option value="0">Please select lender</option>
                          @if(!$lenders->isEmpty())
                            @foreach($lenders as $lender)
                              <option <?php echo $advance->lender_id == $lender->id ? "selected" : ""; ?> value="{{ $lender->id }}">{{ $lender->company_name }}</option>
                            @endforeach
                          @endif
                        </select>  
                      </div>                
                    </div>
                    <div class="col-xs-3">
                      <div class="form-group">
                        <label for="inputLabel">Under Writer</label>
                        <select name="under_writer_user_id" id="under_writer_user_id" class="form-control">
                          <option value="0">Please select user</option>
                          @if(!$company_user->isEmpty())
                            @foreach($company_user as $cuser)
                              <option <?php echo $advance->under_writer_user_id == $cuser->user->id ? "selected" : ""; ?> value="{{ $cuser->user->id }}">{{ $cuser->user->firstname }} {{ $cuser->user->lastname }}</option>
                            @endforeach
                          @endif
                        </select>  
                      </div>                
                    </div>
                    <div class="col-xs-3">
                      <div class="form-group">
                        <label for="inputLabel">Closer</label>
                        <select name="closer_user_id" id="closer_user_id" class="form-control">
                          <option value="0">Please select user</option>
                          @if(!$company_user->isEmpty())
                            @foreach($company_user as $cuser)
                              <option <?php echo $advance->closer_user_id == $cuser->user->id ? "selected" : ""; ?> value="{{ $cuser->user->id }}">{{ $cuser->user->firstname }} {{ $cuser->user->lastname }}</option>
                            @endforeach
                          @endif
                        </select>  
                      </div>                
                    </div>
                  </div>
                </div>

                <div class="box box-primary">
                  <div class="row">
                    <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label for="inputAdvanceType">Advance Type</label>
                        <select name="advance_type" id="advance_type" class="form-control">
                          <option <?php echo $advance->advance_type == 'new' ? 'selected="selected"' : ''; ?> value="new">New</option>
                          <option <?php echo $advance->advance_type == 'add-on' ? 'selected="selected"' : ''; ?> value="add-on">Add-on</option>
                          <option <?php echo $advance->advance_type == 'renewal' ? 'selected="selected"' : ''; ?> value="renewal">Renewal</option>
                        </select>  
                      </div>                
                    </div>

                    <div class="col-xs-6">
                      <div class="form-group">
                        <label for="inputPaymentMethod">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                          <option <?php echo $advance->payment_method == 'ach' ? 'selected="selected"' : ''; ?> value="ach">Ach</option>
                          <option <?php echo $advance->payment_method == 'cc' ? 'selected="selected"' : ''; ?> value="cc">Cc</option>
                        </select>                   
                      </div>                
                    </div>           

                  </div>  

                  <div class="form-group">
                    <label for="inputAdvanceAmount">Advance Amount</label>
                    <input type="number" step="0.01" class="form-control" id="advance_amount" name="advance_amount" value="{{$advance->amount}}" placeholder="Enter Amount" required="">
                  </div>                   

                  <div class="row">
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label for="inputPaymentPeriod">Payment Period</label>
                        <input type="number" class="form-control" id="payment_period" name="payment_period" value="{{$advance->period}}" placeholder="" required="">
                      </div>                
                    </div>
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label for="input">&nbsp</label>
                        <select name="payment_period_type" id="payment_period_type" class="form-control">
                          <option <?php echo $advance->period_type == 'days' ? 'selected="selected"' : ''; ?> value="days">Days</option>
                          <option <?php echo $advance->period_type == 'weeks' ? 'selected="selected"' : ''; ?> value="weeks">Weeks</option>
                          <option <?php echo $advance->period_type == 'month' ? 'selected="selected"' : ''; ?> value="month">Month</option>
                        </select>                    
                      </div>                
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-6">
                      <label for="inputPaymentPeriod">Remit</label>
                      <input type="number" step="0.01" class="form-control" id="remit" name="remit" value="{{$advance->remit}}" placeholder="%" required="">
                    </div>
                    <div class="col-xs-6">
                      <label for="inputPaymentPeriod">Factor Rate</label>
                      <input type="number" step="0.01" class="form-control" id="factor_rate" name="factor_rate" value="{{$advance->factor_rate}}" placeholder="%" required="">
                    </div>
                  </div>     

                  <br />
                  <div style="float: right;"><a onclick="javascript:compute_payback_payment();" href="javascript:void(0);">Compute</a></div>
                  <div id="payback-payment-container-edit" class="payback-payment-container-edit">
                    <div class="form-group">
                      <label for="inputAdvanceAmount">Payback Amount</label>
                      <input type="text" class="form-control" id="payback_amount" name="payback_amount" value="{{$advance->payback}}" placeholder="" disabled="disabled">
                    </div> 

                    <div class="form-group">
                      <label for="inputAdvanceAmount">Payment</label>
                      <input type="text" class="form-control" id="payment" name="payment" value="{{$advance->payment}}" placeholder="" disabled="disabled">
                    </div>                                
                  </div>
                  <br />
               
                </div>

                <div class="box box-primary">
                  <div id="" class="form-group">
                    <div class="box-body">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_variation_0" data-toggle="tab"><strong>Contact Information</strong></a></li>
                          <li class=""><a href="#tab_variation_1" data-toggle="tab"><strong>Business Information</strong></a></li>
                          <li class=""><a href="#tab_variation_2" data-toggle="tab"><strong>Loan Information</strong></a></li>
                          <li class=""><a href="#tab_variation_3" data-toggle="tab"><strong>Broker Information</strong></a></li>
                        </ul>

                        <div class="tab-content">
                          <div class="active tab-pane" id="tab_variation_0">
                            @include('advances.includes.edit_personal_info')
                          </div>
                          <div class="tab-pane" id="tab_variation_1">
                            @include('advances.includes.edit_business_info')
                          </div>
                          <div class="tab-pane" id="tab_variation_2">
                            @include('advances.includes.edit_loan_info')
                          </div>
                          <div class="tab-pane" id="tab_variation_3">
                            @include('advances.includes.edit_broker_info')
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>     
                {!! Form::close() !!}              
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

    load_company_users_dropdown(); 
    load_stage_status_dropdown();

    $('#company_id').change(function () {

      var company_id = $('#company_id').val();
      var c_user_id  = $('#c_user_id').val();
      $('#company-users-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
      var url = base_url + '/contact/ajax_load_company_users'
      $.ajax({
           type: "GET",
           url: url,               
           data: {
              "company_id":company_id,
              'c_user_id':c_user_id
              }, 
           success: function(o)
           {
              $('#company-users-container').html(o);
           }
      });   

    }); 

    $('#stage_id').change(function(){
      load_stage_status_dropdown();
    });  

    $('.bankruptcy_filed').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    })           

  });

  function compute_payback_payment() {
    $.get(base_url + '/contact_advance/ajax_load_payback_payment_computation_edit', $('#edit-advance-form-application').serialize(), function (o) {
      $('#payback-payment-container-edit').html('<br><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br>');

      setTimeout(function () {
        $('#payback-payment-container-edit').html(o);
      }, 250);
    });    
  }

  function load_company_users_dropdown() {

      var company_id = $('#company_id').val();
      var c_user_id  = $('#c_user_id').val();
      $('#company-users-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
      var url = base_url + '/contact/ajax_load_company_users'
      $.ajax({
           type: "GET",
           url: url,               
           data: {
              "company_id":company_id,
              'c_user_id':c_user_id
              }, 
           success: function(o)
           {
              $('#company-users-container').html(o);
           }
      });          
  }  

  function load_stage_status_dropdown() {
    var stage_id = $('#stage_id').val();
    var status = "<?php echo $contact->status; ?>";
    $('#stage-status-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
    var url = base_url + '/contact/ajax_load_stage_status'
    $.ajax({
         type: "GET",
         url: url,               
         data: {"stage_id":stage_id,"status":status}, 
         success: function(o)
         {
            $('#stage-status-container').html(o);
         }
    });
  }  
 
</script>

@endsection

