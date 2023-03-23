<?php

namespace App\Tg\Commands;

use TelegramBot\Api\Client;

abstract class TgCommand implements ITgCommand
{
    protected $bot;

    public function __construct($botToken)
    {
        $this->bot = new Client($botToken);
    }

    protected function getCommandArgs($commandStr)
    {
        $commandArr = array_filter(explode(' ', $commandStr), fn($v) => $v);
        
        unset($commandArr[0]);
        $commandArgs = array_values($commandArr);
        
        return $commandArgs;
    }
}