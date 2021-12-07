<?php

require_once '../../database/conexion.php';
// require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class contact extends conexion
{
    private $table = "Contacts";
    private $contactId = "";
    private $name = "";
    private $lastname = "";
    private $email = "";
    private $phone = "";


    public function getAllContacts($page = 1)
    {
        $start= 0 ;
        $count = 25;
        if ($page > 1) {
            $start = ($count * ($page - 1)) +1 ;
            $count = $count * $page;
        }
        $query = "SELECT * FROM " . $this->table . " limit $start,$count";
        $datos = parent::obtenerDatos($query);
        return ($datos);
    }

    public function getContact($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = '$id'";
        return parent::obtenerDatos($query);
    }

    public function post($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);

        if (empty($datos['name']) || empty($datos['lastname']) || empty($datos['email']) || empty($datos['phone'])) {
            return $_respuestas->error_400();
        } else {
            $this->name = $datos['name'];
            $this->lastname = $datos['lastname'];
            $this->email = $datos['email'];
            $this->phone = $datos['phone'];
            $resp = $this->addContact();
            if ($resp) {
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                            "ContactId" => $resp
                        );
                return $respuesta;
            } else {
                return $_respuestas->error_500();
            }
        }
    }

    private function addContact()
    {
        $query = "INSERT INTO " . $this->table . " (name,lastname,email,phone)
        values 
        ('" . $this->name . "','" . $this->lastname . "','" . $this->email ."','" . $this->phone . "')";
        $resp = parent::nonQueryId($query);
        if ($resp) {
            return $resp;
        } else {
            return 0;
        }
    }

    public function delete($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);

      
        if (!isset($datos['contactId'])) {
            return $_respuestas->error_400();
        } else {
            $this->contactId = $datos['contactId'];
            $resp = $this->deleteContact();
            if ($resp) {
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                            "contactId" => $this->contactId,
                            "msj" => 'deleted'
                        );
                return $respuesta;
            } else {
                return $_respuestas->error_500();
            }
        }
    }


    private function deleteContact()
    {
        $query = "DELETE FROM " . $this->table . " WHERE contactId = '" . $this->contactId . "'";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }
}
