<?php

class Panier
{
    private array $articles = [];

    public function ajouter(Article $article): void
    {
        $this->articles[] = $article;
    }

    public function calculerSousTotal(): float
    {
        $total = 0.0;
        foreach ($this->articles as $article) {
            $total += $article->sousTotal();
        }
        return $total;
    }

    public function calculerTotal(Reduction $reduction): float
    {
        return max(0.0, $reduction->appliquer($this->calculerSousTotal()));
    }

    public function afficherRecapitulatif(Reduction $reduction): void
    {
        echo 'Sous-total : ' . $this->calculerSousTotal() . PHP_EOL;
        echo 'Total à payer : ' . $this->calculerTotal($reduction) . PHP_EOL;
    }
}