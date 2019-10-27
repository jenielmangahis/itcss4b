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