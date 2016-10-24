<?php
//BindEvents Method @1-A44806BF
function BindEvents()
{
    global $detalle_layout;
    $detalle_layout->Navigator->CCSEvents["BeforeShow"] = "detalle_layout_Navigator_BeforeShow";
}
//End BindEvents Method

//detalle_layout_Navigator_BeforeShow @47-AF74643D
function detalle_layout_Navigator_BeforeShow(& $sender)
{
    $detalle_layout_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_layout; //Compatibility
//End detalle_layout_Navigator_BeforeShow

//Hide-Show Component @48-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close detalle_layout_Navigator_BeforeShow @47-DA5C2CC3
    return $detalle_layout_Navigator_BeforeShow;
}
//End Close detalle_layout_Navigator_BeforeShow


?>
