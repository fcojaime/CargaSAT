<?php
//BindEvents Method @1-2D90B45B
function BindEvents()
{
    global $layouts;
    $layouts->Navigator->CCSEvents["BeforeShow"] = "layouts_Navigator_BeforeShow";
}
//End BindEvents Method

//layouts_Navigator_BeforeShow @38-5D10313E
function layouts_Navigator_BeforeShow(& $sender)
{
    $layouts_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $layouts; //Compatibility
//End layouts_Navigator_BeforeShow

//Hide-Show Component @39-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close layouts_Navigator_BeforeShow @38-4D0E19B4
    return $layouts_Navigator_BeforeShow;
}
//End Close layouts_Navigator_BeforeShow


?>


//BindEvents Method @1-2D90B45B
function BindEvents()
{
    global $layouts;
    $layouts->Navigator->CCSEvents["BeforeShow"] = "layouts_Navigator_BeforeShow";
}
//End BindEvents Method

//layouts_Navigator_BeforeShow @38-5D10313E
function layouts_Navigator_BeforeShow(& $sender)
{
    $layouts_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $layouts; //Compatibility
//End layouts_Navigator_BeforeShow

//Hide-Show Component @39-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close layouts_Navigator_BeforeShow @38-4D0E19B4
    return $layouts_Navigator_BeforeShow;
}
//End Close layouts_Navigator_BeforeShow