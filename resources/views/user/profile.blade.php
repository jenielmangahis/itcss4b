@extends('layouts.backend.master')

@section('header-php')
  <?php
  $body_id = '';
  $body_class = '';
  ?>
@endsection 

@section('meta-dynamic')
  <title>{{ config('app.name') }}</title>  
  <meta name="description" content="-">    
@endsection

@section('main')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      User Profile
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
        
        <div class="col-md-3">

          <div class="box box-primary">

            <div class="box-body box-profile">

                @if(file_exists(public_path() . "/uploads/users/".$user->profile_img) && $user->profile_img != "")
                  <img style="" src="{{ asset("/uploads/users/".$user->profile_img) }}" class="profile-user-img img-responsive img-circle" alt="User Profile Image"/>
                @else
                  <img src="{{ asset("/images/user-default-160x160.jpg") }}" class="profile-user-img img-responsive img-circle" alt="User Profile Picture"/>            
                @endif  
                
              <h3 class="profile-username text-center">{{ $user->firstname }} {{ $user->lastname }}</h3>
              <!-- <a href="#" class="btn btn-primary btn-block"><b>Update</b></a> -->
            </div>

          </div>

        </div>

          <div class="col-md-9">

            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#personal_info" data-toggle="tab">Personal Info.</a></li>
                <li class=""><a href="#credential" data-toggle="tab">Credential</a></li>
              </ul>
              {{ Form::open(array('url' => 'user/update_profile', 'class' => '', 'enctype' => 'multipart/form-data')) }}
              <div class="tab-content">
                <div class="active tab-pane" id="personal_info">
                  
                  <input type="hidden" name="id" value="<?= Hashids::encode($user->id); ?>">
                  <div class="box-body">
                                   
                    <div class="form-group">
                      <label>Firstname</label>
                      <?php echo Form::text('firstname', $user->firstname ,['class' => 'form-control', 'required' => '']); ?>
                    </div>  
                    <div class="form-group">
                      <label>Lastname</label>
                      <?php echo Form::text('lastname', $user->lastname ,['class' => 'form-control']); ?>
                    </div>  
                    <div class="form-group">
                      <label>Nickname</label>
                      <?php echo Form::text('nickname', $user->nickname ,['class' => 'form-control']); ?>
                    </div>  
                    <div class="form-group">
                      <label>Contact Number</label>
                      <?php echo Form::text('mobile_number', $user->mobile_number ,['class' => 'form-control']); ?>
                    </div>   

                    <div class="form-group">
                      <label>Default Profile Photo: </label>
                      <input type="file" name="profile_image" id="profile_image">
                    </div>                                                                                                                                                    
                  </div>            
                  <!-- /.box-body -->
                       
                </div>
                <div class="tab-pane" id="credential">
                  <div class="box-body">               
                    <div class="form-group">
                      <label>Username/Email <span class="required">*</span></label>
                      <?php echo Form::text('email', $user->email ,['class' => 'form-control', 'disabled' => '']); ?>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <?php echo Form::password('password' ,['id' => 'password', 'class' => 'form-control', 'minLength' => 4]); ?>
                    </div>                
                    <div class="form-group">
                      <label>Confirm Password</label>
                      <?php echo Form::password('confirm_password' ,['id' => 'confirm_password', 'minLength' => 4, 'class' => 'form-control']); ?>
                    </div>  
                  </div>
                </div>
                <!-- /.tab-pane -->
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success">Update</button>
              </div>              
              {!! Form::close() !!}
              <!-- /.tab-content -->
            </div>

          </div>        

    </section>
  <!-- /.content -->
@endsection

