<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Firstname <span class="required">*</span></label>
      <?php echo Form::text('firstname', $contact->firstname ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>Lastname <span class="required">*</span></label>
      <?php echo Form::text('lastname', $contact->lastname ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Email <span class="required">*</span></label>
      <?php echo Form::email('email', $contact->email ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>Mobile Number <span class="required"></span></label>
      <?php echo Form::text('mobile_number', $contact->mobile_number ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Work Number <span class="required"></span></label>
      <?php echo Form::text('work_number', $contact->work_number ,['class' => 'form-control']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>Home Number <span class="required"></span></label>
      <?php echo Form::text('home_number', $contact->home_number ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Address 1 <span class="required">*</span></label>
      <?php echo Form::text('address1', $contact->address1 ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>Address 2 <span class="required"></span></label>
      <?php echo Form::text('address2', $contact->address2 ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>City <span class="required"></span></label>
      <?php echo Form::text('city', $contact->city ,['class' => 'form-control']); ?>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>State <span class="required"></span></label>
      <?php echo Form::text('state', $contact->state ,['class' => 'form-control']); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Zip Code <span class="required">*</span></label>
      <?php echo Form::text('zip_code', $contact->zip_code ,['class' => 'form-control', 'required' => '']); ?>
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
        <option <?php echo $contact->stage_id == $stage->id ? 'selected="selected"' : ''; ?> value="{{ $stage->id }}">{{ $stage->name }}</option>
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