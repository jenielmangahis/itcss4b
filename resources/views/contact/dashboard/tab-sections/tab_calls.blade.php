


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
    <tr>
      <td>01</td>
      <td>Jeniel Mangahis on Julay 01, 2019</td>
      <td>Out Going</td>
      <td>
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalEditEvent">
            <i class="fa fa-edit"></i>
        </a>                                                     
      </td>
    </tr>  

</table>

<div style="text-align: center;" class="box-footer clearfix">

</div>


<div id="modalAddCallLog" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => '', 'class' => '', 'id' => 'add-call-log-form')) }}
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
                  <label for="inputEventType">Call Type</label>
                  <select name="event_type_id" id="event_type_id" class="form-control">
                    <option value="">Outgoing</option>
                    <option value="">Incoming</option>
                  </select>  
                </div>                
              </div>
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="inputAssignedUser">Call Result</label>
                  <select name="event_type_id" id="event_type_id" class="form-control">
                    <option value="">Already in Program</option>
                    <option value="">Connected</option>
                    <option value="">Disconnected</option>
                    <option value="">Do Not Contact</option>
                    <option value="">Hang Up</option>
                    <option value="">Left Message</option>
                    <option value="">No Answer</option>
                    <option value="">Wrong Number</option>
                  </select>                   
                </div>                
              </div>

              <div class="col-xs-2">
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
              </div>

            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="inputNoteAboutThisCall">Notes about this call</label>
                  <textarea rows="4" cols="50" class="form-control" id="description" name="description" required=""></textarea>
                </div>
              </div>
            </div>

            <div class="row"><div class="col-xs-6"><label>Event Type for this call update status</label></div></div>

            <div class="row">

              <div class="col-xs-5">
                <div class="form-group">
                  <select name="event_type_id" id="event_type_id" class="form-control">
                    <option value="">Follow up Client</option>
                    <option value="">Setup a Meeting</option>
                    <option value="">+Add Another One</option>
                  </select>  
                </div>                
              </div>
              <div class="col-xs-3">
                <div class="form-group">
                  <select name="user_id" id="user_id" class="form-control">
                    <option value="">Opened</option>
                    <option value="">Completed</option>
                    <option value="">Cancelled</option>
                    <option value="">Dispatched</option>
                  </select>                   
                </div>                
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default" disabled>Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    {!! Form::close() !!}        
</div>

