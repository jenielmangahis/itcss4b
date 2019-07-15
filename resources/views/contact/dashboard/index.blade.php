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

        <div class="row">
          <div class="col-md-12">
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
              </div>

            </div>

          </div>

        </div>        
        
        <div class="col-md-3">

          <div class="box box-primary">

            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> {{ $business_info->business_name }}</strong>

              <p class="text-muted">
                Status: <strong>{{ $contact->stage->name }} - {{ !empty($workflow_status->status) ? $workflow_status->status : '' }}</strong>
              </p>
              <a href="#"><span class="badge badge-primary"><i class="fa fa-pencil"></i> Update Status</span></a>
              <hr>

              <p><strong>Assigned User</strong></p>
              <ul class="list-group list-group-unbordered" style="padding-left: 7px !important;">
                <li class="list-group-item">
                  @if(isset($contact->user->firstname) && isset($contact->user->lastname))
                    <p>{{ $contact->user->firstname }} {{ $contact->user->lastname }}</p>
                  @endif
                </li>
              </ul>       

              <p><strong>Contact Information</strong></p>
              <ul class="list-group list-group-unbordered" style="padding-left: 7px !important;">
                <li class="list-group-item">
                  @if(isset($contact->firstname) && isset($contact->lastname))
                    <b>Name: </b><p>{{ $contact->user->firstname }} {{ $contact->user->lastname }}</p>
                  @endif
                </li>
                <li class="list-group-item">
                  <b>Email:</b> <p>{{ $contact->user->email }}</p>
                </li>
                <li class="list-group-item">
                  <b>Work Number:</b> <p>{{ $contact->work_number }}</p>
                </li>
                <li class="list-group-item">
                  <b>Mobile Number:</b> <p>{{ $contact->mobile_number }}</p>
                </li>
                <li class="list-group-item">
                  <b>Address:</b> <p>{{ $contact->address1 }}</p>
                </li>
                <li class="list-group-item">
                  <b>City:</b> <p>{{ $contact->city }}</p>
                </li>
                <li class="list-group-item">
                  <b>State:</b> <p>{{ $contact->state }}</p>
                </li>
                <li class="list-group-item">
                  <b>Zip:</b> <p>{{ $contact->zip_code }}</p>
                </li>
              </ul>        

            </div>

          </div>

        </div>

          <div class="col-md-9">

            <div class="nav-tabs-custom contact-dashboard">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_history" data-toggle="tab">History</a></li>
                <li class=""><a href="#tab_advances" data-toggle="tab">Advances</a></li>
                <li class=""><a href="#tab_calls" data-toggle="tab">Calls</a></li>
                <li class=""><a href="#tab_emails" data-toggle="tab">Emails</a></li>
                <li class=""><a href="#tab_notes" data-toggle="tab">Notes</a></li>
                <li class=""><a href="#tab_emarketing" data-toggle="tab">E-Marketing</a></li>
                <li class=""><a href="#tab_docs" data-toggle="tab">Docs</a></li>
                <li class=""><a href="#tab_events" data-toggle="tab">Events</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Others <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#tab_tasks" data-toggle="tab">Tasks</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#tab_credit_card" data-toggle="tab">Credit Card</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#tab_bank_accounts" data-toggle="tab">Bank Accounts</a></li>
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
                  <p>Tab Calls Here</p>
                </div>
                <div class="tab-pane" id="tab_emails">
                  <p>Tab Emails Here</p>
                </div>
                <div class="tab-pane" id="tab_notes">
                  <p>Tab Notes</p>
                </div>
                <div class="tab-pane" id="tab_emarketing">
                  <p>Tab Email Marketing</p>
                </div>
                <div class="tab-pane" id="tab_docs">
                  <p>Tab Docs</p>
                </div>
                <div class="tab-pane" id="tab_events">
                  @include('contact.dashboard.tab-sections.tab_events')
                </div>
                <div class="tab-pane" id="tab_tasks">
                  <p>Tab Tasks</p>
                </div>
                <div class="tab-pane" id="tab_credit_card">
                  <p>Tab Credit Card</p>
                </div>
                <div class="tab-pane" id="tab_bank_accounts">
                  <p>Tab Bank Accounts</p>
                </div>
                <!-- /.tab-pane -->
              </div>

              <!-- <div class="box-footer">
               <p>FOOTER</p>
              </div>   -->            

              <!-- /.tab-content -->
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

   

  
</script>
@endsection

