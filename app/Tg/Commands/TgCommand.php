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
}