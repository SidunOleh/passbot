<?php

namespace App\Tg\Commands;

use Illuminate\Support\Facades\Log;

class HelpCommand extends TgCommand
{
    public function handle($message): void
    {
        $this->bot->sendMessage(
            $message->getChat()->getId(), 
            file_get_contents('php://input')
        );
    }
}