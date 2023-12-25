<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SimpleJokeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("jokes")->insert(
            array(
                [
                    'title' => '***',
                    'body' => <<<JOKE
- Штирлиц, на вас поступил донос от соседей. Пишут, что вы вчера пили, буянили и ругались по-русски!
Штирлиц молча берёт лист бумаги и пишет ответный донос:
"Группенфюреру СС Генриху Мюллеру. Мои соседи знают русский язык и, что особенно подозрительно, разбираются в ненормативной русской лексике!".
JOKE,
                    'source' => 'anekdot.ru',
                    'created_at' => now()
                ],
            )
        );
    }
}
