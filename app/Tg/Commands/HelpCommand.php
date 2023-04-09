<?php

namespace App\Tg\Commands;

use Illuminate\Support\Facades\Gate;

class HelpCommand extends TgCommand
{
    public function handle($message): void
    {
        $this->bot->sendMessage(
            $message->getChat()->getId(), 
            print_r(Gate::allows('auth-passbot') . '1', true)
        );
    }
}