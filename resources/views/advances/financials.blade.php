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

                {{ Form::open(array('url' => 'contact_advance/update_financial', 'class' => 'edit-advance-form-payments', 'id' => 'edit-advance-form-payments')) }}
                  <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                  <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="{{ $contact->id }}">                
                
                  @include('advances.includes.edit_advance_fields')

                  <div class="box box-primary">
                    <div id="" class="form-group">

                      <div class="row">
                        <div class="col-xs-12 calendar-events-header" style="padding-top: 10px;">
                          <div class="pull-left"><strong>FINANCIALS</strong></div>
                        </div>
                      </div>   

                      <!-- Financial Here --> 
                      <br />
                      <div class="row">
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Bank</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{$contact_adv_financial_bank_statement[1]['name']}}" placeholder="" required="">
                          </div>   
                        </div>
                      </div>

                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">-</th>
                            <th scope="col">-</th>
                            <th scope="col">Total Deposits</th>
                            <th scope="col">Avg. Daily</th>
                            <th scope="col">Withdrawal</th>
                            <th scope="col">Ending Bal.</th>
                            <th scope="col"># Deposit</th>
                            <th scope="col"># Days Neg</th>
                            <th scope="col"># NSFs</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $numbers = GlobalHelper::loadNumbers(12); 
                            $inc     = 0;
                          ?>
                          @foreach($numbers as $num)
                            <tr>
                              <th scope="row">
                                <div class="form-group">
                                  <select style="width: 85px;" name="bank['bank_month'][{{$num}}]" id="bank_month" class="form-control">
                                    <option value="">Month</option>
                                    @foreach($numbers as $months)
                                      <option <?php echo $contact_adv_financial_bank_statement[$inc]['month'] == $months ? 'selected="selected"' : ''; ?> value="{{$months}}">{{ date("M", mktime(0, 0, 0, $months, 10)) }}</option>
                                    @endforeach
                                  </select>                   
                                </div>                              
                              </th>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="bank_year" name="bank['bank_year'][{{$num}}]" value="{{ $contact_adv_financial_bank_statement[$inc]['year'] }}" placeholder="Year">
                                </div>                                
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" step="0.01" class="form-control" id="total_deposits" name="bank['total_deposits'][{{$num}}]" value="{{$contact_adv_financial_bank_statement[$inc]['total_deposits']}}" placeholder="0.00">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" step="0.01" class="form-control" id="averate_daily" name="bank['averate_daily'][{{$num}}]" value="{{ $contact_adv_financial_bank_statement[$inc]['averate_daily'] }}" placeholder="0.00">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" step="0.01" class="form-control" id="withdrawal" name="bank['withdrawal'][{{$num}}]" value="{{ $contact_adv_financial_bank_statement[$inc]['withdrawal'] }}" placeholder="0.00">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" step="0.01" class="form-control" id="ending_balance" name="bank['ending_balance'][{{$num}}]" value="{{ $contact_adv_financial_bank_statement[$inc]['ending_balance'] }}" placeholder="0.00">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="deposits" name="bank['deposits'][{{$num}}]" value="{{ $contact_adv_financial_bank_statement[$inc]['deposits'] }}" placeholder="0">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="days_neg" name="bank['days_neg'][{{$num}}]" value="{{ $contact_adv_financial_bank_statement[$inc]['days_neg'] }}" placeholder="0">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="nsf" name="bank['nsf'][{{$num}}]" value="{{ $contact_adv_financial_bank_statement[$inc]['nsf'] }}" placeholder="0">
                                </div>
                              </td>
                            </tr>
                          <?php $inc++; ?>
                          @endforeach
                        </tbody>
                      </table>     

                      <br />
                      <div class="row">
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Merchant Statement</label>
                            <input type="text" class="form-control" id="merchant_name" name="merchant_name" value="{{ $contact_adv_merchant_statement[1]['name'] }}" placeholder="" required="">
                          </div>   
                        </div>
                      </div>     
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">-</th>
                            <th scope="col">-</th>
                            <th scope="col">Total Vol.</th>
                            <th scope="col">Visa/MC/Disc</th>
                            <th scope="col">Amex</th>
                            <th scope="col">Chargeback Vol.</th>
                            <th scope="col"># Transaction</th>
                            <th scope="col"># Batches</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $numbers = GlobalHelper::loadNumbers(12); 
                            $incm = 0;
                          ?>
                          @foreach($numbers as $num)
                            <tr>
                              <th scope="row">
                                <div class="form-group">
                                  <select style="width: 85px;" name="merchant['merchant_month'][{{$num}}]" id="merchant_month" class="form-control">
                                    <option value="">Month</option>
                                    @foreach($numbers as $months)
                                      <option <?php echo $contact_adv_merchant_statement[$incm]['month'] == $months ? 'selected="selected"' : ''; ?> value="{{$months}}">{{ date("M", mktime(0, 0, 0, $months, 10)) }}</option>
                                    @endforeach
                                  </select>                   
                                </div>                              
                              </th>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="merchant_year" name="merchant['merchant_year'][{{$num}}]" value="{{$contact_adv_merchant_statement[$incm]['year']}}" placeholder="Year">
                                </div>                                
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" step="0.01" class="form-control" id="total_volume" name="merchant['total_volume'][{{$num}}]" value="{{$contact_adv_merchant_statement[$incm]['total_volume']}}" placeholder="0.00">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" step="0.01" class="form-control" id="visa_ms_disc" name="merchant['visa_ms_disc'][{{$num}}]" value="{{$contact_adv_merchant_statement[$incm]['visa_ms_disc']}}" placeholder="0.00">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" step="0.01" class="form-control" id="amex" name="merchant['amex'][{{$num}}]" value="{{$contact_adv_merchant_statement[$incm]['amex']}}" placeholder="0.00">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" step="0.01" class="form-control" id="charge_back_volume" name="merchant['charge_back_volume'][{{$num}}]" value="{{$contact_adv_merchant_statement[$incm]['charge_back_volume']}}" placeholder="0.00">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="transaction" name="merchant['transaction'][{{$num}}]" value="{{$contact_adv_merchant_statement[$incm]['transaction']}}" placeholder="0">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="batches" name="merchant['batches'][{{$num}}]" value="{{$contact_adv_merchant_statement[$incm]['batches']}}" placeholder="0">
                                </div>
                              </td>
                            </tr>
                          <?php $incm++; ?>
                          @endforeach
                        </tbody>
                      </table>    
                      <!-- Financial Here - End -->                                                                    

                    </div>
                  </div>
                {!! Form::close() !!}

                <div class="pull-right">
                  <button type="button" id="btn-update-advance-financials-form" class="btn btn-primary btn-update-advance-financials-form">Update</button>
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

    $( "#btn-update-advance-financials-form" ).click(function() {
      $( "#edit-advance-form-payments" ).submit();
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
    $.get(base_url + '/contact_advance/ajax_load_payback_payment_computation_edit', $('#edit-advance-form-payments').serialize(), function (o) {
      $('#payback-payment-container-edit').html('<br><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br>');

      setTimeout(function () {
        $('#payback-payment-container-edit').html(o);
      }, 250);
    });    
  } 
 
</script>

@endsection

