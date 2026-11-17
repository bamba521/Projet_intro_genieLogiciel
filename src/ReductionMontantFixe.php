<?php

class ReductionMontantFixe implements Reduction
{
    public function __construct(private float $montant) {}

    public function appliquer(float $sousTotal): float
    {
        return $sousTotal - $this->montant;
    }
}