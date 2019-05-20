<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

	  <!-- Sidebar user panel (optional) -->
	  <div class="user-panel">
	    <div class="pull-left image">
	      <img src="images/user-default-160x160.jpg" class="img-circle" alt="User Image">
	    </div>
	    <div class="pull-left info">
	      <p><?= Auth::user()->firstname ?> <?= Auth::user()->lastname ?></p>
	      <!-- Status -->
	      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	    </div>
	  </div>

	  <!-- search form (Optional) -->
	  <!-- <form action="#" method="get" class="sidebar-form">
	    <div class="input-group">
	      <input type="text" name="q" class="form-control" placeholder="Search...">
	      <span class="input-group-btn">
	          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
	          </button>
	        </span>
	    </div>
	  </form> -->
	  <!-- /.search form -->

	  <!-- Sidebar Menu -->
	  <ul class="sidebar-menu" data-widget="tree">
	    <li class="header">ADMIN</li>
	    <!-- Optionally, you can add icons to the links -->
	    <li <?php echo Route::current()->getName() == 'dashboard' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard </span></a>
	    </li>
	    <?php 
	    	$multi_tab_product = '';
	    	if(Route::current()->getName() == 'users' || Route::current()->getName() == 'groups') {
	    		$multi_tab_product = 'active';
	    	}
	    ?>		    
	    <li class="treeview {{ $multi_tab_product }}">
	      <a href="#"><i class="fa fa-user-plus"></i> <span>User Management</span>
	        <span class="pull-right-container">
	            <i class="fa fa-angle-left pull-right"></i>
	          </span>
	      </a>
	      <ul class="treeview-menu">
	        <li <?php echo Route::current()->getName() == 'users' ? 'class="active"' : ''; ?>><a href="{{route('users')}}"><i class="fa fa-odnoklassniki"></i>Users</a></li>
	        <li><a href="{{route('groups')}}"><i class="fa fa-gear"></i>Groups</a></li>
	      </ul>
	    </li>
	  </ul>
	  <!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>