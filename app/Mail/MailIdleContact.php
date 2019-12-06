<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailIdleContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from_email, $subject, $message, $contact_url)
    {
        $this->from_email   = $from_email;
        $this->subject      = $subject;
        $this->message      = $message;
        $this->contact_url  = $contact_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from_email)
                    ->markdown('emails.mail_idle_contact')
                        ->with([
                            'subject' => $this->subject,
                            'message' => $this->message,
                            'url'     => $this->contact_url,
                        ]);          
    }
}
