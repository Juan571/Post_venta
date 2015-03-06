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
    case "getNotificaciones":
        $sql = "SELECT
                    s.solicitudes_accesorios_id as solicitudId,
                    a.agencia,
                    i.producto as accesorio,
                    te.estado as estado
                FROM seguimientos s
                left join agencias a on s.agencias_id = a.id
                left join solicitudes_accesorios_inventario sai on s.solicitudes_accesorios_id = sai.solicitud_accesorios_id
                left join tipos_estados te on s.tipo_estado_id = te.id
                left join inventario i on sai.inventario_id = i.id";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['solicitudId'])]["agencia"] = $v["agencia"];
            $return[intval($v['solicitudId'])]["accesorio"][] = $v["accesorio"];
            $return[intval($v['solicitudId'])]["estado"][] = $v["estado"];
        }
        print json_encode($return);        
        break;
}