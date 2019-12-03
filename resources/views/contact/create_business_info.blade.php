<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Business Name <span class="required"></span></label>
      <?php echo Form::text('business_name', old('business_name') ,['class' => 'form-control']); ?>
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
        <option value="{{ $numbers }}">{{ $numbers }}</option>
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
        <option value="Sole Proprietorship">Sole Proprietorship</option>
        <option value="Partnership">Partnership</option>
        <option value="Corporation">Corporation</option>
        <option value="Limited Liability Company-LLC">Limited Liability Company-LLC</option>
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
      <label>Accept Credit Card from Customers <span class="required">*</span></label>
      <?php echo Form::text('accept_credit_card_from_customer', old('accept_credit_card_from_customer') ,['class' => 'form-control']); ?>
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
      <?php echo Form::text('gross_monthly_credit_card_sales', old('gross_monthly_credit_card_sales') ,['class' => 'form-control']); ?>
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
      <?php echo Form::text('gross_yearly_sales', old('gross_yearly_sales') ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>File Bankruptcy Filed <span class="required"></span></label>
      <select name="filed_bankruptcy" class="form-control" id="filed_bankruptcy">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>                    
    </div>   
  </div>
</div>

<div class="row date-bankruptcy-container">
  <div class="col-md-5">
    <div class="form-group">
      <label>Date of Bankruptcy <span class="required">*</span></label>
      <?php echo Form::text('bankruptcy_filed', old('bankruptcy_filed') ,['class' => 'form-control bankruptcy_filed']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Credit Store <span class="required"></span></label>
      <?php echo Form::text('credit_score', old('credit_score') ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>