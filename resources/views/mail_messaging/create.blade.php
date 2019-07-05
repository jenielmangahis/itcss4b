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
      Mail Messaging | Create
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

          {{ Form::open(array('url' => 'mail_messaging/send', 'class' => '')) }}
            <div class="box-body">
                          
              <div class="form-group">
                <label>To <span class="required"></span></label>
                <select name="recipient" class="form-control" id="recipient">
                  @foreach($contacts as $c)
                  <option value="{{ $c->id }}">{{ $c->email }}</option>
                  @endforeach
                </select>                    
              </div> 
              <div class="form-group">
                <label>Subject <span class="required"></span></label>
                <?php echo Form::text('subject', old('subject') ,['class' => 'form-control']); ?>
              </div>
              <div class="form-group">
                <label>Message <span class="required">*</span></label>
                <?php echo Form::textarea('content', old('content') ,['class' => 'form-control', 'required' => '']); ?>
              </div>      
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Send</button>
              <a class="btn btn-primary" href="{{route('mail_messaging')}}">Cancel</a>
            </div>
          {!! Form::close() !!}     

        </div>        

    </section>
  <!-- /.content -->
@endsection

