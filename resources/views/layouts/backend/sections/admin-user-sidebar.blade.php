	<ul class="sidebar-menu" data-widget="tree">
		
	    <li class="header">ADMIN</li>
	    <!-- Optionally, you can add icons to the links -->
	    <li <?php echo Route::current()->getName() == 'dashboard' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard </span></a>
	    </li>
	    <li <?php echo Route::current()->getName() == 'companies' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('companies')}}"><i class="fa fa-briefcase"></i> <span>Companies / Merchants </span></a>
	    </li>
	    <?php 
	    	$multi_tab_product = '';
	    	if(Route::current()->getName() == 'users' || Route::current()->getName() == 'groups' || Route::current()->getName() == 'company_users' || Route::current()->getName() == 'company_users/create' || Route::current()->getName() == 'company_users/edit') {
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
	        <li <?php echo Route::current()->getName() == 'company_users' ? 'class="active"' : ''; ?>><a href="{{route('company_users')}}"><i class="fa fa-odnoklassniki"></i>MCA Funders</a></li>
	        <li><a href="{{route('groups')}}"><i class="fa fa-gear"></i>Groups</a></li>
	      </ul>
	    </li>

	    <li <?php echo Route::current()->getName() == 'contact' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('contact')}}"><i class="fa fa-phone-square"></i> <span>Contacts </span></a>
	    </li>

	    <li <?php echo Route::current()->getName() == 'lender' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('lender')}}"><i class="fa fa-money"></i> <span>Lenders </span></a>
	    </li>

	    <li <?php echo Route::current()->getName() == 'mail_messaging' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('mail_messaging')}}"><i class="fa fa-envelope-open"></i> <span>Mail Messaging </span></a>
	    </li>	    

	    <li <?php echo Route::current()->getName() == 'email_template' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('email_template')}}"><i class="fa fa-mail-reply-all"></i> <span>Email Templates </span></a>
	    </li>

	    <li <?php echo Route::current()->getName() == 'workflow' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('workflow')}}"><i class="fa fa-server"></i> <span>Workflow </span></a>
	    </li>

	    <!-- <li <?php //echo Route::current()->getName() == 'reports' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('companies')}}"><i class="fa fa-newspaper-o"></i> <span>Reports </span></a>
	    </li> -->

	    <?php 
	    	$multi_tab_settings = '';
	    	if(Route::current()->getName() == 'stage' || Route::current()->getName() == 'workflow_category' 
	    		|| Route::current()->getName() == 'media_type' || Route::current()->getName() == 'event_type'
	    		|| Route::current()->getName() == 'source' || Route::current()->getName() == 'note_type'
	    	) {
	    		$multi_tab_settings = 'active';
	    	}
	    ?>

	    <li class="treeview {{ $multi_tab_settings }}">
	      <a href="#"><i class="fa fa-gear"></i> <span>Settings</span>
	        <span class="pull-right-container">
	            <i class="fa fa-angle-left pull-right"></i>
	          </span>
	      </a>
	      <ul class="treeview-menu">
	        <li <?php echo Route::current()->getName() == 'workflow_category' ? 'class="active"' : ''; ?>><a href="{{route('workflow_category')}}"><i class="fa fa-circle-o"></i>Workflow Category</a></li>
	        <li <?php echo Route::current()->getName() == 'stage' ? 'class="active"' : ''; ?>><a href="{{route('stage')}}"><i class="fa fa-circle-o"></i>Stage</a></li>
	        <li <?php echo Route::current()->getName() == 'media_type' ? 'class="active"' : ''; ?>><a href="{{route('media_type')}}"><i class="fa fa-circle-o"></i>Media Types</a></li>
	        <li <?php echo Route::current()->getName() == 'event_type' ? 'class="active"' : ''; ?>><a href="{{route('event_type')}}"><i class="fa fa-circle-o"></i>Event Types</a></li>
	        <li <?php echo Route::current()->getName() == 'note_type' ? 'class="active"' : ''; ?>><a href="{{route('note_type')}}"><i class="fa fa-circle-o"></i>Note Types</a></li>
	        <li <?php echo Route::current()->getName() == 'source' ? 'class="active"' : ''; ?>><a href="{{route('source')}}"><i class="fa fa-circle-o"></i>Sources</a></li>
	        <li <?php echo Route::current()->getName() == 'state' ? 'class="active"' : ''; ?>><a href="{{route('state')}}"><i class="fa fa-circle-o"></i>States</a></li>
	      </ul>
	    </li>

	</ul>