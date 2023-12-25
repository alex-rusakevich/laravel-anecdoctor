<?php

namespace App\Telegram;

use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use App\Models\Joke;
use Illuminate\Support\Facades\Log;

class Handler extends WebhookHandler
{
    public function start(): void
    {
        $this->chat->message("Привет! Введи команду `/joke`, и я расскажу тебе шутку)")->send();
    }

    public function joke(): void
    {
        Log::debug("Telling a joke");
        $this->chat->action(ChatActions::TYPING)->send();

        $text = '';

        $joke = Joke::inRandomOrder()
            ->limit(1)
            ->get();

        if (count($joke) === 0) {
            $text = "Не получилось придумать шутку :(";
        } else {
            $text = <<<MSG
<b>{$joke[0]->title}</b>

{$joke[0]->body}

<i>Источник: {$joke[0]->source}</i>
MSG;
        }

        Log::debug($text);

        $this->chat->html($text)->send();
    }

    // public function handleChatMessage(\Illuminate\Support\Stringable $text)
    // {
    //     $this->reply($text->value());
    // }
}
