<label>Status</label>
@if( !empty($workflow->toArray()) )

  <select name="status" id="status" class="form-control">
    @foreach($workflow as $w)        
      <option <?php echo $w->status == $status ? 'selected="selected"' : ''; ?> value="{{ $w->status }}">{{ $w->status }}</option>
    @endforeach
  </select>   
@else
  <select name="status" id="status" class="form-control">
    <option value="">No status assigned to stage selected</option>
  </select>
@endif
