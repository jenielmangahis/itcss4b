<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Docs</div>
    <div class="pull-right">
        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddDocs">
            <i class="fa fa-plus"></i> Add Docs
        </a>          
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>

<div class="row">
  {{ Form::open(array('url' => 'contact_dashboard/'.$contact_id, 'class' => '', 'method' => 'get')) }}

    <div class="col-xs-12">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Search By: </label><br />
            <select name="search_by_documents" class="form-control select2" style="width: 30%; float: left;">
              <option value="document_title" selected="selected">Document Title</option>              
            </select>            
            <input class="form-control" type="text" value="<?php echo $search_field_documents; ?>" name="search_field_documents" placeholder="Default Search" style="width: 70%; float: right;">
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="form-group">
            <label>&nbsp;</label><br />
            <button type="submit" class="btn btn-primary">Filter</button>
            <a class="btn btn-success" href="{{url('contact_dashboard/'.$contact_id)}}">Refresh</a>
          </div>
          <!-- /.form-group -->
        </div>
      </div>                

    </div>                      
  {!! Form::close() !!}         
</div>

<table class="table table-bordered table-hover">
  <tr>    
    <th>Document Title</th>
    <th>Date Created</th>
    <th>Created By</th>
    <th style="width:10%;">Action</th>
  </tr>
    @foreach($contactDocs as $doc)
    <tr>
      <td>{{$doc->filename}}</td>
      <td>{{ $doc->created_at }} ?></td>
      <td>{{ $doc->user->firstname }} {{ $doc->user->lastname }}</td>
      <td>
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalEditEvent-<?php echo $calls->id; ?>">
            <i class="fa fa-edit"></i>
        </a>                                                     
      </td>
    </tr>  

      <div id="modalEditEvent-<?php echo $calls->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
          {{ Form::open(array('url' => 'contact_call_tracker/update', 'class' => '', 'id' => 'add-call-log-form')) }}
            <input type="hidden" id="" name="id" value="<?php echo Hashids::encode($calls->id) ?>">
            <div class="modal-dialog modal-lg" style="width: 600px !important;">
              <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Update Call Log</h4>
                </div>
                <div class="modal-body">

                  <div class="row">

                    <div class="col-xs-3">
                      <div class="form-group">
                        <label for="inputCallType">Call Type</label>
                        <select name="call_type" id="call_type" class="form-control">
                          <option <?php echo $calls->call_type == 'Outgoing' ? 'selected="selected"' : ''; ?> value="Outgoing">Outgoing</option>
                          <option <?php echo $calls->call_type == 'Incoming' ? 'selected="selected"' : ''; ?> value="Incoming">Incoming</option>
                        </select>  
                      </div>                
                    </div>
                    <div class="col-xs-4">
                      <div class="form-group">
                        <label for="inputAssignedUser">Call Result</label>
                        <select name="call_result" id="call_result" class="form-control">
                          <option <?php echo $calls->call_result == 'Already in Program' ? 'selected="selected"' : ''; ?> value="Already in Program">Already in Program</option>
                          <option <?php echo $calls->call_result == 'Busy' ? 'selected="selected"' : ''; ?> value="Busy">Busy</option>
                          <option <?php echo $calls->call_result == 'Connected' ? 'selected="selected"' : ''; ?> value="Connected">Connected</option>
                          <option <?php echo $calls->call_result == 'Disconnected' ? 'selected="selected"' : ''; ?> value="Disconnected">Disconnected</option>
                          <option <?php echo $calls->call_result == 'Do Not Contact' ? 'selected="selected"' : ''; ?> value="Do Not Contact">Do Not Contact</option>
                          <option <?php echo $calls->call_result == 'Hang Up' ? 'selected="selected"' : ''; ?> value="Hang Up">Hang Up</option>
                          <option <?php echo $calls->call_result == 'Left Message' ? 'selected="selected"' : ''; ?> value="Left Message">Left Message</option>
                          <option <?php echo $calls->call_result == 'No Answer' ? 'selected="selected"' : ''; ?> value="No Answer">No Answer</option>
                          <option <?php echo $calls->call_result == 'Wrong Number' ? 'selected="selected"' : ''; ?> value="Wrong Number">Wrong Number</option>
                        </select>                   
                      </div>                
                    </div>

                    <div class="col-xs-2">
                      <div class="form-group">
                        <label for="inputTime">Time</label>
                        <input type="text" class="form-control" id="call_minutes" name="call_minutes" value="<?php echo $calls->call_minutes; ?>" placeholder="Call Minutes" title="Call Minutes" required="">
                      </div>                
                    </div>

                    <div class="col-xs-2">
                      <div class="form-group">
                        <label for="inputTime">&nbsp;</label>
                        <input type="text" class="form-control" id="call_seconds" name="call_seconds" value="<?php echo $calls->call_seconds; ?>" placeholder="Call Seconds" title="Call Seconds" required="">
                      </div>                
                    </div>              

                  </div>

                  <div class="row">
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label for="inputNoteAboutThisCall">Notes about this call</label>
                        <textarea rows="4" cols="50" class="form-control" id="notes" name="notes" required=""><?php echo $calls->notes; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row"><div class="col-xs-6"><label>Event Type for this call update status</label></div></div>

                  <div class="row">

                    <div class="col-xs-5">
                      <div class="form-group">
                        <select name="event_type_id" id="event_type_id" class="form-control">
                          @foreach($event_types as $event_type)
                            <option <?php echo $calls->event_type_id == $event_type->id ? 'selected="selected"' : ''; ?> value="{{ $event_type->id }}">{{ $event_type->name }}</option>
                          @endforeach
                        </select>  
                      </div>                
                    </div>
                    <div class="col-xs-3">
                      <div class="form-group">
                        <select name="call_update_status" id="call_update_status" class="form-control">
                          <option <?php echo $calls->call_update_status == 'Opened' ? 'selected="selected"' : ''; ?> value="Opened">Opened</option>
                          <option <?php echo $calls->call_update_status == 'Completed' ? 'selected="selected"' : ''; ?> value="Completed">Completed</option>
                          <option <?php echo $calls->call_update_status == 'Cancelled' ? 'selected="selected"' : ''; ?> value="Cancelled">Cancelled</option>
                          <option <?php echo $calls->call_update_status == 'Dispatched' ? 'selected="selected"' : ''; ?> value="Dispatched">Dispatched</option>
                        </select>                   
                      </div>                
                    </div>

                  </div>

                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default">Update</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

              </div>
            </div>
          {!! Form::close() !!}        
      </div>

    <?php $calls_history_inc++; ?>
    @endforeach 

</table>

<div style="text-align: center;" class="box-footer clearfix">
    {{ $call_log_activity_history->links() }}
</div>

<div style="text-align: center;" class="box-footer clearfix">

</div>


<div id="modalAddDocs" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => 'contact_docs/store', 'class' => '', 'id' => 'add-call-log-form')) }}
      <input type="hidden" id="" name="contact_id" value="<?php echo $contact_id; ?>">
      <div class="modal-dialog modal-lg" style="width: 800px !important;">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Docs</h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="inputTime">Filename</label>
                  <input type="file" class="form-control" id="filename" name="filename" placeholder="Click to Select File" required="">
                </div>                
              </div>
              <div class="col-xs-3">
                <div class="form-group">
                  <label for="inputCallType">Document Type</label>
                  <select name="call_type" id="call_type" class="form-control">
                    <?php foreach($documentTypes as $key => $value){ ?>
                      <option value="<?= $key; ?>"><?= $value; ?></option>
                    <?php } ?>
                  </select>  
                </div>                
              </div>
              <div class="col-xs-5">
                <div class="form-group">
                  <label for="inputTime">Description</label>
                  <input type="text" class="form-control" name="description" required="">
                </div>                
              </div>           

            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Upload</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    {!! Form::close() !!}        
</div>

