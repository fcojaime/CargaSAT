<?php
//BindEvents Method @1-966EDDCE
function BindEvents()
{
    global $NewRecord1;
    $NewRecord1->CCSEvents["OnValidate"] = "NewRecord1_OnValidate";
}
//End BindEvents Method

//NewRecord1_OnValidate @2-A9AB815E
function NewRecord1_OnValidate(& $sender)
{
    $NewRecord1_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
    global $conx_xls;
    $conx_xls= new clsDBcon_xls();
    
    
    $nivel_de_servicio=$NewRecord1->ListBox1->GetValue() ;
    if( $nivel_de_servicio<1)
    {
    	$NewRecord1->Errors->addError("Debe seleccionar un nivel de servicio");
    }
    else {
    	$tipo_archivo=CCDLookUp("tipo_arch","layouts","id_layout=".$conx_xls->ToSQL($nivel_de_servicio, ccsInteger),   $conx_xls);
      //$NewRecord1->Errors->addError("tipo arch ".$tipo_archivo);
   
	$nom_archivo=$NewRecord1->archivo_excel->GetValue();
	if ($nom_archivo!=""){
		$arreglo=explode(".",$nom_archivo);
	 	$ext_archivo=$arreglo[2];
	     	if($ext_archivo!=$tipo_archivo)	
	     		 $NewRecord1->Errors->addError("El tipo de archivo seleccionado no corresponde al tipo de Layout. <br>Seleccione un archivo de tipo ".$tipo_archivo);
	 }
}
  
  
    
//End NewRecord1_OnValidate

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close NewRecord1_OnValidate @2-304A44B9
    return $NewRecord1_OnValidate;
}
//End Close NewRecord1_OnValidate

function obtenDatosLayout($id_layout){
 $datosLayout[0]= "";
 include("conectabd.php");
  if ($conx ){ 
		$ssql = "Select * from layouts 	where id_layout=$id_layout"; 
		if($rs_result = odbc_exec ($conx, $ssql)){ 
				
			while ( odbc_fetch_row($rs_result) ) { 	
        /*
        $id_layout=	odbc_result($rs_result,"id_layout");		
				$nombre_layout  =	odbc_result($rs_result,"nombre_layout");
        $tipo_arch=	odbc_result($rs_result,"tipo_arch");
        $num_hojas=	odbc_result($rs_result,"num_hojas");
        $posicionable=	odbc_result($rs_result,"posicionable");
        $nombre_tabla_destino=	odbc_result($rs_result,"nombre_tabla_destino");
        */
        $datosLayout[0]=	odbc_result($rs_result,"id_layout");		
				$datosLayout[1]  =	odbc_result($rs_result,"nombre_layout");
        $datosLayout[2]=	odbc_result($rs_result,"tipo_arch");
        $datosLayout[3]=	odbc_result($rs_result,"num_hojas");
        $datosLayout[4]=	odbc_result($rs_result,"posicionable");
        $datosLayout[5]=	odbc_result($rs_result,"nombre_tabla_destino");
        $datosLayout[6]=	odbc_result($rs_result,"num_cols_descartar");
        } //while
    } // if $rs
  } //if  conx  
  else {
      echo "no se pudo conectar a la base de datos";
  }
  odbc_close( $conx );
  return   $datosLayout  ;

} 
?>


//BindEvents Method @1-966EDDCE
function BindEvents()
{
    global $NewRecord1;
    $NewRecord1->CCSEvents["OnValidate"] = "NewRecord1_OnValidate";
}
//End BindEvents Method

//NewRecord1_OnValidate @2-A9AB815E
function NewRecord1_OnValidate(& $sender)
{
    $NewRecord1_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
//End NewRecord1_OnValidate

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close NewRecord1_OnValidate @2-304A44B9
    return $NewRecord1_OnValidate;
}
//End Close NewRecord1_OnValidate