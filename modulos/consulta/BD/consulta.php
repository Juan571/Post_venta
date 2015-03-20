<?php
    include("../../../includes/conexion.php");
    $json=array();
    $arrayCaso=array();
    $arrayAccesorios=array();
    $caso=intval($_GET["caso"]);
    $sql="SELECT
          s_a.id as id_caso,
          usr.nombres as nombres_operador,
          sol.nombres nombres_cliente,
          sol.telefono_fijo as tel_fijo,
          sol.telefono_movil as movil,
          sol.cedula as cedula,
          sol.direccion as direccion,
          modelos.modelo as modelo,
          s_a.fecha_solicitud as fecha_solicitud,
          eq.fecha_compra as fecha_compra,
          op.operadora as operadora,
          inv.producto as producto,
          t_p.descripcion as tipo_producto,
          m_r.motivo as motivo,
          s_a_i.id as id_accesorio,
          t_e.estado
        FROM solicitudes_accesorios s_a
        INNER JOIN tipos_estados t_e on t_e.id=tipo_estado_id
        INNER JOIN usuarios usr on usr.id=usuario_id
        INNER JOIN equipos eq on eq.id=equipo_id
        INNER JOIN solicitantes sol on sol.id=eq.solicitante_id
        INNER JOIN modelos on modelos.id=eq.modelo_id
        INNER JOIN tecnologias tec on tec.id=eq.tecnologia_id
        INNER JOIN operadoras op on op.id=eq.operadora_id
        INNER JOIN solicitudes_accesorios_inventario s_a_i on s_a_i.solicitud_accesorios_id=s_a.id
        INNER JOIN inventario inv on inv.id=s_a_i.inventario_id
        INNER JOIN tipos_productos t_p on t_p.id=inv.tipo_producto_id
        INNER JOIN motivos_reemplazo m_r on m_r.id=s_a_i.motivo_id WHERE s_a.id=$caso;";
    $resDatos=$hAccesorios->prepare($sql);
    $resDatos->execute();
    $datos=$resDatos->fetchAll();
    foreach ($datos as $k=>$v){
        $arrayCaso[$v["id_caso"]]["nombre_operador"]=$v["nombres_operador"];
        $arrayCaso[$v["id_caso"]]["nombres_cliente"]=$v["nombres_cliente"];
        $arrayCaso[$v["id_caso"]]["id"]=$v["id_caso"];
        $arrayCaso[$v["id_caso"]]["tel_fijo"]=$v["tel_fijo"];
        $arrayCaso[$v["id_caso"]]["tel_movil"]=$v["movil"];
        $arrayCaso[$v["id_caso"]]["cedula_cliente"]=$v["cedula"];
        $arrayCaso[$v["id_caso"]]["direccion"]=$v["direccion"];
        $arrayCaso[$v["id_caso"]]["modelo"]=$v["modelo"];
        $arrayCaso[$v["id_caso"]]["fecha_solicitud"]=$v["fecha_solicitud"];
        $arrayCaso[$v["id_caso"]]["fecha_compra"]=$v["fecha_compra"];
        $arrayCaso[$v["id_caso"]]["operadora"]=$v["operadora"];
        $arrayCaso[$v["id_caso"]]["estado"]=$v["estado"];
    }
    foreach ($datos as $k=>$v){
        $arrayAccesorios[$v["id_accesorio"]]["producto"]=$v["producto"];
        $arrayAccesorios[$v["id_accesorio"]]["tipo_producto"]=$v["tipo_producto"];
        $arrayAccesorios[$v["id_accesorio"]]["motivo"]=$v["motivo"];
    }
    $json["caso"]=$arrayCaso;
    $json["accesorios"]=$arrayAccesorios;
    print json_encode($json);
?>