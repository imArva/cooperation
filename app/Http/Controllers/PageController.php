<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function dashboard() {
        $client = new Client([
            'verify' => base_path('cacert.pem'),
        ]);

        $response = $client->get('https://api.quotable.io/random?minLength=150');
        $quote = json_decode($response->getBody()->getContents(), true);

        return view('page.dashboard', [
            'bgMenu' => 'dashboard',
            'quote' => collect($quote),
        ]);
    }

}
