<?php

namespace App\Tg\Commands;

class HelpCommand extends TgCommand
{
    public function handle($message): void
    {
        if ( ! in_array($message->getFrom()->getUsername(), config('tg.passbot.users')) ) {
            // $passbot = new TgClient(config('tg.passbot.token'));
            $this->bot->sendMessage($message->getChat()->getId(), $message->getFrom()->getUsername());
            // return;
        } else {
               $this->bot->sendMessage(
            $message->getChat()->getId(), 
            view('tg.commands')->render()
        );
        }

     
    }
}