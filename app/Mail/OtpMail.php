<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otpCode; // Variabel untuk menampung kode

    public function __construct($otpCode)
    {
        $this->otpCode = $otpCode;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Verifikasi OTP - Kerjaku',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.otp', // Kita akan buat view ini di langkah selanjutnya
        );
    }
}