<label>Assigned to:</label>
@if( !empty($company_users->toArray()) )

  <select name="user_id" id="user_id" class="form-control">
    @foreach($company_users as $company_user)   
      <option <?php echo $c_user_id == $company_user->user_id ? 'selected="selected"' : ''; ?> value="{{ $company_user->user_id }}">{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</option>
    @endforeach
  </select>   
@else
  <select name="user_id" id="user_id" class="form-control">
    <option value="">No company users available</option>
  </select>
@endif


