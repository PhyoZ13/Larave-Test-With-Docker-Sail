<?php

namespace App\Console\Commands;

use App\Mail\BatchEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBatchEmail extends Command
{
    protected $signature = 'batch:send-email';
    protected $description = 'Send periodic batch email';

    public function handle()
    {
        // Only send emails when APP_DEBUG is false
        if (config('app.debug')) {
            $this->info('Skipping batch email: APP_DEBUG is true');
            return 0;
        }

        // Send email to inquiry@mail.test
        Mail::to('inquiry@mail.test')->send(new BatchEmail());

        $this->info('Batch email sent successfully');
        return 0;
    }
}
