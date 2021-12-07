<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/class/contact.class.php';
require_once  $_SERVER["DOCUMENT_ROOT"].'/class/respuestas.class.php';

$_respuestas = new respuestas;
$_contacts = new contact;


if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["page"])) {
        $pagina = $_GET["page"];
        $listContacts = $_contacts->getAllContacts($pagina);
        header("Content-Type: application/json");
        echo json_encode($listContacts);
        http_response_code(200);
    } elseif (isset($_GET['id'])) {
        $contactid = $_GET['id'];
        $dataContact = $_contacts->getContact($contactid);
        header("Content-Type: application/json");
        echo json_encode($dataContact);
        http_response_code(200);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_contacts->post($postBody);
    //delvovemos una respuesta
    header('Content-Type: application/json');
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);
} elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") {
   
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
        
    //enviamos datos al manejador
    $datosArray = $_contacts->delete($postBody);
    //delvovemos una respuesta
    header('Content-Type: application/json');
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);
} else {
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}
