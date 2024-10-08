<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\JsonResponse;

class ExchangeRateController extends Controller
{
    public function index(): JsonResponse
    {
        $exchangeRates = ExchangeRate::getData();
        return response()->json($exchangeRates, 200, ['Content-Type' => 'application/json']);
    }

    public function singleday(string $date): JsonResponse
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return response()->json(['message' => 'Invalid date format. Expected format: YYYY-MM-DD'], 400);
        }

        $exchangeRate = ExchangeRate::getData()->where('date', $date);

        if (!$exchangeRate) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return response()->json($exchangeRate, 200, ['Content-Type' => 'application/json']);
    }

    public function today(): JsonResponse
    {
        $today = date('Y-m-d');
        return $this->singleday($today);
    }
}
