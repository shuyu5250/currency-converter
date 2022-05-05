<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyConvertRequest;
use App\Services\CurrencyService;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    private CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function convert(CurrencyConvertRequest $request): JsonResponse
    {
        ['source' => $source, 'target' => $target, 'amount' => $amount] = $request->validated();

        $dollars = $this->currencyService->convert($source, $target, $amount);

        return response()->json(['dollars' => $dollars]);
    }
}
