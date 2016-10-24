<?php
//Include Common Files @1-47B1B58B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "historico_cargas_rs2.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



//Include Page implementation @56-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation



class clsGridl_detalle_medicion_apertu { //l_detalle_medicion_apertu class @99-0B47FC9B

//Variables @99-CF823BBC

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
    public $Sorter_contador;
    public $Sorter_servicio_negocio;
    public $Sorter_id_ppmc;
    public $Sorter_id_estimacion;
    public $Sorter_descripcion;
    public $Sorter_herr_est_cost;
    public $Sorter_req_serv;
    public $Sorter_fecha_asignacion;
    public $Sorter_fecha_entrega_prop;
    public $Sorter_fecha_acepta_prop;
    public $Sorter_horas_aprobadas;
    public $Sorter_tiempo_limite_entrega_prop;
    public $Sorter_observaciones;
    public $Sorter_tipo;
    public $Sorter_serv_contractual;
    public $Sorter_total_unidades;
    public $Sorter_tipo_unidades;
    public $Sorter_ppmc_padre;
    public $Sorter_tipo_padre;
//End Variables

//Class_Initialize Event @99-6E100E49
    function clsGridl_detalle_medicion_apertu($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "l_detalle_medicion_apertu";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid l_detalle_medicion_apertu";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsl_detalle_medicion_apertuDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("l_detalle_medicion_apertuOrder", "");
        $this->SorterDirection = CCGetParam("l_detalle_medicion_apertuDir", "");

        $this->contador = new clsControl(ccsLabel, "contador", "contador", ccsInteger, "", CCGetRequestParam("contador", ccsGet, NULL), $this);
        $this->servicio_negocio = new clsControl(ccsLabel, "servicio_negocio", "servicio_negocio", ccsText, "", CCGetRequestParam("servicio_negocio", ccsGet, NULL), $this);
        $this->id_ppmc = new clsControl(ccsLabel, "id_ppmc", "id_ppmc", ccsText, "", CCGetRequestParam("id_ppmc", ccsGet, NULL), $this);
        $this->id_estimacion = new clsControl(ccsLabel, "id_estimacion", "id_estimacion", ccsText, "", CCGetRequestParam("id_estimacion", ccsGet, NULL), $this);
        $this->descripcion = new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->herr_est_cost = new clsControl(ccsImage, "herr_est_cost", "herr_est_cost", ccsText, "", CCGetRequestParam("herr_est_cost", ccsGet, NULL), $this);
        $this->req_serv = new clsControl(ccsImage, "req_serv", "req_serv", ccsText, "", CCGetRequestParam("req_serv", ccsGet, NULL), $this);
        $this->fecha_asignacion = new clsControl(ccsLabel, "fecha_asignacion", "fecha_asignacion", ccsDate, array("dd", "/", "mm", "/", "yyyy", " ", "H", ":", "nn"), CCGetRequestParam("fecha_asignacion", ccsGet, NULL), $this);
        $this->fecha_entrega_prop = new clsControl(ccsLabel, "fecha_entrega_prop", "fecha_entrega_prop", ccsDate, array("dd", "/", "mm", "/", "yyyy", " ", "H", ":", "nn"), CCGetRequestParam("fecha_entrega_prop", ccsGet, NULL), $this);
        $this->fecha_acepta_prop = new clsControl(ccsLabel, "fecha_acepta_prop", "fecha_acepta_prop", ccsDate, array("dd", "/", "mm", "/", "yyyy", "  ", "H", ":", "nn"), CCGetRequestParam("fecha_acepta_prop", ccsGet, NULL), $this);
        $this->horas_aprobadas = new clsControl(ccsLabel, "horas_aprobadas", "horas_aprobadas", ccsText, "", CCGetRequestParam("horas_aprobadas", ccsGet, NULL), $this);
        $this->tiempo_limite_entrega_prop = new clsControl(ccsLabel, "tiempo_limite_entrega_prop", "tiempo_limite_entrega_prop", ccsText, "", CCGetRequestParam("tiempo_limite_entrega_prop", ccsGet, NULL), $this);
        $this->observaciones = new clsControl(ccsLabel, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", ccsGet, NULL), $this);
        $this->tipo = new clsControl(ccsLabel, "tipo", "tipo", ccsText, "", CCGetRequestParam("tipo", ccsGet, NULL), $this);
        $this->serv_contractual = new clsControl(ccsLabel, "serv_contractual", "serv_contractual", ccsText, "", CCGetRequestParam("serv_contractual", ccsGet, NULL), $this);
        $this->total_unidades = new clsControl(ccsLabel, "total_unidades", "total_unidades", ccsText, "", CCGetRequestParam("total_unidades", ccsGet, NULL), $this);
        $this->tipo_unidades = new clsControl(ccsLabel, "tipo_unidades", "tipo_unidades", ccsText, "", CCGetRequestParam("tipo_unidades", ccsGet, NULL), $this);
        $this->ppmc_padre = new clsControl(ccsLabel, "ppmc_padre", "ppmc_padre", ccsText, "", CCGetRequestParam("ppmc_padre", ccsGet, NULL), $this);
        $this->tipo_padre = new clsControl(ccsLabel, "tipo_padre", "tipo_padre", ccsText, "", CCGetRequestParam("tipo_padre", ccsGet, NULL), $this);
        $this->lb_apert_herr_est_cost = new clsControl(ccsLabel, "lb_apert_herr_est_cost", "lb_apert_herr_est_cost", ccsText, "", CCGetRequestParam("lb_apert_herr_est_cost", ccsGet, NULL), $this);
        $this->lb_apert_req_serv = new clsControl(ccsLabel, "lb_apert_req_serv", "lb_apert_req_serv", ccsText, "", CCGetRequestParam("lb_apert_req_serv", ccsGet, NULL), $this);
        $this->l_detalle_medicion_apertu_TotalRecords = new clsControl(ccsLabel, "l_detalle_medicion_apertu_TotalRecords", "l_detalle_medicion_apertu_TotalRecords", ccsText, "", CCGetRequestParam("l_detalle_medicion_apertu_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_contador = new clsSorter($this->ComponentName, "Sorter_contador", $FileName, $this);
        $this->Sorter_servicio_negocio = new clsSorter($this->ComponentName, "Sorter_servicio_negocio", $FileName, $this);
        $this->Sorter_id_ppmc = new clsSorter($this->ComponentName, "Sorter_id_ppmc", $FileName, $this);
        $this->Sorter_id_estimacion = new clsSorter($this->ComponentName, "Sorter_id_estimacion", $FileName, $this);
        $this->Sorter_descripcion = new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
        $this->Sorter_herr_est_cost = new clsSorter($this->ComponentName, "Sorter_herr_est_cost", $FileName, $this);
        $this->Sorter_req_serv = new clsSorter($this->ComponentName, "Sorter_req_serv", $FileName, $this);
        $this->Sorter_fecha_asignacion = new clsSorter($this->ComponentName, "Sorter_fecha_asignacion", $FileName, $this);
        $this->Sorter_fecha_entrega_prop = new clsSorter($this->ComponentName, "Sorter_fecha_entrega_prop", $FileName, $this);
        $this->Sorter_fecha_acepta_prop = new clsSorter($this->ComponentName, "Sorter_fecha_acepta_prop", $FileName, $this);
        $this->Sorter_horas_aprobadas = new clsSorter($this->ComponentName, "Sorter_horas_aprobadas", $FileName, $this);
        $this->Sorter_tiempo_limite_entrega_prop = new clsSorter($this->ComponentName, "Sorter_tiempo_limite_entrega_prop", $FileName, $this);
        $this->Sorter_observaciones = new clsSorter($this->ComponentName, "Sorter_observaciones", $FileName, $this);
        $this->Sorter_tipo = new clsSorter($this->ComponentName, "Sorter_tipo", $FileName, $this);
        $this->Sorter_serv_contractual = new clsSorter($this->ComponentName, "Sorter_serv_contractual", $FileName, $this);
        $this->Sorter_total_unidades = new clsSorter($this->ComponentName, "Sorter_total_unidades", $FileName, $this);
        $this->Sorter_tipo_unidades = new clsSorter($this->ComponentName, "Sorter_tipo_unidades", $FileName, $this);
        $this->Sorter_ppmc_padre = new clsSorter($this->ComponentName, "Sorter_ppmc_padre", $FileName, $this);
        $this->Sorter_tipo_padre = new clsSorter($this->ComponentName, "Sorter_tipo_padre", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @99-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @99-7EBC43C9
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
            $this->ControlsVisible["contador"] = $this->contador->Visible;
            $this->ControlsVisible["servicio_negocio"] = $this->servicio_negocio->Visible;
            $this->ControlsVisible["id_ppmc"] = $this->id_ppmc->Visible;
            $this->ControlsVisible["id_estimacion"] = $this->id_estimacion->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["herr_est_cost"] = $this->herr_est_cost->Visible;
            $this->ControlsVisible["req_serv"] = $this->req_serv->Visible;
            $this->ControlsVisible["fecha_asignacion"] = $this->fecha_asignacion->Visible;
            $this->ControlsVisible["fecha_entrega_prop"] = $this->fecha_entrega_prop->Visible;
            $this->ControlsVisible["fecha_acepta_prop"] = $this->fecha_acepta_prop->Visible;
            $this->ControlsVisible["horas_aprobadas"] = $this->horas_aprobadas->Visible;
            $this->ControlsVisible["tiempo_limite_entrega_prop"] = $this->tiempo_limite_entrega_prop->Visible;
            $this->ControlsVisible["observaciones"] = $this->observaciones->Visible;
            $this->ControlsVisible["tipo"] = $this->tipo->Visible;
            $this->ControlsVisible["serv_contractual"] = $this->serv_contractual->Visible;
            $this->ControlsVisible["total_unidades"] = $this->total_unidades->Visible;
            $this->ControlsVisible["tipo_unidades"] = $this->tipo_unidades->Visible;
            $this->ControlsVisible["ppmc_padre"] = $this->ppmc_padre->Visible;
            $this->ControlsVisible["tipo_padre"] = $this->tipo_padre->Visible;
            $this->ControlsVisible["lb_apert_herr_est_cost"] = $this->lb_apert_herr_est_cost->Visible;
            $this->ControlsVisible["lb_apert_req_serv"] = $this->lb_apert_req_serv->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->contador->SetValue($this->DataSource->contador->GetValue());
                $this->servicio_negocio->SetValue($this->DataSource->servicio_negocio->GetValue());
                $this->id_ppmc->SetValue($this->DataSource->id_ppmc->GetValue());
                $this->id_estimacion->SetValue($this->DataSource->id_estimacion->GetValue());
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->herr_est_cost->SetValue($this->DataSource->herr_est_cost->GetValue());
                $this->req_serv->SetValue($this->DataSource->req_serv->GetValue());
                $this->fecha_asignacion->SetValue($this->DataSource->fecha_asignacion->GetValue());
                $this->fecha_entrega_prop->SetValue($this->DataSource->fecha_entrega_prop->GetValue());
                $this->fecha_acepta_prop->SetValue($this->DataSource->fecha_acepta_prop->GetValue());
                $this->horas_aprobadas->SetValue($this->DataSource->horas_aprobadas->GetValue());
                $this->tiempo_limite_entrega_prop->SetValue($this->DataSource->tiempo_limite_entrega_prop->GetValue());
                $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                $this->tipo->SetValue($this->DataSource->tipo->GetValue());
                $this->serv_contractual->SetValue($this->DataSource->serv_contractual->GetValue());
                $this->total_unidades->SetValue($this->DataSource->total_unidades->GetValue());
                $this->tipo_unidades->SetValue($this->DataSource->tipo_unidades->GetValue());
                $this->ppmc_padre->SetValue($this->DataSource->ppmc_padre->GetValue());
                $this->tipo_padre->SetValue($this->DataSource->tipo_padre->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->contador->Show();
                $this->servicio_negocio->Show();
                $this->id_ppmc->Show();
                $this->id_estimacion->Show();
                $this->descripcion->Show();
                $this->herr_est_cost->Show();
                $this->req_serv->Show();
                $this->fecha_asignacion->Show();
                $this->fecha_entrega_prop->Show();
                $this->fecha_acepta_prop->Show();
                $this->horas_aprobadas->Show();
                $this->tiempo_limite_entrega_prop->Show();
                $this->observaciones->Show();
                $this->tipo->Show();
                $this->serv_contractual->Show();
                $this->total_unidades->Show();
                $this->tipo_unidades->Show();
                $this->ppmc_padre->Show();
                $this->tipo_padre->Show();
                $this->lb_apert_herr_est_cost->Show();
                $this->lb_apert_req_serv->Show();
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
        $this->l_detalle_medicion_apertu_TotalRecords->Show();
        $this->Sorter_contador->Show();
        $this->Sorter_servicio_negocio->Show();
        $this->Sorter_id_ppmc->Show();
        $this->Sorter_id_estimacion->Show();
        $this->Sorter_descripcion->Show();
        $this->Sorter_herr_est_cost->Show();
        $this->Sorter_req_serv->Show();
        $this->Sorter_fecha_asignacion->Show();
        $this->Sorter_fecha_entrega_prop->Show();
        $this->Sorter_fecha_acepta_prop->Show();
        $this->Sorter_horas_aprobadas->Show();
        $this->Sorter_tiempo_limite_entrega_prop->Show();
        $this->Sorter_observaciones->Show();
        $this->Sorter_tipo->Show();
        $this->Sorter_serv_contractual->Show();
        $this->Sorter_total_unidades->Show();
        $this->Sorter_tipo_unidades->Show();
        $this->Sorter_ppmc_padre->Show();
        $this->Sorter_tipo_padre->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @99-DEF71AD7
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->contador->Errors->ToString());
        $errors = ComposeStrings($errors, $this->servicio_negocio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id_ppmc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id_estimacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->herr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->req_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_asignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_entrega_prop->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_acepta_prop->Errors->ToString());
        $errors = ComposeStrings($errors, $this->horas_aprobadas->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tiempo_limite_entrega_prop->Errors->ToString());
        $errors = ComposeStrings($errors, $this->observaciones->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->serv_contractual->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_unidades->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_unidades->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ppmc_padre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_padre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_apert_herr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_apert_req_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End l_detalle_medicion_apertu Class @99-FCB6E20C

class clsl_detalle_medicion_apertuDataSource extends clsDBcon_xls {  //l_detalle_medicion_apertuDataSource Class @99-CE832DE3

//DataSource Variables @99-4CDDA80D
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $contador;
    public $servicio_negocio;
    public $id_ppmc;
    public $id_estimacion;
    public $descripcion;
    public $herr_est_cost;
    public $req_serv;
    public $fecha_asignacion;
    public $fecha_entrega_prop;
    public $fecha_acepta_prop;
    public $horas_aprobadas;
    public $tiempo_limite_entrega_prop;
    public $observaciones;
    public $tipo;
    public $serv_contractual;
    public $total_unidades;
    public $tipo_unidades;
    public $ppmc_padre;
    public $tipo_padre;
//End DataSource Variables

//DataSourceClass_Initialize Event @99-EFB74BE4
    function clsl_detalle_medicion_apertuDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid l_detalle_medicion_apertu";
        $this->Initialize();
        $this->contador = new clsField("contador", ccsInteger, "");
        
        $this->servicio_negocio = new clsField("servicio_negocio", ccsText, "");
        
        $this->id_ppmc = new clsField("id_ppmc", ccsText, "");
        
        $this->id_estimacion = new clsField("id_estimacion", ccsText, "");
        
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->herr_est_cost = new clsField("herr_est_cost", ccsText, "");
        
        $this->req_serv = new clsField("req_serv", ccsText, "");
        
        $this->fecha_asignacion = new clsField("fecha_asignacion", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->fecha_entrega_prop = new clsField("fecha_entrega_prop", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->fecha_acepta_prop = new clsField("fecha_acepta_prop", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->horas_aprobadas = new clsField("horas_aprobadas", ccsText, "");
        
        $this->tiempo_limite_entrega_prop = new clsField("tiempo_limite_entrega_prop", ccsText, "");
        
        $this->observaciones = new clsField("observaciones", ccsText, "");
        
        $this->tipo = new clsField("tipo", ccsText, "");
        
        $this->serv_contractual = new clsField("serv_contractual", ccsText, "");
        
        $this->total_unidades = new clsField("total_unidades", ccsText, "");
        
        $this->tipo_unidades = new clsField("tipo_unidades", ccsText, "");
        
        $this->ppmc_padre = new clsField("ppmc_padre", ccsText, "");
        
        $this->tipo_padre = new clsField("tipo_padre", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @99-A2AE9C32
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.contador";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_contador" => array("contador", ""), 
            "Sorter_servicio_negocio" => array("servicio_negocio", ""), 
            "Sorter_id_ppmc" => array("id_ppmc", ""), 
            "Sorter_id_estimacion" => array("id_estimacion", ""), 
            "Sorter_descripcion" => array("descripcion", ""), 
            "Sorter_herr_est_cost" => array("herr_est_cost", ""), 
            "Sorter_req_serv" => array("req_serv", ""), 
            "Sorter_fecha_asignacion" => array("fecha_asignacion", ""), 
            "Sorter_fecha_entrega_prop" => array("fecha_entrega_prop", ""), 
            "Sorter_fecha_acepta_prop" => array("fecha_acepta_prop", ""), 
            "Sorter_horas_aprobadas" => array("horas_aprobadas", ""), 
            "Sorter_tiempo_limite_entrega_prop" => array("tiempo_limite_entrega_prop", ""), 
            "Sorter_observaciones" => array("observaciones", ""), 
            "Sorter_tipo" => array("tipo", ""), 
            "Sorter_serv_contractual" => array("serv_contractual", ""), 
            "Sorter_total_unidades" => array("total_unidades", ""), 
            "Sorter_tipo_unidades" => array("tipo_unidades", ""), 
            "Sorter_ppmc_padre" => array("ppmc_padre", ""), 
            "Sorter_tipo_padre" => array("tipo_padre", "")));
    }
//End SetOrder Method

//Prepare Method @99-5D0759C7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], CCGetSession("id_proveedor"), false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], "", false);
    }
//End Prepare Method

//Open Method @99-10FC40C5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.* \n" .
        "FROM l_detalle_medicion_apertura_SAT a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo =" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_detalle_medicion_apertura_SAT b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ")) cnt";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} a.* \n" .
        "FROM l_detalle_medicion_apertura_SAT a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo =" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_detalle_medicion_apertura_SAT b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ") {SQL_OrderBy}";
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

//SetValues Method @99-2B4FCAD3
    function SetValues()
    {
        $this->contador->SetDBValue(trim($this->f("contador")));
        $this->servicio_negocio->SetDBValue($this->f("servicio_negocio"));
        $this->id_ppmc->SetDBValue($this->f("id_ppmc"));
        $this->id_estimacion->SetDBValue($this->f("id_estimacion"));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->herr_est_cost->SetDBValue($this->f("herr_est_cost"));
        $this->req_serv->SetDBValue($this->f("req_serv"));
        $this->fecha_asignacion->SetDBValue(trim($this->f("fecha_asignacion")));
        $this->fecha_entrega_prop->SetDBValue(trim($this->f("fecha_entrega_prop")));
        $this->fecha_acepta_prop->SetDBValue(trim($this->f("fecha_acepta_prop")));
        $this->horas_aprobadas->SetDBValue($this->f("horas_aprobadas"));
        $this->tiempo_limite_entrega_prop->SetDBValue($this->f("tiempo_limite_entrega_prop"));
        $this->observaciones->SetDBValue($this->f("observaciones"));
        $this->tipo->SetDBValue($this->f("tipo"));
        $this->serv_contractual->SetDBValue($this->f("serv_contractual"));
        $this->total_unidades->SetDBValue($this->f("total_unidades"));
        $this->tipo_unidades->SetDBValue($this->f("tipo_unidades"));
        $this->ppmc_padre->SetDBValue($this->f("ppmc_padre"));
        $this->tipo_padre->SetDBValue($this->f("tipo_padre"));
    }
//End SetValues Method

} //End l_detalle_medicion_apertuDataSource Class @99-FCB6E20C

class clsGridl_detalle_medicion_cierre { //l_detalle_medicion_cierre class @160-F64ED002

//Variables @160-513B18F2

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
    public $Sorter_contador;
    public $Sorter_servicio_negocio;
    public $Sorter_id_ppmc;
    public $Sorter_id_estimacion;
    public $Sorter_descripcion;
    public $Sorter_cump_req_func;
    public $Sorter_calific_req_func;
    public $Sorter_retraso_entregables;
    public $Sorter_dias_retraso;
    public $Sorter_calidad_prod_term;
    public $Sorter_total_defectos_func;
    public $Sorter_total_defectos_docu;
    public $Sorter_pena_contractual;
    public $Sorter_calidad_codigo;
    public $Sorter_porcentaje_cumpli;
    public $Sorter_defectos_fugados_amb_prod;
    public $Sorter_total_defectos_fugados;
    public $Sorter_observaciones;
    public $Sorter_tipo;
    public $Sorter_serv_contractual;
    public $Sorter_fecha_caes;
    public $Sorter_total_unidades;
    public $Sorter_tipo_unidades;
//End Variables

//Class_Initialize Event @160-211319D1
    function clsGridl_detalle_medicion_cierre($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "l_detalle_medicion_cierre";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid l_detalle_medicion_cierre";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsl_detalle_medicion_cierreDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("l_detalle_medicion_cierreOrder", "");
        $this->SorterDirection = CCGetParam("l_detalle_medicion_cierreDir", "");

        $this->contador = new clsControl(ccsLabel, "contador", "contador", ccsInteger, "", CCGetRequestParam("contador", ccsGet, NULL), $this);
        $this->servicio_negocio = new clsControl(ccsLabel, "servicio_negocio", "servicio_negocio", ccsText, "", CCGetRequestParam("servicio_negocio", ccsGet, NULL), $this);
        $this->id_ppmc = new clsControl(ccsLabel, "id_ppmc", "id_ppmc", ccsText, "", CCGetRequestParam("id_ppmc", ccsGet, NULL), $this);
        $this->id_estimacion = new clsControl(ccsLabel, "id_estimacion", "id_estimacion", ccsText, "", CCGetRequestParam("id_estimacion", ccsGet, NULL), $this);
        $this->descripcion = new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->cump_req_func = new clsControl(ccsImage, "cump_req_func", "cump_req_func", ccsText, "", CCGetRequestParam("cump_req_func", ccsGet, NULL), $this);
        $this->calific_req_func = new clsControl(ccsLabel, "calific_req_func", "calific_req_func", ccsText, "", CCGetRequestParam("calific_req_func", ccsGet, NULL), $this);
        $this->retraso_entregables = new clsControl(ccsImage, "retraso_entregables", "retraso_entregables", ccsText, "", CCGetRequestParam("retraso_entregables", ccsGet, NULL), $this);
        $this->dias_retraso = new clsControl(ccsLabel, "dias_retraso", "dias_retraso", ccsText, "", CCGetRequestParam("dias_retraso", ccsGet, NULL), $this);
        $this->calidad_prod_term = new clsControl(ccsImage, "calidad_prod_term", "calidad_prod_term", ccsText, "", CCGetRequestParam("calidad_prod_term", ccsGet, NULL), $this);
        $this->total_defectos_func = new clsControl(ccsLabel, "total_defectos_func", "total_defectos_func", ccsText, "", CCGetRequestParam("total_defectos_func", ccsGet, NULL), $this);
        $this->total_defectos_docu = new clsControl(ccsLabel, "total_defectos_docu", "total_defectos_docu", ccsText, "", CCGetRequestParam("total_defectos_docu", ccsGet, NULL), $this);
        $this->pena_contractual = new clsControl(ccsLabel, "pena_contractual", "pena_contractual", ccsText, "", CCGetRequestParam("pena_contractual", ccsGet, NULL), $this);
        $this->calidad_codigo = new clsControl(ccsImage, "calidad_codigo", "calidad_codigo", ccsText, "", CCGetRequestParam("calidad_codigo", ccsGet, NULL), $this);
        $this->porcentaje_cumpli = new clsControl(ccsLabel, "porcentaje_cumpli", "porcentaje_cumpli", ccsText, "", CCGetRequestParam("porcentaje_cumpli", ccsGet, NULL), $this);
        $this->defectos_fugados_amb_prod = new clsControl(ccsImage, "defectos_fugados_amb_prod", "defectos_fugados_amb_prod", ccsText, "", CCGetRequestParam("defectos_fugados_amb_prod", ccsGet, NULL), $this);
        $this->total_defectos_fugados = new clsControl(ccsLabel, "total_defectos_fugados", "total_defectos_fugados", ccsText, "", CCGetRequestParam("total_defectos_fugados", ccsGet, NULL), $this);
        $this->observaciones = new clsControl(ccsLabel, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", ccsGet, NULL), $this);
        $this->tipo = new clsControl(ccsLabel, "tipo", "tipo", ccsText, "", CCGetRequestParam("tipo", ccsGet, NULL), $this);
        $this->serv_contractual = new clsControl(ccsLabel, "serv_contractual", "serv_contractual", ccsText, "", CCGetRequestParam("serv_contractual", ccsGet, NULL), $this);
        $this->fecha_caes = new clsControl(ccsLabel, "fecha_caes", "fecha_caes", ccsDate, array("dd", "/", "mm", "/", "yyyy", "  ", "H", ":", "nn"), CCGetRequestParam("fecha_caes", ccsGet, NULL), $this);
        $this->total_unidades = new clsControl(ccsLabel, "total_unidades", "total_unidades", ccsText, "", CCGetRequestParam("total_unidades", ccsGet, NULL), $this);
        $this->tipo_unidades = new clsControl(ccsLabel, "tipo_unidades", "tipo_unidades", ccsText, "", CCGetRequestParam("tipo_unidades", ccsGet, NULL), $this);
        $this->lb_cierre_cump_req_func = new clsControl(ccsLabel, "lb_cierre_cump_req_func", "lb_cierre_cump_req_func", ccsText, "", CCGetRequestParam("lb_cierre_cump_req_func", ccsGet, NULL), $this);
        $this->lb_cierre_retraso_entregables = new clsControl(ccsLabel, "lb_cierre_retraso_entregables", "lb_cierre_retraso_entregables", ccsText, "", CCGetRequestParam("lb_cierre_retraso_entregables", ccsGet, NULL), $this);
        $this->lb_cierre_calidad_prod_term = new clsControl(ccsLabel, "lb_cierre_calidad_prod_term", "lb_cierre_calidad_prod_term", ccsText, "", CCGetRequestParam("lb_cierre_calidad_prod_term", ccsGet, NULL), $this);
        $this->lb_cierre_calidad_codigo = new clsControl(ccsLabel, "lb_cierre_calidad_codigo", "lb_cierre_calidad_codigo", ccsText, "", CCGetRequestParam("lb_cierre_calidad_codigo", ccsGet, NULL), $this);
        $this->lb_cierre_defectos_fugados_amb_prod = new clsControl(ccsLabel, "lb_cierre_defectos_fugados_amb_prod", "lb_cierre_defectos_fugados_amb_prod", ccsText, "", CCGetRequestParam("lb_cierre_defectos_fugados_amb_prod", ccsGet, NULL), $this);
        $this->l_detalle_medicion_cierre_TotalRecords = new clsControl(ccsLabel, "l_detalle_medicion_cierre_TotalRecords", "l_detalle_medicion_cierre_TotalRecords", ccsText, "", CCGetRequestParam("l_detalle_medicion_cierre_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_contador = new clsSorter($this->ComponentName, "Sorter_contador", $FileName, $this);
        $this->Sorter_servicio_negocio = new clsSorter($this->ComponentName, "Sorter_servicio_negocio", $FileName, $this);
        $this->Sorter_id_ppmc = new clsSorter($this->ComponentName, "Sorter_id_ppmc", $FileName, $this);
        $this->Sorter_id_estimacion = new clsSorter($this->ComponentName, "Sorter_id_estimacion", $FileName, $this);
        $this->Sorter_descripcion = new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
        $this->Sorter_cump_req_func = new clsSorter($this->ComponentName, "Sorter_cump_req_func", $FileName, $this);
        $this->Sorter_calific_req_func = new clsSorter($this->ComponentName, "Sorter_calific_req_func", $FileName, $this);
        $this->Sorter_retraso_entregables = new clsSorter($this->ComponentName, "Sorter_retraso_entregables", $FileName, $this);
        $this->Sorter_dias_retraso = new clsSorter($this->ComponentName, "Sorter_dias_retraso", $FileName, $this);
        $this->Sorter_calidad_prod_term = new clsSorter($this->ComponentName, "Sorter_calidad_prod_term", $FileName, $this);
        $this->Sorter_total_defectos_func = new clsSorter($this->ComponentName, "Sorter_total_defectos_func", $FileName, $this);
        $this->Sorter_total_defectos_docu = new clsSorter($this->ComponentName, "Sorter_total_defectos_docu", $FileName, $this);
        $this->Sorter_pena_contractual = new clsSorter($this->ComponentName, "Sorter_pena_contractual", $FileName, $this);
        $this->Sorter_calidad_codigo = new clsSorter($this->ComponentName, "Sorter_calidad_codigo", $FileName, $this);
        $this->Sorter_porcentaje_cumpli = new clsSorter($this->ComponentName, "Sorter_porcentaje_cumpli", $FileName, $this);
        $this->Sorter_defectos_fugados_amb_prod = new clsSorter($this->ComponentName, "Sorter_defectos_fugados_amb_prod", $FileName, $this);
        $this->Sorter_total_defectos_fugados = new clsSorter($this->ComponentName, "Sorter_total_defectos_fugados", $FileName, $this);
        $this->Sorter_observaciones = new clsSorter($this->ComponentName, "Sorter_observaciones", $FileName, $this);
        $this->Sorter_tipo = new clsSorter($this->ComponentName, "Sorter_tipo", $FileName, $this);
        $this->Sorter_serv_contractual = new clsSorter($this->ComponentName, "Sorter_serv_contractual", $FileName, $this);
        $this->Sorter_fecha_caes = new clsSorter($this->ComponentName, "Sorter_fecha_caes", $FileName, $this);
        $this->Sorter_total_unidades = new clsSorter($this->ComponentName, "Sorter_total_unidades", $FileName, $this);
        $this->Sorter_tipo_unidades = new clsSorter($this->ComponentName, "Sorter_tipo_unidades", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @160-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @160-EB1E39C9
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
            $this->ControlsVisible["contador"] = $this->contador->Visible;
            $this->ControlsVisible["servicio_negocio"] = $this->servicio_negocio->Visible;
            $this->ControlsVisible["id_ppmc"] = $this->id_ppmc->Visible;
            $this->ControlsVisible["id_estimacion"] = $this->id_estimacion->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["cump_req_func"] = $this->cump_req_func->Visible;
            $this->ControlsVisible["calific_req_func"] = $this->calific_req_func->Visible;
            $this->ControlsVisible["retraso_entregables"] = $this->retraso_entregables->Visible;
            $this->ControlsVisible["dias_retraso"] = $this->dias_retraso->Visible;
            $this->ControlsVisible["calidad_prod_term"] = $this->calidad_prod_term->Visible;
            $this->ControlsVisible["total_defectos_func"] = $this->total_defectos_func->Visible;
            $this->ControlsVisible["total_defectos_docu"] = $this->total_defectos_docu->Visible;
            $this->ControlsVisible["pena_contractual"] = $this->pena_contractual->Visible;
            $this->ControlsVisible["calidad_codigo"] = $this->calidad_codigo->Visible;
            $this->ControlsVisible["porcentaje_cumpli"] = $this->porcentaje_cumpli->Visible;
            $this->ControlsVisible["defectos_fugados_amb_prod"] = $this->defectos_fugados_amb_prod->Visible;
            $this->ControlsVisible["total_defectos_fugados"] = $this->total_defectos_fugados->Visible;
            $this->ControlsVisible["observaciones"] = $this->observaciones->Visible;
            $this->ControlsVisible["tipo"] = $this->tipo->Visible;
            $this->ControlsVisible["serv_contractual"] = $this->serv_contractual->Visible;
            $this->ControlsVisible["fecha_caes"] = $this->fecha_caes->Visible;
            $this->ControlsVisible["total_unidades"] = $this->total_unidades->Visible;
            $this->ControlsVisible["tipo_unidades"] = $this->tipo_unidades->Visible;
            $this->ControlsVisible["lb_cierre_cump_req_func"] = $this->lb_cierre_cump_req_func->Visible;
            $this->ControlsVisible["lb_cierre_retraso_entregables"] = $this->lb_cierre_retraso_entregables->Visible;
            $this->ControlsVisible["lb_cierre_calidad_prod_term"] = $this->lb_cierre_calidad_prod_term->Visible;
            $this->ControlsVisible["lb_cierre_calidad_codigo"] = $this->lb_cierre_calidad_codigo->Visible;
            $this->ControlsVisible["lb_cierre_defectos_fugados_amb_prod"] = $this->lb_cierre_defectos_fugados_amb_prod->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->contador->SetValue($this->DataSource->contador->GetValue());
                $this->servicio_negocio->SetValue($this->DataSource->servicio_negocio->GetValue());
                $this->id_ppmc->SetValue($this->DataSource->id_ppmc->GetValue());
                $this->id_estimacion->SetValue($this->DataSource->id_estimacion->GetValue());
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->cump_req_func->SetValue($this->DataSource->cump_req_func->GetValue());
                $this->calific_req_func->SetValue($this->DataSource->calific_req_func->GetValue());
                $this->retraso_entregables->SetValue($this->DataSource->retraso_entregables->GetValue());
                $this->dias_retraso->SetValue($this->DataSource->dias_retraso->GetValue());
                $this->calidad_prod_term->SetValue($this->DataSource->calidad_prod_term->GetValue());
                $this->total_defectos_func->SetValue($this->DataSource->total_defectos_func->GetValue());
                $this->total_defectos_docu->SetValue($this->DataSource->total_defectos_docu->GetValue());
                $this->pena_contractual->SetValue($this->DataSource->pena_contractual->GetValue());
                $this->calidad_codigo->SetValue($this->DataSource->calidad_codigo->GetValue());
                $this->porcentaje_cumpli->SetValue($this->DataSource->porcentaje_cumpli->GetValue());
                $this->defectos_fugados_amb_prod->SetValue($this->DataSource->defectos_fugados_amb_prod->GetValue());
                $this->total_defectos_fugados->SetValue($this->DataSource->total_defectos_fugados->GetValue());
                $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                $this->tipo->SetValue($this->DataSource->tipo->GetValue());
                $this->serv_contractual->SetValue($this->DataSource->serv_contractual->GetValue());
                $this->fecha_caes->SetValue($this->DataSource->fecha_caes->GetValue());
                $this->total_unidades->SetValue($this->DataSource->total_unidades->GetValue());
                $this->tipo_unidades->SetValue($this->DataSource->tipo_unidades->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->contador->Show();
                $this->servicio_negocio->Show();
                $this->id_ppmc->Show();
                $this->id_estimacion->Show();
                $this->descripcion->Show();
                $this->cump_req_func->Show();
                $this->calific_req_func->Show();
                $this->retraso_entregables->Show();
                $this->dias_retraso->Show();
                $this->calidad_prod_term->Show();
                $this->total_defectos_func->Show();
                $this->total_defectos_docu->Show();
                $this->pena_contractual->Show();
                $this->calidad_codigo->Show();
                $this->porcentaje_cumpli->Show();
                $this->defectos_fugados_amb_prod->Show();
                $this->total_defectos_fugados->Show();
                $this->observaciones->Show();
                $this->tipo->Show();
                $this->serv_contractual->Show();
                $this->fecha_caes->Show();
                $this->total_unidades->Show();
                $this->tipo_unidades->Show();
                $this->lb_cierre_cump_req_func->Show();
                $this->lb_cierre_retraso_entregables->Show();
                $this->lb_cierre_calidad_prod_term->Show();
                $this->lb_cierre_calidad_codigo->Show();
                $this->lb_cierre_defectos_fugados_amb_prod->Show();
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
        $this->l_detalle_medicion_cierre_TotalRecords->Show();
        $this->Sorter_contador->Show();
        $this->Sorter_servicio_negocio->Show();
        $this->Sorter_id_ppmc->Show();
        $this->Sorter_id_estimacion->Show();
        $this->Sorter_descripcion->Show();
        $this->Sorter_cump_req_func->Show();
        $this->Sorter_calific_req_func->Show();
        $this->Sorter_retraso_entregables->Show();
        $this->Sorter_dias_retraso->Show();
        $this->Sorter_calidad_prod_term->Show();
        $this->Sorter_total_defectos_func->Show();
        $this->Sorter_total_defectos_docu->Show();
        $this->Sorter_pena_contractual->Show();
        $this->Sorter_calidad_codigo->Show();
        $this->Sorter_porcentaje_cumpli->Show();
        $this->Sorter_defectos_fugados_amb_prod->Show();
        $this->Sorter_total_defectos_fugados->Show();
        $this->Sorter_observaciones->Show();
        $this->Sorter_tipo->Show();
        $this->Sorter_serv_contractual->Show();
        $this->Sorter_fecha_caes->Show();
        $this->Sorter_total_unidades->Show();
        $this->Sorter_tipo_unidades->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @160-5D3096CA
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->contador->Errors->ToString());
        $errors = ComposeStrings($errors, $this->servicio_negocio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id_ppmc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id_estimacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cump_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->calific_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->retraso_entregables->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dias_retraso->Errors->ToString());
        $errors = ComposeStrings($errors, $this->calidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_defectos_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_defectos_docu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pena_contractual->Errors->ToString());
        $errors = ComposeStrings($errors, $this->calidad_codigo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentaje_cumpli->Errors->ToString());
        $errors = ComposeStrings($errors, $this->defectos_fugados_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_defectos_fugados->Errors->ToString());
        $errors = ComposeStrings($errors, $this->observaciones->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->serv_contractual->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_caes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_unidades->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_unidades->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_cierre_cump_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_cierre_retraso_entregables->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_cierre_calidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_cierre_calidad_codigo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_cierre_defectos_fugados_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End l_detalle_medicion_cierre Class @160-FCB6E20C

class clsl_detalle_medicion_cierreDataSource extends clsDBcon_xls {  //l_detalle_medicion_cierreDataSource Class @160-D203EA21

//DataSource Variables @160-EF8969D4
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $contador;
    public $servicio_negocio;
    public $id_ppmc;
    public $id_estimacion;
    public $descripcion;
    public $cump_req_func;
    public $calific_req_func;
    public $retraso_entregables;
    public $dias_retraso;
    public $calidad_prod_term;
    public $total_defectos_func;
    public $total_defectos_docu;
    public $pena_contractual;
    public $calidad_codigo;
    public $porcentaje_cumpli;
    public $defectos_fugados_amb_prod;
    public $total_defectos_fugados;
    public $observaciones;
    public $tipo;
    public $serv_contractual;
    public $fecha_caes;
    public $total_unidades;
    public $tipo_unidades;
//End DataSource Variables

//DataSourceClass_Initialize Event @160-D38C1898
    function clsl_detalle_medicion_cierreDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid l_detalle_medicion_cierre";
        $this->Initialize();
        $this->contador = new clsField("contador", ccsInteger, "");
        
        $this->servicio_negocio = new clsField("servicio_negocio", ccsText, "");
        
        $this->id_ppmc = new clsField("id_ppmc", ccsText, "");
        
        $this->id_estimacion = new clsField("id_estimacion", ccsText, "");
        
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->cump_req_func = new clsField("cump_req_func", ccsText, "");
        
        $this->calific_req_func = new clsField("calific_req_func", ccsText, "");
        
        $this->retraso_entregables = new clsField("retraso_entregables", ccsText, "");
        
        $this->dias_retraso = new clsField("dias_retraso", ccsText, "");
        
        $this->calidad_prod_term = new clsField("calidad_prod_term", ccsText, "");
        
        $this->total_defectos_func = new clsField("total_defectos_func", ccsText, "");
        
        $this->total_defectos_docu = new clsField("total_defectos_docu", ccsText, "");
        
        $this->pena_contractual = new clsField("pena_contractual", ccsText, "");
        
        $this->calidad_codigo = new clsField("calidad_codigo", ccsText, "");
        
        $this->porcentaje_cumpli = new clsField("porcentaje_cumpli", ccsText, "");
        
        $this->defectos_fugados_amb_prod = new clsField("defectos_fugados_amb_prod", ccsText, "");
        
        $this->total_defectos_fugados = new clsField("total_defectos_fugados", ccsText, "");
        
        $this->observaciones = new clsField("observaciones", ccsText, "");
        
        $this->tipo = new clsField("tipo", ccsText, "");
        
        $this->serv_contractual = new clsField("serv_contractual", ccsText, "");
        
        $this->fecha_caes = new clsField("fecha_caes", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->total_unidades = new clsField("total_unidades", ccsText, "");
        
        $this->tipo_unidades = new clsField("tipo_unidades", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @160-9AD46341
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.contador";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_contador" => array("contador", ""), 
            "Sorter_servicio_negocio" => array("servicio_negocio", ""), 
            "Sorter_id_ppmc" => array("id_ppmc", ""), 
            "Sorter_id_estimacion" => array("id_estimacion", ""), 
            "Sorter_descripcion" => array("descripcion", ""), 
            "Sorter_cump_req_func" => array("cump_req_func", ""), 
            "Sorter_calific_req_func" => array("calific_req_func", ""), 
            "Sorter_retraso_entregables" => array("retraso_entregables", ""), 
            "Sorter_dias_retraso" => array("dias_retraso", ""), 
            "Sorter_calidad_prod_term" => array("calidad_prod_term", ""), 
            "Sorter_total_defectos_func" => array("total_defectos_func", ""), 
            "Sorter_total_defectos_docu" => array("total_defectos_docu", ""), 
            "Sorter_pena_contractual" => array("pena_contractual", ""), 
            "Sorter_calidad_codigo" => array("calidad_codigo", ""), 
            "Sorter_porcentaje_cumpli" => array("porcentaje_cumpli", ""), 
            "Sorter_defectos_fugados_amb_prod" => array("defectos_fugados_amb_prod", ""), 
            "Sorter_total_defectos_fugados" => array("total_defectos_fugados", ""), 
            "Sorter_observaciones" => array("observaciones", ""), 
            "Sorter_tipo" => array("tipo", ""), 
            "Sorter_serv_contractual" => array("serv_contractual", ""), 
            "Sorter_fecha_caes" => array("fecha_caes", ""), 
            "Sorter_total_unidades" => array("total_unidades", ""), 
            "Sorter_tipo_unidades" => array("tipo_unidades", "")));
    }
//End SetOrder Method

//Prepare Method @160-5D0759C7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], CCGetSession("id_proveedor"), false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], "", false);
    }
//End Prepare Method

//Open Method @160-C89CA1F5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.* \n" .
        "FROM l_detalle_medicion_cierre_SAT  a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_detalle_medicion_cierre_SAT  b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ")) cnt";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} a.* \n" .
        "FROM l_detalle_medicion_cierre_SAT  a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_detalle_medicion_cierre_SAT  b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ") {SQL_OrderBy}";
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

//SetValues Method @160-DE7518BC
    function SetValues()
    {
        $this->contador->SetDBValue(trim($this->f("contador")));
        $this->servicio_negocio->SetDBValue($this->f("servicio_negocio"));
        $this->id_ppmc->SetDBValue($this->f("id_ppmc"));
        $this->id_estimacion->SetDBValue($this->f("id_estimacion"));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->cump_req_func->SetDBValue($this->f("cump_req_func"));
        $this->calific_req_func->SetDBValue($this->f("calific_req_func"));
        $this->retraso_entregables->SetDBValue($this->f("retraso_entregables"));
        $this->dias_retraso->SetDBValue($this->f("dias_retraso"));
        $this->calidad_prod_term->SetDBValue($this->f("calidad_prod_term"));
        $this->total_defectos_func->SetDBValue($this->f("total_defectos_func"));
        $this->total_defectos_docu->SetDBValue($this->f("total_defectos_docu"));
        $this->pena_contractual->SetDBValue($this->f("pena_contractual"));
        $this->calidad_codigo->SetDBValue($this->f("calidad_codigo"));
        $this->porcentaje_cumpli->SetDBValue($this->f("porcentaje_cumpli"));
        $this->defectos_fugados_amb_prod->SetDBValue($this->f("defectos_fugados_amb_prod"));
        $this->total_defectos_fugados->SetDBValue($this->f("total_defectos_fugados"));
        $this->observaciones->SetDBValue($this->f("observaciones"));
        $this->tipo->SetDBValue($this->f("tipo"));
        $this->serv_contractual->SetDBValue($this->f("serv_contractual"));
        $this->fecha_caes->SetDBValue(trim($this->f("fecha_caes")));
        $this->total_unidades->SetDBValue($this->f("total_unidades"));
        $this->tipo_unidades->SetDBValue($this->f("tipo_unidades"));
    }
//End SetValues Method

} //End l_detalle_medicion_cierreDataSource Class @160-FCB6E20C

class clsGridl_detalle_medicion_inc { //l_detalle_medicion_inc class @221-736D4546

//Variables @221-B46C4647

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
    public $Sorter_contador;
    public $Sorter_id_incidencia;
    public $Sorter_servicio_negocio;
    public $Sorter_nombre_producto;
    public $Sorter_severidad;
    public $Sorter_estado;
    public $Sorter_nuevo;
    public $Sorter_asignado;
    public $Sorter_en_curso;
    public $Sorter_pendiente;
    public $Sorter_resuelto;
    public $Sorter_cerrado;
    public $Sorter_fecha_entrega_avl;
    public $Sorter_manejo_incid_tiempo_atencion;
    public $Sorter_manejo_incid_tiempo_solu;
    public $Sorter_observaciones;
//End Variables

//Class_Initialize Event @221-A6822D80
    function clsGridl_detalle_medicion_inc($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "l_detalle_medicion_inc";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid l_detalle_medicion_inc";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsl_detalle_medicion_incDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("l_detalle_medicion_incOrder", "");
        $this->SorterDirection = CCGetParam("l_detalle_medicion_incDir", "");

        $this->contador = new clsControl(ccsLabel, "contador", "contador", ccsInteger, "", CCGetRequestParam("contador", ccsGet, NULL), $this);
        $this->id_incidencia = new clsControl(ccsLabel, "id_incidencia", "id_incidencia", ccsText, "", CCGetRequestParam("id_incidencia", ccsGet, NULL), $this);
        $this->servicio_negocio = new clsControl(ccsLabel, "servicio_negocio", "servicio_negocio", ccsText, "", CCGetRequestParam("servicio_negocio", ccsGet, NULL), $this);
        $this->nombre_producto = new clsControl(ccsLabel, "nombre_producto", "nombre_producto", ccsText, "", CCGetRequestParam("nombre_producto", ccsGet, NULL), $this);
        $this->severidad = new clsControl(ccsLabel, "severidad", "severidad", ccsText, "", CCGetRequestParam("severidad", ccsGet, NULL), $this);
        $this->estado = new clsControl(ccsLabel, "estado", "estado", ccsText, "", CCGetRequestParam("estado", ccsGet, NULL), $this);
        $this->nuevo = new clsControl(ccsLabel, "nuevo", "nuevo", ccsDate, array("dd", "/", "mm", "/", "yyyy", "  ", "H", ":", "nn"), CCGetRequestParam("nuevo", ccsGet, NULL), $this);
        $this->asignado = new clsControl(ccsLabel, "asignado", "asignado", ccsDate, array("dd", "/", "mm", "/", "yyyy", "  ", "H", ":", "nn"), CCGetRequestParam("asignado", ccsGet, NULL), $this);
        $this->en_curso = new clsControl(ccsLabel, "en_curso", "en_curso", ccsDate, array("dd", "/", "mm", "/", "yyyy", "  ", "H", ":", "nn"), CCGetRequestParam("en_curso", ccsGet, NULL), $this);
        $this->pendiente = new clsControl(ccsLabel, "pendiente", "pendiente", ccsDate, array("dd", "/", "mm", "/", "yyyy", "  ", "H", ":", "nn"), CCGetRequestParam("pendiente", ccsGet, NULL), $this);
        $this->resuelto = new clsControl(ccsLabel, "resuelto", "resuelto", ccsDate, array("dd", "/", "mm", "/", "yyyy", "  ", "H", ":", "nn"), CCGetRequestParam("resuelto", ccsGet, NULL), $this);
        $this->cerrado = new clsControl(ccsLabel, "cerrado", "cerrado", ccsDate, array("dd", "/", "mm", "/", "yyyy", "  ", "H", ":", "nn"), CCGetRequestParam("cerrado", ccsGet, NULL), $this);
        $this->fecha_entrega_avl = new clsControl(ccsLabel, "fecha_entrega_avl", "fecha_entrega_avl", ccsDate, array("dd", "/", "mm", "/", "yyyy", "  ", "H", ":", "nn"), CCGetRequestParam("fecha_entrega_avl", ccsGet, NULL), $this);
        $this->manejo_incid_tiempo_atencion = new clsControl(ccsImage, "manejo_incid_tiempo_atencion", "manejo_incid_tiempo_atencion", ccsText, "", CCGetRequestParam("manejo_incid_tiempo_atencion", ccsGet, NULL), $this);
        $this->manejo_incid_tiempo_solu = new clsControl(ccsImage, "manejo_incid_tiempo_solu", "manejo_incid_tiempo_solu", ccsText, "", CCGetRequestParam("manejo_incid_tiempo_solu", ccsGet, NULL), $this);
        $this->observaciones = new clsControl(ccsLabel, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", ccsGet, NULL), $this);
        $this->lb_inci_manejo_incid_tiempo_atencion = new clsControl(ccsLabel, "lb_inci_manejo_incid_tiempo_atencion", "lb_inci_manejo_incid_tiempo_atencion", ccsText, "", CCGetRequestParam("lb_inci_manejo_incid_tiempo_atencion", ccsGet, NULL), $this);
        $this->lb_inci_manejo_incid_tiempo_solu = new clsControl(ccsLabel, "lb_inci_manejo_incid_tiempo_solu", "lb_inci_manejo_incid_tiempo_solu", ccsText, "", CCGetRequestParam("lb_inci_manejo_incid_tiempo_solu", ccsGet, NULL), $this);
        $this->l_detalle_medicion_inc_TotalRecords = new clsControl(ccsLabel, "l_detalle_medicion_inc_TotalRecords", "l_detalle_medicion_inc_TotalRecords", ccsText, "", CCGetRequestParam("l_detalle_medicion_inc_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_contador = new clsSorter($this->ComponentName, "Sorter_contador", $FileName, $this);
        $this->Sorter_id_incidencia = new clsSorter($this->ComponentName, "Sorter_id_incidencia", $FileName, $this);
        $this->Sorter_servicio_negocio = new clsSorter($this->ComponentName, "Sorter_servicio_negocio", $FileName, $this);
        $this->Sorter_nombre_producto = new clsSorter($this->ComponentName, "Sorter_nombre_producto", $FileName, $this);
        $this->Sorter_severidad = new clsSorter($this->ComponentName, "Sorter_severidad", $FileName, $this);
        $this->Sorter_estado = new clsSorter($this->ComponentName, "Sorter_estado", $FileName, $this);
        $this->Sorter_nuevo = new clsSorter($this->ComponentName, "Sorter_nuevo", $FileName, $this);
        $this->Sorter_asignado = new clsSorter($this->ComponentName, "Sorter_asignado", $FileName, $this);
        $this->Sorter_en_curso = new clsSorter($this->ComponentName, "Sorter_en_curso", $FileName, $this);
        $this->Sorter_pendiente = new clsSorter($this->ComponentName, "Sorter_pendiente", $FileName, $this);
        $this->Sorter_resuelto = new clsSorter($this->ComponentName, "Sorter_resuelto", $FileName, $this);
        $this->Sorter_cerrado = new clsSorter($this->ComponentName, "Sorter_cerrado", $FileName, $this);
        $this->Sorter_fecha_entrega_avl = new clsSorter($this->ComponentName, "Sorter_fecha_entrega_avl", $FileName, $this);
        $this->Sorter_manejo_incid_tiempo_atencion = new clsSorter($this->ComponentName, "Sorter_manejo_incid_tiempo_atencion", $FileName, $this);
        $this->Sorter_manejo_incid_tiempo_solu = new clsSorter($this->ComponentName, "Sorter_manejo_incid_tiempo_solu", $FileName, $this);
        $this->Sorter_observaciones = new clsSorter($this->ComponentName, "Sorter_observaciones", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @221-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @221-9350B537
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
            $this->ControlsVisible["contador"] = $this->contador->Visible;
            $this->ControlsVisible["id_incidencia"] = $this->id_incidencia->Visible;
            $this->ControlsVisible["servicio_negocio"] = $this->servicio_negocio->Visible;
            $this->ControlsVisible["nombre_producto"] = $this->nombre_producto->Visible;
            $this->ControlsVisible["severidad"] = $this->severidad->Visible;
            $this->ControlsVisible["estado"] = $this->estado->Visible;
            $this->ControlsVisible["nuevo"] = $this->nuevo->Visible;
            $this->ControlsVisible["asignado"] = $this->asignado->Visible;
            $this->ControlsVisible["en_curso"] = $this->en_curso->Visible;
            $this->ControlsVisible["pendiente"] = $this->pendiente->Visible;
            $this->ControlsVisible["resuelto"] = $this->resuelto->Visible;
            $this->ControlsVisible["cerrado"] = $this->cerrado->Visible;
            $this->ControlsVisible["fecha_entrega_avl"] = $this->fecha_entrega_avl->Visible;
            $this->ControlsVisible["manejo_incid_tiempo_atencion"] = $this->manejo_incid_tiempo_atencion->Visible;
            $this->ControlsVisible["manejo_incid_tiempo_solu"] = $this->manejo_incid_tiempo_solu->Visible;
            $this->ControlsVisible["observaciones"] = $this->observaciones->Visible;
            $this->ControlsVisible["lb_inci_manejo_incid_tiempo_atencion"] = $this->lb_inci_manejo_incid_tiempo_atencion->Visible;
            $this->ControlsVisible["lb_inci_manejo_incid_tiempo_solu"] = $this->lb_inci_manejo_incid_tiempo_solu->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->contador->SetValue($this->DataSource->contador->GetValue());
                $this->id_incidencia->SetValue($this->DataSource->id_incidencia->GetValue());
                $this->servicio_negocio->SetValue($this->DataSource->servicio_negocio->GetValue());
                $this->nombre_producto->SetValue($this->DataSource->nombre_producto->GetValue());
                $this->severidad->SetValue($this->DataSource->severidad->GetValue());
                $this->estado->SetValue($this->DataSource->estado->GetValue());
                $this->nuevo->SetValue($this->DataSource->nuevo->GetValue());
                $this->asignado->SetValue($this->DataSource->asignado->GetValue());
                $this->en_curso->SetValue($this->DataSource->en_curso->GetValue());
                $this->pendiente->SetValue($this->DataSource->pendiente->GetValue());
                $this->resuelto->SetValue($this->DataSource->resuelto->GetValue());
                $this->cerrado->SetValue($this->DataSource->cerrado->GetValue());
                $this->fecha_entrega_avl->SetValue($this->DataSource->fecha_entrega_avl->GetValue());
                $this->manejo_incid_tiempo_atencion->SetValue($this->DataSource->manejo_incid_tiempo_atencion->GetValue());
                $this->manejo_incid_tiempo_solu->SetValue($this->DataSource->manejo_incid_tiempo_solu->GetValue());
                $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->contador->Show();
                $this->id_incidencia->Show();
                $this->servicio_negocio->Show();
                $this->nombre_producto->Show();
                $this->severidad->Show();
                $this->estado->Show();
                $this->nuevo->Show();
                $this->asignado->Show();
                $this->en_curso->Show();
                $this->pendiente->Show();
                $this->resuelto->Show();
                $this->cerrado->Show();
                $this->fecha_entrega_avl->Show();
                $this->manejo_incid_tiempo_atencion->Show();
                $this->manejo_incid_tiempo_solu->Show();
                $this->observaciones->Show();
                $this->lb_inci_manejo_incid_tiempo_atencion->Show();
                $this->lb_inci_manejo_incid_tiempo_solu->Show();
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
        $this->l_detalle_medicion_inc_TotalRecords->Show();
        $this->Sorter_contador->Show();
        $this->Sorter_id_incidencia->Show();
        $this->Sorter_servicio_negocio->Show();
        $this->Sorter_nombre_producto->Show();
        $this->Sorter_severidad->Show();
        $this->Sorter_estado->Show();
        $this->Sorter_nuevo->Show();
        $this->Sorter_asignado->Show();
        $this->Sorter_en_curso->Show();
        $this->Sorter_pendiente->Show();
        $this->Sorter_resuelto->Show();
        $this->Sorter_cerrado->Show();
        $this->Sorter_fecha_entrega_avl->Show();
        $this->Sorter_manejo_incid_tiempo_atencion->Show();
        $this->Sorter_manejo_incid_tiempo_solu->Show();
        $this->Sorter_observaciones->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @221-E1C451A6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->contador->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id_incidencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->servicio_negocio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_producto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->severidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nuevo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->asignado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->en_curso->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pendiente->Errors->ToString());
        $errors = ComposeStrings($errors, $this->resuelto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cerrado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_entrega_avl->Errors->ToString());
        $errors = ComposeStrings($errors, $this->manejo_incid_tiempo_atencion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->manejo_incid_tiempo_solu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->observaciones->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_inci_manejo_incid_tiempo_atencion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_inci_manejo_incid_tiempo_solu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End l_detalle_medicion_inc Class @221-FCB6E20C

class clsl_detalle_medicion_incDataSource extends clsDBcon_xls {  //l_detalle_medicion_incDataSource Class @221-25405735

//DataSource Variables @221-6547F0F3
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $contador;
    public $id_incidencia;
    public $servicio_negocio;
    public $nombre_producto;
    public $severidad;
    public $estado;
    public $nuevo;
    public $asignado;
    public $en_curso;
    public $pendiente;
    public $resuelto;
    public $cerrado;
    public $fecha_entrega_avl;
    public $manejo_incid_tiempo_atencion;
    public $manejo_incid_tiempo_solu;
    public $observaciones;
//End DataSource Variables

//DataSourceClass_Initialize Event @221-874CD35A
    function clsl_detalle_medicion_incDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid l_detalle_medicion_inc";
        $this->Initialize();
        $this->contador = new clsField("contador", ccsInteger, "");
        
        $this->id_incidencia = new clsField("id_incidencia", ccsText, "");
        
        $this->servicio_negocio = new clsField("servicio_negocio", ccsText, "");
        
        $this->nombre_producto = new clsField("nombre_producto", ccsText, "");
        
        $this->severidad = new clsField("severidad", ccsText, "");
        
        $this->estado = new clsField("estado", ccsText, "");
        
        $this->nuevo = new clsField("nuevo", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->asignado = new clsField("asignado", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->en_curso = new clsField("en_curso", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->pendiente = new clsField("pendiente", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->resuelto = new clsField("resuelto", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->cerrado = new clsField("cerrado", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->fecha_entrega_avl = new clsField("fecha_entrega_avl", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->manejo_incid_tiempo_atencion = new clsField("manejo_incid_tiempo_atencion", ccsText, "");
        
        $this->manejo_incid_tiempo_solu = new clsField("manejo_incid_tiempo_solu", ccsText, "");
        
        $this->observaciones = new clsField("observaciones", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @221-9A3719BD
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.contador";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_contador" => array("contador", ""), 
            "Sorter_id_incidencia" => array("id_incidencia", ""), 
            "Sorter_servicio_negocio" => array("servicio_negocio", ""), 
            "Sorter_nombre_producto" => array("nombre_producto", ""), 
            "Sorter_severidad" => array("severidad", ""), 
            "Sorter_estado" => array("estado", ""), 
            "Sorter_nuevo" => array("nuevo", ""), 
            "Sorter_asignado" => array("asignado", ""), 
            "Sorter_en_curso" => array("en_curso", ""), 
            "Sorter_pendiente" => array("pendiente", ""), 
            "Sorter_resuelto" => array("resuelto", ""), 
            "Sorter_cerrado" => array("cerrado", ""), 
            "Sorter_fecha_entrega_avl" => array("fecha_entrega_avl", ""), 
            "Sorter_manejo_incid_tiempo_atencion" => array("manejo_incid_tiempo_atencion", ""), 
            "Sorter_manejo_incid_tiempo_solu" => array("manejo_incid_tiempo_solu", ""), 
            "Sorter_observaciones" => array("observaciones", "")));
    }
//End SetOrder Method

//Prepare Method @221-5D0759C7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], CCGetSession("id_proveedor"), false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], "", false);
    }
//End Prepare Method

//Open Method @221-DDC5FCF6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.* \n" .
        "FROM l_detalle_medicion_inc_SAT  a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_detalle_medicion_inc_SAT  b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ")) cnt";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} a.* \n" .
        "FROM l_detalle_medicion_inc_SAT  a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_detalle_medicion_inc_SAT  b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ") {SQL_OrderBy}";
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

//SetValues Method @221-411ED093
    function SetValues()
    {
        $this->contador->SetDBValue(trim($this->f("contador")));
        $this->id_incidencia->SetDBValue($this->f("id_incidencia"));
        $this->servicio_negocio->SetDBValue($this->f("servicio_negocio"));
        $this->nombre_producto->SetDBValue($this->f("nombre_producto"));
        $this->severidad->SetDBValue($this->f("severidad"));
        $this->estado->SetDBValue($this->f("estado"));
        $this->nuevo->SetDBValue(trim($this->f("nuevo")));
        $this->asignado->SetDBValue(trim($this->f("asignado")));
        $this->en_curso->SetDBValue(trim($this->f("en_curso")));
        $this->pendiente->SetDBValue(trim($this->f("pendiente")));
        $this->resuelto->SetDBValue(trim($this->f("resuelto")));
        $this->cerrado->SetDBValue(trim($this->f("cerrado")));
        $this->fecha_entrega_avl->SetDBValue(trim($this->f("fecha_entrega_avl")));
        $this->manejo_incid_tiempo_atencion->SetDBValue($this->f("manejo_incid_tiempo_atencion"));
        $this->manejo_incid_tiempo_solu->SetDBValue($this->f("manejo_incid_tiempo_solu"));
        $this->observaciones->SetDBValue($this->f("observaciones"));
    }
//End SetValues Method

} //End l_detalle_medicion_incDataSource Class @221-FCB6E20C

class clsGridl_detalle_eficiencia_pres { //l_detalle_eficiencia_pres class @264-4CCA7235

//Variables @264-512002A0

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
    public $Sorter_contador;
    public $Sorter_grupo_aplicativos;
    public $Sorter_servicios_negocio_rela;
    public $Sorter_promedio_cfm;
    public $Sorter_cfm_nuevo;
    public $Sorter_result_efic_presupuestal;
    public $Sorter_efic_presupuestal;
    public $Sorter_observaciones;
//End Variables

//Class_Initialize Event @264-C3CEBF7D
    function clsGridl_detalle_eficiencia_pres($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "l_detalle_eficiencia_pres";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid l_detalle_eficiencia_pres";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsl_detalle_eficiencia_presDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("l_detalle_eficiencia_presOrder", "");
        $this->SorterDirection = CCGetParam("l_detalle_eficiencia_presDir", "");

        $this->contador = new clsControl(ccsLabel, "contador", "contador", ccsInteger, "", CCGetRequestParam("contador", ccsGet, NULL), $this);
        $this->grupo_aplicativos = new clsControl(ccsLabel, "grupo_aplicativos", "grupo_aplicativos", ccsText, "", CCGetRequestParam("grupo_aplicativos", ccsGet, NULL), $this);
        $this->servicios_negocio_rela = new clsControl(ccsLabel, "servicios_negocio_rela", "servicios_negocio_rela", ccsText, "", CCGetRequestParam("servicios_negocio_rela", ccsGet, NULL), $this);
        $this->promedio_cfm = new clsControl(ccsLabel, "promedio_cfm", "promedio_cfm", ccsText, "", CCGetRequestParam("promedio_cfm", ccsGet, NULL), $this);
        $this->cfm_nuevo = new clsControl(ccsLabel, "cfm_nuevo", "cfm_nuevo", ccsText, "", CCGetRequestParam("cfm_nuevo", ccsGet, NULL), $this);
        $this->result_efic_presupuestal = new clsControl(ccsLabel, "result_efic_presupuestal", "result_efic_presupuestal", ccsText, "", CCGetRequestParam("result_efic_presupuestal", ccsGet, NULL), $this);
        $this->efic_presupuestal = new clsControl(ccsImage, "efic_presupuestal", "efic_presupuestal", ccsText, "", CCGetRequestParam("efic_presupuestal", ccsGet, NULL), $this);
        $this->observaciones = new clsControl(ccsLabel, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", ccsGet, NULL), $this);
        $this->lb_efic_presupuestal1 = new clsControl(ccsLabel, "lb_efic_presupuestal1", "lb_efic_presupuestal1", ccsText, "", CCGetRequestParam("lb_efic_presupuestal1", ccsGet, NULL), $this);
        $this->l_detalle_eficiencia_pres_TotalRecords = new clsControl(ccsLabel, "l_detalle_eficiencia_pres_TotalRecords", "l_detalle_eficiencia_pres_TotalRecords", ccsText, "", CCGetRequestParam("l_detalle_eficiencia_pres_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_contador = new clsSorter($this->ComponentName, "Sorter_contador", $FileName, $this);
        $this->Sorter_grupo_aplicativos = new clsSorter($this->ComponentName, "Sorter_grupo_aplicativos", $FileName, $this);
        $this->Sorter_servicios_negocio_rela = new clsSorter($this->ComponentName, "Sorter_servicios_negocio_rela", $FileName, $this);
        $this->Sorter_promedio_cfm = new clsSorter($this->ComponentName, "Sorter_promedio_cfm", $FileName, $this);
        $this->Sorter_cfm_nuevo = new clsSorter($this->ComponentName, "Sorter_cfm_nuevo", $FileName, $this);
        $this->Sorter_result_efic_presupuestal = new clsSorter($this->ComponentName, "Sorter_result_efic_presupuestal", $FileName, $this);
        $this->Sorter_efic_presupuestal = new clsSorter($this->ComponentName, "Sorter_efic_presupuestal", $FileName, $this);
        $this->Sorter_observaciones = new clsSorter($this->ComponentName, "Sorter_observaciones", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @264-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @264-97E49AA7
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
            $this->ControlsVisible["contador"] = $this->contador->Visible;
            $this->ControlsVisible["grupo_aplicativos"] = $this->grupo_aplicativos->Visible;
            $this->ControlsVisible["servicios_negocio_rela"] = $this->servicios_negocio_rela->Visible;
            $this->ControlsVisible["promedio_cfm"] = $this->promedio_cfm->Visible;
            $this->ControlsVisible["cfm_nuevo"] = $this->cfm_nuevo->Visible;
            $this->ControlsVisible["result_efic_presupuestal"] = $this->result_efic_presupuestal->Visible;
            $this->ControlsVisible["efic_presupuestal"] = $this->efic_presupuestal->Visible;
            $this->ControlsVisible["observaciones"] = $this->observaciones->Visible;
            $this->ControlsVisible["lb_efic_presupuestal1"] = $this->lb_efic_presupuestal1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->contador->SetValue($this->DataSource->contador->GetValue());
                $this->grupo_aplicativos->SetValue($this->DataSource->grupo_aplicativos->GetValue());
                $this->servicios_negocio_rela->SetValue($this->DataSource->servicios_negocio_rela->GetValue());
                $this->promedio_cfm->SetValue($this->DataSource->promedio_cfm->GetValue());
                $this->cfm_nuevo->SetValue($this->DataSource->cfm_nuevo->GetValue());
                $this->result_efic_presupuestal->SetValue($this->DataSource->result_efic_presupuestal->GetValue());
                $this->efic_presupuestal->SetValue($this->DataSource->efic_presupuestal->GetValue());
                $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->contador->Show();
                $this->grupo_aplicativos->Show();
                $this->servicios_negocio_rela->Show();
                $this->promedio_cfm->Show();
                $this->cfm_nuevo->Show();
                $this->result_efic_presupuestal->Show();
                $this->efic_presupuestal->Show();
                $this->observaciones->Show();
                $this->lb_efic_presupuestal1->Show();
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
        $this->l_detalle_eficiencia_pres_TotalRecords->Show();
        $this->Sorter_contador->Show();
        $this->Sorter_grupo_aplicativos->Show();
        $this->Sorter_servicios_negocio_rela->Show();
        $this->Sorter_promedio_cfm->Show();
        $this->Sorter_cfm_nuevo->Show();
        $this->Sorter_result_efic_presupuestal->Show();
        $this->Sorter_efic_presupuestal->Show();
        $this->Sorter_observaciones->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @264-810F1F8B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->contador->Errors->ToString());
        $errors = ComposeStrings($errors, $this->grupo_aplicativos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->servicios_negocio_rela->Errors->ToString());
        $errors = ComposeStrings($errors, $this->promedio_cfm->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cfm_nuevo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->result_efic_presupuestal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->efic_presupuestal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->observaciones->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_efic_presupuestal1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End l_detalle_eficiencia_pres Class @264-FCB6E20C

class clsl_detalle_eficiencia_presDataSource extends clsDBcon_xls {  //l_detalle_eficiencia_presDataSource Class @264-5731DBFB

//DataSource Variables @264-9903BAF7
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $contador;
    public $grupo_aplicativos;
    public $servicios_negocio_rela;
    public $promedio_cfm;
    public $cfm_nuevo;
    public $result_efic_presupuestal;
    public $efic_presupuestal;
    public $observaciones;
//End DataSource Variables

//DataSourceClass_Initialize Event @264-AB78F752
    function clsl_detalle_eficiencia_presDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid l_detalle_eficiencia_pres";
        $this->Initialize();
        $this->contador = new clsField("contador", ccsInteger, "");
        
        $this->grupo_aplicativos = new clsField("grupo_aplicativos", ccsText, "");
        
        $this->servicios_negocio_rela = new clsField("servicios_negocio_rela", ccsText, "");
        
        $this->promedio_cfm = new clsField("promedio_cfm", ccsText, "");
        
        $this->cfm_nuevo = new clsField("cfm_nuevo", ccsText, "");
        
        $this->result_efic_presupuestal = new clsField("result_efic_presupuestal", ccsText, "");
        
        $this->efic_presupuestal = new clsField("efic_presupuestal", ccsText, "");
        
        $this->observaciones = new clsField("observaciones", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @264-2D9DBAE9
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.contador";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_contador" => array("contador", ""), 
            "Sorter_grupo_aplicativos" => array("grupo_aplicativos", ""), 
            "Sorter_servicios_negocio_rela" => array("servicios_negocio_rela", ""), 
            "Sorter_promedio_cfm" => array("promedio_cfm", ""), 
            "Sorter_cfm_nuevo" => array("cfm_nuevo", ""), 
            "Sorter_result_efic_presupuestal" => array("result_efic_presupuestal", ""), 
            "Sorter_efic_presupuestal" => array("efic_presupuestal", ""), 
            "Sorter_observaciones" => array("observaciones", "")));
    }
//End SetOrder Method

//Prepare Method @264-5D0759C7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], CCGetSession("id_proveedor"), false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], "", false);
    }
//End Prepare Method

//Open Method @264-37847A9E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.* \n" .
        "FROM l_detalle_eficiencia_presupuestal_SAT a\n" .
        "WHERE a.id_proveedor =" . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo =" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_detalle_eficiencia_presupuestal_SAT  b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ")) cnt";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} a.* \n" .
        "FROM l_detalle_eficiencia_presupuestal_SAT a\n" .
        "WHERE a.id_proveedor =" . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo =" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_detalle_eficiencia_presupuestal_SAT  b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ") {SQL_OrderBy}";
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

//SetValues Method @264-102EB1DB
    function SetValues()
    {
        $this->contador->SetDBValue(trim($this->f("contador")));
        $this->grupo_aplicativos->SetDBValue($this->f("grupo_aplicativos"));
        $this->servicios_negocio_rela->SetDBValue($this->f("servicios_negocio_rela"));
        $this->promedio_cfm->SetDBValue($this->f("promedio_cfm"));
        $this->cfm_nuevo->SetDBValue($this->f("cfm_nuevo"));
        $this->result_efic_presupuestal->SetDBValue($this->f("result_efic_presupuestal"));
        $this->efic_presupuestal->SetDBValue($this->f("efic_presupuestal"));
        $this->observaciones->SetDBValue($this->f("observaciones"));
    }
//End SetValues Method

} //End l_detalle_eficiencia_presDataSource Class @264-FCB6E20C

class clsGridl_calificacion_rs_AUT { //l_calificacion_rs_AUT class @308-20A87DEF

//Variables @308-2CB59414

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
    public $Sorter_contador;
    public $Sorter_servicio_cont;
    public $Sorter_servicio_negocio;
    public $Sorter_id_ppmc;
    public $Sorter_id_estimacion;
    public $Sorter_tipo;
    public $Sorter_descripcion;
    public $Sorter_herr_est_cost;
    public $Sorter_req_serv;
    public $Sorter_cumpl_req_func;
    public $Sorter_retr_entregable;
    public $Sorter_calidad_prod_term;
    public $Sorter_calidad_codigo;
    public $Sorter_def_fug_amb_prod;
    public $Sorter_obs_manuales;
//End Variables

//Class_Initialize Event @308-A471FAE8
    function clsGridl_calificacion_rs_AUT($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "l_calificacion_rs_AUT";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid l_calificacion_rs_AUT";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsl_calificacion_rs_AUTDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("l_calificacion_rs_AUTOrder", "");
        $this->SorterDirection = CCGetParam("l_calificacion_rs_AUTDir", "");

        $this->contador = new clsControl(ccsLabel, "contador", "contador", ccsInteger, "", CCGetRequestParam("contador", ccsGet, NULL), $this);
        $this->servicio_cont = new clsControl(ccsLabel, "servicio_cont", "servicio_cont", ccsText, "", CCGetRequestParam("servicio_cont", ccsGet, NULL), $this);
        $this->servicio_negocio = new clsControl(ccsLabel, "servicio_negocio", "servicio_negocio", ccsText, "", CCGetRequestParam("servicio_negocio", ccsGet, NULL), $this);
        $this->id_ppmc = new clsControl(ccsLabel, "id_ppmc", "id_ppmc", ccsInteger, "", CCGetRequestParam("id_ppmc", ccsGet, NULL), $this);
        $this->id_estimacion = new clsControl(ccsLabel, "id_estimacion", "id_estimacion", ccsInteger, "", CCGetRequestParam("id_estimacion", ccsGet, NULL), $this);
        $this->tipo = new clsControl(ccsLabel, "tipo", "tipo", ccsText, "", CCGetRequestParam("tipo", ccsGet, NULL), $this);
        $this->descripcion = new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->herr_est_cost = new clsControl(ccsImage, "herr_est_cost", "herr_est_cost", ccsText, "", CCGetRequestParam("herr_est_cost", ccsGet, NULL), $this);
        $this->req_serv = new clsControl(ccsImage, "req_serv", "req_serv", ccsText, "", CCGetRequestParam("req_serv", ccsGet, NULL), $this);
        $this->cumpl_req_func = new clsControl(ccsImage, "cumpl_req_func", "cumpl_req_func", ccsText, "", CCGetRequestParam("cumpl_req_func", ccsGet, NULL), $this);
        $this->retr_entregable = new clsControl(ccsImage, "retr_entregable", "retr_entregable", ccsText, "", CCGetRequestParam("retr_entregable", ccsGet, NULL), $this);
        $this->calidad_prod_term = new clsControl(ccsImage, "calidad_prod_term", "calidad_prod_term", ccsText, "", CCGetRequestParam("calidad_prod_term", ccsGet, NULL), $this);
        $this->calidad_codigo = new clsControl(ccsImage, "calidad_codigo", "calidad_codigo", ccsText, "", CCGetRequestParam("calidad_codigo", ccsGet, NULL), $this);
        $this->def_fug_amb_prod = new clsControl(ccsImage, "def_fug_amb_prod", "def_fug_amb_prod", ccsText, "", CCGetRequestParam("def_fug_amb_prod", ccsGet, NULL), $this);
        $this->obs_manuales = new clsControl(ccsLabel, "obs_manuales", "obs_manuales", ccsText, "", CCGetRequestParam("obs_manuales", ccsGet, NULL), $this);
        $this->lb11_herr_est_cost = new clsControl(ccsLabel, "lb11_herr_est_cost", "lb11_herr_est_cost", ccsText, "", CCGetRequestParam("lb11_herr_est_cost", ccsGet, NULL), $this);
        $this->lb11_req_serv = new clsControl(ccsLabel, "lb11_req_serv", "lb11_req_serv", ccsText, "", CCGetRequestParam("lb11_req_serv", ccsGet, NULL), $this);
        $this->lb11_cumpl_req_func = new clsControl(ccsLabel, "lb11_cumpl_req_func", "lb11_cumpl_req_func", ccsText, "", CCGetRequestParam("lb11_cumpl_req_func", ccsGet, NULL), $this);
        $this->lb11_retr_entregable = new clsControl(ccsLabel, "lb11_retr_entregable", "lb11_retr_entregable", ccsText, "", CCGetRequestParam("lb11_retr_entregable", ccsGet, NULL), $this);
        $this->lb11_calidad_prod_term = new clsControl(ccsLabel, "lb11_calidad_prod_term", "lb11_calidad_prod_term", ccsText, "", CCGetRequestParam("lb11_calidad_prod_term", ccsGet, NULL), $this);
        $this->lb11_calidad_codigo = new clsControl(ccsLabel, "lb11_calidad_codigo", "lb11_calidad_codigo", ccsText, "", CCGetRequestParam("lb11_calidad_codigo", ccsGet, NULL), $this);
        $this->lb11_def_fug_amb_prod = new clsControl(ccsLabel, "lb11_def_fug_amb_prod", "lb11_def_fug_amb_prod", ccsText, "", CCGetRequestParam("lb11_def_fug_amb_prod", ccsGet, NULL), $this);
        $this->l_calificacion_rs_AUT_TotalRecords = new clsControl(ccsLabel, "l_calificacion_rs_AUT_TotalRecords", "l_calificacion_rs_AUT_TotalRecords", ccsText, "", CCGetRequestParam("l_calificacion_rs_AUT_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_contador = new clsSorter($this->ComponentName, "Sorter_contador", $FileName, $this);
        $this->Sorter_servicio_cont = new clsSorter($this->ComponentName, "Sorter_servicio_cont", $FileName, $this);
        $this->Sorter_servicio_negocio = new clsSorter($this->ComponentName, "Sorter_servicio_negocio", $FileName, $this);
        $this->Sorter_id_ppmc = new clsSorter($this->ComponentName, "Sorter_id_ppmc", $FileName, $this);
        $this->Sorter_id_estimacion = new clsSorter($this->ComponentName, "Sorter_id_estimacion", $FileName, $this);
        $this->Sorter_tipo = new clsSorter($this->ComponentName, "Sorter_tipo", $FileName, $this);
        $this->Sorter_descripcion = new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
        $this->Sorter_herr_est_cost = new clsSorter($this->ComponentName, "Sorter_herr_est_cost", $FileName, $this);
        $this->Sorter_req_serv = new clsSorter($this->ComponentName, "Sorter_req_serv", $FileName, $this);
        $this->Sorter_cumpl_req_func = new clsSorter($this->ComponentName, "Sorter_cumpl_req_func", $FileName, $this);
        $this->Sorter_retr_entregable = new clsSorter($this->ComponentName, "Sorter_retr_entregable", $FileName, $this);
        $this->Sorter_calidad_prod_term = new clsSorter($this->ComponentName, "Sorter_calidad_prod_term", $FileName, $this);
        $this->Sorter_calidad_codigo = new clsSorter($this->ComponentName, "Sorter_calidad_codigo", $FileName, $this);
        $this->Sorter_def_fug_amb_prod = new clsSorter($this->ComponentName, "Sorter_def_fug_amb_prod", $FileName, $this);
        $this->Sorter_obs_manuales = new clsSorter($this->ComponentName, "Sorter_obs_manuales", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @308-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @308-902B3677
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
            $this->ControlsVisible["contador"] = $this->contador->Visible;
            $this->ControlsVisible["servicio_cont"] = $this->servicio_cont->Visible;
            $this->ControlsVisible["servicio_negocio"] = $this->servicio_negocio->Visible;
            $this->ControlsVisible["id_ppmc"] = $this->id_ppmc->Visible;
            $this->ControlsVisible["id_estimacion"] = $this->id_estimacion->Visible;
            $this->ControlsVisible["tipo"] = $this->tipo->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["herr_est_cost"] = $this->herr_est_cost->Visible;
            $this->ControlsVisible["req_serv"] = $this->req_serv->Visible;
            $this->ControlsVisible["cumpl_req_func"] = $this->cumpl_req_func->Visible;
            $this->ControlsVisible["retr_entregable"] = $this->retr_entregable->Visible;
            $this->ControlsVisible["calidad_prod_term"] = $this->calidad_prod_term->Visible;
            $this->ControlsVisible["calidad_codigo"] = $this->calidad_codigo->Visible;
            $this->ControlsVisible["def_fug_amb_prod"] = $this->def_fug_amb_prod->Visible;
            $this->ControlsVisible["obs_manuales"] = $this->obs_manuales->Visible;
            $this->ControlsVisible["lb11_herr_est_cost"] = $this->lb11_herr_est_cost->Visible;
            $this->ControlsVisible["lb11_req_serv"] = $this->lb11_req_serv->Visible;
            $this->ControlsVisible["lb11_cumpl_req_func"] = $this->lb11_cumpl_req_func->Visible;
            $this->ControlsVisible["lb11_retr_entregable"] = $this->lb11_retr_entregable->Visible;
            $this->ControlsVisible["lb11_calidad_prod_term"] = $this->lb11_calidad_prod_term->Visible;
            $this->ControlsVisible["lb11_calidad_codigo"] = $this->lb11_calidad_codigo->Visible;
            $this->ControlsVisible["lb11_def_fug_amb_prod"] = $this->lb11_def_fug_amb_prod->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->contador->SetValue($this->DataSource->contador->GetValue());
                $this->servicio_cont->SetValue($this->DataSource->servicio_cont->GetValue());
                $this->servicio_negocio->SetValue($this->DataSource->servicio_negocio->GetValue());
                $this->id_ppmc->SetValue($this->DataSource->id_ppmc->GetValue());
                $this->id_estimacion->SetValue($this->DataSource->id_estimacion->GetValue());
                $this->tipo->SetValue($this->DataSource->tipo->GetValue());
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->herr_est_cost->SetValue($this->DataSource->herr_est_cost->GetValue());
                $this->req_serv->SetValue($this->DataSource->req_serv->GetValue());
                $this->cumpl_req_func->SetValue($this->DataSource->cumpl_req_func->GetValue());
                $this->retr_entregable->SetValue($this->DataSource->retr_entregable->GetValue());
                $this->calidad_prod_term->SetValue($this->DataSource->calidad_prod_term->GetValue());
                $this->calidad_codigo->SetValue($this->DataSource->calidad_codigo->GetValue());
                $this->def_fug_amb_prod->SetValue($this->DataSource->def_fug_amb_prod->GetValue());
                $this->obs_manuales->SetValue($this->DataSource->obs_manuales->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->contador->Show();
                $this->servicio_cont->Show();
                $this->servicio_negocio->Show();
                $this->id_ppmc->Show();
                $this->id_estimacion->Show();
                $this->tipo->Show();
                $this->descripcion->Show();
                $this->herr_est_cost->Show();
                $this->req_serv->Show();
                $this->cumpl_req_func->Show();
                $this->retr_entregable->Show();
                $this->calidad_prod_term->Show();
                $this->calidad_codigo->Show();
                $this->def_fug_amb_prod->Show();
                $this->obs_manuales->Show();
                $this->lb11_herr_est_cost->Show();
                $this->lb11_req_serv->Show();
                $this->lb11_cumpl_req_func->Show();
                $this->lb11_retr_entregable->Show();
                $this->lb11_calidad_prod_term->Show();
                $this->lb11_calidad_codigo->Show();
                $this->lb11_def_fug_amb_prod->Show();
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
        $this->l_calificacion_rs_AUT_TotalRecords->Show();
        $this->Sorter_contador->Show();
        $this->Sorter_servicio_cont->Show();
        $this->Sorter_servicio_negocio->Show();
        $this->Sorter_id_ppmc->Show();
        $this->Sorter_id_estimacion->Show();
        $this->Sorter_tipo->Show();
        $this->Sorter_descripcion->Show();
        $this->Sorter_herr_est_cost->Show();
        $this->Sorter_req_serv->Show();
        $this->Sorter_cumpl_req_func->Show();
        $this->Sorter_retr_entregable->Show();
        $this->Sorter_calidad_prod_term->Show();
        $this->Sorter_calidad_codigo->Show();
        $this->Sorter_def_fug_amb_prod->Show();
        $this->Sorter_obs_manuales->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @308-E2F9BB0E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->contador->Errors->ToString());
        $errors = ComposeStrings($errors, $this->servicio_cont->Errors->ToString());
        $errors = ComposeStrings($errors, $this->servicio_negocio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id_ppmc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id_estimacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->herr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->req_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->retr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->calidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->calidad_codigo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->def_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->obs_manuales->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb11_herr_est_cost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb11_req_serv->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb11_cumpl_req_func->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb11_retr_entregable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb11_calidad_prod_term->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb11_calidad_codigo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb11_def_fug_amb_prod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End l_calificacion_rs_AUT Class @308-FCB6E20C

class clsl_calificacion_rs_AUTDataSource extends clsDBcon_xls {  //l_calificacion_rs_AUTDataSource Class @308-E049EFE6

//DataSource Variables @308-DC6F6105
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $contador;
    public $servicio_cont;
    public $servicio_negocio;
    public $id_ppmc;
    public $id_estimacion;
    public $tipo;
    public $descripcion;
    public $herr_est_cost;
    public $req_serv;
    public $cumpl_req_func;
    public $retr_entregable;
    public $calidad_prod_term;
    public $calidad_codigo;
    public $def_fug_amb_prod;
    public $obs_manuales;
//End DataSource Variables

//DataSourceClass_Initialize Event @308-4F2764E8
    function clsl_calificacion_rs_AUTDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid l_calificacion_rs_AUT";
        $this->Initialize();
        $this->contador = new clsField("contador", ccsInteger, "");
        
        $this->servicio_cont = new clsField("servicio_cont", ccsText, "");
        
        $this->servicio_negocio = new clsField("servicio_negocio", ccsText, "");
        
        $this->id_ppmc = new clsField("id_ppmc", ccsInteger, "");
        
        $this->id_estimacion = new clsField("id_estimacion", ccsInteger, "");
        
        $this->tipo = new clsField("tipo", ccsText, "");
        
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->herr_est_cost = new clsField("herr_est_cost", ccsText, "");
        
        $this->req_serv = new clsField("req_serv", ccsText, "");
        
        $this->cumpl_req_func = new clsField("cumpl_req_func", ccsText, "");
        
        $this->retr_entregable = new clsField("retr_entregable", ccsText, "");
        
        $this->calidad_prod_term = new clsField("calidad_prod_term", ccsText, "");
        
        $this->calidad_codigo = new clsField("calidad_codigo", ccsText, "");
        
        $this->def_fug_amb_prod = new clsField("def_fug_amb_prod", ccsText, "");
        
        $this->obs_manuales = new clsField("obs_manuales", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @308-E824E079
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.contador";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_contador" => array("contador", ""), 
            "Sorter_servicio_cont" => array("servicio_cont", ""), 
            "Sorter_servicio_negocio" => array("servicio_negocio", ""), 
            "Sorter_id_ppmc" => array("id_ppmc", ""), 
            "Sorter_id_estimacion" => array("id_estimacion", ""), 
            "Sorter_tipo" => array("tipo", ""), 
            "Sorter_descripcion" => array("descripcion", ""), 
            "Sorter_herr_est_cost" => array("herr_est_cost", ""), 
            "Sorter_req_serv" => array("req_serv", ""), 
            "Sorter_cumpl_req_func" => array("cumpl_req_func", ""), 
            "Sorter_retr_entregable" => array("retr_entregable", ""), 
            "Sorter_calidad_prod_term" => array("calidad_prod_term", ""), 
            "Sorter_calidad_codigo" => array("calidad_codigo", ""), 
            "Sorter_def_fug_amb_prod" => array("def_fug_amb_prod", ""), 
            "Sorter_obs_manuales" => array("obs_manuales", "")));
    }
//End SetOrder Method

//Prepare Method @308-5D0759C7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], CCGetSession("id_proveedor"), false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], "", false);
    }
//End Prepare Method

//Open Method @308-C99F9A15
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.* \n" .
        "FROM  l_calificacion_rs_AUT_SAT  a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM  l_calificacion_rs_AUT_SAT   b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'\n" .
        "AND b.estatus='F' \n" .
        ")) cnt";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} a.* \n" .
        "FROM  l_calificacion_rs_AUT_SAT  a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM  l_calificacion_rs_AUT_SAT   b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'\n" .
        "AND b.estatus='F' \n" .
        ") {SQL_OrderBy}";
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

//SetValues Method @308-F67172AA
    function SetValues()
    {
        $this->contador->SetDBValue(trim($this->f("contador")));
        $this->servicio_cont->SetDBValue($this->f("servicio_cont"));
        $this->servicio_negocio->SetDBValue($this->f("servicio_negocio"));
        $this->id_ppmc->SetDBValue(trim($this->f("id_ppmc")));
        $this->id_estimacion->SetDBValue(trim($this->f("id_estimacion")));
        $this->tipo->SetDBValue($this->f("tipo"));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->herr_est_cost->SetDBValue($this->f("herr_est_cost"));
        $this->req_serv->SetDBValue($this->f("req_serv"));
        $this->cumpl_req_func->SetDBValue($this->f("cumpl_req_func"));
        $this->retr_entregable->SetDBValue($this->f("retr_entregable"));
        $this->calidad_prod_term->SetDBValue($this->f("calidad_prod_term"));
        $this->calidad_codigo->SetDBValue($this->f("calidad_codigo"));
        $this->def_fug_amb_prod->SetDBValue($this->f("def_fug_amb_prod"));
        $this->obs_manuales->SetDBValue($this->f("obs_manuales"));
    }
//End SetValues Method

} //End l_calificacion_rs_AUTDataSource Class @308-FCB6E20C

class clsRecordl_calificacion_incidentes1 { //l_calificacion_incidentes1 Class @352-2A0C9BE3

//Variables @352-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @352-658490FE
    function clsRecordl_calificacion_incidentes1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record l_calificacion_incidentes1/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "l_calificacion_incidentes1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_id_proveedor = new clsControl(ccsListBox, "s_id_proveedor", "Id Proveedor", ccsText, "", CCGetRequestParam("s_id_proveedor", $Method, NULL), $this);
            $this->s_id_proveedor->DSType = dsSQL;
            $this->s_id_proveedor->DataSource = new clsDBcon_xls();
            $this->s_id_proveedor->ds = & $this->s_id_proveedor->DataSource;
            list($this->s_id_proveedor->BoundColumn, $this->s_id_proveedor->TextColumn, $this->s_id_proveedor->DBFormat) = array("id_proveedor", "nom_proveedor", "");
            $this->s_id_proveedor->DataSource->Parameters["sesid_proveedor"] = CCGetSession("id_proveedor", NULL);
            $this->s_id_proveedor->DataSource->Parameters["sescapc_cds"] = CCGetSession("capc_cds", NULL);
            $this->s_id_proveedor->DataSource->wp = new clsSQLParameters();
            $this->s_id_proveedor->DataSource->wp->AddParameter("1", "sesid_proveedor", ccsInteger, "", "", $this->s_id_proveedor->DataSource->Parameters["sesid_proveedor"], 0, false);
            $this->s_id_proveedor->DataSource->wp->AddParameter("2", "sescapc_cds", ccsText, "", "", $this->s_id_proveedor->DataSource->Parameters["sescapc_cds"], "", false);
            $this->s_id_proveedor->DataSource->SQL = "SELECT distinct id_proveedor, nom_proveedor \n" .
            "FROM usuario \n" .
            "where id_proveedor<>0 and \n" .
            "id_proveedor not in(Select id_proveedor u2 from usuario as u2 where u2.capc_cds='CAPC')\n" .
            "and (id_proveedor=" . $this->s_id_proveedor->DataSource->SQLValue($this->s_id_proveedor->DataSource->wp->GetDBValue("1"), ccsInteger) . "\n" .
            "	or '" . $this->s_id_proveedor->DataSource->SQLValue($this->s_id_proveedor->DataSource->wp->GetDBValue("2"), ccsText) . "'='CAPC')\n" .
            "\n" .
            "\n" .
            "";
            $this->s_id_proveedor->DataSource->Order = "";
            $this->s_id_periodo = new clsControl(ccsListBox, "s_id_periodo", "s_id_periodo", ccsText, "", CCGetRequestParam("s_id_periodo", $Method, NULL), $this);
            $this->s_id_periodo->DSType = dsSQL;
            $this->s_id_periodo->DataSource = new clsDBcon_xls();
            $this->s_id_periodo->ds = & $this->s_id_periodo->DataSource;
            list($this->s_id_periodo->BoundColumn, $this->s_id_periodo->TextColumn, $this->s_id_periodo->DBFormat) = array("id_periodo", "periodo", "");
            $this->s_id_periodo->DataSource->Parameters["sesid_proveedor"] = CCGetSession("id_proveedor", NULL);
            $this->s_id_periodo->DataSource->wp = new clsSQLParameters();
            $this->s_id_periodo->DataSource->wp->AddParameter("1", "sesid_proveedor", ccsInteger, "", "", $this->s_id_periodo->DataSource->Parameters["sesid_proveedor"], 0, false);
            $this->s_id_periodo->DataSource->SQL = "select distinct id_periodo,  periodo+tipo_periodo as periodo\n" .
            "from periodos_hist\n" .
            "where (id_proveedor=0 or id_proveedor=" . $this->s_id_periodo->DataSource->SQLValue($this->s_id_periodo->DataSource->wp->GetDBValue("1"), ccsInteger) . " or " . $this->s_id_periodo->DataSource->SQLValue($this->s_id_periodo->DataSource->wp->GetDBValue("1"), ccsInteger) . " =1)";
            $this->s_id_periodo->DataSource->Order = "";
            $this->s_opt_slas = new clsControl(ccsListBox, "s_opt_slas", "s_opt_slas", ccsText, "", CCGetRequestParam("s_opt_slas", $Method, NULL), $this);
            $this->s_opt_slas->DSType = dsListOfValues;
            $this->s_opt_slas->Values = array(array("SLA", "SLA"), array("SLO", "SLO"));
            $this->lb_periodo_fecha_carga2 = new clsControl(ccsLabel, "lb_periodo_fecha_carga2", "lb_periodo_fecha_carga2", ccsDate, array("dd", "/", "mm", "/", "yyyy", " ", "hh", ":", "mm"), CCGetRequestParam("lb_periodo_fecha_carga2", $Method, NULL), $this);
            $this->lb_periodo_fecha_carga2->HTML = true;
            $this->lb_nom_periodo = new clsControl(ccsLabel, "lb_nom_periodo", "lb_nom_periodo", ccsText, "", CCGetRequestParam("lb_nom_periodo", $Method, NULL), $this);
            $this->lb_nom_periodo->HTML = true;
            $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @352-B510F28A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_id_proveedor->Validate() && $Validation);
        $Validation = ($this->s_id_periodo->Validate() && $Validation);
        $Validation = ($this->s_opt_slas->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_id_proveedor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_id_periodo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_opt_slas->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @352-41EA360A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_id_proveedor->Errors->Count());
        $errors = ($errors || $this->s_id_periodo->Errors->Count());
        $errors = ($errors || $this->s_opt_slas->Errors->Count());
        $errors = ($errors || $this->lb_periodo_fecha_carga2->Errors->Count());
        $errors = ($errors || $this->lb_nom_periodo->Errors->Count());
        $errors = ($errors || $this->Label1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @352-DD94EE4C
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = $FileName;
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @352-6ACB8C14
    function Show()
    {
        global $CCSUseAmp;
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->s_id_proveedor->Prepare();
        $this->s_id_periodo->Prepare();
        $this->s_opt_slas->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_id_proveedor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_id_periodo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_opt_slas->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lb_periodo_fecha_carga2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lb_nom_periodo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->s_id_proveedor->Show();
        $this->s_id_periodo->Show();
        $this->s_opt_slas->Show();
        $this->lb_periodo_fecha_carga2->Show();
        $this->lb_nom_periodo->Show();
        $this->Label1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End l_calificacion_incidentes1 Class @352-FCB6E20C



class clsGridl_calificacion_incidentes { //l_calificacion_incidentes class @382-1366BE37

//Variables @382-FA5CD198

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
    public $Sorter_contador;
    public $Sorter_id_incidencia;
    public $Sorter_servicio_de_negocio;
    public $Sorter_nombre_del_producto;
    public $Sorter_severidad;
    public $Sorter_Cumple_Inc_TiempoAsignacion;
    public $Sorter_Cumple_Inc_TiempoSolucion;
    public $Sorter_Obs_Proceso;
//End Variables

//Class_Initialize Event @382-E749C249
    function clsGridl_calificacion_incidentes($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "l_calificacion_incidentes";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid l_calificacion_incidentes";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsl_calificacion_incidentesDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("l_calificacion_incidentesOrder", "");
        $this->SorterDirection = CCGetParam("l_calificacion_incidentesDir", "");

        $this->contador = new clsControl(ccsLabel, "contador", "contador", ccsInteger, "", CCGetRequestParam("contador", ccsGet, NULL), $this);
        $this->id_incidencia = new clsControl(ccsLabel, "id_incidencia", "id_incidencia", ccsText, "", CCGetRequestParam("id_incidencia", ccsGet, NULL), $this);
        $this->servicio_de_negocio = new clsControl(ccsLabel, "servicio_de_negocio", "servicio_de_negocio", ccsText, "", CCGetRequestParam("servicio_de_negocio", ccsGet, NULL), $this);
        $this->nombre_del_producto = new clsControl(ccsLabel, "nombre_del_producto", "nombre_del_producto", ccsText, "", CCGetRequestParam("nombre_del_producto", ccsGet, NULL), $this);
        $this->severidad = new clsControl(ccsLabel, "severidad", "severidad", ccsInteger, "", CCGetRequestParam("severidad", ccsGet, NULL), $this);
        $this->Cumple_Inc_TiempoAsignacion = new clsControl(ccsImage, "Cumple_Inc_TiempoAsignacion", "Cumple_Inc_TiempoAsignacion", ccsText, "", CCGetRequestParam("Cumple_Inc_TiempoAsignacion", ccsGet, NULL), $this);
        $this->Cumple_Inc_TiempoSolucion = new clsControl(ccsImage, "Cumple_Inc_TiempoSolucion", "Cumple_Inc_TiempoSolucion", ccsText, "", CCGetRequestParam("Cumple_Inc_TiempoSolucion", ccsGet, NULL), $this);
        $this->Obs_Proceso = new clsControl(ccsLabel, "Obs_Proceso", "Obs_Proceso", ccsText, "", CCGetRequestParam("Obs_Proceso", ccsGet, NULL), $this);
        $this->lb_Cumple_In_TiempoAsignacion = new clsControl(ccsLabel, "lb_Cumple_In_TiempoAsignacion", "lb_Cumple_In_TiempoAsignacion", ccsText, "", CCGetRequestParam("lb_Cumple_In_TiempoAsignacion", ccsGet, NULL), $this);
        $this->lb_Cumple_Inc_TiempoSolucion = new clsControl(ccsLabel, "lb_Cumple_Inc_TiempoSolucion", "lb_Cumple_Inc_TiempoSolucion", ccsText, "", CCGetRequestParam("lb_Cumple_Inc_TiempoSolucion", ccsGet, NULL), $this);
        $this->l_calificacion_incidentes_TotalRecords = new clsControl(ccsLabel, "l_calificacion_incidentes_TotalRecords", "l_calificacion_incidentes_TotalRecords", ccsText, "", CCGetRequestParam("l_calificacion_incidentes_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_contador = new clsSorter($this->ComponentName, "Sorter_contador", $FileName, $this);
        $this->Sorter_id_incidencia = new clsSorter($this->ComponentName, "Sorter_id_incidencia", $FileName, $this);
        $this->Sorter_servicio_de_negocio = new clsSorter($this->ComponentName, "Sorter_servicio_de_negocio", $FileName, $this);
        $this->Sorter_nombre_del_producto = new clsSorter($this->ComponentName, "Sorter_nombre_del_producto", $FileName, $this);
        $this->Sorter_severidad = new clsSorter($this->ComponentName, "Sorter_severidad", $FileName, $this);
        $this->Sorter_Cumple_Inc_TiempoAsignacion = new clsSorter($this->ComponentName, "Sorter_Cumple_Inc_TiempoAsignacion", $FileName, $this);
        $this->Sorter_Cumple_Inc_TiempoSolucion = new clsSorter($this->ComponentName, "Sorter_Cumple_Inc_TiempoSolucion", $FileName, $this);
        $this->Sorter_Obs_Proceso = new clsSorter($this->ComponentName, "Sorter_Obs_Proceso", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @382-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @382-E265569C
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
            $this->ControlsVisible["contador"] = $this->contador->Visible;
            $this->ControlsVisible["id_incidencia"] = $this->id_incidencia->Visible;
            $this->ControlsVisible["servicio_de_negocio"] = $this->servicio_de_negocio->Visible;
            $this->ControlsVisible["nombre_del_producto"] = $this->nombre_del_producto->Visible;
            $this->ControlsVisible["severidad"] = $this->severidad->Visible;
            $this->ControlsVisible["Cumple_Inc_TiempoAsignacion"] = $this->Cumple_Inc_TiempoAsignacion->Visible;
            $this->ControlsVisible["Cumple_Inc_TiempoSolucion"] = $this->Cumple_Inc_TiempoSolucion->Visible;
            $this->ControlsVisible["Obs_Proceso"] = $this->Obs_Proceso->Visible;
            $this->ControlsVisible["lb_Cumple_In_TiempoAsignacion"] = $this->lb_Cumple_In_TiempoAsignacion->Visible;
            $this->ControlsVisible["lb_Cumple_Inc_TiempoSolucion"] = $this->lb_Cumple_Inc_TiempoSolucion->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->contador->SetValue($this->DataSource->contador->GetValue());
                $this->id_incidencia->SetValue($this->DataSource->id_incidencia->GetValue());
                $this->servicio_de_negocio->SetValue($this->DataSource->servicio_de_negocio->GetValue());
                $this->nombre_del_producto->SetValue($this->DataSource->nombre_del_producto->GetValue());
                $this->severidad->SetValue($this->DataSource->severidad->GetValue());
                $this->Cumple_Inc_TiempoAsignacion->SetValue($this->DataSource->Cumple_Inc_TiempoAsignacion->GetValue());
                $this->Cumple_Inc_TiempoSolucion->SetValue($this->DataSource->Cumple_Inc_TiempoSolucion->GetValue());
                $this->Obs_Proceso->SetValue($this->DataSource->Obs_Proceso->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->contador->Show();
                $this->id_incidencia->Show();
                $this->servicio_de_negocio->Show();
                $this->nombre_del_producto->Show();
                $this->severidad->Show();
                $this->Cumple_Inc_TiempoAsignacion->Show();
                $this->Cumple_Inc_TiempoSolucion->Show();
                $this->Obs_Proceso->Show();
                $this->lb_Cumple_In_TiempoAsignacion->Show();
                $this->lb_Cumple_Inc_TiempoSolucion->Show();
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
        $this->l_calificacion_incidentes_TotalRecords->Show();
        $this->Sorter_contador->Show();
        $this->Sorter_id_incidencia->Show();
        $this->Sorter_servicio_de_negocio->Show();
        $this->Sorter_nombre_del_producto->Show();
        $this->Sorter_severidad->Show();
        $this->Sorter_Cumple_Inc_TiempoAsignacion->Show();
        $this->Sorter_Cumple_Inc_TiempoSolucion->Show();
        $this->Sorter_Obs_Proceso->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @382-6D7F9245
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->contador->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id_incidencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->servicio_de_negocio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_del_producto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->severidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Cumple_Inc_TiempoAsignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Cumple_Inc_TiempoSolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Obs_Proceso->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_Cumple_In_TiempoAsignacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lb_Cumple_Inc_TiempoSolucion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End l_calificacion_incidentes Class @382-FCB6E20C

class clsl_calificacion_incidentesDataSource extends clsDBcon_xls {  //l_calificacion_incidentesDataSource Class @382-4FB96D20

//DataSource Variables @382-A3811EDE
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $contador;
    public $id_incidencia;
    public $servicio_de_negocio;
    public $nombre_del_producto;
    public $severidad;
    public $Cumple_Inc_TiempoAsignacion;
    public $Cumple_Inc_TiempoSolucion;
    public $Obs_Proceso;
//End DataSource Variables

//DataSourceClass_Initialize Event @382-5BF4282C
    function clsl_calificacion_incidentesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid l_calificacion_incidentes";
        $this->Initialize();
        $this->contador = new clsField("contador", ccsInteger, "");
        
        $this->id_incidencia = new clsField("id_incidencia", ccsText, "");
        
        $this->servicio_de_negocio = new clsField("servicio_de_negocio", ccsText, "");
        
        $this->nombre_del_producto = new clsField("nombre_del_producto", ccsText, "");
        
        $this->severidad = new clsField("severidad", ccsInteger, "");
        
        $this->Cumple_Inc_TiempoAsignacion = new clsField("Cumple_Inc_TiempoAsignacion", ccsText, "");
        
        $this->Cumple_Inc_TiempoSolucion = new clsField("Cumple_Inc_TiempoSolucion", ccsText, "");
        
        $this->Obs_Proceso = new clsField("Obs_Proceso", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @382-84967BE1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.contador";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_contador" => array("contador", ""), 
            "Sorter_id_incidencia" => array("id_incidencia", ""), 
            "Sorter_servicio_de_negocio" => array("servicio_de_negocio", ""), 
            "Sorter_nombre_del_producto" => array("nombre_del_producto", ""), 
            "Sorter_severidad" => array("severidad", ""), 
            "Sorter_Cumple_Inc_TiempoAsignacion" => array("Cumple_Inc_TiempoAsignacion", ""), 
            "Sorter_Cumple_Inc_TiempoSolucion" => array("Cumple_Inc_TiempoSolucion", ""), 
            "Sorter_Obs_Proceso" => array("Obs_Proceso", "")));
    }
//End SetOrder Method

//Prepare Method @382-5D0759C7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], CCGetSession("id_proveedor"), false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], "", false);
    }
//End Prepare Method

//Open Method @382-9652A16D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.* \n" .
        "FROM l_calificacion_incidentes_AUT_SAT a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_calificacion_incidentes_AUT_SAT b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ")) cnt";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} a.* \n" .
        "FROM l_calificacion_incidentes_AUT_SAT a\n" .
        "WHERE a.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND a.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND a.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND a.estatus='F'\n" .
        "and  a.num_carga=(\n" .
        "SELECT max(b.num_carga)\n" .
        "FROM l_calificacion_incidentes_AUT_SAT b\n" .
        "WHERE b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "AND b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "AND b.estatus='F'\n" .
        ") {SQL_OrderBy}";
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

//SetValues Method @382-0A6ED0F5
    function SetValues()
    {
        $this->contador->SetDBValue(trim($this->f("contador")));
        $this->id_incidencia->SetDBValue($this->f("id_incidencia"));
        $this->servicio_de_negocio->SetDBValue($this->f("servicio_de_negocio"));
        $this->nombre_del_producto->SetDBValue($this->f("nombre_del_producto"));
        $this->severidad->SetDBValue(trim($this->f("severidad")));
        $this->Cumple_Inc_TiempoAsignacion->SetDBValue($this->f("Cumple_Inc_TiempoAsignacion"));
        $this->Cumple_Inc_TiempoSolucion->SetDBValue($this->f("Cumple_Inc_TiempoSolucion"));
        $this->Obs_Proceso->SetDBValue($this->f("Obs_Proceso"));
    }
//End SetValues Method

} //End l_calificacion_incidentesDataSource Class @382-FCB6E20C

class clsGridresumen { //resumen class @440-C13F06D0

//Variables @440-13BF1489

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
    public $Sorter_Medicion;
    public $Sorter_Total;
//End Variables

//Class_Initialize Event @440-4B2C0587
    function clsGridresumen($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "resumen";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid resumen";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsresumenDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("resumenOrder", "");
        $this->SorterDirection = CCGetParam("resumenDir", "");

        $this->Medicion = new clsControl(ccsLabel, "Medicion", "Medicion", ccsText, "", CCGetRequestParam("Medicion", ccsGet, NULL), $this);
        $this->Total = new clsControl(ccsLabel, "Total", "Total", ccsInteger, "", CCGetRequestParam("Total", ccsGet, NULL), $this);
        $this->resumen_TotalRecords = new clsControl(ccsLabel, "resumen_TotalRecords", "resumen_TotalRecords", ccsText, "", CCGetRequestParam("resumen_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_Medicion = new clsSorter($this->ComponentName, "Sorter_Medicion", $FileName, $this);
        $this->Sorter_Total = new clsSorter($this->ComponentName, "Sorter_Total", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @440-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @440-5DD4A007
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
            $this->ControlsVisible["Medicion"] = $this->Medicion->Visible;
            $this->ControlsVisible["Total"] = $this->Total->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Medicion->SetValue($this->DataSource->Medicion->GetValue());
                $this->Total->SetValue($this->DataSource->Total->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Medicion->Show();
                $this->Total->Show();
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
        $this->resumen_TotalRecords->Show();
        $this->Sorter_Medicion->Show();
        $this->Sorter_Total->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @440-32AFE906
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Medicion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Total->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End resumen Class @440-FCB6E20C

class clsresumenDataSource extends clsDBcon_xls {  //resumenDataSource Class @440-6EE4ACE1

//DataSource Variables @440-C37DC002
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Medicion;
    public $Total;
//End DataSource Variables

//DataSourceClass_Initialize Event @440-B7535646
    function clsresumenDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid resumen";
        $this->Initialize();
        $this->Medicion = new clsField("Medicion", ccsText, "");
        
        $this->Total = new clsField("Total", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @440-CC3A11D5
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_Medicion" => array("Medicion", ""), 
            "Sorter_Total" => array("Total", "")));
    }
//End SetOrder Method

//Prepare Method @440-CA793EC1
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], CCGetSession("id_proveedor"), false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], '', false);
    }
//End Prepare Method

//Open Method @440-D3DA5637
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "FROM resumen_SAT \n" .
        "WHERE id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "and   fecha_visible<=getDATE()) cnt";
        $this->SQL = "SELECT * \n" .
        "FROM resumen_SAT \n" .
        "WHERE id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "and   fecha_visible<=getDATE()";
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

//SetValues Method @440-17F709C0
    function SetValues()
    {
        $this->Medicion->SetDBValue($this->f("Medicion"));
        $this->Total->SetDBValue(trim($this->f("Total")));
    }
//End SetValues Method

} //End resumenDataSource Class @440-FCB6E20C

class clsGridGrid1 { //Grid1 class @2-E857A572

//Variables @2-6E51DF5A

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
//End Variables

//Class_Initialize Event @2-06DE3174
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

//Show Method @2-A2716E91
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

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-5D0759C7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], CCGetSession("id_proveedor"), false);
        $this->wp->AddParameter("2", "urls_id_periodo", ccsInteger, "", "", $this->Parameters["urls_id_periodo"], 0, false);
        $this->wp->AddParameter("3", "urls_opt_slas", ccsText, "", "", $this->Parameters["urls_opt_slas"], "", false);
    }
//End Prepare Method

//Open Method @2-88462DA5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select  sc.descripcion,\n" .
        "	 sum(case when herr_est_cost='1' or herr_est_cost='0' then 1 else 0 end) totherr_est_cost, \n" .
        "		sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end) cumplenherr_est_cost, \n" .
        "		case when sum(case when herr_est_cost='1' or herr_est_cost='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end)/cast((sum(case when herr_est_cost='1' or herr_est_cost='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end herr_est_cost,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='herr_est_cost') as meta_herr_est_cost,\n" .
        "	 \n" .
        "	 sum(case when req_serv='1' or req_serv='0' then 1 else 0 end) totreq_serv, \n" .
        "		sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end) cumplenreq_serv, \n" .
        "		case when sum(case when req_serv='1' or req_serv='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end)/cast((sum(case when req_serv='1' or req_serv='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end req_serv,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='req_serv') as meta_req_serv,\n" .
        "	 \n" .
        "	 sum(case when cumpl_req_func='1' or cumpl_req_func='0' then 1 else 0 end) totcumpl_req_func, \n" .
        "		sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end) cumplencumpl_req_func, \n" .
        "		case when sum(case when cumpl_req_func='1' or cumpl_req_func='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end)/cast((sum(case when cumpl_req_func='1' or cumpl_req_func='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end cumpl_req_func ,\n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='cumpl_req_func') as meta_cumpl_req_func,\n" .
        "	 \n" .
        "	 \n" .
        "	 sum(case when calidad_prod_term='1' or calidad_prod_term='0' then 1 else 0 end) totcalidad_prod_term, \n" .
        "		sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end) cumplencalidad_prod_term, \n" .
        "		case when sum(case when calidad_prod_term='1' or calidad_prod_term='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end)/\n" .
        "		 cast(	(sum(case when calidad_prod_term='1' or calidad_prod_term='0' then 1 else 0 end))AS float)*100 \n" .
        "		else 0 end calidad_prod_term,\n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='calidad_prod_term') as meta_calidad_prod_term,\n" .
        "	\n" .
        "	\n" .
        "	 sum(case when retr_entregable='1' or retr_entregable='0' then 1 else 0 end) totretr_entregable, \n" .
        "		sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end) cumplenretr_entregable, \n" .
        "		case when sum(case when retr_entregable='1' or retr_entregable='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end)/cast((sum(case when retr_entregable='1' or retr_entregable='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end retr_entregable,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='retr_entregable') as meta_retr_entregable,\n" .
        "	 \n" .
        "	 sum(case when calidad_codigo='1' or calidad_codigo='0' then 1 else 0 end) totcal_cod, \n" .
        "		sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end) cumplencal_cod, \n" .
        "		case when sum(case when calidad_codigo='1' or calidad_codigo='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end)/cast((sum(case when calidad_codigo='1' or calidad_codigo='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end cal_cod,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='cal_cod') as meta_cal_cod,\n" .
        "	 \n" .
        "	 sum(case when def_fug_amb_prod='1' or def_fug_amb_prod='0' then 1 else 0 end) totdef_fug_amb_prod, \n" .
        "		sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end) cumplendef_fug_amb_prod, \n" .
        "		case when sum(case when def_fug_amb_prod='1' or def_fug_amb_prod='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end)/cast((sum(case when def_fug_amb_prod='1' or def_fug_amb_prod='0' then 1 else 0 end)) as float)*100  \n" .
        "		else 0 end def_fug_amb_prod,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='def_fug_amb_prod') as meta_def_fug_amb_prod,\n" .
        "	 \n" .
        "	 sum(case when cumple_inc_tiempoasignacion='1' or cumple_inc_tiempoasignacion='0' then 1 else 0 end)  totinc_tiempoasignacion, \n" .
        "		sum(case when isnumeric(cumple_inc_tiempoasignacion)=1 then cast(cumple_inc_tiempoasignacion as int) else 0 end) cumpleninc_tiempoasignacion, \n" .
        "		case when sum(case when cumple_inc_tiempoasignacion='1' or cumple_inc_tiempoasignacion='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(cumple_inc_tiempoasignacion)=1 then cast(cumple_inc_tiempoasignacion as int) else 0 end)/cast((sum(case when cumple_inc_tiempoasignacion='1' or cumple_inc_tiempoasignacion='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end inc_tiempoasignacion,\n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='inc_tiempoasignacion') as meta_inc_tiempoasignacion,\n" .
        "	\n" .
        "	 sum(case when cumple_inc_tiemposolucion='1' or cumple_inc_tiemposolucion='0' then 1 else 0 end) totinc_tiemposolucion, \n" .
        "		sum(case when isnumeric(cumple_inc_tiempoSolucion)=1 then cast(cumple_inc_tiempoSolucion as int) else 0 end) cumpleninc_tiemposolucion, \n" .
        "		case when sum(case when cumple_inc_tiemposolucion='1' or cumple_inc_tiemposolucion='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(cumple_inc_tiempoSolucion)=1 then cast(cumple_inc_tiempoSolucion as int) else 0 end)/cast((sum(case when cumple_inc_tiemposolucion='1' or cumple_inc_tiemposolucion='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end inc_tiemposolucion,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='inc_tiemposolucion') as meta_inc_tiemposolucion,\n" .
        "	 	\n" .
        "	 	 AVG(Cumple_EF) cumplenefic_presup, AVG(total_ef) totefic_presup, avg(cast(Cumple_EF as float))/avg(total_ef)*100  efic_presup,\n" .
        "	 (Select Meta from [archivosxls].[dbo].mc_c_metrica where acronimo='EFIC_PRESUP') as meta_efic_presup\n" .
        "from [archivosxls].[dbo].mc_c_ServContractual sc \n" .
        "left join (select * from [archivosxls].[dbo].l_calificacion_rs_aut_SAT m\n" .
        "	where m.id_periodo= " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "    and m.id_proveedor =" . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and m.tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and m.estatus ='F' \n" .
        "	and num_carga=(\n" .
        "       select max(b.num_carga)\n" .
        "       from [archivosxls].[dbo].l_calificacion_rs_aut_SAT  b\n" .
        "       where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " \n" .
        "       and b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "       and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "       and b.estatus='F'\n" .
        "       )) m on sc.Descripcion  = m.servicio_cont  \n" .
        "	 left join	(select cumple_inc_tiempoasignacion, cumple_inc_tiempoSolucion, \n" .
        "				id_proveedor, 'Servicio de Soporte de Aplicaciones'  servicio_cont\n" .
        "				from [archivosxls].[dbo].l_calificacion_incidentes_AUT_SAT\n" .
        "				where (id_periodo= " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "   and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "  and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'   and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from [archivosxls].[dbo].l_calificacion_incidentes_aut_SAT b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "  and b.id_periodo =   " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and b.estatus='F' ) \n" .
        "				) )  mi on  mi.servicio_cont = sc.Descripcion \n" .
        "	left join (select SUM(case when efic_presupuestal='1' then 1 else 0 end) Cumple_EF, COUNT(efic_presupuestal) Total_EF, Id_Proveedor,  2 IdServicioCont  \n" .
        "			from [archivosxls].[dbo].l_detalle_eficiencia_presupuestal_SAT \n" .
        "			where (id_periodo=  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "   and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "  and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'   and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from [archivosxls].[dbo].l_calificacion_incidentes_aut_SAT b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "  and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and b.estatus='F' ) \n" .
        "				) group by id_proveedor ) ef on ef.IdServicioCont = sc.id\n" .
        "where sc.Aplica ='CDS' and IdOld <>0\n" .
        "group by sc.Descripcion) cnt";
        $this->SQL = "select  sc.descripcion,\n" .
        "	 sum(case when herr_est_cost='1' or herr_est_cost='0' then 1 else 0 end) totherr_est_cost, \n" .
        "		sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end) cumplenherr_est_cost, \n" .
        "		case when sum(case when herr_est_cost='1' or herr_est_cost='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end)/cast((sum(case when herr_est_cost='1' or herr_est_cost='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end herr_est_cost,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='herr_est_cost') as meta_herr_est_cost,\n" .
        "	 \n" .
        "	 sum(case when req_serv='1' or req_serv='0' then 1 else 0 end) totreq_serv, \n" .
        "		sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end) cumplenreq_serv, \n" .
        "		case when sum(case when req_serv='1' or req_serv='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end)/cast((sum(case when req_serv='1' or req_serv='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end req_serv,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='req_serv') as meta_req_serv,\n" .
        "	 \n" .
        "	 sum(case when cumpl_req_func='1' or cumpl_req_func='0' then 1 else 0 end) totcumpl_req_func, \n" .
        "		sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end) cumplencumpl_req_func, \n" .
        "		case when sum(case when cumpl_req_func='1' or cumpl_req_func='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end)/cast((sum(case when cumpl_req_func='1' or cumpl_req_func='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end cumpl_req_func ,\n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='cumpl_req_func') as meta_cumpl_req_func,\n" .
        "	 \n" .
        "	 \n" .
        "	 sum(case when calidad_prod_term='1' or calidad_prod_term='0' then 1 else 0 end) totcalidad_prod_term, \n" .
        "		sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end) cumplencalidad_prod_term, \n" .
        "		case when sum(case when calidad_prod_term='1' or calidad_prod_term='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end)/\n" .
        "		 cast(	(sum(case when calidad_prod_term='1' or calidad_prod_term='0' then 1 else 0 end))AS float)*100 \n" .
        "		else 0 end calidad_prod_term,\n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='calidad_prod_term') as meta_calidad_prod_term,\n" .
        "	\n" .
        "	\n" .
        "	 sum(case when retr_entregable='1' or retr_entregable='0' then 1 else 0 end) totretr_entregable, \n" .
        "		sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end) cumplenretr_entregable, \n" .
        "		case when sum(case when retr_entregable='1' or retr_entregable='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end)/cast((sum(case when retr_entregable='1' or retr_entregable='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end retr_entregable,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='retr_entregable') as meta_retr_entregable,\n" .
        "	 \n" .
        "	 sum(case when calidad_codigo='1' or calidad_codigo='0' then 1 else 0 end) totcal_cod, \n" .
        "		sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end) cumplencal_cod, \n" .
        "		case when sum(case when calidad_codigo='1' or calidad_codigo='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end)/cast((sum(case when calidad_codigo='1' or calidad_codigo='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end cal_cod,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='cal_cod') as meta_cal_cod,\n" .
        "	 \n" .
        "	 sum(case when def_fug_amb_prod='1' or def_fug_amb_prod='0' then 1 else 0 end) totdef_fug_amb_prod, \n" .
        "		sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end) cumplendef_fug_amb_prod, \n" .
        "		case when sum(case when def_fug_amb_prod='1' or def_fug_amb_prod='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end)/cast((sum(case when def_fug_amb_prod='1' or def_fug_amb_prod='0' then 1 else 0 end)) as float)*100  \n" .
        "		else 0 end def_fug_amb_prod,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='def_fug_amb_prod') as meta_def_fug_amb_prod,\n" .
        "	 \n" .
        "	 sum(case when cumple_inc_tiempoasignacion='1' or cumple_inc_tiempoasignacion='0' then 1 else 0 end)  totinc_tiempoasignacion, \n" .
        "		sum(case when isnumeric(cumple_inc_tiempoasignacion)=1 then cast(cumple_inc_tiempoasignacion as int) else 0 end) cumpleninc_tiempoasignacion, \n" .
        "		case when sum(case when cumple_inc_tiempoasignacion='1' or cumple_inc_tiempoasignacion='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(cumple_inc_tiempoasignacion)=1 then cast(cumple_inc_tiempoasignacion as int) else 0 end)/cast((sum(case when cumple_inc_tiempoasignacion='1' or cumple_inc_tiempoasignacion='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end inc_tiempoasignacion,\n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='inc_tiempoasignacion') as meta_inc_tiempoasignacion,\n" .
        "	\n" .
        "	 sum(case when cumple_inc_tiemposolucion='1' or cumple_inc_tiemposolucion='0' then 1 else 0 end) totinc_tiemposolucion, \n" .
        "		sum(case when isnumeric(cumple_inc_tiempoSolucion)=1 then cast(cumple_inc_tiempoSolucion as int) else 0 end) cumpleninc_tiemposolucion, \n" .
        "		case when sum(case when cumple_inc_tiemposolucion='1' or cumple_inc_tiemposolucion='0' then 1 else 0 end)>0 then \n" .
        "			sum(case when isnumeric(cumple_inc_tiempoSolucion)=1 then cast(cumple_inc_tiempoSolucion as int) else 0 end)/cast((sum(case when cumple_inc_tiemposolucion='1' or cumple_inc_tiemposolucion='0' then 1 else 0 end)) as float)*100 \n" .
        "		else 0 end inc_tiemposolucion,	 \n" .
        "	 (select meta from [archivosxls].[dbo].mc_c_metrica where acronimo='inc_tiemposolucion') as meta_inc_tiemposolucion,\n" .
        "	 	\n" .
        "	 	 AVG(Cumple_EF) cumplenefic_presup, AVG(total_ef) totefic_presup, avg(cast(Cumple_EF as float))/avg(total_ef)*100  efic_presup,\n" .
        "	 (Select Meta from [archivosxls].[dbo].mc_c_metrica where acronimo='EFIC_PRESUP') as meta_efic_presup\n" .
        "from [archivosxls].[dbo].mc_c_ServContractual sc \n" .
        "left join (select * from [archivosxls].[dbo].l_calificacion_rs_aut_SAT m\n" .
        "	where m.id_periodo= " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "    and m.id_proveedor =" . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and m.tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' and m.estatus ='F' \n" .
        "	and num_carga=(\n" .
        "       select max(b.num_carga)\n" .
        "       from [archivosxls].[dbo].l_calificacion_rs_aut_SAT  b\n" .
        "       where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " \n" .
        "       and b.id_periodo =  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "       and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' \n" .
        "       and b.estatus='F'\n" .
        "       )) m on sc.Descripcion  = m.servicio_cont  \n" .
        "	 left join	(select cumple_inc_tiempoasignacion, cumple_inc_tiempoSolucion, \n" .
        "				id_proveedor, 'Servicio de Soporte de Aplicaciones'  servicio_cont\n" .
        "				from [archivosxls].[dbo].l_calificacion_incidentes_AUT_SAT\n" .
        "				where (id_periodo= " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "   and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "  and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'   and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from [archivosxls].[dbo].l_calificacion_incidentes_aut_SAT b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "  and b.id_periodo =   " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and b.estatus='F' ) \n" .
        "				) )  mi on  mi.servicio_cont = sc.Descripcion \n" .
        "	left join (select SUM(case when efic_presupuestal='1' then 1 else 0 end) Cumple_EF, COUNT(efic_presupuestal) Total_EF, Id_Proveedor,  2 IdServicioCont  \n" .
        "			from [archivosxls].[dbo].l_detalle_eficiencia_presupuestal_SAT \n" .
        "			where (id_periodo=  " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "   and id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "  and tipo_nivel_servicio ='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'   and estatus ='F'\n" .
        "				and num_carga=(select max(b.num_carga) from [archivosxls].[dbo].l_calificacion_incidentes_aut_SAT b \n" .
        "				where b.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "  and b.id_periodo = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "  and b.tipo_nivel_servicio = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'  and b.estatus='F' ) \n" .
        "				) group by id_proveedor ) ef on ef.IdServicioCont = sc.id\n" .
        "where sc.Aplica ='CDS' and IdOld <>0\n" .
        "group by sc.Descripcion";
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

//SetValues Method @2-87A0602F
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
        $this->cumplenefic_presup->SetDBValue(trim($this->f("cumplenefic_presup")));
        $this->totefic_presup->SetDBValue(trim($this->f("totefic_presup")));
        $this->efic_presup->SetDBValue($this->f("efic_presup"));
        $this->meta_efic_presup->SetDBValue($this->f("meta_efic_presup"));
    }
//End SetValues Method

} //End Grid1DataSource Class @2-FCB6E20C

//Initialize Page @1-B1E736CF
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
$TemplateFileName = "historico_cargas_rs2.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-9A853C01
include_once("./historico_cargas_rs2_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9614C244
$DBcon_xls = new clsDBcon_xls();
$MainPage->Connections["con_xls"] = & $DBcon_xls;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$Header = new clsHeader("", "Header", $MainPage);
$Header->Initialize();
$lb_resumen = new clsControl(ccsLabel, "lb_resumen", "lb_resumen", ccsText, "", CCGetRequestParam("lb_resumen", ccsGet, NULL), $MainPage);
$lb_resumen->HTML = true;
$l_detalle_medicion_apertu = new clsGridl_detalle_medicion_apertu("", $MainPage);
$l_detalle_medicion_cierre = new clsGridl_detalle_medicion_cierre("", $MainPage);
$l_detalle_medicion_inc = new clsGridl_detalle_medicion_inc("", $MainPage);
$l_detalle_eficiencia_pres = new clsGridl_detalle_eficiencia_pres("", $MainPage);
$l_calificacion_rs_AUT = new clsGridl_calificacion_rs_AUT("", $MainPage);
$l_calificacion_incidentes1 = new clsRecordl_calificacion_incidentes1("", $MainPage);
$l_calificacion_incidentes = new clsGridl_calificacion_incidentes("", $MainPage);
$resumen = new clsGridresumen("", $MainPage);
$lb_periodo_fecha_carga = new clsControl(ccsLabel, "lb_periodo_fecha_carga", "lb_periodo_fecha_carga", ccsText, "", CCGetRequestParam("lb_periodo_fecha_carga", ccsGet, NULL), $MainPage);
$lb_periodo_fecha_carga->HTML = true;
$Grid1 = new clsGridGrid1("", $MainPage);
$lb_efic_presup = new clsControl(ccsLabel, "lb_efic_presup", "lb_efic_presup", ccsText, "", CCGetRequestParam("lb_efic_presup", ccsGet, NULL), $MainPage);
$Imprimir = new clsButton("Imprimir", ccsGet, $MainPage);
$MainPage->Header = & $Header;
$MainPage->lb_resumen = & $lb_resumen;
$MainPage->l_detalle_medicion_apertu = & $l_detalle_medicion_apertu;
$MainPage->l_detalle_medicion_cierre = & $l_detalle_medicion_cierre;
$MainPage->l_detalle_medicion_inc = & $l_detalle_medicion_inc;
$MainPage->l_detalle_eficiencia_pres = & $l_detalle_eficiencia_pres;
$MainPage->l_calificacion_rs_AUT = & $l_calificacion_rs_AUT;
$MainPage->l_calificacion_incidentes1 = & $l_calificacion_incidentes1;
$MainPage->l_calificacion_incidentes = & $l_calificacion_incidentes;
$MainPage->resumen = & $resumen;
$MainPage->lb_periodo_fecha_carga = & $lb_periodo_fecha_carga;
$MainPage->Grid1 = & $Grid1;
$MainPage->lb_efic_presup = & $lb_efic_presup;
$MainPage->Imprimir = & $Imprimir;
$l_detalle_medicion_apertu->Initialize();
$l_detalle_medicion_cierre->Initialize();
$l_detalle_medicion_inc->Initialize();
$l_detalle_eficiencia_pres->Initialize();
$l_calificacion_rs_AUT->Initialize();
$l_calificacion_incidentes->Initialize();
$resumen->Initialize();
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

//Execute Components @1-7D906631
$l_calificacion_incidentes1->Operation();
$Header->Operations();
//End Execute Components

//Go to destination page @1-733DC610
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($l_detalle_medicion_apertu);
    unset($l_detalle_medicion_cierre);
    unset($l_detalle_medicion_inc);
    unset($l_detalle_eficiencia_pres);
    unset($l_calificacion_rs_AUT);
    unset($l_calificacion_incidentes1);
    unset($l_calificacion_incidentes);
    unset($resumen);
    unset($Grid1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A4CAFED8
$Header->Show();
$l_detalle_medicion_apertu->Show();
$l_detalle_medicion_cierre->Show();
$l_detalle_medicion_inc->Show();
$l_detalle_eficiencia_pres->Show();
$l_calificacion_rs_AUT->Show();
$l_calificacion_incidentes1->Show();
$l_calificacion_incidentes->Show();
$resumen->Show();
$Grid1->Show();
$Imprimir->Show();
$lb_resumen->Show();
$lb_periodo_fecha_carga->Show();
$lb_efic_presup->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $TemplateEncoding);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2E4051F0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
$Header->Class_Terminate();
unset($Header);
unset($l_detalle_medicion_apertu);
unset($l_detalle_medicion_cierre);
unset($l_detalle_medicion_inc);
unset($l_detalle_eficiencia_pres);
unset($l_calificacion_rs_AUT);
unset($l_calificacion_incidentes1);
unset($l_calificacion_incidentes);
unset($resumen);
unset($Grid1);
unset($Tpl);
//End Unload Page


?>
