<div class="form-group">
  <h2 class="page-header">
    <i class="fa fa-info-circle"></i> Company
    <small class="pull-right"></small>
  </h2>
</div> 

<div class="form-group">
  <label>Company:</label>
  <select name="company_id" id="company_id" class="form-control">
    @foreach($companies as $company)
    <option value="{{ $company->id }}">{{ $company->name }}</option>
    @endforeach
  </select>                    
</div>

<div class="form-group">
  <div id="company-users-container"></div>           
</div>                
<br />

<div class="form-group">
  <h2 class="page-header">
    <i class="fa fa-info-circle"></i> Info.
    <small class="pull-right"></small>
  </h2>
</div> 

<div class="form-group">
  <label>Firstname <span class="required">*</span></label>
  <?php echo Form::text('firstname', old('firstname') ,['class' => 'form-control', 'required' => '']); ?>
</div>

<div class="form-group">
  <label>Lastname <span class="required">*</span></label>
  <?php echo Form::text('lastname', old('lastname') ,['class' => 'form-control', 'required' => '']); ?>
</div>

<div class="form-group">
  <label>Email <span class="required">*</span></label>
  <?php echo Form::email('email', old('email') ,['class' => 'form-control', 'required' => '']); ?>
</div>

<div class="form-group">
  <label>Mobile Number <span class="required"></span></label>
  <?php echo Form::text('mobile_number', old('mobile_number') ,['class' => 'form-control']); ?>
</div>

<div class="form-group">
  <label>Work Number <span class="required"></span></label>
  <?php echo Form::text('work_number', old('work_number') ,['class' => 'form-control']); ?>
</div>

<div class="form-group">
  <label>Home Number <span class="required"></span></label>
  <?php echo Form::text('home_number', old('home_number') ,['class' => 'form-control']); ?>
</div>

<div class="form-group">
  <h2 class="page-header">
    <i class="fa fa-info-circle"></i> Address
    <small class="pull-right"></small>
  </h2>
</div>

<div class="form-group">
  <label>Address 1 <span class="required">*</span></label>
  <?php echo Form::text('address1', old('address1') ,['class' => 'form-control', 'required' => '']); ?>
</div>

<div class="form-group">
  <label>Address 2 <span class="required"></span></label>
  <?php echo Form::text('address2', old('address2') ,['class' => 'form-control']); ?>
</div>

<div class="form-group">
  <label>City <span class="required"></span></label>
  <?php echo Form::text('city', old('city') ,['class' => 'form-control']); ?>
</div>

<div class="form-group">
  <label>State <span class="required"></span></label>
  <?php echo Form::text('state', old('state') ,['class' => 'form-control']); ?>
</div>

<div class="form-group">
  <label>Zip Code <span class="required">*</span></label>
  <?php echo Form::text('zip_code', old('zip_code') ,['class' => 'form-control', 'required' => '']); ?>
</div>

<div class="form-group">
  <h2 class="page-header">
    <i class="fa fa-info-circle"></i> Status
    <small class="pull-right"></small>
  </h2>
</div>               

<div class="form-group">
  <select name="status" class="form-control">
    <option value="0" selected="selected">Active</option>
    <option value="1">Suspended</option>
  </select>                    
</div>  

<div class="form-group">
  <h2 class="page-header">
    <i class="fa fa-info-circle"></i> Stage
    <small class="pull-right"></small>
  </h2>
</div>               

<div class="form-group">
  <select name="stage_id" class="form-control">
    @foreach($stages as $stage)
    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
    @endforeach
  </select>                    
</div>   