<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

// Manejar preflight request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}


define("HOSTNAME", "localhost");
define("USERNAME", "root"); 
define("PASSWORD", "");
define("DATABASE", "api");

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if (!$connection) {
    die("Connection failed: ");
}
else {
    // echo "Connected successfully";
}

header("Content-Type: application/json");

$sql = "SELECT 
    COALESCE((SELECT SUM(Monto) FROM entradas), 0) AS suma_entradas,
    COALESCE((SELECT SUM(Monto) FROM salidas), 0) AS suma_salidas,
    COALESCE((SELECT SUM(Monto) FROM entradas), 0) + 
    COALESCE((SELECT SUM(Monto) FROM salidas), 0) AS suma_total,
    (SELECT COUNT(*) FROM entradas) AS cantidad_entradas,
    (SELECT COUNT(*) FROM salidas) AS cantidad_salidas,
    (SELECT COUNT(*) FROM entradas) + 
    (SELECT COUNT(*) FROM salidas) AS total_registros";

$result = $connection->query($sql); 

if($result && $result->num_rows > 0)
{
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}
else
{
    echo json_encode(array(
        "suma_entradas" => 0,
        "suma_salidas" => 0,
        "suma_total" => 0,
        "cantidad_entradas" => 0,
        "cantidad_salidas" => 0,
        "total_registros" => 0
    ));
}



?>

