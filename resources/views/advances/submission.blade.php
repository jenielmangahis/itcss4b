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
      Edit Advance - {{ $contact->company->name }}
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
            <div class="pull-right">
              <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
            </div>              
          </div>               

          <div class="box-body">
            <div class="row">
              <section class="col-lg-3 connectedSortable ui-sortable">
                @include('advances.includes.side_menu')
              </section>

              <section class="col-lg-9 connectedSortable ui-sortable">

                @include('advances.includes.summary_block')

                {{ Form::open(array('url' => 'contact_advance/update_advance', 'class' => 'edit-advance-form-sub', 'id' => 'edit-advance-form-sub')) }}
                <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="{{ $contact->id }}">                
                
                @include('advances.includes.edit_advance_fields')

                {!! Form::close() !!}

                <div class="box box-primary">
                  <div id="" class="form-group">

                    <div class="row">
                      <div class="col-xs-12 calendar-events-header" style="padding-top: 10px;">
                        <div class="pull-left"><strong>SUBMISSIONS</strong></div>
                        <div class="pull-right">
                          <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalSendSubmission">
                              <i class="fa fa-plus"></i> Send Submission
                          </a>                             
                          <a href="javascript:location.reload();" class="btn btn-primary">
                              <i class="fa fa-refresh"></i>
                          </a>
                        </div>
                      </div>
                    </div>                    

                    <!-- Submission Here --> 
                    <br />     
                    <ul class="timeline timeline-inverse">

                      @if(!$ca_submissions->isEmpty())

                        @foreach($ca_submissions as $sub)
                          <!-- timeline item -->
                          <li>
                            <i class="fa fa-mail-forward bg-blue"></i>

                            <div class="timeline-item">
                              <span class="time"><i class="fa fa-clock-o"></i> {{ date("F j, Y, g:i a", strtotime($sub->created_at)) }} </span>
                              <h3 class="timeline-header">
                                <?php $subject = isset($sub->subject) ? $sub->subject : 'NA'; ?>
                                <a href="javascript:void(0);">Subject:</a> <?php echo $subject; ?> <a href="javascript:void(0);">sent by:</a> {{ $sub->sender }}
                                <br />
                                <?php 
                                  if(GlobalHelper::is_serialized_string($sub->recipient)) {
                                    $recipients_array = unserialize($sub->recipient);
                                    $recipients = rtrim(implode(', ', $recipients_array), ', ');
                                    echo '<a href="javascript:void(0);">To:</a> ' . $recipients;                                    
                                  } else {
                                ?>
                                  <a href="javascript:void(0);">To:</a> {{ $sub->recipient }}
                                <?php } ?>
                              </h3>
                              <div class="timeline-body" style="overflow: auto; min-height: 40px; max-height: 120px;">
                                  <?php echo $sub->content; ?>
                              </div>

                              <div class="timeline-footer">
                                <?php 
                                  $documents_list = "";
                                  if(GlobalHelper::is_serialized_string($sub->documents)) {
                                    $unserialize_documents = unserialize($sub->documents);
                                    $docs_array = array();
                                    foreach($unserialize_documents as $udocs) {
                                      $contact_docs = App\ContactDocs::find($udocs);
                                      if($contact_docs) {
                                        $docs_array[] = $contact_docs->filename;
                                      }
                                    }
                                    $documents_list = rtrim(implode(', ', $docs_array), ', ');
                                  } else {
                                    $documents_list = $sub->documents;
                                  }
                                ?>
                                <strong>Attached Docs: </strong> {{ $documents_list }}
                                <div style="float: right;">
                                  <a href="javascript:void(0);" class="btn btn-primary btn-xs">
                                      {{ ucfirst($sub->status) }}
                                  </a>                                    
                                </div>   
                              </div>
                            </div>
                          </li>
                          <!-- END timeline item -->

                        @endforeach

                        <li>
                          <i class="fa fa-clock-o bg-gray"></i>
                        </li>

                      @else
                        <li>
                          <i class="fa fa-file-text bg-blue"></i>
                          <div class="timeline-item"><h3 class="timeline-header"><strong>Submission is empty</strong></h3></div>  
                        </li>
                      @endif

                    </ul>                               

                  </div>
                </div>
               


                <div class="pull-right">
                  <button type="button" id="btn-update-advance-sub-form" class="btn btn-primary btn-update-advance-sub-form">Update</button>
                </div>     
                              
              </section>

              <div id="modalSendSubmission" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left;">
                  {{ Form::open(array('url' => 'contact_advance/send_submission', 'class' => '', 'id' => 'send-email-form')) }}
                    <input type="hidden" name="contact_advance_id" id="contact_advance_id" value="<?php echo Hashids::encode($advance_id); ?>">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Send Email</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email Templates</label>
                            <div class="col-sm-10">
                              <select class="form-control email-template" name="email_template_id">
                                  <option value="0">- Blank -</option>
                                @foreach($emailTemplates as $et)
                                  <option value="{{ $et->id }}">{{ $et->name }}</option>
                                @endforeach
                              </select>                                 
                            </div>
                          </div>                            
                          <div class="form-group multi-select row">
                            <label class="col-sm-2 col-form-label">To (Lenders)<span class="required"></span></label>
                            <div class="col-sm-10">
                              <select class="select_recipient form-control" name="recipient[]" multiple="multiple">
                                @foreach($lenders as $l)
                                  <option value="{{ $l->email }}">{{ $l->email }}</option>
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
                          <div class="form-group">
                            <label>Message <span class="required">*</span></label>
                            <div class="editor-container">
                              <?php echo Form::textarea('content', old('content') ,['id' => 'ckeditor', 'class' => 'form-control', 'required' => '']); ?>
                            </div>
                          </div>
                          <div class="form-group multi-select row">
                            <label class="col-sm-2 col-form-label">Attached Documents <span class="required"></span></label>
                            <div class="col-sm-10">
                              <select class="select_recipient form-control" name="documents[]" multiple="multiple">
                                @foreach($documents as $doc)
                                  <option value="{{ $doc->id }}">{{ $doc->document_title }}</option>
                                @endforeach
                              </select>                                
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

            </div>
          </div>

        </div>   

    </section>
  <!-- /.content -->
@endsection

@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>';

  $(function () {
  
    $('.select_recipient').select2();     

    $( "#btn-update-advance-sub-form" ).click(function() {
      $( "#edit-advance-form-sub" ).submit();
    });    

    $( "#advance_amount" ).change(function() {
      compute_payback_payment();
    });

    $( "#remit" ).change(function() {
      compute_payback_payment();
    });

    $( "#payment_period" ).change(function() {
      compute_payback_payment();
    });

    $('#factor_rate').on('input',function(e){
      compute_payback_payment();
    });      

    CKEDITOR.replace('ckeditor');      

  });

  function compute_payback_payment() {
    $.get(base_url + '/contact_advance/ajax_load_payback_payment_computation_edit', $('#edit-advance-form-sub').serialize(), function (o) {
      $('#payback-payment-container-edit').html('<br><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br>');

      setTimeout(function () {
        $('#payback-payment-container-edit').html(o);
      }, 250);
    });    
  } 
 
</script>

@endsection

