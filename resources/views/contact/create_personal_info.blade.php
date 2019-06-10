<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Company11:</label>
      <select name="company_id" id="company_id" class="form-control">
        @foreach($companies as $company)
        <option value="{{ $company->id }}">{{ $company->name }}</option>
        @endforeach
      </select>                    
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <div id="company-users-container"></div>           
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Firstname <span class="required">*</span></label>
      <?php echo Form::text('firstname', old('firstname') ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>Lastname <span class="required">*</span></label>
      <?php echo Form::text('lastname', old('lastname') ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Email <span class="required">*</span></label>
      <?php echo Form::email('email', old('email') ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>Mobile Number <span class="required"></span></label>
      <?php echo Form::text('mobile_number', old('mobile_number') ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Work Number <span class="required"></span></label>
      <?php echo Form::text('work_number', old('work_number') ,['class' => 'form-control']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>Home Number <span class="required"></span></label>
      <?php echo Form::text('home_number', old('home_number') ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Address 1 <span class="required">*</span></label>
      <?php echo Form::text('address1', old('address1') ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>Address 2 <span class="required"></span></label>
      <?php echo Form::text('address2', old('address2') ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>City <span class="required"></span></label>
      <?php echo Form::text('city', old('city') ,['class' => 'form-control']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>State <span class="required"></span></label>
      <?php echo Form::text('state', old('state') ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Zip Code <span class="required">*</span></label>
      <?php echo Form::text('zip_code', old('zip_code') ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>
</div>
<hr />
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Stage <span class="required"></span></label>
      <select name="stage_id" class="form-control" id="stage_id">
        @foreach($stages as $stage)
        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
        @endforeach
      </select>                    
    </div>   
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <div id="stage-status-container"></div>
    </div>
  </div>
</div>