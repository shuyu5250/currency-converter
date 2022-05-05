<?php

namespace App\Services;

/**
 * 貨幣處理服務
 */
class CurrencyService
{
    /**
     * 貨幣轉換匯率對應表
     */
    const EXCHANGE_RATE = [
        'TWD' => [
            'TWD' => 1,
            'JPY' => 3.669,
            'USD' => 0.03281,
        ],
        'JPY' => [
            'TWD' => 0.26956,
            'JPY' => 1,
            'USD' => 0.00885,
        ],
        'USD' => [
            'TWD' => 30.444,
            'JPY' => 111.801,
            'USD' => 1,
        ]
    ];

    /**
     * 回傳固定小數位數
     */
    const DIGITS = 2;

    /**
     * 兩貨幣間進行轉換
     *
     * @param string $sourceCurrency 當前幣別
     * @param string $targetCurrency 目標幣別
     * @param float $amount 目標數量
     * @return string
     */
    public function convert(string $sourceCurrency, string $targetCurrency, float $amount): string
    {
        $rate = self::EXCHANGE_RATE[$sourceCurrency][$targetCurrency];

        return number_format(bcmul($rate, $amount, self::DIGITS), self::DIGITS);
    }
}
