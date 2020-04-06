<h4 style="float:left"> Users Log </h4>
<table border="1" cellpadding="8" width="941" >
  <tr style="background-color: #cccccc">
    <th colspan="4 style="text-align: left;">&nbsp;</th>
  </tr>  
  <tr>
    <th>#</th>
    <th>Name</th>
    <th style="text-align: right;">Date</th>
    <th style="text-align: right;">Total Entry</th>
  </tr>
  @foreach($users_log as $usr_log)
    <tr>
      <td>{{ $usr_log->id }}</td>
      <td>{{ $usr_log->firstname }} {{ $usr_log->lastname }}</td>
      <td style="text-align: right;"><?php echo date("F j, Y", strtotime($usr_log->login_date));?></td>
      <td style="text-align: right;">{{ UserHelper::getTotalUserContactEntryByDate($usr_log->user_id, $usr_log->login_date) }}</td>
    </tr>
  @endforeach
  <tr>
    <th colspan="4">&nbsp;</th>
  </tr>  

</table>
<?php
$filename = "users_log.xls";
header("Content-type: application/x-msexcel;charset=UTF-8");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
?>