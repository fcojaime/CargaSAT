<?php
//BindEvents Method @1-DC3E53E5
function BindEvents()
{
    global $lb_resumen;
    global $l_detalle_medicion_apertu;
    global $l_detalle_medicion_cierre;
    global $l_detalle_medicion_inc;
    global $l_detalle_eficiencia_pres;
    global $l_calificacion_rs_AUT;
    global $l_calificacion_incidentes1;
    global $l_calificacion_incidentes;
    global $resumen;
    global $Grid1;
    global $CCSEvents;
    $lb_resumen->CCSEvents["BeforeShow"] = "lb_resumen_BeforeShow";
    $l_detalle_medicion_apertu->l_detalle_medicion_apertu_TotalRecords->CCSEvents["BeforeShow"] = "l_detalle_medicion_apertu_l_detalle_medicion_apertu_TotalRecords_BeforeShow";
    $l_detalle_medicion_apertu->CCSEvents["BeforeShowRow"] = "l_detalle_medicion_apertu_BeforeShowRow";
    $l_detalle_medicion_cierre->l_detalle_medicion_cierre_TotalRecords->CCSEvents["BeforeShow"] = "l_detalle_medicion_cierre_l_detalle_medicion_cierre_TotalRecords_BeforeShow";
    $l_detalle_medicion_cierre->CCSEvents["BeforeShowRow"] = "l_detalle_medicion_cierre_BeforeShowRow";
    $l_detalle_medicion_cierre->ds->CCSEvents["AfterExecuteSelect"] = "l_detalle_medicion_cierre_ds_AfterExecuteSelect";
    $l_detalle_medicion_inc->l_detalle_medicion_inc_TotalRecords->CCSEvents["BeforeShow"] = "l_detalle_medicion_inc_l_detalle_medicion_inc_TotalRecords_BeforeShow";
    $l_detalle_medicion_inc->CCSEvents["BeforeShowRow"] = "l_detalle_medicion_inc_BeforeShowRow";
    $l_detalle_eficiencia_pres->l_detalle_eficiencia_pres_TotalRecords->CCSEvents["BeforeShow"] = "l_detalle_eficiencia_pres_l_detalle_eficiencia_pres_TotalRecords_BeforeShow";
    $l_detalle_eficiencia_pres->CCSEvents["BeforeShowRow"] = "l_detalle_eficiencia_pres_BeforeShowRow";
    $l_calificacion_rs_AUT->l_calificacion_rs_AUT_TotalRecords->CCSEvents["BeforeShow"] = "l_calificacion_rs_AUT_l_calificacion_rs_AUT_TotalRecords_BeforeShow";
    $l_calificacion_rs_AUT->CCSEvents["BeforeShowRow"] = "l_calificacion_rs_AUT_BeforeShowRow";
    $l_calificacion_incidentes1->s_id_periodo->ds->CCSEvents["BeforeExecuteSelect"] = "l_calificacion_incidentes1_s_id_periodo_ds_BeforeExecuteSelect";
    $l_calificacion_incidentes->l_calificacion_incidentes_TotalRecords->CCSEvents["BeforeShow"] = "l_calificacion_incidentes_l_calificacion_incidentes_TotalRecords_BeforeShow";
    $l_calificacion_incidentes->CCSEvents["BeforeShowRow"] = "l_calificacion_incidentes_BeforeShowRow";
    $resumen->resumen_TotalRecords->CCSEvents["BeforeShow"] = "resumen_resumen_TotalRecords_BeforeShow";
    $Grid1->CCSEvents["BeforeShowRow"] = "Grid1_BeforeShowRow";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//lb_resumen_BeforeShow @98-A1112916
function lb_resumen_BeforeShow(& $sender)
{
    $lb_resumen_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lb_resumen; //Compatibility
//End lb_resumen_BeforeShow

//Custom Code @291-2A29BDB7
// -------------------------
    // Write your own code here.
      $lb_resumen->SetValue( CCGetSession("resumen_carga"));
// -------------------------
//End Custom Code

//Close lb_resumen_BeforeShow @98-86AA5ABF
    return $lb_resumen_BeforeShow;
}
//End Close lb_resumen_BeforeShow

//l_detalle_medicion_apertu_l_detalle_medicion_apertu_TotalRecords_BeforeShow @101-7613DFC1
function l_detalle_medicion_apertu_l_detalle_medicion_apertu_TotalRecords_BeforeShow(& $sender)
{
    $l_detalle_medicion_apertu_l_detalle_medicion_apertu_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_detalle_medicion_apertu; //Compatibility
//End l_detalle_medicion_apertu_l_detalle_medicion_apertu_TotalRecords_BeforeShow

//Retrieve number of records @102-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close l_detalle_medicion_apertu_l_detalle_medicion_apertu_TotalRecords_BeforeShow @101-375F0B7A
    return $l_detalle_medicion_apertu_l_detalle_medicion_apertu_TotalRecords_BeforeShow;
}
//End Close l_detalle_medicion_apertu_l_detalle_medicion_apertu_TotalRecords_BeforeShow

//l_detalle_medicion_apertu_BeforeShowRow @99-1673C833
function l_detalle_medicion_apertu_BeforeShowRow(& $sender)
{
    $l_detalle_medicion_apertu_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_detalle_medicion_apertu; //Compatibility
//End l_detalle_medicion_apertu_BeforeShowRow

//Custom Code @408-2A29BDB7
// -------------------------
    // Write your own code here.
    
 $l_detalle_medicion_apertu->lb_apert_herr_est_cost->Visible  =false;
  $valor=  $l_detalle_medicion_apertu->herr_est_cost->GetValue();
switch($valor){
		case "1":
			$l_detalle_medicion_apertu->herr_est_cost->SetValue("images/Cumple.png");  
			$l_detalle_medicion_apertu->herr_est_cost->Visible  =true;
			break;
		case "0":
			$l_detalle_medicion_apertu->herr_est_cost->SetValue("images/NoCumple.png");  
			$l_detalle_medicion_apertu->herr_est_cost->Visible  =true;
			break;
		default:
			$l_detalle_medicion_apertu->herr_est_cost->Visible  =false;
			$l_detalle_medicion_apertu->lb_apert_herr_est_cost->Visible  =true;
			$l_detalle_medicion_apertu->lb_apert_herr_est_cost->SetValue($valor);  
			
			
}

$l_detalle_medicion_apertu->lb_apert_req_serv->Visible  =false;
$valor=$l_detalle_medicion_apertu->req_serv->GetValue();
switch($valor){
		case "1":
			$l_detalle_medicion_apertu->req_serv->SetValue("images/Cumple.png");  
			$l_detalle_medicion_apertu->req_serv->Visible  =true;
			break;
		case "0":
			$l_detalle_medicion_apertu->req_serv->SetValue("images/NoCumple.png");  
			$l_detalle_medicion_apertu->req_serv->Visible  =true;
			break;
		default:
			$l_detalle_medicion_apertu->req_serv->Visible  =false;
			$l_detalle_medicion_apertu->lb_apert_req_serv->Visible  =true;
			$l_detalle_medicion_apertu->lb_apert_req_serv->SetValue($valor);  
			
	}
// -------------------------
//End Custom Code

//Close l_detalle_medicion_apertu_BeforeShowRow @99-3284981A
    return $l_detalle_medicion_apertu_BeforeShowRow;
}
//End Close l_detalle_medicion_apertu_BeforeShowRow

//l_detalle_medicion_cierre_l_detalle_medicion_cierre_TotalRecords_BeforeShow @162-69395F48
function l_detalle_medicion_cierre_l_detalle_medicion_cierre_TotalRecords_BeforeShow(& $sender)
{
    $l_detalle_medicion_cierre_l_detalle_medicion_cierre_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_detalle_medicion_cierre; //Compatibility
//End l_detalle_medicion_cierre_l_detalle_medicion_cierre_TotalRecords_BeforeShow

//Retrieve number of records @163-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close l_detalle_medicion_cierre_l_detalle_medicion_cierre_TotalRecords_BeforeShow @162-5FC816FE
    return $l_detalle_medicion_cierre_l_detalle_medicion_cierre_TotalRecords_BeforeShow;
}
//End Close l_detalle_medicion_cierre_l_detalle_medicion_cierre_TotalRecords_BeforeShow

//l_detalle_medicion_cierre_BeforeShowRow @160-D507AEF2
function l_detalle_medicion_cierre_BeforeShowRow(& $sender)
{
    $l_detalle_medicion_cierre_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_detalle_medicion_cierre; //Compatibility
//End l_detalle_medicion_cierre_BeforeShowRow

//Custom Code @412-2A29BDB7
// -------------------------
    // Write your own code here.
    
$valor=$l_detalle_medicion_cierre->cump_req_func->GetValue();
$l_detalle_medicion_cierre->lb_cierre_cump_req_func->Visible  =false;
$l_detalle_medicion_cierre->cump_req_func->Visible  =false;
switch($valor){
		case "1":
			$l_detalle_medicion_cierre->cump_req_func->SetValue("images/Cumple.png");  
			$l_detalle_medicion_cierre->cump_req_func->Visible  =true;
			break;
		case "0":
			$l_detalle_medicion_cierre->cump_req_func->SetValue("images/NoCumple.png");  
			$l_detalle_medicion_cierre->cump_req_func->Visible  =true;
			break;
		default:
			$l_detalle_medicion_cierre->cump_req_func->Visible  =false;
			$l_detalle_medicion_cierre->lb_cierre_cump_req_func->Visible  =true;
			$l_detalle_medicion_cierre->lb_cierre_cump_req_func->SetValue($valor);	
	}
 
 $valor=$l_detalle_medicion_cierre->retraso_entregables->GetValue();
$l_detalle_medicion_cierre->lb_cierre_retraso_entregables->Visible  =false;
switch($valor){
		case "1":
			$l_detalle_medicion_cierre->retraso_entregables->SetValue("images/Cumple.png");  
			$l_detalle_medicion_cierre->retraso_entregables->Visible  =true;
			break;
		case "0":
			$l_detalle_medicion_cierre->retraso_entregables->SetValue("images/NoCumple.png");  
			$l_detalle_medicion_cierre->retraso_entregables->Visible  =true;
			break;
		default:
			$l_detalle_medicion_cierre->retraso_entregables->Visible  =false;
			$l_detalle_medicion_cierre->lb_cierre_retraso_entregables->Visible  =true;
			$l_detalle_medicion_cierre->lb_cierre_retraso_entregables->SetValue($valor);	
}

$valor=$l_detalle_medicion_cierre->calidad_prod_term->GetValue();
$l_detalle_medicion_cierre->lb_cierre_calidad_prod_term->Visible  =false;
 switch($valor ){
		case "1":
			$l_detalle_medicion_cierre->calidad_prod_term->SetValue("images/Cumple.png");  
			$l_detalle_medicion_cierre->calidad_prod_term->Visible  =true;
			break;
		case "0":
			$l_detalle_medicion_cierre->calidad_prod_term->SetValue("images/NoCumple.png");  
			$l_detalle_medicion_cierre->calidad_prod_term->Visible  =true;
			break;
		default:
			$l_detalle_medicion_cierre->calidad_prod_term->Visible  =false;
			$l_detalle_medicion_cierre->lb_cierre_calidad_prod_term->Visible  =true;
			$l_detalle_medicion_cierre->lb_cierre_calidad_prod_term->SetValue($valor);	

 }
 
 $l_detalle_medicion_cierre->lb_cierre_calidad_codigo->Visible  =false;
 $valor=$l_detalle_medicion_cierre->calidad_codigo->GetValue();
 switch($valor){
		case "1":
			$l_detalle_medicion_cierre->calidad_codigo->SetValue("images/Cumple.png");  
			$l_detalle_medicion_cierre->calidad_codigo->Visible  =true;
			break;
		case "0":
			$l_detalle_medicion_cierre->calidad_codigo->SetValue("images/NoCumple.png");  
			$l_detalle_medicion_cierre->calidad_codigo->Visible  =true;
			break;
		default:
			$l_detalle_medicion_cierre->calidad_codigo->Visible  =false;
			$l_detalle_medicion_cierre->lb_cierre_calidad_codigo->Visible  =true;
			$l_detalle_medicion_cierre->lb_cierre_calidad_codigo->SetValue($valor);	

 }
 


 $l_detalle_medicion_cierre->lb_cierre_defectos_fugados_amb_prod->Visible  =false;
 $valor=$l_detalle_medicion_cierre->defectos_fugados_amb_prod->GetValue();
 switch($valor){
		case "1":
			$l_detalle_medicion_cierre->defectos_fugados_amb_prod->SetValue("images/Cumple.png");  
			$l_detalle_medicion_cierre->defectos_fugados_amb_prod->Visible  =true;
			break;
		case "0":
			$l_detalle_medicion_cierre->defectos_fugados_amb_prod->SetValue("images/NoCumple.png");  
			$l_detalle_medicion_cierre->defectos_fugados_amb_prod->Visible  =true;
			break;
		default:
			$l_detalle_medicion_cierre->defectos_fugados_amb_prod->Visible  =false;
			$l_detalle_medicion_cierre->lb_cierre_defectos_fugados_amb_prod->Visible  =true;
			$l_detalle_medicion_cierre->lb_cierre_defectos_fugados_amb_prod->SetValue($valor);	
 }
 
    
// -------------------------
//End Custom Code

//Close l_detalle_medicion_cierre_BeforeShowRow @160-F435EC66
    return $l_detalle_medicion_cierre_BeforeShowRow;
}
//End Close l_detalle_medicion_cierre_BeforeShowRow

//l_detalle_medicion_cierre_ds_AfterExecuteSelect @160-E6203AD3
function l_detalle_medicion_cierre_ds_AfterExecuteSelect(& $sender)
{
    $l_detalle_medicion_cierre_ds_AfterExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_detalle_medicion_cierre; //Compatibility
//End l_detalle_medicion_cierre_ds_AfterExecuteSelect

//Custom Code @522-2A29BDB7
// -------------------------
    // Write your own code here.
    //echo " med cierre ".$l_detalle_medicion_cierre->DataSource->CountSQL;
// -------------------------
//End Custom Code

//Close l_detalle_medicion_cierre_ds_AfterExecuteSelect @160-1A30D8A4
    return $l_detalle_medicion_cierre_ds_AfterExecuteSelect;
}
//End Close l_detalle_medicion_cierre_ds_AfterExecuteSelect

//l_detalle_medicion_inc_l_detalle_medicion_inc_TotalRecords_BeforeShow @223-C39699AC
function l_detalle_medicion_inc_l_detalle_medicion_inc_TotalRecords_BeforeShow(& $sender)
{
    $l_detalle_medicion_inc_l_detalle_medicion_inc_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_detalle_medicion_inc; //Compatibility
//End l_detalle_medicion_inc_l_detalle_medicion_inc_TotalRecords_BeforeShow

//Retrieve number of records @224-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close l_detalle_medicion_inc_l_detalle_medicion_inc_TotalRecords_BeforeShow @223-3C4BD6FF
    return $l_detalle_medicion_inc_l_detalle_medicion_inc_TotalRecords_BeforeShow;
}
//End Close l_detalle_medicion_inc_l_detalle_medicion_inc_TotalRecords_BeforeShow

//l_detalle_medicion_inc_BeforeShowRow @221-51F8CA4E
function l_detalle_medicion_inc_BeforeShowRow(& $sender)
{
    $l_detalle_medicion_inc_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_detalle_medicion_inc; //Compatibility
//End l_detalle_medicion_inc_BeforeShowRow

//Custom Code @413-2A29BDB7
// -------------------------
    // Write your own code here.
    
$l_detalle_medicion_inc->lb_inci_manejo_incid_tiempo_atencion->Visible  =true;
$valor=$l_detalle_medicion_inc->manejo_incid_tiempo_atencion->GetValue();
switch($valor){
		case "1":
			$l_detalle_medicion_inc->manejo_incid_tiempo_atencion->SetValue("images/Cumple.png");  
			$l_detalle_medicion_inc->manejo_incid_tiempo_atencion->Visible  =true;
			break;
		case "0":
			$l_detalle_medicion_inc->manejo_incid_tiempo_atencion->SetValue("images/NoCumple.png");  
			$l_detalle_medicion_inc->manejo_incid_tiempo_atencion->Visible  =true;
			break;
		default:
			$l_detalle_medicion_inc->manejo_incid_tiempo_atencion->Visible  =false;
			$l_detalle_medicion_inc->lb_inci_manejo_incid_tiempo_atencion->Visible  =true;
			$l_detalle_medicion_inc->lb_inci_manejo_incid_tiempo_atencion->SetValue($valor) ;
}


$l_detalle_medicion_inc->lb_inci_manejo_incid_tiempo_solu->Visible  =false;
$valor=$l_detalle_medicion_inc->manejo_incid_tiempo_solu->GetValue();
switch($valor){
		case "1":
			$l_detalle_medicion_inc->manejo_incid_tiempo_solu->SetValue("images/Cumple.png");  
			$l_detalle_medicion_inc->manejo_incid_tiempo_solu->Visible  =true;
			break;
		case "0":
			$l_detalle_medicion_inc->manejo_incid_tiempo_solu->SetValue("images/NoCumple.png");  
			$l_detalle_medicion_inc->manejo_incid_tiempo_solu->Visible  =true;
			break;
		default:
			$l_detalle_medicion_inc->manejo_incid_tiempo_solu->Visible  =false;
			$l_detalle_medicion_inc->lb_inci_manejo_incid_tiempo_solu->Visible  =true;
			$l_detalle_medicion_inc->lb_inci_manejo_incid_tiempo_solu->SetValue($valor) ;
			
	}

// -------------------------
//End Custom Code

//Close l_detalle_medicion_inc_BeforeShowRow @221-A966E2C0
    return $l_detalle_medicion_inc_BeforeShowRow;
}
//End Close l_detalle_medicion_inc_BeforeShowRow

//l_detalle_eficiencia_pres_l_detalle_eficiencia_pres_TotalRecords_BeforeShow @266-E72B57EF
function l_detalle_eficiencia_pres_l_detalle_eficiencia_pres_TotalRecords_BeforeShow(& $sender)
{
    $l_detalle_eficiencia_pres_l_detalle_eficiencia_pres_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_detalle_eficiencia_pres; //Compatibility
//End l_detalle_eficiencia_pres_l_detalle_eficiencia_pres_TotalRecords_BeforeShow

//Retrieve number of records @267-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close l_detalle_eficiencia_pres_l_detalle_eficiencia_pres_TotalRecords_BeforeShow @266-8D750AEE
    return $l_detalle_eficiencia_pres_l_detalle_eficiencia_pres_TotalRecords_BeforeShow;
}
//End Close l_detalle_eficiencia_pres_l_detalle_eficiencia_pres_TotalRecords_BeforeShow

//l_detalle_eficiencia_pres_BeforeShowRow @264-D71DF42F
function l_detalle_eficiencia_pres_BeforeShowRow(& $sender)
{
    $l_detalle_eficiencia_pres_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_detalle_eficiencia_pres; //Compatibility
//End l_detalle_eficiencia_pres_BeforeShowRow

//Custom Code @414-2A29BDB7
// -------------------------
    // Write your own code here.
    
$l_detalle_eficiencia_pres->lb_efic_presupuestal1->Visible  =false;
$valor=$l_detalle_eficiencia_pres->efic_presupuestal->GetValue();
switch($valor){
		case "1":
			$l_detalle_eficiencia_pres->efic_presupuestal->SetValue("images/Cumple.png");  
			$l_detalle_eficiencia_pres->efic_presupuestal->Visible  =true;
			break;
		case "0":
			$l_detalle_eficiencia_pres->efic_presupuestal->SetValue("images/NoCumple.png");  
			$l_detalle_eficiencia_pres->efic_presupuestal->Visible  =true;
			break;
		default:
			$l_detalle_eficiencia_pres->efic_presupuestal->Visible  =false;
		       $l_detalle_eficiencia_pres->lb_efic_presupuestal1->Visible  =true;
			$l_detalle_eficiencia_pres->lb_efic_presupuestal1->SetValue($valor) ; 
			
	}
// -------------------------
//End Custom Code

//Close l_detalle_eficiencia_pres_BeforeShowRow @264-F2E0EF3E
    return $l_detalle_eficiencia_pres_BeforeShowRow;
}
//End Close l_detalle_eficiencia_pres_BeforeShowRow

//l_calificacion_rs_AUT_l_calificacion_rs_AUT_TotalRecords_BeforeShow @312-729F3CE8
function l_calificacion_rs_AUT_l_calificacion_rs_AUT_TotalRecords_BeforeShow(& $sender)
{
    $l_calificacion_rs_AUT_l_calificacion_rs_AUT_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_calificacion_rs_AUT; //Compatibility
//End l_calificacion_rs_AUT_l_calificacion_rs_AUT_TotalRecords_BeforeShow

//Retrieve number of records @313-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close l_calificacion_rs_AUT_l_calificacion_rs_AUT_TotalRecords_BeforeShow @312-E8D65583
    return $l_calificacion_rs_AUT_l_calificacion_rs_AUT_TotalRecords_BeforeShow;
}
//End Close l_calificacion_rs_AUT_l_calificacion_rs_AUT_TotalRecords_BeforeShow

//l_calificacion_rs_AUT_BeforeShowRow @308-7A198E32
function l_calificacion_rs_AUT_BeforeShowRow(& $sender)
{
    $l_calificacion_rs_AUT_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_calificacion_rs_AUT; //Compatibility
//End l_calificacion_rs_AUT_BeforeShowRow

//Custom Code @433-2A29BDB7
// -------------------------
    // Write your own code here.
 
 $l_calificacion_rs_AUT->lb11_herr_est_cost->Visible=false;
 $valor=$l_calificacion_rs_AUT->herr_est_cost->GetValue();
 
switch($valor){
		case "1":
			$l_calificacion_rs_AUT->herr_est_cost->SetValue("images/Cumple.png");  
			$l_calificacion_rs_AUT->herr_est_cost->Visible  =true;
			break;
		case "0":
			$l_calificacion_rs_AUT->herr_est_cost->SetValue("images/NoCumple.png");  
			$l_calificacion_rs_AUT->herr_est_cost->Visible  =true;
			break;
		default:
			$l_calificacion_rs_AUT->herr_est_cost->Visible=false;
			$l_calificacion_rs_AUT->lb11_herr_est_cost->Visible=true;
			$l_calificacion_rs_AUT->lb11_herr_est_cost->SetValue($valor);	


}

 $l_calificacion_rs_AUT->lb11_req_serv->Visible  =false;
 $valor=$l_calificacion_rs_AUT->req_serv->GetValue();
switch( $valor){
		case "1":
			$l_calificacion_rs_AUT->req_serv->SetValue("images/Cumple.png");  
			$l_calificacion_rs_AUT->req_serv->Visible  =true;
			break;
		case "0":
			$l_calificacion_rs_AUT->req_serv->SetValue("images/NoCumple.png");  
			$l_calificacion_rs_AUT->req_serv->Visible  =true;
			break;
		default:
			$l_calificacion_rs_AUT->req_serv->Visible  =false;
			$l_calificacion_rs_AUT->lb11_req_serv->Visible  =true;
			$l_calificacion_rs_AUT->lb11_req_serv->SetValue($valor);	

}

 $l_calificacion_rs_AUT->lb11_cumpl_req_func->Visible  =false;
 $valor=$l_calificacion_rs_AUT->cumpl_req_func->GetValue();
switch($valor){
		case "1":
			$l_calificacion_rs_AUT->cumpl_req_func->SetValue("images/Cumple.png");  
			$l_calificacion_rs_AUT->cumpl_req_func->Visible  =true;
			break;
		case "0":
			$l_calificacion_rs_AUT->cumpl_req_func->SetValue("images/NoCumple.png");  
			$l_calificacion_rs_AUT->cumpl_req_func->Visible  =true;
			break;
		default:
			$l_calificacion_rs_AUT->cumpl_req_func->Visible  =false;
			$l_calificacion_rs_AUT->lb11_cumpl_req_func->Visible  =true;
			$l_calificacion_rs_AUT->lb11_cumpl_req_func->SetValue($valor);
}

 $l_calificacion_rs_AUT->lb11_retr_entregable->Visible  =false;
 $l_calificacion_rs_AUT->retr_entregable->Visible  =false;
 $valor=$l_calificacion_rs_AUT->retr_entregable->GetValue();
switch( $valor){
		case "1":
			$l_calificacion_rs_AUT->retr_entregable->SetValue("images/Cumple.png");  
			$l_calificacion_rs_AUT->retr_entregable->Visible  =true;
			break;
		case "0":
			$l_calificacion_rs_AUT->retr_entregable->SetValue("images/NoCumple.png");  
			$l_calificacion_rs_AUT->retr_entregable->Visible  =true;
			break;
		default:
			$l_calificacion_rs_AUT->retr_entregable->Visible  =false;
			$l_calificacion_rs_AUT->lb11_retr_entregable->Visible  =true;
			$l_calificacion_rs_AUT->lb11_retr_entregable->SetValue($valor);
}

 $l_calificacion_rs_AUT->lb11_calidad_prod_term->Visible  =false;
 $l_calificacion_rs_AUT->calidad_prod_term->Visible  =false;
 $valor=$l_calificacion_rs_AUT->calidad_prod_term->GetValue();
switch( $valor){
		case "1":
			$l_calificacion_rs_AUT->calidad_prod_term->SetValue("images/Cumple.png");  
			$l_calificacion_rs_AUT->calidad_prod_term->Visible  =true;
			break;
		case "0":
			$l_calificacion_rs_AUT->calidad_prod_term->SetValue("images/NoCumple.png");  
			$l_calificacion_rs_AUT->calidad_prod_term->Visible  =true;
			break;
		default:
			$l_calificacion_rs_AUT->calidad_prod_term->Visible  =false;
			$l_calificacion_rs_AUT->lb11_calidad_prod_term->Visible  =true;
			$l_calificacion_rs_AUT->lb11_calidad_prod_term->SetValue($valor);
}

 $l_calificacion_rs_AUT->lb11_calidad_codigo->Visible  =false;
 $valor=$l_calificacion_rs_AUT->calidad_codigo->GetValue();
switch( $valor){
		case "1":
			$l_calificacion_rs_AUT->calidad_codigo->SetValue("images/Cumple.png");  
			$l_calificacion_rs_AUT->calidad_codigo->Visible  =true;
			break;
		case "0":
			$l_calificacion_rs_AUT->calidad_codigo->SetValue("images/NoCumple.png");  
			$l_calificacion_rs_AUT->calidad_codigo->Visible  =true;
			break;
		default:
			$l_calificacion_rs_AUT->calidad_codigo->Visible  =false;
			$l_calificacion_rs_AUT->lb11_calidad_codigo->Visible  =true;
			$l_calificacion_rs_AUT->lb11_calidad_codigo->SetValue($valor);
}

 $l_calificacion_rs_AUT->lb11_def_fug_amb_prod->Visible  =false;
 $valor=$l_calificacion_rs_AUT->def_fug_amb_prod->GetValue();
switch( $valor){
		case "1":
			$l_calificacion_rs_AUT->def_fug_amb_prod->SetValue("images/Cumple.png");  
			$l_calificacion_rs_AUT->def_fug_amb_prod->Visible  =true;
			break;
		case "0":
			$l_calificacion_rs_AUT->def_fug_amb_prod->SetValue("images/NoCumple.png");  
			$l_calificacion_rs_AUT->def_fug_amb_prod->Visible  =true;
			break;
		default:
			$l_calificacion_rs_AUT->def_fug_amb_prod->Visible  =false;
			$l_calificacion_rs_AUT->lb11_def_fug_amb_prod->Visible  =true;
			$l_calificacion_rs_AUT->lb11_def_fug_amb_prod->SetValue($valor);
}

// -------------------------
//End Custom Code

//Close l_calificacion_rs_AUT_BeforeShowRow @308-B1B06246
    return $l_calificacion_rs_AUT_BeforeShowRow;
}
//End Close l_calificacion_rs_AUT_BeforeShowRow

//l_calificacion_incidentes1_s_id_periodo_ds_BeforeExecuteSelect @355-6E33379B
function l_calificacion_incidentes1_s_id_periodo_ds_BeforeExecuteSelect(& $sender)
{
    $l_calificacion_incidentes1_s_id_periodo_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_calificacion_incidentes1; //Compatibility
//End l_calificacion_incidentes1_s_id_periodo_ds_BeforeExecuteSelect

//Custom Code @520-2A29BDB7
// -------------------------
    // Write your own code here.
   // echo "-" . $l_calificacion_incidentes1->s_id_periodo->DataSource->SQL;
// -------------------------
//End Custom Code

//Close l_calificacion_incidentes1_s_id_periodo_ds_BeforeExecuteSelect @355-88E61CAC
    return $l_calificacion_incidentes1_s_id_periodo_ds_BeforeExecuteSelect;
}
//End Close l_calificacion_incidentes1_s_id_periodo_ds_BeforeExecuteSelect

//DEL  // -------------------------
//DEL      // Write your own code here.
		
//DEL      
//DEL      
//DEL  switch($l_calificacion_incidentes2->Cumple_Inc_TiempoAsignacion->GetValue()){
//DEL  		case "1":
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoAsignacion->SetValue("images/Cumple.png");  
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoAsignacion->Visible  =true;
//DEL  			break;
//DEL  		case "0":
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoAsignacion->SetValue("images/NoCumple.png");  
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoAsignacion->Visible  =true;
//DEL  			break;
//DEL  		default:
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoAsignacion->Visible  =false;
//DEL  }
//DEL  
//DEL  switch($l_calificacion_incidentes2->Cumple_Inc_TiempoSolucion->GetValue()){
//DEL  		case "1":
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoSolucion->SetValue("images/Cumple.png");  
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoSolucion->Visible  =true;
//DEL  			break;
//DEL  		case "0":
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoSolucion->SetValue("images/NoCumple.png");  
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoSolucion->Visible  =true;
//DEL  			break;
//DEL  		default:
//DEL  			$l_calificacion_incidentes2->Cumple_Inc_TiempoSolucion->Visible  =false;
//DEL  	}
//DEL      
		 
//DEL  // -------------------------

//l_calificacion_incidentes_l_calificacion_incidentes_TotalRecords_BeforeShow @384-BE841E8A
function l_calificacion_incidentes_l_calificacion_incidentes_TotalRecords_BeforeShow(& $sender)
{
    $l_calificacion_incidentes_l_calificacion_incidentes_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_calificacion_incidentes; //Compatibility
//End l_calificacion_incidentes_l_calificacion_incidentes_TotalRecords_BeforeShow

//Retrieve number of records @385-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close l_calificacion_incidentes_l_calificacion_incidentes_TotalRecords_BeforeShow @384-23CE904F
    return $l_calificacion_incidentes_l_calificacion_incidentes_TotalRecords_BeforeShow;
}
//End Close l_calificacion_incidentes_l_calificacion_incidentes_TotalRecords_BeforeShow

//l_calificacion_incidentes_BeforeShowRow @382-4F37C06D
function l_calificacion_incidentes_BeforeShowRow(& $sender)
{
    $l_calificacion_incidentes_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $l_calificacion_incidentes; //Compatibility
//End l_calificacion_incidentes_BeforeShowRow

//Custom Code @407-2A29BDB7
// -------------------------
    // Write your own code here.
 
 $l_calificacion_incidentes->lb_Cumple_In_TiempoAsignacion->Visible  =false;  
$valor=$l_calificacion_incidentes->Cumple_Inc_TiempoAsignacion->GetValue(); 
switch($valor){
		case "1":
			$l_calificacion_incidentes->Cumple_Inc_TiempoAsignacion->SetValue("images/Cumple.png");  
			$l_calificacion_incidentes->Cumple_Inc_TiempoAsignacion->Visible  =true;
			break;
		case "0":
			$l_calificacion_incidentes->Cumple_Inc_TiempoAsignacion->SetValue("images/NoCumple.png");  
			$l_calificacion_incidentes->Cumple_Inc_TiempoAsignacion->Visible  =true;
			break;
		default:
			$l_calificacion_incidentes->Cumple_Inc_TiempoAsignacion->Visible  =false;
			$l_calificacion_incidentes->lb_Cumple_In_TiempoAsignacion->Visible  =true;
			$l_calificacion_incidentes->lb_Cumple_In_TiempoAsignacion->SetValue($valor);
}


$l_calificacion_incidentes->lb_Cumple_Inc_TiempoSolucion->Visible  =false;
$valor=$l_calificacion_incidentes->Cumple_Inc_TiempoSolucion->GetValue();
switch($valor){
		case "1":
			$l_calificacion_incidentes->Cumple_Inc_TiempoSolucion->SetValue("images/Cumple.png");  
			$l_calificacion_incidentes->Cumple_Inc_TiempoSolucion->Visible  =true;
			break;
		case "0":
			$l_calificacion_incidentes->Cumple_Inc_TiempoSolucion->SetValue("images/NoCumple.png");  
			$l_calificacion_incidentes->Cumple_Inc_TiempoSolucion->Visible  =true;
			break;
		default:
			$l_calificacion_incidentes->Cumple_Inc_TiempoSolucion->Visible  =false;
			$l_calificacion_incidentes->lb_Cumple_Inc_TiempoSolucion->Visible  =true;
			$l_calificacion_incidentes->lb_Cumple_Inc_TiempoSolucion->SetValue($valor);

	} 

// -------------------------
//End Custom Code

//Close l_calificacion_incidentes_BeforeShowRow @382-7518C5F5
    return $l_calificacion_incidentes_BeforeShowRow;
}
//End Close l_calificacion_incidentes_BeforeShowRow

//resumen_resumen_TotalRecords_BeforeShow @442-50DF31F0
function resumen_resumen_TotalRecords_BeforeShow(& $sender)
{
    $resumen_resumen_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resumen; //Compatibility
//End resumen_resumen_TotalRecords_BeforeShow

//Retrieve number of records @443-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close resumen_resumen_TotalRecords_BeforeShow @442-89F754AA
    return $resumen_resumen_TotalRecords_BeforeShow;
}
//End Close resumen_resumen_TotalRecords_BeforeShow

//Grid1_BeforeShowRow @2-FCC1FF76
function Grid1_BeforeShowRow(& $sender)
{
    $Grid1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_BeforeShowRow

//Custom Code @69-2A29BDB7
// -------------------------
    // Write your own code here.
    	global $db;
	global $lColorCelda;
	$db= new clsDBcon_xls();
	/*
	para que este código funcione es necesario que el nombre de los controles cumpla con lo esperado en el código
	un prefijo seguido del acronimo del SLA 
	*/
	$db->query("SELECT lower(Acronimo)  FROM mc_c_metrica where id_ver_metrica<12 ");
	while($db->next_record()){
		$sAcronimo= $db->f(0);
		$sImg= "img" . $db->f(0); //se asocia la imagen al acronimo
		$sCumplen = "cumplen" . $sAcronimo;
		$sTotal = "tot"  . $sAcronimo;
		$sMeta = "meta_" . $sAcronimo;
		$Grid1->$sCumplen->Visible=false;
		$Grid1->$sTotal->Visible=false;
		//if($db->f(0)==1){//si el campo activo del SLA para el servicio es 1, se pintan los semáforos, de lo contrario no aplica el SLA para el servicio
			$Grid1->$sImg->SetValue("images/blank_SLA.png");
			if (isset($Grid1->$sImg)){
				if($Grid1->DataSource->f($sTotal) != "0" && $Grid1->DataSource->f($sTotal)!=""){
					$result=$Grid1->$sCumplen->GetValue();
					$result2= $Grid1->$sTotal->GetValue();
					$total_div=($result/$result2)*100;
					$Grid1->$sAcronimo->SetValue($Grid1->$sCumplen->GetValue() . "/" . $Grid1->$sTotal->GetValue() . " = " . round($total_div,2) . "%");
					if($Grid1->DataSource->f($db->f(0))<$Grid1->DataSource->f($sMeta)){
						$Grid1->$sImg->SetValue("images/down.png");
					} else {
						$Grid1->$sImg->SetValue("images/up.png");
					}
				} else {
					$Grid1->$sImg->SetValue("images/left.png");
					$Grid1->$sAcronimo->SetValue("Sin Datos<br>para Medir");
				}
			}
		//} else {
			//$grdTableroSLAs->$sAcronimo->SetValue("No Aplica para<br>este servicio");
		//	$Grid1->$sAcronimo->SetValue("");
		//	$Grid1->$sImg->SetValue("images/blank_SLA.png");
		//}
	}
	$db->close();
// -------------------------
//End Custom Code

//Close Grid1_BeforeShowRow @2-23E47D26
    return $Grid1_BeforeShowRow;
}
//End Close Grid1_BeforeShowRow

//Page_BeforeShow @1-28126209
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $historico_cargas_rs2; //Compatibility
//End Page_BeforeShow

//Custom Code @469-2A29BDB7
// -------------------------
    // Write your own code here.
    global $l_calificacion_incidentes1;
      if(CCGetSession("capc_cds")=="CDS"){
    	$l_calificacion_incidentes1->s_id_proveedor->SetValue(CCGetSession("id_proveedor"));
      }
      //poner la fecha de registro y tipo de periodo de carga
      $id_proveedor=$l_calificacion_incidentes1->s_id_proveedor->GetValue();
      $id_periodo=$l_calificacion_incidentes1->s_id_periodo->GetValue();
      $opt_slas=$l_calificacion_incidentes1->s_opt_slas->GetValue();
      
     // $l_calificacion_incidentes1->Label1->SetValue(" id prov ".$id_proveedor);	
      if ($id_proveedor>0 &&  $id_periodo>0 &&  $opt_slas!="") {
      		
	      $ssql=" SELECT distinct a.fecha_registro,  periodo+tipo_periodo as periodo,
	      a.num_carga, u.usuario
	FROM l_calificacion_incidentes_AUT a,  periodos_hist p, usuario u
	WHERE a.id_periodo=p.id_periodo and u.id_usuario=a.id_usuario and
	a.id_proveedor =  $id_proveedor
	AND a.id_periodo = $id_periodo
	AND a.tipo_nivel_servicio = '$opt_slas' 
	AND a.estatus='F'
	and  a.num_carga=(
	SELECT max(b.num_carga)
	FROM l_calificacion_incidentes_AUT b
	WHERE b.id_proveedor = $id_proveedor
	AND b.id_periodo =$id_periodo
	AND b.tipo_nivel_servicio = '$opt_slas' 
	AND b.estatus='F'
	)
	      ";
	      global $db;
		$db=new clsDBcon_xls;
		$num_max_incidentes=0;
		$n_error=0;
		$fecha_carga="0";
		$db->query($ssql);
		while ($db->next_record() ) {  		         
		        $fecha_carga=$db->f(0);
		        $nom_periodo=$db->f(1);	 	     
		        $num_carga=$db->f(2);	
		        $usuario_carga=$db->f(3);	
		}  
		if ($fecha_carga!="0"){
			$date=date_create($fecha_carga);	
			$fecha_carga=date_format($date, 'd/m/Y H:i:s');	
		      //$l_calificacion_incidentes1->lb_periodo_fecha_carga2->SetValue($fecha_carga);
		      $l_calificacion_incidentes1->lb_nom_periodo->SetValue("<font color=green size=3><strong> <h3>Periodo : $nom_periodo ,  Fecha de Carga : $fecha_carga,  Usuario que cargó : $usuario_carga, Intento número : $num_carga</h3></strong></font>");
		}
	      else {
	      		$l_calificacion_incidentes1->lb_nom_periodo->SetValue("");
	      }
      }
      global $lb_efic_presup;
      $fecha_hoy=date("Y/m/d");
      
      if($fecha_hoy>="2016/05/01")
     	 	$lb_efic_presup->Visible=false;
     	else
     		$lb_efic_presup->SetValue("Eficiencia Presupuestal :  N/A");
     		
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
?>
