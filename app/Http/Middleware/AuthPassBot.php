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
    public function handle(Request $request, Closure $next): Response
    {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (in_array($input['message']['from']['id'], config('tg.passbot.users_ids'))) {
            return $next($request);
        }

        (new TgClient(config('tg.passbot.token')))->sendMessage(
            $input['message']['chat']['id'],
            'Access Denied. Text to @qwerty_sova to get access.'
        );
        
        return response('');
    }
}
