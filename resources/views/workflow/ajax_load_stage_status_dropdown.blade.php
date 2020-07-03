<label>Status</label>
@if( !empty($workflow->toArray()) )

  <?php 
    $selected = "";
  ?>

  <select name="status" id="status" class="form-control status-list">
    @foreach($workflow as $w)        
      <option <?php echo $w->id == $status ? 'selected="selected"' : ''; ?> value="{{ $w->id }}">{{ $w->status }}</option>
    @endforeach
  </select>   
@else
  <select name="workflow_id" id="workflow_id" class="form-control">
    <option value="">No status assigned to stage selected</option>
  </select>
@endif
<script>
$(function(){
  $(".status-list").change(function(){
    var status = $(".status-list option:selected").text();
    if( status.toLowerCase() == 'settled' ){
      $(".date-settled-grp").removeClass('hide');
      $("#is_settled").val("Yes");
    }else{
      $(".date-settled-grp").addClass('hide');
      $("#is_settled").val("No");
    }
  });
});  
</script>