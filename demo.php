<?php

require __DIR__ . '/vendor/autoload.php';

$panier = new Panier();
$panier->ajouter(new Article('Cahier', 1000, 2));
$panier->ajouter(new Article('Sac', 48000, 1));

echo "--- Sans réduction ---" . PHP_EOL;
$panier->afficherRecapitulatif(ReductionFactory::creer('aucune'));

echo PHP_EOL . "--- Code promo PROMO10 ---" . PHP_EOL;
$panier->afficherRecapitulatif(ReductionFactory::creer('code_promo', 'PROMO10'));

echo PHP_EOL . "--- 5 000 FCFA offerts dès 50 000 FCFA ---" . PHP_EOL;
$panier->afficherRecapitulatif(ReductionFactory::creer('offert_seuil'));