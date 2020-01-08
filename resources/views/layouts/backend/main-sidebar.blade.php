<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

	  <!-- Sidebar user panel (optional) -->
	  <div class="user-panel">
	    <div class="pull-left image">
	      
	        @if(file_exists(public_path() . "/uploads/users/".Auth::user()->profile_img) && Auth::user()->profile_img != "")
	          <img src="{{ asset("/uploads/users/".Auth::user()->profile_img) }}" class="user-image" alt="User Image"/>
	        @else
	          <img src="{{ asset('/images/user-default-160x160.jpg') }}" class="img-circle" alt="User Image">          
	        @endif  	      
	    </div>
	    <div class="pull-left info">
	      <p><?= Auth::user()->firstname ?> <?= Auth::user()->lastname ?></p>
	      <!-- Status -->
	      <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
	    </div>
	  </div>

	  <!-- Sidebar Menu -->
	  @include('layouts.backend.sections.user-sidebar')

	  <!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>