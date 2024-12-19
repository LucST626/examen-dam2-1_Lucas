<?php
$randomNumber = rand(1, 100);
$parity = ($randomNumber % 2 === 0) ? "par" : "impar";
$elements = ["rojo", "azul", "verde", "amarillo", "morado"];
$randomElement = $elements[array_rand($elements)];

echo json_encode([
    "numero" => $randomNumber,
    "paridad" => $parity,
    "elemento" => $randomElement
]);
?>