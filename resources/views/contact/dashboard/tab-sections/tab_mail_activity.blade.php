<style>
.multi-select .select2{
  width: 100% !important;
}
</style>
<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Email Activity</div>
    <div class="pull-right">
        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalSendEmail">
            <i class="fa fa-plus"></i> Send Email
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
            <select name="search_by_mail" class="form-control select2" style="width: 30%; float: left;">
              <option value="subject" selected="selected">Subject</option>
            </select>
            <input class="form-control" type="text" value="<?php echo $search_field_mail; ?>" name="search_field_mail" placeholder="Default Search" style="width: 70%; float: right;">
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
<ul class="list-mail-messaging">
@foreach($mail_messaging as $e)
  <li>
    <div class="col-md-1"><img src="{{asset('images/email.png')}}" style="height: 80px;"></div>
    <div class="col-md-11">
      <a href="javascript:void(0);" class="mail-messaging-show-content" data-value="<?= $e->id; ?>"><h3>{{ $e->date }} - {{ $e->user->firstname}} {{ $e->user->lastname }}</h3></a>
      <span class="pull-right">Opened : <span class="date-last-opened-container-<?= $e->id; ?>">{{ $e->date_last_opened }}</span></span>
      <small>Subject : {{ $e->subject }}</small><br />
      <small>To : {{ $e->recipient }}</small>
      <div class="email-content-container-<?= $e->id ?> hidden">
        <div class="email-content">
          {!! $e->content !!}
          <br />
          <a class="btn btn-info pull-right mail-messaging-hide-content" data-value="<?= $e->id; ?>" href="javascript:void(0);">Hide</a>
          <div class="clearfix"></div>
        </div>
      </div>
  </div>
    <hr />
  </li>
@endforeach

<div id="modalSendEmail" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => 'mail_messaging/send', 'class' => '', 'id' => 'send-email-form')) }}
    <input type="hidden" value="{{$contact_id}}" name="contact_id" id="contact_id">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Send Email</h4>
      </div>
            <div class="modal-body">
        <div class="form-group multi-select row">
          <label class="col-sm-2 col-form-label">To <span class="required"></span></label>
          <div class="col-sm-10">
            <select class="select_recipient form-control" name="recipient[]" multiple="multiple">
              @foreach($contacts as $c)
                <option value="{{ $c->id }}">{{ $c->email }}</option>
              @endforeach
            </select>                                
          </div>
        </div>
        <div class="form-group multi-select row">
          <label class="col-sm-2 col-form-label">BCC <span class="required"></span></label>
          <div class="col-sm-10">
            <select class="select_recipient form-control" name="bcc[]" multiple="multiple">
              @foreach($contacts as $c)
                <option value="{{ $c->email }}">{{ $c->email }}</option>
              @endforeach
            </select>                                 
          </div>
        </div>
        <div class="form-group multi-select row">
          <label class="col-sm-2 col-form-label">CC <span class="required"></span></label>
          <div class="col-sm-10">
            <select class="select_recipient form-control" name="cc[]" multiple="multiple">
              @foreach($contacts as $c)
                <option value="{{ $c->email }}">{{ $c->email }}</option>
              @endforeach
            </select>                                 
          </div>
        </div> 
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Subject <span class="required"></span></label>
          <div class="col-sm-10">
            <?php echo Form::text('subject', old('subject') ,['class' => 'form-control']); ?>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Email Templates</label>
          <div class="col-sm-10">
            <select class="form-control email-template" name="">
                <option value="0">- Blank -</option>
              @foreach($emailTemplates as $et)
                <option value="{{ $et->id }}">{{ $et->name }}</option>
              @endforeach
            </select>                                 
          </div>
        </div>
        <div class="form-group">
          <label>Message <span class="required">*</span></label>
          <div class="editor-container">
            <?php echo Form::textarea('content', old('content') ,['id' => 'ckeditor', 'class' => 'form-control', 'required' => '']); ?>
          </div>
        </div>
            </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Send</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    {!! Form::close() !!}        
</div>

<script>

  /*
   * NOTE: 
   *    - I transfer the javascript to the main files which is the index.php on contact -> dashboard
   *    - The script must be on the main file, not on the include files kasi isa mag conflict sa ibang script function
   *    - Hindi pwede ma doble yung section page-footer-scripts
  */

  /*$(function () {   
    var base_url = '<?php //echo url('/'); ?>';
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

    $(".email-template").change(function(){
      var email_template_id = $(this).val();
      $('.editor-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
      var url = base_url + '/email_template/ajax_load_email_template_content';
      $.ajax({
           type: "GET",
           url: url,               
           data: {
              "email_template_id":email_template_id
              }, 
           success: function(o)
           {
              $('.editor-container').html(o);
           }
      });
    });
    $('.select_recipient').select2();

    CKEDITOR.replace('ckeditor');

  });*/
</script>


