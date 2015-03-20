<?php

/* 
 * Copyright (C) 2015 willicab
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
$accion = $_REQUEST["accion"];
$ejecuta  = new preparedsqls();

switch ($accion) {

    case "getAccesorios":
        $sql = "SELECT * FROM inventario where tipo_producto_id = 1 and activo = 1";
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
    case "setCantidadAccesorios":
        $id = $_REQUEST["id"];
        $cant = $_REQUEST["cant"];
        foreach ($id as $k=>$v) {
            $sql = "UPDATE inventario set cantidad=cantidad + {$cant[$k]} where id=$v";
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