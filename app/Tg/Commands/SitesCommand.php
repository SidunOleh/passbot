<?php

namespace App\Tg\Commands;

use App\Models\Site;

class SitesCommand extends TgCommand
{
    public function handle($message): void
    {
        // $commandStr = $message->getText();
        // $commandArgs = $this->getCommandArgs($commandStr);
        
        // if (! $commandArgs or is_numeric($commandArgs[0])) {
        //     $response = $this->getSites($commandArgs[0] ?? 1);
        // } else {
        //     $response = $this->getCredentials($commandArgs[0]);    
        // }

        $this->bot->sendMessage($message->getChat()->getId(), $response = 'ffdf', '', true);
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
    
    private function getCredentials($siteName)
    {
        $site = Site::firstWhere('name', 'like', "{$siteName}%");
        if (! $site) {
            $credentials = [];
        } else {
            $credentials = $site->credentials()
                ->orderByDesc('created_at')
                ->get();
        }
            
        return view('tg.credentials', ['credentials' => $credentials,])
            ->render();
    }
}