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

  <?php $body_class = "hold-transition login-page"; ?>
  <body id="{{ $body_id }}" class="{{ $body_class }}">    
    @yield('main')
    @yield('page-footer-scripts')
  </body>  

</html>