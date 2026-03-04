<?php
header("Content-Type: application/json; charset=utf-8");

$arquivo = "/etc/squid/bloqueios.txt"; // ajuste aqui se necessário
// $arquivo = "/etc/squid/bloqueios.txt";

if (!file_exists($arquivo)) {
    echo json_encode([]);
    exit;
}

$linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$saida = [];
foreach ($linhas as $l) {
    $l = trim($l);
    if ($l === "") continue;

    if ($l[0] !== '.') $l = '.' . $l;
    $saida[] = strtolower($l);
}

$saida = array_values(array_unique($saida));
sort($saida);

echo json_encode($saida);
