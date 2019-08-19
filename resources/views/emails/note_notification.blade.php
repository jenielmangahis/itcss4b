@component('mail::message')

<p>Hello Sir/Ma'am, </p>

<p><?= $message; ?></p>

Regards,<br>
<?php echo 'core-CRM Team'; ?>
@endcomponent
