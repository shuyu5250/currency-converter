<?php

namespace Tests\Unit;

use App\Services\CurrencyService;
use PHPUnit\Framework\TestCase;

class CurrencyConvertTest extends TestCase
{
    private CurrencyService $currencyService;

    public function setUp(): void
    {
        $this->currencyService = new CurrencyService();
    }

    /**
     * @dataProvider convertProvider
     */
    public function test_convert(string $source, string $target, float $amount, string $expectation)
    {
        $this->assertSame($this->currencyService->convert($source, $target, $amount), $expectation);
    }

    public function convertProvider(): array
    {
        return [
            ['TWD', 'USD', 1234, '40.48'],
            ['TWD', 'JPY', 2345, '8,603.80'],
            ['TWD', 'TWD', 3456, '3,456.00'],
            ['USD', 'TWD', 4567, '139,037.74'],
            ['USD', 'JPY', 5678, '634,806.07'],
            ['USD', 'USD', 6789, '6,789.00'],
            ['JPY', 'TWD', 7890, '2,126.82'],
            ['JPY', 'JPY', 8901, '8,901.00'],
            ['JPY', 'USD', 9012, '79.75'],
        ];
    }
}
