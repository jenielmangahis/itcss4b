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
                <!-- <select name="recipient" class="form-control" id="recipient">
                  @foreach($contacts as $c)
                  <option value="{{ $c->id }}">{{ $c->email }}</option>
                  @endforeach
                </select>  -->   
                <select class="select_recipient form-control" name="recipient[]" multiple="multiple">
                  @foreach($contacts as $c)
                    <option value="{{ $c->id }}">{{ $c->email }}</option>
                  @endforeach
                </select>                                 
              </div>
              <div class="form-group">
                <label>BCC <span class="required"></span></label>
                <!-- <select name="recipient" class="form-control" id="recipient">
                  @foreach($contacts as $c)
                  <option value="{{ $c->id }}">{{ $c->email }}</option>
                  @endforeach
                </select>  -->   
                <select class="select_recipient form-control" name="bcc[]" multiple="multiple">
                  @foreach($contacts as $c)
                    <option value="{{ $c->email }}">{{ $c->email }}</option>
                  @endforeach
                </select>                                 
              </div>
              <div class="form-group">
                <label>CC <span class="required"></span></label>
                <!-- <select name="recipient" class="form-control" id="recipient">
                  @foreach($contacts as $c)
                  <option value="{{ $c->id }}">{{ $c->email }}</option>
                  @endforeach
                </select>  -->   
                <select class="select_recipient form-control" name="cc[]" multiple="multiple">
                  @foreach($contacts as $c)
                    <option value="{{ $c->email }}">{{ $c->email }}</option>
                  @endforeach
                </select>                                 
              </div> 
              <div class="form-group">
                <label>Subject <span class="required"></span></label>
                <?php echo Form::text('subject', old('subject') ,['class' => 'form-control']); ?>
              </div>
              <div class="form-group">
                <label>Email Templates</label>
                <select class="form-control email-template" name="">
                    <option value="0">- Blank -</option>
                  @foreach($emailTemplates as $et)
                    <option value="{{ $et->id }}">{{ $et->name }}</option>
                  @endforeach
                </select>                                 
              </div>
              <div class="form-group">
                <label>Message <span class="required">*</span></label>
                <div class="editor-container">
                  <?php echo Form::textarea('content', old('content') ,['id' => 'ckeditor', 'class' => 'form-control', 'required' => '']); ?>
                </div>
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

@section('page-footer-scripts')
<script>
  $(function () {   
    var base_url = '<?php echo url('/'); ?>';
    
    $(".email-template").change(function(){
      var email_template_id = $(this).val();
      $('.editor-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
      var url = base_url + '/email_template/ajax_load_email_template_content';
      $.ajax({
           type: "GET",
           url: url,               
           data: {
              "email_template_id":email_template_id
              }, 
           success: function(o)
           {
              $('.editor-container').html(o);
           }
      });
    });
    $('.select_recipient').select2();
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('ckeditor');

  });
</script>
@endsection

