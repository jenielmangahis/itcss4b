<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Business Name <span class="required"></span></label>
      <?php echo Form::text('business_name', $contact_business_info->business_name ,['class' => 'form-control', 'id' => 'business_name']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Years in Business <span class="required"></span></label>
      <select name="years_in_business" class="form-control" id="years_in_business">
        @foreach(GlobalHelper::loadNumbers(100) as $numbers)
        <option <?php echo $contact_business_info->years_in_business == $numbers ? 'selected="selected"' : ''; ?> value="{{ $numbers }}">{{ $numbers }}</option>
        @endforeach
      </select>      
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      &nbsp;
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Legal Entity of Business <span class="required"></span></label>
      <select name="legal_entity_of_business" class="form-control" id="legal_entity_of_business">
        <option <?php echo $contact_business_info->legal_entity_of_business == 'Sole Proprietorship' ? 'selected="selected"' : ''; ?> value="Sole Proprietorship">Sole Proprietorship</option>
        <option <?php echo $contact_business_info->legal_entity_of_business == 'Partnership' ? 'selected="selected"' : ''; ?> value="Partnership">Partnership</option>
        <option <?php echo $contact_business_info->legal_entity_of_business == 'Corporation' ? 'selected="selected"' : ''; ?> value="Corporation">Corporation</option>
        <option <?php echo $contact_business_info->legal_entity_of_business == 'Limited Liability Company-LLC' ? 'selected="selected"' : ''; ?> value="Limited Liability Company-LLC">Limited Liability Company-LLC</option>
      </select>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      &nbsp;
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Accept Credit Card from Customers <span class="required"></span></label>
      <?php echo Form::text('accept_credit_card_from_customer', $contact_business_info->accept_credit_card_from_customer ,['class' => 'form-control']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      &nbsp;
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Gross Monthly Credit Card Sales <span class="required"></span></label>
      <?php echo Form::text('gross_monthly_credit_card_sales', $contact_business_info->gross_monthly_credit_card_sales ,['class' => 'form-control']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      &nbsp;
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Gross Yearly Sales <span class="required"></span></label>
      <?php echo Form::text('gross_yearly_sales', $contact_business_info->gross_yearly_sales ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>File Bankruptcy Filed <span class="required"></span></label>
      <select name="filed_bankruptcy" class="form-control" id="filed_bankruptcy">
        <option <?php echo $contact_business_info->filed_bankruptcy == 'Yes' ? 'selected="selected"' : ''; ?> value="Yes">Yes</option>
        <option <?php echo $contact_business_info->filed_bankruptcy == 'No' ? 'selected="selected"' : ''; ?> value="No">No</option>
      </select>                    
    </div>   
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Date of Bankruptcy <span class="required">*</span></label>
      <?php echo Form::text('bankruptcy_filed', $contact_business_info->bankruptcy_filed ,['class' => 'form-control bankruptcy_filed']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Credit Store <span class="required"></span></label>
      <?php echo Form::text('credit_score', $contact_business_info->credit_score ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>