<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Email Activity</div>
  </div>
</div>
<ul class="list-mail-messaging">
@foreach($mail_messaging as $e)
  <li>
    <a href="javascript:void(0);" class="mail-messaging-show-content" data-value="<?= $e->id; ?>"><h3>{{ $e->date }} - {!! $e->subject !!}</h3></a>
    <span class="pull-right">Opened : <span class="date-last-opened-container-<?= $e->id; ?>">{{ $e->date_last_opened }}</span></span>
    <small>To : {{ $e->recipient }}</small>
    <div class="email-content-container-<?= $e->id ?> hidden">
      <div class="email-content">
        {!! $e->content !!}
        <br />
        <a class="btn btn-info pull-right mail-messaging-hide-content" data-value="<?= $e->id; ?>" href="javascript:void(0);">Hide</a>
        <div class="clearfix"></div>
      </div>
    </div>
    <hr />
  </li>
@endforeach

@section('page-footer-scripts')
<script>
  $(function(){
    var base_url = '<?php echo url('/'); ?>';
    $(".mail-messaging-show-content").click(function(){
      var data_value = $(this).attr("data-value");
      $(".email-content-container-" + data_value).removeClass("hidden");   
      var url = base_url + '/mail_messaging/ajax_update_last_opened';
      $.ajax({
           type: "GET",
           url: url,
           dataType: 'json',               
           data: {
              "mail_messaging_id":data_value
              }, 
           success: function(o)
           {
              $(".date-last-opened-container-" + data_value).html("<small>Updating...</small>");
              $(".date-last-opened-container-" + data_value).html(o.date_last_opened);
           }
      });

    });

    $(".mail-messaging-hide-content").click(function(){
      var data_value = $(this).attr("data-value");
      $(".email-content-container-" + data_value).addClass("hidden");      
    });
  });
</script>
@endsection

