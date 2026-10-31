<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 *
 * @property TModel $resource
 */
abstract class BaseJsonResource extends JsonResource
{
    /**
     * Format money minor units (e.g. cents) to decimal representation for display.
     *
     * @return array{minor: int, decimal: string, currency: string}|null
     */
    protected function formatMoney(?int $priceMinor, string $currency = 'USD'): ?array
    {
        if ($priceMinor === null) {
            return null;
        }

        return [
            'minor' => $priceMinor,
            'decimal' => number_format($priceMinor / 100, 2, '.', ''),
            'currency' => $currency,
        ];
    }
}
