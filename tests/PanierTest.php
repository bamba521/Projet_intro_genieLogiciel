<?php

use PHPUnit\Framework\TestCase;

class PanierTest extends TestCase
{
    private function panierDe(float $prix, int $quantite = 1): Panier
    {
        $panier = new Panier();
        $panier->ajouter(new Article('Article', $prix, $quantite));
        return $panier;
    }

    public function testSansReduction(): void
    {
        $panier = $this->panierDe(1000, 2);
        $this->assertEquals(2000, $panier->calculerTotal(ReductionFactory::creer('aucune')));
    }

    public function testReductionPourcentage(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(18000, $panier->calculerTotal(ReductionFactory::creer('pourcentage', 10)));
    }

    public function testMontantFixe(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(15000, $panier->calculerTotal(ReductionFactory::creer('montant', 5000)));
    }

    public function testTotalNeJamaisNegatif(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(0, $panier->calculerTotal(ReductionFactory::creer('montant', 30000)));
    }

    public function testCodePromoValide(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(18000, $panier->calculerTotal(ReductionFactory::creer('code_promo', 'PROMO10')));
    }

    public function testCodePromoInconnu(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(20000, $panier->calculerTotal(ReductionFactory::creer('code_promo', 'ABC')));
    }

    public function testTypeInconnu(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(20000, $panier->calculerTotal(ReductionFactory::creer('type_inconnu', 1)));
    }
}