<h4 style="float:left"> Merchants/Companies </h4>
<table border="1" cellpadding="8" width="941" >
  <tr style="background-color: #cccccc">
    <th colspan="5" style="text-align: left;">&nbsp;</th>
  </tr>  
  <tr>
    <th>#</th>
    <th>Company Name</th>
    <th>Contact Name</th>
    <th>Email</th>
    <th>Contact Number</th>    
  </tr>
  @foreach($merchants_log as $merchant_log)
      <tr>
          <td>{{ $merchant_log->id }}</td>
          <td>{{ $merchant_log->name }}</td>
          <td>{{ $merchant_log->firstname }} {{ $merchant_log->lastname }}</td>
          <td>{{ $merchant_log->email }}</td>
          <td>{{ $merchant_log->contact_number }}</td>
      </tr>
  @endforeach  
  <tr>
    <th colspan="4">&nbsp;</th>
  </tr>  

</table>
<?php
$filename = "merchants_log.xls";
header("Content-type: application/x-msexcel;charset=UTF-8");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
?>