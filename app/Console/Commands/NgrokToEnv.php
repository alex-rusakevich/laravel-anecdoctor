<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NgrokToEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ngrok-to-env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get running Ngrok public address and put it in .env as APP_URL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ngrok_html = curlToStr('http://localhost:4040/api/tunnels');

        if ($ngrok_html == null) {
            die("Couldn't fetch ngrok public URL. Did you turn Ngrok on?");
        }

        $ngrok_url = json_decode($ngrok_html, true)["tunnels"][0]["public_url"];
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, preg_replace('/APP_URL=.*(?=\n)/', "APP_URL=$ngrok_url", file_get_contents($path)));
        }

        consolePut("Done! Ngrok's new URL is '$ngrok_url'");
    }
}
