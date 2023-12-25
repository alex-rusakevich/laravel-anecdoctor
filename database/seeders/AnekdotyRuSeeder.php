<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Log;
use PHPHtmlParser\Dom;

class AnekdotyRuSeeder extends Seeder
{
    public function run(): void
    {
        $dom = new Dom;
        $dom->loadFromUrl('https://anekdoty.ru/');

        $joke_count = 0;

        foreach ($dom->find('div.content-block.best > ul.item-list > li') as $content_part) {
            if (count($content_part->find("img")) != 0) {
                continue;
            }

            $joke = $content_part->find("div.holder-body > p")[0];

            if ($joke == null)
                continue;

            $joke_text = preg_replace("/<br\s?\/?>/i", "\n", $joke->innerHtml());
            $joke_text = trim(strip_tags($joke_text));

            if (hasCurse($joke_text)) {
                Log::info("Skipped a joke due to curse words");
                continue;
            }

            // consolePut($joke_text . "\n" . str_repeat("=", 80) . "\n");

            DB::table("jokes")->insert(
                array(
                    [
                        'title' => '***',
                        'body' => $joke_text,
                        'source' => 'anekdoty.ru',
                        'created_at' => now()
                    ],
                )
            );

            $joke_count++;
        }

        // consolePut("Added $joke_count jokes");
    }
}
