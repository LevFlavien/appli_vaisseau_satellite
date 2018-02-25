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
    protected $description = "Envoie le token actuel à l'amiral et tente de récupérer le nouveau";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $configuration = Configuration::all()->first();

        if ($configuration) {
            if (!$configuration->active) {
                $this->error("Le satellite n'est pas actif.");
                return $this->endError();
            }
            $address = $configuration->amiral_address;
        } else {
            $this->error("L'adresse de l'amiral n'est pas définie dans la configuration du satellite.");

            $this->endError();
            return;
        }

        $this->info('Récupération du token actuel...');

        $client = new Client();
        $token = Token::all()->first();

        $this->info('Envoi du token actuel...');

        try {
            $request = $client->get($address . $token);
        } catch (RequestException $e) {
            $this->error("Echec de la communication avec l'amiral.");
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
            }

            $this->error('Pas de token reçu, vérification du dernier contact...');
            $this->noTokenAction($configuration);

            $this->endError();
            return;
        }

        $responseCode = $request->getStatusCode();

        if ($responseCode == 200) {
            $newToken = unserialize($request->getbody())[0];

            if ($newToken == $token->token) {
                $this->error('Le token reçu est similaire. Vérification du dernier contact...');
                $this->noTokenAction($configuration);
            }

            $this->info('Token reçu, mise à jour...');

            Token::destroy($token->id);
            Token::create(['token' => $newToken]);
            $this->endSuccess();
        } else {
            $this->error('Pas de token reçu, vérification du dernier contact...');
            $this->noTokenAction($configuration);
        }
    }

    /**
     * Action à reproduire quand l'amiral n'a pas pu envoyer un nouveau token.
     * @param Configuration $configuration
     */
    private function noTokenAction($configuration) {
        $token = Token::all()->first();

        if ($token) {
            $tokenDate = $token->updated_at;
        } else {
            $tokenDate = $configuration->updated_at;
        }
        $currentDate = new \DateTime();

        $interval = $currentDate->getTimestamp() - $tokenDate->getTimestamp();

        if ($interval >= 5400) {
            $this->error('Délais dépassé sans nouvelle réponse (1h30). Départ de la flotte...');
            $configuration = Configuration::all()->first();
            $configuration->active = false;
            $configuration->save();
        }
    }

    private function endError() {
        $this->info('Fin du programme. Erreurs détectées.');
    }

    private function endSuccess() {
        $this->info('Fin du programme avec succès');
    }
}
