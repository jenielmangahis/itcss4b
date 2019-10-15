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
                <div class="">
                  <div class="row">
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3>0.00</h3>
                          <p>Balance</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3>0.00</h3>
                          <p>Payments Made</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>0.00</h3>
                          <p>Return</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>0.00</h3>
                          <p>Last Payment</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>0<sup style="font-size: 20px">%</sup></h3>
                          <p>Performance</p>
                        </div>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>

                {{ Form::open(array('url' => 'contact_advance/update_underwriter_notes', 'class' => 'edit-advance-form-application', 'id' => 'edit-advance-form-application')) }}
                <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="{{ $contact->id }}">                
                
                @include('advances.includes.edit_advance_fields')

                <div class="box box-primary">
                  <div id="" class="form-group">

                    <div class="row">
                      <div class="col-xs-12 calendar-events-header" style="padding-top: 10px;">
                        <div class="pull-left"><strong>UNDERWRITER NOTES</strong></div>
                        <div class="pull-right">         
                            <a href="javascript:location.reload();" class="btn btn-primary">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </div>
                      </div>
                    </div>

                    <br />
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="inputField">Underwriters Opinion</label>
                          <textarea rows="4" cols="50" class="form-control" id="under_writer_opinion" name="under_writer_opinion" required="">{{isset($under_writer_note->under_writer_opinion) ? $under_writer_note->under_writer_opinion : ''}}</textarea>
                        </div>                             
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="inputField">Tax Liens/Judgements</label>
                          <textarea rows="4" cols="50" class="form-control" id="tax_liens_judgements" name="tax_liens_judgements" required="">{{isset($under_writer_note->tax_liens_judgements) ? $under_writer_note->tax_liens_judgements : ''}}</textarea>
                        </div>                             
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="inputField">UCC Position</label>
                          <textarea rows="4" cols="50" class="form-control" id="ucc_position" name="ucc_position" required="">{{isset($under_writer_note->ucc_position) ? $under_writer_note->ucc_position : ''}}</textarea>
                        </div>                             
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="inputField">Advance History/Comments</label>
                          <textarea rows="4" cols="50" class="form-control" id="advance_history_comments" name="advance_history_comments" required="">{{isset($under_writer_note->advance_history_comments) ? $under_writer_note->advance_history_comments : ''}}</textarea>
                        </div>                             
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="inputField">Major Issues</label>
                          <textarea rows="4" cols="50" class="form-control" id="major_issues" name="major_issues" required="">{{isset($under_writer_note->major_issues) ? $under_writer_note->major_issues : ''}}</textarea>
                        </div>                             
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="inputField">Required Paperworks & Information</label>
                          <textarea rows="4" cols="50" class="form-control" id="required_paperworks_information" name="required_paperworks_information" required="">{{isset($under_writer_note->required_paperworks_information) ? $under_writer_note->required_paperworks_information : ''}}</textarea>
                        </div>                             
                      </div>
                    </div>

                  </div>
                </div>

                {!! Form::close() !!}

                <div class="pull-right">
                  <button type="button" id="btn-update-advance-in-underwriter-notes-form" class="btn btn-primary btn-update-advance-in-underwriter-notes-form">Update</button>
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

  $(function () {

    $( "#btn-update-advance-in-underwriter-notes-form" ).click(function() {
      $( "#edit-advance-form-application" ).submit();
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

  });

  function compute_payback_payment() {
    $.get(base_url + '/contact_advance/ajax_load_payback_payment_computation_edit', $('#edit-advance-form-application').serialize(), function (o) {
      $('#payback-payment-container-edit').html('<br><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br>');

      setTimeout(function () {
        $('#payback-payment-container-edit').html(o);
      }, 250);
    });    
  } 
 
</script>

@endsection

