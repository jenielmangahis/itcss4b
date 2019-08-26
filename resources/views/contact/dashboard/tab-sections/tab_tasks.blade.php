<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Tasks</div>
    <div class="pull-right">
        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddTask">
            <i class="fa fa-plus"></i> Add Task
        </a>          
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>

<div class="row">
  {{ Form::open(array('url' => 'contact_dashboard/'.$contact_id, 'class' => '', 'method' => 'get')) }}

    <div class="col-xs-12">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Search By: </label><br />
            <select name="search_by" class="form-control select2" style="width: 30%; float: left;">
              <option value="title" selected="selected">Task</option>
            </select>
            <input class="form-control" type="text" value="<?php echo $search_task_field; ?>" name="search_task_field" placeholder="Default Search" style="width: 70%; float: right;">
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="form-group">
            <label>&nbsp;</label><br />
            <button type="submit" class="btn btn-primary">Filter</button>
            <a class="btn btn-success" href="{{url('contact_dashboard/'.$contact_id)}}">Refresh</a>
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
    <th>Task</th>
    <th>Status</th>
    <th>Assigned To</th>
    <th>Created By</th>
    <th>Due Date</th>
    <th>Days</th>
    <th style="width:10%;">Action</th>
  </tr>
  @foreach($contact_tasks as $task)
    <?php 
      $assigned_user = "";
      if(!empty($task->assigned_user) || $task->assigned_user != 0) {
        $assigned_user_id = unserialize($task->assigned_user);
        $assigned_user = App\User::find($assigned_user_id);
      }
    ?>
    <tr>
      <td>{{ $task->id }}</td>
      <td>{{ $task->title }}</td>
      <td>{{ $task->status }}</td>
      @if($assigned_user)
         <td><?php echo $assigned_user->firstname . " " . $assigned_user->lastname; ?></td>
      @else
         <td>-</td>
      @endif
     
      @if(isset($task->user->firstname))
        <td>{{ $task->user->firstname }} {{ $task->user->lastname }}</td>
      @else
        <td>-</td>
      @endif
      <td>{{ $task->due_date }}</td>
      <td><?php echo GlobalHelper::computeDaysBetweenDates(date('Y-m-d'), $task->due_date); ?></td>
      <td>
        <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDeleteTask-<?= $task->id; ?>">
            <i class="fa fa-trash"></i>
        </a>
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalEditTask-<?= $task->id; ?>">
            <i class="fa fa-edit"></i>
        </a> 
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalViewTask-<?= $task->id; ?>">
            <i class="fa fa-window-maximize"></i>
        </a>                                                     
      </td>
    </tr>  

    <div id="modalDeleteTask-<?= $task->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Delete</h4>
            </div>
            <div class="modal-body">
              Are you sure you want to delete selected task?
            </div>
            <div class="modal-footer">
              {{ Form::open(array('url' => 'contact_task/destroy')) }}
                <?php echo Form::hidden('id', Hashids::encode($task->id) ,[]); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
              {!! Form::close() !!}
            </div>

          </div>
        </div>
    </div>  

    <div id="modalEditTask-<?= $task->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
        {{ Form::open(array('url' => 'contact_task/update', 'class' => '', 'id' => 'edit-task-form')) }}
          <input type="hidden" name="id" value="<?= Hashids::encode($task->id); ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Update Task</h4>
              </div>
              <div class="modal-body">

                <div class="form-group">
                  <label for="inputLocation">Contact: </label>
                  {{ $contact->firstname }} {{ $contact->lastname }}
                </div>   

                <div class="form-group">
                  <label for="inputTitle">Title</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" placeholder="Enter Title" required="">
                </div>         

                <div class="form-group">
                  <label for="inputDescription">Notes</label>
                  <textarea rows="4" cols="50" class="form-control" id="task_notes-{{$task->id}}"  name="notes" required="">{{ $task->notes }}</textarea>
                </div>            

                <div class="row">
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="inputDate">Due Date</label>
                      <input type="text" class="form-control due_date" id="due_date" name="due_date" value="{{ $task->due_date }}" placeholder="" required="">
                    </div>                
                  </div>
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="inputAssignedUser">Assigned User</label>
                      <select name="assigned_user" id="assigned_user" class="form-control">
                        @if( !empty($company_users->toArray()) )
                          @foreach($company_users as $company_user)   

                            <?php 
                              $assigned_user_id = 0;
                              if(!empty($task->assigned_user) || $task->assigned_user != 0) {
                                $assigned_user_id = unserialize($task->assigned_user);
                                $assigned_user = App\User::find($assigned_user_id);
                              }
                            ?>

                            <option <?php echo $assigned_user_id == $company_user->user_id ? 'selected="selected"' : ''; ?> value="{{ $company_user->user_id }}">{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</option>
                          @endforeach
                        @else
                          <select name="assigned_user" id="assigned_user" class="form-control">
                            <option value="">No company users available</option>
                          </select>
                        @endif
                      </select>                   
                    </div>                
                  </div>
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="inputStatusr">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option <?php echo $task->status == 'pending' ? 'selected="selected"' : ''; ?> value="pending">Pending</option>
                        <option <?php echo $task->status == 'in_progress' ? 'selected="selected"' : ''; ?> value="in_progress">In progress</option>
                        <option <?php echo $task->status == 'closed' ? 'selected="selected"' : ''; ?> value="closed">Closed</option>
                        <option <?php echo $task->status == 'completed' ? 'selected="selected"' : ''; ?> value="completed">Completed</option>
                      </select>                   
                    </div>                
                  </div>                  
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-default">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>

            </div>
          </div>
        {!! Form::close() !!}        
    </div>  

    <div id="modalViewTask-<?= $task->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
          <input type="hidden" name="id" value="<?= Hashids::encode($task->id); ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">View Details</h4>
              </div>
              <div class="modal-body">

                <div class="form-group">
                  <label for="inputLocation">Contact: </label>
                  {{ $contact->firstname }} {{ $contact->lastname }}
                </div>   

                <div class="form-group">
                  <label for="inputTitle">Title</label>
                  <p>{{$task->title}}</p>
                </div> 

                <div class="form-group">
                  <label for="inputDescription">Notes</label>
                  <?php echo $task->notes; ?>
                </div>    

                <div class="row">
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="inputDate">Due Date</label>
                      <p><?php echo date("F j, Y, g:i a", strtotime($task->due_date)); ?></p>
                    </div>                
                  </div>
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="inputAssignedUser">Assigned User</label>
                        @if( !empty($company_users->toArray()) )
                          @foreach($company_users as $company_user)   

                            <?php 
                              $assigned_user_id = 0;
                              if(!empty($task->assigned_user) || $task->assigned_user != 0) {
                                $assigned_user_id = unserialize($task->assigned_user);
                                $assigned_user = App\User::find($assigned_user_id);
                              }
                            ?>

                            <p>{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</p>
                          @endforeach
                        @else
                          <p>No company users available</p>
                        @endif                  
                    </div>                
                  </div>
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="inputStatusr">Status</label>
                      <p>{{ $task->status }}</p>                
                    </div>                
                  </div>                  
                </div>
              </div>

            </div>
          </div>     
    </div>        

  @endforeach
</table>

<div style="text-align: center;" class="box-footer clearfix">
    {{ $contact_tasks->links() }}
</div>

<div id="modalAddTask" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => 'contact_task/store', 'class' => '', 'id' => 'add-task-form')) }}
      <input type="hidden" name="contact_id" id="contact_id" value="{{ $contact_id }}">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Task</h4>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <label for="inputLocation">Contact: </label>
              {{ $contact->firstname }} {{ $contact->lastname }}
            </div>   

            <div class="form-group">
              <label for="inputTitle">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Enter Title" required="">
            </div>         

            <div class="form-group">
              <label for="inputDescription">Notes</label>
              <textarea rows="4" cols="50" class="form-control" id="task_notes" name="notes" required="">{{old('notes')}}</textarea>
            </div>            

            <div class="row">
              <div class="col-xs-6">
                <div class="form-group">
                  <label for="inputDate">Due Date</label>
                  <input type="text" class="form-control due_date" id="due_date" name="due_date" value="{{old('due_date')}}" placeholder="" required="">
                </div>                
              </div>
              <div class="col-xs-6">
                <div class="form-group">
                  <label for="inputAssignedUser">Assigned User</label>
                  <select name="assigned_user" id="assigned_user" class="form-control">
                    @if( !empty($company_users->toArray()) )
                      @foreach($company_users as $company_user)   
                        <option value="{{ $company_user->user_id }}">{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</option>
                      @endforeach
                    @else
                      <select name="assigned_user" id="assigned_user" class="form-control">
                        <option value="">No company users available</option>
                      </select>
                    @endif
                  </select>                   
                </div>                
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    {!! Form::close() !!}        
</div>

