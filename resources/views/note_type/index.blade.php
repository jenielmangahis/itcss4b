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
      Note Types
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
        
        <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Note Type List</h3>
                    <div class="pull-right">
                        <a href="{{route('note_type/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create New
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                  <div class="row">
                    {{ Form::open(array('url' => 'note_type', 'class' => '', 'method' => 'get')) }}

                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Search By: </label><br />
                              <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
                                <option value="name" selected="selected">Name</option>
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
                              <a class="btn btn-success" href="{{route('note_type')}}">Refresh</a>
                            </div>
                            <!-- /.form-group -->
                          </div>
                        </div>                

                      </div>                      
                    {!! Form::close() !!}         
                  </div>

                  <table class="table table-bordered table-hover">
                    <tr>
                      <th style="width: 1%;" >#</th>
                      <th>Name</th>
                      <th style="width:10%;">Action</th>
                    </tr>
                    @foreach($note_types as $mt)
                        <tr>
                            <td>{{ $mt->id }}</td>
                            <td>{{ $mt->name }}</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDelete-<?= $mt->id; ?>">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                <a href="{{route('note_type/edit',[Hashids::encode($mt->id)])}}" class="btn btn-xs btn-primary">
                                    <i class="fa fa-edit"></i> Edit
                                </a>                                                              
                            </td>
                        </tr>

                        <div id="modalDelete-<?= $mt->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete selected note type?
                                </div>
                                <div class="modal-footer">
                                  {{ Form::open(array('url' => 'note_type/destroy')) }}
                                    <?php echo Form::hidden('id', Hashids::encode($mt->id) ,[]); ?>
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
                <!-- /.box-body -->

                <div style="text-align: center;" class="box-footer clearfix">
                    {{ $note_types->links() }}
                </div>

              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
  <!-- /.content -->
@endsection

