<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ReplyMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reply-message-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reply Message Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $responseMessageReceive = Http::get(config('whatsapp.api_url'). '/messages');

    }
}
