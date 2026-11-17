<?php

class ReductionOffertePartirDe implements Reduction
{
    public function __construct(private float $montant, private float $seuil) {}

    public function appliquer(float $sousTotal): float
    {
        return $sousTotal >= $this->seuil ? $sousTotal - $this->montant : $sousTotal;
    }
}