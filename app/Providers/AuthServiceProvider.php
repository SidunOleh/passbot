<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use TelegramBot\Api\Client as TgClient;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('auth-passbot', function (?User $user, $username) {
            $input = json_decode(file_get_contents('php://input'), true);
            if ( ! in_array($input['message']['from']['username'], config('tg.passbot.users')) ) {
                $passbot = new TgClient(config('tg.passbot.token'));
                $passbot->sendMessage(
                    $input['message']['chat']['id'], 
                    'Not allowed, text to @qwerty_sova to get access.' . $username
                );
                return false;
            }

            return true;
        });
    }
}
