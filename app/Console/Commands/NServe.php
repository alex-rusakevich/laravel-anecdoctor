<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NServe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'n-serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Write Ngrok public address to .env and serve the bot';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call("app:ngrok-to-env");
        $this->call("telegraph:set-webhook");
        $this->call("serve");
    }
}
