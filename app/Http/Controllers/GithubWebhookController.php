<?php

namespace App\Http\Controllers;

use Artisan;

class GithubWebhookController extends Controller
{
    public function gitRepoReceivedPush()
    {
        abort_unless($this->requestSignatureIsValid(), 403);

        Artisan::call('dashboard:github');

        echo 'ok';
    }

    protected function requestSignatureIsValid() : bool
    {
        $gitHubSignature = request()->header('X-Hub-Signature');

        list($usedAlgorithm, $gitHubHash) = explode('=', $gitHubSignature, 2);

        $payload = file_get_contents('php://input');

        $calculatedHash = hash_hmac($usedAlgorithm, $payload, config('services.github.hook_secret'));

        return $calculatedHash === $gitHubHash;
    }
}
