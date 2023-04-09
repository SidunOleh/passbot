<?php

namespace App\Tg\Commands;

class HelpCommand extends TgCommand
{
    public function handle($message): void
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $username = $input['message']['from']['username'];
        if ( ! in_array($username, config('tg.passbot.users')) ) {
            // $passbot = new TgClient(config('tg.passbot.token'));
            $this->bot->sendMessage($input['chat']['id'], 'Not allowed, text to @querty_sova to get access.');
            // return;
        } else {
               $this->bot->sendMessage(
            $message->getChat()->getId(), 
            view('tg.commands')->render()
        );
        }

     
    }
}