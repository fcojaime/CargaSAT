<?php
//BindEvents Method @1-17B9AB1D
function BindEvents()
{
    global $periodos_carga1;
    $periodos_carga1->Button_Insert->CCSEvents["OnClick"] = "periodos_carga1_Button_Insert_OnClick";
    $periodos_carga1->Button_Update->CCSEvents["OnClick"] = "periodos_carga1_Button_Update_OnClick";
    $periodos_carga1->fecha_limite->CCSEvents["BeforeShow"] = "periodos_carga1_fecha_limite_BeforeShow";
    $periodos_carga1->CCSEvents["OnValidate"] = "periodos_carga1_OnValidate";
}
//End BindEvents Method

//periodos_carga1_Button_Insert_OnClick @38-41A1EEFC
function periodos_carga1_Button_Insert_OnClick(& $sender)
{
    $periodos_carga1_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $periodos_carga1; //Compatibility
//End periodos_carga1_Button_Insert_OnClick

//Custom Code @55-2A29BDB7
// -------------------------
    // Write your own code here.
    $num_mes=0;
    $nom_mes=$periodos_carga1->nombre_mes->GetValue();
    $num_mes=ObtenNumMes($nom_mes);
    $periodos_carga1->mes->SetValue($num_mes);
    
// -------------------------
//End Custom Code

//Close periodos_carga1_Button_Insert_OnClick @38-8C2652F1
    return $periodos_carga1_Button_Insert_OnClick;
}
//End Close periodos_carga1_Button_Insert_OnClick

//periodos_carga1_Button_Update_OnClick @39-6D40F928
function periodos_carga1_Button_Update_OnClick(& $sender)
{
    $periodos_carga1_Button_Update_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $periodos_carga1; //Compatibility
//End periodos_carga1_Button_Update_OnClick

//Custom Code @56-2A29BDB7
// -------------------------
    // Write your own code here.
    $num_mes=0;
    $nom_mes=$periodos_carga1->nombre_mes->GetValue();
    $num_mes=ObtenNumMes($nom_mes);
   
    $periodos_carga1->mes->SetValue($num_mes);
    
  
// -------------------------
//End Custom Code

//Close periodos_carga1_Button_Update_OnClick @39-27B17A4C
    return $periodos_carga1_Button_Update_OnClick;
}
//End Close periodos_carga1_Button_Update_OnClick

//periodos_carga1_fecha_limite_BeforeShow @45-1CC89539
function periodos_carga1_fecha_limite_BeforeShow(& $sender)
{
    $periodos_carga1_fecha_limite_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $periodos_carga1; //Compatibility
//End periodos_carga1_fecha_limite_BeforeShow

//Close periodos_carga1_fecha_limite_BeforeShow @45-9D0563F8
    return $periodos_carga1_fecha_limite_BeforeShow;
}
//End Close periodos_carga1_fecha_limite_BeforeShow

//periodos_carga1_OnValidate @36-906F4606
function periodos_carga1_OnValidate(& $sender)
{
    $periodos_carga1_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $periodos_carga1; //Compatibility
//End periodos_carga1_OnValidate

//Custom Code @57-2A29BDB7
// -------------------------
    // Write your own code here.
   $tipo_periodo=$periodos_carga1->tipo_periodo->GetValue();
   $num_intentos_permitidos=$periodos_carga1->num_intentos_permitidos->GetValue();
	if( $tipo_periodo=="Normal")
	{
		if ($num_intentos_permitidos>3) {
			$periodos_carga1_OnValidate = false;
		  	$periodos_carga1->Errors->addError("El número de intentos debe ser menor o igual a 3");
		}
	}
	else {
		if ($num_intentos_permitidos>1) {
			$periodos_carga1_OnValidate = false;
		  	$periodos_carga1->Errors->addError("En un periodo de tipo 'Extraordinario' el número de intentos no debe ser mayor a 1");
		}
	}
	
	$fecha_limite=$periodos_carga1->fecha_limite->GetValue();
	$dim_arreglo=count($fecha_limite);
	
	$mes=ObtenNumMes($periodos_carga1->nombre_mes->GetValue());
	if ($dim_arreglo>2){
		if ($fecha_limite[2]<$mes) {
			$periodos_carga1->Errors->addError("La fecha límite de carga debe ser posterior o igual al mes ");
			$periodos_carga1_OnValidate = false;
		}		
	}
	else
	{	
		$periodos_carga1->Errors->addError("La fecha límite de carga no es válida ");
		$periodos_carga1_OnValidate = false;
	}
	
// -------------------------
//End Custom Code

//Close periodos_carga1_OnValidate @36-C87D4026
    return $periodos_carga1_OnValidate;
}
//End Close periodos_carga1_OnValidate

function ObtenNumMes($nom_mes){
	
	$num_mes=0;
   
    switch ($nom_mes){
    	case "Enero":
    		$num_mes=1;
    	break;
    	case "Febrero":
    		$num_mes=2;
    	break;
    	case "Marzo":
    		$num_mes=3;
    	break;
    	case "Abril":
    		$num_mes=4;
    	break;
    	case "Mayo":
    		$num_mes=5;
    	break;
    	case "Junio":
    		$num_mes=6;
    	break;
    	case "Julio":
    		$num_mes=7;
    	break;
    	case "Agosto":
    		$num_mes=8;
    	break;
    	case "Septiembre":
    		$num_mes=9;
    	break;
    	case "Octubre":
    		$num_mes=10;
    	break;
    	case "Noviembre":
    		$num_mes=11;
    	break;
    	case "Diciembre":
    		$num_mes=12;
    	break;
    }
    return $num_mes;
	
	}
?>
