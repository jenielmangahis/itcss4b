<div class="row">
    <div class="col-md-8">
      <div class="row">      
      <div class="col-md-6">
        @if(UserHelper::isAdminUser(Auth::user()->group_id))
        <div class="form-group">
          <label>Company:</label>
          <select name="company_id" id="company_id" class="form-control default-select2">
            @foreach($companies as $company)
            <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
          </select>                    
        </div>
        @endif
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
      </div>

      <div class="col-md-6">
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
          <label>Stage <span class="required"></span></label>
          <select name="stage_id" class="form-control" id="stage_id">
            @foreach($stages as $stage)
            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
            @endforeach
          </select>                    
        </div>    
        
        <div class="form-group">
          <div id="stage-status-container"></div>
        </div>  
      </div>
      </div>
      <div class="row">
        <h3 style="background-color: #3c8dbc; color: #ffffff; padding: 10px;font-size: 16px;">Other Contact Information</h3>
        <div class="col-md-6">
          <div class="form-group">
            <label>Name</label>
            <?php echo Form::text('other_name', old('firstname') ,['class' => 'form-control']); ?>
          </div>    

          <div class="form-group">
            <label>Email</label>
            <?php echo Form::email('other_email', old('other_email') ,['class' => 'form-control']); ?>
          </div>
          
          <div class="form-group">
            <label>Work Number</label>
            <?php echo Form::text('other_work_number', old('other_work_number') ,['class' => 'form-control']); ?>
          </div>  
        </div>
      </div>

    </div>

    <div class="col-md-4">

      <!-- @if(UserHelper::isAdminUser(Auth::user()->group_id))
        <div class="form-group">
          <div id="company-users-container"></div>           
        </div>
      @endif  --> 


      <span class="btn badge badge-primary" style="margin-bottom: 10px; margin-top: 10px;">Assigned to Company Users</span>

      @foreach($company_users_by_group as $company_name => $company_users_group )
      <div class="form-group">
        <label style="">{{ ucwords($company_name) }}</label><br />
        @foreach($company_users_group as $company_user_data)        
        &nbsp;&nbsp;&nbsp;<input name="company_assigned_users[]" type="checkbox" value="{{ $company_user_data['user_id'] }}" class="minimal"> {{ $company_user_data['name'] }} <br />
        @endforeach
      </div>
      @endforeach

      <span class="btn badge badge-primary" style="margin-bottom: 10px; margin-top: 10px;">Assigned to Group Users</span>

      @foreach($users_other_groups as $group_name => $user_group )
      <div class="form-group">
        <label style="">{{ ucwords($group_name) }}</label><br />
        @foreach($user_group as $user_d)        
        &nbsp;&nbsp;&nbsp;<input name="company_assigned_users[]" type="checkbox" value="{{ $user_d['user_id'] }}" class="minimal"> {{ $user_d['name'] }} <br />
        @endforeach
      </div>
      @endforeach
    </div>
</div>