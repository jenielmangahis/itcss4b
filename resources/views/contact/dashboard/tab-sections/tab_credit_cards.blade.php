<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Credit Card</div>    
  </div>
</div>
<br /><br />
{{ Form::open(array('url' => 'contact_credit_card/update', 'class' => '')) }}  
  <?php if( $contact_credit_card_id > 0 ){ $contact_credit_card_id =  Hashids::encode($contact_credit_card_id);} ?>
  <input type="hidden" id="" name="contact_id" value="<?php echo $contact_id; ?>">
  <input type="hidden" id="" name="contact_credit_card_id" value="<?php echo $contact_credit_card_id; ?>">
  <div class="box-body">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Debit / Credit <span class="required">*</span></label>
      <div class="col-sm-10">
        <select name="debit_credit" id="" class="form-control">
          <?php foreach($creditCardDebitCredit as $key => $value){ ?>
            <option <?php echo $data_contact_credit_card['debit_credit'] == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Card Type <span class="required">*</span></label>
      <div class="col-sm-10">
        <select name="card_type" id="" class="form-control">
          <?php foreach($creditCardCardTypes as $key => $value){ ?>
            <option <?php echo $data_contact_credit_card['card_type'] == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Card Issuer <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('card_issuer', $data_contact_credit_card['card_issuer'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Name on Card <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('name_on_card', $data_contact_credit_card['name_on_card'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Card Number <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('card_number', $data_contact_credit_card['card_number'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Expiration Date <span class="required">*</span></label>
      <div class="col-sm-3">
        <select name="expiration_date_month" id="" class="form-control">
        <?php for( $x = 1; $x <= 12; $x++ ){ ?>
          <option <?php echo $data_contact_credit_card['expiration_date_month'] == $x ? 'selected="selected"' : ''; ?> value="<?= $x; ?>"><?= $x; ?></option>
        <?php } ?>
        </select>
      </div>
      <div class="col-sm-3">
        <select name="expiration_date_year" id="" class="form-control">
        <?php for( $x = date("Y", strtotime("+10 year")); $x >= 1980; $x-- ){ ?>
          <option <?php echo $data_contact_credit_card['expiration_date_year'] == $x ? 'selected="selected"' : ''; ?> value="<?= $x; ?>"><?= $x; ?></option>
        <?php } ?>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Address <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('address', $data_contact_credit_card['address'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Address2 <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('address2', $data_contact_credit_card['address2'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">City <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('city', $data_contact_credit_card['city'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>      

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">State <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('state', $data_contact_credit_card['state'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Zip <span class="required">*</span></label>
      <div class="col-sm-10">
        <?php echo Form::text('zip', $data_contact_credit_card['zip'] ,['class' => 'form-control', 'required' => '']); ?>
      </div>
    </div>      
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-success">Save Credit Card</button>
  </div>
{!! Form::close() !!}
</div>