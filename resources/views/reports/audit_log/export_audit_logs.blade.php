<h4 style="float:left"> Audit Logs </h4>
<table border="1" cellpadding="8" width="941" >
  <tr style="background-color: #cccccc">
    <th colspan="4" style="text-align: left;">&nbsp;</th>
  </tr>  
  <tr>
    <th>#</th>
    <th>Name</th>
    <th style="text-align: right;">Date</th>
    <th style="text-align: right;">Module Actions</th>
  </tr>
  <?php $inc = 1; ?>
  @foreach($audit_logs as $audit_log)
    <tr>
      <td>{{ $inc }}</td>
      <td>{{ $audit_log->firstname }} {{ $audit_log->lastname }}</td>
      <td style="text-align: right;"><?php echo date("F j, Y", strtotime($audit_log->created_at));?></td>
      <td style="text-align: right;">{{$audit_log->module}} : {{$audit_log->title}}</td>
    </tr>
  <?php $inc++; ?>
  @endforeach
  <tr>
    <th colspan="4">&nbsp;</th>
  </tr>  

</table>
<?php
$filename = "audit_logs.xls";
header("Content-type: application/x-msexcel;charset=UTF-8");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
?>