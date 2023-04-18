<?php

namespace App\Tg\Commands;

use App\Models\Site;

class SitesCommand extends TgCommand
{
    public function handle($message): void
    {
        $commandStr = $message->getText();
        $commandArgs = $this->getCommandArgs($commandStr);
        
        if (! $commandArgs or is_numeric($commandArgs[0])) {
            $response = $this->getSites($commandArgs[0] ?? 1);
        } else {
            $response = $this->getCredentials($commandArgs[0]);    
        }

        $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
            [
                [
                    ['text' => 'link', 'url' => 'https://core.telegram.org']
                ]
            ]
        );
        
        $this->bot->sendMessage($message->getChat()->getId(), 'sdd', null, false, null, $keyboard);
        // $this->bot->sendMessage($message->getChat()->getId(), $response, 'HTML', true);
    }
    
    private function getSites($page=1)
    {
        $offset = (abs($page) - 1) * 10;
        $sites = Site::offset($offset)
            ->limit(10)
            ->orderByDesc('created_at')
            ->get();
            
        return view('tg.sites', ['sites' => $sites,])
            ->render();
    }
    
    private function getCredentials($site)
    {
        $credentials = Site::firstWhere('name', 'like', "{$site}%")
            ->credentials()
            ->orderByDesc('created_at')
            ->get() ?? [];
            
        return view('tg.credentials', ['credentials' => $credentials,])
            ->render();
    }
}