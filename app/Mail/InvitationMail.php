<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\FormTicket; // Import FormTicket model
use Illuminate\Mail\Mailables\Attachment;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formTicket; // Store the FormTicket instance

    /**
     * Create a new message instance.
     */
    public function __construct(FormTicket $formTicket)
    {
        $this->formTicket = $formTicket;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre invitation pour EK MODERN INTERIOR',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'invitation',
            with: [
                'formTicket' => $this->formTicket, // Pass data to the view
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return
        [
            Attachment::fromPath(public_path('asset/pdf/ek_modern_interior_invite.pdf'))
            ->as('Votre_Invitation.pdf')
            ->withMime('application/pdf'),
        ];
    }
}
