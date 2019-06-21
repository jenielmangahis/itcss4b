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
      Contacts : Campaign
    </h1>
    
    <ol class="breadcrumb">
      <li><a href="{{route('contact')}}"><i class="fa fa-dashboard"></i> Contacts</a></li>
      <li class="active">Campaign</li>
    </ol> 

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

        <div class="box box-primary">
          <div class="box-body">
            <div class="box-header ">
                <div class="pull-left">
                    <a href="{{route('contact/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Create New
                    </a>
                </div>
                </div>
          </div>
        </div>  

        <div class="box box-primary">

          <div class="box-body">
            <div class="row">
              {{ Form::open(array('url' => 'contact_campaign', 'class' => '', 'method' => 'get')) }}

                <div class="col-xs-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Search By: </label><br />
                        <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
                          <option value="title" selected="selected">Title</option>
                        </select>
                        <input class="form-control" type="text" value="<?php echo $search_field; ?>" name="search_field" placeholder="Default Search" style="width: 70%; float: right;">
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>&nbsp;</label><br />
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a class="btn btn-success" href="{{route('contact_campaign')}}">Refresh</a>
                      </div>
                      <!-- /.form-group -->
                    </div>
                  </div>                

                </div>                      
              {!! Form::close() !!}         
            </div>  

            <table class="table table-bordered">
              <tr>
                <th>Status</th>
                <th>Created At</th>
                <th>Created By</th>
                <th>Title</th>
                <th>Source</th>
                <th>Cost</th>
                <th>Priority</th>
                <th>Media</th>
                <th>Purchase Amount</th>
                <th>Action</th>
              </tr>
              @foreach($campaigns as $camp)
                  <tr>
                      <?php $camp->status == 1 ? $status = 'Active' : $active = 'Inactive'; ?>
                      <td>{{ $status }}</td>
                      <td>{{ date("m/d/Y g:i a", strtotime($camp->created_at)) }}</td>
                      <td>-</td>
                      <td>{{ $camp->title }}</td>
                      <td>-</td>
                      <td>{{ $camp->campaign_cost }}</td>
                      <td>{{ $camp->priority }}</td>
                      <td>-</td>
                      <td>{{ $camp->purchase_amount }}</td>
                      <td>
                          <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDelete-<?= $camp->id; ?>">
                              <i class="fa fa-trash"></i> Delete
                          </a>
                          <a href="{{route('contact/edit',[Hashids::encode($camp->id)])}}" class="btn btn-xs btn-primary">
                              <i class="fa fa-edit"></i> Edit
                          </a>                                                              
                      </td>
                  </tr>

                  <div id="modalDelete-<?= $camp->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete selected campaign?
                          </div>
                          <div class="modal-footer">
                            {{ Form::open(array('url' => 'contact/destroy')) }}
                              <?php echo Form::hidden('id', Hashids::encode($camp->id) ,[]); ?>
                              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              <button type="submit" class="btn btn-danger">Yes</button>
                            {!! Form::close() !!}
                          </div>

                        </div>
                      </div>
                  </div>   

              @endforeach
            </table>

          </div>   

          <div style="text-align: center;" class="box-footer clearfix">
              {{ $campaigns->links() }}
          </div>          

        </div>    
        

    </section>
  <!-- /.content -->
@endsection

@section('page-footer-scripts')
<script>
  var base_url = '<?php echo url("/"); ?>'; 

</script>
@endsection


