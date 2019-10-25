<?php 
  $payback_amount  = 0;
  $advance_payment = 0;
  $count_payment   = 0;

  $balance       = 0;
  $payments_made = 0;
  $return        = 0;
  $last_payment  = 0;
  $performance   = 0;

  if(isset($advance->payback)) {
    $payback_amount = $advance->payback;
  }

  if(isset($total_advance_payment)) {
    $advance_payment = $total_advance_payment;
  }

  if(isset($last_payment_amount)) {
    $last_payment = $last_payment_amount;
  }

  if(isset($count_payment_made)) {
    $count_payment = $count_payment_made;
  }

  $balance = $payback_amount - $advance_payment;

  $performance = ($count_payment / $advance->period) * 100;
?>

<div class="">
  <div class="row">
    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo number_format($balance,2); ?></h3>
          <p>Balance</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo number_format($count_payment,2); ?></h3>
          <p>Payments Made</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo number_format($advance_payment,2); ?></h3>
          <p>Return</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo number_format($last_payment,2); ?></h3>
          <p>Last Payment</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?php echo number_format($performance,2); ?>%</h3>
          <p>Performance</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>
</div>