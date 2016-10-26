<?php

include './Classes/PHPExcel/IOFactory.php';

//error_reporting (E_ALL);

//BindEvents Method @1-277223D3
function BindEvents()
{
    global $NewRecord1;
    global $CCSEvents;
    $NewRecord1->Button_Insert->CCSEvents["OnClick"] = "NewRecord1_Button_Insert_OnClick";
    $NewRecord1->Aplicar->CCSEvents["OnClick"] = "NewRecord1_Aplicar_OnClick";
    $NewRecord1->CCSEvents["OnValidate"] = "NewRecord1_OnValidate";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//NewRecord1_Button_Insert_OnClick @4-848B3021
function NewRecord1_Button_Insert_OnClick(& $sender)
{
    $NewRecord1_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
//End NewRecord1_Button_Insert_OnClick

//Custom Code @33-2A29BDB7
// -------------------------
    // Write your own code here.
    $NewRecord1->id_reg_ok->SetValue(0);
     	 $NewRecord1->img_cargando->SetValue("images/cargando.gif");  
	$NewRecord1->img_cargando->Visible  =true;
// -------------------------
//End Custom Code

//Close NewRecord1_Button_Insert_OnClick @4-A9FC55FD
    return $NewRecord1_Button_Insert_OnClick;
}
//End Close NewRecord1_Button_Insert_OnClick

//NewRecord1_Aplicar_OnClick @20-C8706DC8
function NewRecord1_Aplicar_OnClick(& $sender)
{
    $NewRecord1_Aplicar_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
    global $conx_xls;
    $conx_xls= new clsDBcon_xls();
    
    //pendiente CCGetParam("id_registro")
    
     
//End NewRecord1_Aplicar_OnClick

//Custom Code @24-2A29BDB7
// -------------------------
    // Write your own code here.
     //Generacion de registros para el sistema comparativo una vez que se realizo la carga correctamente
     $conx_xls->query("exec TableroMyM_SDMA4.dbo.actualiza_comparativo_incidentes ".$NewRecord1->ListBox1->GetValue());
     $conx_xls->query("exec TableroMyM_SDMA4.dbo.actualiza_comparativo_aperturas ".$NewRecord1->ListBox1->GetValue());
     $conx_xls->query("exec TableroMyM_SDMA4.dbo.actualiza_comparativo_cierres ".$NewRecord1->ListBox1->GetValue());
          
     global $Redirect;          
     $Redirect="historico_cargas_rs2.php?s_id_periodo=".$NewRecord1->ListBox1->GetValue()."&s_opt_slas=".$NewRecord1->optsla->GetValue() ;
  
     	
// -------------------------
//End Custom Code

//Close NewRecord1_Aplicar_OnClick @20-6E8B07EF
    return $NewRecord1_Aplicar_OnClick;
}
//End Close NewRecord1_Aplicar_OnClick

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL      $NewRecord1->Label4->SetValue("pulso el boton");
//DEL      
//DEL  // -------------------------

//NewRecord1_OnValidate @2-A9AB815E
function NewRecord1_OnValidate(& $sender)
{
    $NewRecord1_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
    global $conx_xls;
    $conx_xls= new clsDBcon_xls();
    global $Redirect;
     
    $cadFormatoRedini="<font color=red size=2><strong>";
    $cadFormatofin="</strong></font>";
    $cadFormatoGini="<font color=green size=2><strong>";
  
 	 //$NewRecord1->img_cargando->SetValue("images/cargando.gif");  
	//$NewRecord1->img_cargando->Visible  =true;
 			
     
    //error_reporting(E_ALL);
     if ($NewRecord1->id_reg_ok->GetValue()>0)
     {
     		$mivar1=CCGetParam("mivar",1);
     		    		
	      $id_periodo=$NewRecord1->ListBox1->GetValue() ;
	      ///////////////7
	      	$id_usuario=CCGetUserID(); 
	    	$id_proveedor=CCDLookUp("id_proveedor","usuario","id_usuario=".$conx_xls->ToSQL($id_usuario, ccsInteger),   $conx_xls);
	      	$id_grupo=CCDLookUp("id_grupo","grupo_proveedor_SAT","id_proveedor=".$conx_xls->ToSQL($id_proveedor, ccsInteger),   $conx_xls);
	       //////
	       $str_anio=CCDLookUp("anio","periodos_carga","id_periodo=".$conx_xls->ToSQL($id_periodo, ccsInteger),   $conx_xls);
	      	$str_mes=CCDLookUp("nombre_mes","periodos_carga","id_periodo=".$conx_xls->ToSQL($id_periodo, ccsInteger),   $conx_xls);
	       $str_periodo=$str_mes."/".$str_anio;
	       //////
	       $num_intentos_permitidos=CCDLookUp("num_intentos_permitidos","periodos_carga"," id_periodo=".$conx_xls->ToSQL($id_periodo, ccsInteger),   $conx_xls);
       
	       $ids_layouts=ObtenGrupoLayout($id_grupo);
	       $numero_de_layouts=count( $ids_layouts);
	       $id_registro=$NewRecord1->id_reg_ok->GetValue();
	       $cad_resultado="";
	       //nuevo
	       $str_fecha_limite=CCDLookUp("fecha_limite","periodos_carga","id_periodo=".$conx_xls->ToSQL($id_periodo, ccsInteger),   $conx_xls);
	     	$vigencia=2;//ComparaFechasYMD($str_fecha_limite);
	     	$opt_slas=$NewRecord1->optsla->GetValue() ;	
	     	$tipo_carga=CCDLookUp("tipo_periodo","periodos_carga"," id_periodo=".$conx_xls->ToSQL($id_periodo, ccsInteger),   $conx_xls);
           	//$fecha_hoy=date("Y/m/d H:i");
	       //$NewRecord1->Errors->addError(" str_fecha_limite $str_fecha_limite, $fecha_hoy $fecha_hoy");
			
	       
	       //nuevo
	    	if ( $ids_layouts[0][0]>0 && $ids_layouts[0][1] !="" && $ids_layouts[0][2] !="" && ($vigencia==0 || $vigencia==2 )){ //sí encontró al menos un layout
	    		$num_intentos_hechos=ObtenIntentosHechosPorPeriodo($id_proveedor,$id_periodo,$ids_layouts[0][2],$opt_slas);
      			//$NewRecord1->Errors->addError(" num_intentos_hechos $num_intentos_hechos");
		    	if($num_intentos_hechos<$num_intentos_permitidos){
		    		for ($nlayout=0; $nlayout<$numero_de_layouts; $nlayout++){	
					$nom_tabla=$ids_layouts[$nlayout][2];
					$leyenda=$ids_layouts[$nlayout][3];
					$fecha_registro="'".date("Y/m/d H:i")."'";
				 	$ssql = "Update $nom_tabla set estatus= 'F' , fecha_registro=$fecha_registro,
				 	num_carga=(select ISNULL ( max(num_carga),0)+1 from $nom_tabla where id_proveedor=$id_proveedor and estatus='F' and tipo_nivel_servicio='$opt_slas' and id_periodo=$id_periodo)
				 	 where id_usuario=$id_usuario
			                    and   id_registro=$id_registro   "; 
			             
				     $conx_xls->query($ssql);
				      $num_erro=$conx_xls->Errors->Count();
				      
				     	if ( $num_erro!=0)
				     		$NewRecord1->Errors->addError("$cadFormatoRedini <br>No se pudieron guardar los cambios en la tabla $nom_tabla debido a que hubo errores en la conexion $cadFormatofin");
				    	else {
				     	  $num_reg_afect=$conx_xls->affected_rows();
				         $cad_resultado.="<br> <strong><font color=blue>Se guardaron  $num_reg_afect registros de $leyenda  </strong></font> ";
				     	 //$NewRecord1->Errors->addError();
				    	}
		    		}//for
		    		$num_intento=CCDLookUp("num_carga", $nom_tabla,"id_registro=".$conx_xls->ToSQL($id_registro, ccsInteger),   $conx_xls);
		      
		    		$cad_resultado="Para el periodo <strong>$str_periodo </strong> se tienen los siguientes datos de carga en su intento número $num_intento:<br> ".$cad_resultado;
		    		if($num_intentos_permitidos==$num_intento)
		    			$cad_resultado=$cad_resultado."<br>Esta es la última carga permitida para este periodo";
		    			
		    		$NewRecord1->Label3->SetValue($cad_resultado);
		    		$para=CCDLookUp("email_usuario","usuario","id_usuario=".$conx_xls->ToSQL($id_usuario, ccsInteger),   $conx_xls);
		      		
		      		
		    		//enviaCorreoCargaArchivo($para, "Resumen de la Carga de archivos", $cad_resultado,$num_intento,$str_periodo);
		    	}
		    	else{
		 		$NewRecord1->Errors->addError("$cadFormatoRedini El número de intentos permitidos ya ha sido cubierto $cadFormatofin");
   
		    		//$NewRecord1->Errors->addError(" num_intentos_hechos $num_intentos_hechos, num_intentos_permitidos $num_intentos_permitidos");
		    	}
	    	} 
	    	else{
	    		if($vigencia==1)	{
	    			$NewRecord1->Errors->addError("$cadFormatoRedini La fecha límite de carga a expirado y no se aplicó  la carga del archivo  $cadFormatofin");
	    		}
	    	}
	    	CCSetSession("resumen_carga", $cad_resultado);
	    	$NewRecord1->Aplicar->Visible=false;
	       $NewRecord1->id_reg_ok->SetValue(0); 
	       $NewRecord1->Label3->Visible=true;
	       // $NewRecord1_OnValidate = false;
     	}
 else {
    CCSetSession("resumen_carga",""); //limpiamos la variable de resultado
  
    $opt_slas=$NewRecord1->optsla->GetValue() ;
    if ($opt_slas=="") {
    	$NewRecord1->Errors->addError("$cadFormatoRedini Indique si el archivo es SLA o SLO $cadFormatofin");
    	$NewRecord1->Aplicar->Visible=false;
    }
   else {
    $id_periodo=$NewRecord1->ListBox1->GetValue() ;
    if( $id_periodo<1)
    {
    	$NewRecord1->Errors->addError("$cadFormatoRedini Debe seleccionar un periodo de carga $cadFormatofin");
    	$NewRecord1->Aplicar->Visible=false;
    }
    else {
    	//$NewRecord1->Aplicar->Visible=true;//ojo nuevo y se quito del before show
    	
    	$id_usuario=CCGetUserID(); 
    	$id_proveedor=CCDLookUp("id_proveedor","usuario","id_usuario=".$conx_xls->ToSQL($id_usuario, ccsInteger),   $conx_xls);
      	$id_grupo=CCDLookUp("id_grupo","grupo_proveedor_SAT","id_proveedor=".$conx_xls->ToSQL($id_proveedor, ccsInteger),   $conx_xls);
	     
      	$ids_layouts=ObtenGrupoLayout($id_grupo);
       $numero_de_layouts=count( $ids_layouts);
       $num_intentos_permitidos=CCDLookUp("num_intentos_permitidos","periodos_carga"," id_periodo=".$conx_xls->ToSQL($id_periodo, ccsInteger),   $conx_xls);
       $tipo_carga=CCDLookUp("tipo_periodo","periodos_carga"," id_periodo=".$conx_xls->ToSQL($id_periodo, ccsInteger),   $conx_xls);
       
      	     
       $num_intentos_hechos=ObtenIntentosHechosPorPeriodo($id_proveedor,$id_periodo,$ids_layouts[0][2],$opt_slas);
       // $NewRecord1->Errors->addError("num_intentos_hechos $num_intentos_hechos id_proveedor $id_proveedor, id_periodo $id_periodo, tabla ".$ids_layouts[0][2] );
						 
     
    	if ( $ids_layouts[0][0]>0 && $ids_layouts[0][1] !="" && $num_intentos_permitidos>$num_intentos_hechos){ //sí encontró al menos un layout
    		 $tipo_archivo=$ids_layouts[0][1];
    	
    	   	//$tipo_archivo=CCDLookUp("tipo_arch","layouts","id_layout=".$conx_xls->ToSQL($nivel_de_servicio, ccsInteger),   $conx_xls);
	      //$NewRecord1->Errors->addError("tipo arch ".$tipo_archivo);
	   
		$nom_archivo=$NewRecord1->archivo_excel->GetValue();
		//$NewRecord1->Errors->addError("nom_archivo $nom_archivo");
		if ($nom_archivo!=""){
			$arreglo=explode(".",$nom_archivo);
		 	$ext_archivo=$arreglo[2];
		 	$nom_archivo_simple=$arreglo[1].".".$arreglo[2];
		 	$prefijo_arch_slo=CCDLookUp("nom_arch_slo","usuario","id_usuario=".$conx_xls->ToSQL($id_usuario, ccsInteger),   $conx_xls);
		 	$prefijo_arch_sla=CCDLookUp("nom_arch_sla","usuario","id_usuario=".$conx_xls->ToSQL($id_usuario, ccsInteger),   $conx_xls);
     			$anio_p=CCDLookUp("anio","periodos_carga"," id_periodo=".$conx_xls->ToSQL($id_periodo, ccsInteger),   $conx_xls);
      			$mes_p=CCDLookUp("mes","periodos_carga"," id_periodo=".$conx_xls->ToSQL($id_periodo, ccsInteger),   $conx_xls);
      
		 	//$anio_arch="vacio";
		 	//$mes_arch="vacio";
		 	$valtipoSL="NO";
		 	$mensaje_err_nomenc="El tipo de archivo no cumple con la nomenclatura especificada.";
		 		
		 	if( $opt_slas=="SLO") {
		 		$num_letra_prefijo=strlen($prefijo_arch_slo);
		 		$nom_arch_ini=substr ($nom_archivo_simple,0,$num_letra_prefijo);
		 		$nom_arch_fin=substr ($nom_archivo_simple,$num_letra_prefijo+1,8);
		 		//$nom_archivo_simple="RepSLO_CDS" ;  //"RepSLO_CDS2_20140530.xls" 
		 		if($nom_arch_ini==$prefijo_arch_slo ){	//empezó bien	 		
		 			$anio_arch=substr($nom_arch_fin,0,4);
		 			$mes_arch=substr($nom_arch_fin,4,2);	
		 			if($anio_arch==$anio_p && $mes_arch==$mes_p){
		 				$valtipoSL="OK";	
		 			}
		 			else{
		 				if($anio_arch!=$anio_p )
		 					$mensaje_err_nomenc="El nombre del archivo no cumple con el año del periodo seleccionado";
		 				else
		 					$mensaje_err_nomenc="El nombre del archivo no cumple con el mes del periodo seleccionado";
		 			
		 			}
		 		}
		 		
		 		//echo "nom_arch_ini $nom_arch_ini, nom_arch_fin $nom_arch_fin, prefijo_arch_slo  $prefijo_arch_slo,  anio_arch $anio_arch, mes_arch $mes_arch , anio_p $anio_p, mes_p $mes_p ";
		 	}
		 	else
		 	{  //$opt_slas=="SLA"
		 		$num_letra_prefijo=strlen($prefijo_arch_sla);
		 		$nom_arch_ini=substr ($nom_archivo_simple,0,$num_letra_prefijo);
		 		$nom_arch_fin=substr ($nom_archivo_simple,$num_letra_prefijo+1,8);
		 				 		
		 		if($nom_arch_ini==$prefijo_arch_sla ){	//empezó bien	 		
		 			$anio_arch=substr($nom_arch_fin,0,4);
		 			$mes_arch=substr($nom_arch_fin,4,2);	
		 			if($anio_arch==$anio_p && $mes_arch==$mes_p){
		 				$valtipoSL="OK";	
		 			}
		 			else{
		 				if($anio_arch!=$anio_p )
		 					$mensaje_err_nomenc="El nombre del archivo no cumple con el año del periodo seleccionado";
		 				else
		 					$mensaje_err_nomenc="El nombre del archivo no cumple con el mes del periodo seleccionado.";
		 			
		 			}
		 		}
		 		//echo "nom_arch_ini $nom_arch_ini, nom_arch_fin $nom_arch_fin, prefijo_arch_sla  $prefijo_arch_sla,  anio_arch $anio_arch, mes_arch $mes_arch , anio_p $anio_p, mes_p $mes_p ";
			}
		     	if($ext_archivo!=$tipo_archivo || $valtipoSL!="OK"	)	{
		     		if ($ext_archivo!=$tipo_archivo )
		     			$NewRecord1->Errors->addError("$cadFormatoRedini El tipo de archivo seleccionado no corresponde al tipo de Layout. <br>Seleccione  un archivo de tipo $opt_slas (".$tipo_archivo.") $cadFormatofin");
		     		else	{
		     			//if($valtipoSL!="OK")
		     			$NewRecord1->Errors->addError("$cadFormatoRedini $mensaje_err_nomenc  $cadFormatofin");
		     		}
		     			
				$NewRecord1->Aplicar->Visible=false;
			}
		      else {    
		    
	           		$num_carga= $num_intentos_hechos+1; 
	            		$contador="";
	            		$id_registro=time()+rand(1,2345);
	            		$fecha_registro="'".date("Y/m/d H:i:s")."'";
	            		//include ("clock.php");
	            		//$fec_dmy=date("d/m/Y H:i");
		            	//echo "<br> fec reg ".$fecha_registro;
		            	//$NewRecord1->Errors->addError("<br> fec reg ".$fecha_registro.", fec_dmy $fec_dmy");
		            	//lectura del archivo
			     	$inputFileName ="./temp_xls/".$nom_archivo;
				$NewRecord1->ruta_archivo->SetValue($inputFileName);
				 //$NewRecord1->Errors->addError(" inputFileName $inputFileName");
				//  Read your Excel workbook
				try {
				    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
				    $objPHPExcel = $objReader->load($inputFileName);
				} catch (Exception $e) {
				    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
				    . '": ' . $e->getMessage());
				}
				
				//  Get worksheet dimensions
				$sheetCount = $objPHPExcel->getSheetCount();
				//$NewRecord1->Errors->addError("el archivo tiene $sheetCount hojas");
			  	$NewRecord1->Errors->addError("$cadFormatoGini Este es su intento num. $num_carga, le restan ".($num_intentos_permitidos- $num_carga)." intentos $cadFormatofin");
			  
			    //echo "<div id='progress' style='position:relative;padding:0px; width:650px;height:960px;left:25px;'>";

			  
		      		//empezamos a validar y cargar cada layout/hoja
		      		$erroresGeneral="NO"; 
		      		$NewRecord1->Aplicar->Visible=false; 
		      		try {
			      		for ($nlayout=0; $nlayout<$numero_de_layouts; $nlayout++){	
				     		$id_layout=$ids_layouts[$nlayout][0];
				     		$contador="";
				     		include("carga_hoja.php");
			      		}//for
		      		} catch (Exception $e) {
				    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
				    . '": ' . $e->getMessage());
				}
		      		 $validacionesSQL=ValidaInfoCargada($id_proveedor,$id_registro );
		      		 $num_errorValidaciones=count($validacionesSQL);
				
				 if($num_errorValidaciones>1 || $validacionesSQL[0][0]==-1){
				 	//muestra errores	
				 	$errores_datos="SI";
				 	$NewRecord1->Aplicar->Visible=false; 
				 	for($n=0; $n<$num_errorValidaciones; $n++){
       	        			$NewRecord1->Errors->addError($cadFormatoRedini .$validacionesSQL[$n][1].$cadFormatofin);
				 	}
					 if( $erroresGeneral=="SI" )
				  		$NewRecord1->Errors->addError($cadFormatoRedini ."Por favor corrija los errores reportados y vuelva a cargar el archivo".$cadFormatofin);
				 	
				 }
				 else {
				 	 if( $erroresGeneral!="SI" ) {
				 		$NewRecord1->Errors->addError("$cadFormatoGini Se validó la información y no se encontraron errores. Para almacenar su información dar clic en el botón -Aplicar- que se encuentra abajo de su pantalla.  $cadFormatofin");
						$NewRecord1->Aplicar->Visible=true; 
				 	 }
				 	 else {
				 	 	$NewRecord1->Errors->addError($cadFormatoRedini ."Por favor corrija los errores reportados y vuelva a cargar el archivo".$cadFormatofin);
				 	
				 	 	}
				 }
				 
		   	}// else de si la ext es correcta
		}//if nom arch !=""
		else {
		 	$NewRecord1->Errors->addError("$cadFormatoRedini Debe seleccionar un archivo para cargar $cadFormatofin");
			$NewRecord1->Aplicar->Visible=false; 		
			
		}
    	}//if sí encontró al menos un layout
	else {//no encontró layouts en el grupo
		 if($num_intentos_permitidos<=$num_intentos_hechos)
      			$NewRecord1->Errors->addError("$cadFormatoRedini Ya ha sido cubierto el numero de intentos de carga del archivo, por lo que ya no se permite una carga mas $cadFormatofin");
      		else       
			$NewRecord1->Errors->addError("$cadFormatoRedini No se encontraron layouts en el grupo del usuario $cadFormatofin");
		$NewRecord1->Aplicar->Visible=false;
	}//else no encontró layouts en el grupo	
    }
 }
}
  
  $NewRecord1->img_cargando->Visible  =false;

    
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

//Page_AfterInitialize @1-A88926BC
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $carga_archivo; //Compatibility
    global $Redirect;
    
//End Page_AfterInitialize

//Custom Code @15-2A29BDB7

if(isset($_FILES['archivo_excel_File']['name'])) {
	//$Component->Content->visible=false;
	
	//$NewRecord1->Aplicar->visible=true;
	$Redirect="muestra_archivo.php";
	
}
else {
	//$NewRecord1->Aplicar->visible=false;
	//$Component->Content->visible=true;
	//echo "no hay";	
	}
//End Custom Code
//var_dump($_FILES);
//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeUnload @1-1C6754CA
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $carga_archivo; //Compatibility
  //  global $Redirect;
//End Page_BeforeUnload

//Custom Code @16-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//$Redirect="./muestra_archivo.php";
//End Custom Code

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload

//Page_BeforeShow @1-44E181DA
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $carga_archivo; //Compatibility
    global $NewRecord1;
//End Page_BeforeShow

//Custom Code @21-2A29BDB7
// -------------------------

  
 $nom_proveedor=CCGetSession("nom_cds");
 $NewRecord1->lnom_cds->SetValue("<font size=4><strong>CDS : ".$nom_proveedor."</strong></font>");
 
if(isset($_FILES['archivo_excel_File']['name'])) {
	
	/*
    global $CCSEvents;
    
    if ( $NewRecord1->Aplicar->CCSEvents["OnClick"])
    		$NewRecord1->Label3->SetValue("El boton aplicar fue oprimido");
    else 
    		$NewRecord1->Label3->SetValue("no se oprimio el boton");
    */
	//$NewRecord1->Aplicar->Visible=true;  ojo se puso en el onvalidate
	$Redirect="muestra_archivo.php";
	$NewRecord1->Label1->Visible=true;
	
	$NewRecord1->Label2->Visible=true;
	//$NewRecord1->Label2->SetValue("El resultado de la validacion del archivo es la siguiente : ");
	
}
else {
	//$carga_archivo->Content->NewRecord1->Aplicar->visible=false;
	
	$NewRecord1->Aplicar->Visible=false;
	$NewRecord1->Label1->Visible=false;
	$NewRecord1->Label1->SetValue(" ");
	$NewRecord1->Label2->Visible=false;
	$NewRecord1->Label2->SetValue(" ");
	
	//echo "no hay";	
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeInitialize @1-B03F1F3F
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $carga_archivo; //Compatibility
//End Page_BeforeInitialize

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

function obtenDatosLayout($id_layout){
	$datosLayout[0]= "";
 
 	global $db;
	$db=new clsDBcon_xls;
	
	//se va por la información de la estimación
	$ssql = "Select * from layouts 	where id_layout=$id_layout"; 
	$db->query($ssql);
	if($db->has_next_record()){
		while ($db->next_record() ) { 			         
	        $datosLayout[0]=	$db->f("id_layout");		
		  $datosLayout[1]=	$db->f("nombre_layout");
	        $datosLayout[2]=	$db->f("tipo_arch");
	        $datosLayout[3]=	$db->f("num_hojas");
	        $datosLayout[4]=	$db->f("posicionable");
	        $datosLayout[5]=	$db->f("nombre_tabla_destino");
	        $datosLayout[6]=	$db->f("num_cols_descartar");
	        $datosLayout[7]=$db->f("leyenda");
        	} //while
    	} // if $rs
  
  return   $datosLayout  ;

} 


function ObtenDefinicion_campos($id_layout,$posicionable){
	$datosLayout["0"]= "";
	global $db;
	$db=new clsDBcon_xls;
	
    	if ($posicionable=="NO")   {   //se basa en los nombres de las columnas
     		$cad_orden=" nombre_columna ";       
    	}
    	else {//se basa en la posicion de la columna
      	$cad_orden=" posicion ";
    	}
	$ssql = "Select * from detalle_layout where id_layout=$id_layout order by $cad_orden"; 
	$db->query($ssql);
	if($db->has_next_record()){
		if ($posicionable=="NO")   {   //se basa en los nombres de las columnas
        		$cad_orden=" nombre_columna ";  
			while ($db->next_record() ) { 			                        
		  	    $nombre_columna =	$db->f("nombre_columna");
		          $tipo_col=	$db->f("tipo_col");
		          $acepta_nulos=	$db->f("acepta_nulos");
		          $definicion_campo["$nombre_columna"][0]  = $tipo_col ; 
		          $definicion_campo["$nombre_columna"][1]  = $acepta_nulos ;          
          		} //while     
      	}
      	else {//se basa en la posicion de la columna          
         		while ($db->next_record() ) { 	
		            $posicion=	$db->f("posicion");
		            $tipo_col=	$db->f("tipo_col");
		            $acepta_nulos=	$db->f("acepta_nulos");
		            $img_0=$db->f("img_0");
		            $img_1=$db->f("img_1");
		            $img_2=$db->f("img_2");
		            
		            $definicion_campo[$posicion][0] = $tipo_col ;  
		            $definicion_campo[$posicion][1] = $acepta_nulos;   
		            $definicion_campo[$posicion][2] = $img_0;  
		            $definicion_campo[$posicion][3] = $img_1;
		            $definicion_campo[$posicion][4] = $img_2;           
		       } //while
        	}
    } // if $rs
   
  return   $definicion_campo ;

}

function validaCampo($v,$num_de_columna,$definicion_campos){
   //echo "dentro de la funcion";
  // echo $definicion_campos[1];
     //echo "num_de_columna  $num_de_columna" ;
    $validaCampo[0]=-1;
    $tipo_de_dato=$definicion_campos[$num_de_columna][0];
    $acepta_nulos=$definicion_campos[$num_de_columna][1];
    $img0=$definicion_campos[$num_de_columna][2];
    $img1=$definicion_campos[$num_de_columna][3];
    $img2=$definicion_campos[$num_de_columna][4];
    
    if($acepta_nulos=="SI" && $v=="") {
        $validaCampo[0]=1;
        $validaCampo[2]=" null ";
    }
    else {
        switch ($tipo_de_dato){
        case "cadena"  :          
           $v=utf8_decode($v); 
           $v=trim($v);
          if ($v==""){
           	$v="vacio";
           }
           else {
           	if($v==0)
			$validaCampo[0]=1; 	
	       else
	       	if ($v!="")
		     		$validaCampo[0]=1;    
		     	else	
			     	$v="vacios";
		     
           }
	   $validaCampo[2]=" '$v' ";
	  /*
	  if($v==0) 
		   $v=" &nbsp;0"; 
	   */
          break;
        case "numero":
           if (is_numeric ($v)) {
              $validaCampo[0]=1;    
              $validaCampo[2]=$v;     
           }
           else{
	            if ($v==0) {
	              $validaCampo[0]=1;    
	              $validaCampo[2]=$v;     
	           }
	            if($v=="SDPM" || $v=="N/A"){
	              	 $validaCampo[0]=1; 
	              	 $validaCampo[2]=" null ";
	            }
	            else {
	            	 	$validaCampo[0]=-1; 
	            		$validaCampo[2]=" null ";
	            	}
           }
           break;
       case "flotante"  :
           if (is_float ($v))  {
             $validaCampo[0]=1;         
             $validaCampo[2]=$v;     
           }
           break; 
        case "fecha":
           //suponiendo dia/mes/año
           
           if (!is_float($v)){ 
              $validaCampo[0]=-1; 
              $v=trim($v);
              if($v=="SDPM" || $v=="N/A"){
              	 $validaCampo[0]=1; 
              	 $validaCampo[2]=" null ";
              }
            }  
            else {
            	//$v=41850.5826388889;
            	$v_orig =$v;
            	$partes_num=explode(".",$v);
            	
             //$fecha_new=($v-25569)*24*60*60;
              $fecha_new=($partes_num[0]-25568)*24*60*60;
              $partes_num[1]=$v-$partes_num[0];
              $num_segundos=$partes_num[1]*24*60*60;
              $num_horas=$num_segundos/(60*60);
              $part_entera_num_hora=explode(".",$num_horas);
              
              $num_min= ($num_segundos%(60*60))/60;
              $num_min=round($num_min);
             //$v=date("d/m/Y", $fecha_new)  ;
            
            
             $v=date("d/m/Y H:i", $fecha_new)  ;
              //$v=$v." $num_horas : $num_min";
             $dia =substr($v,0,2); 
             $mes =substr($v,3,2);       
             $anio=substr($v,6,4);
             $fecha_creada= mktime( $part_entera_num_hora[0],$num_min,0,$mes,$dia,$anio);
              $v=date("d/m/Y H:i", $fecha_creada)  ;
             
             //echo " valor_de_dato ".$v."  ". date("d/m/Y", $fecha_new);//." ,  conversion ".mktime($v);
             if (checkdate ($mes,$dia,$anio)) {
                $validaCampo[0]=1;   
                 //antes$v1=date("Y/m/d h:i", $fecha_new)  ;
                 $v1=date("Y/m/d H:i", $fecha_creada)  ;
                 $validaCampo[2]="'$v1'";
                 //$v=$v."  fecha formato Y/m/d   $v1 ";      
                         
              }
            }
           break;      
           
        }
    }
    
    if($tipo_de_dato=="cadena" && ($img0!="" || $img1!="" || $img2!="") ){
         if($v=="0")
          	$validaCampo[1]="<div align=center> <img align=middle src='./imgs/$img0'></div>";
        else {
         	 if($v=="1")
          		$validaCampo[1]="<div align=center> <img align=middle src='./imgs/$img1'></div> ";
          	else {
          		 if ( $img2!="")        
	          		$validaCampo[1]="<div align=center> <img align=middle src='./imgs/$img2'></div>'";	        
	          	else{
	          		   if($v!="SDPM" && $v!="N/A")
	          		  	 $validaCampo[0]=-1;
	          		$validaCampo[1]=$v;
	          	}
          	}
          }
     }
    else
     	$validaCampo[1]=$v;  
     	//echo "valida campo 1 ".$validaCampo[1];
     	
    return $validaCampo;
}

function ObtenGrupoLayout($id_grupo){
	$ids_Layout[0][0]=0;
	$ids_Layout[0][1]="";
	$ids_Layout[0][2]="";
	
	global $db;
	$db=new clsDBcon_xls;	
    	
	$ssql = "Select * from layouts where id_grupo=$id_grupo order by id_layout "; 
	$db->query($ssql);
	$posicion=0;
	while ($db->next_record() ) { 			                        
		$id_layout =$db->f("id_layout");
		$tipo_arch=$db->f("tipo_arch");
		$nombre_tabla_destino=$db->f("nombre_tabla_destino");
		$leyenda=$db->f("leyenda");
		$ids_Layout[$posicion][0] = $id_layout ;  
		$ids_Layout[$posicion][1] = $tipo_arch;   
		$ids_Layout[$posicion][2] = $nombre_tabla_destino;  
		$ids_Layout[$posicion][3] = $leyenda;  
		
		$posicion++;
	} //while
        	
   
  return   $ids_Layout ;

}


function ObtenIntentosHechosPorPeriodo($id_proveedor,$id_periodo,$nom_tabla ,$tipo_niv_servicio) {
$num_intentos= 0;
 
 	global $db;
	$db=new clsDBcon_xls;
	//$id_proveedor =4;
	$ssql = "select MAX(num_carga) as num_tot_carga  from $nom_tabla  
			where estatus='F' and id_periodo=$id_periodo and  id_proveedor=$id_proveedor
			and tipo_nivel_servicio='$tipo_niv_servicio' "; 
	//echo $ssql;
	$db->query($ssql);
	while ($db->next_record() ) {  		         
	        $num_intentos=$db->f(0);	 
	        //echo "num_intentos en al cons while".  $num_intentos;
	        if(is_null($num_intentos)) $num_intentos=0;
	               	
    	} // if 
  	  //echo "num_intentos  al salir del while".  $num_intentos;
  	  	
  	if ($num_intentos<1 )
  		$num_intentos=0;
  		
  return   $num_intentos  ;	
	
}
      	
      	
function ValidaInfoCargada($id_proveedor,$id_registro )
{
 
    	$salida[0][0]=1;
    	$salida[0][1]= "";
    	
	global $db;
	$db=new clsDBcon_xls;
	$num_max_incidentes=0;
	$n_error=0;
	 
	$ssql = "Select count(*) as num_incidentes from l_calificacion_incidentes_AUT_SAT where id_proveedor=$id_proveedor and id_registro=$id_registro "; 
	//echo $ssql;
	$db->query($ssql);
	while ($db->next_record() ) {  		         
	        $num_incidentes=$db->f(0);	 	     
	        if(is_null($num_incidentes)) $num_incidentes=0;	               	
    	} // while  	
  	  	
  	$ssql = "Select count(*) as num_inc_ns from l_detalle_medicion_inc_SAT where id_proveedor=$id_proveedor and id_registro=$id_registro";
      	//echo $ssql;
    	$db->query($ssql);
    	while ($db->next_record() ) {  		         
	        $num_inc_ns=$db->f(0);	 	       
	        if(is_null($num_inc_ns)) $num_inc_ns=0;	               	
    	} // 
       
	
	if ($num_incidentes!=$num_inc_ns){
	    	$salida[$n_error][0]=-1;
	    	$salida[$n_error][1]= "El número de incidentes de las hojas Detalle Incidentes NS y Detalle de Medición - Inc no coincide ";
	    	$n_error++;
	    	if ($num_incidentes>$num_inc_ns)
	    		$num_max_incidentes=$num_incidentes;	
	    	else
	    		$num_max_incidentes=$num_inc_ns;	
	}
	else{
		$num_max_incidentes=$num_incidentes;	
	}
	
	//validacion de ids
	$ssql="Select count(a.id_incidencia) from l_calificacion_incidentes_AUT_SAT a, l_detalle_medicion_inc_SAT b
		 where a.id_proveedor=$id_proveedor and a.id_registro=$id_registro
	    		and a.id_incidencia=b.id_incidencia 
	    		and b.id_proveedor=$id_proveedor and b.id_registro=$id_registro ";

    	$db->query($ssql);
    	while ($db->next_record() ) {  		         
	        $num_incidentes_intersec=$db->f(0);	 		        
	        if(is_null($num_incidentes_intersec)) $num_incidentes_intersec=0;	               	
    	} 
    	if ($num_max_incidentes!= $num_incidentes_intersec){
    		$salida[$n_error][0]=-1;
	    	$salida[$n_error][1]= "Los ids de incidentes no coinciden entre la hoja de Incidentes y la de Detalle de Medición - Inc  ";
	    	$n_error++;
    	}    	
	
 	//validacion de formato   para Incidentes
	$ssql="Select count(*) from l_calificacion_incidentes_AUT_SAT where id_proveedor=$id_proveedor and id_registro=$id_registro
	    		and id_incidencia like 'INC%'";

    	$db->query($ssql);
    	while ($db->next_record() ) {  		         
	        $num_incidentes_val=$db->f(0);	 		        
	        if(is_null($num_incidentes_val)) $num_incidentes_val=0;	               	
    	} 
 
     if ($num_incidentes!=$num_incidentes_val){
     		$salida[$n_error][0]=-1;
	    	$salida[$n_error][1]= "Existen registros en la hoja de Incidentes que no cumplen con el formato del id INC#####9999999 ";
	    	$n_error++;
	}
 
 	//validacion de formato   para Detalle de Medición - Inc
	$ssql="Select count(*) from l_detalle_medicion_inc_SAT where id_proveedor=$id_proveedor and id_registro=$id_registro
	    		and id_incidencia like 'INC%'";

    	$db->query($ssql);
    	while ($db->next_record() ) {  		         
	        $num_inc_ns_val=$db->f(0);	 		        
	        if(is_null($num_inc_ns_val)) $num_inc_ns_val=0;	               	
    	} 
 
     if ($num_inc_ns!=$num_inc_ns_val){
     		$salida[$n_error][0]=-1;
	    	$salida[$n_error][1]= "Existen registros en la hoja de Detalle de Medición - Inc que no cumplen con el formato del id INC#####9999999 ";
	    	$n_error++;
	}    
	
	////////////////////////////////////////////
	//validacion de id_ppm   l_calificacion_rs_AUT
	$ssql="Select distinct id_ppmc from  l_detalle_medicion_apertura_SAT  where id_proveedor=$id_proveedor and id_registro=$id_registro ";

    	$db->query($ssql);
    	if ($db->next_record() ) {  		         
	        $num_rs_apertura=$db->num_rows('id_ppmc');	                      	
    	}
    	else 
  		$num_rs_apertura=0;	
  	
	$ssql="Select distinct id_ppmc from  l_detalle_medicion_cierre_SAT  where id_proveedor=$id_proveedor and id_registro=$id_registro ";

    	$db->query($ssql);
    	if ($db->next_record() ) {  		         
	        $num_rs_cierre=$db->num_rows('id_ppmc');	    		               	               	
    	}
    	else
    		$num_rs_cierre=0;
    		
	$ssql="Select distinct (c.id_ppmc) from  l_detalle_medicion_cierre_SAT c, l_calificacion_rs_AUT_SAT t
	  where c.id_proveedor=$id_proveedor and c.id_registro=$id_registro
	  		and c.id_ppmc =cast(t.id_ppmc as varchar)
	  		and t.id_proveedor=$id_proveedor and t.id_registro=$id_registro ";

    	$db->query($ssql);
    	if ($db->next_record() ) {  		         
	        $num_rs_cierre_intersec=$db->num_rows('id_ppmc');	       	               	
    	} 
    	else
    		$num_rs_cierre_intersec=0;
	
	if ($num_rs_cierre_intersec!=$num_rs_cierre){
		$salida[$n_error][0]=-1;
	    	$salida[$n_error][1]= "Existen registros de requerimientos de cierre que no coinciden con la hoja de Detalle RSs ";
	    	$n_error++;
	}
	$ssql="Select distinct (a.id_ppmc) from  l_detalle_medicion_apertura_SAT a, l_calificacion_rs_AUT_SAT t
	  where a.id_proveedor=$id_proveedor and a.id_registro=$id_registro
	  		and a.id_ppmc =cast(t.id_ppmc as varchar)
	  		and t.id_proveedor=$id_proveedor and t.id_registro=$id_registro ";


    	$db->query($ssql);
    	if ($db->next_record() ) {  		         
	        $num_rs_apertura_intersec=$db->num_rows('id_ppmc'); 	        	               	
    	} 
    	else
    		$num_rs_apertura_intersec=0;
    		
	// $num_rs_apertura=$num_rs_apertura_intersec; //quitar
	if ($num_rs_apertura_intersec!=$num_rs_apertura){
		$salida[$n_error][0]=-1; //num_rs_apertura_intersec $num_rs_apertura_intersec ,  num_rs_apertura $num_rs_apertura , $ssql , 
	    	$salida[$n_error][1]= "Existen registros de requerimientos de apertura que no coinciden con la hoja de Detalle RSs ";
	    	$n_error++;
	}
	
	
	$ssql="Select id_incidencia, count(id_incidencia)as total from l_calificacion_incidentes_AUT_SAT 
		where id_proveedor= $id_proveedor  and id_registro=$id_registro
 		group by id_incidencia order by total desc		 ";

    	$db->query($ssql);
    	if ($db->next_record() ) {  		         
	        $num_repetidos=$db->f('total'); 
	        $id_incid_repetida =$db->f('id_incidencia');     	               	
    	} 
    	else
    		$num_repetidos=0;
    		
    	if ( $num_repetidos>1){
    		$salida[$n_error][0]=-1;
	    	$salida[$n_error][1]= "Existen números de Incidencia  que están duplicados en la hoja de Detalle Incidentes NS ";
	    	$n_error++;	
    	}
    	
      $ssql="Select id_incidencia, count(id_incidencia)as total from l_detalle_medicion_inc_SAT 
		where id_proveedor= $id_proveedor  and id_registro=$id_registro
 		group by id_incidencia order by total desc		 ";

    	$db->query($ssql);
    	if ($db->next_record() ) {  		         
	        $num_repetidos=$db->f('total');  //$db->();	    
	        $id_incid_repetida =$db->f('id_incidencia');        	               	
    	} 
    	else
    		$num_repetidos=0;
    		
    	if ( $num_repetidos>1){
    		$salida[$n_error][0]=-1;
	    	$salida[$n_error][1]= "Existen números de Incidencia  que están duplicados en la hoja de Detalle de Medición - Inc ";
	    	$n_error++;	
    	}
    	
	
	return $salida;
	
	
}  	  

function enviaCorreoCargaArchivo($para, $titulo, $mensaje_resum,$num_intento,$periodo)
{

// mensaje
$mensaje = "
<html>
<head>
  <title>Estatus de carga de archivo de excel para Niveles de Servicio</title>
</head>
<body>
  <p>Para el  periodo $periodo se realizó la carga del archivo con éxito en su número de intento : $num_intento</p>
  <table>
    <tr>
      <th>$mensaje_resum</th> 
    </tr>  
    
  </table>
</body>
</html>
";

/*
 <tr> 
      <th>Detalle RSs</th><th>344</th>
    </tr>
    <tr>
      <th>Detalle de Medición - Apertura</th>
     </tr>
        <tr>
      <th>Detalle de Medición - Cierre</th><th>122</th>
    </tr>
    <tr> 
      <th>Detalle de Medición - Inc</th><th>344</th>
    </tr>
    <tr>
      <th>Detalle Eficiencia Presupuestal</th>
     </tr>
*/
// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= "To: $para" . "\r\n";
$cabeceras .= 'From: carreyest@hotmail.com' . "\r\n";


// Enviarlo
mail($para, $titulo, $mensaje, $cabeceras);	
	
	
}


function ComparaFechasYMD($fecha1) { 
	//formato requjerido YMD
 	$fecha1Menor=2;  //fecha1 mayor
	$fecha2=date("Y/m/d H:i");
  
	$anio1=substr($fecha1,0,4);
	$mes1=substr($fecha1,5,2);
	$dia1=substr($fecha1,8,2);
  	$hora1=substr($fecha1,11,2);
  	$min1=substr($fecha1,14,2);
                                        
	$anio2=substr($fecha2,0,4);
	$mes2=substr($fecha2,5,2);
	$dia2=substr($fecha2,8,2);
 	$hora2=substr($fecha2,11,2);
 	$min2=substr($fecha2,14,2);
	//echo "<br> horas $hora1 , $hora2 , minutos $min1, $min2"; 
	if ( $anio1 < $anio2) {
		$fecha1Menor= 1 ;
	}
	else {
		if ( $anio1 ==$anio2) {		
			if ( $mes1 < $mes2) {
				$fecha1Menor= 1 ; 	
			}
			else {
				if ( $mes1 == $mes2) {
					if ( $dia1 < $dia2) {
						$fecha1Menor= 1;	
					}
					else {
						if ( $dia1 == $dia2)  {
                  if ( $hora1 < $hora2) {
					         	$fecha1Menor= 1;	
					         }
                   else
                   {
                       if ( $hora1 ==$hora2) {  
                             if ( $min1 < $min2) {
					         	             $fecha1Menor= 1;	
					                   } 
                              else
                                {
                                    if ( $min1 == $min2) 
					         $fecha1Menor= 0;
                                }
                        }
                    }
                }
           }
							
				}			
			}
		}
	}

	return $fecha1Menor; 
}

?>
