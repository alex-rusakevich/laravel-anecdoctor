<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Log;
use PHPHtmlParser\Dom;

class AnekdotRuSeeder extends Seeder
{
    public function run(): void
    {
        $dom = new Dom;
        $dom->loadFromUrl('https://www.anekdot.ru/');

        $joke_count = 0;

        foreach ($dom->find('div.topicbox') as $content_part) {
            if (count($content_part->find("img")) != 0) {
                continue;
            }

            $joke = $content_part->find("div.text")[0];

            if ($joke == null)
                continue;

            $joke_text = preg_replace("/<br\s?\/?>/i", "\n", $joke->innerHtml());
            $joke_text = trim(strip_tags($joke_text));

            if (hasCurse($joke_text)) {
                Log::info("Skipped a joke due to curse words");
                continue;
            }

            if (str_contains($joke_text, "читать дальше")) {
                continue;
            }

            DB::table("jokes")->insert(
                array(
                    [
                        'title' => '***',
                        'body' => $joke_text,
                        'source' => 'anekdot.ru',
                        'created_at' => now()
                    ],
                )
            );

            $joke_count++;
        }

        // consolePut("Added $joke_count jokes");
    }
}
