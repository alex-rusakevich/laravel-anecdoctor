<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Joke;

class JokeController extends Controller
{
    public function getRandomJoke(Request $request){
        $joke_number = $request->get("number", 1);

        $joke = Joke::inRandomOrder()
            -> limit($joke_number)
            -> get();

        if(!count($joke)) {
            return response()->json(["status" => "Couldn't fetch a joke: database is empty yet"]);
        } else {
            return response()->json($joke);
        }
    }
}
