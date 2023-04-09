<?php

namespace App\Tg\Commands;

class HelpCommand extends TgCommand
{
    public function handle($message): void
    {
        $this->bot->sendMessage(
            $message->getChat()->getId(), 
            $message->getChat()->getId()
        );
    }
}