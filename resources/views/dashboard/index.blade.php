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
      Dashboard
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

  </section>
  <!-- /.content -->
@endsection

