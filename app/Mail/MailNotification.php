<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $subject, $message)
    {
        $this->name    = $name;
        $this->email   = $email;
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
        return $this->from($this->email)
                    ->markdown('emails.test_notification') // test_notification.blade.php file is located in 'resources/views/emails' folder
                        ->with([
                            'name' => $this->name,
                            'subject' => $this->subject,
                            'message' => $this->message
                        ]);          
    }
}
