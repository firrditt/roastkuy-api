<?php

namespace App\Mail;

use App\Models\Account;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifiedAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $account;
    public $otp;
    public $type;
    /**
     * Create a new message instance.
     */
    public function __construct(Account $account, $otp, $type = "new")
    {
        $this->account = $account;
        $this->otp = $otp;
        $this->type = "new";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->type == "new" ? "Selamat bergabung!" : "Informasi akun anda";
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verification-register',
            with: [
                'otp' => $this->otp
            ]
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
