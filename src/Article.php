<?php

class Article
{
    public function __construct(
        private string $nom,
        private float $prix,
        private int $quantite
    ) {}

    public function nom(): string
    {
        return $this->nom;
    }

    public function sousTotal(): float
    {
        return $this->prix * $this->quantite;
    }
}