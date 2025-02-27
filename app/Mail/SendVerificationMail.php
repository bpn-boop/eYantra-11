<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class SendVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $token;
    public $verification_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->token = $token;
        $this->verification_link = env('USER_VERIFICATION_URL') . '/verify-email' . '/' . sodium_bin2base64($token, SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING) . '/' . sodium_bin2base64(Crypt::encrypt($user), SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Send Verification Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.verification-email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
