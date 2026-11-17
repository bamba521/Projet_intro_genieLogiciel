<?php

class ReductionPourcentage implements Reduction
{
    public function __construct(private float $pourcentage) {}

    public function appliquer(float $sousTotal): float
    {
        return $sousTotal - ($sousTotal * $this->pourcentage / 100);
    }
}