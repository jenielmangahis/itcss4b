	<ul class="sidebar-menu" data-widget="tree">
		
	    <li class="header">ADMIN</li>
	    <!-- Optionally, you can add icons to the links -->
	    <li <?php echo Route::current()->getName() == 'dashboard' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard </span></a>
	    </li>

	    <li <?php echo Route::current()->getName() == 'companies' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('contact')}}"><i class="fa fa-phone-square"></i> <span>Contacts </span></a>
	    </li>

	    <!-- <li <?php //echo Route::current()->getName() == 'lender' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('lender')}}"><i class="fa fa-money"></i> <span>Lenders </span></a>
	    </li> -->

	    <!-- <li <?php //echo Route::current()->getName() == 'mail_messaging' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('mail_messaging')}}"><i class="fa fa-envelope-open"></i> <span>Mail Messaging </span></a>
	    </li> -->

	    <!-- <li <?php //echo Route::current()->getName() == 'email_template' ? 'class="active"' : ''; ?>>
	    	<a href="{{route('email_template')}}"><i class="fa fa-mail-reply-all"></i> <span>Email Templates </span></a>
	    </li> -->

	</ul>