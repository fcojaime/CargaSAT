<?php
//Include Common Files @1-5BBD7AA1
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "periodo4.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridperiodos_carga { //periodos_carga class @2-CA7471C5

//Variables @2-791A1921

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
    public $Sorter_id_periodo;
    public $Sorter_anio;
    public $Sorter_nombre_mes;
    public $Sorter_fecha_limite;
    public $Sorter_num_intentos_permitidos;
    public $Sorter_tipo_periodo;
    public $Sorter_id_proveedor;
//End Variables

//Class_Initialize Event @2-DDD0302C
    function clsGridperiodos_carga($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "periodos_carga";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid periodos_carga";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsperiodos_cargaDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("periodos_cargaOrder", "");
        $this->SorterDirection = CCGetParam("periodos_cargaDir", "");

        $this->id_periodo = new clsControl(ccsLink, "id_periodo", "id_periodo", ccsInteger, "", CCGetRequestParam("id_periodo", ccsGet, NULL), $this);
        $this->id_periodo->Page = "";
        $this->anio = new clsControl(ccsLabel, "anio", "anio", ccsInteger, "", CCGetRequestParam("anio", ccsGet, NULL), $this);
        $this->nombre_mes = new clsControl(ccsLabel, "nombre_mes", "nombre_mes", ccsText, "", CCGetRequestParam("nombre_mes", ccsGet, NULL), $this);
        $this->fecha_limite = new clsControl(ccsLabel, "fecha_limite", "fecha_limite", ccsDate, array("dd", "/", "mm", "/", "yyyy", " ", "hh", ":", "nn"), CCGetRequestParam("fecha_limite", ccsGet, NULL), $this);
        $this->num_intentos_permitidos = new clsControl(ccsLabel, "num_intentos_permitidos", "num_intentos_permitidos", ccsInteger, "", CCGetRequestParam("num_intentos_permitidos", ccsGet, NULL), $this);
        $this->tipo_periodo = new clsControl(ccsLabel, "tipo_periodo", "tipo_periodo", ccsText, "", CCGetRequestParam("tipo_periodo", ccsGet, NULL), $this);
        $this->id_proveedor = new clsControl(ccsLabel, "id_proveedor", "id_proveedor", ccsText, "", CCGetRequestParam("id_proveedor", ccsGet, NULL), $this);
        $this->periodos_carga_Insert = new clsControl(ccsLink, "periodos_carga_Insert", "periodos_carga_Insert", ccsText, "", CCGetRequestParam("periodos_carga_Insert", ccsGet, NULL), $this);
        $this->periodos_carga_Insert->Parameters = CCGetQueryString("QueryString", array("id_periodo", "ccsForm"));
        $this->periodos_carga_Insert->Page = "periodo4.php";
        $this->Sorter_id_periodo = new clsSorter($this->ComponentName, "Sorter_id_periodo", $FileName, $this);
        $this->Sorter_anio = new clsSorter($this->ComponentName, "Sorter_anio", $FileName, $this);
        $this->Sorter_nombre_mes = new clsSorter($this->ComponentName, "Sorter_nombre_mes", $FileName, $this);
        $this->Sorter_fecha_limite = new clsSorter($this->ComponentName, "Sorter_fecha_limite", $FileName, $this);
        $this->Sorter_num_intentos_permitidos = new clsSorter($this->ComponentName, "Sorter_num_intentos_permitidos", $FileName, $this);
        $this->Sorter_tipo_periodo = new clsSorter($this->ComponentName, "Sorter_tipo_periodo", $FileName, $this);
        $this->Sorter_id_proveedor = new clsSorter($this->ComponentName, "Sorter_id_proveedor", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
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

//Show Method @2-E1C7E04F
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_id_proveedor"] = CCGetFromGet("s_id_proveedor", NULL);
        $this->DataSource->Parameters["urls_anio"] = CCGetFromGet("s_anio", NULL);
        $this->DataSource->Parameters["urls_nombre_mes"] = CCGetFromGet("s_nombre_mes", NULL);

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
            $this->ControlsVisible["id_periodo"] = $this->id_periodo->Visible;
            $this->ControlsVisible["anio"] = $this->anio->Visible;
            $this->ControlsVisible["nombre_mes"] = $this->nombre_mes->Visible;
            $this->ControlsVisible["fecha_limite"] = $this->fecha_limite->Visible;
            $this->ControlsVisible["num_intentos_permitidos"] = $this->num_intentos_permitidos->Visible;
            $this->ControlsVisible["tipo_periodo"] = $this->tipo_periodo->Visible;
            $this->ControlsVisible["id_proveedor"] = $this->id_proveedor->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id_periodo->SetValue($this->DataSource->id_periodo->GetValue());
                $this->id_periodo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->id_periodo->Parameters = CCAddParam($this->id_periodo->Parameters, "id_periodo", $this->DataSource->f("id_periodo"));
                $this->anio->SetValue($this->DataSource->anio->GetValue());
                $this->nombre_mes->SetValue($this->DataSource->nombre_mes->GetValue());
                $this->fecha_limite->SetValue($this->DataSource->fecha_limite->GetValue());
                $this->num_intentos_permitidos->SetValue($this->DataSource->num_intentos_permitidos->GetValue());
                $this->tipo_periodo->SetValue($this->DataSource->tipo_periodo->GetValue());
                $this->id_proveedor->SetValue($this->DataSource->id_proveedor->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id_periodo->Show();
                $this->anio->Show();
                $this->nombre_mes->Show();
                $this->fecha_limite->Show();
                $this->num_intentos_permitidos->Show();
                $this->tipo_periodo->Show();
                $this->id_proveedor->Show();
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
        $this->periodos_carga_Insert->Show();
        $this->Sorter_id_periodo->Show();
        $this->Sorter_anio->Show();
        $this->Sorter_nombre_mes->Show();
        $this->Sorter_fecha_limite->Show();
        $this->Sorter_num_intentos_permitidos->Show();
        $this->Sorter_tipo_periodo->Show();
        $this->Sorter_id_proveedor->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-28FC38FE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id_periodo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->anio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_limite->Errors->ToString());
        $errors = ComposeStrings($errors, $this->num_intentos_permitidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_periodo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id_proveedor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End periodos_carga Class @2-FCB6E20C

class clsperiodos_cargaDataSource extends clsDBcon_xls {  //periodos_cargaDataSource Class @2-5A7325D4

//DataSource Variables @2-30CA59C6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $id_periodo;
    public $anio;
    public $nombre_mes;
    public $fecha_limite;
    public $num_intentos_permitidos;
    public $tipo_periodo;
    public $id_proveedor;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-9160700E
    function clsperiodos_cargaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid periodos_carga";
        $this->Initialize();
        $this->id_periodo = new clsField("id_periodo", ccsInteger, "");
        
        $this->anio = new clsField("anio", ccsInteger, "");
        
        $this->nombre_mes = new clsField("nombre_mes", ccsText, "");
        
        $this->fecha_limite = new clsField("fecha_limite", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->num_intentos_permitidos = new clsField("num_intentos_permitidos", ccsInteger, "");
        
        $this->tipo_periodo = new clsField("tipo_periodo", ccsText, "");
        
        $this->id_proveedor = new clsField("id_proveedor", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-26EE8C73
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id_periodo" => array("id_periodo", ""), 
            "Sorter_anio" => array("anio", ""), 
            "Sorter_nombre_mes" => array("nombre_mes", ""), 
            "Sorter_fecha_limite" => array("fecha_limite", ""), 
            "Sorter_num_intentos_permitidos" => array("num_intentos_permitidos", ""), 
            "Sorter_tipo_periodo" => array("tipo_periodo", ""), 
            "Sorter_id_proveedor" => array("id_proveedor", "")));
    }
//End SetOrder Method

//Prepare Method @2-6CCB21FE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_proveedor", ccsInteger, "", "", $this->Parameters["urls_id_proveedor"], 0, false);
        $this->wp->AddParameter("2", "urls_anio", ccsInteger, "", "", $this->Parameters["urls_anio"], 0, false);
        $this->wp->AddParameter("3", "urls_nombre_mes", ccsText, "", "", $this->Parameters["urls_nombre_mes"], "", false);
    }
//End Prepare Method

//Open Method @2-B12EDC8C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT distinct id_periodo, anio, nombre_mes, mes, fecha_limite, num_intentos_permitidos, tipo_periodo, periodos_carga.id_proveedor AS periodos_carga_id_proveedor,\n" .
        "nom_proveedor \n" .
        "FROM periodos_carga,\n" .
        "usuario\n" .
        "WHERE usuario.id_proveedor=periodos_carga.id_proveedor\n" .
        "and 	periodos_carga.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND periodos_carga.anio = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND periodos_carga.nombre_mes LIKE '%" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "%' ) cnt";
        $this->SQL = "SELECT distinct id_periodo, anio, nombre_mes, mes, fecha_limite, num_intentos_permitidos, tipo_periodo, periodos_carga.id_proveedor AS periodos_carga_id_proveedor,\n" .
        "nom_proveedor \n" .
        "FROM periodos_carga,\n" .
        "usuario\n" .
        "WHERE usuario.id_proveedor=periodos_carga.id_proveedor\n" .
        "and 	periodos_carga.id_proveedor = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND periodos_carga.anio = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND periodos_carga.nombre_mes LIKE '%" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "%' ";
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

//SetValues Method @2-7E2E9B41
    function SetValues()
    {
        $this->id_periodo->SetDBValue(trim($this->f("id_periodo")));
        $this->anio->SetDBValue(trim($this->f("anio")));
        $this->nombre_mes->SetDBValue($this->f("nombre_mes"));
        $this->fecha_limite->SetDBValue(trim($this->f("fecha_limite")));
        $this->num_intentos_permitidos->SetDBValue(trim($this->f("num_intentos_permitidos")));
        $this->tipo_periodo->SetDBValue($this->f("tipo_periodo"));
        $this->id_proveedor->SetDBValue($this->f("nom_proveedor"));
    }
//End SetValues Method

} //End periodos_cargaDataSource Class @2-FCB6E20C

class clsRecordperiodos_cargaSearch { //periodos_cargaSearch Class @31-87C75BE3

//Variables @31-9E315808

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

//Class_Initialize Event @31-76684FAF
    function clsRecordperiodos_cargaSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record periodos_cargaSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "periodos_cargaSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_id_proveedor = new clsControl(ccsListBox, "s_id_proveedor", "Id Proveedor", ccsInteger, "", CCGetRequestParam("s_id_proveedor", $Method, NULL), $this);
            $this->s_id_proveedor->DSType = dsSQL;
            $this->s_id_proveedor->DataSource = new clsDBcon_xls();
            $this->s_id_proveedor->ds = & $this->s_id_proveedor->DataSource;
            list($this->s_id_proveedor->BoundColumn, $this->s_id_proveedor->TextColumn, $this->s_id_proveedor->DBFormat) = array("", "", "");
            $this->s_id_proveedor->DataSource->SQL = "SELECT distinct id_proveedor, nom_proveedor \n" .
            "FROM usuario \n" .
            "where capc_cds<>'CAPC'\n" .
            "	union select  0, 'TODOS'";
            $this->s_id_proveedor->DataSource->Order = "";
            $this->s_anio = new clsControl(ccsTextBox, "s_anio", "Anio", ccsInteger, "", CCGetRequestParam("s_anio", $Method, NULL), $this);
            $this->s_nombre_mes = new clsControl(ccsListBox, "s_nombre_mes", "Nombre Mes", ccsText, "", CCGetRequestParam("s_nombre_mes", $Method, NULL), $this);
            $this->s_nombre_mes->DSType = dsListOfValues;
            $this->s_nombre_mes->Values = array(array("Enero", "Enero"), array("Febrero", "Febrero"), array("Marzo", "Marzo"), array("Abril", "Abril"), array("Mayo", "Mayo"), array("Junio", "Junio"), array("Julio", "Julio"), array("Agosto", "Agosto"), array("Septiembre", "Septiembre"), array("Octubre", "Octubre"), array("Noviembre", "Noviembre"), array("Diciembre", "Diciembre"));
        }
    }
//End Class_Initialize Event

//Validate Method @31-FB854EA5
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_id_proveedor->Validate() && $Validation);
        $Validation = ($this->s_anio->Validate() && $Validation);
        $Validation = ($this->s_nombre_mes->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_id_proveedor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_anio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombre_mes->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @31-9B545818
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_id_proveedor->Errors->Count());
        $errors = ($errors || $this->s_anio->Errors->Count());
        $errors = ($errors || $this->s_nombre_mes->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @31-1B6AADC4
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
        $Redirect = "periodo4.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "periodo4.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @31-95F8D8DD
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
        $this->s_nombre_mes->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_id_proveedor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_anio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombre_mes->Errors->ToString());
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
        $this->s_anio->Show();
        $this->s_nombre_mes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End periodos_cargaSearch Class @31-FCB6E20C

class clsRecordperiodos_carga1 { //periodos_carga1 Class @36-53EC4D85

//Variables @36-9E315808

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

//Class_Initialize Event @36-3971B1D5
    function clsRecordperiodos_carga1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record periodos_carga1/Error";
        $this->DataSource = new clsperiodos_carga1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "periodos_carga1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            $this->anio = new clsControl(ccsTextBox, "anio", "Anio", ccsInteger, "", CCGetRequestParam("anio", $Method, NULL), $this);
            $this->anio->Required = true;
            $this->nombre_mes = new clsControl(ccsListBox, "nombre_mes", "Nombre Mes", ccsText, "", CCGetRequestParam("nombre_mes", $Method, NULL), $this);
            $this->nombre_mes->DSType = dsListOfValues;
            $this->nombre_mes->Values = array(array("Enero", "Enero"), array("Febrero", "Febrero"), array("Marzo", "Marzo"), array("Abril", "Abril"), array("Mayo", "Mayo"), array("Junio", "Junio"), array("Julio", "Julio"), array("Agosto", "Agosto"), array("Septiembre", "Septiembre"), array("Octubre", "Octubre"), array("Noviembre", "Noviembre"), array("Diciembre", "Diciembre"));
            $this->fecha_limite = new clsControl(ccsTextBox, "fecha_limite", "Fecha Limite", ccsDate, array("dd", "/", "mm", "/", "yyyy", " ", "hh", ":", "nn"), CCGetRequestParam("fecha_limite", $Method, NULL), $this);
            $this->fecha_limite->Required = true;
            $this->num_intentos_permitidos = new clsControl(ccsTextBox, "num_intentos_permitidos", "Num Intentos Permitidos", ccsInteger, "", CCGetRequestParam("num_intentos_permitidos", $Method, NULL), $this);
            $this->num_intentos_permitidos->Required = true;
            $this->tipo_periodo = new clsControl(ccsListBox, "tipo_periodo", "Tipo Periodo", ccsText, "", CCGetRequestParam("tipo_periodo", $Method, NULL), $this);
            $this->tipo_periodo->DSType = dsListOfValues;
            $this->tipo_periodo->Values = array(array("Normal", "Normal"), array("Extraordinario", "Extraordinario"));
            $this->tipo_periodo->Required = true;
            $this->id_proveedor = new clsControl(ccsListBox, "id_proveedor", "Id Proveedor", ccsInteger, "", CCGetRequestParam("id_proveedor", $Method, NULL), $this);
            $this->id_proveedor->DSType = dsSQL;
            $this->id_proveedor->DataSource = new clsDBcon_xls();
            $this->id_proveedor->ds = & $this->id_proveedor->DataSource;
            list($this->id_proveedor->BoundColumn, $this->id_proveedor->TextColumn, $this->id_proveedor->DBFormat) = array("", "", "");
            $this->id_proveedor->DataSource->SQL = "SELECT distinct id_proveedor, nom_proveedor \n" .
            "FROM usuario \n" .
            "	where capc_cds='CDS'\n" .
            "	union select 0,'Todos'";
            $this->id_proveedor->DataSource->Order = "";
            $this->id_proveedor->Required = true;
            $this->mes = new clsControl(ccsHidden, "mes", "mes", ccsInteger, "", CCGetRequestParam("mes", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @36-777CABE1
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid_periodo"] = CCGetFromGet("id_periodo", NULL);
    }
//End Initialize Method

//Validate Method @36-6EDA60C2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->anio->Validate() && $Validation);
        $Validation = ($this->nombre_mes->Validate() && $Validation);
        $Validation = ($this->fecha_limite->Validate() && $Validation);
        $Validation = ($this->num_intentos_permitidos->Validate() && $Validation);
        $Validation = ($this->tipo_periodo->Validate() && $Validation);
        $Validation = ($this->id_proveedor->Validate() && $Validation);
        $Validation = ($this->mes->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->anio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nombre_mes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fecha_limite->Errors->Count() == 0);
        $Validation =  $Validation && ($this->num_intentos_permitidos->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tipo_periodo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->id_proveedor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mes->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @36-539C959C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->anio->Errors->Count());
        $errors = ($errors || $this->nombre_mes->Errors->Count());
        $errors = ($errors || $this->fecha_limite->Errors->Count());
        $errors = ($errors || $this->num_intentos_permitidos->Errors->Count());
        $errors = ($errors || $this->tipo_periodo->Errors->Count());
        $errors = ($errors || $this->id_proveedor->Errors->Count());
        $errors = ($errors || $this->mes->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @36-288F0419
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @36-FF661182
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->anio->SetValue($this->anio->GetValue(true));
        $this->DataSource->nombre_mes->SetValue($this->nombre_mes->GetValue(true));
        $this->DataSource->fecha_limite->SetValue($this->fecha_limite->GetValue(true));
        $this->DataSource->num_intentos_permitidos->SetValue($this->num_intentos_permitidos->GetValue(true));
        $this->DataSource->tipo_periodo->SetValue($this->tipo_periodo->GetValue(true));
        $this->DataSource->id_proveedor->SetValue($this->id_proveedor->GetValue(true));
        $this->DataSource->mes->SetValue($this->mes->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @36-4F1325E5
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->anio->SetValue($this->anio->GetValue(true));
        $this->DataSource->nombre_mes->SetValue($this->nombre_mes->GetValue(true));
        $this->DataSource->fecha_limite->SetValue($this->fecha_limite->GetValue(true));
        $this->DataSource->num_intentos_permitidos->SetValue($this->num_intentos_permitidos->GetValue(true));
        $this->DataSource->tipo_periodo->SetValue($this->tipo_periodo->GetValue(true));
        $this->DataSource->id_proveedor->SetValue($this->id_proveedor->GetValue(true));
        $this->DataSource->mes->SetValue($this->mes->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @36-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @36-CD237812
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

        $this->nombre_mes->Prepare();
        $this->tipo_periodo->Prepare();
        $this->id_proveedor->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->anio->SetValue($this->DataSource->anio->GetValue());
                    $this->nombre_mes->SetValue($this->DataSource->nombre_mes->GetValue());
                    $this->fecha_limite->SetValue($this->DataSource->fecha_limite->GetValue());
                    $this->num_intentos_permitidos->SetValue($this->DataSource->num_intentos_permitidos->GetValue());
                    $this->tipo_periodo->SetValue($this->DataSource->tipo_periodo->GetValue());
                    $this->id_proveedor->SetValue($this->DataSource->id_proveedor->GetValue());
                    $this->mes->SetValue($this->DataSource->mes->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->anio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nombre_mes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fecha_limite->Errors->ToString());
            $Error = ComposeStrings($Error, $this->num_intentos_permitidos->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tipo_periodo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->id_proveedor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->anio->Show();
        $this->nombre_mes->Show();
        $this->fecha_limite->Show();
        $this->num_intentos_permitidos->Show();
        $this->tipo_periodo->Show();
        $this->id_proveedor->Show();
        $this->mes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End periodos_carga1 Class @36-FCB6E20C

class clsperiodos_carga1DataSource extends clsDBcon_xls {  //periodos_carga1DataSource Class @36-9F90EC5C

//DataSource Variables @36-2AEC1647
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $anio;
    public $nombre_mes;
    public $fecha_limite;
    public $num_intentos_permitidos;
    public $tipo_periodo;
    public $id_proveedor;
    public $mes;
//End DataSource Variables

//DataSourceClass_Initialize Event @36-86DA13BE
    function clsperiodos_carga1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record periodos_carga1/Error";
        $this->Initialize();
        $this->anio = new clsField("anio", ccsInteger, "");
        
        $this->nombre_mes = new clsField("nombre_mes", ccsText, "");
        
        $this->fecha_limite = new clsField("fecha_limite", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->num_intentos_permitidos = new clsField("num_intentos_permitidos", ccsInteger, "");
        
        $this->tipo_periodo = new clsField("tipo_periodo", ccsText, "");
        
        $this->id_proveedor = new clsField("id_proveedor", ccsInteger, "");
        
        $this->mes = new clsField("mes", ccsInteger, "");
        

        $this->InsertFields["anio"] = array("Name" => "anio", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nombre_mes"] = array("Name" => "nombre_mes", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fecha_limite"] = array("Name" => "fecha_limite", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["num_intentos_permitidos"] = array("Name" => "num_intentos_permitidos", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["tipo_periodo"] = array("Name" => "tipo_periodo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["id_proveedor"] = array("Name" => "id_proveedor", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mes"] = array("Name" => "mes", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["anio"] = array("Name" => "anio", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nombre_mes"] = array("Name" => "nombre_mes", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fecha_limite"] = array("Name" => "fecha_limite", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["num_intentos_permitidos"] = array("Name" => "num_intentos_permitidos", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipo_periodo"] = array("Name" => "tipo_periodo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["id_proveedor"] = array("Name" => "id_proveedor", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mes"] = array("Name" => "mes", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @36-FB900772
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid_periodo", ccsInteger, "", "", $this->Parameters["urlid_periodo"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id_periodo", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @36-E2B9BD38
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM periodos_carga {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @36-4BC88DFF
    function SetValues()
    {
        $this->anio->SetDBValue(trim($this->f("anio")));
        $this->nombre_mes->SetDBValue($this->f("nombre_mes"));
        $this->fecha_limite->SetDBValue(trim($this->f("fecha_limite")));
        $this->num_intentos_permitidos->SetDBValue(trim($this->f("num_intentos_permitidos")));
        $this->tipo_periodo->SetDBValue($this->f("tipo_periodo"));
        $this->id_proveedor->SetDBValue(trim($this->f("id_proveedor")));
        $this->mes->SetDBValue(trim($this->f("mes")));
    }
//End SetValues Method

//Insert Method @36-22C242CA
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["anio"]["Value"] = $this->anio->GetDBValue(true);
        $this->InsertFields["nombre_mes"]["Value"] = $this->nombre_mes->GetDBValue(true);
        $this->InsertFields["fecha_limite"]["Value"] = $this->fecha_limite->GetDBValue(true);
        $this->InsertFields["num_intentos_permitidos"]["Value"] = $this->num_intentos_permitidos->GetDBValue(true);
        $this->InsertFields["tipo_periodo"]["Value"] = $this->tipo_periodo->GetDBValue(true);
        $this->InsertFields["id_proveedor"]["Value"] = $this->id_proveedor->GetDBValue(true);
        $this->InsertFields["mes"]["Value"] = $this->mes->GetDBValue(true);
        $this->SQL = CCBuildInsert("periodos_carga", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @36-21211396
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["anio"]["Value"] = $this->anio->GetDBValue(true);
        $this->UpdateFields["nombre_mes"]["Value"] = $this->nombre_mes->GetDBValue(true);
        $this->UpdateFields["fecha_limite"]["Value"] = $this->fecha_limite->GetDBValue(true);
        $this->UpdateFields["num_intentos_permitidos"]["Value"] = $this->num_intentos_permitidos->GetDBValue(true);
        $this->UpdateFields["tipo_periodo"]["Value"] = $this->tipo_periodo->GetDBValue(true);
        $this->UpdateFields["id_proveedor"]["Value"] = $this->id_proveedor->GetDBValue(true);
        $this->UpdateFields["mes"]["Value"] = $this->mes->GetDBValue(true);
        $this->SQL = CCBuildUpdate("periodos_carga", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @36-68F8DBC3
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM periodos_carga";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End periodos_carga1DataSource Class @36-FCB6E20C

//Include Page implementation @50-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation



//Initialize Page @1-A06DADD0
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
$TemplateFileName = "periodo4.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|js/jquery/ui/jquery.ui.core.js|js/jquery/ui/jquery.ui.widget.js|js/jquery/ui/jquery.ui.datepicker.js|js/jquery/datepicker/ccs-date-timepicker.js|";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C89D2C71
include_once("./periodo4_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-372CDE6B
$DBcon_xls = new clsDBcon_xls();
$MainPage->Connections["con_xls"] = & $DBcon_xls;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$periodos_carga = new clsGridperiodos_carga("", $MainPage);
$periodos_cargaSearch = new clsRecordperiodos_cargaSearch("", $MainPage);
$periodos_carga1 = new clsRecordperiodos_carga1("", $MainPage);
$Header = new clsHeader("", "Header", $MainPage);
$Header->Initialize();
$MainPage->periodos_carga = & $periodos_carga;
$MainPage->periodos_cargaSearch = & $periodos_cargaSearch;
$MainPage->periodos_carga1 = & $periodos_carga1;
$MainPage->Header = & $Header;
$periodos_carga->Initialize();
$periodos_carga1->Initialize();
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

//Execute Components @1-8EA10866
$Header->Operations();
$periodos_carga1->Operation();
$periodos_cargaSearch->Operation();
//End Execute Components

//Go to destination page @1-12F27A3A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($periodos_carga);
    unset($periodos_cargaSearch);
    unset($periodos_carga1);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6D6F3C4B
$periodos_carga->Show();
$periodos_cargaSearch->Show();
$periodos_carga1->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $TemplateEncoding);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-CFD9BCDF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($periodos_carga);
unset($periodos_cargaSearch);
unset($periodos_carga1);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
