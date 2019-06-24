<input type="hidden" name="id" value="<?= Hashids::encode($contact_campaign->id); ?>">
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Campaign Title <span class="required">*</span></label>
      <?php echo Form::text('title', $contact_campaign->title ,['class' => 'form-control', 'required' => '']); ?>
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <label>Status <span class="required"></span></label>
      <select name="status" class="form-control" id="status">
        <option <?php echo $contact_campaign->status == 1 ? 'selected="selected"' : ''; ?> value="1">Active</option>
        <option <?php echo $contact_campaign->status == 2 ? 'selected="selected"' : ''; ?> value="2">Inactive</option>
      </select>                    
    </div>  
  </div>              
</div>   
<!-- /.row --> 

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label><i class="fa fa-calendar"></i> Start Date <span class="required"></span></label>
      <?php echo Form::text('start_date', $contact_campaign->start_date ,['class' => 'form-control', 'id' => 'datepicker_start_date_edit']); ?>                 
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <label><i class="fa fa-calendar"></i> End Date <span class="required"></span></label>
      <?php echo Form::text('end_date', $contact_campaign->end_date ,['class' => 'form-control', 'id' => 'datepicker_end_date_edit']); ?>
    </div>
  </div>              
</div>   
<!-- /.row -->            

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Source <span class="required"></span></label>
      <select name="source_id" class="form-control" id="source_id">
        <option value="0">-</option>
        @foreach($sources as $source)
          <option value="{{ $source->id }}">{{ $source->name }}</option>
        @endforeach              
      </select>                    
    </div>   
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <label>Media Type <span class="required"></span></label>
      <select name="media_type_id" class="form-control" id="media_type_id">
        <option value="0">-</option>
        @foreach($media_types as $media_type)
          <option <?php echo $contact_campaign->media_type_id == $media_type->id ? 'selected="selected"' : ''; ?> value="{{ $media_type->id }}">{{ $media_type->name }}</option>
        @endforeach
      </select>                    
    </div>  
  </div>
</div>         
<!-- /.row --> 

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Campaign Cost <span class="required"></span></label>
      <?php echo Form::number('campaign_cost', $contact_campaign->campaign_cost ,['class' => 'form-control', 'step' => 'any']); ?>
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <label>Purchase Amount <span class="required"></span></label>
      <?php echo Form::number('purchase_amount', $contact_campaign->purchase_amount ,['class' => 'form-control', 'step' => 'any']); ?>
    </div>
  </div>              
</div>   
<!-- /.row -->              

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Priority <span class="required"></span></label>
      <?php echo Form::number('priority', $contact_campaign->priority ,['class' => 'form-control']); ?>                 
    </div>   
  </div>
  <div class="col-md-5">
    <div class="form-group">
      
    </div>
  </div>
</div>        
<!-- /.row -->  

<script>
  $(function () {

    //Date picker
    $('#datepicker_start_date_edit').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
    })  

    $('#datepicker_end_date_edit').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
    })    

  });  
</script>            