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
      User Management
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
                    <h3 class="box-title">User List</h3>
                    <div class="pull-right">
                        @if(UserHelper::checkUserRolePermission(Auth::user()->group_id, 'users', 'create'))
                          <a href="{{route('user/create')}}" class="btn btn-primary">
                              <i class="fa fa-plus"></i> Create New
                          </a>
                        @endif
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                  <div class="row">
                    {{ Form::open(array('url' => 'users', 'class' => '', 'method' => 'get')) }}

                      <div class="col-xs-12">
                        <!-- <div><a href="javascript:ajaxLoadTaskFilter();">load</a></div> -->
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Search By: </label><br />
                              <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
                                <option value="firstname" selected="selected">Firstname</option>
                                <option value="lastname">Lastname</option>
                                <option value="email" >Email</option>
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
                              <a class="btn btn-success" href="{{route('users')}}">Refresh</a>
                            </div>
                            <!-- /.form-group -->
                          </div>
                        </div>                

                      </div>                      
                    {!! Form::close() !!}         
                  </div>

                  <table class="table table-bordered">
                    <tr>
                      <th >#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Group</th>
                      <th>Action</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_active == 0 ? 'active' : 'Suspended' }}</td>
                            <td>{{ !empty($user->group->name) ? $user->group->name : '-' }}</td>
                            <td>
                                <?php $edit_access = UserHelper::checkUserRolePermission(Auth::user()->group_id, 'users', 'edit');  ?>
                                @if($edit_access)
                                  <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDelete-<?= $user->id; ?>">
                                      <i class="fa fa-trash"></i> Delete
                                  </a>
                                @endif
                                <?php $delete_access = UserHelper::checkUserRolePermission(Auth::user()->group_id, 'users', 'delete');  ?>
                                 @if($delete_access)
                                  <a href="{{route('user/edit',[Hashids::encode($user->id)])}}" class="btn btn-xs btn-primary">
                                      <i class="fa fa-edit"></i> Edit
                                  </a> 
                                @endif                                                             
                            </td>
                        </tr>

                        <div id="modalDelete-<?= $user->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete selected user?
                                </div>
                                <div class="modal-footer">
                                  {{ Form::open(array('url' => 'user/destroy')) }}
                                    <?php echo Form::hidden('id', Hashids::encode($user->id) ,[]); ?>
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
                    {{ $users->links() }}
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

