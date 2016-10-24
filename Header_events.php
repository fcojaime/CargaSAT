<?php

// //Events @1-F81417CB

//Header_pnlMenu_BeforeShow @14-F2DF091B
function Header_pnlMenu_BeforeShow(& $sender)
{
    $Header_pnlMenu_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_pnlMenu_BeforeShow

//Custom Code @19-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Header_pnlMenu_BeforeShow @14-E7393C77
    return $Header_pnlMenu_BeforeShow;
}
//End Close Header_pnlMenu_BeforeShow

//Header_BeforeShow @1-19A6F438
function Header_BeforeShow(& $sender)
{
    $Header_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_BeforeShow

//Custom Code @9-2A29BDB7
// -------------------------
	global $Panel2;
	global $Panel1;
	global $Tpl;
	$PathToRoot='';
	$Tpl->SetVar("imgUserPath",$PathToRoot  . "images/user.png");
	$Tpl->SetVar("imgCierrePath",$PathToRoot  . "images/cierre.png");
	$Tpl->SetVar("imgCierre2Path",$PathToRoot  . "images/cierre2.png");
	$Tpl->SetVar("imgCargaxlsPath",$PathToRoot  . "images/xls.jpg");
	$Tpl->SetVar("imgHistoricosPath",$PathToRoot  . "images/historico.jpg");
	$Tpl->SetVar("imgPeriodosPath",$PathToRoot  . "images/calendario.jpg");
	$Tpl->SetVar("imgBackTableroPath",$PathToRoot  . "images/prev.gif");
	
    $Component->hdLogoPath->SetValue($PathToRoot . "SDMA_capcV.png");
    
    if(CCGetUserLogin()==""){
    	$Component->Panel1->Visible=false;
    	$Component->Panel2->Visible=false;
    	$Component->Panel3->Visible=false;
    	$Component->Panel4->Visible=false;
    } else {
    	$Component->lSesion->SetValue(CCGetUserLogin());
    }
    
    	//$Component->pnlMenu->Visible=true;//false;
    	$Component->Panel2->Visible=true;
    						   
    if(CCGetGroupID()<5){
    	$Component->pnlMenu->Visible=false;
    }
    if(CCGetSession("capc_cds")=="CAPC"){
    	//ocultar carga_archivo
    	$Component->Panel3->Visible=true;
    	$Component->Panel4->Visible=false;
    }
    if(CCGetSession("capc_cds")=="CDS"){
    	$Component->Panel3->Visible=false;
    	$Component->Panel4->Visible=true;
    	//echo"";
    	}
// -------------------------
//End Custom Code

//Close Header_BeforeShow @1-E0152CE0
    return $Header_BeforeShow;
}
//End Close Header_BeforeShow
?>
