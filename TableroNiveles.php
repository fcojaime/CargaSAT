<?php
//Include Common Files @1-532D0649
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "TableroNiveles.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid1 { //Grid1 class @2-E857A572

//Variables @2-0E2E170B

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sorter_descripcion;
    public $Sorter_cumplenherr_est_cost;
    public $Sorter_cumplenreq_serv;
    public $Sorter_cumplencumpl_req_func;
    public $Sorter_cumplencalidad_prod_term;
    public $Sorter_cumplenretr_entregable;
    public $Sorter_cumplencal_cod;
    public $Sorter_cumplendef_fug_amb_prod;
//End Variables

//Class_Initialize Event @2-5FE9FA8A
    function clsGridGrid1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGrid1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 15;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("Grid1Order", "");
        $this->SorterDirection = CCGetParam("Grid1Dir", "");

        $this->descripcion = new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->cumplenherr_est_cost = new clsControl(ccsLabel, "cumplenherr_est_cost", "cumplenherr_est_cost", ccsInteger, "", CCGetRequestParam("cumplenherr_est_cost", ccsGet, NULL), $this);
        $this->cumplenreq_serv = new clsControl(ccsLabel, "cumplenreq_serv", "cumplenreq_serv", ccsInteger, "", CCGetRequestParam("cumplenreq_serv", ccsGet, NULL), $this);
        $this->cumplencumpl_req_func = new clsControl(ccsLabel, "cumplencumpl_req_func", "cumplencumpl_req_func", ccsInteger, "", CCGetRequestParam("cumplencumpl_req_func", ccsGet, NULL), $this);
        $this->cumplencalidad_prod_term = new clsControl(ccsLabel, "cumplencalidad_prod_term", "cumplencalidad_prod_term", ccsInteger, "", CCGetRequestParam("cumplencalidad_prod_term", ccsGet, NULL), $this);
        $this->cumplenretr_entregable = new clsControl(ccsLabel, "cumplenretr_entregable", "cumplenretr_entregable", ccsInteger, "", CCGetRequestParam("cumplenretr_entregable", ccsGet, NULL), $this);
        $this->cumplencal_cod = new clsControl(ccsLabel, "cumplencal_cod", "cumplencal_cod", ccsInteger, "", CCGetRequestParam("cumplencal_cod", ccsGet, NULL), $this);
        $this->cumplendef_fug_amb_prod = new clsControl(ccsLabel, "cumplendef_fug_amb_prod", "cumplendef_fug_amb_prod", ccsInteger, "", CCGetRequestParam("cumplendef_fug_amb_prod", ccsGet, NULL), $this);
        $this->totherr_est_cost = new clsControl(ccsLabel, "totherr_est_cost", "totherr_est_cost", ccsInteger, "", CCGetRequestParam("totherr_est_cost", ccsGet, NULL), $this);
        $this->herr_est_cost = new clsControl(ccsLabel, "herr_est_cost", "herr_est_cost", ccsText, "", CCGetRequestParam("herr_est_cost", ccsGet, NULL), $this);
        $this->herr_est_cost->HTML = true;
        $this->meta_herr_est_cost = new clsControl(ccsHidden, "meta_herr_est_cost", "meta_herr_est_cost", ccsFloat, "", CCGetRequestParam("meta_herr_est_cost", ccsGet, NULL), $this);
        $this->totreq_serv = new clsControl(ccsLabel, "totreq_serv", "totreq_serv", ccsInteger, "", CCGetRequestParam("totreq_serv", ccsGet, NULL), $this);
        $this->req_serv = new clsControl(ccsLabel, "req_serv", "req_serv", ccsText, "", CCGetRequestParam("req_serv", ccsGet, NULL), $this);
        $this->req_serv->HTML = true;
        $this->meta_req_serv = new clsControl(ccsHidden, "meta_req_serv", "meta_req_serv", ccsFloat, "", CCGetRequestParam("meta_req_serv", ccsGet, NULL), $this);
        $this->totcumpl_req_func = new clsControl(ccsLabel, "totcumpl_req_func", "totcumpl_req_func", ccsInteger, "", CCGetRequestParam("totcumpl_req_func", ccsGet, NULL), $this);
        $this->cumpl_req_func = new clsControl(ccsLabel, "cumpl_req_func", "cumpl_req_func", ccsText, "", CCGetRequestParam("cumpl_req_func", ccsGet, NULL), $this);
        $this->cumpl_req_func->HTML = true;
        $this->meta_cumpl_req_func = new clsControl(ccsHidden, "meta_cumpl_req_func", "meta_cumpl_req_func", ccsFloat, "", CCGetRequestParam("meta_cumpl_req_func", ccsGet, NULL), $this);
        $this->totcalidad_prod_term = new clsControl(ccsLabel, "totcalidad_prod_term", "totcalidad_prod_term", ccsInteger, "", CCGetRequestParam("totcalidad_prod_term", ccsGet, NULL), $this);
        $this->calidad_prod_term = new clsControl(ccsLabel, "calidad_prod_term", "calidad_prod_term", ccsText, "", CCGetRequestParam("calidad_prod_term", ccsGet, NULL), $this);
        $this->calidad_prod_term->HTML = true;
        $this->meta_calidad_prod_term = new clsControl(ccsHidden, "meta_calidad_prod_term", "meta_calidad_prod_term", ccsFloat, "", CCGetRequestParam("meta_calidad_prod_term", ccsGet, NULL), $this);
        $this->totretr_entregable = new clsControl(ccsLabel, "totretr_entregable", "totretr_entregable", ccsInteger, "", CCGetRequestParam("totretr_entregable", ccsGet, NULL), $this);
        $this->retr_entregable = new clsControl(ccsLabel, "retr_entregable", "retr_entregable", ccsText, "", CCGetRequestParam("retr_entregable", ccsGet, NULL), $this);
        $this->retr_entregable->HTML = true;
        $this->meta_retr_entregable = new clsControl(ccsHidden, "meta_retr_entregable", "meta_retr_entregable", ccsFloat, "", CCGetRequestParam("meta_retr_entregable", ccsGet, NULL), $this);
        $this->totcal_cod = new clsControl(ccsLabel, "totcal_cod", "totcal_cod", ccsInteger, "", CCGetRequestParam("totcal_cod", ccsGet, NULL), $this);
        $this->cal_cod = new clsControl(ccsLabel, "cal_cod", "cal_cod", ccsText, "", CCGetRequestParam("cal_cod", ccsGet, NULL), $this);
        $this->cal_cod->HTML = true;
        $this->meta_cal_cod = new clsControl(ccsHidden, "meta_cal_cod", "meta_cal_cod", ccsFloat, "", CCGetRequestParam("meta_cal_cod", ccsGet, NULL), $this);
        $this->totdef_fug_amb_prod = new clsControl(ccsLabel, "totdef_fug_amb_prod", "totdef_fug_amb_prod", ccsInteger, "", CCGetRequestParam("totdef_fug_amb_prod", ccsGet, NULL), $this);
        $this->def_fug_amb_prod = new clsControl(ccsLabel, "def_fug_amb_prod", "def_fug_amb_prod", ccsText, "", CCGetRequestParam("def_fug_amb_prod", ccsGet, NULL), $this);
        $this->def_fug_amb_prod->HTML = true;
        $this->meta_def_fug_amb_prod = new clsControl(ccsHidden, "meta_def_fug_amb_prod", "meta_def_fug_amb_prod", ccsFloat, "", CCGetRequestParam("meta_def_fug_amb_prod", ccsGet, NULL), $this);
        $this->imgherr_est_cost = new clsControl(ccsImage, "imgherr_est_cost", "imgherr_est_cost", ccsText, "", CCGetRequestParam("imgherr_est_cost", ccsGet, NULL), $this);
        $this->imgreq_serv = new clsControl(ccsImage, "imgreq_serv", "imgreq_serv", ccsText, "", CCGetRequestParam("imgreq_serv", ccsGet, NULL), $this);
        $this->imgcumpl_req_func = new clsControl(ccsImage, "imgcumpl_req_func", "imgcumpl_req_func", ccsText, "", CCGetRequestParam("imgcumpl_req_func", ccsGet, NULL), $this);
        $this->imgcalidad_prod_term = new clsControl(ccsImage, "imgcalidad_prod_term", "imgcalidad_prod_term", ccsText, "", CCGetRequestParam("imgcalidad_prod_term", ccsGet, NULL), $this);
        $this->imgretr_entregable = new clsControl(ccsImage, "imgretr_entregable", "imgretr_entregable", ccsText, "", CCGetRequestParam("imgretr_entregable", ccsGet, NULL), $this);
        $this->imgcal_cod = new clsControl(ccsImage, "imgcal_cod", "imgcal_cod", ccsText, "", CCGetRequestParam("imgcal_cod", ccsGet, NULL), $this);
        $this->imgdef_fug_amb_prod = new clsControl(ccsImage, "imgdef_fug_amb_prod", "imgdef_fug_amb_prod", ccsText, "", CCGetRequestParam("imgdef_fug_amb_prod", ccsGet, NULL), $this);
        $this->cumpleninc_tiempoasignacion = new clsControl(ccsLabel, "cumpleninc_tiempoasignacion", "cumpleninc_tiempoasignacion", ccsInteger, "", CCGetRequestParam("cumpleninc_tiempoasignacion", ccsGet, NULL), $this);
        $this->totinc_tiempoasignacion = new clsControl(ccsLabel, "totinc_tiempoasignacion", "totinc_tiempoasignacion", ccsInteger, "", CCGetRequestParam("totinc_tiempoasignacion", ccsGet, NULL), $this);
        $this->inc_tiempoasignacion = new clsControl(ccsLabel, "inc_tiempoasignacion", "inc_tiempoasignacion", ccsText, "", CCGetRequestParam("inc_tiempoasignacion", ccsGet, NULL), $this);
        $this->inc_tiempoasignacion->HTML = true;
        $this->meta_inc_tiempoasignacion = new clsControl(ccsHidden, "meta_inc_tiempoasignacion", "meta_inc_tiempoasignacion", ccsInteger, "", CCGetRequestParam("meta_inc_tiempoasignacion", ccsGet, NULL), $this);
        $this->cumpleninc_tiemposolucion = new clsControl(ccsLabel, "cumpleninc_tiemposolucion", "cumpleninc_tiemposolucion", ccsInteger, "", CCGetRequestParam("cumpleninc_tiemposolucion", ccsGet, NULL), $this);
        $this->totinc_tiemposolucion = new clsControl(ccsLabel, "totinc_tiemposolucion", "totinc_tiemposolucion", ccsInteger, "", CCGetRequestParam("totinc_tiemposolucion", ccsGet, NULL), $this);
        $this->inc_tiemposolucion = new clsControl(ccsLabel, "inc_tiemposolucion", "inc_tiemposolucion", ccsText, "", CCGetRequestParam("inc_tiemposolucion", ccsGet, NULL), $this);
        $this->inc_tiemposolucion->HTML = true;
        $this->meta_inc_tiemposolucion = new clsControl(ccsHidden, "meta_inc_tiemposolucion", "meta_inc_tiemposolucion", ccsInteger, "", CCGetRequestParam("meta_inc_tiemposolucion", ccsGet, NULL), $this);
        $this->imginc_tiempoasignacion = new clsControl(ccsImage, "imginc_tiempoasignacion", "imginc_tiempoasignacion", ccsText, "", CCGetRequestParam("imginc_tiempoasignacion", ccsGet, NULL), $this);
        $this->imginc_tiemposolucion = new clsControl(ccsImage, "imginc_tiemposolucion", "imginc_tiemposolucion", ccsText, "", CCGetRequestParam("imginc_tiemposolucion", ccsGet, NULL), $this);
        $this->imgefic_presup = new clsControl(ccsImage, "imgefic_presup", "imgefic_presup", ccsText, "", CCGetRequestParam("imgefic_presup", ccsGet, NULL), $this);
        $this->cumplenefic_presup = new clsControl(ccsLabel, "cumplenefic_presup", "cumplenefic_presup", ccsInteger, "", CCGetRequestParam("cumplenefic_presup", ccsGet, NULL), $this);
        $this->totefic_presup = new clsControl(ccsLabel, "totefic_presup", "totefic_presup", ccsInteger, "", CCGetRequestParam("totefic_presup", ccsGet, NULL), $this);
        $this->efic_presup = new clsControl(ccsLabel, "efic_presup", "efic_presup", ccsText, "", CCGetRequestParam("efic_presup", ccsGet, NULL), $this);
        $this->efic_presup->HTML = true;
        $this->meta_efic_presup = new clsControl(ccsHidden, "meta_efic_presup", "meta_efic_presup", ccsText, "", CCGetRequestParam("meta_efic_presup", ccsGet, NULL), $this);
        $this->Sorter_descripcion = new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
        $this->Sorter_cumplenherr_est_cost = new clsSorter($this->ComponentName, "Sorter_cumplenherr_est_cost", $FileName, $this);
        $this->Sorter_cumplenreq_serv = new clsSorter($this->ComponentName, "Sorter_cumplenreq_serv", $FileName, $this);
        $this->Sorter_cumplencumpl_req_func = new clsSorter($this->ComponentName, "Sorter_cumplencumpl_req_func", $FileName, $this);
        $this->Sorter_cumplencalidad_prod_term = new clsSorter($this->ComponentName, "Sorter_cumplencalidad_prod_term", $FileName, $this);
        $this->Sorter_cumplenretr_entregable = new clsSorter($this->ComponentName, "Sorter_cumplenretr_entregable", $FileName, $this);
        $this->Sorter_cumplencal_cod = new clsSorter($this->ComponentName, "Sorter_cumplencal_cod", $FileName, $this);
        $this->Sorter_cumplendef_fug_amb_prod = new clsSorter($this->ComponentName, "Sorter_cumplendef_fug_amb_prod", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-D4A12B54
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_id_proveedor"] = CCGetFromGet("s_id_proveedor", NULL);
        $this->DataSource->Parameters["urls_id_periodo"] = CCGetFromGet("s_id_periodo", NULL);
        $this->DataSource->Parameters["urls_opt_slas"] = CCGetFromGet("s_opt_slas", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["cumplenherr_est_cost"] = $this->cumplenherr_est_cost->Visible;
            $this->ControlsVisible["cumplenreq_serv"] = $this->cumplenreq_serv->Visible;
            $this->ControlsVisible["cumplencumpl_req_func"] = $this->cumplencumpl_req_func->Visible;
            $this->ControlsVisible["cumplencalidad_prod_term"] = $this->cumplencalidad_prod_term->Visible;
            $this->ControlsVisible["cumplenretr_entregable"] = $this->cumplenretr_entregable->Visible;
            $this->ControlsVisible["cumplencal_cod"] = $this->cumplencal_cod->Visible;
            $this->ControlsVisible["cumplendef_fug_amb_prod"] = $this->cumplendef_fug_amb_prod->Visible;
            $this->ControlsVisible["totherr_est_cost"] = $this->totherr_est_cost->Visible;
            $this->ControlsVisible["herr_est_cost"] = $this->herr_est_cost->Visible;
            $this->ControlsVisible["meta_herr_est_cost"] = $this->meta_herr_est_cost->Visible;
            $this->ControlsVisible["totreq_serv"] = $this->totreq_serv->Visible;
            $this->ControlsVisible["req_serv"] = $this->req_serv->Visible;
            $this->ControlsVisible["meta_req_serv"] = $this->meta_req_serv->Visible;
            $this->ControlsVisible["totcumpl_req_func"] = $this->totcumpl_req_func->Visible;
            $this->ControlsVisible["cumpl_req_func"] = $this->cumpl_req_func->Visible;
            $this->ControlsVisible["meta_cumpl_req_func"] = $this->meta_cumpl_req_func->Visible;
            $this->ControlsVisible["totcalidad_prod_term"] = $this->totcalidad_prod_term->Visible;
            $this->ControlsVisible["calidad_prod_term"] = $this->calidad_prod_term->Visible;
            $this->ControlsVisible["meta_calidad_prod_term"] = $this->meta_calidad_prod_term->Visible;
            $this->ControlsVisible["totretr_entregable"] = $this->totretr_entregable->Visible;
            $this->ControlsVisible["retr_entregable"] = $this->retr_entregable->Visible;
            $this->ControlsVisible["meta_retr_entregable"] = $this->meta_retr_entregable->Visible;
            $this->ControlsVisible["totcal_cod"] = $this->totcal_cod->Visible;
            $this->ControlsVisible["cal_cod"] = $this->cal_cod->Visible;
            $this->ControlsVisible["meta_cal_cod"] = $this->meta_cal_cod->Visible;
            $this->ControlsVisible["totdef_fug_amb_prod"] = $this->totdef_fug_amb_prod->Visible;
            $this->ControlsVisible["def_fug_amb_prod"] = $this->def_fug_amb_prod->Visible;
            $this->ControlsVisible["meta_def_fug_amb_prod"] = $this->meta_def_fug_amb_prod->Visible;
            $this->ControlsVisible["imgherr_est_cost"] = $this->imgherr_est_cost->Visible;
            $this->ControlsVisible["imgreq_serv"] = $this->imgreq_serv->Visible;
            $this->ControlsVisible["imgcumpl_req_func"] = $this->imgcumpl_req_func->Visible;
            $this->ControlsVisible["imgcalidad_prod_term"] = $this->imgcalidad_prod_term->Visible;
            $this->ControlsVisible["imgretr_entregable"] = $this->imgretr_entregable->Visible;
            $this->ControlsVisible["imgcal_cod"] = $this->imgcal_cod->Visible;
            $this->ControlsVisible["imgdef_fug_amb_prod"] = $this->imgdef_fug_amb_prod->Visible;
            $this->ControlsVisible["cumpleninc_tiempoasignacion"] = $this->cumpleninc_tiempoasignacion->Visible;
            $this->ControlsVisible["totinc_tiempoasignacion"] = $this->totinc_tiempoasignacion->Visible;
            $this->ControlsVisible["inc_tiempoasignacion"] = $this->inc_tiempoasignacion->Visible;
            $this->ControlsVisible["meta_inc_tiempoasignacion"] = $this->meta_inc_tiempoasignacion->Visible;
            $this->ControlsVisible["cumpleninc_tiemposolucion"] = $this->cumpleninc_tiemposolucion->Visible;
            $this->ControlsVisible["totinc_tiemposolucion"] = $this->totinc_tiemposolucion->Visible;
            $this->ControlsVisible["inc_tiemposolucion"] = $this->inc_tiemposolucion->Visible;
            $this->ControlsVisible["meta_inc_tiemposolucion"] = $this->meta_inc_tiemposolucion->Visible;
            $this->ControlsVisible["imginc_tiempoasignacion"] = $this->imginc_tiempoasignacion->Visible;
            $this->ControlsVisible["imginc_tiemposolucion"] = $this->imginc_tiemposolucion->Visible;
            $this->ControlsVisible["imgefic_presup"] = $this->imgefic_presup->Visible;
            $this->ControlsVisible["cumplenefic_presup"] = $this->cumplenefic_presup->Visible;
            $this->ControlsVisible["totefic_presup"] = $this->totefic_presup->Visible;
            $this->ControlsVisible["efic_presup"] = $this->efic_presup->Visible;
            $this->ControlsVisible["meta_efic_presup"] = $this->meta_efic_presup->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->cumplenherr_est_cost->SetValue($this->DataSource->cumplenherr_est_cost->GetValue());
                $this->cumplenreq_serv->SetValue($this->DataSource->cumplenreq_serv->GetValue());
                $this->cumplencumpl_req_func->SetValue($this->DataSource->cumplencumpl_req_func->GetValue());
                $this->cumplencalidad_prod_term->SetValue($this->DataSource->cumplencalidad_prod_term->GetValue());
                $this->cumplenretr_entregable->SetValue($this->DataSource->cumplenretr_entregable->GetValue());
                $this->cumplencal_cod->SetValue($this->DataSource->cumplencal_cod->GetValue());
                $this->cumplendef_fug_amb_prod->SetValue($this->DataSource->cumplendef_fug_amb_prod->GetValue());
                $this->totherr_est_cost->SetValue($this->DataSource->totherr_est_cost->GetValue());
                $this->herr_est_cost->SetValue($this->DataSource->herr_est_cost->GetValue());
                $this->meta_herr_est_cost->SetValue($this->DataSource->meta_herr_est_cost->GetValue());
                $this->totreq_serv->SetValue($this->DataSource->totreq_serv->GetValue());
                $this->req_serv->SetValue($this->DataSource->req_serv->GetValue());
                $this->meta_req_serv->SetValue($this->DataSource->meta_req_serv->GetValue());
                $this->totcumpl_req_func->SetValue($this->DataSource->totcumpl_req_func->GetValue());
                $this->cumpl_req_func->SetValue($this->DataSource->cumpl_req_func->GetValue());
                $this->meta_cumpl_req_func->SetValue($this->DataSource->meta_cumpl_req_func->GetValue());
                $this->totcalidad_prod_term->SetValue($this->DataSource->totcalidad_prod_term->GetValue());
                $this->calidad_prod_term->SetValue($this->DataSource->calidad_prod_term->GetValue());
                $this->meta_calidad_prod_term->SetValue($this->DataSource->meta_calidad_prod_term->GetValue());
                $this->totretr_entregable->SetValue($this->DataSource->totretr_entregable->GetValue());
                $this->retr_entregable->SetValue($this->DataSource->retr_entregable->GetValue());
                $this->meta_retr_entregable->SetValue($this->DataSource->meta_retr_entregable->GetValue());
                $this->totcal_cod->SetValue($this->DataSource->totcal_cod->GetValue());
                $this->cal_cod->SetValue($this->DataSource->cal_cod->GetValue());
                $this->meta_cal_cod->SetValue($this->DataSource->meta_cal_cod->GetValue());
                $this->totdef_fug_amb_prod->SetValue($this->DataSource->totdef_fug_amb_prod->GetValue());
                $this->def_fug_amb_prod->SetValue($this->DataSource->def_fug_amb_prod->GetValue());
                $this->meta_def_fug_amb_prod->SetValue($this->DataSource->meta_def_fug_amb_prod->GetValue());
                $this->cumpleninc_tiempoasignacion->SetValue($this->DataSource->cumpleninc_tiempoasignacion->GetValue());
                $this->totinc_tiempoasignacion->SetValue($this->DataSource->totinc_tiempoasignacion->GetValue());
                $this->inc_tiempoasignacion->SetValue($this->DataSource->inc_tiempoasignacion->GetValue());
                $this->meta_inc_tiempoasignacion->SetValue($this->DataSource->meta_inc_tiempoasignacion->GetValue());
                $this->cumpleninc_tiemposolucion->SetValue($this->DataSource->cumpleninc_tiemposolucion->GetValue());
                $this->totinc_tiemposolucion->SetValue($this->DataSource->totinc_tiemposolucion->GetValue());
                $this->inc_tiemposolucion->SetValue($this->DataSource->inc_tiemposolucion->GetValue());
                $this->meta_inc_tiemposolucion->SetValue($this->DataSource->meta_inc_tiemposolucion->GetValue());
                $this->cumplenefic_presup->SetValue($this->DataSource->cumplenefic_presup->GetValue());
                $this->totefic_presup->SetValue($this->DataSource->totefic_presup->GetValue());
                $this->efic_presup->SetValue($this->DataSource->efic_presup->GetValue());
                $this->meta_efic_presup->SetValue($this->DataSource->meta_efic_presup->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->descripcion->Show();
                $this->cumplenherr_est_cost->Show();
                $this->cumplenreq_serv->Show();
                $this->cumplencumpl_req_func->Show();
                $this->cumplencalidad_prod_term->Show();
                $this->cumplenretr_entregable->Show();
                $this->cumplencal_cod->Show();
                $this->cumplendef_fug_amb_prod->Show();
                $this->totherr_est_cost->Show();
                $this->herr_est_cost->Show();
                $this->meta_herr_est_cost->Show();
                $this->totreq_serv->Show();
                $this->req_serv->Show();
                $this->meta_req_serv->Show();
                $this->totcumpl_req_func->Show();
                $this->cumpl_req_func->Show();
                $this->meta_cumpl_req_func->Show();
                $this->totcalidad_prod_term->Show();
                $this->calidad_prod_term->Show();
                $this->meta_calidad_prod_term->Show();
                $this->totretr_entregable->Show();
                $this->retr_entregable->Show();
                $this->meta_retr_entregable->Show();
                $this->totcal_cod->Show();
                $this->cal_cod->Show();
                $this->meta_cal_cod->Show();
                $this->totdef_fug_amb_prod->Show();
                $this->def_fug_amb_prod->Show();
                $this->meta_def_fug_amb_prod->Show();
                $this->imgherr_est_cost->Show();
                $this->imgreq_serv->Show();
                $this->imgcumpl_req_func->Show();
                $this->imgcalidad_prod_term->Show();
                $this->imgretr_entregable->Show();
                $this->imgcal_cod->Show();
                $this->imgdef_fug_amb_prod->Show();
                $this->cumpleninc_tiempoasignacion->Show();
                $this->totinc_tiempoasignacion->Show();
                $this->inc_tiempoasignacion->Show();
                $this->meta_inc_tiempoasignacion->Show();
                $this->cumpleninc_tiemposolucion->Show();
                $this->totinc_tiemposolucion->Show();
                $this->inc_tiemposolucion->Show();
                $this->meta_inc_tiemposolucion->Show();
                $this->imginc_tiempoasignacion->Show();
                $this->imginc_tiemposolucion->Show();
                $this->imgefic_presup->Show();
                $this->cumplenefic_presup->Show();
                $this->totefic_presup->Show();
                $this->efic_presup->Show();
                $this->meta_efic_presup->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->Sorter_descripcion->Show();
        $this->Sorter_cumplenherr_est_cost->Show();
        $this->Sorter_cumplenreq_serv->Show();
        $this->Sorter_cumplencumpl_req_func->Show();
        $this->Sorter_cumplencalidad_prod_term->Show();
        $this->Sorter_cumplenretr_entregable->Show();
        $this->Sorter_cumplencal_cod->Show();
        $this->Sorter_cumplendef_fug_amb_prod->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-0DABB770
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplenherr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplenreq_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplencumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplencalidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplenretr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplencal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplendef_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totherr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->herr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_herr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totreq_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->req_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_req_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totcumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_cumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totcalidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->calidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_calidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totretr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->retr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_retr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totcal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_cal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totdef_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->def_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_def_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgherr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgreq_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgcumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgcalidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgretr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgcal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgdef_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumpleninc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totinc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->inc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_inc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumpleninc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totinc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->inc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_inc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imginc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imginc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgefic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplenefic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totefic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->efic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_efic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid1 Class @2-FCB6E20C

class clsGrid1DataSource extends clsDBcon_xls {  //Grid1DataSource Class @2-4A4C3D6C

//DataSource Variables @2-BCED2BEC
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $descripcion;
    public $cumplenherr_est_cost;
    public $cumplenreq_serv;
    public $cumplencumpl_req_func;
    public $cumplencalidad_prod_term;
    public $cumplenretr_entregable;
    public $cumplencal_cod;
    public $cumplendef_fug_amb_prod;
    public $totherr_est_cost;
    public $herr_est_cost;
    public $meta_herr_est_cost;
    public $totreq_serv;
    public $req_serv;
    public $meta_req_serv;
    public $totcumpl_req_func;
    public $cumpl_req_func;
    public $meta_cumpl_req_func;
    public $totcalidad_prod_term;
    public $calidad_prod_term;
    public $meta_calidad_prod_term;
    public $totretr_entregable;
    public $retr_entregable;
    public $meta_retr_entregable;
    public $totcal_cod;
    public $cal_cod;
    public $meta_cal_cod;
    public $totdef_fug_amb_prod;
    public $def_fug_amb_prod;
    public $meta_def_fug_amb_prod;
    public $cumpleninc_tiempoasignacion;
    public $totinc_tiempoasignacion;
    public $inc_tiempoasignacion;
    public $meta_inc_tiempoasignacion;
    public $cumpleninc_tiemposolucion;
    public $totinc_tiemposolucion;
    public $inc_tiemposolucion;
    public $meta_inc_tiemposolucion;
    public $cumplenefic_presup;
    public $totefic_presup;
    public $efic_presup;
    public $meta_efic_presup;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EDC0C6FE
    function clsGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid1";
        $this->Initialize();
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->cumplenherr_est_cost = new clsField("cumplenherr_est_cost", ccsInteger, "");
        
        $this->cumplenreq_serv = new clsField("cumplenreq_serv", ccsInteger, "");
        
        $this->cumplencumpl_req_func = new clsField("cumplencumpl_req_func", ccsInteger, "");
        
        $this->cumplencalidad_prod_term = new clsField("cumplencalidad_prod_term", ccsInteger, "");
        
        $this->cumplenretr_entregable = new clsField("cumplenretr_entregable", ccsInteger, "");
        
        $this->cumplencal_cod = new clsField("cumplencal_cod", ccsInteger, "");
        
        $this->cumplendef_fug_amb_prod = new clsField("cumplendef_fug_amb_prod", ccsInteger, "");
        
        $this->totherr_est_cost = new clsField("totherr_est_cost", ccsInteger, "");
        
        $this->herr_est_cost = new clsField("herr_est_cost", ccsText, "");
        
        $this->meta_herr_est_cost = new clsField("meta_herr_est_cost", ccsFloat, "");
        
        $this->totreq_serv = new clsField("totreq_serv", ccsInteger, "");
        
        $this->req_serv = new clsField("req_serv", ccsText, "");
        
        $this->meta_req_serv = new clsField("meta_req_serv", ccsFloat, "");
        
        $this->totcumpl_req_func = new clsField("totcumpl_req_func", ccsInteger, "");
        
        $this->cumpl_req_func = new clsField("cumpl_req_func", ccsText, "");
        
        $this->meta_cumpl_req_func = new clsField("meta_cumpl_req_func", ccsFloat, "");
        
        $this->totcalidad_prod_term = new clsField("totcalidad_prod_term", ccsInteger, "");
        
        $this->calidad_prod_term = new clsField("calidad_prod_term", ccsText, "");
        
        $this->meta_calidad_prod_term = new clsField("meta_calidad_prod_term", ccsFloat, "");
        
        $this->totretr_entregable = new clsField("totretr_entregable", ccsInteger, "");
        
        $this->retr_entregable = new clsField("retr_entregable", ccsText, "");
        
        $this->meta_retr_entregable = new clsField("meta_retr_entregable", ccsFloat, "");
        
        $this->totcal_cod = new clsField("totcal_cod", ccsInteger, "");
        
        $this->cal_cod = new clsField("cal_cod", ccsText, "");
        
        $this->meta_cal_cod = new clsField("meta_cal_cod", ccsFloat, "");
        
        $this->totdef_fug_amb_prod = new clsField("totdef_fug_amb_prod", ccsInteger, "");
        
        $this->def_fug_amb_prod = new clsField("def_fug_amb_prod", ccsText, "");
        
        $this->meta_def_fug_amb_prod = new clsField("meta_def_fug_amb_prod", ccsFloat, "");
        
        $this->cumpleninc_tiempoasignacion = new clsField("cumpleninc_tiempoasignacion", ccsInteger, "");
        
        $this->totinc_tiempoasignacion = new clsField("totinc_tiempoasignacion", ccsInteger, "");
        
        $this->inc_tiempoasignacion = new clsField("inc_tiempoasignacion", ccsText, "");
        
        $this->meta_inc_tiempoasignacion = new clsField("meta_inc_tiempoasignacion", ccsInteger, "");
        
        $this->cumpleninc_tiemposolucion = new clsField("cumpleninc_tiemposolucion", ccsInteger, "");
        
        $this->totinc_tiemposolucion = new clsField("totinc_tiemposolucion", ccsInteger, "");
        
        $this->inc_tiemposolucion = new clsField("inc_tiemposolucion", ccsText, "");
        
        $this->meta_inc_tiemposolucion = new clsField("meta_inc_tiemposolucion", ccsInteger, "");
        
        $this->cumplenefic_presup = new clsField("cumplenefic_presup", ccsInteger, "");
        
        $this->totefic_presup = new clsField("totefic_presup", ccsInteger, "");
        
        $this->efic_presup = new clsField("efic_presup", ccsText, "");
        
        $this->meta_efic_presup = new clsField("meta_efic_presup", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B02EE738
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_descripcion" => array("descripcion", ""), 
            "Sorter_cumplenherr_est_cost" => array("cumplenherr_est_cost", ""), 
            "Sorter_cumplenreq_serv" => array("cumplenreq_serv", ""), 
            "Sorter_cumplencumpl_req_func" => array("cumplencumpl_req_func", ""), 
            "Sorter_cumplencalidad_prod_term" => array("cumplencalidad_prod_term", ""), 
            "Sorter_cumplenretr_entregable" => array("cumplenretr_entregable", ""), 
            "Sorter_cumplencal_cod" => array("cumplencal_cod", ""), 
            "Sorter_cumplendef_fug_amb_prod" => array("cumplendef_fug_amb_prod", "")));
    }
//End SetOrder Method

//Prepare Method @2-D4D298C1
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], 0, false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], "", false);
    }
//End Prepare Method

//Open Method @2-78AB5C93
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select  sc.descripcion,\n" .
        "	 count(herr_est_cost) totherr_est_cost, \n" .
        "		sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end) cumplenherr_est_cost, \n" .
        "		case when count(herr_est_cost)>0 then \n" .
        "			sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end)/count(herr_est_cost)*100 \n" .
        "		else 0 end herr_est_cost,\n" .
        "	 (select meta from mc_c_metrica where acronimo='herr_est_cost') as meta_herr_est_cost,\n" .
        "	 count(req_serv) totreq_serv, \n" .
        "		sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end) cumplenreq_serv, \n" .
        "		case when count(req_serv)>0 then \n" .
        "			sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end)/count(req_serv)*100 \n" .
        "		else 0 end req_serv,\n" .
        "	 (select meta from mc_c_metrica where acronimo='req_serv') as meta_req_serv,\n" .
        "	 count(cumpl_req_func) totcumpl_req_func, \n" .
        "		sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end) cumplencumpl_req_func, \n" .
        "		case when count(cumpl_req_func)>0 then \n" .
        "			sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end)/count(cumpl_req_func)*100 \n" .
        "		else 0 end cumpl_req_func ,\n" .
        "	 (select meta from mc_c_metrica where acronimo='cumpl_req_func') as meta_cumpl_req_func,\n" .
        "	 count(calidad_prod_term) totcalidad_prod_term, \n" .
        "		sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end) cumplencalidad_prod_term, \n" .
        "		case when count(calidad_prod_term)>0 then \n" .
        "			sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end)/count(calidad_prod_term)*100 \n" .
        "		else 0 end calidad_prod_term,\n" .
        "	 (select meta from mc_c_metrica where acronimo='calidad_prod_term') as meta_calidad_prod_term,\n" .
        "	 count(retr_entregable) totretr_entregable, \n" .
        "		sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end) cumplenretr_entregable, \n" .
        "		case when count(retr_entregable)>0 then \n" .
        "			sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end)/count(retr_entregable)*100 \n" .
        "		else 0 end retr_entregable,\n" .
        "	 (select meta from mc_c_metrica where acronimo='retr_entregable') as meta_retr_entregable,\n" .
        "	 count(calidad_codigo) totcal_cod, \n" .
        "		sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end) cumplencal_cod, \n" .
        "		case when count(calidad_codigo)>0 then \n" .
        "			sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end)/count(calidad_codigo)*100 \n" .
        "		else 0 end cal_cod,\n" .
        "	 (select meta from mc_c_metrica where acronimo='cal_cod') as meta_cal_cod,\n" .
        "	 count(def_fug_amb_prod) totdef_fug_amb_prod, \n" .
        "		sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end) cumplendef_fug_amb_prod, \n" .
        "		case when count(def_fug_amb_prod)>0 then \n" .
        "			sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end)/count(def_fug_amb_prod)*100  \n" .
        "		else 0 end def_fug_amb_prod,\n" .
        "	 (select meta from mc_c_metrica where acronimo='def_fug_amb_prod') as meta_def_fug_amb_prod,\n" .
        "	 count(cumple_inc_tiempoasignacion) totinc_tiempoasignacion, \n" .
        "		sum(cast(cumple_inc_tiempoasignacion as int)) cumpleninc_tiempoasignacion, \n" .
        "		case when count(cumple_inc_tiempoasignacion)>0 then \n" .
        "			sum(cast(cumple_inc_tiempoasignacion as float))/count(cumple_inc_tiempoasignacion)*100 \n" .
        "		else 0 end inc_tiempoasignacion,\n" .
        "	 (select meta from mc_c_metrica where acronimo='inc_tiempoasignacion') as meta_inc_tiempoasignacion,\n" .
        "	 count(cumple_inc_tiemposolucion) totinc_tiemposolucion, \n" .
        "		sum(cast(cumple_inc_tiemposolucion as int)) cumpleninc_tiemposolucion, \n" .
        "		case when count(cumple_inc_tiemposolucion)>0 then \n" .
        "			sum(cast(cumple_inc_tiemposolucion as float))/count(cumple_inc_tiemposolucion)*100 \n" .
        "		else 0 end inc_tiemposolucion,\n" .
        "	 (select meta from mc_c_metrica where acronimo='inc_tiemposolucion') as meta_inc_tiemposolucion,\n" .
        "	 AVG(Cumple_EF) cumplen_efic_presup, AVG(total_ef) tot_efic_presup, avg(cast(Cumple_EF as float))/avg(total_ef)*100  efic_presup,\n" .
        "	 (Select Meta from mc_c_metrica where acronimo='EFIC_PRESUP') as meta_efic_presup\n" .
        "from mc_c_ServContractual sc \n" .
        "left join (select * from l_calificacion_rs_aut m\n" .
        "	where m.id_periodo=5  and m.id_proveedor = 3 and m.tipo_nivel_servicio ='SLO' and m.estatus ='F' \n" .
        "	and num_carga=(\n" .
        "       select max(b.num_carga)\n" .
        "       from l_calificacion_rs_aut  b\n" .
        "       where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "       and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "       and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'\n" .
        "       and b.estatus='F'\n" .
        "       )) m on sc.Descripcion  = m.servicio_cont  \n" .
        "	 left join	(select cumple_inc_tiempoasignacion, cumple_inc_tiempoSolucion, \n" .
        "				id_proveedor, 'Servicio de Soporte de Aplicaciones'  servicio_cont\n" .
        "				from l_calificacion_incidentes_AUT\n" .
        "				where (id_periodo=" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and b.estatus='F' ) \n" .
        "				) )  mi on  mi.servicio_cont = sc.Descripcion \n" .
        "	left join (select SUM(cast(efic_presupuestal as int)) Cumple_EF, COUNT(efic_presupuestal) Total_EF, Id_Proveedor,  2 IdServicioCont  \n" .
        "			from l_detalle_eficiencia_presupuestal \n" .
        "			where (id_periodo= " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and b.estatus='F' ) \n" .
        "				) group by id_proveedor ) ef on ef.IdServicioCont = sc.id\n" .
        "where sc.Aplica ='CDS' and IdOld <>0\n" .
        "group by sc.Descripcion ) cnt";
        $this->SQL = "select  sc.descripcion,\n" .
        "	 count(herr_est_cost) totherr_est_cost, \n" .
        "		sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end) cumplenherr_est_cost, \n" .
        "		case when count(herr_est_cost)>0 then \n" .
        "			sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end)/count(herr_est_cost)*100 \n" .
        "		else 0 end herr_est_cost,\n" .
        "	 (select meta from mc_c_metrica where acronimo='herr_est_cost') as meta_herr_est_cost,\n" .
        "	 count(req_serv) totreq_serv, \n" .
        "		sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end) cumplenreq_serv, \n" .
        "		case when count(req_serv)>0 then \n" .
        "			sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end)/count(req_serv)*100 \n" .
        "		else 0 end req_serv,\n" .
        "	 (select meta from mc_c_metrica where acronimo='req_serv') as meta_req_serv,\n" .
        "	 count(cumpl_req_func) totcumpl_req_func, \n" .
        "		sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end) cumplencumpl_req_func, \n" .
        "		case when count(cumpl_req_func)>0 then \n" .
        "			sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end)/count(cumpl_req_func)*100 \n" .
        "		else 0 end cumpl_req_func ,\n" .
        "	 (select meta from mc_c_metrica where acronimo='cumpl_req_func') as meta_cumpl_req_func,\n" .
        "	 count(calidad_prod_term) totcalidad_prod_term, \n" .
        "		sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end) cumplencalidad_prod_term, \n" .
        "		case when count(calidad_prod_term)>0 then \n" .
        "			sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end)/count(calidad_prod_term)*100 \n" .
        "		else 0 end calidad_prod_term,\n" .
        "	 (select meta from mc_c_metrica where acronimo='calidad_prod_term') as meta_calidad_prod_term,\n" .
        "	 count(retr_entregable) totretr_entregable, \n" .
        "		sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end) cumplenretr_entregable, \n" .
        "		case when count(retr_entregable)>0 then \n" .
        "			sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end)/count(retr_entregable)*100 \n" .
        "		else 0 end retr_entregable,\n" .
        "	 (select meta from mc_c_metrica where acronimo='retr_entregable') as meta_retr_entregable,\n" .
        "	 count(calidad_codigo) totcal_cod, \n" .
        "		sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end) cumplencal_cod, \n" .
        "		case when count(calidad_codigo)>0 then \n" .
        "			sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end)/count(calidad_codigo)*100 \n" .
        "		else 0 end cal_cod,\n" .
        "	 (select meta from mc_c_metrica where acronimo='cal_cod') as meta_cal_cod,\n" .
        "	 count(def_fug_amb_prod) totdef_fug_amb_prod, \n" .
        "		sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end) cumplendef_fug_amb_prod, \n" .
        "		case when count(def_fug_amb_prod)>0 then \n" .
        "			sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end)/count(def_fug_amb_prod)*100  \n" .
        "		else 0 end def_fug_amb_prod,\n" .
        "	 (select meta from mc_c_metrica where acronimo='def_fug_amb_prod') as meta_def_fug_amb_prod,\n" .
        "	 count(cumple_inc_tiempoasignacion) totinc_tiempoasignacion, \n" .
        "		sum(cast(cumple_inc_tiempoasignacion as int)) cumpleninc_tiempoasignacion, \n" .
        "		case when count(cumple_inc_tiempoasignacion)>0 then \n" .
        "			sum(cast(cumple_inc_tiempoasignacion as float))/count(cumple_inc_tiempoasignacion)*100 \n" .
        "		else 0 end inc_tiempoasignacion,\n" .
        "	 (select meta from mc_c_metrica where acronimo='inc_tiempoasignacion') as meta_inc_tiempoasignacion,\n" .
        "	 count(cumple_inc_tiemposolucion) totinc_tiemposolucion, \n" .
        "		sum(cast(cumple_inc_tiemposolucion as int)) cumpleninc_tiemposolucion, \n" .
        "		case when count(cumple_inc_tiemposolucion)>0 then \n" .
        "			sum(cast(cumple_inc_tiemposolucion as float))/count(cumple_inc_tiemposolucion)*100 \n" .
        "		else 0 end inc_tiemposolucion,\n" .
        "	 (select meta from mc_c_metrica where acronimo='inc_tiemposolucion') as meta_inc_tiemposolucion,\n" .
        "	 AVG(Cumple_EF) cumplen_efic_presup, AVG(total_ef) tot_efic_presup, avg(cast(Cumple_EF as float))/avg(total_ef)*100  efic_presup,\n" .
        "	 (Select Meta from mc_c_metrica where acronimo='EFIC_PRESUP') as meta_efic_presup\n" .
        "from mc_c_ServContractual sc \n" .
        "left join (select * from l_calificacion_rs_aut m\n" .
        "	where m.id_periodo=5  and m.id_proveedor = 3 and m.tipo_nivel_servicio ='SLO' and m.estatus ='F' \n" .
        "	and num_carga=(\n" .
        "       select max(b.num_carga)\n" .
        "       from l_calificacion_rs_aut  b\n" .
        "       where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "       and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "       and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'\n" .
        "       and b.estatus='F'\n" .
        "       )) m on sc.Descripcion  = m.servicio_cont  \n" .
        "	 left join	(select cumple_inc_tiempoasignacion, cumple_inc_tiempoSolucion, \n" .
        "				id_proveedor, 'Servicio de Soporte de Aplicaciones'  servicio_cont\n" .
        "				from l_calificacion_incidentes_AUT\n" .
        "				where (id_periodo=" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and b.estatus='F' ) \n" .
        "				) )  mi on  mi.servicio_cont = sc.Descripcion \n" .
        "	left join (select SUM(cast(efic_presupuestal as int)) Cumple_EF, COUNT(efic_presupuestal) Total_EF, Id_Proveedor,  2 IdServicioCont  \n" .
        "			from l_detalle_eficiencia_presupuestal \n" .
        "			where (id_periodo= " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and b.estatus='F' ) \n" .
        "				) group by id_proveedor ) ef on ef.IdServicioCont = sc.id\n" .
        "where sc.Aplica ='CDS' and IdOld <>0\n" .
        "group by sc.Descripcion ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @2-6AF500D5
    function SetValues()
    {
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->cumplenherr_est_cost->SetDBValue(trim($this->f("cumplenherr_est_cost")));
        $this->cumplenreq_serv->SetDBValue(trim($this->f("cumplenreq_serv")));
        $this->cumplencumpl_req_func->SetDBValue(trim($this->f("cumplencumpl_req_func")));
        $this->cumplencalidad_prod_term->SetDBValue(trim($this->f("cumplencalidad_prod_term")));
        $this->cumplenretr_entregable->SetDBValue(trim($this->f("cumplenretr_entregable")));
        $this->cumplencal_cod->SetDBValue(trim($this->f("cumplencal_cod")));
        $this->cumplendef_fug_amb_prod->SetDBValue(trim($this->f("cumplendef_fug_amb_prod")));
        $this->totherr_est_cost->SetDBValue(trim($this->f("totherr_est_cost")));
        $this->herr_est_cost->SetDBValue($this->f("herr_est_cost"));
        $this->meta_herr_est_cost->SetDBValue(trim($this->f("meta_herr_est_cost")));
        $this->totreq_serv->SetDBValue(trim($this->f("totreq_serv")));
        $this->req_serv->SetDBValue($this->f("req_serv"));
        $this->meta_req_serv->SetDBValue(trim($this->f("meta_req_serv")));
        $this->totcumpl_req_func->SetDBValue(trim($this->f("totcumpl_req_func")));
        $this->cumpl_req_func->SetDBValue($this->f("cumpl_req_func"));
        $this->meta_cumpl_req_func->SetDBValue(trim($this->f("meta_cumpl_req_func")));
        $this->totcalidad_prod_term->SetDBValue(trim($this->f("totcalidad_prod_term")));
        $this->calidad_prod_term->SetDBValue($this->f("calidad_prod_term"));
        $this->meta_calidad_prod_term->SetDBValue(trim($this->f("meta_calidad_prod_term")));
        $this->totretr_entregable->SetDBValue(trim($this->f("totretr_entregable")));
        $this->retr_entregable->SetDBValue($this->f("retr_entregable"));
        $this->meta_retr_entregable->SetDBValue(trim($this->f("meta_retr_entregable")));
        $this->totcal_cod->SetDBValue(trim($this->f("totcal_cod")));
        $this->cal_cod->SetDBValue($this->f("cal_cod"));
        $this->meta_cal_cod->SetDBValue(trim($this->f("meta_cal_cod")));
        $this->totdef_fug_amb_prod->SetDBValue(trim($this->f("totdef_fug_amb_prod")));
        $this->def_fug_amb_prod->SetDBValue($this->f("def_fug_amb_prod"));
        $this->meta_def_fug_amb_prod->SetDBValue(trim($this->f("meta_def_fug_amb_prod")));
        $this->cumpleninc_tiempoasignacion->SetDBValue(trim($this->f("cumpleninc_tiempoasignacion")));
        $this->totinc_tiempoasignacion->SetDBValue(trim($this->f("totinc_tiempoasignacion")));
        $this->inc_tiempoasignacion->SetDBValue($this->f("inc_tiempoasignacion"));
        $this->meta_inc_tiempoasignacion->SetDBValue(trim($this->f("meta_inc_tiempoasignacion")));
        $this->cumpleninc_tiemposolucion->SetDBValue(trim($this->f("cumpleninc_tiemposolucion")));
        $this->totinc_tiemposolucion->SetDBValue(trim($this->f("totinc_tiemposolucion")));
        $this->inc_tiemposolucion->SetDBValue($this->f("inc_tiemposolucion"));
        $this->meta_inc_tiemposolucion->SetDBValue(trim($this->f("meta_inc_tiemposolucion")));
        $this->cumplenefic_presup->SetDBValue(trim($this->f("cumplen_efic_presup")));
        $this->totefic_presup->SetDBValue(trim($this->f("tot_efic_presup")));
        $this->efic_presup->SetDBValue($this->f("efic_presup"));
        $this->meta_efic_presup->SetDBValue($this->f("meta_efic_presup"));
    }
//End SetValues Method

} //End Grid1DataSource Class @2-FCB6E20C

//Initialize Page @1-72B0F2F1
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";
$TemplateSource = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "TableroNiveles.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F3EFFD04
include_once("./TableroNiveles_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B7C418E2
$DBcon_xls = new clsDBcon_xls();
$MainPage->Connections["con_xls"] = & $DBcon_xls;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$Grid1 = new clsGridGrid1("", $MainPage);
$MainPage->Grid1 = & $Grid1;
$Grid1->Initialize();
$ScriptIncludes = "";
$SList = explode("|", $Scripts);
foreach ($SList as $Script) {
    if ($Script != "") $ScriptIncludes = $ScriptIncludes . "<script src=\"" . $PathToRoot . $Script . "\" type=\"text/javascript\"></script>\n";
}
$Attributes->SetValue("scriptIncludes", $ScriptIncludes);

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-FA3E6D4A
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
if (strlen($TemplateSource)) {
    $Tpl->LoadTemplateFromStr($TemplateSource, $BlockToParse, "CP1252");
} else {
    $Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
}
$Tpl->SetVar("CCS_PathToRoot", $PathToRoot);
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-4C5812F4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($Grid1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-ED8D35E1
$Grid1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $TemplateEncoding);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E9C658CF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($Grid1);
unset($Tpl);
//End Unload Page


?>


//Include Common Files @1-532D0649
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "TableroNiveles.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid1 { //Grid1 class @2-E857A572

//Variables @2-0E2E170B

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sorter_descripcion;
    public $Sorter_cumplenherr_est_cost;
    public $Sorter_cumplenreq_serv;
    public $Sorter_cumplencumpl_req_func;
    public $Sorter_cumplencalidad_prod_term;
    public $Sorter_cumplenretr_entregable;
    public $Sorter_cumplencal_cod;
    public $Sorter_cumplendef_fug_amb_prod;
//End Variables

//Class_Initialize Event @2-5FE9FA8A
    function clsGridGrid1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGrid1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 15;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("Grid1Order", "");
        $this->SorterDirection = CCGetParam("Grid1Dir", "");

        $this->descripcion = new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->cumplenherr_est_cost = new clsControl(ccsLabel, "cumplenherr_est_cost", "cumplenherr_est_cost", ccsInteger, "", CCGetRequestParam("cumplenherr_est_cost", ccsGet, NULL), $this);
        $this->cumplenreq_serv = new clsControl(ccsLabel, "cumplenreq_serv", "cumplenreq_serv", ccsInteger, "", CCGetRequestParam("cumplenreq_serv", ccsGet, NULL), $this);
        $this->cumplencumpl_req_func = new clsControl(ccsLabel, "cumplencumpl_req_func", "cumplencumpl_req_func", ccsInteger, "", CCGetRequestParam("cumplencumpl_req_func", ccsGet, NULL), $this);
        $this->cumplencalidad_prod_term = new clsControl(ccsLabel, "cumplencalidad_prod_term", "cumplencalidad_prod_term", ccsInteger, "", CCGetRequestParam("cumplencalidad_prod_term", ccsGet, NULL), $this);
        $this->cumplenretr_entregable = new clsControl(ccsLabel, "cumplenretr_entregable", "cumplenretr_entregable", ccsInteger, "", CCGetRequestParam("cumplenretr_entregable", ccsGet, NULL), $this);
        $this->cumplencal_cod = new clsControl(ccsLabel, "cumplencal_cod", "cumplencal_cod", ccsInteger, "", CCGetRequestParam("cumplencal_cod", ccsGet, NULL), $this);
        $this->cumplendef_fug_amb_prod = new clsControl(ccsLabel, "cumplendef_fug_amb_prod", "cumplendef_fug_amb_prod", ccsInteger, "", CCGetRequestParam("cumplendef_fug_amb_prod", ccsGet, NULL), $this);
        $this->totherr_est_cost = new clsControl(ccsLabel, "totherr_est_cost", "totherr_est_cost", ccsInteger, "", CCGetRequestParam("totherr_est_cost", ccsGet, NULL), $this);
        $this->herr_est_cost = new clsControl(ccsLabel, "herr_est_cost", "herr_est_cost", ccsText, "", CCGetRequestParam("herr_est_cost", ccsGet, NULL), $this);
        $this->herr_est_cost->HTML = true;
        $this->meta_herr_est_cost = new clsControl(ccsHidden, "meta_herr_est_cost", "meta_herr_est_cost", ccsFloat, "", CCGetRequestParam("meta_herr_est_cost", ccsGet, NULL), $this);
        $this->totreq_serv = new clsControl(ccsLabel, "totreq_serv", "totreq_serv", ccsInteger, "", CCGetRequestParam("totreq_serv", ccsGet, NULL), $this);
        $this->req_serv = new clsControl(ccsLabel, "req_serv", "req_serv", ccsText, "", CCGetRequestParam("req_serv", ccsGet, NULL), $this);
        $this->req_serv->HTML = true;
        $this->meta_req_serv = new clsControl(ccsHidden, "meta_req_serv", "meta_req_serv", ccsFloat, "", CCGetRequestParam("meta_req_serv", ccsGet, NULL), $this);
        $this->totcumpl_req_func = new clsControl(ccsLabel, "totcumpl_req_func", "totcumpl_req_func", ccsInteger, "", CCGetRequestParam("totcumpl_req_func", ccsGet, NULL), $this);
        $this->cumpl_req_func = new clsControl(ccsLabel, "cumpl_req_func", "cumpl_req_func", ccsText, "", CCGetRequestParam("cumpl_req_func", ccsGet, NULL), $this);
        $this->cumpl_req_func->HTML = true;
        $this->meta_cumpl_req_func = new clsControl(ccsHidden, "meta_cumpl_req_func", "meta_cumpl_req_func", ccsFloat, "", CCGetRequestParam("meta_cumpl_req_func", ccsGet, NULL), $this);
        $this->totcalidad_prod_term = new clsControl(ccsLabel, "totcalidad_prod_term", "totcalidad_prod_term", ccsInteger, "", CCGetRequestParam("totcalidad_prod_term", ccsGet, NULL), $this);
        $this->calidad_prod_term = new clsControl(ccsLabel, "calidad_prod_term", "calidad_prod_term", ccsText, "", CCGetRequestParam("calidad_prod_term", ccsGet, NULL), $this);
        $this->calidad_prod_term->HTML = true;
        $this->meta_calidad_prod_term = new clsControl(ccsHidden, "meta_calidad_prod_term", "meta_calidad_prod_term", ccsFloat, "", CCGetRequestParam("meta_calidad_prod_term", ccsGet, NULL), $this);
        $this->totretr_entregable = new clsControl(ccsLabel, "totretr_entregable", "totretr_entregable", ccsInteger, "", CCGetRequestParam("totretr_entregable", ccsGet, NULL), $this);
        $this->retr_entregable = new clsControl(ccsLabel, "retr_entregable", "retr_entregable", ccsText, "", CCGetRequestParam("retr_entregable", ccsGet, NULL), $this);
        $this->retr_entregable->HTML = true;
        $this->meta_retr_entregable = new clsControl(ccsHidden, "meta_retr_entregable", "meta_retr_entregable", ccsFloat, "", CCGetRequestParam("meta_retr_entregable", ccsGet, NULL), $this);
        $this->totcal_cod = new clsControl(ccsLabel, "totcal_cod", "totcal_cod", ccsInteger, "", CCGetRequestParam("totcal_cod", ccsGet, NULL), $this);
        $this->cal_cod = new clsControl(ccsLabel, "cal_cod", "cal_cod", ccsText, "", CCGetRequestParam("cal_cod", ccsGet, NULL), $this);
        $this->cal_cod->HTML = true;
        $this->meta_cal_cod = new clsControl(ccsHidden, "meta_cal_cod", "meta_cal_cod", ccsFloat, "", CCGetRequestParam("meta_cal_cod", ccsGet, NULL), $this);
        $this->totdef_fug_amb_prod = new clsControl(ccsLabel, "totdef_fug_amb_prod", "totdef_fug_amb_prod", ccsInteger, "", CCGetRequestParam("totdef_fug_amb_prod", ccsGet, NULL), $this);
        $this->def_fug_amb_prod = new clsControl(ccsLabel, "def_fug_amb_prod", "def_fug_amb_prod", ccsText, "", CCGetRequestParam("def_fug_amb_prod", ccsGet, NULL), $this);
        $this->def_fug_amb_prod->HTML = true;
        $this->meta_def_fug_amb_prod = new clsControl(ccsHidden, "meta_def_fug_amb_prod", "meta_def_fug_amb_prod", ccsFloat, "", CCGetRequestParam("meta_def_fug_amb_prod", ccsGet, NULL), $this);
        $this->imgherr_est_cost = new clsControl(ccsImage, "imgherr_est_cost", "imgherr_est_cost", ccsText, "", CCGetRequestParam("imgherr_est_cost", ccsGet, NULL), $this);
        $this->imgreq_serv = new clsControl(ccsImage, "imgreq_serv", "imgreq_serv", ccsText, "", CCGetRequestParam("imgreq_serv", ccsGet, NULL), $this);
        $this->imgcumpl_req_func = new clsControl(ccsImage, "imgcumpl_req_func", "imgcumpl_req_func", ccsText, "", CCGetRequestParam("imgcumpl_req_func", ccsGet, NULL), $this);
        $this->imgcalidad_prod_term = new clsControl(ccsImage, "imgcalidad_prod_term", "imgcalidad_prod_term", ccsText, "", CCGetRequestParam("imgcalidad_prod_term", ccsGet, NULL), $this);
        $this->imgretr_entregable = new clsControl(ccsImage, "imgretr_entregable", "imgretr_entregable", ccsText, "", CCGetRequestParam("imgretr_entregable", ccsGet, NULL), $this);
        $this->imgcal_cod = new clsControl(ccsImage, "imgcal_cod", "imgcal_cod", ccsText, "", CCGetRequestParam("imgcal_cod", ccsGet, NULL), $this);
        $this->imgdef_fug_amb_prod = new clsControl(ccsImage, "imgdef_fug_amb_prod", "imgdef_fug_amb_prod", ccsText, "", CCGetRequestParam("imgdef_fug_amb_prod", ccsGet, NULL), $this);
        $this->cumpleninc_tiempoasignacion = new clsControl(ccsLabel, "cumpleninc_tiempoasignacion", "cumpleninc_tiempoasignacion", ccsInteger, "", CCGetRequestParam("cumpleninc_tiempoasignacion", ccsGet, NULL), $this);
        $this->totinc_tiempoasignacion = new clsControl(ccsLabel, "totinc_tiempoasignacion", "totinc_tiempoasignacion", ccsInteger, "", CCGetRequestParam("totinc_tiempoasignacion", ccsGet, NULL), $this);
        $this->inc_tiempoasignacion = new clsControl(ccsLabel, "inc_tiempoasignacion", "inc_tiempoasignacion", ccsText, "", CCGetRequestParam("inc_tiempoasignacion", ccsGet, NULL), $this);
        $this->inc_tiempoasignacion->HTML = true;
        $this->meta_inc_tiempoasignacion = new clsControl(ccsHidden, "meta_inc_tiempoasignacion", "meta_inc_tiempoasignacion", ccsInteger, "", CCGetRequestParam("meta_inc_tiempoasignacion", ccsGet, NULL), $this);
        $this->cumpleninc_tiemposolucion = new clsControl(ccsLabel, "cumpleninc_tiemposolucion", "cumpleninc_tiemposolucion", ccsInteger, "", CCGetRequestParam("cumpleninc_tiemposolucion", ccsGet, NULL), $this);
        $this->totinc_tiemposolucion = new clsControl(ccsLabel, "totinc_tiemposolucion", "totinc_tiemposolucion", ccsInteger, "", CCGetRequestParam("totinc_tiemposolucion", ccsGet, NULL), $this);
        $this->inc_tiemposolucion = new clsControl(ccsLabel, "inc_tiemposolucion", "inc_tiemposolucion", ccsText, "", CCGetRequestParam("inc_tiemposolucion", ccsGet, NULL), $this);
        $this->inc_tiemposolucion->HTML = true;
        $this->meta_inc_tiemposolucion = new clsControl(ccsHidden, "meta_inc_tiemposolucion", "meta_inc_tiemposolucion", ccsInteger, "", CCGetRequestParam("meta_inc_tiemposolucion", ccsGet, NULL), $this);
        $this->imginc_tiempoasignacion = new clsControl(ccsImage, "imginc_tiempoasignacion", "imginc_tiempoasignacion", ccsText, "", CCGetRequestParam("imginc_tiempoasignacion", ccsGet, NULL), $this);
        $this->imginc_tiemposolucion = new clsControl(ccsImage, "imginc_tiemposolucion", "imginc_tiemposolucion", ccsText, "", CCGetRequestParam("imginc_tiemposolucion", ccsGet, NULL), $this);
        $this->imgefic_presup = new clsControl(ccsImage, "imgefic_presup", "imgefic_presup", ccsText, "", CCGetRequestParam("imgefic_presup", ccsGet, NULL), $this);
        $this->cumplenefic_presup = new clsControl(ccsLabel, "cumplenefic_presup", "cumplenefic_presup", ccsInteger, "", CCGetRequestParam("cumplenefic_presup", ccsGet, NULL), $this);
        $this->totefic_presup = new clsControl(ccsLabel, "totefic_presup", "totefic_presup", ccsInteger, "", CCGetRequestParam("totefic_presup", ccsGet, NULL), $this);
        $this->efic_presup = new clsControl(ccsLabel, "efic_presup", "efic_presup", ccsText, "", CCGetRequestParam("efic_presup", ccsGet, NULL), $this);
        $this->efic_presup->HTML = true;
        $this->meta_efic_presup = new clsControl(ccsHidden, "meta_efic_presup", "meta_efic_presup", ccsText, "", CCGetRequestParam("meta_efic_presup", ccsGet, NULL), $this);
        $this->Sorter_descripcion = new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
        $this->Sorter_cumplenherr_est_cost = new clsSorter($this->ComponentName, "Sorter_cumplenherr_est_cost", $FileName, $this);
        $this->Sorter_cumplenreq_serv = new clsSorter($this->ComponentName, "Sorter_cumplenreq_serv", $FileName, $this);
        $this->Sorter_cumplencumpl_req_func = new clsSorter($this->ComponentName, "Sorter_cumplencumpl_req_func", $FileName, $this);
        $this->Sorter_cumplencalidad_prod_term = new clsSorter($this->ComponentName, "Sorter_cumplencalidad_prod_term", $FileName, $this);
        $this->Sorter_cumplenretr_entregable = new clsSorter($this->ComponentName, "Sorter_cumplenretr_entregable", $FileName, $this);
        $this->Sorter_cumplencal_cod = new clsSorter($this->ComponentName, "Sorter_cumplencal_cod", $FileName, $this);
        $this->Sorter_cumplendef_fug_amb_prod = new clsSorter($this->ComponentName, "Sorter_cumplendef_fug_amb_prod", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-A6C9A0F0
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_id_proveedor"] = CCGetFromGet("s_id_proveedor", NULL);
        $this->DataSource->Parameters["urls_id_periodo"] = CCGetFromGet("s_id_periodo", NULL);
        $this->DataSource->Parameters["urls_opt_slas"] = CCGetFromGet("s_opt_slas", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["cumplenherr_est_cost"] = $this->cumplenherr_est_cost->Visible;
            $this->ControlsVisible["cumplenreq_serv"] = $this->cumplenreq_serv->Visible;
            $this->ControlsVisible["cumplencumpl_req_func"] = $this->cumplencumpl_req_func->Visible;
            $this->ControlsVisible["cumplencalidad_prod_term"] = $this->cumplencalidad_prod_term->Visible;
            $this->ControlsVisible["cumplenretr_entregable"] = $this->cumplenretr_entregable->Visible;
            $this->ControlsVisible["cumplencal_cod"] = $this->cumplencal_cod->Visible;
            $this->ControlsVisible["cumplendef_fug_amb_prod"] = $this->cumplendef_fug_amb_prod->Visible;
            $this->ControlsVisible["totherr_est_cost"] = $this->totherr_est_cost->Visible;
            $this->ControlsVisible["herr_est_cost"] = $this->herr_est_cost->Visible;
            $this->ControlsVisible["meta_herr_est_cost"] = $this->meta_herr_est_cost->Visible;
            $this->ControlsVisible["totreq_serv"] = $this->totreq_serv->Visible;
            $this->ControlsVisible["req_serv"] = $this->req_serv->Visible;
            $this->ControlsVisible["meta_req_serv"] = $this->meta_req_serv->Visible;
            $this->ControlsVisible["totcumpl_req_func"] = $this->totcumpl_req_func->Visible;
            $this->ControlsVisible["cumpl_req_func"] = $this->cumpl_req_func->Visible;
            $this->ControlsVisible["meta_cumpl_req_func"] = $this->meta_cumpl_req_func->Visible;
            $this->ControlsVisible["totcalidad_prod_term"] = $this->totcalidad_prod_term->Visible;
            $this->ControlsVisible["calidad_prod_term"] = $this->calidad_prod_term->Visible;
            $this->ControlsVisible["meta_calidad_prod_term"] = $this->meta_calidad_prod_term->Visible;
            $this->ControlsVisible["totretr_entregable"] = $this->totretr_entregable->Visible;
            $this->ControlsVisible["retr_entregable"] = $this->retr_entregable->Visible;
            $this->ControlsVisible["meta_retr_entregable"] = $this->meta_retr_entregable->Visible;
            $this->ControlsVisible["totcal_cod"] = $this->totcal_cod->Visible;
            $this->ControlsVisible["cal_cod"] = $this->cal_cod->Visible;
            $this->ControlsVisible["meta_cal_cod"] = $this->meta_cal_cod->Visible;
            $this->ControlsVisible["totdef_fug_amb_prod"] = $this->totdef_fug_amb_prod->Visible;
            $this->ControlsVisible["def_fug_amb_prod"] = $this->def_fug_amb_prod->Visible;
            $this->ControlsVisible["meta_def_fug_amb_prod"] = $this->meta_def_fug_amb_prod->Visible;
            $this->ControlsVisible["imgherr_est_cost"] = $this->imgherr_est_cost->Visible;
            $this->ControlsVisible["imgreq_serv"] = $this->imgreq_serv->Visible;
            $this->ControlsVisible["imgcumpl_req_func"] = $this->imgcumpl_req_func->Visible;
            $this->ControlsVisible["imgcalidad_prod_term"] = $this->imgcalidad_prod_term->Visible;
            $this->ControlsVisible["imgretr_entregable"] = $this->imgretr_entregable->Visible;
            $this->ControlsVisible["imgcal_cod"] = $this->imgcal_cod->Visible;
            $this->ControlsVisible["imgdef_fug_amb_prod"] = $this->imgdef_fug_amb_prod->Visible;
            $this->ControlsVisible["cumpleninc_tiempoasignacion"] = $this->cumpleninc_tiempoasignacion->Visible;
            $this->ControlsVisible["totinc_tiempoasignacion"] = $this->totinc_tiempoasignacion->Visible;
            $this->ControlsVisible["inc_tiempoasignacion"] = $this->inc_tiempoasignacion->Visible;
            $this->ControlsVisible["meta_inc_tiempoasignacion"] = $this->meta_inc_tiempoasignacion->Visible;
            $this->ControlsVisible["cumpleninc_tiemposolucion"] = $this->cumpleninc_tiemposolucion->Visible;
            $this->ControlsVisible["totinc_tiemposolucion"] = $this->totinc_tiemposolucion->Visible;
            $this->ControlsVisible["inc_tiemposolucion"] = $this->inc_tiemposolucion->Visible;
            $this->ControlsVisible["meta_inc_tiemposolucion"] = $this->meta_inc_tiemposolucion->Visible;
            $this->ControlsVisible["imginc_tiempoasignacion"] = $this->imginc_tiempoasignacion->Visible;
            $this->ControlsVisible["imginc_tiemposolucion"] = $this->imginc_tiemposolucion->Visible;
            $this->ControlsVisible["imgefic_presup"] = $this->imgefic_presup->Visible;
            $this->ControlsVisible["cumplenefic_presup"] = $this->cumplenefic_presup->Visible;
            $this->ControlsVisible["totefic_presup"] = $this->totefic_presup->Visible;
            $this->ControlsVisible["efic_presup"] = $this->efic_presup->Visible;
            $this->ControlsVisible["meta_efic_presup"] = $this->meta_efic_presup->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->cumplenherr_est_cost->SetValue($this->DataSource->cumplenherr_est_cost->GetValue());
                $this->cumplenreq_serv->SetValue($this->DataSource->cumplenreq_serv->GetValue());
                $this->cumplencumpl_req_func->SetValue($this->DataSource->cumplencumpl_req_func->GetValue());
                $this->cumplencalidad_prod_term->SetValue($this->DataSource->cumplencalidad_prod_term->GetValue());
                $this->cumplenretr_entregable->SetValue($this->DataSource->cumplenretr_entregable->GetValue());
                $this->cumplencal_cod->SetValue($this->DataSource->cumplencal_cod->GetValue());
                $this->cumplendef_fug_amb_prod->SetValue($this->DataSource->cumplendef_fug_amb_prod->GetValue());
                $this->totherr_est_cost->SetValue($this->DataSource->totherr_est_cost->GetValue());
                $this->herr_est_cost->SetValue($this->DataSource->herr_est_cost->GetValue());
                $this->meta_herr_est_cost->SetValue($this->DataSource->meta_herr_est_cost->GetValue());
                $this->totreq_serv->SetValue($this->DataSource->totreq_serv->GetValue());
                $this->req_serv->SetValue($this->DataSource->req_serv->GetValue());
                $this->meta_req_serv->SetValue($this->DataSource->meta_req_serv->GetValue());
                $this->totcumpl_req_func->SetValue($this->DataSource->totcumpl_req_func->GetValue());
                $this->cumpl_req_func->SetValue($this->DataSource->cumpl_req_func->GetValue());
                $this->meta_cumpl_req_func->SetValue($this->DataSource->meta_cumpl_req_func->GetValue());
                $this->totcalidad_prod_term->SetValue($this->DataSource->totcalidad_prod_term->GetValue());
                $this->calidad_prod_term->SetValue($this->DataSource->calidad_prod_term->GetValue());
                $this->meta_calidad_prod_term->SetValue($this->DataSource->meta_calidad_prod_term->GetValue());
                $this->totretr_entregable->SetValue($this->DataSource->totretr_entregable->GetValue());
                $this->retr_entregable->SetValue($this->DataSource->retr_entregable->GetValue());
                $this->meta_retr_entregable->SetValue($this->DataSource->meta_retr_entregable->GetValue());
                $this->totcal_cod->SetValue($this->DataSource->totcal_cod->GetValue());
                $this->cal_cod->SetValue($this->DataSource->cal_cod->GetValue());
                $this->meta_cal_cod->SetValue($this->DataSource->meta_cal_cod->GetValue());
                $this->totdef_fug_amb_prod->SetValue($this->DataSource->totdef_fug_amb_prod->GetValue());
                $this->def_fug_amb_prod->SetValue($this->DataSource->def_fug_amb_prod->GetValue());
                $this->meta_def_fug_amb_prod->SetValue($this->DataSource->meta_def_fug_amb_prod->GetValue());
                $this->cumpleninc_tiempoasignacion->SetValue($this->DataSource->cumpleninc_tiempoasignacion->GetValue());
                $this->totinc_tiempoasignacion->SetValue($this->DataSource->totinc_tiempoasignacion->GetValue());
                $this->inc_tiempoasignacion->SetValue($this->DataSource->inc_tiempoasignacion->GetValue());
                $this->meta_inc_tiempoasignacion->SetValue($this->DataSource->meta_inc_tiempoasignacion->GetValue());
                $this->cumpleninc_tiemposolucion->SetValue($this->DataSource->cumpleninc_tiemposolucion->GetValue());
                $this->totinc_tiemposolucion->SetValue($this->DataSource->totinc_tiemposolucion->GetValue());
                $this->inc_tiemposolucion->SetValue($this->DataSource->inc_tiemposolucion->GetValue());
                $this->meta_inc_tiemposolucion->SetValue($this->DataSource->meta_inc_tiemposolucion->GetValue());
                $this->cumplenefic_presup->SetValue($this->DataSource->cumplenefic_presup->GetValue());
                $this->totefic_presup->SetValue($this->DataSource->totefic_presup->GetValue());
                $this->efic_presup->SetValue($this->DataSource->efic_presup->GetValue());
                $this->meta_efic_presup->SetValue($this->DataSource->meta_efic_presup->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->descripcion->Show();
                $this->cumplenherr_est_cost->Show();
                $this->cumplenreq_serv->Show();
                $this->cumplencumpl_req_func->Show();
                $this->cumplencalidad_prod_term->Show();
                $this->cumplenretr_entregable->Show();
                $this->cumplencal_cod->Show();
                $this->cumplendef_fug_amb_prod->Show();
                $this->totherr_est_cost->Show();
                $this->herr_est_cost->Show();
                $this->meta_herr_est_cost->Show();
                $this->totreq_serv->Show();
                $this->req_serv->Show();
                $this->meta_req_serv->Show();
                $this->totcumpl_req_func->Show();
                $this->cumpl_req_func->Show();
                $this->meta_cumpl_req_func->Show();
                $this->totcalidad_prod_term->Show();
                $this->calidad_prod_term->Show();
                $this->meta_calidad_prod_term->Show();
                $this->totretr_entregable->Show();
                $this->retr_entregable->Show();
                $this->meta_retr_entregable->Show();
                $this->totcal_cod->Show();
                $this->cal_cod->Show();
                $this->meta_cal_cod->Show();
                $this->totdef_fug_amb_prod->Show();
                $this->def_fug_amb_prod->Show();
                $this->meta_def_fug_amb_prod->Show();
                $this->imgherr_est_cost->Show();
                $this->imgreq_serv->Show();
                $this->imgcumpl_req_func->Show();
                $this->imgcalidad_prod_term->Show();
                $this->imgretr_entregable->Show();
                $this->imgcal_cod->Show();
                $this->imgdef_fug_amb_prod->Show();
                $this->cumpleninc_tiempoasignacion->Show();
                $this->totinc_tiempoasignacion->Show();
                $this->inc_tiempoasignacion->Show();
                $this->meta_inc_tiempoasignacion->Show();
                $this->cumpleninc_tiemposolucion->Show();
                $this->totinc_tiemposolucion->Show();
                $this->inc_tiemposolucion->Show();
                $this->meta_inc_tiemposolucion->Show();
                $this->imginc_tiempoasignacion->Show();
                $this->imginc_tiemposolucion->Show();
                $this->imgefic_presup->Show();
                $this->cumplenefic_presup->Show();
                $this->totefic_presup->Show();
                $this->efic_presup->Show();
                $this->meta_efic_presup->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->Sorter_descripcion->Show();
        $this->Sorter_cumplenherr_est_cost->Show();
        $this->Sorter_cumplenreq_serv->Show();
        $this->Sorter_cumplencumpl_req_func->Show();
        $this->Sorter_cumplencalidad_prod_term->Show();
        $this->Sorter_cumplenretr_entregable->Show();
        $this->Sorter_cumplencal_cod->Show();
        $this->Sorter_cumplendef_fug_amb_prod->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-0DABB770
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplenherr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplenreq_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplencumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplencalidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplenretr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplencal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplendef_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totherr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->herr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_herr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totreq_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->req_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_req_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totcumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_cumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totcalidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->calidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_calidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totretr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->retr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_retr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totcal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_cal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totdef_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->def_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_def_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgherr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgreq_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgcumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgcalidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgretr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgcal_cod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgdef_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumpleninc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totinc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->inc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_inc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumpleninc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totinc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->inc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_inc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imginc_tiempoasignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imginc_tiemposolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imgefic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumplenefic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->totefic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->efic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meta_efic_presup->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid1 Class @2-FCB6E20C

class clsGrid1DataSource extends clsDBcon_xls {  //Grid1DataSource Class @2-4A4C3D6C

//DataSource Variables @2-BCED2BEC
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $descripcion;
    public $cumplenherr_est_cost;
    public $cumplenreq_serv;
    public $cumplencumpl_req_func;
    public $cumplencalidad_prod_term;
    public $cumplenretr_entregable;
    public $cumplencal_cod;
    public $cumplendef_fug_amb_prod;
    public $totherr_est_cost;
    public $herr_est_cost;
    public $meta_herr_est_cost;
    public $totreq_serv;
    public $req_serv;
    public $meta_req_serv;
    public $totcumpl_req_func;
    public $cumpl_req_func;
    public $meta_cumpl_req_func;
    public $totcalidad_prod_term;
    public $calidad_prod_term;
    public $meta_calidad_prod_term;
    public $totretr_entregable;
    public $retr_entregable;
    public $meta_retr_entregable;
    public $totcal_cod;
    public $cal_cod;
    public $meta_cal_cod;
    public $totdef_fug_amb_prod;
    public $def_fug_amb_prod;
    public $meta_def_fug_amb_prod;
    public $cumpleninc_tiempoasignacion;
    public $totinc_tiempoasignacion;
    public $inc_tiempoasignacion;
    public $meta_inc_tiempoasignacion;
    public $cumpleninc_tiemposolucion;
    public $totinc_tiemposolucion;
    public $inc_tiemposolucion;
    public $meta_inc_tiemposolucion;
    public $cumplenefic_presup;
    public $totefic_presup;
    public $efic_presup;
    public $meta_efic_presup;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EDC0C6FE
    function clsGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid1";
        $this->Initialize();
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->cumplenherr_est_cost = new clsField("cumplenherr_est_cost", ccsInteger, "");
        
        $this->cumplenreq_serv = new clsField("cumplenreq_serv", ccsInteger, "");
        
        $this->cumplencumpl_req_func = new clsField("cumplencumpl_req_func", ccsInteger, "");
        
        $this->cumplencalidad_prod_term = new clsField("cumplencalidad_prod_term", ccsInteger, "");
        
        $this->cumplenretr_entregable = new clsField("cumplenretr_entregable", ccsInteger, "");
        
        $this->cumplencal_cod = new clsField("cumplencal_cod", ccsInteger, "");
        
        $this->cumplendef_fug_amb_prod = new clsField("cumplendef_fug_amb_prod", ccsInteger, "");
        
        $this->totherr_est_cost = new clsField("totherr_est_cost", ccsInteger, "");
        
        $this->herr_est_cost = new clsField("herr_est_cost", ccsText, "");
        
        $this->meta_herr_est_cost = new clsField("meta_herr_est_cost", ccsFloat, "");
        
        $this->totreq_serv = new clsField("totreq_serv", ccsInteger, "");
        
        $this->req_serv = new clsField("req_serv", ccsText, "");
        
        $this->meta_req_serv = new clsField("meta_req_serv", ccsFloat, "");
        
        $this->totcumpl_req_func = new clsField("totcumpl_req_func", ccsInteger, "");
        
        $this->cumpl_req_func = new clsField("cumpl_req_func", ccsText, "");
        
        $this->meta_cumpl_req_func = new clsField("meta_cumpl_req_func", ccsFloat, "");
        
        $this->totcalidad_prod_term = new clsField("totcalidad_prod_term", ccsInteger, "");
        
        $this->calidad_prod_term = new clsField("calidad_prod_term", ccsText, "");
        
        $this->meta_calidad_prod_term = new clsField("meta_calidad_prod_term", ccsFloat, "");
        
        $this->totretr_entregable = new clsField("totretr_entregable", ccsInteger, "");
        
        $this->retr_entregable = new clsField("retr_entregable", ccsText, "");
        
        $this->meta_retr_entregable = new clsField("meta_retr_entregable", ccsFloat, "");
        
        $this->totcal_cod = new clsField("totcal_cod", ccsInteger, "");
        
        $this->cal_cod = new clsField("cal_cod", ccsText, "");
        
        $this->meta_cal_cod = new clsField("meta_cal_cod", ccsFloat, "");
        
        $this->totdef_fug_amb_prod = new clsField("totdef_fug_amb_prod", ccsInteger, "");
        
        $this->def_fug_amb_prod = new clsField("def_fug_amb_prod", ccsText, "");
        
        $this->meta_def_fug_amb_prod = new clsField("meta_def_fug_amb_prod", ccsFloat, "");
        
        $this->cumpleninc_tiempoasignacion = new clsField("cumpleninc_tiempoasignacion", ccsInteger, "");
        
        $this->totinc_tiempoasignacion = new clsField("totinc_tiempoasignacion", ccsInteger, "");
        
        $this->inc_tiempoasignacion = new clsField("inc_tiempoasignacion", ccsText, "");
        
        $this->meta_inc_tiempoasignacion = new clsField("meta_inc_tiempoasignacion", ccsInteger, "");
        
        $this->cumpleninc_tiemposolucion = new clsField("cumpleninc_tiemposolucion", ccsInteger, "");
        
        $this->totinc_tiemposolucion = new clsField("totinc_tiemposolucion", ccsInteger, "");
        
        $this->inc_tiemposolucion = new clsField("inc_tiemposolucion", ccsText, "");
        
        $this->meta_inc_tiemposolucion = new clsField("meta_inc_tiemposolucion", ccsInteger, "");
        
        $this->cumplenefic_presup = new clsField("cumplenefic_presup", ccsInteger, "");
        
        $this->totefic_presup = new clsField("totefic_presup", ccsInteger, "");
        
        $this->efic_presup = new clsField("efic_presup", ccsText, "");
        
        $this->meta_efic_presup = new clsField("meta_efic_presup", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B02EE738
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_descripcion" => array("descripcion", ""), 
            "Sorter_cumplenherr_est_cost" => array("cumplenherr_est_cost", ""), 
            "Sorter_cumplenreq_serv" => array("cumplenreq_serv", ""), 
            "Sorter_cumplencumpl_req_func" => array("cumplencumpl_req_func", ""), 
            "Sorter_cumplencalidad_prod_term" => array("cumplencalidad_prod_term", ""), 
            "Sorter_cumplenretr_entregable" => array("cumplenretr_entregable", ""), 
            "Sorter_cumplencal_cod" => array("cumplencal_cod", ""), 
            "Sorter_cumplendef_fug_amb_prod" => array("cumplendef_fug_amb_prod", "")));
    }
//End SetOrder Method

//Prepare Method @2-D4D298C1
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], 0, false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], "", false);
    }
//End Prepare Method

//Open Method @2-78AB5C93
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select  sc.descripcion,\n" .
        "	 count(herr_est_cost) totherr_est_cost, \n" .
        "		sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end) cumplenherr_est_cost, \n" .
        "		case when count(herr_est_cost)>0 then \n" .
        "			sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end)/count(herr_est_cost)*100 \n" .
        "		else 0 end herr_est_cost,\n" .
        "	 (select meta from mc_c_metrica where acronimo='herr_est_cost') as meta_herr_est_cost,\n" .
        "	 count(req_serv) totreq_serv, \n" .
        "		sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end) cumplenreq_serv, \n" .
        "		case when count(req_serv)>0 then \n" .
        "			sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end)/count(req_serv)*100 \n" .
        "		else 0 end req_serv,\n" .
        "	 (select meta from mc_c_metrica where acronimo='req_serv') as meta_req_serv,\n" .
        "	 count(cumpl_req_func) totcumpl_req_func, \n" .
        "		sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end) cumplencumpl_req_func, \n" .
        "		case when count(cumpl_req_func)>0 then \n" .
        "			sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end)/count(cumpl_req_func)*100 \n" .
        "		else 0 end cumpl_req_func ,\n" .
        "	 (select meta from mc_c_metrica where acronimo='cumpl_req_func') as meta_cumpl_req_func,\n" .
        "	 count(calidad_prod_term) totcalidad_prod_term, \n" .
        "		sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end) cumplencalidad_prod_term, \n" .
        "		case when count(calidad_prod_term)>0 then \n" .
        "			sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end)/count(calidad_prod_term)*100 \n" .
        "		else 0 end calidad_prod_term,\n" .
        "	 (select meta from mc_c_metrica where acronimo='calidad_prod_term') as meta_calidad_prod_term,\n" .
        "	 count(retr_entregable) totretr_entregable, \n" .
        "		sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end) cumplenretr_entregable, \n" .
        "		case when count(retr_entregable)>0 then \n" .
        "			sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end)/count(retr_entregable)*100 \n" .
        "		else 0 end retr_entregable,\n" .
        "	 (select meta from mc_c_metrica where acronimo='retr_entregable') as meta_retr_entregable,\n" .
        "	 count(calidad_codigo) totcal_cod, \n" .
        "		sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end) cumplencal_cod, \n" .
        "		case when count(calidad_codigo)>0 then \n" .
        "			sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end)/count(calidad_codigo)*100 \n" .
        "		else 0 end cal_cod,\n" .
        "	 (select meta from mc_c_metrica where acronimo='cal_cod') as meta_cal_cod,\n" .
        "	 count(def_fug_amb_prod) totdef_fug_amb_prod, \n" .
        "		sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end) cumplendef_fug_amb_prod, \n" .
        "		case when count(def_fug_amb_prod)>0 then \n" .
        "			sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end)/count(def_fug_amb_prod)*100  \n" .
        "		else 0 end def_fug_amb_prod,\n" .
        "	 (select meta from mc_c_metrica where acronimo='def_fug_amb_prod') as meta_def_fug_amb_prod,\n" .
        "	 count(cumple_inc_tiempoasignacion) totinc_tiempoasignacion, \n" .
        "		sum(cast(cumple_inc_tiempoasignacion as int)) cumpleninc_tiempoasignacion, \n" .
        "		case when count(cumple_inc_tiempoasignacion)>0 then \n" .
        "			sum(cast(cumple_inc_tiempoasignacion as float))/count(cumple_inc_tiempoasignacion)*100 \n" .
        "		else 0 end inc_tiempoasignacion,\n" .
        "	 (select meta from mc_c_metrica where acronimo='inc_tiempoasignacion') as meta_inc_tiempoasignacion,\n" .
        "	 count(cumple_inc_tiemposolucion) totinc_tiemposolucion, \n" .
        "		sum(cast(cumple_inc_tiemposolucion as int)) cumpleninc_tiemposolucion, \n" .
        "		case when count(cumple_inc_tiemposolucion)>0 then \n" .
        "			sum(cast(cumple_inc_tiemposolucion as float))/count(cumple_inc_tiemposolucion)*100 \n" .
        "		else 0 end inc_tiemposolucion,\n" .
        "	 (select meta from mc_c_metrica where acronimo='inc_tiemposolucion') as meta_inc_tiemposolucion,\n" .
        "	 AVG(Cumple_EF) cumplen_efic_presup, AVG(total_ef) tot_efic_presup, avg(cast(Cumple_EF as float))/avg(total_ef)*100  efic_presup,\n" .
        "	 (Select Meta from mc_c_metrica where acronimo='EFIC_PRESUP') as meta_efic_presup\n" .
        "from mc_c_ServContractual sc \n" .
        "left join (select * from l_calificacion_rs_aut m\n" .
        "	where m.id_periodo=5  and m.id_proveedor = 3 and m.tipo_nivel_servicio ='SLO' and m.estatus ='F' \n" .
        "	and num_carga=(\n" .
        "       select max(b.num_carga)\n" .
        "       from l_calificacion_rs_aut  b\n" .
        "       where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "       and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "       and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'\n" .
        "       and b.estatus='F'\n" .
        "       )) m on sc.Descripcion  = m.servicio_cont  \n" .
        "	 left join	(select cumple_inc_tiempoasignacion, cumple_inc_tiempoSolucion, \n" .
        "				id_proveedor, 'Servicio de Soporte de Aplicaciones'  servicio_cont\n" .
        "				from l_calificacion_incidentes_AUT\n" .
        "				where (id_periodo=" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and b.estatus='F' ) \n" .
        "				) )  mi on  mi.servicio_cont = sc.Descripcion \n" .
        "	left join (select SUM(cast(efic_presupuestal as int)) Cumple_EF, COUNT(efic_presupuestal) Total_EF, Id_Proveedor,  2 IdServicioCont  \n" .
        "			from l_detalle_eficiencia_presupuestal \n" .
        "			where (id_periodo= " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and b.estatus='F' ) \n" .
        "				) group by id_proveedor ) ef on ef.IdServicioCont = sc.id\n" .
        "where sc.Aplica ='CDS' and IdOld <>0\n" .
        "group by sc.Descripcion ) cnt";
        $this->SQL = "select  sc.descripcion,\n" .
        "	 count(herr_est_cost) totherr_est_cost, \n" .
        "		sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end) cumplenherr_est_cost, \n" .
        "		case when count(herr_est_cost)>0 then \n" .
        "			sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end)/count(herr_est_cost)*100 \n" .
        "		else 0 end herr_est_cost,\n" .
        "	 (select meta from mc_c_metrica where acronimo='herr_est_cost') as meta_herr_est_cost,\n" .
        "	 count(req_serv) totreq_serv, \n" .
        "		sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end) cumplenreq_serv, \n" .
        "		case when count(req_serv)>0 then \n" .
        "			sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end)/count(req_serv)*100 \n" .
        "		else 0 end req_serv,\n" .
        "	 (select meta from mc_c_metrica where acronimo='req_serv') as meta_req_serv,\n" .
        "	 count(cumpl_req_func) totcumpl_req_func, \n" .
        "		sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end) cumplencumpl_req_func, \n" .
        "		case when count(cumpl_req_func)>0 then \n" .
        "			sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end)/count(cumpl_req_func)*100 \n" .
        "		else 0 end cumpl_req_func ,\n" .
        "	 (select meta from mc_c_metrica where acronimo='cumpl_req_func') as meta_cumpl_req_func,\n" .
        "	 count(calidad_prod_term) totcalidad_prod_term, \n" .
        "		sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end) cumplencalidad_prod_term, \n" .
        "		case when count(calidad_prod_term)>0 then \n" .
        "			sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end)/count(calidad_prod_term)*100 \n" .
        "		else 0 end calidad_prod_term,\n" .
        "	 (select meta from mc_c_metrica where acronimo='calidad_prod_term') as meta_calidad_prod_term,\n" .
        "	 count(retr_entregable) totretr_entregable, \n" .
        "		sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end) cumplenretr_entregable, \n" .
        "		case when count(retr_entregable)>0 then \n" .
        "			sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end)/count(retr_entregable)*100 \n" .
        "		else 0 end retr_entregable,\n" .
        "	 (select meta from mc_c_metrica where acronimo='retr_entregable') as meta_retr_entregable,\n" .
        "	 count(calidad_codigo) totcal_cod, \n" .
        "		sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end) cumplencal_cod, \n" .
        "		case when count(calidad_codigo)>0 then \n" .
        "			sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end)/count(calidad_codigo)*100 \n" .
        "		else 0 end cal_cod,\n" .
        "	 (select meta from mc_c_metrica where acronimo='cal_cod') as meta_cal_cod,\n" .
        "	 count(def_fug_amb_prod) totdef_fug_amb_prod, \n" .
        "		sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end) cumplendef_fug_amb_prod, \n" .
        "		case when count(def_fug_amb_prod)>0 then \n" .
        "			sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end)/count(def_fug_amb_prod)*100  \n" .
        "		else 0 end def_fug_amb_prod,\n" .
        "	 (select meta from mc_c_metrica where acronimo='def_fug_amb_prod') as meta_def_fug_amb_prod,\n" .
        "	 count(cumple_inc_tiempoasignacion) totinc_tiempoasignacion, \n" .
        "		sum(cast(cumple_inc_tiempoasignacion as int)) cumpleninc_tiempoasignacion, \n" .
        "		case when count(cumple_inc_tiempoasignacion)>0 then \n" .
        "			sum(cast(cumple_inc_tiempoasignacion as float))/count(cumple_inc_tiempoasignacion)*100 \n" .
        "		else 0 end inc_tiempoasignacion,\n" .
        "	 (select meta from mc_c_metrica where acronimo='inc_tiempoasignacion') as meta_inc_tiempoasignacion,\n" .
        "	 count(cumple_inc_tiemposolucion) totinc_tiemposolucion, \n" .
        "		sum(cast(cumple_inc_tiemposolucion as int)) cumpleninc_tiemposolucion, \n" .
        "		case when count(cumple_inc_tiemposolucion)>0 then \n" .
        "			sum(cast(cumple_inc_tiemposolucion as float))/count(cumple_inc_tiemposolucion)*100 \n" .
        "		else 0 end inc_tiemposolucion,\n" .
        "	 (select meta from mc_c_metrica where acronimo='inc_tiemposolucion') as meta_inc_tiemposolucion,\n" .
        "	 AVG(Cumple_EF) cumplen_efic_presup, AVG(total_ef) tot_efic_presup, avg(cast(Cumple_EF as float))/avg(total_ef)*100  efic_presup,\n" .
        "	 (Select Meta from mc_c_metrica where acronimo='EFIC_PRESUP') as meta_efic_presup\n" .
        "from mc_c_ServContractual sc \n" .
        "left join (select * from l_calificacion_rs_aut m\n" .
        "	where m.id_periodo=5  and m.id_proveedor = 3 and m.tipo_nivel_servicio ='SLO' and m.estatus ='F' \n" .
        "	and num_carga=(\n" .
        "       select max(b.num_carga)\n" .
        "       from l_calificacion_rs_aut  b\n" .
        "       where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "       and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "       and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'\n" .
        "       and b.estatus='F'\n" .
        "       )) m on sc.Descripcion  = m.servicio_cont  \n" .
        "	 left join	(select cumple_inc_tiempoasignacion, cumple_inc_tiempoSolucion, \n" .
        "				id_proveedor, 'Servicio de Soporte de Aplicaciones'  servicio_cont\n" .
        "				from l_calificacion_incidentes_AUT\n" .
        "				where (id_periodo=" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and b.estatus='F' ) \n" .
        "				) )  mi on  mi.servicio_cont = sc.Descripcion \n" .
        "	left join (select SUM(cast(efic_presupuestal as int)) Cumple_EF, COUNT(efic_presupuestal) Total_EF, Id_Proveedor,  2 IdServicioCont  \n" .
        "			from l_detalle_eficiencia_presupuestal \n" .
        "			where (id_periodo= " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and b.estatus='F' ) \n" .
        "				) group by id_proveedor ) ef on ef.IdServicioCont = sc.id\n" .
        "where sc.Aplica ='CDS' and IdOld <>0\n" .
        "group by sc.Descripcion ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @2-6AF500D5
    function SetValues()
    {
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->cumplenherr_est_cost->SetDBValue(trim($this->f("cumplenherr_est_cost")));
        $this->cumplenreq_serv->SetDBValue(trim($this->f("cumplenreq_serv")));
        $this->cumplencumpl_req_func->SetDBValue(trim($this->f("cumplencumpl_req_func")));
        $this->cumplencalidad_prod_term->SetDBValue(trim($this->f("cumplencalidad_prod_term")));
        $this->cumplenretr_entregable->SetDBValue(trim($this->f("cumplenretr_entregable")));
        $this->cumplencal_cod->SetDBValue(trim($this->f("cumplencal_cod")));
        $this->cumplendef_fug_amb_prod->SetDBValue(trim($this->f("cumplendef_fug_amb_prod")));
        $this->totherr_est_cost->SetDBValue(trim($this->f("totherr_est_cost")));
        $this->herr_est_cost->SetDBValue($this->f("herr_est_cost"));
        $this->meta_herr_est_cost->SetDBValue(trim($this->f("meta_herr_est_cost")));
        $this->totreq_serv->SetDBValue(trim($this->f("totreq_serv")));
        $this->req_serv->SetDBValue($this->f("req_serv"));
        $this->meta_req_serv->SetDBValue(trim($this->f("meta_req_serv")));
        $this->totcumpl_req_func->SetDBValue(trim($this->f("totcumpl_req_func")));
        $this->cumpl_req_func->SetDBValue($this->f("cumpl_req_func"));
        $this->meta_cumpl_req_func->SetDBValue(trim($this->f("meta_cumpl_req_func")));
        $this->totcalidad_prod_term->SetDBValue(trim($this->f("totcalidad_prod_term")));
        $this->calidad_prod_term->SetDBValue($this->f("calidad_prod_term"));
        $this->meta_calidad_prod_term->SetDBValue(trim($this->f("meta_calidad_prod_term")));
        $this->totretr_entregable->SetDBValue(trim($this->f("totretr_entregable")));
        $this->retr_entregable->SetDBValue($this->f("retr_entregable"));
        $this->meta_retr_entregable->SetDBValue(trim($this->f("meta_retr_entregable")));
        $this->totcal_cod->SetDBValue(trim($this->f("totcal_cod")));
        $this->cal_cod->SetDBValue($this->f("cal_cod"));
        $this->meta_cal_cod->SetDBValue(trim($this->f("meta_cal_cod")));
        $this->totdef_fug_amb_prod->SetDBValue(trim($this->f("totdef_fug_amb_prod")));
        $this->def_fug_amb_prod->SetDBValue($this->f("def_fug_amb_prod"));
        $this->meta_def_fug_amb_prod->SetDBValue(trim($this->f("meta_def_fug_amb_prod")));
        $this->cumpleninc_tiempoasignacion->SetDBValue(trim($this->f("cumpleninc_tiempoasignacion")));
        $this->totinc_tiempoasignacion->SetDBValue(trim($this->f("totinc_tiempoasignacion")));
        $this->inc_tiempoasignacion->SetDBValue($this->f("inc_tiempoasignacion"));
        $this->meta_inc_tiempoasignacion->SetDBValue(trim($this->f("meta_inc_tiempoasignacion")));
        $this->cumpleninc_tiemposolucion->SetDBValue(trim($this->f("cumpleninc_tiemposolucion")));
        $this->totinc_tiemposolucion->SetDBValue(trim($this->f("totinc_tiemposolucion")));
        $this->inc_tiemposolucion->SetDBValue($this->f("inc_tiemposolucion"));
        $this->meta_inc_tiemposolucion->SetDBValue(trim($this->f("meta_inc_tiemposolucion")));
        $this->cumplenefic_presup->SetDBValue(trim($this->f("cumplen_efic_presup")));
        $this->totefic_presup->SetDBValue(trim($this->f("tot_efic_presup")));
        $this->efic_presup->SetDBValue($this->f("efic_presup"));
        $this->meta_efic_presup->SetDBValue($this->f("meta_efic_presup"));
    }
//End SetValues Method

} //End Grid1DataSource Class @2-FCB6E20C

//Initialize Page @1-99980E34
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";
$TemplateSource = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "TableroNiveles.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F3EFFD04
include_once("./TableroNiveles_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E1DA0C9A
$DBcon_xls = new clsDBcon_xls();
$MainPage->Connections["con_xls"] = & $DBcon_xls;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$Grid1 = new clsGridGrid1("", $MainPage);
$MainPage->Grid1 = & $Grid1;
$Grid1->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-FA3E6D4A
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
if (strlen($TemplateSource)) {
    $Tpl->LoadTemplateFromStr($TemplateSource, $BlockToParse, "CP1252");
} else {
    $Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
}
$Tpl->SetVar("CCS_PathToRoot", $PathToRoot);
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-4C5812F4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($Grid1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-ED8D35E1
$Grid1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $TemplateEncoding);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E9C658CF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($Grid1);
unset($Tpl);
//End Unload Page