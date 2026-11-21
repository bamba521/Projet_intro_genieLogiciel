<?php

// Version INITIALE : une seule classe qui fait tout
require __DIR__ . '/avant/Panier.php';

$panier = new Panier();
$panier->ajouter('Cahier', 1000, 2);
$panier->ajouter('Sac', 48000, 1);

echo '--- Sans réduction ---' . PHP_EOL;
$panier->calculerTotal();

echo PHP_EOL . '--- Code promo PROMO10 ---' . PHP_EOL;
$panier->calculerTotal('code_promo', 'PROMO10');

echo PHP_EOL . '--- RG6 : 5 000 FCFA offerts dès 50 000 ---' . PHP_EOL;
$panier->calculerTotal('offert_seuil');