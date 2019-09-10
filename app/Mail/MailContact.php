<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from_email, $subject, $message)
    {
        $this->from_email   = $from_email;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->from($this->from_email)
                    ->markdown('emails.mail_contact') // mail_cotact.blade.php file is located in 'resources/views/emails' folder
                        ->with([
                            'subject' => $this->subject,
                            'message' => $this->message
                        ]);          
    }
}
