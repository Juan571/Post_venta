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
    case "getEstados":
        $sql = "SELECT * FROM estado";
        $res = $hTerritorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id_estado'])] = utf8_encode($v['estado']);
        }
        print json_encode($return);
        break;
    case "getMunicipios":
        $sql = "SELECT * FROM municipio";
        $res = $hTerritorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id_municipio'])] = array(
                $v["estado_id"],
                utf8_encode($v['municipio'])
            );
        }
        print json_encode($return);
        break;
    case "getParroquias":
        $sql = "SELECT * FROM parroquia";
        $res = $hTerritorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id_parroquia'])] = array(
                $v["municipio_id"],
                utf8_encode($v['parroquia'])
            );
        }
        print json_encode($return);
        break;
    case "getModelos":
        $sql = "SELECT * FROM modelos where activo = 1";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id'])] = array(
                utf8_encode($v['modelo']),
                utf8_encode($v['descripcion']),
                $v["activo"]
            );
        }
        print json_encode($return);
        break;
    case "getColores":
        $sql = "SELECT * FROM colores where activo = 1";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id'])] = array(
                utf8_encode($v['color']),
                $v["activo"]
            );
        }
        print json_encode($return);
        break;
    case "getTecnologias":
        $sql = "SELECT * FROM tecnologias where activo = 1";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id'])] = array(
                utf8_encode($v['tecnologia']),
                $v["activo"]
            );
        }
        print json_encode($return);
        break;
    case "getOperadoras":
        $sql = "SELECT * FROM operadoras where activo = 1";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id'])] = array(
                utf8_encode($v['operadora']),
                $v["activo"]
            );
        }
        print json_encode($return);
        break;
    case "getAccesorios":
        $sql = "SELECT * FROM inventario where tipo_producto_id = 1 and activo = 1";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id'])] = ($v['producto']);
        }
        print json_encode($return);
        break;
    case "getMotivos":
        $sql = "SELECT * FROM motivos_reemplazo where activo = 1";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return[intval($v['id'])] = ($v['motivo']);
        }
        print json_encode($return);
        break;
    case "getSolicitante":
        $cedula = $_REQUEST["cedula"];
        $sql = "SELECT * FROM solicitantes where cedula='$cedula'";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return = array(
                "cedula" => $v["cedula"],
                "nombres" => $v["nombres"],
                "apellidos" => $v["apellidos"],
                "direccion" => $v["direccion"],
                "parroquia_id" => $v["parroquia_id"],
                "telefono_fijo" => $v["telefono_fijo"],
                "telefono_movil" => $v["telefono_movil"],
                "correo" => $v["correo"]
            );
        }
        print json_encode($return);
        break;
    case "getEquipo":
        $serial = $_REQUEST["serial"];
        $sql = "SELECT * FROM equipos where serial='$serial'";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        $return = array();
        foreach ($array as $k=>$v){
            $return = array(
                "solicitante_id" => $v["solicitante_id"],
                "modelo_id" => $v["modelo_id"],
                "color_id" => $v["color_id"],
                "imei" => $v["imei"],
                "tecnologia_id" => $v["tecnologia_id"],
                "factura" => $v["factura"],
                "fecha_compra" => $v["fecha_compra"],
                "operadora_id" => $v["operadora_id"]
            );
        }
        print json_encode($return);
        break;
    case "setSolicitante":
        $cedula = $_REQUEST["cedula"];
        $nombres= $_REQUEST["nombres"];
        $apellidos= $_REQUEST["apellidos"];
        $direccion= $_REQUEST["direccion"];
        $parroquia_id= $_REQUEST["parroquia_id"];
        $tlfFijo= $_REQUEST["tlfFijo"];
        $tlfMovil= $_REQUEST["tlfMovil"];
        $correo= $_REQUEST["correo"];
        // Verificar si ya existe el solicitante
        $sql = "select id, count(id) as cuenta from solicitantes where cedula=$cedula";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $v = $res->fetch();
        $cuenta = $v["cuenta"];
        $id = $v["id"];
        if ($cuenta == 0) { // Si no existe, se crea nuevo
            $sql = "insert into solicitantes values(NULL, '$cedula', '$nombres', "
                    . "'$apellidos', '$direccion', $parroquia_id, '$tlfFijo', "
                    . "'$tlfMovil', '$correo')";
            #print $sql;
            $res = $hAccesorios->prepare($sql);
            $res->execute();
            print json_encode(array(
                "mensaje" => "Set Solicitante",
                "sql" => "$sql",
                "error" => "0",
                "id" => $hAccesorios->lastInsertId()
            ));
        } else { // Si existe, se actualiza
            $sql = "update solicitantes set nombres='$nombres', "
                    . "apellidos='$apellidos', direccion='$direccion', "
                    . "parroquia_id=$parroquia_id, telefono_fijo='$tlfFijo', "
                    . "telefono_movil='$tlfMovil', correo='$correo' "
                    . "where cedula='$cedula'";
            $res = $hAccesorios->prepare($sql);
            $res->execute();
            print json_encode(array(
                "mensaje" => "Update Solicitante",
                "sql" => "$sql",
                "error" => "0",
                "id" => $id
            ));
        }
        break;
    case "setEquipo":
        $solicitanteId = $_REQUEST["solicitanteId"];
        $modeloId = $_REQUEST["modeloId"];
        $colorId = $_REQUEST["colorId"];
        $imei = $_REQUEST["imei"];
        $serial = $_REQUEST["serial"];
        $tecnologiaId = $_REQUEST["tecnologiaId"];
        $factura = $_REQUEST["factura"];
        $fechaCompra = $_REQUEST["fechaCompra"];
        $operadoraId = $_REQUEST["operadoraId"];
        // Verificar si ya existe el equipo
        $sql = "select id, count(id) as cuenta from equipos where serial='$serial'";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $v = $res->fetch();
        $cuenta = $v["cuenta"];
        $id = $v["id"];
        if ($cuenta == 0) { // Si no existe, se crea nuevo
            $sql = "insert into equipos values(NULL, $solicitanteId, $modeloId"
                    . ", $colorId, '$imei', '$serial', $tecnologiaId, '$factura'"
                    . ", '$fechaCompra', $operadoraId)";
            $res = $hAccesorios->prepare($sql);
            $res->execute();
            print json_encode(array(
                "mensaje" => "Set Equipo",
                "sql" => "$sql",
                "error" => "0",
                "id" => $hAccesorios->lastInsertId()
            ));
        } else {
            $sql = "update equipos set solicitante_id=$solicitanteId"
                    . ", modelo_id=$modeloId, color_id=$colorId, imei='$imei'"
                    . ", tecnologia_id=$tecnologiaId, factura='$factura'"
                    . ", fecha_compra='$fechaCompra', operadora_id='$operadoraId'";
            $res = $hAccesorios->prepare($sql);
            $res->execute();
            print json_encode(array(
                "mensaje" => "Update Equipo",
                "sql" => "$sql",
                "error" => "0",
                "id" => $id
            ));
        }
        break;
    case "setSolicitud":
        $equipo_id = $_REQUEST["equipo_id"];
        $usuario_id = $_REQUEST["usuario_id"];
        $agencia_id = $_REQUEST["agencia_id"];
        $sql1 = "insert into solicitudes_accesorios values(null, $equipo_id, now(), $usuario_id)";
        $res = $hAccesorios->prepare($sql1);
        $res->execute();
        $id = $hAccesorios->lastInsertId();
        $sql2 = "insert into seguimientos values(null, now(), 1, $id, '', $agencia_id)";
        $res = $hAccesorios->prepare($sql2);
        $res->execute();
        print json_encode(array(
            "mensaje" => "set Solicitud",
            "sql1" => "$sql1",
            "sql2" => "$sql2",
            "error" => "0",
            "id" => $id
        ));
        break;
    case "setAccesorios":
        $solicitudId = $_REQUEST["solicitudId"];
        $accesorios = $_REQUEST["acc"];
        $descripciones = $_REQUEST["desc"];
        $motivos = $_REQUEST["mot"];
        $observaciones = $_REQUEST["obs"];
        foreach ($accesorios as $k=>$v){
            $sql = "insert into solicitudes_accesorios_inventario values(null, $solicitudId, $v, '{$descripciones[$k]}', {$motivos[$k]}, '{$observaciones[$k]}', 0)";
            $res = $hAccesorios->prepare($sql);
            $res->execute();
            $sql = "update inventario set cantidad = cantidad - 1 where id = $v";
            $res = $hAccesorios->prepare($sql);
            $res->execute();
        }
        print json_encode(array(
            "mensaje" => "set Accesorios",
            "error" => "0",
        ));
        break;
    default:
        print json_encode(array(
            "error" => "1",
            "mensaje" => "No se ha seleccionado una acción"
        ));
        break;
}
