<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quote\StoreQuoteRequest;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
	public function store(StoreQuoteRequest $request): JsonResponse
	{
		$validated = $request->validated();
		$directoryPath = '/quotes/' . $validated['quote'] . '/';

		$quote = Quote::create([
			'quote'    => ['en'=> $validated['quote'], 'ka'=> $validated['quote_ka']],
			'movie_id' => $validated['id'],
			'image'    => $request->file('image')->store($directoryPath),
			'user_id'  => auth()->user()->id,
		]);
		return response()->json($quote, 201);
	}
}
