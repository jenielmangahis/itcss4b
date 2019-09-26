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
.label{
  padding: 10px;
  display: block;
  font-size: 13px;
}
</style>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Search Mail Records
    </h1>
    
    <ol class="breadcrumb">
      <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Contacts</a></li>
      <li class="active">Search Mail Records</a></li>
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
                <div class="box-body">

                  <div class="row">
                    {{ Form::open(array('url' => 'contact/search_mail_records', 'class' => '', 'method' => 'get')) }}

                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Search By: </label><br />
                              <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
                                <option value="all" selected="selected">All</option>
                                <option value="campaign_name">Campaign Name</option>
                                <option value="email_marketing">Email Marketing</option>
                              </select>
                              <input class="form-control" type="text" value="<?php echo $search_field; ?>" name="search_field" placeholder="Search" style="width: 70%; float: right;">
                            </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>&nbsp;</label><br />
                              <button type="submit" class="btn btn-primary">Search</button>                              
                              <a class="btn btn-success" href="{{route('contact/search_mail_records')}}">Refresh</a>                              
                            </div>
                            <!-- /.form-group -->
                          </div>
                        </div>                

                      </div>                      
                    {!! Form::close() !!}         
                  </div>

                  <table class="table table-bordered">
                    <tr>
                      <th>Full Name</th>
                      <th>Subject</th>
                      <th style="width: 40px;"></th>
                      <th></th>
                    </tr>
                    @foreach($mail_messaging as $ms)
                        <tr>
                            @if(isset($ms->user->firstname) && isset($ms->user->lastname))
                              <td>{{ $ms->user->firstname}} {{ $ms->user->lastname }}</td>                              
                            @else
                              <td>-</td>
                            @endif
                            <td>
                              <a href="javascript:void(0);" data-toggle="modal" data-target="#modalEmailContent-<?= $ms->id; ?>" >{{ $ms->subject }}</a>
                              <div id="modalEmailContent-<?= $ms->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                                  
                                    <div class="modal-dialog modal-md">
                                      <div class="modal-content">

                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                          </button>
                                          <h4 class="modal-title" id="myModalLabel">Email Details</h4>
                                        </div>
                                        <div class="modal-body">
                                          
                                          <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Subject <span class="required"></span></label>
                                            <div class="col-sm-10">
                                              <?php echo Form::text('subject', $ms->subject ,['readonly' => 'readonly', 'disabled' => 'disabled', 'class' => 'form-control']); ?>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">To <span class="required"></span></label>
                                            <div class="col-sm-10">
                                              <?php echo Form::text('recipient', $ms->recipient ,['readonly' => 'readonly', 'disabled' => 'disabled', 'class' => 'form-control']); ?>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">BCC <span class="required"></span></label>
                                            <div class="col-sm-10">
                                              <?php echo Form::text('bcc', $ms->bcc ,['readonly' => 'readonly', 'disabled' => 'disabled', 'class' => 'form-control']); ?>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">CC <span class="required"></span></label>
                                            <div class="col-sm-10">
                                              <?php echo Form::text('cc', $ms->cc ,['readonly' => 'readonly', 'disabled' => 'disabled', 'class' => 'form-control']); ?>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Message <span class="required"></span></label>
                                            <br />
                                            <div class="col-sm-10">
                                              <?= $ms->content; ?>
                                            </div>
                                          </div>

                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>

                                      </div>
                                    </div>     
                              </div>
                            </td>
                            <td><label class="label label-info">Categorized</label></td>
                            <td>-</td>
                        </tr>
                    @endforeach
                  </table>                  
                </div>
                <!-- /.box-body -->
                <div style="text-align: center;" class="box-footer clearfix">
                    {{ $mail_messaging->links() }}
                </div>

              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
  <!-- /.content -->
@endsection

@section('page-footer-scripts')
<script>
var base_url = '<?php echo url("/"); ?>';
$(function(){
  CKEDITOR.replace('ckeditor');
});
</script>
@endsection