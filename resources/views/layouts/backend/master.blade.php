@yield('header-php')
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @include('layouts.backend.meta-essentials')
  @yield('meta-dynamic')
  @include('layouts.backend.favicons')
  @include('layouts.backend.styles')
  @include('layouts.backend.fonts')  
</head>

<?php $body_class = "hold-transition skin-blue sidebar-mini"; ?>
<body id="{{ $body_id }}" class="{{ $body_class }}">

<div class="wrapper">

  <!-- Main Header -->
  @include('layouts.backend.main-header')  

  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.backend.main-sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('main')

  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('layouts.backend.footer') 

  <!-- Control Sidebar -->
  {{-- @include('layouts.backend.control-sidebar') --}} 

</div>
<!-- ./wrapper -->

@include('layouts.backend.footer-scripts')
@yield('page-footer-scripts')

</body>
</html>