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

    private $input;
    
    public function __construct()
    {
        $this->passbotToken = config('tg.passbot.token');
        $this->passbot = new TgClient($this->passbotToken);
        $this->input = json_decode(file_get_contents('php://input'), true);
    }
    
    public function __invoke()
    {
        if (! $this->allowAccess()) {
            $this->passbot->sendMessage(
                $this->input['message']['chat']['id'],
                'Access Denied. Text to @qwerty_sova to get access.',
            );
            die;
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

    private function allowAccess()
    {
        return in_array(
            $this->input['message']['from']['username'], 
            config('tg.passbot.users')
        );
    }
}