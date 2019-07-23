<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Email Activity</div>
  </div>
</div>
<ul class="list-mail-messaging">
@foreach($mail_messaging as $e)
  <li>
    <h3>{{ $e->date }} - {{ $e->subject }}</h3>
    <small>To : {{ $e->recipient }}</small>
  </li>
@endforeach

