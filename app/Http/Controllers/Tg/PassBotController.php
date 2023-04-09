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

        $input = json_decode(file_get_contents('php://input'), true);
        $username = $input['message']['from']['username'];
        if ( ! in_array($username, config('tg.passbot.users')) ) {
            $passbot = new TgClient(config('tg.passbot.token'));
            $passbot->sendMessage($input['chat']['id'], 'Not allowed, text to @querty_sova to get access.');
            return;
        }

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