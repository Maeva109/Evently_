<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Notifications\SendMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class processContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Contact $contact)
    {
        //
        $this->contact = $contact;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Notification::send($this->contact , new SendMessage($this->contact));

    }
}
