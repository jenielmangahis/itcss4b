<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactNoteNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $to_email, $from_email, $subject, $message)
    {
        $this->name    = $name;
        $this->from_email = $from_email;
        $this->to_email   = $to_email;
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
        return $this->from($this->from_email, "Core-CRM")
                    ->subject($this->subject)
                    ->markdown('emails.note_notification')
                        ->with([
                            'name'    => $this->name,
                            'subject' => $this->subject,
                            'message' => $this->message
                        ]);                 
    }
}
