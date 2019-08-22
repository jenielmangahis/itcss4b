<!-- Tasks Menu -->
<li class="dropdown tasks-menu">
<!-- Menu Toggle Button -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-flag-o"></i>
  @if(isset($pending_task_count) && (!empty($pending_task_count) || $pending_task_count > 0))
    <span class="label label-danger">{{$pending_task_count}}</span>
  @endif
</a>
<ul class="dropdown-menu">
  <li class="header">
    <?php $pending_task_count_value = isset($pending_task_count) ? $pending_task_count : 0; ?>
    <strong>You have {{ $pending_task_count_value }} pending tasks</strong>
  </li>
  <li>
    <!-- Inner menu: contains the tasks -->
    @if(isset($pending_task) && $pending_task)
    <ul class="menu">
      @foreach($pending_task as $ptask)
        <li>
          <a href="<?php echo url('contact_dashboard/' . Hashids::encode($ptask->contact_id) . '#tab_tasks') ?>">
            <h3>
              <strong>Task No.: {{$ptask->id}}</strong> - {{ $ptask->title }}
              <!-- <small class="pull-right">-</small> -->
            </h3>
            <!-- <div class="progress xs">
              <div class="progress-bar progress-bar-aqua" style="width: 100%" role="progressbar"
                   aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only">100% Complete</span>
              </div>
            </div> -->
          </a>
        </li>
      @endforeach
    </ul>
    @else
      <ul class="menu">
        <li>NO PENDING TASK</li>
      </ul>
    @endif
  </li>
  <!-- <li class="footer">
    <a href="#">View all tasks</a>
  </li> -->
</ul>
</li>