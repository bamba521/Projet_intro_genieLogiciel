<?php

interface Reduction
{
    public function appliquer(float $sousTotal): float;
}