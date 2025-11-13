<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BatchEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'バッチ処理送信メール',
        );
    }

    public function content(): Content
    {
        $now = now();
        $dateTime = $now->format('Y年m月d日 H時i分');

        return new Content(
            view: 'emails.batch',
            with: [
                'dateTime' => $dateTime,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
