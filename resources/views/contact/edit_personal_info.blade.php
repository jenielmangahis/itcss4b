<div class="row">
  <div class="col-md-8">
    <div class="row"> 
      <div class="col-md-6">
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
      </div>
      <div class="col-md-6">
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
    </div>
    <div class="row">
        <h3 style="background-color: #3c8dbc; color: #ffffff; padding: 10px;font-size: 16px;">Other Contact Information</h3>
        <div class="col-md-6">
          <div class="form-group">
            <label>Name</label>
            <?php echo Form::text('other_name', $contact->other_name ,['class' => 'form-control']); ?>
          </div>    

          <div class="form-group">
            <label>Email</label>
            <?php echo Form::email('other_email', $contact->other_email ,['class' => 'form-control']); ?>
          </div>
          
          <div class="form-group">
            <label>Work Number</label>
            <?php echo Form::text('other_work_number', $contact->other_work_number ,['class' => 'form-control']); ?>
          </div>  
        </div>
      </div>
  </div>

  <div class="col-md-4">
    <!-- <div class="form-group">
      <div id="company-users-container"></div>           
    </div>  -->

    <span class="btn badge badge-primary" style="margin-bottom: 10px; margin-top: 10px;">Assigned to Company Funders</span>

    <div class="form-group">
      <select name="company_assigned_users[]" class="form-control company_assigned_users" id="company_assigned_users" multiple="multiple">
        @foreach($company_users_by_group as $company_name => $company_users_group )
          <optgroup label="{{ ucwords($company_name) }}">
          @foreach($company_users_group as $company_user_data)    

            <?php 
              $is_selected = "";
              foreach($existing_assigned_user as $e_au) {
                    if($e_au['user_id'] == $company_user_data['user_id']) {
                      $is_selected = 'selected=""';
                    }
              }
            ?>

            <option {{$is_selected}} value="{{ $company_user_data['user_id'] }}">{{ $company_user_data['name'] }}</option>
          @endforeach          
        @endforeach
      </select>
    </div> 


    <span class="btn badge badge-primary" style="margin-bottom: 10px; margin-top: 10px;">Assigned to Group Users</span>

    <div class="form-group">
      <select name="company_assigned_users[]" class="form-control company_assigned_users" id="company_assigned_users2" multiple="multiple">
        @foreach($users_other_groups as $group_name => $user_group )
          <optgroup label="{{ ucwords($group_name) }}">
          @foreach($user_group as $user_d)   

            <?php 
              $is_selected = "";
              foreach($existing_assigned_user as $e_au) {
                    if($e_au['user_id'] == $user_d['user_id']) {
                      $is_selected = 'selected=""';
                    }
              }
            ?>

            <option {{$is_selected}} value="{{ $user_d['user_id'] }}">{{ $user_d['name'] }}</option>
          @endforeach          
        @endforeach
      </select>
    </div>     

  </div>
</div>