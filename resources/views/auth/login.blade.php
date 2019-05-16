@extends('layouts.backend.login_template')

@section('header-php')
  <?php
  $body_id = 'page-login';
  $body_class = '';
  ?>
@endsection

@section('meta-dynamic')
  <title>Login</title>  
  <meta name="description" content="Login">    
@endsection

@section('main')

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>coreCMS</b></a>
  </div>

  <div class="login-box-body">

    @if(Session::has('message'))
      <div class="alert {{ Session::get('alert_class') }}">
        <button type="button" class="close" data-dismiss="alert">&times</button>
        {{ Session::get('message') }}
      </div>
    @endif  

    <p class="login-box-msg">Sign in to start your session..</p>

    <form id="login-form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}   
      <div class="form-group has-feedback">
        <input id="login-username" type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="login-password" type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      @if ($errors->has('username'))
          <span class="help-block alert alert-danger">
              <strong>{{ $errors->first('username') }}</strong>
          </span>
      @endif

      @if ($errors->has('password'))
          <span class="help-block alert alert-danger">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif

      <div class="row">
        <div class="col-xs-12">
          <input id="login-submit" type="submit" class="btn btn-primary btn-block btn-flat" value="LOGIN">
        </div>
      </div>
    </form>
    <br />

    <a href="#">I forgot my password</a><br>
    <!-- <a href="#" class="text-center">Register a new membership</a> -->    

  </div>
  <!-- /.login-box-body -->
</div>

@endsection

@section('page-footer-scripts')
<script>
</script>
@endsection
