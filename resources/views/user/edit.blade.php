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
      User | Edit
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

          {{ Form::open(array('url' => 'user/update', 'class' => '')) }}
          <input type="hidden" name="id" value="<?= Hashids::encode($user->id); ?>">          
            <div class="box-body">
          
              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> User Credential
                  <small class="pull-right"></small>
                </h2>
              </div>                
              <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <?php echo Form::text('email', $user->email ,['class' => 'form-control', 'required' => '', 'disabled' => 'disabled']); ?>
              </div>
              <div class="form-group">
                <label>Username <span class="required">*</span></label>
                <?php echo Form::text('username', $user->username ,['class' => 'form-control', 'required' => '', 'disabled' => 'disabled']); ?>
              </div>
              <div class="form-group">
                <label>Password</label>
                <?php echo Form::password('password' ,['id' => 'password', 'class' => 'form-control', 'minLength' => 6]); ?>
              </div>                
              <div class="form-group">
                <label>Confirm Password</label>
                <?php echo Form::password('confirm_password' ,['id' => 'confirm_password', 'minLength' => 6, 'class' => 'form-control']); ?>
              </div>  
              <div class="form-group">
                <label>Group</label>
                <select name="group_id" class="form-control">
                  @foreach($groups as $group)
                    <option <?php echo $group->id == $user->group_id ? 'selected="selected"' : ''; ?> value="{{ $group->id }}">{{ $group->name }}</option>
                  @endforeach
                </select>                    
              </div>     
              <br />
              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> Profile Information
                  <small class="pull-right"></small>
                </h2>
              </div>                 
              <div class="form-group">
                <label>Firstname</label>
                <?php echo Form::text('firstname', $user->firstname ,['class' => 'form-control', 'required' => '']); ?>
              </div>   
              <div class="form-group">
                <label>Lastname</label>
                <?php echo Form::text('lastname', $user->lastname ,['class' => 'form-control', 'required' => '']); ?>
              </div>  
              <div class="form-group">
                <label>Nickname</label>
                <?php echo Form::text('nickname', $user->nickname ,['class' => 'form-control']); ?>
              </div>  

              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> Contact Number
                  <small class="pull-right"></small>
                </h2>
              </div> 

              <div class="form-group">
                <label>Mobile Number</label>
                <?php echo Form::text('mobile_number', $user->mobile_number ,['class' => 'form-control']); ?>
              </div>    
              <div class="form-group">
                <label>Work Number</label>
                <?php echo Form::text('work_number', $user->work_number ,['class' => 'form-control']); ?>
              </div>  
              <div class="form-group">
                <label>Home Number</label>
                <?php echo Form::text('home_number', $user->home_number ,['class' => 'form-control']); ?>
              </div>  

              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> Status
                  <small class="pull-right"></small>
                </h2>
              </div>               

              <div class="form-group">
                <select name="is_active" class="form-control">
                  <option value="0" <?php echo $user->is_active == 0 ? 'selected="selected"' : ''; ?>>Active</option>
                  <option value="1" <?php echo $user->is_active == 1 ? 'selected="selected"' : ''; ?>>Suspended</option>
                </select>                    
              </div>                                                                                                                             
            </div>            
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Update</button>
              <a class="btn btn-primary" href="{{route('users')}}">Cancel</a>
            </div>
          {!! Form::close() !!}     

        </div>        

    </section>
  <!-- /.content -->
@endsection

