<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Attachable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
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

    public $request;
    public $fileName;
    // public $details;

    public function __construct($request, $fileName)
    {
        $this->request = $request;
        $this->fileName = $fileName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Contact Form",
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
        $attachments = [];

        if($this->fileName){

            $attachments = [
                Attachment::fromPath(public_path('uploads/'. $this->fileName))
            ];

        }
        return $attachments;

    }
}
