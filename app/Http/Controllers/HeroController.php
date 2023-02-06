<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Inertia\Inertia;

class HeroController extends Controller
{
    public function index()
    {
        $timestamp = time();
        $hash = hash('md5', $timestamp . env('MARVEL_API_PRIV_KEY') . env('MARVEL_API_PUB_KEY'));

        $client = new Client();
        $response = $client->get('https://gateway.marvel.com/v1/public/characters', [
            'query' => [
                'apikey' => env('MARVEL_API_PUB_KEY'),
                'ts' => $timestamp,
                'hash' => $hash,
            ],
        ]);

        $heroes = json_decode($response->getBody(), true)['data']['results'];

        return Inertia::render('Dashboard', [
            'heroes' => $heroes,
        ]);
    }

    public function heroesTop3()
    {
        $timestamp = time();
        $hash = hash('md5', $timestamp . env('MARVEL_API_PRIV_KEY') . env('MARVEL_API_PUB_KEY'));
        $heroesTop3 = Hero::orderBy('votes', 'desc')->take(3)->get();
        $heroes = array();
        
        foreach($heroesTop3 as $heroesTop3) {
            $client = new Client();
            $response = $client->get('https://gateway.marvel.com/v1/public/characters/'. $heroesTop3->id, [
                'query' => [
                    'apikey' => env('MARVEL_API_PUB_KEY'),
                    'ts' => $timestamp,
                    'hash' => $hash,
                ],
            ]);

            array_push($heroes,json_decode($response->getBody(), true)['data']['results'][0]);
        }

        return Inertia::render('HeroesTop', [
            'heroes' => $heroes,
        ]);
    }

    /**
     * Hero's Vote.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function heroVote(Request $request): string
    {
        try {
            $hero = Hero::find($request->hero_id);
            $hero->votes++;
            $hero->save();
    
            return response()->json(['message_success' => "Vote registered successfully!"]);
        } catch(Exception $e) {
            return response()->json(['message_error' => "Unregistered Vote!"], 500);
        }
    }
}