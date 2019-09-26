@extends('layouts.backend.master')

@section('header-php')
  <?php
  $body_id = '';
  $body_class = '';
  ?>
@endsection 

@section('meta-dynamic')
  <title>coreCMS</title>  
  <meta name="description" content="-">    
@endsection

@section('main')
<style>
.multi-select .select2{
  width: 100% !important;
}
</style>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Contacts Management
    </h1>
    
    <ol class="breadcrumb">
      <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Contacts</a></li>
      <!-- <li class="active">Here</li> -->
    </ol> 

  </section>

  <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->

        @if(Session::has('message'))
            <div class="alert {{ Session::get('alert_class') }}">
              <button type="button" class="close" data-dismiss="alert">&times</button>
              {{ Session::get('message') }}
            </div>
        @endif    

        @if ($errors->any())
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times</button>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div><!--/.alert.alert-danger-->
        @endif {{-- end of @if ($errors->any()) @if ($errors->any()) --}}        
        
        <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                    <div class="pull-left">
                        <a href="{{route('contact/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create New
                        </a>
                    </div>                  
                    <div class="pull-left" style="margin-left: 5px;">
                      <a href="{{route('contact_datasource')}}" class="btn">
                          <i class="fa fa-database"></i> Data Source
                      </a>          
                    </div>
                    <div class="pull-left" style="margin-left: 5px;">
                      <a href="{{route('contact_campaign')}}" class="btn">
                          <i class="fa fa-database"></i> Campaigns
                      </a>          
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                  <div class="row">
                    {{ Form::open(array('url' => 'contact', 'class' => '', 'method' => 'get')) }}

                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Search By: </label><br />
                              <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
                                <option value="name" selected="selected">Name</option>
                                <option value="email" selected="selected">Email</option>
                              </select>
                              <input class="form-control" type="text" value="<?php echo $search_field; ?>" name="search_field" placeholder="Default Search" style="width: 70%; float: right;">
                            </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>&nbsp;</label><br />
                              <button type="submit" class="btn btn-primary">Filter</button>                              
                              <a class="btn btn-success" href="{{route('contact')}}">Refresh</a>
                              <a class="btn btn-success" href="{{route('contact/search_mail_records')}}">Search Mail Records</a>
                            </div>
                            <!-- /.form-group -->
                          </div>
                        </div>                

                      </div>                      
                    {!! Form::close() !!}         
                  </div>

                  <table class="table table-bordered">
                    <tr>
                      <th >#</th>

                      <th>Created</th>
                      <th>Business Name</th>
                      <th>Assigned To</th>
                      <th>Full Name</th>
                      <th>Home Phone</th>
                      <th>Email</th>
                      <th>Stage</th>
                      <th>Status</th>
                      <th>Data Source</th>
                      <th>Actions</th>
                    </tr>
                    @foreach($contact as $con)
                        <?php 
                          $workflow_status = App\Workflow::where('id', '=', $con->status)->first();
                          $business_info   = App\ContactBusinessInformation::where('contact_id', '=', $con->id)->first();

                          $business_name   = '';
                          if( $business_info ){
                            $business_name = $business_info->business_name;
                          }
                        ?>
                        <tr>
                            <td>{{ $con->id }}</td>                            
                            <td>{{ date("F j, Y", strtotime($con->created_at)) }}</td>
                            <td><?= $business_name; ?></td>
                            <!-- <td>-</td> -->
                            @if(isset($con->user->firstname) && isset($con->user->lastname))
                              <td>{{ $con->user->firstname}} {{ $con->user->lastname }}</td>
                            @else
                              <td>-</td>
                            @endif
                            <td><a href="{{url('contact_dashboard/'.Hashids::encode($con->id))}}">{{ $con->firstname }} {{$con->lastname }}</a></td>
                            <td>
                              <a href="javascript:void(0);" class="btn" id="" onclick="javascript:load_activity_history_tab_list('<?php echo  Hashids::encode($con->id); ?>');" data-toggle="modal" data-target="#modalCallTracker">
                                 {{ $con->mobile_number }}
                              </a>                                
                            </td>
                            <td>
                              <a href="javascript:void(0);" data-key="{{ $con->email }}" data-id="{{ $con->id }}" class="btn btn-quick-send-modal" id="" data-toggle="modal" data-target="#modalSendEmail">
                                {{ $con->email }}
                              </a>
                            </td>
                            <td>{{  !empty($con->stage->name) ? $con->stage->name : '-' }}</td>
                            <td>{{ !empty($workflow_status->status) ? $workflow_status->status : '-' }}</td>
                            <td>{{ isset($con->data_source) ? $con->data_source : 'Form Fill' }}</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDelete-<?= $con->id; ?>" >
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                <a href="{{route('contact/edit',[Hashids::encode($con->id)])}}" class="btn btn-xs btn-primary">
                                    <i class="fa fa-edit"></i> Edit
                                </a> 
                                <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="javascript:load_update_status_field('<?php echo $con->id; ?>')" id="edit-modal-status-<?php echo $con->id; ?>" data-toggle="modal" data-target="#modalEdit">
                                    <i class="fa fa-edit"></i> Status
                                </a>                                                            
                            </td>
                        </tr>

                        <div id="modalDelete-<?= $con->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete selected contact?
                                </div>
                                <div class="modal-footer">
                                  {{ Form::open(array('url' => 'contact/destroy')) }}
                                    <?php echo Form::hidden('id', Hashids::encode($con->id) ,[]); ?>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                  {!! Form::close() !!}
                                </div>

                              </div>
                            </div>
                        </div>   

                    @endforeach
                  </table>

                  <div id="modalEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                      {{ Form::open(array('url' => 'contact/update_status', 'class' => '', 'id' => 'edit-contact-status-form')) }}
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel">Edit Status</h4>
                            </div>
                            <div class="modal-body">
                              <div id="stage-status-container"></div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-default">Update</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>

                          </div>
                        </div>
                      {!! Form::close() !!}        
                  </div>

                  <div id="modalCallTracker" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">                     
                      {{ Form::open(array('url' => 'contact_call_tracker/store', 'class' => '', 'id' => 'call-log-activity-form')) }}
                        <input type="hidden" value="" name="contact_id" id="contact_id" class="contact_id_add_modal">
                        <div class="modal-dialog modal-lg" style="width: 1000px !important;">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel">Call Log Activity</h4>
                            </div>
                            <div class="modal-body">

                              <div class="row">
                              <section class="col-lg-5 connectedSortable ui-sortable">
                                {{ Form::open(array('url' => 'contact_call_tracker/store', 'class' => '', 'id' => 'add-call-tracker')) }}
                                <div class="row">

                                  <div class="col-xs-3">
                                    <div class="form-group">
                                      <label for="inputcalltype">Type</label>
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

                                <div class="row"><div class="col-xs-12"><label>Event Type for this call update status</label></div></div>

                                <div class="row">

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <select name="event_type_id" id="event_type_id" class="form-control">
                                        @foreach($event_types as $event_type)
                                          <option value="{{ $event_type->id }}">{{ $event_type->name }}</option>
                                        @endforeach
                                      </select>  
                                    </div>                
                                  </div>
                                  <div class="col-xs-5">
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

                                <div class="row">
                                  <div class="col-xs-12">
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-default">Add</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> 
                                    </div>  
                                  </div>                               
                                </div>    
                                {!! Form::close() !!}                     
                              </section>

                              <section class="col-lg-7 connectedSortable ui-sortable">

                              @if(Session::has('message'))
                                  <div class="alert {{ Session::get('alert_class') }}">
                                    <button type="button" class="close" data-dismiss="alert">&times</button>
                                    {{ Session::get('message') }}
                                  </div>
                              @endif    

                              @if ($errors->any())
                                <div class="alert alert-danger">
                                  <button type="button" class="close" data-dismiss="alert">&times</button>
                                  <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                  </ul>
                                </div><!--/.alert.alert-danger-->
                              @endif {{-- end of @if ($errors->any()) @if ($errors->any()) --}}  

                                <div class="nav-tabs-custom contact-dashboard">
                                  <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_activity_history" data-toggle="tab">Activity History</a></li>
                                    <li class=""><a href="#tab_followup_call" data-toggle="tab">Followup Call</a></li>              
                                  </ul>

                                  <div class="tab-content">
                                    <div class="active tab-pane" id="tab_activity_history">

                                      <div id="activity-history-tab-list-container"></div>

                                      <div style="text-align: center;" class="box-footer clearfix">

                                      </div>
      
                                    </div>
                                    
                                    <div class="tab-pane" id="tab_followup_call">
                                      {{ Form::open(array('url' => 'contact_call_tracker/store_followup', 'class' => '', 'id' => 'call-log-followup-form')) }}
                                      <input type="hidden" name="event_date" id="event_date" class="event_date" value="">
                                      <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="">
                                      <div class="row">
                                        <section class="col-lg-7 connectedSortable ui-sortable" style="text-align: center;">
                                          <label for="inputNoteAboutThisCall">When</label>
                                          <div class="when-calendar"></div>
                                        </section>
                                        <section class="col-lg-5 connectedSortable ui-sortable">
                                          <div class="row">
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label for="inputNoteAboutThisCall">Assigned to: </label>
                                                <div id="user-assigned-to-container" class="user-assigned-to-container"></div>                                                 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label for="inputNoteAboutThisCall">Event Type </label>
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
                                          </div>
                                          <div class="row">
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label for="inputNoteAboutThisCall">Time: </label>
                                                <input type="text" name="event_time" id="event_time" class="form-control timepicker" value="">                                                 
                                              </div>
                                            </div>
                                          </div>                                          
                                          <div class="row">
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <textarea rows="4" cols="50" class="form-control" id="description" name="description" required=""></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <button type="submit" class="btn btn-default">Save Call</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>                                                                                           
                                              </div>
                                            </div>
                                          </div>                                           
                                        </section>                                          
                                      </div>
                                      {!! Form::close() !!}        
                                    </div>
                                  </div>                                 
                                </div>
                              </section>
                              </div>

                            </div>

                            <!-- <div class="modal-footer">
                              <button type="submit" class="btn btn-default" disabled>Add</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div> -->

                          </div>
                        </div>
                      {!! Form::close() !!}        
                  </div>                  

                </div>
                <!-- /.box-body -->

                <div style="text-align: center;" class="box-footer clearfix">
                    {{ $contact->links() }}
                </div>

              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>

    <div id="modalSendEmail" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
        {{ Form::open(array('url' => 'mail_messaging/send', 'class' => '', 'id' => 'send-email-form')) }}
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
                <select class="select_recipient_to form-control" name="recipient[]" multiple="multiple">
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
  <!-- /.content -->
@endsection

<?php 
  $call_track_modal = 'no';
  if ($errors->any()) {
    $call_track_modal = 'yes';
  }
?>

@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>';

  function load_update_status_field(id) {
    $('#stage-status-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
    var url = base_url + '/contact/ajax_load_update_status'
    $.ajax({
         type: "GET",
         url: url,               
         data: {"id":id}, 
         success: function(o)
         {
            $('#stage-status-container').html(o);
         }
    });
  }  

  function load_assigned_to_users(id) {
    $('#user-assigned-to-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
    var url = base_url + '/contact_call_tracker/ajax_followup_call_user_dropdown'
    $.ajax({
         type: "GET",
         url: url,               
         data: {"id":id}, 
         success: function(o)
         {
            $('#user-assigned-to-container').html(o);
         }
    });    
  }

  function load_activity_history_tab_list(id) {
    load_assigned_to_users(id);
    $('#activity-history-tab-list-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
    $('.contact_id_add_modal').val(id);
    $('.contact_id').val(id);
    var url = base_url + '/contact_call_tracker/ajax_loadactivity_history_tab_list'
    $.ajax({
         type: "GET",
         url: url,               
         data: {"id":id}, 
         success: function(o)
         {
            $('#activity-history-tab-list-container').html(o);
         }
    });  
  }
  $(function () { 
    $('.select_recipient').select2();
    $('.select_recipient_to').select2();

    $(".btn-quick-send-modal").click(function(){
      var email_selected = $(this).attr("data-key");
      var contact_id = $(this).attr("data-id");
      $(".select_recipient_to").select2("val", contact_id);
      //$('.select_recipient_to').select2('data', {id: 11, text: 'test@test.com'});      
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

    <?php if(Session::get('calltrackermodal') == 'yes') { ?>
      load_activity_history_tab_list('<?php echo Session::get('calltrackercontactid'); ?>'); 
      $('#modalCallTracker').modal('show'); 
    <?php }elseif($call_track_modal == 'yes') { ?>
      load_activity_history_tab_list('<?php echo Session::get('calltrackercontactid'); ?>'); 
      $('#modalCallTracker').modal('show');
    <?php } ?>

    $('.when-calendar').pignoseCalendar({
      theme: 'blue',
      select: function(date) {
        $('#event_date').val(date[0]);
      }
    }); 

    $('.timepicker').timepicker({
      showInputs: false
    })       

    CKEDITOR.replace('ckeditor');
    
  });
  
</script>
@endsection