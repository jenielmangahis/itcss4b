<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Bank Account</div>    
  </div>
</div>
<br /><br />
{{ Form::open(array('url' => 'contact_bank_account/update', 'class' => '')) }}
  <div class="row">
  <div class="form-check">
    <label class="form-check-label" style="font-size:16px;">
      <input type="checkbox" <?php echo( $data_bank_account['is_check_paying_client'] == 1 ? 'checked="checked"' : '' ); ?> class="form-check-input" name="is_check_paying_client" />
      Check Paying Client
    </label>
  </div>
  </div>
  <hr style="background-color: #777;border:2px !important;height: 2px;" />
  <?php if( $bank_account_id > 0 ){ $bank_account_id =  Hashids::encode($bank_account_id);} ?>
  <input type="hidden" id="" name="contact_id" value="<?php echo $contact_id; ?>">
  <input type="hidden" id="" name="bank_account_id" value="<?php echo $bank_account_id; ?>">
  <div class="box-body">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Routing Number <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('routing_number', $data_bank_account['routing_number'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Account Number <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('account_number', $data_bank_account['account_number'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Account Type <span class="required">*</span></label>
      <div class="col-sm-10">
        <select name="account_type" id="" class="form-control">
          <?php foreach($bankAccountAccountTypes as $key => $value){ ?>
            <option <?php echo $data_bank_account['account_type'] == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
          <?php } ?>
        </select>     
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Name on Account <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('name_on_account', $data_bank_account['name_on_account'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Bank Name <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('bank_name', $data_bank_account['bank_name'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Address <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('address', $data_bank_account['address'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">City <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('city', $data_bank_account['city'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">State <span class="required">*</span></label>
      <div class="col-sm-10">
        <select class="form-control" name="state_id">
          @foreach($states as $st)
            <option <?= $data_bank_account['state_id'] == $st->id ? 'selected="selected"' : '';  ?> value="{{ $st->id }}">{{ $st->name }}</option>
          @endforeach
        </select>  
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Zip <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('zip', $data_bank_account['zip'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>      
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-success">Save Bank Account</button>
  </div>
{!! Form::close() !!}
</div>