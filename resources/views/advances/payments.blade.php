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

                {{ Form::open(array('url' => 'contact_advance/update_advance', 'class' => 'edit-advance-form-application', 'id' => 'edit-advance-form-application')) }}
                <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="{{ $contact->id }}">                
                
                @include('advances.includes.edit_advance_fields')

                {!! Form::close() !!}

                <div class="box box-primary">
                  <div id="" class="form-group">

                    <div class="row">
                      <div class="col-xs-12 calendar-events-header" style="padding-top: 10px;">
                        <div class="pull-left"><strong>PAYMENTS</strong></div>
                        <div class="pull-right">      
                            <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddPayment">
                                <i class="fa fa-plus"></i> Add Payment
                            </a>                             
                            <a href="javascript:location.reload();" class="btn btn-primary">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </div>
                      </div>
                    </div>   

                    <div class="row">

                      {{ Form::open(array('url' => 'advance_payments/'.$hash_id, 'class' => '', 'method' => 'get')) }}

                        <div class="col-xs-12">
                          <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Search By: </label><br />
                                <select name="search_by_adv_payment" class="form-control" style="width: 30%; float: left;">
                                  <option value="transaction_id" selected="selected">Transaction ID</option>              
                                </select>            
                                <input class="form-control" type="text" value="<?php echo $search_field_adv_payment; ?>" name="search_field_adv_payment" placeholder="Default Search" style="width: 70%; float: right;">
                              </div>
                              <!-- /.form-group -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>&nbsp;</label><br />
                                <button type="submit" class="btn btn-primary">Filter</button>
                                  <a class="btn btn-success" href="{{url('advance_payments/'.$hash_id)}}">Refresh</a>           
                              </div>
                              <!-- /.form-group -->
                            </div>
                          </div>                
                        </div>

                      {!! Form::close() !!}         
                    </div>

                    <table class="table table-bordered table-hover">
                      <tr>    
                        <th>Tansaction ID</th>
                        <th>Process By</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Memo</th>
                        <th>Payee</th>
                        <th>Status</th>
                        <th style="width:10%;">Action</th>
                      </tr>
                      @if(!$advance_payments->isEmpty())
                        @foreach($advance_payments as $payment)
                          <tr>
                            <td>{{ $payment->transaction_id }}</td>
                            <td>{{ $payment->transaction_id }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->type }}</td>
                            <td>{{ $payment->memo }}</td>
                            <td>{{ $payment->transaction_id }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>  

                              <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalEditPayment-<?php echo $payment->id; ?>">
                                <i class="fa fa-edit"></i>
                              </a>

                              <a href="javascript:void(0);" class="btn btn-xs btn-danger" id="" data-toggle="modal" data-target="#modalDeleteDoc-<?php echo $payment->id; ?>">
                                  <i class="fa fa-trash"></i>
                              </a> 

                              <div id="modalEditPayment-<?php echo $payment->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                                {{ Form::open(array('url' => 'contact_advance/update_advance_payment', 'class' => '', 'id' => 'update-advance-form', 'enctype' => 'multipart/form-data')) }}
                                  <input type="hidden" id="" name="payment_id" value="<?php echo Hashids::encode($payment->id); ?>">
                                  <input type="hidden" id="" name="contact_id" value="<?php echo Hashids::encode($contact->id); ?>">
                                  <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                                  <div class="modal-dialog modal-lg" style="width: 600px !important;">
                                    <div class="modal-content">

                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Payment</h4>
                                      </div>
                                      <div class="modal-body">

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Transaction ID</label>
                                              <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="{{ $payment->transaction_id }}" required placeholder=""> 
                                            </div>                
                                          </div>      
                                        </div>

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Amount</label>
                                              <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $payment->amount }}" required placeholder=""> 
                                            </div>                
                                          </div>      
                                        </div>                            

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Type</label>
                                              <select name="type" id="type" class="form-control">
                                                <option <?php echo $payment->type == 'cc' ? 'selected="selected"' : ''; ?>value="cc">CC</option>
                                                <option <?php echo $payment->type == 'ach' ? 'selected="selected"' : ''; ?> value="ach">ACH</option>
                                              </select>   
                                            </div>                
                                          </div>      
                                        </div>

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Payee</label>
                                              <select name="payee" id="payee" class="form-control" style="width: 100%;">
                                                @if(!$users->isEmpty())
                                                  @foreach($users as $cuser)
                                                    <option <?php echo $payment->payee_id == $cuser->id ? 'selected="selected"' : ''; ?> value="{{ $cuser->id }}">{{ $cuser->firstname }} {{ $cuser->lastname }}</option>
                                                  @endforeach
                                                @endif
                                              </select>  

                                            </div>                
                                          </div>      
                                        </div>

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Memo</label>
                                              <textarea class="form-control" name="memo" class="memo" rows="4" cols="2">{{ $payment->memo }}</textarea>
                                            </div>                
                                          </div>      
                                        </div>                            

                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="form-group">
                                              <label for="inputField">Status</label>
                                              <select name="status" id="status" class="form-control">
                                                <option <?php echo $payment->status == 'paid' ? 'selected="selected"' : ''; ?> value="paid">Paid</option>
                                                <option <?php echo $payment->status == 'pending' ? 'selected="selected"' : ''; ?> value="pending">Pending</option>
                                              </select>   
                                            </div>                
                                          </div>      
                                        </div>                            

                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-default">Update Payment</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>

                                    </div>
                                  </div>
                                {!! Form::close() !!}        
                            </div>                

                            {!! Form::close() !!}
                              </div>

                              <div id="modalDeleteDoc-<?php echo $payment->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                      Are you sure you want to delete selected payment?
                                    </div>
                                    <div class="modal-footer">
                                      {{ Form::open(array('url' => 'contact_advance/destroy_payment')) }}
                                        <?php echo Form::hidden('id', Hashids::encode($payment->id) ,[]); ?>
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
                      @else
                        <tr><td colspan="8" style="text-align: center;">NO PAYMENT RECORDS</td></tr>
                      @endif

                    </table>

                    <div style="text-align: center;" class="box-footer clearfix">
                        {{ $advance_payments->links() }}
                    </div>                                      

                  </div>
                </div>

                <div id="modalAddPayment" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                    {{ Form::open(array('url' => 'contact_advance/store_advance', 'class' => '', 'id' => 'add-advance-form', 'enctype' => 'multipart/form-data')) }}
                      <input type="hidden" id="" name="contact_id" value="<?php echo Hashids::encode($contact->id); ?>">
                      <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                      <div class="modal-dialog modal-lg" style="width: 600px !important;">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Add Payment</h4>
                          </div>
                          <div class="modal-body">

                            <div class="row">
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="inputField">Transaction ID</label>
                                  <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="" required placeholder=""> 
                                </div>                
                              </div>      
                            </div>

                            <div class="row">
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="inputField">Amount</label>
                                  <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="" required placeholder=""> 
                                </div>                
                              </div>      
                            </div>                            

                            <div class="row">
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="inputField">Type</label>
                                  <select name="type" id="type" class="form-control">
                                    <option value="cc">CC</option>
                                    <option value="ach">ACH</option>
                                  </select>   
                                </div>                
                              </div>      
                            </div>

                            <div class="row">
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="inputField">Payee</label>
                                  <select name="payee" id="payee" class="form-control" style="width: 100%;">
                                    @if(!$users->isEmpty())
                                      @foreach($users as $cuser)
                                        <option value="{{ $cuser->id }}">{{ $cuser->firstname }} {{ $cuser->lastname }}</option>
                                      @endforeach
                                    @endif
                                  </select>  

                                </div>                
                              </div>      
                            </div>

                            <div class="row">
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="inputField">Memo</label>
                                  <textarea class="form-control" name="memo" class="memo" rows="4" cols="2"></textarea>
                                </div>                
                              </div>      
                            </div>                            

                            <div class="row">
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="inputField">Status</label>
                                  <select name="status" id="status" class="form-control">
                                    <option value="paid">Paid</option>
                                    <option value="pending">Pending</option>
                                  </select>   
                                </div>                
                              </div>      
                            </div>                            

                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-default">Add Payment</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>

                        </div>
                      </div>
                    {!! Form::close() !!}        
                </div>                


                <div class="pull-right">
                  <button type="button" id="btn-update-advance-payment-form" class="btn btn-primary btn-update-advance-payment-form">Update</button>
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

    //$('#payee').select2();          

    $( "#btn-update-advance-payment-form" ).click(function() {
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

