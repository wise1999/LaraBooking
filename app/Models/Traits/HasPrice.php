<?php

namespace App\Models\Traits;

use App\Money\Money;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Currencies\ISOCurrencies;
use NumberFormatter;

trait HasPrice {
    public function getPriceAttribute($value) {
        return new Money($value);
    }

    public function getFormattedPriceAttribute() {
        return $this->price->formatted();
    }
}
