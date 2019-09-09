
@if(!$todays_events->isEmpty()) 
  <div class="no-print today-events-container" id="today-events-container">
    <div class="callout callout-info" style="margin-bottom: 0!important; background-color: #2fef00 !important;">
      <h4><i class="fa fa-info"></i> Today Events:</h4>
      <ul>
        @if($todays_events)
          @foreach($todays_events as $tv)
          <li>{{ $tv->title }} : {{ date("F j, Y", strtotime($tv->event_date)) }} {{ date("g:i a", strtotime($tv->event_time)) }} ( Assigned to: {{ $tv->user->firstname }} {{ $tv->user->lastname }})</li>
          @endforeach
        @else
          <li>No Events.</li>
        @endif
      </ul>
      
    </div>
  </div>
  <br />
@endif

<div class="no-print">
  <div class="callout callout-info" style="margin-bottom: 0!important;">
    <h4><i class="fa fa-info"></i> Upcoming Events:</h4>
    <ul>
      @if(!$upcoming_events->isEmpty()) 
        @foreach($upcoming_events as $uv)
        <li>{{ $uv->title }} : {{ date("F j, Y", strtotime($uv->event_date)) }} {{ date("g:i a", strtotime($uv->event_time)) }} ( Assigned to: {{ $uv->user->firstname }} {{ $uv->user->lastname }})</li>
        @endforeach
      @else
        <li>No Upcoming Events.</li>
      @endif
    </ul>
    
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
  {{ Form::open(array('url' => 'contact_dashboard/'.$contact_id, 'class' => '', 'method' => 'get')) }}
    <input type="hidden" value="{{$contact_id}}" name="contact_id" id="contact_id">
    <div class="col-xs-12">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Search By: </label><br />
            <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
              <option value="title" selected="selected">Title</option>
            </select>
            <input class="form-control" type="text" value="<?php echo $search_field_event; ?>" name="search_field" placeholder="Default Search" style="width: 70%; float: right;">
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
      <td>{{ date("F j, Y", strtotime($event->event_date)) }} {{ date("g:i a", strtotime($event->event_time)) }}</td>
      <td>{{ $event->user->firstname }} {{ $event->user->lastname }}</td>
      <td>{{ $event->event_type->name }}</td>
      <td>{{ $event->description }}</td>
      <td>
        <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDeleteEvent-<?= $event->id; ?>">
            <i class="fa fa-trash"></i>
        </a>
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalEditEvent-<?= $event->id; ?>">
            <i class="fa fa-edit"></i>
        </a>                                                     
      </td>
    </tr>  

    <div id="modalDeleteEvent-<?= $event->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Delete</h4>
            </div>
            <div class="modal-body">
              Are you sure you want to delete selected event?
            </div>
            <div class="modal-footer">
              {{ Form::open(array('url' => 'contact_event/destroy')) }}
                <?php echo Form::hidden('id', Hashids::encode($event->id) ,[]); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
              {!! Form::close() !!}
            </div>

          </div>
        </div>
    </div>  

    <div id="modalEditEvent-<?= $event->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
        {{ Form::open(array('url' => 'contact_event/update', 'class' => '', 'id' => 'edit-event-form')) }}
          <input type="hidden" name="id" value="<?= Hashids::encode($event->id); ?>">
          <input type="hidden" value="{{$contact_id}}" name="contact_id" id="contact_id">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Update Event</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="inputTitle">Title</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" placeholder="Enter Title" required="">
                </div>

                <div class="row">
                  <div class="col-xs-3">
                    <div class="form-group">
                      <label for="inputDate">Date</label>
                      <input type="text" class="form-control event_date" id="event_date" required="" value="{{ $event->event_date }}" name="event_date" placeholder="">
                    </div>                
                  </div>
                  <div class="col-xs-3">
                    <div class="form-group">
                      <label for="inputTime">Time</label>
                      <input type="text" class="form-control timepicker" id="event_time" name="event_time" value="{{ $event->event_time }}" placeholder="">
                    </div>                
                  </div>
                  <div class="col-xs-3">
                    <div class="form-group">
                      <label for="inputEventType">Event Type</label>
                      <select name="event_type_id" id="event_type_id" class="form-control">
                        @if( !empty($event_types->toArray()) )
                          @foreach($event_types as $et)   
                            <option <?php echo $et->id == $event->event_type_id ? 'selected="selected"' : ''; ?> value="{{ $et->id }}">{{ $et->name }}</option>
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
                            <option <?php echo $company_user->user_id == $event->user_id ? 'selected="selected"' : ''; ?> value="{{ $company_user->user_id }}">{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</option>
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
                  <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}" placeholder="Enter Location">
                </div>

                <div class="form-group">
                  <label for="inputDescription">Description</label>
                  <textarea rows="4" cols="50" class="form-control" id="description" required="" name="description">{{ $event->description }}</textarea>
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

  @endforeach
</table>

<div style="text-align: center;" class="box-footer clearfix">
    {{ $contact_events->links() }}
</div>


<div id="modalAddEvent" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => 'contact_event/store', 'class' => '', 'id' => 'add-event-form')) }}
    <input type="hidden" value="{{$contact_id}}" name="contact_id" id="contact_id">
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
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required="">
            </div>

            <div class="row">
              <div class="col-xs-3">
                <div class="form-group">
                  <label for="inputDate">Date</label>
                  <input type="text" class="form-control event_date" id="event_date" name="event_date" placeholder="" required="">
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
              <textarea rows="4" cols="50" class="form-control" id="description" name="description" required=""></textarea>
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

