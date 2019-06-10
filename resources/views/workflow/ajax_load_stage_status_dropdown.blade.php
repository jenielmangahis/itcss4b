<label>Status</label>
@if( !empty($workflow->toArray()) )

  <?php 
    $selected = "";
  ?>

  <select name="user_id" id="user_id" class="form-control">
    @foreach($workflow as $w)        
      <option <?php echo $selected; ?> value="{{ $w->id }}">{{ $w->status }}</option>
    @endforeach
  </select>   
@else
  <select name="workflow_id" id="workflow_id" class="form-control">
    <option value="">No status assigned to stage selected</option>
  </select>
@endif
