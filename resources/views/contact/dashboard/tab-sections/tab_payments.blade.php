<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Payments</div>
    <div class="pull-right">
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>
<table class="table table-bordered table-hover">
  <tr>
    <th>Transaction ID</th>
    <th>Process By</th>
    <th>Process Date</th>
    <th>Amount</th>
    <th>Type</th>
    <th>Memo</th>
    <th>Payee</th>
    <th>Status</th>
    <th style="width:10%;">Action</th>
  </tr>
    <?php foreach($a_payments as $payment){ ?>
      <tr>
        <td><?= $payment['transaction_id']; ?></td>
        <td><?= $payment['process_by']; ?></td>
        <td><?= $payment['process_date']; ?></td>
        <td><?= $payment['amount']; ?></td>
        <td><?= $payment['type']; ?></td>
        <td><?= $payment['memo']; ?></td>
        <td><?= $payment['payee']; ?></td>
        <td><?= $payment['status']; ?></td>
        <td>
          <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalViewAdvancePayment-<?= $payment['payment_advance_id']; ?>">
              <i class="fa fa-window-maximize"></i>
          </a>                                                     
          <div id="modalViewAdvancePayment-<?= $payment['payment_advance_id']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left;">
            <div class="modal-dialog modal-md">
              <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">View Details</h4>
                </div>
                <div class="modal-body">    
                  <table class="table table-bordered table-hover table-view-details">
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Contract Number</td><td><?= $payment['advance']['contract_number']; ?></td></tr>                    
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Loan ID</td><td><?= $payment['advance']['loan_id']; ?></td></tr>
                    <tr><td colspan="2"></td></tr>
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Transaction ID</td><td><?= $payment['transaction_id']; ?></td></tr>
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Process By</td><td><?= $payment['process_by']; ?></td></tr>
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Process Date</td><td><?= $payment['process_date']; ?></td></tr>
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Amount</td><td><?= $payment['amount']; ?></td></tr>
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Type</td><td><?= $payment['type']; ?></td></tr>
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Memo</td><td><?= $payment['memo']; ?></td></tr>
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Payee</td><td><?= $payment['payee']; ?></td></tr>
                    <tr><td style="width: 40%;background-color: #23527c;color:#ffffff;">Status</td><td><?= $payment['status']; ?></td></tr>
                  </table>
                </div>
              </div>
            </div>     
          </div>
        </td>
      </tr>        
    <?php } ?>
</table>  

