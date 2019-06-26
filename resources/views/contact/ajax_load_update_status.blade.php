<input type="hidden" id="id" value="<?php echo Hashids::encode($contact->id) ?>" name="id">
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Stage <span class="required"></span></label>
      <select name="stage_id" onchange="javascript:load_stage_status_dropdown('<?php echo $contact->status; ?>');" class="form-control" id="stage_id">
        @foreach($stages as $stage)
        <option <?php echo $contact->stage_id == $stage->id ? 'selected="selected"' : ''; ?> value="{{ $stage->id }}">{{ $stage->name }}</option>
        @endforeach
      </select>                    
    </div>   
  </div>
  <div class="col-md-5">
    <div class="form-group">

    <div id="stage-status-dropdown-container">
      <label>Status</label>
      @if( !empty($workflow->toArray()) )

        <select name="status" id="status" class="form-control">
          @foreach($workflow as $w)        
            <option <?php echo $w->id == $status ? 'selected="selected"' : ''; ?> value="{{ $w->id }}">{{ $w->status }}</option>
          @endforeach
        </select>   
      @else
        <select name="workflow_id" id="workflow_id" class="form-control">
          <option value="">No status assigned to stage selected</option>
        </select>
      @endif      
    </div>

    </div>
  </div>
</div>

<script>
  
  function load_stage_status_dropdown(status) {
    var stage_id = $('#stage_id').val();
    $('#stage-status-dropdown-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');

    var url = base_url + '/contact/ajax_load_stage_status'
    $.ajax({
         type: "GET",
         url: url,               
         data: {"stage_id":stage_id,"status":status}, 
         success: function(o)
         {
            $('#stage-status-dropdown-container').html(o);
         }
    });
  }    

</script>