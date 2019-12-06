@component('mail::message')
# <?= $subject; ?>

<?= $message; ?></p>

@component('mail::button', ['url' => $url])
GO TO CONTACT DETAILS
@endcomponent

Regards,<br>
coreCMS team
@endcomponent
