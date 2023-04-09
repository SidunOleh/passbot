<?php

namespace App\Http\Controllers\Tg;

use App\Http\Controllers\Controller;
use App\Tg\Commands\HelpCommand;
use App\Tg\Commands\SitesCommand;
use Closure;
use TelegramBot\Api\Client as TgClient;
use Illuminate\Support\Facades\Gate;

class PassBotController extends Controller
{
    private $passbotToken;
    
    private $passbot;
    
    public function __construct()
    {
        $this->passbotToken = config('tg.passbot.token');
        $this->passbot = new TgClient($this->passbotToken);
    }
    
    public function __invoke()
    {
        // if ( ! Gate::allows('auth-passbot') ) {
        //     // return;
        // } else {
        //     return;
        // }

        $this->passbot->command('start', Closure::fromCallable([
            new HelpCommand($this->passbotToken), 
            'handle'
        ]));
        $this->passbot->command('help', Closure::fromCallable([
            new HelpCommand($this->passbotToken), 
            'handle'
        ]));
        $this->passbot->command('sites', Closure::fromCallable([
            new SitesCommand($this->passbotToken), 
            'handle'
        ]));

        $this->passbot->run();
    }
}