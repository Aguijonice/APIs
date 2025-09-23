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
    $Tipo_entrada= $datos['Tipo_entrada'];
    $Monto = $datos['Monto'];
    $Fecha = $datos['Fecha'];
    $Factura = $datos['Factura'];
    $id_usuario = $datos['id_usuario'];

    // Variable para guardar en la BD
    $factura_guardar = $Factura;

    // Si Factura no está vacío, ejecutar la función imagen y obtener el nombre
    if (!empty($Factura)) {
        $nombre_imagen = imagen($Factura);
        $factura_guardar = $nombre_imagen; // Guardar el nombre de la imagen en lugar del base64
    }

    //print_r($factura_guardar); // Verificar el valor que se va a guardar en la BD
    $sql = "INSERT INTO entradas (Tipo_entrada, Monto, Fecha, Factura, id_usuario) VALUES ('$Tipo_entrada', '$Monto', '$Fecha', '$factura_guardar', '$id_usuario')";
    $result = $connection->query($sql);

   if($result){ 
    $dato['id_entrada'] = $connection->insert_id; 
    echo json_encode($dato); 
    }else{ 
    echo json_encode(array('error'=>'Error al crear usuario', 'sql_error' => $connection->error));
    }


function imagen($Factura){
    $imagen = $Factura;

    if (isset($imagen)) {
        $direccion = dirname(__FILE__) . "\Public\imagenes\\";
        $partes = explode(";base64,", $imagen);
        $extension = explode("/", mime_content_type($imagen))[1];
        $imagen_base64 = base64_decode($partes[1]);
        $nombre_imagen1 = $direccion . uniqid() . "." . $extension;
        file_put_contents($nombre_imagen1, $imagen_base64);
        $nombre_imagen = str_replace("\\", "/", $nombre_imagen1); 
        
        return $nombre_imagen;
    } 
}


?>