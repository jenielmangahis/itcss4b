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
      Lenders Management
    </h1>
    
    <!-- 
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol> 
    -->

  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->       
    <div class="box">
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
        <div class="box-body">
          <section class="col-lg-4 connectedSortable ui-sortable">

              <div class="box box-primary">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Lender Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="pull-left">
                          <strong>Company Name: </strong>{{ $lender->company_name }}
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="pull-left">
                          <p><strong>Address:</strong> {{ $lender->street }}, {{ $lender->city }}, {{ $lender->state }}, {{ $lender->zip_code }}</p>
                          <p><strong>Email:</strong> {{ $lender->email }}</p>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td><strong>Total Advances:</strong></td>
                      <td><div class="pull-right">{{ $advances_count }}</div></td>
                    </tr>

                    <tr>
                      <td><strong>Total Advance Amount:</strong></td>
                      <td><div class="pull-right">{{ number_format($advances_total_amount, 2) }}</div></td>
                    </tr>

                    <tr>
                      <td><strong>Payback Total:</strong></td>
                      <td><div class="pull-right">{{ number_format($advances_total_payback,2) }}</div></td>
                    </tr>
                    <?php 
                      if($advances_total_amount > 0 && $advances_count > 0) {
                        $total_advance_size = $advances_total_amount / $advances_count; 
                      } else { $total_advance_size = 0; }
                      
                    ?>
                    <tr>
                      <td><strong>Average Advance Size:</strong></td>
                      <td><div class="pull-right">{{ number_format($total_advance_size,2) }}</div></td>
                    </tr>
                  </tbody>
                </table>    
              </div>

              <div class="box box-primary">

                <table class="table">
                  <thead>
                    <tr>
                      <th colspan="2">
                        Contacts
                        <div class="pull-right">
                          @if(UserHelper::checkUserRolePermission(Auth::user()->group_id, 'contacts', 'create'))
                            <a href="javascript:void(0);" class="" id="" data-toggle="modal" data-target="#modalAddLenderContact">
                            Add Contact
                            </a>
                          @endif
                        </div>
                      </th>
                    </tr>
                  </thead>
                </table>

                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!$lender_contacts->isEmpty())
                      @foreach($lender_contacts as $lender_contact)
                        <tr>
                          <td>{{ $lender_contact->name }}</td>
                          <td>{{ $lender_contact->email }}</td>
                          <td>
                            <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDeleteLenderContact-<?= $lender_contact->id; ?>" >
                                <i class="fa fa-trash"></i>
                            </a>                            
                          </td>
                        </tr>

                        <div id="modalDeleteLenderContact-<?= $lender_contact->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete selected lender contact?
                                </div>
                                <div class="modal-footer">
                                  {{ Form::open(array('url' => 'lender/lender_contact_destroy')) }}
                                    <?php echo Form::hidden('lender_contact_id', Hashids::encode($lender_contact->id) ,[]); ?>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                  {!! Form::close() !!}
                                </div>

                              </div>
                            </div>
                        </div>   

                      @endforeach
                    @else
                        <tr>
                          <td colspan="2">No Contacts Available</td>
                        </tr>
                    @endif

                  </tbody>
                </table>     
                
              </div>                     
          </section>

          <section class="col-lg-8 connectedSortable ui-sortable">
            <div class="nav-tabs-custom contact-dashboard contact-dashboard-tabs">

              <div class="no-print">
                <div class="callout callout-info" style="margin-bottom: 0!important;">
                  <h4><i class="fa fa-info"></i> Notes:</h4>
                  <ul>
                    <li>{{$lender->notes}}</li>
                  </ul>
                  
                </div>
              </div>      


              <div class="row">
                <div class="col-xs-12">
                  <div class="pull-left"><h3><strong>Advances</strong></h3></div>
                </div>
              </div>              

              <table class="table table-bordered table-hover">
                <tr>
                  <th style="width: 1%;" >Loan ID</th>
                  <th>Contract Date</th>
                  <th>Contract Num.</th>
                  <th>Advance Date</th>
                  <th>Amount</th>
                  <th>Payback</th>
                  <th>Balance</th>
                  <th>Rate</th>
                  <th>Period</th>
                  <th>Payment</th>
                  <th>Type</th>
                  <th>Status</th>
                </tr>
                @foreach($advances as $advance)
                  <tr>
                    <td>{{ $advance->loan_id }}</td>
                    <td>{{ $advance->contract_date }}</td>
                    <td>{{ $advance->contract_number }}</td>
                    <td>{{ $advance->advance_date }}</td>
                    <td>{{ number_format($advance->amount,2) }}</td>
                    <td>{{ number_format($advance->payback,2) }}</td>
                    <td>{{ number_format($advance->balance,2) }}</td>
                    <td>{{ $advance->factor_rate }}%</td>
                    <td>{{ ucfirst($advance->period_type) }}</td>
                    <td>{{ number_format($advance->payment,2) }}</td>
                    <td>{{ ucfirst($advance->advance_type) }}</td>
                    <td>{{ $advance->status }}</td>
                  </tr>    
                @endforeach
              </table>         
              <div style="text-align: center;" class="box-footer clearfix">
                  {{ $advances->links() }}
              </div>
            </div>

          </section>
        </div>
      </div>
      <!-- /.row -->
    </div>

    <div id="modalAddLenderContact" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
        {{ Form::open(array('url' => 'lender/store_lender_contact', 'class' => '', 'id' => 'add-contact-lender-form')) }}
          <div class="modal-dialog modal-sm">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Lender Contact</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="inputTitle">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="" required="">
                </div>
                <div class="form-group">
                <label><strong>Email</strong></label>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="" required="">
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-default">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>

            </div>
          </div>
        {!! Form::close() !!}        
    </div>      

  </section>

  <!-- /.content -->
@endsection

@section('page-footer-scripts')

<script>

</script>

@endsection

