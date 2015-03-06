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
    case "getAgentesAutorizados":
        // Obtener Oficinas Comerciales
        $sql = "SELECT * FROM agencias where activo = 1 and id = agencia_id";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $arrayOc = $res->fetchAll();
        // Obtener Agenctes Autorizados
        $sql = "SELECT * FROM agencias where activo = 1 and id != agencia_id";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $arrayAa = $res->fetchAll();
        $return = array();
        foreach ($arrayOc as $k=>$v){
            $return[intval($v['id'])] = array(
                "nombre" => $v["agencia"],
                "agencias" => array()
            );
        }
        foreach ($arrayAa as $k=>$v){
            $return[intval($v['agencia_id'])]["agencias"][] = array(
                "id" => $v["id"],
                "nombre" => $v["agencia"]
            );
        }        
        print json_encode($return);
        break;
    case "getTiposUsuarios":
        $sql = "SELECT * FROM tipos_usuarios;";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        foreach ($array as $k=>$v){
            $return[intval($v['id'])] = $v["descripcion"];
        }
        print json_encode($return);
        break;
    case "getUsuarios":
        $sql = "SELECT
                    u.id as usuarioId,
                    cedula,
                    nombres,
                    apellidos,
                    correo,
                    u.agencia_id,
                    agencia,
                    a.agencia_id as oficina_comercial_id,
                    tipo_usuario_id,
                    descripcion as tipo_usuario
                FROM usuarios u
                inner join agencias a on u.agencia_id = a.id
                inner join tipos_usuarios tu on u.tipo_usuario_id = tu.id";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        $array = $res->fetchAll();
        foreach ($array as $k=>$v){
            $return[intval($v['usuarioId'])] = array(
                "cedula" => $v["cedula"],
                "nombres" => $v["nombres"],
                "apellidos" => $v["apellidos"],
                "correo" => $v["correo"],
                "agencia_id" => $v["agencia_id"],
                "agencia" => $v["agencia"],
                "oficina_comercial_id" => $v["oficina_comercial_id"],
                "tipo_usuario_id" => $v["tipo_usuario_id"],
                "tipo_usuario" => $v["tipo_usuario"],
            );
        }
        print json_encode($return);
        break;
    case "setUsuario":
        $cedula = $_REQUEST["cedula"];
        $nombres = $_REQUEST["nombres"];
        $apellidos = $_REQUEST["apellidos"];
        $clave = md5($_REQUEST["clave"]);
        $correo = $_REQUEST["correo"];
        $agenciaId = $_REQUEST["agenciaId"];
        $tipoUsuarioId = $_REQUEST["tipoUsuarioId"];

        $sql = "INSERT INTO usuarios values(null, '$cedula', '$nombres', '$apellidos', '$correo', '$clave', $agenciaId, $tipoUsuarioId)";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        print json_encode(array(
            "mensaje" => "Set Usuario",
            "sql" => "$sql",
            "error" => "0",
            "id" => $hAccesorios->lastInsertId()
        ));
        break;
    case "updateUsuario":
        $id = $_REQUEST["id"];
        $cedula = $_REQUEST["cedula"];
        $nombres = $_REQUEST["nombres"];
        $apellidos = $_REQUEST["apellidos"];
        $clave = $_REQUEST["clave"] == "" ? "" : md5($_REQUEST["clave"]);
        $correo = $_REQUEST["correo"];
        $agenciaId = $_REQUEST["agenciaId"];
        $tipoUsuarioId = $_REQUEST["tipoUsuarioId"];
        
        $sql = "UPDATE usuarios set cedula='$cedula', nombres='$nombres', "
                . "apellidos='$apellidos', correo='$correo', "
                . "agencia_id=$agenciaId, tipo_usuario_id=$tipoUsuarioId "
                . ($clave != "" ? ", clave='$clave'" : "")
                . "where id=$id";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        print json_encode(array(
            "mensaje" => "Set Usuario",
            "sql" => "$sql",
            "error" => "0",
            "id" => $hAccesorios->lastInsertId()
        ));
        break;
    case "delUsuario":
        $id = $_REQUEST["id"];
        $sql = "DELETE FROM usuarios where id=$id";
        $res = $hAccesorios->prepare($sql);
        $res->execute();
        print json_encode(array(
            "mensaje" => "Del Usuario",
            "sql" => "$sql",
            "error" => "0",
            "id" => $id
        ));
        break;
}