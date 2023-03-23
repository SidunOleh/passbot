<?php

namespace App\Tg\Commands;

interface ITgCommand
{
    public function handle($message): void;
}