<div class="box box-primary">
  <ul class="sidebar-menu" data-widget="tree">
  
    <!-- Optionally, you can add icons to the links -->
    <li <?php echo Route::current()->getName() == 'advance_application' ? 'class="active"' : ''; ?>>
      <a href="{{url('advance_application/' . $hash_id)}}"><i class="fa fa-list-ul"></i> <span>Application </span></a>
    </li>
    <li <?php echo Route::current()->getName() == 'dashboard' ? 'class="active"' : ''; ?>>
      <a href="#"><i class="fa fa-list-ul"></i> <span>Financials </span></a>
    </li>
    <li <?php echo Route::current()->getName() == 'advance_documents' ? 'class="active"' : ''; ?>>
      <a href="{{url('advance_documents/' . $hash_id)}}"><i class="fa fa-list-ul"></i> <span>Documents </span></a>
    </li>
    <li <?php echo Route::current()->getName() == 'dashboard' ? 'class="active"' : ''; ?>>
      <a href="#"><i class="fa fa-list-ul"></i> <span>Applications </span></a>
    </li>
    <li <?php echo Route::current()->getName() == 'dashboard' ? 'class="active"' : ''; ?>>
      <a href="#"><i class="fa fa-list-ul"></i> <span>Submissions </span></a>
    </li>
    <li <?php echo Route::current()->getName() == 'advance_underwriter_notes' ? 'class="active"' : ''; ?>>
      <a href="{{url('advance_underwriter_notes/' . $hash_id)}}"><i class="fa fa-list-ul"></i> <span>Underwriter Notes </span></a>
    </li>
    <li <?php echo Route::current()->getName() == 'advance_funding_info' ? 'class="active"' : ''; ?>>
      <a href="{{url('advance_funding_info/' . $hash_id)}}"><i class="fa fa-list-ul"></i> <span>Funding Info </span></a>
    </li>
    <li <?php echo Route::current()->getName() == 'advance_payments' ? 'class="active"' : ''; ?>>
      <a href="{{url('advance_payments/' . $hash_id)}}"><i class="fa fa-list-ul"></i> <span>Payments </span></a>
    </li>

  </ul>
</div>