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
      Companies | Edit
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

          {{ Form::open(array('url' => 'companies/update', 'class' => '')) }}
          <input type="hidden" name="id" value="<?= Hashids::encode($companies->id); ?>">                
            <div class="box-body">
                          
              <div class="form-group">
                <label>Name <span class="required">*</span></label>
                <?php echo Form::text('name', $companies->name ,['class' => 'form-control', 'required' => '']); ?>
              </div>
              <div class="form-group">
                <label>Contact Number <span class="required">*</span></label>
                <?php echo Form::text('contact_number', $companies->contact_number ,['class' => 'form-control', 'required' => '']); ?>
              </div>
             
              <br />
              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> Social Media
                  <small class="pull-right"></small>
                </h2>
              </div>                 
              <div class="form-group">
                <label>Facebook</label>
                <?php echo Form::text('facebook', $companies->facebook ,['class' => 'form-control']); ?>
              </div>   
              <div class="form-group">
                <label>Twitter</label>
                <?php echo Form::text('twitter', $companies->twitter ,['class' => 'form-control']); ?>
              </div>  
              <div class="form-group">
                <label>Instagram</label>
                <?php echo Form::text('instagram', $companies->instagram ,['class' => 'form-control']); ?>
              </div>

              <div class="form-group">
                <h2 class="page-header">
                  <i class="fa fa-info-circle"></i> Status
                  <small class="pull-right"></small>
                </h2>
              </div>               

              <div class="form-group">
                <select name="is_active" class="form-control">
                  <option value="0" <?php echo $companies->is_active == 0 ? 'selected="selected"' : ''; ?>>Active</option>
                  <option value="1" <?php echo $companies->is_active == 1 ? 'selected="selected"' : ''; ?>>Suspended</option>
                </select>                    
              </div>                                                                                                                             
            </div>            
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Submit</button>
              <a class="btn btn-primary" href="{{route('companies')}}">Cancel</a>
            </div>
          {!! Form::close() !!}     

        </div>        

    </section>
  <!-- /.content -->
@endsection

