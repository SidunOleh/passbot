<?php

namespace App\Tg\Commands;

class HelpCommand extends TgCommand
{
    public function handle($message): void
    {
        if ( ! in_array($this->getFrom()->getUsername(), config('tg.passbot.users')) ) {
            // $passbot = new TgClient(config('tg.passbot.token'));
            $this->bot->sendMessage($this->getChat()->getId(), 'Not allowed, text to @querty_sova to get access.');
            // return;
        } else {
               $this->bot->sendMessage(
            $message->getChat()->getId(), 
            view('tg.commands')->render()
        );
        }

     
    }
}