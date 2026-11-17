<?php

use PHPUnit\Framework\TestCase;

class PanierTest extends TestCase
{
    protected function setUp(): void
    {
        ob_start();
    }

    protected function tearDown(): void
    {
        ob_end_clean();
    }

    private function panierDe(int $prix, int $quantite = 1): Panier
    {
        $panier = new Panier();
        $panier->ajouter('Article', $prix, $quantite);
        return $panier;
    }

    public function testSansReduction(): void
    {
        $panier = $this->panierDe(1000, 2);
        $this->assertEquals(2000, $panier->calculerTotal());
    }

    public function testReductionPourcentage(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(18000, $panier->calculerTotal('pourcentage', 10));
    }

    public function testMontantFixe(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(15000, $panier->calculerTotal('montant', 5000));
    }

    public function testTotalNeJamaisNegatif(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(0, $panier->calculerTotal('montant', 30000));
    }

    public function testCodePromoValide(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(18000, $panier->calculerTotal('code_promo', 'PROMO10'));
    }

    public function testCodePromoInconnu(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(20000, $panier->calculerTotal('code_promo', 'ABC'));
    }

    public function testTypeInconnu(): void
    {
        $panier = $this->panierDe(20000);
        $this->assertEquals(20000, $panier->calculerTotal('type_inconnu', 1));
    }
}