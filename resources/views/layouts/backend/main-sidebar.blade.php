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
	  @if(Auth::user()->group_id == 1)
	  	@include('layouts.backend.sections.admin-user-sidebar')
	  @elseif(Auth::user()->group_id == 2)
	  	@include('layouts.backend.sections.company-user-sidebar')
	  @endif
	  <!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>