@component('mail::message')
# Test Notification

<p>Name:  <?= $name; ?>,</p>
<p>Subject:  <?= $subject; ?>,</p>

<p>Message: <br /> <?= $message; ?></p>

Regards,<br>
<?= $name; ?>
@endcomponent
