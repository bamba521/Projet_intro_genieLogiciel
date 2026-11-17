<?php

class ReductionFactory
{
    public static function creer(string $type, mixed $valeur = null): Reduction
    {
        return match ($type) {
            'pourcentage' => new ReductionPourcentage((float) $valeur),
            'montant'     => new ReductionMontantFixe((float) $valeur),
            'code_promo'  => new ReductionCodePromo((string) $valeur),
            default       => new ReductionAucune(),
        };
    }
}