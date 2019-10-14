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

                {{ Form::open(array('url' => 'contact_advance/update_application', 'class' => 'edit-advance-form-application', 'id' => 'edit-advance-form-application')) }}
                <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                <input type="hidden" name="contact_id" id="contact_id" class="contact_id" value="{{ $contact->id }}">                
                <div class="box box-primary">
                  <div class="row">
                    <div class="col-xs-3">
                      <div class="form-group">
                        <label for="inputLabel">Sales</label>
                        <select name="sales_user_id" id="sales_user_id" class="form-control">
                          <option value="0">Please select user</option>
                          @if(!$company_user->isEmpty())
                            @foreach($company_user as $cuser)
                              <option <?php echo $advance->sales_user_id == $cuser->user->id ? "selected" : ""; ?> value="{{ $cuser->user->id }}">{{ $cuser->user->firstname }} {{ $cuser->user->lastname }}</option>
                            @endforeach
                          @endif
                        </select>  
                      </div>                
                    </div>
                    <div class="col-xs-3">
                      <div class="form-group">
                        <label for="inputLabel">Lender</label>
                        <select name="lender_id" id="lender_id" class="form-control">
                          <option value="0">Please select user</option>
                          @if(!$company_user->isEmpty())
                            @foreach($company_user as $cuser)
                              <option <?php echo $advance->lender_id == $cuser->user->id ? "selected" : ""; ?> value="{{ $cuser->user->id }}">{{ $cuser->user->firstname }} {{ $cuser->user->lastname }}</option>
                            @endforeach
                          @endif
                        </select>  
                      </div>                
                    </div>
                    <div class="col-xs-3">
                      <div class="form-group">
                        <label for="inputLabel">Under Writer</label>
                        <select name="under_writer_user_id" id="under_writer_user_id" class="form-control">
                          <option value="0">Please select user</option>
                          @if(!$company_user->isEmpty())
                            @foreach($company_user as $cuser)
                              <option <?php echo $advance->under_writer_user_id == $cuser->user->id ? "selected" : ""; ?> value="{{ $cuser->user->id }}">{{ $cuser->user->firstname }} {{ $cuser->user->lastname }}</option>
                            @endforeach
                          @endif
                        </select>  
                      </div>                
                    </div>
                    <div class="col-xs-3">
                      <div class="form-group">
                        <label for="inputLabel">Closer</label>
                        <select name="closer_user_id" id="closer_user_id" class="form-control">
                          <option value="0">Please select user</option>
                          @if(!$company_user->isEmpty())
                            @foreach($company_user as $cuser)
                              <option <?php echo $advance->closer_user_id == $cuser->user->id ? "selected" : ""; ?> value="{{ $cuser->user->id }}">{{ $cuser->user->firstname }} {{ $cuser->user->lastname }}</option>
                            @endforeach
                          @endif
                        </select>  
                      </div>                
                    </div>
                  </div>
                </div>

                <div class="box box-primary">
                  <div class="row">
                    <input type="hidden" name="advance_id" id="advance_id" class="advance_id" value="{{ Hashids::encode($advance->id) }}">
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label for="inputAdvanceType">Advance Type</label>
                        <select name="advance_type" id="advance_type" class="form-control">
                          <option <?php echo $advance->advance_type == 'new' ? 'selected="selected"' : ''; ?> value="new">New</option>
                          <option <?php echo $advance->advance_type == 'add-on' ? 'selected="selected"' : ''; ?> value="add-on">Add-on</option>
                          <option <?php echo $advance->advance_type == 'renewal' ? 'selected="selected"' : ''; ?> value="renewal">Renewal</option>
                        </select>  
                      </div>                
                    </div>

                    <div class="col-xs-6">
                      <div class="form-group">
                        <label for="inputPaymentMethod">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                          <option <?php echo $advance->payment_method == 'ach' ? 'selected="selected"' : ''; ?> value="ach">Ach</option>
                          <option <?php echo $advance->payment_method == 'cc' ? 'selected="selected"' : ''; ?> value="cc">Cc</option>
                        </select>                   
                      </div>                
                    </div>           

                  </div>  

                  <div class="form-group">
                    <label for="inputAdvanceAmount">Advance Amount</label>
                    <input type="number" step="0.01" class="form-control" id="advance_amount" name="advance_amount" value="{{$advance->amount}}" placeholder="Enter Amount" required="">
                  </div>                   

                  <div class="row">
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label for="inputPaymentPeriod">Payment Period</label>
                        <input type="number" class="form-control" id="payment_period" name="payment_period" value="{{$advance->period}}" placeholder="" required="">
                      </div>                
                    </div>
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label for="input">&nbsp</label>
                        <select name="payment_period_type" id="payment_period_type" class="form-control">
                          <option <?php echo $advance->period_type == 'days' ? 'selected="selected"' : ''; ?> value="days">Days</option>
                          <option <?php echo $advance->period_type == 'weeks' ? 'selected="selected"' : ''; ?> value="weeks">Weeks</option>
                          <option <?php echo $advance->period_type == 'month' ? 'selected="selected"' : ''; ?> value="month">Month</option>
                        </select>                    
                      </div>                
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-6">
                      <label for="inputPaymentPeriod">Remit</label>
                      <input type="number" step="0.01" class="form-control" id="remit" name="remit" value="{{$advance->remit}}" placeholder="%" required="">
                    </div>
                    <div class="col-xs-6">
                      <label for="inputPaymentPeriod">Factor Rate</label>
                      <input type="number" step="0.01" class="form-control" id="factor_rate" name="factor_rate" value="{{$advance->factor_rate}}" placeholder="%" required="">
                    </div>
                  </div>     

                  <br />
                  <div style="float: right;"><a onclick="javascript:compute_payback_payment();" href="javascript:void(0);">Compute</a></div>
                  <div id="payback-payment-container-edit" class="payback-payment-container-edit">
                    <div class="form-group">
                      <label for="inputAdvanceAmount">Payback Amount</label>
                      <input type="text" class="form-control" id="payback_amount" name="payback_amount" value="{{$advance->payback}}" placeholder="" disabled="disabled">
                    </div> 

                    <div class="form-group">
                      <label for="inputAdvanceAmount">Payment</label>
                      <input type="text" class="form-control" id="payment" name="payment" value="{{$advance->payment}}" placeholder="" disabled="disabled">
                    </div>                                
                  </div>
                  <br />
               
                </div>

                <div class="box box-primary">
                  <div id="" class="form-group">

                    <div class="row">
                      <div class="col-xs-12 calendar-events-header">
                        <div class="pull-left calendar-events-title">Docs</div>
                        <div class="pull-right">
                            <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddDocs">
                                <i class="fa fa-plus"></i> Add Docs
                            </a>          
                            <a href="javascript:location.reload();" class="btn btn-primary">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <?php if( $group_id == 3 ){ ?>
                        {{ Form::open(array('url' => 'dashboard/', 'class' => '', 'method' => 'get')) }}
                      <?php }else{ ?>
                        {{ Form::open(array('url' => 'contact_dashboard/'.$contact->id, 'class' => '', 'method' => 'get')) }}
                      <?php } ?>
                      

                        <div class="col-xs-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Search By: </label><br />
                                <select name="search_by_documents" class="form-control select2" style="width: 30%; float: left;">
                                  <option value="document_title" selected="selected">Document Title</option>              
                                </select>            
                                <input class="form-control" type="text" value="<?php //echo $search_field_documents; ?>" name="search_field_documents" placeholder="Default Search" style="width: 70%; float: right;">
                              </div>
                              <!-- /.form-group -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>&nbsp;</label><br />
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <?php if( $group_id == 3 ){ ?>
                                  <a class="btn btn-success" href="{{url('dashboard')}}">Refresh</a>
                                <?php }else{ ?>
                                  <a class="btn btn-success" href="{{url('contact_dashboard/'.$contact->id)}}">Refresh</a>
                                <?php } ?>            
                              </div>
                              <!-- /.form-group -->
                            </div>
                          </div>                

                        </div>                      
                      {!! Form::close() !!}         
                    </div>

                    <table class="table table-bordered table-hover">
                      <tr>    
                        <th>Document Title</th>
                        <th>Date Created</th>
                        <th>Created By</th>
                        <th style="width:10%;">Action</th>
                      </tr>
                        @foreach($contactDocs as $doc)
                        <tr>
                          <td>{{ $doc->document_title }}</td>
                          <td>{{ $doc->created_at }}</td>
                          @if(isset($doc->user->firstname) && isset($doc->user->lastname))
                            <td>{{ $doc->user->firstname }} {{ $doc->user->lastname }}</td>
                          @else
                            <td>-</td>
                          @endif
                          <td>  
                            <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalViewDoc-<?php echo $doc->id; ?>">
                                <i class="fa fa-search-plus"></i>
                            </a>
                            <a href="{{ URL::asset('uploads/contact_docs/' . $doc->filename) }}" class="btn btn-xs btn-primary" id="">
                                <i class="fa fa-download"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalDeleteDoc-<?php echo $doc->id; ?>">
                                <i class="fa fa-trash"></i>
                            </a> 

                            <div id="modalViewDoc-<?php echo $doc->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                              <div class="modal-dialog modal-lg" style="width: 400px !important;">
                                <div class="modal-content">

                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">View Doc</h4>
                                    </div>

                                    <div class="modal-body">
                                      <table class="table table-bordered">
                                        <tr>
                                          <td>Document Title</td>
                                          <td>: <b>{{ $doc->document_title }}</b></td>
                                        </tr>                    
                                        <tr>
                                          <td>Document Type</td>
                                          <td>: <?= $documentTypes[$doc->document_type]; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Description</td>
                                          <td>: {{ $doc->description }}</td>
                                        </tr>
                                      </table> 
                                    </div>

                                    <div class="modal-footer"> 
                                      <a href="{{ URL::asset('uploads/contact_docs/' . $doc->filename) }}" class="btn btn-primary" id="">
                                          <i class="fa fa-download"></i> Download
                                      </a>                 
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>

                                </div>            
                              </div>
                            </div>

                            <div id="modalDeleteDoc-<?= $doc->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">

                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                  </div>
                                  <div class="modal-body">
                                    Are you sure you want to delete selected document?
                                  </div>
                                  <div class="modal-footer">
                                    {{ Form::open(array('url' => 'contact_docs/destroy')) }}
                                      <?php echo Form::hidden('id', Hashids::encode($doc->id) ,[]); ?>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                      <button type="submit" class="btn btn-danger">Yes</button>
                                    {!! Form::close() !!}
                                  </div>

                                </div>
                              </div>
                          </div>  

                          </td>
                        </tr> 
                        @endforeach 

                    </table>

                    <div style="text-align: center;" class="box-footer clearfix">
                        
                    </div>

                    <div style="text-align: center;" class="box-footer clearfix">

                    </div>

                    <div id="modalAddDocs" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                        {{ Form::open(array('url' => 'contact_docs/store', 'class' => '', 'id' => 'add-call-log-form', 'enctype' => 'multipart/form-data')) }}
                          <input type="hidden" id="" name="contact_id" value="<?php echo $contact->id; ?>">
                          <div class="modal-dialog modal-lg" style="width: 800px !important;">
                            <div class="modal-content">

                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Add Docs</h4>
                              </div>
                              <div class="modal-body">

                                <div class="row">
                                  <div class="col-xs-4">
                                    <div class="form-group">
                                      <label for="inputTime">Filename</label>
                                      <input type="file" class="form-control" id="filename" name="filename" placeholder="Click to Select File" required="">
                                    </div>                
                                  </div>
                                  <div class="col-xs-3">
                                    <div class="form-group">
                                      <label for="inputCallType">Document Type</label>
                                      <select name="document_type" id="document_type" class="form-control">
                                        <?php foreach($documentTypes as $key => $value){ ?>
                                          <option value="<?= $key; ?>"><?= $value; ?></option>
                                        <?php } ?>
                                      </select>  
                                    </div>                
                                  </div>
                                  <div class="col-xs-5">
                                    <div class="form-group">
                                      <label for="inputTime">Description</label>
                                      <input type="text" class="form-control" name="description" required="">
                                    </div>                
                                  </div>           

                                </div>

                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Upload</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        {!! Form::close() !!}        
                    </div>

                  </div>
                </div>

                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>     
                {!! Form::close() !!}              
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

