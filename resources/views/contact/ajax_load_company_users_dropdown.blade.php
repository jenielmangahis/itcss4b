<label>Assigned to:</label>
@if( !empty($company_users->toArray()) )

  <?php 
    $selected = "";
  ?>

  <select name="user_id" id="user_id" class="form-control">
    @foreach($company_users as $company_user)
      if(!empty($c_user_id)) {
        if($c_user_id == $company_user->user_id) {
          $selected = "selected='selected'";
        }
      }    
      <option <?php echo $selected; ?> value="{{ $company_user->user_id }}">{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</option>
    @endforeach
  </select>   
@else
  <p>No company users available</p>
@endif
