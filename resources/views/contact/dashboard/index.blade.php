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
  .nav-tabs li{
    background-color:#3c8dbc !important;
    min-width: 8%;
    /*width: 9%;*/
    margin-right: 2px !important;    
    font-size: 13px;
  }
  .nav-tabs li a{
    padding: 10px 10px;
    color: #ffffff !important;
  }
  .nav-tabs li.active{
    background-color: #222D32 !important;
  }
  .nav-tabs li.active a{
    color:#3c8dbc !important;
  }
  .dropdown ul.dropdown-menu li a:hover{
    background-color: #3c8dbc !important;
    color: #ffffff !important;
  }
  .dropdown ul.dropdown-menu li a{
    color: #ffffff !important;
  }
</style>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Contacts : Dashboard
    </h1>
    
    
    <ol class="breadcrumb">
      <li><a href="{{route('contact')}}"><i class="fa fa-dashboard"></i> Contacts</a></li>
      <li class="active">Dashboard</li>
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
            </div>
        @endif          
        
        <div class="box">

          <div class="box-header with-border">                
            <div class="pull-left" style="margin-left: 5px;">
              <input class="form-control" type="text" value="" name="search_field" placeholder="Search" style="">                             
            </div>
            <div class="pull-left" style="margin-left: 5px;">
              <a target="_blank" href="{{route('contact/edit',[$contact_id])}}" class="btn">
                  <i class="fa fa-pencil"></i> Edit Contact
              </a>          
            </div>

            <div class="pull-right">
              <a href="{{route('contact')}}" class="btn btn-primary">Back</a>
            </div>              
          </div>               

          <div class="box-body">
            <div class="row">
              <section class="col-lg-3 connectedSortable ui-sortable">

                  <div class="box box-primary">
                    <div class="box-body box-profile">
                      <h3 class="profile-username text-center">{{ $business_info->business_name }}</h3>
                    </div>

                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Status</td>
                          <td><div class="pull-right"><a href="javascript:void(0);">{{ $contact->stage->name }} - {{ !empty($workflow_status->status) ? $workflow_status->status : '' }}</a></div></td>
                        </tr>
                        <tr>
                          <td colspan="2" style="text-align: center;"><a href="#"><span class="badge badge-primary"><i class="fa fa-pencil"></i> Update Status</span></a></td>
                        </tr>
                      </tbody>
                    </table>   
                  </div>

                  <div class="box box-primary">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Assigned User</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><div class="pull-left">
                            @if(isset($contact->user->firstname) && isset($contact->user->lastname))
                              {{ $contact->user->firstname }} {{ $contact->user->lastname }}
                            @endif
                          </div></td>
                        </tr>
                      </tbody>
                    </table>    
                  </div>

                  <div class="box box-primary">

                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2">Contact Info.</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Name:</td>
                          <td><div class="pull-right">
                            @if(isset($contact->firstname) && isset($contact->lastname))
                              {{ $contact->firstname }} {{ $contact->lastname }}
                            @endif
                          </div></td>
                        </tr>
                        <tr>
                          <td>Email:</td>
                          <td><div class="pull-right">{{ $contact->email }}</div></td>
                        </tr>
                        <tr>
                          <td>Work Number:</td>
                          <td><div class="pull-right">{{ $contact->work_number }}</div></td>
                        </tr>
                        <tr>
                          <td>Mobile Number:</td>
                          <td><div class="pull-right">{{ $contact->mobile_number }}</div></td>
                        </tr>
                        <tr>
                          <td>Address:</td>
                          <td><div style="text-align: right;" class="pull-right">{{ $contact->address1 }}</div></td>
                        </tr>
                        <tr>
                          <td>City</td>
                          <td><div class="pull-right">{{ $contact->city }}</div></td>
                        </tr>
                        <tr>
                          <td>State</td>
                          <td><div class="pull-right">{{ $contact->state }}</div></td>
                        </tr>
                        <tr>
                          <td>Zip</td>
                          <td><div class="pull-right">{{ $contact->zip_code }}</div></td>
                        </tr>
                      </tbody>
                    </table>     
                    
                  </div>                     
              </section>

              <section class="col-lg-9 connectedSortable ui-sortable">
                <div class="nav-tabs-custom contact-dashboard contact-dashboard-tabs">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_history" data-toggle="tab"><i class="fa fa-history"></i> History</a></li>
                    <li class=""><a href="#tab_advances" data-toggle="tab"><i class="fa fa-dollar"></i> Advances</a></li>
                    <li class=""><a href="#tab_calls" data-toggle="tab"><i class="fa fa-phone"></i> Calls</a></li>
                    <li class=""><a href="#tab_emails" data-toggle="tab"><i class="fa fa-envelope-open"></i> Emails</a></li>
                    <li class=""><a href="#tab_notes" data-toggle="tab"><i class="fa fa-list"></i> Notes</a></li>
                    <li class=""><a href="#tab_emarketing" data-toggle="tab"><i class="fa fa-address-card-o"></i> E-Marketing</a></li>
                    <li class=""><a href="#tab_docs" data-toggle="tab"><i class="fa fa-file"></i> Docs</a></li>
                    <li class=""><a href="#tab_events" data-toggle="tab"><i class="fa fa-calendar"></i> Events</a></li>
                    <!-- <li class=""><a href="#tab_bank_accounts" data-toggle="tab"><i class="fa fa-bank"></i> Bank Account</a></li>
                    <li class=""><a href="#tab_credit_card" data-toggle="tab"><i class="fa fa-credit-card"></i> Credit Card</a></li> -->
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Others <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#tab_tasks" data-toggle="tab">Tasks</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#tab_bank_accounts" data-toggle="tab">Bank Account</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#tab_credit_card" data-toggle="tab">Credit Card</a></li>
                      </ul>
                    </li>                
                  </ul>
                
                  <div class="tab-content">
                    <div class="active tab-pane" id="tab_history">
                      <p>Tab History here</p>       
                    </div>
                    <div class="tab-pane" id="tab_advances">
                      <p>Tab Advances Here</p>
                    </div>
                    <div class="tab-pane" id="tab_calls">
                      @include('contact.dashboard.tab-sections.tab_calls')
                    </div>
                    <div class="tab-pane" id="tab_emails">
                      @include('contact.dashboard.tab-sections.tab_mail_activity')
                    </div>
                    <div class="tab-pane" id="tab_notes">
                      @include('contact.dashboard.tab-sections.tab_notes')
                    </div>
                    <div class="tab-pane" id="tab_emarketing">
                      <p>Tab Email Marketing</p>
                    </div>
                    <div class="tab-pane" id="tab_docs">
                      @include('contact.dashboard.tab-sections.tab_docs')
                    </div>
                    <div class="tab-pane" id="tab_events">
                      @include('contact.dashboard.tab-sections.tab_events')
                    </div>
                    <div class="tab-pane" id="tab_tasks">
                      @include('contact.dashboard.tab-sections.tab_tasks')
                    </div>
                    <div class="tab-pane" id="tab_credit_card">
                      @include('contact.dashboard.tab-sections.tab_credit_cards')
                    </div>
                    <div class="tab-pane" id="tab_bank_accounts">
                      @include('contact.dashboard.tab-sections.tab_bank_accounts')
                    </div>
                    <!-- /.tab-pane -->
                  </div>

                  <!-- <div class="box-footer">
                   <p>FOOTER</p>
                  </div>   -->            

                  <!-- /.tab-content -->
                </div>

              </section>
            </div>
          </div>

        </div>   

    </section>
  <!-- /.content -->
@endsection

@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>';

  /*
   * Tabs stay on selected active tab when refreshing - start
  */
  if (location.hash) {
    $('a[href=\'' + location.hash + '\']').tab('show');
  }
  var activeTab = localStorage.getItem('activeTab');
  if (activeTab) {
    $('a[href="' + activeTab + '"]').tab('show');
  }

  $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
    e.preventDefault()
    var tab_name = this.getAttribute('href')
    if (history.pushState) {
      history.pushState(null, null, tab_name)
    }
    else {
      location.hash = tab_name
    }
    localStorage.setItem('activeTab', tab_name)

    $(this).tab('show');
    return false;
  });
  $(window).on('popstate', function () {
    var anchor = location.hash ||
      $('a[data-toggle=\'tab\']').first().attr('href');
    $('a[href=\'' + anchor + '\']').tab('show');
  }); 
  /*
   * Tabs stay on selected active tab when refreshing - start
  */

  var attribute_task_note = $(this).attr("attribute-task-note");

  $(function () {

    
    $('.event_date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    }) 

    $('.due_date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    })     

    $('.timepicker').timepicker({
      showInputs: false
    })

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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('ckeditor');    
    CKEDITOR.replace('note_content');   
    CKEDITOR.replace('task_notes'); 

    <?php foreach($contact_tasks as $task) { ?>
      CKEDITOR.replace('task_notes-<?php echo $task->id; ?>');   
    <?php } ?>

    $('#cc_emails').multiple_emails({position: "bottom"});
    
  });


</script>
@endsection

