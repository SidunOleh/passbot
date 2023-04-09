<?php

namespace App\Tg\Commands;

use Illuminate\Support\Facades\Log;

class HelpCommand extends TgCommand
{
    public function handle($message): void
    {
        Log::info($message);

        $this->bot->sendMessage(
            $message->getChat()->getId(), 
            view('tg.commands')->render()
        );
    }
}