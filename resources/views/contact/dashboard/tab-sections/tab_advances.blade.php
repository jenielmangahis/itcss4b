<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Advances</div>
    <div class="pull-right">
        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddAdvance">
            <i class="fa fa-plus"></i> New Advance
        </a>          
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>

<div class="row">
  <?php if( $group_id == 3 ){ ?>
    {{ Form::open(array('url' => 'dashboard', 'class' => '', 'method' => 'get')) }}
  <?php }else{ ?>
    {{ Form::open(array('url' => 'contact_dashboard/'.$contact_id, 'class' => '', 'method' => 'get')) }}
  <?php } ?>
  

    <div class="col-xs-12">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Search By: </label><br />
            <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
              <option <?php echo $search_by_advance == 'loan_id' ? 'selected="selected"' : ''; ?> value="loan_id">Loan ID</option>
              <option <?php echo $search_by_advance == 'status' ? 'selected="selected"' : ''; ?> value="status">Status</option>
              <option <?php echo $search_by_advance == 'advance_type' ? 'selected="selected"' : ''; ?> value="advance_type">Type</option>
              <option <?php echo $search_by_advance == 'period_type' ? 'selected="selected"' : ''; ?> value="period_type">Period</option>
            </select>
            <input class="form-control" type="text" value="<?php echo $search_advance_field; ?>" name="search_advance_field" placeholder="Default Search" style="width: 70%; float: right;">
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
              <a class="btn btn-success" href="{{url('contact_dashboard/'.$contact_id)}}">Refresh</a>
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
    <th>Loan ID</th>
    <!-- <th>Contract Date</th> -->
    <!-- <th>Contract Num.:</th>
    <th>Advance Date</th> -->
    <th>Amount</th>
    <th>Payback</th>
    <th>Payment</th>
    <th>Balance</th>
    <th>Rate</th>
    <th>Period</th>
    <th>Type</th>
    <th>Status</th>
    <?php if( $group_id == 1 ){ ?>
      <th style="width:10%;">Action</th>
    <?php } ?>
  </tr>

  @foreach($contact_advances as $advance)
    <?php 
      $rate = 0;
    ?>
    <tr>
      <td>{{$advance->loan_id}}</td>
      <!-- <td>--</td>
      <td>--</td>
      <td>--</td> -->
      <td>{{ number_format($advance->amount,2) }}</td>
      <td>{{ number_format($advance->payback,2) }}</td>
      <td>{{ number_format($advance->payment,2) }}</td>
      <td>{{ number_format($advance->balance,2) }}</td>
      <td>{{ $advance->factor_rate }}%</td>
      <td>{{ $advance->period_type }} - {{ $advance->period }}</td>
      
      <td>{{ $advance->advance_type }}</td>
      <td>{{ $advance->status }}</td>
      <?php if( $group_id == 1 ){ ?>
      <td>
        <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDeleteAdvance-<?= $advance->id; ?>">
            <i class="fa fa-trash"></i>
        </a>
        <!-- <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalEditAdvance-<?= $advance->id; ?>">
            <i class="fa fa-edit"></i>
        </a>  -->          
        <a href="{{url('advance_application/'.Hashids::encode($advance->id))}}" class="btn btn-xs btn-primary">
            <i class="fa fa-edit"></i>
        </a>                                          
      </td>
      <?php } ?>
    </tr>  

    <div id="modalDeleteAdvance-<?= $advance->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Delete</h4>
            </div>
            <div class="modal-body">
              Are you sure you want to delete selected advance?
            </div>
            <div class="modal-footer">
              {{ Form::open(array('url' => 'contact_advance/destroy')) }}
                <?php echo Form::hidden('id', Hashids::encode($advance->id) ,[]); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
              {!! Form::close() !!}
            </div>

          </div>
        </div>
    </div>    

    <div id="modalEditAdvance-<?= $advance->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
        {{ Form::open(array('url' => 'contact_advance/update', 'class' => 'edit-advance-form-' . $advance->id, 'id' => 'edit-advance-form-'. $advance->id)) }}
          <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
          <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="{{ $contact_id }}">
          <div class="modal-dialog modal-lg" style="width: 600px !important;">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Advance</h4>
              </div>
              <div class="modal-body">

                <div class="row">

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
                <div style="float: right;"><a onclick="javascript:compute_payback_payment('<?php echo $advance->id; ?>');" href="javascript:void(0);">Compute</a></div>
                <div id="payback-payment-container-edit-<?php echo $advance->id; ?>" class="payback-payment-container-edit-<?php echo $advance->id; ?>">
                  <div class="form-group">
                    <label for="inputAdvanceAmount">Payback Amount</label>
                    <input type="text" class="form-control" id="payback_amount" name="payback_amount" value="{{$advance->payback}}" placeholder="" disabled="disabled">
                  </div> 

                  <div class="form-group">
                    <label for="inputAdvanceAmount">Payment</label>
                    <input type="text" class="form-control" id="payment" name="payment" value="{{$advance->payment}}" placeholder="" disabled="disabled">
                  </div>                                
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-default">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>

            </div>
          </div>
        {!! Form::close() !!}        
    </div>        

  @endforeach
</table>

<div style="text-align: center;" class="box-footer clearfix">
    {{ $contact_advances->links() }}
</div>

<div id="modalAddAdvance" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => 'contact_advance/store', 'class' => '', 'id' => 'add-advance-form')) }}
      <input type="hidden" name="contact_id" id="contact_id" value="{{ $contact_id }}">
      <div class="modal-dialog modal-lg" style="width: 600px !important;">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Advance</h4>
          </div>
          <div class="modal-body">

            <div class="row">

              <div class="col-xs-6">
                <div class="form-group">
                  <label for="inputAdvanceType">Advance Type</label>
                  <select name="advance_type" id="advance_type" class="form-control">
                    <option value="new">New</option>
                    <option value="add-on">Add-on</option>
                    <option value="renewal">Renewal</option>
                  </select>  
                </div>                
              </div>

              <div class="col-xs-6">
                <div class="form-group">
                  <label for="inputPaymentMethod">Payment Method</label>
                  <select name="payment_method" id="payment_method" class="form-control">
                    <option value="ach">Ach</option>
                    <option value="cc">Cc</option>
                  </select>                   
                </div>                
              </div>           

            </div>  

            <div class="form-group">
              <label for="inputAdvanceAmount">Advance Amount</label>
              <input type="number" step="0.01" class="form-control advance_amount" id="advance_amount" name="advance_amount" value="{{old('advance_amount')}}" placeholder="Enter Amount" required="">
            </div>                   

            <div class="row">
              <div class="col-xs-6">
                <div class="form-group">
                  <label for="inputPaymentPeriod">Payment Period</label>
                  <input type="number" class="form-control payment_period" id="payment_period" name="payment_period" value="{{old('payment_period')}}" placeholder="" required="">
                </div>                
              </div>
              <div class="col-xs-6">
                <div class="form-group">
                  <label for="input">&nbsp</label>
                  <select name="payment_period_type" id="payment_period_type" class="form-control">
                    <option value="days">Days</option>
                    <option value="weeks">Weeks</option>
                    <option value="month">Month</option>
                  </select>                    
                </div>                
              </div>
            </div>

            <div class="row">
              <div class="col-xs-6">
                <label for="inputPaymentPeriod">Remit</label>
                <input  type="number" step="0.01" class="form-control remit" id="remit" name="remit" value="{{old('remit')}}" placeholder="%" required="">
              </div>
              <div class="col-xs-6">
                <label for="inputPaymentPeriod">Factor Rate</label>
                <input  type="number" step="0.01" class="form-control factor_rate" id="factor_rate" name="factor_rate" value="{{old('factor_rate')}}" placeholder="%" required="">
              </div>
            </div>     

            <br />
            <div style="float: right;"><a onclick="javascript:compute_payback_and_payment();" href="javascript:void(0);">Compute</a></div>
            <div id="payback-payment-container" class="payback-payment-container">
              <div class="form-group">
                <label for="inputAdvanceAmount">Payback Amount</label>
                <input type="text" class="form-control" id="payback_amount" name="payback_amount" value="{{old('payback_amount')}}" placeholder="" disabled="disabled">
              </div> 

              <div class="form-group">
                <label for="inputAdvanceAmount">Payment</label>
                <input type="text" class="form-control" id="payment" name="payment" value="{{old('payment')}}" placeholder="" disabled="disabled">
              </div>                                
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    {!! Form::close() !!}        
</div>

