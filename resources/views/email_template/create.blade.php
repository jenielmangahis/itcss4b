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
      Email Template | Create
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

          {{ Form::open(array('url' => 'email_template/store', 'class' => '')) }}
            <div class="box-body">
              @if(UserHelper::isAdminUser(Auth::user()->group_id))
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Company:</label>
                      <select name="company_id" id="company_id" class="form-control">
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                      </select>                    
                    </div>
                  </div>

                  <div class="col-md-5">
                    <div class="form-group">
                      <div id="company-users-container"></div>           
                    </div>  
                  </div>
                </div>
              @endif       
              <div class="form-group">
                <label>Name <span class="required">*</span></label>
                <?php echo Form::text('name', old('name') ,['class' => 'form-control', 'required' => '']); ?>                
              </div>  
              <div class="form-group">
                <label>Content <span class="required">*</span></label>                
                <?php echo Form::textarea('content', old('content') ,['class' => 'form-control', 'id' => 'ckeditor', 'required' => '']); ?>
              </div>  
            </div>        
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Submit</button>
              <a class="btn btn-primary" href="{{route('email_template')}}">Cancel</a>
            </div>
          {!! Form::close() !!}     

        </div>        

    </section>
  <!-- /.content -->
@endsection
@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>'; 

  function load_company_users_dropdown() {
      var company_id = $('#company_id').val();
      var c_user_id = 0;
      $('#company-users-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
      var url = base_url + '/contact/ajax_load_company_users'
      $.ajax({
           type: "GET",
           url: url,               
           data: {
              "company_id":company_id,
              'c_user_id':c_user_id
              }, 
           success: function(o)
           {
              $('#company-users-container').html(o);
           }
      });          
  }

  $(function () {
    load_company_users_dropdown();
    
    $('#company_id').change(function () {
      var company_id = $('#company_id').val();
      var c_user_id = 0;
      $('#company-users-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
      var url = base_url + '/contact/ajax_load_company_users'
      $.ajax({
           type: "GET",
           url: url,               
           data: {
              "company_id":company_id,
              'c_user_id':c_user_id
              }, 
           success: function(o)
           {
              $('#company-users-container').html(o);
           }
      }); 
    });

    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('ckeditor');

  });

</script>
@endsection

