@extends('layouts.backend.login_template')

@section('header-php')
  <?php
  $body_id = 'page-login';
  $body_class = '';
  ?>
@endsection

@section('meta-dynamic')
  <title>Reset Password</title>  
  <meta name="description" content="Login">    
@endsection

@section('main')
<style>
.login-page, .register-page {
  background-color: #070707;
}
</style>
<div class="login-box">
  <div class="login-logo" style="margin-bottom: 10px;">
    <a href="#"><img src="{{ asset('/images/corelogo_big.jpg') }}" alt="CoreCMS" style="width:100%;" /></a>
  </div>

  <div class="login-box-body">

    @if(Session::has('message'))
      <div class="alert {{ Session::get('alert_class') }}">
        <button type="button" class="close" data-dismiss="alert">&times</button>
        {{ Session::get('message') }}
      </div>
    @endif  

    <?php if( $is_code_valid ){ ?>
    <p class="login-box-msg">Reset Password</p>

    {{ Form::open(array('url' => 'change_password', 'class' => '', 'method' => 'post')) }}    
    {{ csrf_field() }}       
      <?php echo Form::hidden('user_id', Hashids::encode($user->id) ,[]); ?>  
      <div class="form-group has-feedback">
        <input id="login-password" type="password" name="password" class="form-control" placeholder="New Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input id="login-repassword" type="password" name="repassword" class="form-control" placeholder="Retype Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <input id="login-submit" type="submit" class="btn btn-primary btn-block btn-flat" value="Change Password">
        </div>
      </div>
    {!! Form::close() !!}        
    <?php } ?>

  </div>
  <!-- /.login-box-body -->
</div>

@endsection

@section('page-footer-scripts')
<script>
</script>
@endsection
