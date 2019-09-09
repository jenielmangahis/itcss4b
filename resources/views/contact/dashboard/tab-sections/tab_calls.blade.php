


<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Call History</div>
    <div class="pull-right">
        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddCallLog">
            <i class="fa fa-plus"></i> Add Call Logs
        </a>          
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>

<!-- <div class="row">

    <div class="col-xs-12">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Search By: </label><br />
            <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
              <option value="title" selected="selected">Title</option>
            </select>
            <input class="form-control" type="text" value="" name="search_field" placeholder="Default Search" style="width: 70%; float: right;">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>&nbsp;</label><br />
            <button type="submit" class="btn btn-primary">Filter</button>
            <a class="btn btn-success" href="{{url('contact_dashboard/'.$contact_id)}}">Refresh</a>
          </div>
        </div>
      </div>                

    </div>                      

</div> -->

<table class="table table-bordered table-hover">
  <tr>
    <th style="width: 1%;" >#</th>
    <th>Calls</th>
    <th>Call Type</th>
    <th style="width:10%;">Action</th>
  </tr>
    <?php $calls_history_inc = 1; ?>
    @foreach($call_log_activity_history as $calls)
    <tr>
      <td>{{$calls_history_inc}}</td>
      <td>{{ $calls->contact->firstname }} {{ $calls->contact->lastname }} on <?php echo date('F j, Y, g:i a', strtotime($calls->created_at)) ?></td>
      <td>{{ $calls->call_type }}</td>
      <td>
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalEditEvent-<?php echo $calls->id; ?>">
            <i class="fa fa-edit"></i>
        </a>                                                     
      </td>
    </tr>  

      <div id="modalEditEvent-<?php echo $calls->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
          {{ Form::open(array('url' => 'contact_call_tracker/update', 'class' => '', 'id' => 'add-call-log-form')) }}
            <input type="hidden" id="" name="contact_id" value="<?php echo $contact_id; ?>">
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


<div id="modalAddCallLog" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => 'contact_call_tracker/store', 'class' => '', 'id' => 'add-call-log-form')) }}
      <input type="hidden" id="" name="contact_id" value="<?php echo $contact_id; ?>">
      <div class="modal-dialog modal-lg" style="width: 600px !important;">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Call Log</h4>
          </div>
          <div class="modal-body">

            <div class="row">

              <div class="col-xs-3">
                <div class="form-group">
                  <label for="inputCallType">Call Type</label>
                  <select name="call_type" id="call_type" class="form-control">
                    <option value="Outgoing">Outgoing</option>
                    <option value="Incoming">Incoming</option>
                  </select>  
                </div>                
              </div>
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="inputAssignedUser">Call Result</label>
                  <select name="call_result" id="call_result" class="form-control">
                    <option value="Already in Program">Already in Program</option>
                    <option value="Busy">Busy</option>
                    <option value="Connected">Connected</option>
                    <option value="Disconnected">Disconnected</option>
                    <option value="Do Not Contact">Do Not Contact</option>
                    <option value="Hang Up">Hang Up</option>
                    <option value="Left Message">Left Message</option>
                    <option value="No Answer">No Answer</option>
                    <option value="Wrong Number">Wrong Number</option>
                  </select>                   
                </div>                
              </div>

              <!-- <div class="col-xs-2">
                <div class="form-group">
                  <label for="inputTime">Time</label>
                  <input type="text" class="form-control timepicker" id="event_time" name="event_time" placeholder="">
                </div>                
              </div>

              <div class="col-xs-2">
                <div class="form-group">
                  <label for="inputTime">&nbsp;</label>
                  <input type="text" class="form-control timepicker" id="event_time" name="event_time" placeholder="">
                </div>                
              </div> -->

              <div class="col-xs-2">
                <div class="form-group">
                  <label for="inputTime">Time</label>
                  <input type="text" class="form-control" id="call_minutes" name="call_minutes" placeholder="Call Minutes" title="Call Minutes" required="">
                </div>                
              </div>

              <div class="col-xs-2">
                <div class="form-group">
                  <label for="inputTime">&nbsp;</label>
                  <input type="text" class="form-control" id="call_seconds" name="call_seconds" placeholder="Call Seconds" title="Call Seconds" required="">
                </div>                
              </div>              

            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="inputNoteAboutThisCall">Notes about this call</label>
                  <textarea rows="4" cols="50" class="form-control" id="notes" name="notes" required=""></textarea>
                </div>
              </div>
            </div>

            <div class="row"><div class="col-xs-6"><label>Event Type for this call update status</label></div></div>

            <div class="row">

              <div class="col-xs-5">
                <div class="form-group">
                  <select name="event_type_id" id="event_type_id" class="form-control">
                    @foreach($event_types as $event_type)
                      <option value="{{ $event_type->id }}">{{ $event_type->name }}</option>
                    @endforeach
                  </select>  
                </div>                
              </div>
              <div class="col-xs-3">
                <div class="form-group">
                  <select name="call_update_status" id="call_update_status" class="form-control">
                    <option value="Opened">Opened</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Dispatched">Dispatched</option>
                  </select>                   
                </div>                
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    {!! Form::close() !!}        
</div>

