<?php
//Include Common Files @1-A531BC92
define("RelativePath", "..");
define("PathToCurrentPage", "/respaldo/");
define("FileName", "detalle_layout_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Master Page implementation @1-ECD4BC60
include_once(RelativePath . "/Designs/Apricot/MasterPage.php");
//End Master Page implementation

class clsGriddetalle_layout { //detalle_layout class @11-1DF62577

//Variables @11-94C9ECDD

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
    public $Sorter_id_detalle;
    public $Sorter_nombre_layout;
    public $Sorter_nombre_columna;
    public $Sorter_posicion;
    public $Sorter_tipo_col;
    public $Sorter_condicion1;
    public $Sorter_condicion2;
    public $Sorter_acepta_nulos;
//End Variables

//Class_Initialize Event @11-1C73FCBB
    function clsGriddetalle_layout($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "detalle_layout";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid detalle_layout";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsdetalle_layoutDataSource($this);
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
        $this->SorterName = CCGetParam("detalle_layoutOrder", "");
        $this->SorterDirection = CCGetParam("detalle_layoutDir", "");

        $this->id_detalle = new clsControl(ccsLink, "id_detalle", "id_detalle", ccsInteger, "", CCGetRequestParam("id_detalle", ccsGet, NULL), $this);
        $this->id_detalle->Page = "detalle_layout_maint.php";
        $this->nombre_layout = new clsControl(ccsLabel, "nombre_layout", "nombre_layout", ccsText, "", CCGetRequestParam("nombre_layout", ccsGet, NULL), $this);
        $this->nombre_columna = new clsControl(ccsLabel, "nombre_columna", "nombre_columna", ccsText, "", CCGetRequestParam("nombre_columna", ccsGet, NULL), $this);
        $this->posicion = new clsControl(ccsLabel, "posicion", "posicion", ccsInteger, "", CCGetRequestParam("posicion", ccsGet, NULL), $this);
        $this->tipo_col = new clsControl(ccsLabel, "tipo_col", "tipo_col", ccsText, "", CCGetRequestParam("tipo_col", ccsGet, NULL), $this);
        $this->condicion1 = new clsControl(ccsLabel, "condicion1", "condicion1", ccsText, "", CCGetRequestParam("condicion1", ccsGet, NULL), $this);
        $this->condicion2 = new clsControl(ccsLabel, "condicion2", "condicion2", ccsText, "", CCGetRequestParam("condicion2", ccsGet, NULL), $this);
        $this->acepta_nulos = new clsControl(ccsLabel, "acepta_nulos", "acepta_nulos", ccsText, "", CCGetRequestParam("acepta_nulos", ccsGet, NULL), $this);
        $this->detalle_layout_Insert = new clsControl(ccsLink, "detalle_layout_Insert", "detalle_layout_Insert", ccsText, "", CCGetRequestParam("detalle_layout_Insert", ccsGet, NULL), $this);
        $this->detalle_layout_Insert->Parameters = CCGetQueryString("QueryString", array("id_detalle", "ccsForm"));
        $this->detalle_layout_Insert->Page = "detalle_layout_maint.php";
        $this->Sorter_id_detalle = new clsSorter($this->ComponentName, "Sorter_id_detalle", $FileName, $this);
        $this->Sorter_nombre_layout = new clsSorter($this->ComponentName, "Sorter_nombre_layout", $FileName, $this);
        $this->Sorter_nombre_columna = new clsSorter($this->ComponentName, "Sorter_nombre_columna", $FileName, $this);
        $this->Sorter_posicion = new clsSorter($this->ComponentName, "Sorter_posicion", $FileName, $this);
        $this->Sorter_tipo_col = new clsSorter($this->ComponentName, "Sorter_tipo_col", $FileName, $this);
        $this->Sorter_condicion1 = new clsSorter($this->ComponentName, "Sorter_condicion1", $FileName, $this);
        $this->Sorter_condicion2 = new clsSorter($this->ComponentName, "Sorter_condicion2", $FileName, $this);
        $this->Sorter_acepta_nulos = new clsSorter($this->ComponentName, "Sorter_acepta_nulos", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @11-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @11-19AC6E1A
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_id_layout"] = CCGetFromGet("s_id_layout", NULL);
        $this->DataSource->Parameters["urls_nombre_columna"] = CCGetFromGet("s_nombre_columna", NULL);
        $this->DataSource->Parameters["urls_tipo_col"] = CCGetFromGet("s_tipo_col", NULL);
        $this->DataSource->Parameters["urls_condicion1"] = CCGetFromGet("s_condicion1", NULL);
        $this->DataSource->Parameters["urls_condicion2"] = CCGetFromGet("s_condicion2", NULL);
        $this->DataSource->Parameters["urls_acepta_nulos"] = CCGetFromGet("s_acepta_nulos", NULL);

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
            $this->ControlsVisible["id_detalle"] = $this->id_detalle->Visible;
            $this->ControlsVisible["nombre_layout"] = $this->nombre_layout->Visible;
            $this->ControlsVisible["nombre_columna"] = $this->nombre_columna->Visible;
            $this->ControlsVisible["posicion"] = $this->posicion->Visible;
            $this->ControlsVisible["tipo_col"] = $this->tipo_col->Visible;
            $this->ControlsVisible["condicion1"] = $this->condicion1->Visible;
            $this->ControlsVisible["condicion2"] = $this->condicion2->Visible;
            $this->ControlsVisible["acepta_nulos"] = $this->acepta_nulos->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id_detalle->SetValue($this->DataSource->id_detalle->GetValue());
                $this->id_detalle->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->id_detalle->Parameters = CCAddParam($this->id_detalle->Parameters, "id_detalle", $this->DataSource->f("id_detalle"));
                $this->nombre_layout->SetValue($this->DataSource->nombre_layout->GetValue());
                $this->nombre_columna->SetValue($this->DataSource->nombre_columna->GetValue());
                $this->posicion->SetValue($this->DataSource->posicion->GetValue());
                $this->tipo_col->SetValue($this->DataSource->tipo_col->GetValue());
                $this->condicion1->SetValue($this->DataSource->condicion1->GetValue());
                $this->condicion2->SetValue($this->DataSource->condicion2->GetValue());
                $this->acepta_nulos->SetValue($this->DataSource->acepta_nulos->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id_detalle->Show();
                $this->nombre_layout->Show();
                $this->nombre_columna->Show();
                $this->posicion->Show();
                $this->tipo_col->Show();
                $this->condicion1->Show();
                $this->condicion2->Show();
                $this->acepta_nulos->Show();
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
        $this->detalle_layout_Insert->Show();
        $this->Sorter_id_detalle->Show();
        $this->Sorter_nombre_layout->Show();
        $this->Sorter_nombre_columna->Show();
        $this->Sorter_posicion->Show();
        $this->Sorter_tipo_col->Show();
        $this->Sorter_condicion1->Show();
        $this->Sorter_condicion2->Show();
        $this->Sorter_acepta_nulos->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @11-47CA0117
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id_detalle->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_layout->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_columna->Errors->ToString());
        $errors = ComposeStrings($errors, $this->posicion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_col->Errors->ToString());
        $errors = ComposeStrings($errors, $this->condicion1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->condicion2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->acepta_nulos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End detalle_layout Class @11-FCB6E20C

class clsdetalle_layoutDataSource extends clsDBcon_xls {  //detalle_layoutDataSource Class @11-F661F00B

//DataSource Variables @11-375A07DB
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $id_detalle;
    public $nombre_layout;
    public $nombre_columna;
    public $posicion;
    public $tipo_col;
    public $condicion1;
    public $condicion2;
    public $acepta_nulos;
//End DataSource Variables

//DataSourceClass_Initialize Event @11-EF3A1142
    function clsdetalle_layoutDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid detalle_layout";
        $this->Initialize();
        $this->id_detalle = new clsField("id_detalle", ccsInteger, "");
        
        $this->nombre_layout = new clsField("nombre_layout", ccsText, "");
        
        $this->nombre_columna = new clsField("nombre_columna", ccsText, "");
        
        $this->posicion = new clsField("posicion", ccsInteger, "");
        
        $this->tipo_col = new clsField("tipo_col", ccsText, "");
        
        $this->condicion1 = new clsField("condicion1", ccsText, "");
        
        $this->condicion2 = new clsField("condicion2", ccsText, "");
        
        $this->acepta_nulos = new clsField("acepta_nulos", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @11-767E38F9
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id_detalle" => array("id_detalle", ""), 
            "Sorter_nombre_layout" => array("nombre_layout", ""), 
            "Sorter_nombre_columna" => array("nombre_columna", ""), 
            "Sorter_posicion" => array("posicion", ""), 
            "Sorter_tipo_col" => array("tipo_col", ""), 
            "Sorter_condicion1" => array("condicion1", ""), 
            "Sorter_condicion2" => array("condicion2", ""), 
            "Sorter_acepta_nulos" => array("acepta_nulos", "")));
    }
//End SetOrder Method

//Prepare Method @11-00EC650A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_layout", ccsInteger, "", "", $this->Parameters["urls_id_layout"], "", false);
        $this->wp->AddParameter("2", "urls_nombre_columna", ccsText, "", "", $this->Parameters["urls_nombre_columna"], "", false);
        $this->wp->AddParameter("3", "urls_tipo_col", ccsText, "", "", $this->Parameters["urls_tipo_col"], "", false);
        $this->wp->AddParameter("4", "urls_condicion1", ccsText, "", "", $this->Parameters["urls_condicion1"], "", false);
        $this->wp->AddParameter("5", "urls_condicion2", ccsText, "", "", $this->Parameters["urls_condicion2"], "", false);
        $this->wp->AddParameter("6", "urls_acepta_nulos", ccsText, "", "", $this->Parameters["urls_acepta_nulos"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "detalle_layout.id_layout", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "detalle_layout.nombre_columna", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "detalle_layout.tipo_col", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "detalle_layout.condicion1", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "detalle_layout.condicion2", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opContains, "detalle_layout.acepta_nulos", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]);
    }
//End Prepare Method

//Open Method @11-1B3E67C9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM detalle_layout LEFT JOIN layouts ON\n\n" .
        "detalle_layout.id_layout = layouts.id_layout";
        $this->SQL = "SELECT id_detalle, nombre_layout, nombre_columna, posicion, tipo_col, condicion1, condicion2, acepta_nulos \n\n" .
        "FROM detalle_layout LEFT JOIN layouts ON\n\n" .
        "detalle_layout.id_layout = layouts.id_layout {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @11-A22BD642
    function SetValues()
    {
        $this->id_detalle->SetDBValue(trim($this->f("id_detalle")));
        $this->nombre_layout->SetDBValue($this->f("nombre_layout"));
        $this->nombre_columna->SetDBValue($this->f("nombre_columna"));
        $this->posicion->SetDBValue(trim($this->f("posicion")));
        $this->tipo_col->SetDBValue($this->f("tipo_col"));
        $this->condicion1->SetDBValue($this->f("condicion1"));
        $this->condicion2->SetDBValue($this->f("condicion2"));
        $this->acepta_nulos->SetDBValue($this->f("acepta_nulos"));
    }
//End SetValues Method

} //End detalle_layoutDataSource Class @11-FCB6E20C

class clsRecorddetalle_layoutSearch { //detalle_layoutSearch Class @2-D2C0DD93

//Variables @2-9E315808

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

//Class_Initialize Event @2-B183C27C
    function clsRecorddetalle_layoutSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record detalle_layoutSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "detalle_layoutSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_id_layout = new clsControl(ccsListBox, "s_id_layout", "Id Layout", ccsInteger, "", CCGetRequestParam("s_id_layout", $Method, NULL), $this);
            $this->s_id_layout->DSType = dsTable;
            $this->s_id_layout->DataSource = new clsDBcon_xls();
            $this->s_id_layout->ds = & $this->s_id_layout->DataSource;
            $this->s_id_layout->DataSource->SQL = "SELECT * \n" .
"FROM layouts {SQL_Where} {SQL_OrderBy}";
            list($this->s_id_layout->BoundColumn, $this->s_id_layout->TextColumn, $this->s_id_layout->DBFormat) = array("id_layout", "nombre_layout", "");
            $this->s_nombre_columna = new clsControl(ccsTextBox, "s_nombre_columna", "Nombre Columna", ccsText, "", CCGetRequestParam("s_nombre_columna", $Method, NULL), $this);
            $this->s_tipo_col = new clsControl(ccsTextBox, "s_tipo_col", "Tipo Col", ccsText, "", CCGetRequestParam("s_tipo_col", $Method, NULL), $this);
            $this->s_condicion1 = new clsControl(ccsTextBox, "s_condicion1", "Condicion1", ccsText, "", CCGetRequestParam("s_condicion1", $Method, NULL), $this);
            $this->s_condicion2 = new clsControl(ccsTextBox, "s_condicion2", "Condicion2", ccsText, "", CCGetRequestParam("s_condicion2", $Method, NULL), $this);
            $this->s_acepta_nulos = new clsControl(ccsTextBox, "s_acepta_nulos", "Acepta Nulos", ccsText, "", CCGetRequestParam("s_acepta_nulos", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-1AE42B98
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_id_layout->Validate() && $Validation);
        $Validation = ($this->s_nombre_columna->Validate() && $Validation);
        $Validation = ($this->s_tipo_col->Validate() && $Validation);
        $Validation = ($this->s_condicion1->Validate() && $Validation);
        $Validation = ($this->s_condicion2->Validate() && $Validation);
        $Validation = ($this->s_acepta_nulos->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_id_layout->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombre_columna->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tipo_col->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_condicion1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_condicion2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_acepta_nulos->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-D43769B2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_id_layout->Errors->Count());
        $errors = ($errors || $this->s_nombre_columna->Errors->Count());
        $errors = ($errors || $this->s_tipo_col->Errors->Count());
        $errors = ($errors || $this->s_condicion1->Errors->Count());
        $errors = ($errors || $this->s_condicion2->Errors->Count());
        $errors = ($errors || $this->s_acepta_nulos->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-17A595B8
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
        $Redirect = "detalle_layout_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "detalle_layout_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-6C5CF53D
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

        $this->s_id_layout->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_id_layout->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombre_columna->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tipo_col->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_condicion1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_condicion2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_acepta_nulos->Errors->ToString());
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
        $this->s_id_layout->Show();
        $this->s_nombre_columna->Show();
        $this->s_tipo_col->Show();
        $this->s_condicion1->Show();
        $this->s_condicion2->Show();
        $this->s_acepta_nulos->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End detalle_layoutSearch Class @2-FCB6E20C

//Include Page implementation @55-A738AFAB
include_once(RelativePath . "/respaldo/MenuIncludablePage.php");
//End Include Page implementation

//Initialize Page @1-2002956D
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";
$PathToCurrentMasterPage = "";
$TemplatePathValue = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";
$MasterPage = null;
$TemplateSource = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "detalle_layout_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$PathToRootOpt = "../";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-8008E204
include_once("./detalle_layout_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0C53009E
$DBcon_xls = new clsDBcon_xls();
$MainPage->Connections["con_xls"] = & $DBcon_xls;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$MasterPage = new clsMasterPage("/Designs/" . $CCProjectDesign . "/", "MasterPage", $MainPage);
$MasterPage->Attributes = $Attributes;
$MasterPage->Initialize();
$Head = new clsPanel("Head", $MainPage);
$Head->PlaceholderName = "Head";
$Content = new clsPanel("Content", $MainPage);
$Content->PlaceholderName = "Content";
$detalle_layout = new clsGriddetalle_layout("", $MainPage);
$detalle_layoutSearch = new clsRecorddetalle_layoutSearch("", $MainPage);
$Menu = new clsPanel("Menu", $MainPage);
$Menu->PlaceholderName = "Menu";
$MenuIncludablePage = new clsMenuIncludablePage("", "MenuIncludablePage", $MainPage);
$MenuIncludablePage->Initialize();
$Sidebar1 = new clsPanel("Sidebar1", $MainPage);
$Sidebar1->PlaceholderName = "Sidebar1";
$HeaderSidebar = new clsPanel("HeaderSidebar", $MainPage);
$HeaderSidebar->PlaceholderName = "HeaderSidebar";
$MainPage->Head = & $Head;
$MainPage->Content = & $Content;
$MainPage->detalle_layout = & $detalle_layout;
$MainPage->detalle_layoutSearch = & $detalle_layoutSearch;
$MainPage->Menu = & $Menu;
$MainPage->MenuIncludablePage = & $MenuIncludablePage;
$MainPage->Sidebar1 = & $Sidebar1;
$MainPage->HeaderSidebar = & $HeaderSidebar;
$Content->AddComponent("detalle_layout", $detalle_layout);
$Content->AddComponent("detalle_layoutSearch", $detalle_layoutSearch);
$Menu->AddComponent("MenuIncludablePage", $MenuIncludablePage);
$detalle_layout->Initialize();
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

//Initialize HTML Template @1-A7427295
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
if (strlen($TemplateSource)) {
    $Tpl->LoadTemplateFromStr($TemplateSource, $BlockToParse, "CP1252");
} else {
    $Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
}
$Tpl->SetVar("CCS_PathToRoot", $PathToRoot);
$Tpl->SetVar("CCS_PathToMasterPage", RelativePath . $PathToCurrentMasterPage);
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-60AEFDB0
$MasterPage->Operations();
$MenuIncludablePage->Operations();
$detalle_layoutSearch->Operation();
//End Execute Components

//Go to destination page @1-B89EECCA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($detalle_layout);
    unset($detalle_layoutSearch);
    $MenuIncludablePage->Class_Terminate();
    unset($MenuIncludablePage);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6235915D
$Head->Show();
$Content->Show();
$Menu->Show();
$Sidebar1->Show();
$HeaderSidebar->Show();
$MasterPage->Tpl->SetVar("Head", $Tpl->GetVar("Panel Head"));
$MasterPage->Tpl->SetVar("Content", $Tpl->GetVar("Panel Content"));
$MasterPage->Tpl->SetVar("Menu", $Tpl->GetVar("Panel Menu"));
$MasterPage->Tpl->SetVar("Sidebar1", $Tpl->GetVar("Panel Sidebar1"));
$MasterPage->Tpl->SetVar("HeaderSidebar", $Tpl->GetVar("Panel HeaderSidebar"));
$MasterPage->Show();
if (!isset($main_block)) $main_block = $MasterPage->HTML;
$main_block = CCConvertEncoding($main_block, $FileEncoding, $TemplateEncoding);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-21A35674
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($MasterPage);
unset($detalle_layout);
unset($detalle_layoutSearch);
$MenuIncludablePage->Class_Terminate();
unset($MenuIncludablePage);
unset($Tpl);
//End Unload Page


?>


//Include Common Files @1-A531BC92
define("RelativePath", "..");
define("PathToCurrentPage", "/respaldo/");
define("FileName", "detalle_layout_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Master Page implementation @1-ECD4BC60
include_once(RelativePath . "/Designs/Apricot/MasterPage.php");
//End Master Page implementation

class clsGriddetalle_layout { //detalle_layout class @11-1DF62577

//Variables @11-94C9ECDD

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
    public $Sorter_id_detalle;
    public $Sorter_nombre_layout;
    public $Sorter_nombre_columna;
    public $Sorter_posicion;
    public $Sorter_tipo_col;
    public $Sorter_condicion1;
    public $Sorter_condicion2;
    public $Sorter_acepta_nulos;
//End Variables

//Class_Initialize Event @11-1C73FCBB
    function clsGriddetalle_layout($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "detalle_layout";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid detalle_layout";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsdetalle_layoutDataSource($this);
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
        $this->SorterName = CCGetParam("detalle_layoutOrder", "");
        $this->SorterDirection = CCGetParam("detalle_layoutDir", "");

        $this->id_detalle = new clsControl(ccsLink, "id_detalle", "id_detalle", ccsInteger, "", CCGetRequestParam("id_detalle", ccsGet, NULL), $this);
        $this->id_detalle->Page = "detalle_layout_maint.php";
        $this->nombre_layout = new clsControl(ccsLabel, "nombre_layout", "nombre_layout", ccsText, "", CCGetRequestParam("nombre_layout", ccsGet, NULL), $this);
        $this->nombre_columna = new clsControl(ccsLabel, "nombre_columna", "nombre_columna", ccsText, "", CCGetRequestParam("nombre_columna", ccsGet, NULL), $this);
        $this->posicion = new clsControl(ccsLabel, "posicion", "posicion", ccsInteger, "", CCGetRequestParam("posicion", ccsGet, NULL), $this);
        $this->tipo_col = new clsControl(ccsLabel, "tipo_col", "tipo_col", ccsText, "", CCGetRequestParam("tipo_col", ccsGet, NULL), $this);
        $this->condicion1 = new clsControl(ccsLabel, "condicion1", "condicion1", ccsText, "", CCGetRequestParam("condicion1", ccsGet, NULL), $this);
        $this->condicion2 = new clsControl(ccsLabel, "condicion2", "condicion2", ccsText, "", CCGetRequestParam("condicion2", ccsGet, NULL), $this);
        $this->acepta_nulos = new clsControl(ccsLabel, "acepta_nulos", "acepta_nulos", ccsText, "", CCGetRequestParam("acepta_nulos", ccsGet, NULL), $this);
        $this->detalle_layout_Insert = new clsControl(ccsLink, "detalle_layout_Insert", "detalle_layout_Insert", ccsText, "", CCGetRequestParam("detalle_layout_Insert", ccsGet, NULL), $this);
        $this->detalle_layout_Insert->Parameters = CCGetQueryString("QueryString", array("id_detalle", "ccsForm"));
        $this->detalle_layout_Insert->Page = "detalle_layout_maint.php";
        $this->Sorter_id_detalle = new clsSorter($this->ComponentName, "Sorter_id_detalle", $FileName, $this);
        $this->Sorter_nombre_layout = new clsSorter($this->ComponentName, "Sorter_nombre_layout", $FileName, $this);
        $this->Sorter_nombre_columna = new clsSorter($this->ComponentName, "Sorter_nombre_columna", $FileName, $this);
        $this->Sorter_posicion = new clsSorter($this->ComponentName, "Sorter_posicion", $FileName, $this);
        $this->Sorter_tipo_col = new clsSorter($this->ComponentName, "Sorter_tipo_col", $FileName, $this);
        $this->Sorter_condicion1 = new clsSorter($this->ComponentName, "Sorter_condicion1", $FileName, $this);
        $this->Sorter_condicion2 = new clsSorter($this->ComponentName, "Sorter_condicion2", $FileName, $this);
        $this->Sorter_acepta_nulos = new clsSorter($this->ComponentName, "Sorter_acepta_nulos", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @11-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @11-802301FC
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_id_layout"] = CCGetFromGet("s_id_layout", NULL);
        $this->DataSource->Parameters["urls_nombre_columna"] = CCGetFromGet("s_nombre_columna", NULL);
        $this->DataSource->Parameters["urls_tipo_col"] = CCGetFromGet("s_tipo_col", NULL);
        $this->DataSource->Parameters["urls_condicion1"] = CCGetFromGet("s_condicion1", NULL);
        $this->DataSource->Parameters["urls_condicion2"] = CCGetFromGet("s_condicion2", NULL);
        $this->DataSource->Parameters["urls_acepta_nulos"] = CCGetFromGet("s_acepta_nulos", NULL);

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
            $this->ControlsVisible["id_detalle"] = $this->id_detalle->Visible;
            $this->ControlsVisible["nombre_layout"] = $this->nombre_layout->Visible;
            $this->ControlsVisible["nombre_columna"] = $this->nombre_columna->Visible;
            $this->ControlsVisible["posicion"] = $this->posicion->Visible;
            $this->ControlsVisible["tipo_col"] = $this->tipo_col->Visible;
            $this->ControlsVisible["condicion1"] = $this->condicion1->Visible;
            $this->ControlsVisible["condicion2"] = $this->condicion2->Visible;
            $this->ControlsVisible["acepta_nulos"] = $this->acepta_nulos->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id_detalle->SetValue($this->DataSource->id_detalle->GetValue());
                $this->id_detalle->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->id_detalle->Parameters = CCAddParam($this->id_detalle->Parameters, "id_detalle", $this->DataSource->f("id_detalle"));
                $this->nombre_layout->SetValue($this->DataSource->nombre_layout->GetValue());
                $this->nombre_columna->SetValue($this->DataSource->nombre_columna->GetValue());
                $this->posicion->SetValue($this->DataSource->posicion->GetValue());
                $this->tipo_col->SetValue($this->DataSource->tipo_col->GetValue());
                $this->condicion1->SetValue($this->DataSource->condicion1->GetValue());
                $this->condicion2->SetValue($this->DataSource->condicion2->GetValue());
                $this->acepta_nulos->SetValue($this->DataSource->acepta_nulos->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id_detalle->Show();
                $this->nombre_layout->Show();
                $this->nombre_columna->Show();
                $this->posicion->Show();
                $this->tipo_col->Show();
                $this->condicion1->Show();
                $this->condicion2->Show();
                $this->acepta_nulos->Show();
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
        $this->detalle_layout_Insert->Show();
        $this->Sorter_id_detalle->Show();
        $this->Sorter_nombre_layout->Show();
        $this->Sorter_nombre_columna->Show();
        $this->Sorter_posicion->Show();
        $this->Sorter_tipo_col->Show();
        $this->Sorter_condicion1->Show();
        $this->Sorter_condicion2->Show();
        $this->Sorter_acepta_nulos->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @11-47CA0117
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id_detalle->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_layout->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_columna->Errors->ToString());
        $errors = ComposeStrings($errors, $this->posicion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_col->Errors->ToString());
        $errors = ComposeStrings($errors, $this->condicion1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->condicion2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->acepta_nulos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End detalle_layout Class @11-FCB6E20C

class clsdetalle_layoutDataSource extends clsDBcon_xls {  //detalle_layoutDataSource Class @11-F661F00B

//DataSource Variables @11-375A07DB
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $id_detalle;
    public $nombre_layout;
    public $nombre_columna;
    public $posicion;
    public $tipo_col;
    public $condicion1;
    public $condicion2;
    public $acepta_nulos;
//End DataSource Variables

//DataSourceClass_Initialize Event @11-EF3A1142
    function clsdetalle_layoutDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid detalle_layout";
        $this->Initialize();
        $this->id_detalle = new clsField("id_detalle", ccsInteger, "");
        
        $this->nombre_layout = new clsField("nombre_layout", ccsText, "");
        
        $this->nombre_columna = new clsField("nombre_columna", ccsText, "");
        
        $this->posicion = new clsField("posicion", ccsInteger, "");
        
        $this->tipo_col = new clsField("tipo_col", ccsText, "");
        
        $this->condicion1 = new clsField("condicion1", ccsText, "");
        
        $this->condicion2 = new clsField("condicion2", ccsText, "");
        
        $this->acepta_nulos = new clsField("acepta_nulos", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @11-767E38F9
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id_detalle" => array("id_detalle", ""), 
            "Sorter_nombre_layout" => array("nombre_layout", ""), 
            "Sorter_nombre_columna" => array("nombre_columna", ""), 
            "Sorter_posicion" => array("posicion", ""), 
            "Sorter_tipo_col" => array("tipo_col", ""), 
            "Sorter_condicion1" => array("condicion1", ""), 
            "Sorter_condicion2" => array("condicion2", ""), 
            "Sorter_acepta_nulos" => array("acepta_nulos", "")));
    }
//End SetOrder Method

//Prepare Method @11-00EC650A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_id_layout", ccsInteger, "", "", $this->Parameters["urls_id_layout"], "", false);
        $this->wp->AddParameter("2", "urls_nombre_columna", ccsText, "", "", $this->Parameters["urls_nombre_columna"], "", false);
        $this->wp->AddParameter("3", "urls_tipo_col", ccsText, "", "", $this->Parameters["urls_tipo_col"], "", false);
        $this->wp->AddParameter("4", "urls_condicion1", ccsText, "", "", $this->Parameters["urls_condicion1"], "", false);
        $this->wp->AddParameter("5", "urls_condicion2", ccsText, "", "", $this->Parameters["urls_condicion2"], "", false);
        $this->wp->AddParameter("6", "urls_acepta_nulos", ccsText, "", "", $this->Parameters["urls_acepta_nulos"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "detalle_layout.id_layout", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "detalle_layout.nombre_columna", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "detalle_layout.tipo_col", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "detalle_layout.condicion1", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "detalle_layout.condicion2", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opContains, "detalle_layout.acepta_nulos", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]);
    }
//End Prepare Method

//Open Method @11-E3AB1718
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM detalle_layout LEFT JOIN layouts ON\n\n" .
        "detalle_layout.id_layout = layouts.id_layout";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} id_detalle, nombre_layout, nombre_columna, posicion, tipo_col, condicion1, condicion2, acepta_nulos \n\n" .
        "FROM detalle_layout LEFT JOIN layouts ON\n\n" .
        "detalle_layout.id_layout = layouts.id_layout {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @11-A22BD642
    function SetValues()
    {
        $this->id_detalle->SetDBValue(trim($this->f("id_detalle")));
        $this->nombre_layout->SetDBValue($this->f("nombre_layout"));
        $this->nombre_columna->SetDBValue($this->f("nombre_columna"));
        $this->posicion->SetDBValue(trim($this->f("posicion")));
        $this->tipo_col->SetDBValue($this->f("tipo_col"));
        $this->condicion1->SetDBValue($this->f("condicion1"));
        $this->condicion2->SetDBValue($this->f("condicion2"));
        $this->acepta_nulos->SetDBValue($this->f("acepta_nulos"));
    }
//End SetValues Method

} //End detalle_layoutDataSource Class @11-FCB6E20C

class clsRecorddetalle_layoutSearch { //detalle_layoutSearch Class @2-D2C0DD93

//Variables @2-9E315808

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

//Class_Initialize Event @2-B183C27C
    function clsRecorddetalle_layoutSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record detalle_layoutSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "detalle_layoutSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_id_layout = new clsControl(ccsListBox, "s_id_layout", "Id Layout", ccsInteger, "", CCGetRequestParam("s_id_layout", $Method, NULL), $this);
            $this->s_id_layout->DSType = dsTable;
            $this->s_id_layout->DataSource = new clsDBcon_xls();
            $this->s_id_layout->ds = & $this->s_id_layout->DataSource;
            $this->s_id_layout->DataSource->SQL = "SELECT * \n" .
"FROM layouts {SQL_Where} {SQL_OrderBy}";
            list($this->s_id_layout->BoundColumn, $this->s_id_layout->TextColumn, $this->s_id_layout->DBFormat) = array("id_layout", "nombre_layout", "");
            $this->s_nombre_columna = new clsControl(ccsTextBox, "s_nombre_columna", "Nombre Columna", ccsText, "", CCGetRequestParam("s_nombre_columna", $Method, NULL), $this);
            $this->s_tipo_col = new clsControl(ccsTextBox, "s_tipo_col", "Tipo Col", ccsText, "", CCGetRequestParam("s_tipo_col", $Method, NULL), $this);
            $this->s_condicion1 = new clsControl(ccsTextBox, "s_condicion1", "Condicion1", ccsText, "", CCGetRequestParam("s_condicion1", $Method, NULL), $this);
            $this->s_condicion2 = new clsControl(ccsTextBox, "s_condicion2", "Condicion2", ccsText, "", CCGetRequestParam("s_condicion2", $Method, NULL), $this);
            $this->s_acepta_nulos = new clsControl(ccsTextBox, "s_acepta_nulos", "Acepta Nulos", ccsText, "", CCGetRequestParam("s_acepta_nulos", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-1AE42B98
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_id_layout->Validate() && $Validation);
        $Validation = ($this->s_nombre_columna->Validate() && $Validation);
        $Validation = ($this->s_tipo_col->Validate() && $Validation);
        $Validation = ($this->s_condicion1->Validate() && $Validation);
        $Validation = ($this->s_condicion2->Validate() && $Validation);
        $Validation = ($this->s_acepta_nulos->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_id_layout->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombre_columna->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tipo_col->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_condicion1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_condicion2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_acepta_nulos->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-D43769B2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_id_layout->Errors->Count());
        $errors = ($errors || $this->s_nombre_columna->Errors->Count());
        $errors = ($errors || $this->s_tipo_col->Errors->Count());
        $errors = ($errors || $this->s_condicion1->Errors->Count());
        $errors = ($errors || $this->s_condicion2->Errors->Count());
        $errors = ($errors || $this->s_acepta_nulos->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-17A595B8
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
        $Redirect = "detalle_layout_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "detalle_layout_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-110D22B5
    function Show()
    {
        global $CCSUseAmp;
        $Tpl = & CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->s_id_layout->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_id_layout->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombre_columna->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tipo_col->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_condicion1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_condicion2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_acepta_nulos->Errors->ToString());
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
        $this->s_id_layout->Show();
        $this->s_nombre_columna->Show();
        $this->s_tipo_col->Show();
        $this->s_condicion1->Show();
        $this->s_condicion2->Show();
        $this->s_acepta_nulos->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End detalle_layoutSearch Class @2-FCB6E20C

//Include Page implementation @55-A738AFAB
include_once(RelativePath . "/respaldo/MenuIncludablePage.php");
//End Include Page implementation

//Initialize Page @1-2494AD91
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";
$PathToCurrentMasterPage = "";
$TemplatePathValue = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";
$MasterPage = null;
$TemplateSource = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "detalle_layout_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-8008E204
include_once("./detalle_layout_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FEFE595B
$DBcon_xls = new clsDBcon_xls();
$MainPage->Connections["con_xls"] = & $DBcon_xls;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$MasterPage = new clsMasterPage("/Designs/" . $CCProjectDesign . "/", "MasterPage", $MainPage);
$MasterPage->Attributes = $Attributes;
$MasterPage->Initialize();
$Head = new clsPanel("Head", $MainPage);
$Head->PlaceholderName = "Head";
$Content = new clsPanel("Content", $MainPage);
$Content->PlaceholderName = "Content";
$detalle_layout = new clsGriddetalle_layout("", $MainPage);
$detalle_layoutSearch = new clsRecorddetalle_layoutSearch("", $MainPage);
$Menu = new clsPanel("Menu", $MainPage);
$Menu->PlaceholderName = "Menu";
$MenuIncludablePage = new clsMenuIncludablePage("", "MenuIncludablePage", $MainPage);
$MenuIncludablePage->Initialize();
$Sidebar1 = new clsPanel("Sidebar1", $MainPage);
$Sidebar1->PlaceholderName = "Sidebar1";
$HeaderSidebar = new clsPanel("HeaderSidebar", $MainPage);
$HeaderSidebar->PlaceholderName = "HeaderSidebar";
$MainPage->Head = & $Head;
$MainPage->Content = & $Content;
$MainPage->detalle_layout = & $detalle_layout;
$MainPage->detalle_layoutSearch = & $detalle_layoutSearch;
$MainPage->Menu = & $Menu;
$MainPage->MenuIncludablePage = & $MenuIncludablePage;
$MainPage->Sidebar1 = & $Sidebar1;
$MainPage->HeaderSidebar = & $HeaderSidebar;
$Content->AddComponent("detalle_layout", $detalle_layout);
$Content->AddComponent("detalle_layoutSearch", $detalle_layoutSearch);
$Menu->AddComponent("MenuIncludablePage", $MenuIncludablePage);
$detalle_layout->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-A7427295
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
if (strlen($TemplateSource)) {
    $Tpl->LoadTemplateFromStr($TemplateSource, $BlockToParse, "CP1252");
} else {
    $Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
}
$Tpl->SetVar("CCS_PathToRoot", $PathToRoot);
$Tpl->SetVar("CCS_PathToMasterPage", RelativePath . $PathToCurrentMasterPage);
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-60AEFDB0
$MasterPage->Operations();
$MenuIncludablePage->Operations();
$detalle_layoutSearch->Operation();
//End Execute Components

//Go to destination page @1-B89EECCA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($detalle_layout);
    unset($detalle_layoutSearch);
    $MenuIncludablePage->Class_Terminate();
    unset($MenuIncludablePage);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6235915D
$Head->Show();
$Content->Show();
$Menu->Show();
$Sidebar1->Show();
$HeaderSidebar->Show();
$MasterPage->Tpl->SetVar("Head", $Tpl->GetVar("Panel Head"));
$MasterPage->Tpl->SetVar("Content", $Tpl->GetVar("Panel Content"));
$MasterPage->Tpl->SetVar("Menu", $Tpl->GetVar("Panel Menu"));
$MasterPage->Tpl->SetVar("Sidebar1", $Tpl->GetVar("Panel Sidebar1"));
$MasterPage->Tpl->SetVar("HeaderSidebar", $Tpl->GetVar("Panel HeaderSidebar"));
$MasterPage->Show();
if (!isset($main_block)) $main_block = $MasterPage->HTML;
$main_block = CCConvertEncoding($main_block, $FileEncoding, $TemplateEncoding);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-21A35674
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($MasterPage);
unset($detalle_layout);
unset($detalle_layoutSearch);
$MenuIncludablePage->Class_Terminate();
unset($MenuIncludablePage);
unset($Tpl);
//End Unload Page