<?php

namespace App\Console\Commands;

use App\Models\Joke;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EnsureUnique extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ensure-unique';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all non-unique jokes from DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $duplicated = DB::table('jokes')
            ->select('body', DB::raw('count(`body`) as occurences'))
            ->groupBy('body')
            ->having('occurences', '>', 1)
            ->get();

        foreach ($duplicated as $record) {
            Joke::where('body', $record->body)->limit(1)->delete();
        }

        consolePut("Done! Removed " . count($duplicated) . " DB items!");
    }
}
