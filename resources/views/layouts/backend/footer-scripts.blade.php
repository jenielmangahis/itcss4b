<!-- REQUIRED JS SCRIPTS -->
<div id="modal-quick-search-company" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      {{ Form::open(array('url' => 'contact/quick_search', 'class' => '', 'method' => 'post')) }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa fa-search"></i> Quick Search</h4>
      </div>
		<div class="modal-body">
			<div class="box-body">
		      <div class="form-group">
		        <label>Search Name</label>
		        <select class="search-contact-name form-control" name="qs_contact"></select>
		      </div>
			</div>
		</div>
      	<div class="modal-footer">
		    <button type="submit" class="btn btn-primary"><i class="fa fa fa-search"></i> Search</button>
		</div>
      {!! Form::close() !!}  
    </div>
  </div>
</div>

<script>
var base_url = '<?php echo url("/"); ?>';
</script>
<!-- jQuery 3 -->
<script src="{{ asset ('/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset ('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset ('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset ('/bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset ('/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset ('/bower_components/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<script src="{{ asset ('/bower_components/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset ('/js/admin.js') }}"></script>
<!-- Select2 - dropdown -->
<script src="{{ asset ('/js/select2.min.js') }}"></script>

<!-- Bootstrap Datepicker -->
<script src="{{ asset ('/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- Add pignose js here -->
<script src="{{ asset ('/bower_components/pg-calendar/js/pignose.calendar.full.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset ('/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- multiple email textfield -->
<script src="{{ asset ('/bower_components/email-eddress-multiple/multiple-emails.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset ('/bower_components/chart.js/Chart.js') }}"></script>
