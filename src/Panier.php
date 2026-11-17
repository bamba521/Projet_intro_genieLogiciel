<?php

class Panier
{
    private $articles = [];

    public function ajouter($nom, $prix, $quantite)
    {
        $this->articles[] = ['nom' => $nom, 'prix' => $prix, 'quantite' => $quantite];
    }

    public function calculerSousTotal()
    {
        $sousTotal = 0;
        foreach ($this->articles as $article) {
            $sousTotal += $article['prix'] * $article['quantite'];
        }
        return $sousTotal;
    }

    public function calculerTotal($typeReduction = null, $valeurReduction = 0)
    {
        $sousTotal = $this->calculerSousTotal();

        if ($typeReduction == 'pourcentage') {
            $totalApresReduction = $sousTotal - ($sousTotal * $valeurReduction / 100);
        } elseif ($typeReduction == 'montant') {
            $totalApresReduction = $sousTotal - $valeurReduction;
        } elseif ($typeReduction == 'code_promo') {
            if ($valeurReduction == 'PROMO10') {
                $totalApresReduction = $sousTotal * 0.9;
            } else {
                $totalApresReduction = $sousTotal;
            }
        } else {
            $totalApresReduction = $sousTotal;
        }

        if ($totalApresReduction < 0) {
            $totalApresReduction = 0;
        }

        return $totalApresReduction;
    }

    public function afficherRecapitulatif($typeReduction = null, $valeurReduction = 0)
    {
        echo 'Sous-total : ' . $this->calculerSousTotal() . PHP_EOL;
        echo 'Total à payer : ' . $this->calculerTotal($typeReduction, $valeurReduction) . PHP_EOL;
    }
}