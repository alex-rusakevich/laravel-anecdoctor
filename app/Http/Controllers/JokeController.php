<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Joke;
use \Illuminate\Http\JsonResponse;

class JokeController extends Controller
{
    /**
     * Generate and return random jokes (depending on `?number=` GET parameter)
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getRandomJoke(Request $request): JsonResponse
    {
        $joke_number = $request->get("number", 1);

        $joke = Joke::inRandomOrder()
            ->limit($joke_number)
            ->get();

        if (count($joke) === 0) {
            return response()->json(["status" => "Couldn't fetch a joke: database is empty yet"]);
        } else {
            return response()->json($joke);
        }
    }
}
