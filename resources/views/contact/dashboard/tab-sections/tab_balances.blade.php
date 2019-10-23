<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Balances</div>
    <div class="pull-right">
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>
<table class="table table-bordered table-hover">
  <tr>
    <th>Loan ID</th>
    <th>Contract Date</th>
    <th>Contract Number</th>
    <th>Advance Date</th>
    <th>Payback</th>
    <th>Balance</th>
    <th>Period</th>
    <th>Payment</th>
    <th>Type</th>
    <th>Status</th>    
  </tr>
    <?php foreach($contactAdvance as $ca){ ?>
      <tr>
        <td><?= $ca->loan_id; ?></td>
        <td><?= date("F j Y", strtotime($ca->contract_date)); ?></td>
        <td><?= $ca->contract_number ?></td>
        <td><?= date("F j Y", strtotime($ca->advance_date)); ?></td>
        <td><?= number_format($ca->payback, 2); ?></td>
        <td><?= number_format($ca->balance, 2); ?></td>
        <td><?= $ca->period; ?></td>
        <td><?= number_format($ca->payment, 2); ?></td>
        <td><?= $ca->advance_type; ?></td>
        <td><?= $ca->status; ?></td>
      </tr>        
    <?php } ?>
</table>   

