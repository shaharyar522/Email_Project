<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class welcomeemail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    // Data ko class ke andar lane ka kaam karta hai
    // Jo values tum object banate waqt dete ho, constructor unko receive karke class ke andar store karta hai.

    public $mailmessage;
    public $mailsubject;
    public $details;

    public function __construct($message, $subject, $details)
    {
        $this->mailmessage = $message;
        $this->mailsubject = $subject;
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mailsubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.welcome-mail',
            //      with: [
            //     'bodyMessage' => $this->mailmessage, // change key name
            //     'mailsubject' => $this->mailsubject,
            // ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
