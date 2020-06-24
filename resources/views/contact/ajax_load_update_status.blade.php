<input type="hidden" id="id" value="<?php echo Hashids::encode($contact->id) ?>" name="id">
<input type="hidden" id="is_settled" name="is_settled" value="<?= $contact->is_settled; ?>">
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
    </div>

    </div>
  </div>
</div>
<?php 
  $date_settled = $contact->date_settled;          
  $class_date_settled = "hide";
  if( strtolower($contact->is_settled) == 'yes' ){
    $class_date_settled = '';
  }
?>
<div class="row <?= $class_date_settled; ?> date-settled-grp">
  <div class="col-md-5">
    <div class="form-group">
      <label>Date Settled</label>
      <?php echo Form::text('date_settled', $date_settled ,['class' => 'form-control date_settled']); ?>
    </div>
  </div>
</div>

<script>
  
  function load_stage_status_dropdown(status) {
    var stage_id = $('#stage_id').val();
    $('#stage-status-dropdown-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');

    $(".date-settled-grp").addClass("hide");
    $("#is_settled").val("No");

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

  $('.date_settled').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
  });
  
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

</script>