<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Legal Scrub</div>    
  </div>
</div>
{{ Form::open(array('url' => 'contact_note/update_legal_scrub', 'class' => '')) }}
  <input type="hidden" id="" name="contact_id" value="<?php echo $contact_id; ?>">
  <div class="box-body">
    <div class="row">
      <div class="col-sm-10">
        <?php //echo Form::textarea('legal_scrub', $lscrub ,['id' => 'ck_legal_scrub', 'class' => 'form-control', 'required' => '']); ?>
        <textarea rows="4" cols="50" class="form-control" id="legal_note" name="legal_note" required="">{{ $lscrub }}</textarea>
      </div>
    </div>
  </div>  
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-success">Update Legal Scrub</button>
  </div>
{!! Form::close() !!}
</div>