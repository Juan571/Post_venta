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

$accion = $_REQUEST["accion"];

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
}