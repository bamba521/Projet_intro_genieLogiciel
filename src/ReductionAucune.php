<?php

class ReductionAucune implements Reduction
{
    public function appliquer(float $sousTotal): float
    {
        return $sousTotal;
    }
}