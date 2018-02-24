<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Token;
use App\Configuration;

class GetToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amiral:communicate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send current token to amiral and try to get new token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $configuration = Configuration::all()->first();

        if ($configuration) {
            $address = $configuration->amiral_address;
        } else {
            $this->error("L'adresse de l'amiral n'est pas définie dans la configuration du satellite.");
            return;
        }

        $this->info('Récupération du token actuel...');

        $client = new Client();
        $token = Token::all()->first();

        $this->info('Envoi du token actuel...');

        try {
            $request = $client->get($address . $token);
        } catch (RequestException $e) {
            echo("Echec de la communication avec l'amiral.");
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
            }

            $this->noTokenAction();

            return;
        }

        $responseCode = $request->getStatusCode();

        // TODO code erreur ?

        $token = unserialize($request->getbody())[0];

        Token::destroy();
        Token::create('token');

        // Récupération token configuration amiral.
    }

    // TODO que faire si le token n'a pas encore été généré ?
    private function noTokenAction() {
        $token = Token::all()->first();

        if ($token) {
            $tokenDate = $token->updated_at;
            $currentDate = new \DateTime();
        }
        dump($currentDate, $tokenDate);

        $interval = $currentDate->getTimestamp() - $tokenDate->getTimestamp();

        if ($interval >= 5400) {
            $this->info('Délais dépassé sans nouvelle réponse. Départ de la flotte...');
            $configuration = Configuration::all()->first();
            $configuration->active = false;
            $configuration->save();
        }
    }
}
