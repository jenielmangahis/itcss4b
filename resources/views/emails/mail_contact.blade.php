@component('mail::message')
# Contact Mail

<p>Name:  <?= $name; ?>,</p>
<p>Subject:  <?= $subject; ?>,</p>

<p>Message: <br /> <?= $message; ?></p>

Regards,<br>
coreCMS admin
@endcomponent
