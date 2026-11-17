<?php

class Panier
{
    private $articles = [];

    public function ajouter($nom, $prix, $quantite)
    {
        $this->articles[] = ['nom' => $nom, 'prix' => $prix, 'quantite' => $quantite];
    }

    // NOUVEAU : le calcul du sous-total n'existe plus qu'à un seul endroit
    public function calculerSousTotal()
    {
        $sousTotal = 0;
        foreach ($this->articles as $article) {
            $sousTotal += $article['prix'] * $article['quantite'];
        }
        return $sousTotal;
    }

    public function calculerTotal($typeReduction = null, $valeur = 0)
    {
        $sousTotal = $this->calculerSousTotal();

        if ($typeReduction == 'pourcentage') {
            $total = $sousTotal - ($sousTotal * $valeur / 100);
        } elseif ($typeReduction == 'montant') {
            $total = $sousTotal - $valeur;
        } elseif ($typeReduction == 'code_promo') {
            if ($valeur == 'PROMO10') {
                $total = $sousTotal * 0.9;
            } else {
                $total = $sousTotal;
            }
        } else {
            $total = $sousTotal;
        }

        if ($total < 0) {
            $total = 0;
        }

        echo 'Sous-total : ' . $sousTotal . PHP_EOL;
        echo 'Total à payer : ' . $total . PHP_EOL;

        return $total;
    }

    public function afficherRecapitulatif()
    {
        $sousTotal = $this->calculerSousTotal();
        echo 'Récapitulatif : ' . $sousTotal . PHP_EOL;
    }
}