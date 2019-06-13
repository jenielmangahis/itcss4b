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
      Workflow | Create
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

          {{ Form::open(array('url' => 'workflow/store', 'class' => '')) }}
            <div class="box-body">
              
              <div class="form-group">
                <label>Category <span class="required">*</span></label>
                <select name="workflow_category_id" class="form-control">
                  @foreach($workflowCategories as $wc)
                    <option value="{{$wc->id}}">{{ $wc->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Stage <span class="required">*</span></label>
                <select name="stage_id" class="form-control">
                  @foreach($stages as $st)
                    <option value="{{$st->id}}">{{ $st->name }}</option>
                  @endforeach
                </select> 
              </div>

              <div class="form-group">
                <label>Status <span class="required">*</span></label>
                <?php echo Form::text('status', old('status') ,['class' => 'form-control', 'required' => '']); ?>
              </div>

              <div class="form-group">
                <label>Color Code <span class="required">*</span></label>
                <?php echo Form::text('color_code', old('color_code') ,['maxlength' => 7, 'class' => 'form-control colorpicker', 'required' => '']); ?>
              </div>          
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Submit</button>
              <a class="btn btn-primary" href="{{route('workflow')}}">Cancel</a>
            </div>
          {!! Form::close() !!}     

        </div>        

    </section>
  <!-- /.content -->
@endsection

