<?php
    session_cache_expire(1);
    session_start();
    require_once("../includes/conexion.php");
    
    $accion = $_REQUEST["accion"];
    
    switch($accion) {
        case "iniciarSesion":
            $cedula = $_REQUEST["cedula"];
            $clave = md5($_REQUEST["clave"]);

            $sql = "SELECT 
	                    u.id as usuario_id, 
	                    u.cedula as cedula, 
                        u.nombres as nombres, 
                        u.apellidos as apellidos,
                        u.correo as correo,
                        u.tipo_usuario_id as tipo_usuario_id,
                        u.agencia_id as agencia_id,
                        a.agencia as agencia,
                        oc.id as oficina_comercial_id,
                        oc.agencia as oficina_comercial
                    FROM usuarios u
                    left join agencias a on u.agencia_id = a.id
                    left join agencias oc on a.agencia_id = oc.id
                    where cedula='$cedula' and clave='$clave'";
            $res = $hAccesorios->prepare($sql);
            $res->execute();
            $v = $res->fetch();
            $cuenta = $res->rowCount();
            if ($cuenta > 0){
                $_SESSION["usuarioId"] = $v["usuario_id"];
                $_SESSION["usuarioNombre"] = $v["nombres"]." ".$v["apellidos"];
                $_SESSION["usuarioCorreo"] = $v["correo"];
                $_SESSION["usuarioTipoId"] = $v["tipo_usuario_id"];
                $_SESSION["usuarioAgenciaId"] = $v["agencia_id"];
                $_SESSION["usuarioAgencia"] = $v["agencia"];
                $_SESSION["usuarioOficinaComercialId"] = $v["oficina_comercial_id"];
                $_SESSION["usuarioOficinaComercial"] = $v["oficina_comercial"];
                header("Location: ../modulos/index.php");
            } else {
                header("Location: ../index.php?error=1");
            }            
            break;
        case "cerrarSesion":
            unset($_SESSION["usuarioId"]);
            unset($_SESSION["usuarioNombres"]);
            unset($_SESSION["usuarioApellidos"]);
            unset($_SESSION["usuarioCorreo"]);
            unset($_SESSION["usuarioTipoId"]);
            unset($_SESSION["usuarioAgenciaId"]);
            unset($_SESSION["usuarioAgencia"]);
            unset($_SESSION["usuarioOficinaComercialId"]);
            unset($_SESSION["usuarioOficinaComercial"]);
            header("Location: ../index.php");
            break;
        case "CambiarClave":
            $usuarioId = $_REQUEST["usuarioId"];
            $clave = md5($_REQUEST["clave"]);
            $clave1 = md5($_REQUEST["clave1"]);
            $clave2 = md5($_REQUEST["clave2"]);
            $sql = "select * from usuarios where id=$usuarioId and clave='$clave'";
            $res = $hAccesorios->prepare($sql);
            $res->execute();
            $v = $res->fetch();
            $cuenta = $res->rowCount();
            if ($cuenta == 0) {
                header("Location: ../modulos/usuario/cambiarClave.php?error=1");
            } elseif ($clave1 != $clave2) {
                header("Location: ../modulos/usuario/cambiarClave.php?error=2");
            } else {
                $sql = "update usuarios set clave='$clave1' where id=$usuarioId";
                $res = $hAccesorios->prepare($sql);
                $res->execute();
                header("Location: ../modulos/usuario/cambiarClave.php?error=0");
            }
            break;
    }
