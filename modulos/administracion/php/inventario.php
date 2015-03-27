<?php

/* 
 * Copyright (C) 2015 willicab pff .. JuanRomero..
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

include_once '../../../includes/conexion.php';
include_once '../../GestionCasos/BD/preparedsqls.php';

function scanear_string($string)
{

    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
            "#", "@", "|", "!", "\"",
            "·", "$", "%", "&", "/",
            "(", ")", "?", "'", "¡",
            "¿", "[", "^", "`", "]",
            "+", "}", "{", "¨", "´",
            ">", "< ", ";", ",", ":",
            ".", " "),
        '',
        $string
    );


    return $string;
}
$accion = $_REQUEST["accion"];
if (isset($_REQUEST["data"]))
$data = $_REQUEST["data"];

$ejecuta  = new preparedsqls();

switch ($accion) {

    case "getAccesorios":
        $sql = "SELECT detalles_inventario.id as id,
        inventario.producto as producto,
        detalles_inventario.cantidad as cantidad
        FROM detalles_inventario join inventario on (inventario.id = detalles_inventario.inventario_id) where modelo_id = $data and inventario.activo = 1";

        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id'])] = array(
                "producto" => $v['producto'],
                "cantidad" => $v['cantidad']
            );
        }
        print json_encode($return);
        break;
    case "getModelos":

        $sql = "SELECT * FROM modelos where activo = 1";
        $res = $hAccesorios ->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id'])] = array(
                "modelo" => $v['modelo'],
                "descrip" => $v['descripcion']
            );
        }
        print json_encode($return);

        break;
    case "getInventario":

        echo $ejecuta->obtenerInventario();

        break;
    case "getAccesoriosOrden":
        $idorden=$_REQUEST['data'];

        echo $ejecuta->obtenerAccesoriosOrden($idorden);

        break;
    case "getOrdenes":

        echo $ejecuta->obtenerOrdenesAsig();

        break;
    case "setCantidadAccesorios":
        $id = $_REQUEST["id"];
        $cant = $_REQUEST["cant"];
        $orden = scanear_string($_REQUEST["codeOrdAsig"]);

        $obsOrden = scanear_string($_REQUEST["obserorden"]);
        $fechaorden =$_REQUEST["fechaorden"];
        $sql = "INSERT INTO orden_asignaciones (fecha,codigo_orden,observacion) VALUES ('$fechaorden','$orden','$obsOrden')";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $ultimo= $hAccesorios->lastInsertId();

        foreach ($id as $k=>$v) {
           $sql = "INSERT INTO transacciones(detalles_inventario_id,cantidad,orden_asignaciones_id) VALUES ('$v',{$cant[$k]},$ultimo)";
           $res = $hAccesorios->prepare($sql);
           $res->execute();
        }
        print json_encode(array("error" => "0"));

        break;
    case "addAccesorio":
        $nombre = $_REQUEST["nombre"];
        $sql = "INSERT INTO inventario VALUES(null, '$nombre', 1, 0, 1)";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        print json_encode(array(
            "mensaje" => "Set Accesorio",
            "sql" => "$sql",
            "error" => "0",
            "id" => $hAccesorios->lastInsertId()
        ));
        break;
}