@extends('layouts.backend.master')
<style>
.nav-tabs-custom>.tab-content{
  border:1px solid #d2d6de !important;
  box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.nav-tabs-custom>.nav-tabs{
  background-color: #3c8dbc !important;
}
.nav-tabs-custom>.nav-tabs>li a{
  color: #ffffff !important;
}
.nav-tabs-custom>.nav-tabs>li.active a{
  color: #000000 !important;
}
.nav-tabs-custom>.nav-tabs>li.active {
  padding-left: 3px;
}
</style>
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
      Contacts | Edit
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

          {{ Form::open(array('url' => 'contact/update', 'class' => '', 'id' => 'edit-contact-form')) }}
          <input type="hidden" name="id" value="<?= Hashids::encode($contact->id); ?>">
          <input type="hidden" id="c_user_id" name="c_user_id" value="<?= Hashids::encode($contact->user_id); ?>">            
            <div class="box-body">
              <div id="" class="form-group">
                <div class="box-body">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab_variation_0" data-toggle="tab"><strong>Contact Information</strong></a></li>
                      <li class=""><a href="#tab_variation_1" data-toggle="tab"><strong>Business Information</strong></a></li>
                      <li class=""><a href="#tab_variation_2" data-toggle="tab"><strong>Loan Information</strong></a></li>
                      <li class=""><a href="#tab_variation_3" data-toggle="tab"><strong>Broker Information</strong></a></li>
                    </ul>

                    <div class="tab-content">
                      <div class="active tab-pane" id="tab_variation_0">
                        @include('contact.edit_personal_info')
                      </div>
                      <div class="tab-pane" id="tab_variation_1">
                        @include('contact.edit_business_info')
                      </div>

                      <div class="tab-pane" id="tab_variation_2">
                        @include('contact.edit_loan_info')
                      </div>

                      <div class="tab-pane" id="tab_variation_3">
                        @include('contact.edit_broker_info')
                      </div>

                    </div>
                  </div>
                </div>
              </div>
                                                                                                                                       
            </div>            
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Update</button>
              <a class="btn btn-primary" href="{{route('contact')}}">Cancel</a>
            </div>
          {!! Form::close() !!}     

        </div>        

    </section>
  <!-- /.content -->
@endsection

@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>'; 

  $("#filed_bankruptcy").change(function(){
    var selected = $(this).val();
    if( selected == 'Yes' ){
      $(".date-bankruptcy-container").removeClass("hide");
    }else{
      $(".date-bankruptcy-container").addClass("hide");
    }
  });
  function load_company_users_dropdown() {
    
      /*$.get(base_url + '/contact/ajax_load_company_users', $('#add-contact-form').serialize() , function (o) {
        $('#company-users-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');

        setTimeout(function () {
          $('#company-users-container').html(o);
        }, 250);
      }); */ 

      var company_id = $('#company_id').val();
      var c_user_id  = $('#c_user_id').val();
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

  function load_stage_status_dropdown() {
    var stage_id = $('#stage_id').val();
    var status = "<?php echo $contact->status; ?>";
    $('#stage-status-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');
    var url = base_url + '/workflow/ajax_load_stage_status'
    $.ajax({
         type: "GET",
         url: url,               
         data: {"stage_id":stage_id,"status":status}, 
         success: function(o)
         {
            $('#stage-status-container').html(o);
         }
    });
  }

  $(function () {

    $('.bankruptcy_filed').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    })    

    load_company_users_dropdown();
    load_stage_status_dropdown();
    $('#company_id').change(function () {

      /*$.get(base_url + '/contact/ajax_load_company_users', $('#add-contact-form').serialize() , function (o) {
        $('#company-users-container').html('<br /><div style="text-align: center;" class="wrap"><i class="fa fa-spin fa-spinner"></i> Loading</div><br />');

        setTimeout(function () {
          $('#company-users-container').html(o);
        }, 250);
      });*/

      var company_id = $('#company_id').val();
      var c_user_id  = $('#c_user_id').val();
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

    $('#stage_id').change(function(){
      load_stage_status_dropdown();
    }); 
  });

</script>
@endsection


