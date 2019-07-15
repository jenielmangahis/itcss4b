<div class="pull-left calendar-events-title">Calendar Events</div>
<div class="pull-right">
    <a href="#" class="btn btn-primary">
        <i class="fa fa-plus"></i> Add Event
    </a>
    <a href="javascript:location.reload();" class="btn btn-primary">
        <i class="fa fa-refresh"></i>
    </a>
</div>

<br /><br /><br />
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
        <td>{{$event->title}}</td>
        <td>{{ $event->event_date }}</td>
        <td>{{ $event->user->firstname }} {{ $event->user->lastname }}</td>
        <td>-</td>
        <td>{{ $event->user->title }}</td>
        <td>{{ $event->user->description }}</td>
        <td>
           -                                                            
        </td>
    </tr>  
  @endforeach
</table>