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
      Contacts | Edit
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
        
        <div class="box box-primary">

          {{ Form::open(array('url' => 'contact/update', 'class' => '')) }}
          <input type="hidden" name="id" value="<?= Hashids::encode($contact->id); ?>">          
            <div class="box-body">
                        
              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> Info.
                  <small class="pull-right"></small>
                </h2>
              </div> 

              <div class="form-group">
                <label>Firstname <span class="required">*</span></label>
                <?php echo Form::text('firstname', $contact->firstname ,['class' => 'form-control', 'required' => '']); ?>
              </div>

              <div class="form-group">
                <label>Lastname <span class="required">*</span></label>
                <?php echo Form::text('lastname', $contact->lastname ,['class' => 'form-control', 'required' => '']); ?>
              </div>

              <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <?php echo Form::email('email', $contact->email ,['class' => 'form-control', 'required' => '']); ?>
              </div>

              <div class="form-group">
                <label>Mobile Number <span class="required"></span></label>
                <?php echo Form::text('mobile_number', $contact->mobile_number ,['class' => 'form-control']); ?>
              </div>

              <div class="form-group">
                <label>Work Number <span class="required"></span></label>
                <?php echo Form::text('work_number', $contact->work_number ,['class' => 'form-control']); ?>
              </div>

              <div class="form-group">
                <label>Home Number <span class="required"></span></label>
                <?php echo Form::text('home_number', $contact->home_number ,['class' => 'form-control']); ?>
              </div>

              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> Address
                  <small class="pull-right"></small>
                </h2>
              </div>

              <div class="form-group">
                <label>Address 1 <span class="required">*</span></label>
                <?php echo Form::text('address1', $contact->address1 ,['class' => 'form-control', 'required' => '']); ?>
              </div>

              <div class="form-group">
                <label>Address 2 <span class="required"></span></label>
                <?php echo Form::text('address2', $contact->address2 ,['class' => 'form-control']); ?>
              </div>

              <div class="form-group">
                <label>City <span class="required"></span></label>
                <?php echo Form::text('city', $contact->city ,['class' => 'form-control']); ?>
              </div>

              <div class="form-group">
                <label>State <span class="required"></span></label>
                <?php echo Form::text('state', $contact->state ,['class' => 'form-control']); ?>
              </div>

              <div class="form-group">
                <label>Zip Code <span class="required">*</span></label>
                <?php echo Form::text('zip_code', $contact->zip_code ,['class' => 'form-control', 'required' => '']); ?>
              </div>

              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> Status
                  <small class="pull-right"></small>
                </h2>
              </div>               

              <div class="form-group">
                <select name="status" class="form-control">
                  <option value="0" selected="selected">Active</option>
                  <option value="1">Suspended</option>
                </select>                    
              </div>  

              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> Stage
                  <small class="pull-right"></small>
                </h2>
              </div>               

              <div class="form-group">
                <select name="stage_id" class="form-control">
                  @foreach($stages as $stage)
                  <option <?php echo $contact->stage_id == $stage->id ? 'selected="selected"' : ''; ?> value="{{ $stage->id }}">{{ $stage->name }}</option>
                  @endforeach
                </select>                    
              </div>                               

              <br />
              <hr />
              <div id="" class="form-group">
                <div class="box-body">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab_variation_0" data-toggle="tab"><strong>Business Info.</strong></a></li>
                      <li class=""><a href="#tab_variation_1" data-toggle="tab"><strong>Loan Info.</strong></a></li>
                      <li class=""><a href="#tab_variation_2" data-toggle="tab"><strong>Broker Info.</strong></a></li>
                    </ul>

                    <div class="tab-content">
                      <div class="active tab-pane" id="tab_variation_0">
                        For Business Information
                      </div>

                      <div class="tab-pane" id="tab_variation_1">
                        For Loan Information
                      </div>

                      <div class="tab-pane" id="tab_variation_2">
                        For Broker Information
                      </div>

                    </div>
                  </div>
                </div>
              </div>
                                                                                                                                       
            </div>            
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Update</button>
              <a class="btn btn-primary" href="{{route('contact')}}">Cancel</a>
            </div>
          {!! Form::close() !!}     

        </div>        

    </section>
  <!-- /.content -->
@endsection

