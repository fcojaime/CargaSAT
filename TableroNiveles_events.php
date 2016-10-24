<?php
//BindEvents Method @1-B1A6A580
function BindEvents()
{
    global $Grid1;
    $Grid1->CCSEvents["BeforeShowRow"] = "Grid1_BeforeShowRow";
}
//End BindEvents Method

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
					$Grid1->$sAcronimo->SetValue($Grid1->$sCumplen->GetValue() . "/" . $Grid1->$sTotal->GetValue() . " = " . round($Grid1->$sAcronimo->GetValue(),2) . "%");
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


?>


//BindEvents Method @1-B1A6A580
function BindEvents()
{
    global $Grid1;
    $Grid1->CCSEvents["BeforeShowRow"] = "Grid1_BeforeShowRow";
}
//End BindEvents Method

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
// -------------------------
//End Custom Code

//Close Grid1_BeforeShowRow @2-23E47D26
    return $Grid1_BeforeShowRow;
}
//End Close Grid1_BeforeShowRow