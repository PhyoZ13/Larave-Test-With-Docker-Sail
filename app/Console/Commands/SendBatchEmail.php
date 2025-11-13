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
        // Send email to inquiry@mail.test
        Mail::to('inquiry@mail.test')->send(new BatchEmail());

        $this->info('Batch email sent successfully');
        return 0;
    }
}
