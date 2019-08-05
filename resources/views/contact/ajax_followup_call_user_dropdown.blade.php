<select name="user_id" id="user_id" class="form-control user-assigned-to">
  @if( !empty($company_users->toArray()) )
    @foreach($company_users as $company_user)   
      <option value="{{ $company_user->user_id }}">{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</option>
    @endforeach
  @else
    <option value="">No company users available</option>
  @endif
</select> 