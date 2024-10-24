<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContact extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Contact $contact
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thank You for Contacting Us!')
                    ->view('emails.contact_us') // Ensure this view exists
                    ->with([
                        'contact' => $this->contact,
                    ]);
    }
}
