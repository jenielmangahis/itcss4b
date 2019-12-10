<div class="row">
  <div class="col-md-5">
    @if(UserHelper::isAdminUser(Auth::user()->group_id))
    <div class="form-group">
      <label>Company:</label>
      <select name="company_id" id="company_id" class="form-control">
        @foreach($companies as $company)
        <option <?php echo $contact->company_id == $company->id ? 'selected="selected"' : ''; ?> value="{{ $company->id }}">{{ $company->name }}</option>
        @endforeach
      </select>                    
    </div>
    @endif

    <div class="form-group">
      <label>Firstname <span class="required">*</span></label>
      <?php echo Form::text('firstname', $contact->firstname ,['class' => 'form-control', 'required' => '']); ?>
    </div> 
    
    <div class="form-group">
      <label>Lastname <span class="required">*</span></label>
      <?php echo Form::text('lastname', $contact->lastname ,['class' => 'form-control', 'required' => '']); ?>
    </div>

    <div class="form-group">
      <label>Email <span class="required">*</span></label>
      <?php echo Form::email('email', $contact->email ,['class' => 'form-control', 'required' => '']); ?>
    </div>

    <div class="form-group">
      <label>Mobile Number <span class="required"></span></label>
      <?php echo Form::text('mobile_number', $contact->mobile_number ,['class' => 'form-control']); ?>
    </div>    

    <div class="form-group">
      <label>Work Number <span class="required"></span></label>
      <?php echo Form::text('work_number', $contact->work_number ,['class' => 'form-control']); ?>
    </div>    

    <div class="form-group">
      <label>Home Number <span class="required"></span></label>
      <?php echo Form::text('home_number', $contact->home_number ,['class' => 'form-control']); ?>
    </div> 
    
    <div class="form-group">
      <label>Address 1 <span class="required">*</span></label>
      <?php echo Form::text('address1', $contact->address1 ,['class' => 'form-control', 'required' => '']); ?>
    </div>    

    <div class="form-group">
      <label>Address 2 <span class="required"></span></label>
      <?php echo Form::text('address2', $contact->address2 ,['class' => 'form-control']); ?>
    </div>       

    <div class="form-group">
      <label>City <span class="required"></span></label>
      <?php echo Form::text('city', $contact->city  ,['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
      <label>State <span class="required"></span></label>
      <?php echo Form::text('state', $contact->state ,['class' => 'form-control']); ?>
    </div>  
    
    <div class="form-group">
      <label>Zip Code <span class="required">*</span></label>
      <?php echo Form::text('zip_code', $contact->zip_code ,['class' => 'form-control', 'required' => '']); ?>
    </div>  
    
    <div class="form-group">
      <label>Stage <span class="required"></span></label>
      <select name="stage_id" class="form-control" id="stage_id">
        @foreach($stages as $stage)
        <option <?php echo $contact->stage_id == $stage->id ? 'selected="selected"' : ''; ?> value="{{ $stage->id }}">{{ $stage->name }}</option>
        @endforeach
      </select>                    
    </div>   
    
    <div class="form-group">
      <div id="stage-status-container"></div>
    </div>         

  </div>

  <div class="col-md-5">
    <!-- <div class="form-group">
      <div id="company-users-container"></div>           
    </div>  -->

    <span class="btn badge badge-primary" style="margin-bottom: 10px; margin-top: 10px;">Assigned to Company Users</span>

    @foreach($company_users_by_group as $company_name => $company_users_group )
    <div class="form-group">
      <label style="">{{ ucwords($company_name) }}</label><br />
      @foreach($company_users_group as $company_user_data)      

      <?php 
        $is_checked = "";
        foreach($existing_assigned_user as $e_au) {
              if($e_au['user_id'] == $company_user_data['user_id']) {
                $is_checked = 'checked=""';
              }
        }
      ?>

      &nbsp;&nbsp;&nbsp;<input name="company_assigned_users[]" type="checkbox" <?php echo $is_checked; ?> value="{{ $company_user_data['user_id'] }}" class="minimal"> {{ $company_user_data['name'] }} <br />
      @endforeach
    </div>
    @endforeach  

    <span class="btn badge badge-primary" style="margin-bottom: 10px; margin-top: 10px;">Assigned to Group Users</span>

    @foreach($users_other_groups as $group_name => $user_group )
    <div class="form-group">
      <label style="">{{ ucwords($group_name) }}</label><br />
      @foreach($user_group as $user_d)        

      <?php 
        $is_checked = "";
        foreach($existing_assigned_user as $e_au) {
              if($e_au['user_id'] == $user_d['user_id']) {
                $is_checked = 'checked=""';
              }
        }
      ?>

      &nbsp;&nbsp;&nbsp;<input name="company_assigned_users[]" type="checkbox" <?php echo $is_checked; ?> value="{{ $user_d['user_id'] }}" class="minimal"> {{ $user_d['name'] }} <br />
      @endforeach
    </div>
    @endforeach      

  </div>
</div>