   <?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
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
   
   
   $datos = json_decode(file_get_contents('php://input'), true);
    $Tipo_entrada = $datos['Tipo_entrada'];
    $Monto = $datos['Monto'];
    $Fecha = $datos['Fecha'];
    $Factura = $datos['Factura'];
    $id_usuario = $datos['id_usuario'];

    $sql = "INSERT INTO entradas (Tipo_entrada, Monto, Fecha, Factura, id_usuario) VALUES ('$Tipo_entrada', '$Monto', '$Fecha', '$Factura', '$id_usuario')";
    $result = $connection->query($sql);

   if($result){ 
    $dato['id_entrada'] = $connection->insert_id; 
    echo json_encode($dato); 
    }else{ 
    echo json_encode(array('error'=>'Error al crear usuario', 'sql_error' => $connection->error));
    }



?>