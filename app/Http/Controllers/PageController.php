<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $client;

    public function __construct() {
        $this->client = new Client([
            'verify' => base_path('cacert.pem'),
        ]);
    }
    
    public function dashboard() { 
        $response = $this->client->get('https://api.quotable.io/random?minLength=150');
        $quote = json_decode($response->getBody()->getContents(), true);

        return view('page.dashboard', [
            'bgMenu' => 'dashboard',
            'quote' => collect($quote),
        ]);
    }

    public function officer() {
        $users = User::all();

        return view('page.student-affairs.officer', [
            'bgMenu' => 'officer',
            'users' => $users
        ]);
    }

    public function item() {
        return view('page.coperation.item', [
            'bgMenu' => 'item'
        ]);
    }

    public function report() {
        return view('page.coperation.report', [
            'bgMenu' => 'report'
        ]);
    }

}
