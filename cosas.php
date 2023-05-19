<?php
session_start();
$articulos = array(
    array("id" => 1, "nombre" => "Zapatillas Nike", "precio" => 60),
    array("id" => 2, "nombre" => "Sudadera Domyos", "precio" => 15),
    array("id" => 3, "nombre" => "Pala de pádel Vairo", "precio" => 50),
    array("id" => 4, "nombre" => "Pelota de baloncesto Molten", "precio" => 20)
);

echo "<ul>" . "productos disponibles";
foreach ($articulos as $articulo) {
    echo "<li>" . $articulo["id"] . "<a href='carro.php?id=$articulo[id]'> " . $articulo["nombre"] . "</a>" . $articulo["precio"] . "</li>";
}
echo "</ul>";
echo "<a href='carro.php'> Vaciar carro</a>";

if (isset($_REQUEST["id"])) {
    $total = 0;
    foreach ($articulos as $articulo) {
        if ($_REQUEST["id"] == $articulo["id"]) {
            if (isset($_SESSION["id" . $articulo["id"]])) {
                $_SESSION["id" . $articulo["id"]]["cantidad"]++; 
            } else {
                $_SESSION["id" . $articulo["id"]] = $articulo;
                $_SESSION["id" . $articulo["id"]]["cantidad"] = 1;
            }
            $added = true;
        }
        if (isset($_SESSION["id" . $articulo["id"]])) {
            echo "<p>-" . $articulo["nombre"] . "(" . $articulo["precio"] . " euros) Cantidad: " . $_SESSION["id" . $articulo["id"]]["cantidad"] . "</p>";
            $total += ($_SESSION["id" . $articulo["id"]]["precio"] * $_SESSION["id" . $articulo["id"]]["cantidad"]);
        }
    }
    
        echo "<p> Total comprado: " . $total . "</p>";
    
} else {
    $_SESSION = array();
    session_destroy();
}
?>
