<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use TelegramBot\Api\Client as TgClient;

class AuthPassBot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response|null
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $username = $input['message']['from']['username'];
        if (in_array($username, config('tg.passbot.users'))) {
            return $next($request);
        }
        
        $passbot = new TgClient(config('tg.passbot.token'));
        $passbot->sendMessage(
            $input['message']['chat']['id'],
            'Access Denied. Text to @qwerty_sova to get access.'
        );
        // return response('');
    }
}
