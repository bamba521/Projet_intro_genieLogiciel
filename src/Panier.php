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

        return $total; // plus aucun echo ici : la méthode ne fait que calculer
    }

    // L'affichage vit ici, et seulement ici
    public function afficherRecapitulatif($typeReduction = null, $valeur = 0)
    {
        echo 'Sous-total : ' . $this->calculerSousTotal() . PHP_EOL;
        echo 'Total à payer : ' . $this->calculerTotal($typeReduction, $valeur) . PHP_EOL;
    }
}