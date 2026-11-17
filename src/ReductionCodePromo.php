<?php

class ReductionCodePromo implements Reduction
{
    private const CODES = ['PROMO10' => 10];

    public function __construct(private string $code) {}

    public function appliquer(float $sousTotal): float
    {
        if (!isset(self::CODES[$this->code])) {
            return $sousTotal;
        }
        return (new ReductionPourcentage(self::CODES[$this->code]))->appliquer($sousTotal);
    }
}
