<?php
require_once("../config/conexion.php");
//llamada al modelo marca
require_once("../modelos/Recibos.php");

$recibos = new Recibos();

switch ($_GET["op"]) {
  case 'get_detalle_lente_rec_ini':
     
  break;


///////////////////////GET NUMERO RECIBO
  case "get_numero_recibo":
  $datos= $recibos->get_numero_recibo($_POST["sucursal_correlativo"]);
  $sucursal = $_POST["sucursal_correlativo"];
  $prefijo = "";
  if ($sucursal=="Metrocentro") {
    $prefijo="ME";
  }elseif ($sucursal=="Santa Ana") {
    $prefijo="SA";
  }elseif ($sucursal=="San Miguel") {
    $prefijo="SM";
  }
    if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){                  
      $codigo=$row["numero_recibo"];
      $cod=(substr($codigo,4,11))+1;
      $output["correlativo"]="R".$prefijo."-".$cod;
    }             
  }else{
      $output["correlativo"] = "R".$prefijo."-1";
  }

   echo json_encode($output);

  break;

  case 'registrar_recibo':

  $datos=$recibos->valida_existencia_nrecibo($_POST["n_recibo"]);
  if(is_array($datos)==true and count($datos)==0){

    $recibos->agrega_detalle_abono($_POST['a_anteriores'],$_POST['n_recibo'],$_POST['n_venta_recibo_ini'],$_POST['monto'],$_POST['fecha'],$_POST['sucursal'],$_POST['id_paciente'],$_POST['id_usuario'],$_POST['telefono_ini'],$_POST['recibi_rec_ini'],$_POST['empresa_ini'],$_POST['texto'],$_POST['numero'],$_POST['saldo'],$_POST['forma_pago'],$_POST['marca_aro_ini'],$_POST['modelo_aro_ini'],$_POST['color_aro_ini'],$_POST['lente_rec_ini'],$_POST['ar_rec_ini'],$_POST['photo_rec_ini'],$_POST['observaciones_rec_ini'],$_POST['pr_abono'],$_POST['servicio_rec_ini']);
      $messages[]="ok";
      
    }else{
      $errors[]="error";
    }

    if (isset($messages)){
     ?>
       <?php
         foreach ($messages as $message) {
             echo json_encode($message);
           }
         ?>
   <?php
 }
    //mensaje error
      if (isset($errors)){

   ?>

         <?php
           foreach ($errors as $error) {
               echo json_encode($error);
             }
           ?>
   <?php
   } 

    break;

  /////////////COMPROBAR SALDOS PARA IMPRIMIR FACTURA CONTADO
  case "consultar_saldo":
  $datos= $recibos->saldo_venta($_POST["n_venta"],$_POST["id_paciente"]);
  
    if(is_array($datos)==true and count($datos)>0){
      foreach($datos as $row){                  
        $output["saldo"]=$row["saldo"];
      }             
    }

   echo json_encode($output);

  break;

  case 'listar_recibos_emitidos':
    $datos=$recibos->get_recibos_emitidos($_POST["sucursal"]);
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){

        $sub_array = array();

        $sub_array[] = $row["id_recibo"];
        $sub_array[] = $row["numero_recibo"];
        $sub_array[] = $row["numero_venta"];
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["servicio_para"];
        $sub_array[] = '<button type="button"  class="btn btn-md bg-light" onClick="editar_recibo('.$row["id_recibo"].',\''.$row["numero_recibo"].'\',\''.$row["numero_venta"].'\','.$row["nombres"].')"><i class="fa fa-edit" aria-hidden="true" style="color:green"></i></button>';
        $sub_array[] = '<a href="imprimir_recibo_pdf.php?n_recibo='.$row["numero_recibo"].'&'."nombres=".$row["nombres"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button" class="btn btn-link btn-md imprimir_recibo"><i class="fa fa-print" aria-hidden="true" style="color:green"></i></button></a>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Informaci??n para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);      
    break;

}