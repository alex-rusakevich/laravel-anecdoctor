<?php

namespace App\Http\Controllers;

use App\Models\Joke;
use Illuminate\Http\Request;
use Log;

use \Illuminate\Http\JsonResponse;
use Validator;

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
        Log::debug($request->all());

        $validator = Validator::make($request->all(), [
            'number' => 'numeric|min:1|max:64',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => implode("; ", $validator->messages()->all())], status: 400);
        }

        $joke_number = (int) $request->get("number", 1);

        $joke = Joke::inRandomOrder()
            ->limit($joke_number)
            ->get();

        if (count($joke) === 0) {
            return response()->json(["status" => "Couldn't fetch a joke: database is empty yet"], status: 400);
        } else {
            return response()->json($joke);
        }
    }
}
