

<div class="no-print">
  <div class="callout callout-info" style="margin-bottom: 0!important;">
    <h4><i class="fa fa-info"></i> Upcoming Events:</h4>
    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
  </div>
</div>

<br />

<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Calendar Events</div>
    <div class="pull-right">
        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddEvent">
            <i class="fa fa-plus"></i> Add Event
        </a>          
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>

<div class="row">
  {{ Form::open(array('url' => 'contact', 'class' => '', 'method' => 'get')) }}

    <div class="col-xs-12">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Search By: </label><br />
            <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
              <option value="title" selected="selected">Title</option>
            </select>
            <input class="form-control" type="text" value="<?php //echo $search_field; ?>" name="search_field" placeholder="Default Search" style="width: 70%; float: right;">
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="form-group">
            <label>&nbsp;</label><br />
            <button type="submit" class="btn btn-primary">Filter</button>
            <a class="btn btn-success" href="{{route('contact')}}">Refresh</a>
          </div>
          <!-- /.form-group -->
        </div>
      </div>                

    </div>                      
  {!! Form::close() !!}         
</div>

<table class="table table-bordered table-hover">
  <tr>
    <th style="width: 1%;" >#</th>
    <th>Title</th>
    <th>Date & Time</th>
    <th>Assigned To</th>
    <th>Type</th>
    <th>Description</th>
    <th style="width:10%;">Action</th>
  </tr>
  @foreach($contact_events as $event)
    <tr>
      <td>{{ $event->id }}</td>
      <td>{{ $event->title }}</td>
      <td>{{ $event->event_date }} {{ $event->event_time }}</td>
      <td>{{ $event->user->firstname }} {{ $event->user->lastname }}</td>
      
      <td>{{ $event->type }}</td>
      <td>{{ $event->description }}</td>
      <td>
         -                                                            
      </td>
    </tr>  
  @endforeach
</table>


<div id="modalAddEvent" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => 'contact_event/store', 'class' => '', 'id' => 'add-event-form')) }}
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Event</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="inputTitle">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
            </div>

            <div class="row">
              <div class="col-xs-3">
                <div class="form-group">
                  <label for="inputDate">Date</label>
                  <input type="text" class="form-control event_date" id="event_date" name="event_date" placeholder="">
                </div>                
              </div>
              <div class="col-xs-3">
                <div class="form-group">
                  <label for="inputTime">Time</label>
                  <input type="text" class="form-control timepicker" id="event_time" name="event_time" placeholder="">
                </div>                
              </div>
              <div class="col-xs-3">
                <div class="form-group">
                  <label for="inputEventType">Event Type</label>
                  <select name="event_type_id" id="event_type_id" class="form-control">
                    @if( !empty($event_types->toArray()) )
                      @foreach($event_types as $et)   
                        <option value="{{ $et->id }}">{{ $et->name }}</option>
                      @endforeach
                    @else
                      <select name="event_type_id" id="event_type_id" class="form-control">
                        <option value="">No event type available</option>
                      </select>
                    @endif
                  </select>  
                </div>                
              </div>
              <div class="col-xs-3">
                <div class="form-group">
                  <label for="inputAssignedUser">Assigned User</label>
                  <select name="user_id" id="user_id" class="form-control">
                    @if( !empty($company_users->toArray()) )
                      @foreach($company_users as $company_user)   
                        <option value="{{ $company_user->user_id }}">{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</option>
                      @endforeach
                    @else
                      <select name="user_id" id="user_id" class="form-control">
                        <option value="">No company users available</option>
                      </select>
                    @endif
                  </select>                   
                </div>                
              </div>
            </div>

            <div class="form-group">
              <label for="inputLocation">Location</label>
              <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location">
            </div>

            <div class="form-group">
              <label for="inputDescription">Description</label>
              <textarea rows="4" cols="50" class="form-control" id="description" name="description"></textarea>
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

