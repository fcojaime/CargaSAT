<?php
//BindEvents Method @1-C0634196
function BindEvents()
{
    global $Login1;
    $Login1->Button_DoLogin->CCSEvents["OnClick"] = "Login1_Button_DoLogin_OnClick";
}
//End BindEvents Method

//Login1_Button_DoLogin_OnClick @3-E337B8B9
function Login1_Button_DoLogin_OnClick(& $sender)
{
    $Login1_Button_DoLogin_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Login1; //Compatibility
//End Login1_Button_DoLogin_OnClick

//Login @6-8D8664A8
    global $CCSLocales;
    global $Redirect;
    
    if ( !CCLoginUser( $Container->login->Value, $Container->password->Value)) {
        $Container->Errors->addError($CCSLocales->GetText("CCS_LoginError"));
        $Container->password->SetValue("");
        $Login1_Button_DoLogin_OnClick = 0;
    } else {
        global $Redirect;
        $Redirect = CCGetParam("ret_link", $Redirect);
          global $conx_xls;
    	$conx_xls= new clsDBcon_xls();
        $id_usuario=CCGetUserID(); 
        $nom_proveedor=CCDLookUp("nom_proveedor","usuario","id_usuario=".$conx_xls->ToSQL($id_usuario, ccsInteger),   $conx_xls);
	 $id_proveedor=CCDLookUp("id_proveedor","usuario","id_usuario=".$conx_xls->ToSQL($id_usuario, ccsInteger),   $conx_xls);
	 $capc_cds=CCDLookUp("capc_cds","usuario","id_usuario=".$conx_xls->ToSQL($id_usuario, ccsInteger),   $conx_xls);
	
	 
        CCSetSession("nom_cds",$nom_proveedor);
        CCSetSession("id_proveedor",$id_proveedor);
        CCSetSession("capc_cds",$capc_cds);
        
        if($capc_cds=="CAPC")
         $Redirect = "historico_cargas_rs2.php";
        else
          $Redirect = "carga_archivo.php";
        
        $Login1_Button_DoLogin_OnClick = 1;
    }
//End Login

//Close Login1_Button_DoLogin_OnClick @3-53D741FA
    return $Login1_Button_DoLogin_OnClick;
}
//End Close Login1_Button_DoLogin_OnClick


?>
