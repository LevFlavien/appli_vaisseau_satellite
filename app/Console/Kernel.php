<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Token;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $client = new Client();
            $token = Token::all()->first();

            try {
                $request = $client->get('http://monurl/' . $token);
            } catch (RequestException $e) {
                echo $e->getRequest() . "\n";
                if ($e->hasResponse()) {
                    echo $e->getResponse() . "\n";
                }

                // Si ça fait 1h30, quitte la flotte.

                $tokenDate = Token::all()->first()->updated_at;
                $currentDate = new \DateTime();

                return;
            }

            $responseCode = $request->getStatusCode();

            // TODO code erreur ?

            $token = unserialize($request->getbody())[0];

            Token::destroy();
            Token::create('token');

            // Récupération token configuration amiral.

        })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
