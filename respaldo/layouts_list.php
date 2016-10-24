<?php
//Include Common Files @1-A34E1C8F
define("RelativePath", "..");
define("PathToCurrentPage", "/respaldo/");
define("FileName", "layouts_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Master Page implementation @1-ECD4BC60
include_once(RelativePath . "/Designs/Apricot/MasterPage.php");
//End Master Page implementation

class clsGridlayouts { //layouts class @9-A0AF77B4

//Variables @9-5A7CDBED

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
    public $Sorter_id_layout;
    public $Sorter_nombre_layout;
    public $Sorter_num_hojas;
    public $Sorter_posicionable;
    public $Sorter_nombre_tabla_destino;
    public $Sorter_tipo_arch;
    public $Sorter_num_cols_descartar;
//End Variables

//Class_Initialize Event @9-BD26B75A
    function clsGridlayouts($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "layouts";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid layouts";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clslayoutsDataSource($this);
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
        $this->SorterName = CCGetParam("layoutsOrder", "");
        $this->SorterDirection = CCGetParam("layoutsDir", "");

        $this->id_layout = new clsControl(ccsLink, "id_layout", "id_layout", ccsInteger, "", CCGetRequestParam("id_layout", ccsGet, NULL), $this);
        $this->id_layout->Page = "layouts_maint.php";
        $this->nombre_layout = new clsControl(ccsLabel, "nombre_layout", "nombre_layout", ccsText, "", CCGetRequestParam("nombre_layout", ccsGet, NULL), $this);
        $this->num_hojas = new clsControl(ccsLabel, "num_hojas", "num_hojas", ccsInteger, "", CCGetRequestParam("num_hojas", ccsGet, NULL), $this);
        $this->posicionable = new clsControl(ccsLabel, "posicionable", "posicionable", ccsText, "", CCGetRequestParam("posicionable", ccsGet, NULL), $this);
        $this->nombre_tabla_destino = new clsControl(ccsLabel, "nombre_tabla_destino", "nombre_tabla_destino", ccsText, "", CCGetRequestParam("nombre_tabla_destino", ccsGet, NULL), $this);
        $this->tipo_arch = new clsControl(ccsLabel, "tipo_arch", "tipo_arch", ccsText, "", CCGetRequestParam("tipo_arch", ccsGet, NULL), $this);
        $this->num_cols_descartar = new clsControl(ccsLabel, "num_cols_descartar", "num_cols_descartar", ccsInteger, "", CCGetRequestParam("num_cols_descartar", ccsGet, NULL), $this);
        $this->layouts_Insert = new clsControl(ccsLink, "layouts_Insert", "layouts_Insert", ccsText, "", CCGetRequestParam("layouts_Insert", ccsGet, NULL), $this);
        $this->layouts_Insert->Parameters = CCGetQueryString("QueryString", array("id_layout", "ccsForm"));
        $this->layouts_Insert->Page = "layouts_maint.php";
        $this->Sorter_id_layout = new clsSorter($this->ComponentName, "Sorter_id_layout", $FileName, $this);
        $this->Sorter_nombre_layout = new clsSorter($this->ComponentName, "Sorter_nombre_layout", $FileName, $this);
        $this->Sorter_num_hojas = new clsSorter($this->ComponentName, "Sorter_num_hojas", $FileName, $this);
        $this->Sorter_posicionable = new clsSorter($this->ComponentName, "Sorter_posicionable", $FileName, $this);
        $this->Sorter_nombre_tabla_destino = new clsSorter($this->ComponentName, "Sorter_nombre_tabla_destino", $FileName, $this);
        $this->Sorter_tipo_arch = new clsSorter($this->ComponentName, "Sorter_tipo_arch", $FileName, $this);
        $this->Sorter_num_cols_descartar = new clsSorter($this->ComponentName, "Sorter_num_cols_descartar", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @9-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @9-EF0B4301
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nombre_layout"] = CCGetFromGet("s_nombre_layout", NULL);
        $this->DataSource->Parameters["urls_posicionable"] = CCGetFromGet("s_posicionable", NULL);
        $this->DataSource->Parameters["urls_nombre_tabla_destino"] = CCGetFromGet("s_nombre_tabla_destino", NULL);
        $this->DataSource->Parameters["urls_tipo_arch"] = CCGetFromGet("s_tipo_arch", NULL);

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
            $this->ControlsVisible["id_layout"] = $this->id_layout->Visible;
            $this->ControlsVisible["nombre_layout"] = $this->nombre_layout->Visible;
            $this->ControlsVisible["num_hojas"] = $this->num_hojas->Visible;
            $this->ControlsVisible["posicionable"] = $this->posicionable->Visible;
            $this->ControlsVisible["nombre_tabla_destino"] = $this->nombre_tabla_destino->Visible;
            $this->ControlsVisible["tipo_arch"] = $this->tipo_arch->Visible;
            $this->ControlsVisible["num_cols_descartar"] = $this->num_cols_descartar->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id_layout->SetValue($this->DataSource->id_layout->GetValue());
                $this->id_layout->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->id_layout->Parameters = CCAddParam($this->id_layout->Parameters, "id_layout", $this->DataSource->f("id_layout"));
                $this->nombre_layout->SetValue($this->DataSource->nombre_layout->GetValue());
                $this->num_hojas->SetValue($this->DataSource->num_hojas->GetValue());
                $this->posicionable->SetValue($this->DataSource->posicionable->GetValue());
                $this->nombre_tabla_destino->SetValue($this->DataSource->nombre_tabla_destino->GetValue());
                $this->tipo_arch->SetValue($this->DataSource->tipo_arch->GetValue());
                $this->num_cols_descartar->SetValue($this->DataSource->num_cols_descartar->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id_layout->Show();
                $this->nombre_layout->Show();
                $this->num_hojas->Show();
                $this->posicionable->Show();
                $this->nombre_tabla_destino->Show();
                $this->tipo_arch->Show();
                $this->num_cols_descartar->Show();
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
        $this->layouts_Insert->Show();
        $this->Sorter_id_layout->Show();
        $this->Sorter_nombre_layout->Show();
        $this->Sorter_num_hojas->Show();
        $this->Sorter_posicionable->Show();
        $this->Sorter_nombre_tabla_destino->Show();
        $this->Sorter_tipo_arch->Show();
        $this->Sorter_num_cols_descartar->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @9-3652FBF2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id_layout->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_layout->Errors->ToString());
        $errors = ComposeStrings($errors, $this->num_hojas->Errors->ToString());
        $errors = ComposeStrings($errors, $this->posicionable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_tabla_destino->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_arch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->num_cols_descartar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End layouts Class @9-FCB6E20C

class clslayoutsDataSource extends clsDBcon_xls {  //layoutsDataSource Class @9-B4A1AEBA

//DataSource Variables @9-679C85F8
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $id_layout;
    public $nombre_layout;
    public $num_hojas;
    public $posicionable;
    public $nombre_tabla_destino;
    public $tipo_arch;
    public $num_cols_descartar;
//End DataSource Variables

//DataSourceClass_Initialize Event @9-5DE21AC5
    function clslayoutsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid layouts";
        $this->Initialize();
        $this->id_layout = new clsField("id_layout", ccsInteger, "");
        
        $this->nombre_layout = new clsField("nombre_layout", ccsText, "");
        
        $this->num_hojas = new clsField("num_hojas", ccsInteger, "");
        
        $this->posicionable = new clsField("posicionable", ccsText, "");
        
        $this->nombre_tabla_destino = new clsField("nombre_tabla_destino", ccsText, "");
        
        $this->tipo_arch = new clsField("tipo_arch", ccsText, "");
        
        $this->num_cols_descartar = new clsField("num_cols_descartar", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @9-B1B02FBC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id_layout" => array("id_layout", ""), 
            "Sorter_nombre_layout" => array("nombre_layout", ""), 
            "Sorter_num_hojas" => array("num_hojas", ""), 
            "Sorter_posicionable" => array("posicionable", ""), 
            "Sorter_nombre_tabla_destino" => array("nombre_tabla_destino", ""), 
            "Sorter_tipo_arch" => array("tipo_arch", ""), 
            "Sorter_num_cols_descartar" => array("num_cols_descartar", "")));
    }
//End SetOrder Method

//Prepare Method @9-8D8B882C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nombre_layout", ccsText, "", "", $this->Parameters["urls_nombre_layout"], "", false);
        $this->wp->AddParameter("2", "urls_posicionable", ccsText, "", "", $this->Parameters["urls_posicionable"], "", false);
        $this->wp->AddParameter("3", "urls_nombre_tabla_destino", ccsText, "", "", $this->Parameters["urls_nombre_tabla_destino"], "", false);
        $this->wp->AddParameter("4", "urls_tipo_arch", ccsText, "", "", $this->Parameters["urls_tipo_arch"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nombre_layout", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "posicionable", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "nombre_tabla_destino", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "tipo_arch", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @9-A2CF85DD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM layouts";
        $this->SQL = "SELECT id_layout, nombre_layout, num_hojas, posicionable, nombre_tabla_destino, tipo_arch, num_cols_descartar \n\n" .
        "FROM layouts {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @9-ADEFD6D4
    function SetValues()
    {
        $this->id_layout->SetDBValue(trim($this->f("id_layout")));
        $this->nombre_layout->SetDBValue($this->f("nombre_layout"));
        $this->num_hojas->SetDBValue(trim($this->f("num_hojas")));
        $this->posicionable->SetDBValue($this->f("posicionable"));
        $this->nombre_tabla_destino->SetDBValue($this->f("nombre_tabla_destino"));
        $this->tipo_arch->SetDBValue($this->f("tipo_arch"));
        $this->num_cols_descartar->SetDBValue(trim($this->f("num_cols_descartar")));
    }
//End SetValues Method

} //End layoutsDataSource Class @9-FCB6E20C

class clsRecordlayoutsSearch { //layoutsSearch Class @2-2971A77D

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

//Class_Initialize Event @2-77C88D12
    function clsRecordlayoutsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record layoutsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "layoutsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_nombre_layout = new clsControl(ccsTextBox, "s_nombre_layout", "Nombre Layout", ccsText, "", CCGetRequestParam("s_nombre_layout", $Method, NULL), $this);
            $this->s_posicionable = new clsControl(ccsTextBox, "s_posicionable", "Posicionable", ccsText, "", CCGetRequestParam("s_posicionable", $Method, NULL), $this);
            $this->s_nombre_tabla_destino = new clsControl(ccsTextBox, "s_nombre_tabla_destino", "Nombre Tabla Destino", ccsText, "", CCGetRequestParam("s_nombre_tabla_destino", $Method, NULL), $this);
            $this->s_tipo_arch = new clsControl(ccsTextBox, "s_tipo_arch", "Tipo Arch", ccsText, "", CCGetRequestParam("s_tipo_arch", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-D3F0F73B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_nombre_layout->Validate() && $Validation);
        $Validation = ($this->s_posicionable->Validate() && $Validation);
        $Validation = ($this->s_nombre_tabla_destino->Validate() && $Validation);
        $Validation = ($this->s_tipo_arch->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_nombre_layout->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_posicionable->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombre_tabla_destino->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tipo_arch->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-1820C756
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_nombre_layout->Errors->Count());
        $errors = ($errors || $this->s_posicionable->Errors->Count());
        $errors = ($errors || $this->s_nombre_tabla_destino->Errors->Count());
        $errors = ($errors || $this->s_tipo_arch->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-64AE3969
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
        $Redirect = "layouts_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "layouts_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-233AA6BF
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_nombre_layout->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_posicionable->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombre_tabla_destino->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tipo_arch->Errors->ToString());
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
        $this->s_nombre_layout->Show();
        $this->s_posicionable->Show();
        $this->s_nombre_tabla_destino->Show();
        $this->s_tipo_arch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End layoutsSearch Class @2-FCB6E20C

//Include Page implementation @46-A738AFAB
include_once(RelativePath . "/respaldo/MenuIncludablePage.php");
//End Include Page implementation

//Initialize Page @1-A9264C1D
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
$TemplateFileName = "layouts_list.html";
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

//Include events file @1-2ECC4A96
include_once("./layouts_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3E06C5A1
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
$layouts = new clsGridlayouts("", $MainPage);
$layoutsSearch = new clsRecordlayoutsSearch("", $MainPage);
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
$MainPage->layouts = & $layouts;
$MainPage->layoutsSearch = & $layoutsSearch;
$MainPage->Menu = & $Menu;
$MainPage->MenuIncludablePage = & $MenuIncludablePage;
$MainPage->Sidebar1 = & $Sidebar1;
$MainPage->HeaderSidebar = & $HeaderSidebar;
$Content->AddComponent("layouts", $layouts);
$Content->AddComponent("layoutsSearch", $layoutsSearch);
$Menu->AddComponent("MenuIncludablePage", $MenuIncludablePage);
$layouts->Initialize();
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

//Execute Components @1-1D30BE1E
$MasterPage->Operations();
$MenuIncludablePage->Operations();
$layoutsSearch->Operation();
//End Execute Components

//Go to destination page @1-5EB89782
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($layouts);
    unset($layoutsSearch);
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

//Unload Page @1-199CBACE
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($MasterPage);
unset($layouts);
unset($layoutsSearch);
$MenuIncludablePage->Class_Terminate();
unset($MenuIncludablePage);
unset($Tpl);
//End Unload Page


?>


//Include Common Files @1-A34E1C8F
define("RelativePath", "..");
define("PathToCurrentPage", "/respaldo/");
define("FileName", "layouts_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Master Page implementation @1-ECD4BC60
include_once(RelativePath . "/Designs/Apricot/MasterPage.php");
//End Master Page implementation

class clsGridlayouts { //layouts class @9-A0AF77B4

//Variables @9-5A7CDBED

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
    public $Sorter_id_layout;
    public $Sorter_nombre_layout;
    public $Sorter_num_hojas;
    public $Sorter_posicionable;
    public $Sorter_nombre_tabla_destino;
    public $Sorter_tipo_arch;
    public $Sorter_num_cols_descartar;
//End Variables

//Class_Initialize Event @9-BD26B75A
    function clsGridlayouts($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "layouts";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid layouts";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clslayoutsDataSource($this);
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
        $this->SorterName = CCGetParam("layoutsOrder", "");
        $this->SorterDirection = CCGetParam("layoutsDir", "");

        $this->id_layout = new clsControl(ccsLink, "id_layout", "id_layout", ccsInteger, "", CCGetRequestParam("id_layout", ccsGet, NULL), $this);
        $this->id_layout->Page = "layouts_maint.php";
        $this->nombre_layout = new clsControl(ccsLabel, "nombre_layout", "nombre_layout", ccsText, "", CCGetRequestParam("nombre_layout", ccsGet, NULL), $this);
        $this->num_hojas = new clsControl(ccsLabel, "num_hojas", "num_hojas", ccsInteger, "", CCGetRequestParam("num_hojas", ccsGet, NULL), $this);
        $this->posicionable = new clsControl(ccsLabel, "posicionable", "posicionable", ccsText, "", CCGetRequestParam("posicionable", ccsGet, NULL), $this);
        $this->nombre_tabla_destino = new clsControl(ccsLabel, "nombre_tabla_destino", "nombre_tabla_destino", ccsText, "", CCGetRequestParam("nombre_tabla_destino", ccsGet, NULL), $this);
        $this->tipo_arch = new clsControl(ccsLabel, "tipo_arch", "tipo_arch", ccsText, "", CCGetRequestParam("tipo_arch", ccsGet, NULL), $this);
        $this->num_cols_descartar = new clsControl(ccsLabel, "num_cols_descartar", "num_cols_descartar", ccsInteger, "", CCGetRequestParam("num_cols_descartar", ccsGet, NULL), $this);
        $this->layouts_Insert = new clsControl(ccsLink, "layouts_Insert", "layouts_Insert", ccsText, "", CCGetRequestParam("layouts_Insert", ccsGet, NULL), $this);
        $this->layouts_Insert->Parameters = CCGetQueryString("QueryString", array("id_layout", "ccsForm"));
        $this->layouts_Insert->Page = "layouts_maint.php";
        $this->Sorter_id_layout = new clsSorter($this->ComponentName, "Sorter_id_layout", $FileName, $this);
        $this->Sorter_nombre_layout = new clsSorter($this->ComponentName, "Sorter_nombre_layout", $FileName, $this);
        $this->Sorter_num_hojas = new clsSorter($this->ComponentName, "Sorter_num_hojas", $FileName, $this);
        $this->Sorter_posicionable = new clsSorter($this->ComponentName, "Sorter_posicionable", $FileName, $this);
        $this->Sorter_nombre_tabla_destino = new clsSorter($this->ComponentName, "Sorter_nombre_tabla_destino", $FileName, $this);
        $this->Sorter_tipo_arch = new clsSorter($this->ComponentName, "Sorter_tipo_arch", $FileName, $this);
        $this->Sorter_num_cols_descartar = new clsSorter($this->ComponentName, "Sorter_num_cols_descartar", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @9-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @9-3695DDA2
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nombre_layout"] = CCGetFromGet("s_nombre_layout", NULL);
        $this->DataSource->Parameters["urls_posicionable"] = CCGetFromGet("s_posicionable", NULL);
        $this->DataSource->Parameters["urls_nombre_tabla_destino"] = CCGetFromGet("s_nombre_tabla_destino", NULL);
        $this->DataSource->Parameters["urls_tipo_arch"] = CCGetFromGet("s_tipo_arch", NULL);

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
            $this->ControlsVisible["id_layout"] = $this->id_layout->Visible;
            $this->ControlsVisible["nombre_layout"] = $this->nombre_layout->Visible;
            $this->ControlsVisible["num_hojas"] = $this->num_hojas->Visible;
            $this->ControlsVisible["posicionable"] = $this->posicionable->Visible;
            $this->ControlsVisible["nombre_tabla_destino"] = $this->nombre_tabla_destino->Visible;
            $this->ControlsVisible["tipo_arch"] = $this->tipo_arch->Visible;
            $this->ControlsVisible["num_cols_descartar"] = $this->num_cols_descartar->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id_layout->SetValue($this->DataSource->id_layout->GetValue());
                $this->id_layout->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->id_layout->Parameters = CCAddParam($this->id_layout->Parameters, "id_layout", $this->DataSource->f("id_layout"));
                $this->nombre_layout->SetValue($this->DataSource->nombre_layout->GetValue());
                $this->num_hojas->SetValue($this->DataSource->num_hojas->GetValue());
                $this->posicionable->SetValue($this->DataSource->posicionable->GetValue());
                $this->nombre_tabla_destino->SetValue($this->DataSource->nombre_tabla_destino->GetValue());
                $this->tipo_arch->SetValue($this->DataSource->tipo_arch->GetValue());
                $this->num_cols_descartar->SetValue($this->DataSource->num_cols_descartar->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id_layout->Show();
                $this->nombre_layout->Show();
                $this->num_hojas->Show();
                $this->posicionable->Show();
                $this->nombre_tabla_destino->Show();
                $this->tipo_arch->Show();
                $this->num_cols_descartar->Show();
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
        $this->layouts_Insert->Show();
        $this->Sorter_id_layout->Show();
        $this->Sorter_nombre_layout->Show();
        $this->Sorter_num_hojas->Show();
        $this->Sorter_posicionable->Show();
        $this->Sorter_nombre_tabla_destino->Show();
        $this->Sorter_tipo_arch->Show();
        $this->Sorter_num_cols_descartar->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @9-3652FBF2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id_layout->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_layout->Errors->ToString());
        $errors = ComposeStrings($errors, $this->num_hojas->Errors->ToString());
        $errors = ComposeStrings($errors, $this->posicionable->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_tabla_destino->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_arch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->num_cols_descartar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End layouts Class @9-FCB6E20C

class clslayoutsDataSource extends clsDBcon_xls {  //layoutsDataSource Class @9-B4A1AEBA

//DataSource Variables @9-679C85F8
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $id_layout;
    public $nombre_layout;
    public $num_hojas;
    public $posicionable;
    public $nombre_tabla_destino;
    public $tipo_arch;
    public $num_cols_descartar;
//End DataSource Variables

//DataSourceClass_Initialize Event @9-5DE21AC5
    function clslayoutsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid layouts";
        $this->Initialize();
        $this->id_layout = new clsField("id_layout", ccsInteger, "");
        
        $this->nombre_layout = new clsField("nombre_layout", ccsText, "");
        
        $this->num_hojas = new clsField("num_hojas", ccsInteger, "");
        
        $this->posicionable = new clsField("posicionable", ccsText, "");
        
        $this->nombre_tabla_destino = new clsField("nombre_tabla_destino", ccsText, "");
        
        $this->tipo_arch = new clsField("tipo_arch", ccsText, "");
        
        $this->num_cols_descartar = new clsField("num_cols_descartar", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @9-B1B02FBC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id_layout" => array("id_layout", ""), 
            "Sorter_nombre_layout" => array("nombre_layout", ""), 
            "Sorter_num_hojas" => array("num_hojas", ""), 
            "Sorter_posicionable" => array("posicionable", ""), 
            "Sorter_nombre_tabla_destino" => array("nombre_tabla_destino", ""), 
            "Sorter_tipo_arch" => array("tipo_arch", ""), 
            "Sorter_num_cols_descartar" => array("num_cols_descartar", "")));
    }
//End SetOrder Method

//Prepare Method @9-8D8B882C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nombre_layout", ccsText, "", "", $this->Parameters["urls_nombre_layout"], "", false);
        $this->wp->AddParameter("2", "urls_posicionable", ccsText, "", "", $this->Parameters["urls_posicionable"], "", false);
        $this->wp->AddParameter("3", "urls_nombre_tabla_destino", ccsText, "", "", $this->Parameters["urls_nombre_tabla_destino"], "", false);
        $this->wp->AddParameter("4", "urls_tipo_arch", ccsText, "", "", $this->Parameters["urls_tipo_arch"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nombre_layout", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "posicionable", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "nombre_tabla_destino", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "tipo_arch", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @9-7237DE72
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM layouts";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} id_layout, nombre_layout, num_hojas, posicionable, nombre_tabla_destino, tipo_arch, num_cols_descartar \n\n" .
        "FROM layouts {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @9-ADEFD6D4
    function SetValues()
    {
        $this->id_layout->SetDBValue(trim($this->f("id_layout")));
        $this->nombre_layout->SetDBValue($this->f("nombre_layout"));
        $this->num_hojas->SetDBValue(trim($this->f("num_hojas")));
        $this->posicionable->SetDBValue($this->f("posicionable"));
        $this->nombre_tabla_destino->SetDBValue($this->f("nombre_tabla_destino"));
        $this->tipo_arch->SetDBValue($this->f("tipo_arch"));
        $this->num_cols_descartar->SetDBValue(trim($this->f("num_cols_descartar")));
    }
//End SetValues Method

} //End layoutsDataSource Class @9-FCB6E20C

class clsRecordlayoutsSearch { //layoutsSearch Class @2-2971A77D

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

//Class_Initialize Event @2-77C88D12
    function clsRecordlayoutsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record layoutsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "layoutsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_nombre_layout = new clsControl(ccsTextBox, "s_nombre_layout", "Nombre Layout", ccsText, "", CCGetRequestParam("s_nombre_layout", $Method, NULL), $this);
            $this->s_posicionable = new clsControl(ccsTextBox, "s_posicionable", "Posicionable", ccsText, "", CCGetRequestParam("s_posicionable", $Method, NULL), $this);
            $this->s_nombre_tabla_destino = new clsControl(ccsTextBox, "s_nombre_tabla_destino", "Nombre Tabla Destino", ccsText, "", CCGetRequestParam("s_nombre_tabla_destino", $Method, NULL), $this);
            $this->s_tipo_arch = new clsControl(ccsTextBox, "s_tipo_arch", "Tipo Arch", ccsText, "", CCGetRequestParam("s_tipo_arch", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-D3F0F73B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_nombre_layout->Validate() && $Validation);
        $Validation = ($this->s_posicionable->Validate() && $Validation);
        $Validation = ($this->s_nombre_tabla_destino->Validate() && $Validation);
        $Validation = ($this->s_tipo_arch->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_nombre_layout->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_posicionable->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombre_tabla_destino->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tipo_arch->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-1820C756
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_nombre_layout->Errors->Count());
        $errors = ($errors || $this->s_posicionable->Errors->Count());
        $errors = ($errors || $this->s_nombre_tabla_destino->Errors->Count());
        $errors = ($errors || $this->s_tipo_arch->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-64AE3969
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
        $Redirect = "layouts_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "layouts_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-B5E380C9
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_nombre_layout->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_posicionable->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombre_tabla_destino->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tipo_arch->Errors->ToString());
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
        $this->s_nombre_layout->Show();
        $this->s_posicionable->Show();
        $this->s_nombre_tabla_destino->Show();
        $this->s_tipo_arch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End layoutsSearch Class @2-FCB6E20C

//Include Page implementation @46-A738AFAB
include_once(RelativePath . "/respaldo/MenuIncludablePage.php");
//End Include Page implementation

//Initialize Page @1-A714AEFA
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
$TemplateFileName = "layouts_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-2ECC4A96
include_once("./layouts_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-15C0867E
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
$layouts = new clsGridlayouts("", $MainPage);
$layoutsSearch = new clsRecordlayoutsSearch("", $MainPage);
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
$MainPage->layouts = & $layouts;
$MainPage->layoutsSearch = & $layoutsSearch;
$MainPage->Menu = & $Menu;
$MainPage->MenuIncludablePage = & $MenuIncludablePage;
$MainPage->Sidebar1 = & $Sidebar1;
$MainPage->HeaderSidebar = & $HeaderSidebar;
$Content->AddComponent("layouts", $layouts);
$Content->AddComponent("layoutsSearch", $layoutsSearch);
$Menu->AddComponent("MenuIncludablePage", $MenuIncludablePage);
$layouts->Initialize();

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

//Execute Components @1-1D30BE1E
$MasterPage->Operations();
$MenuIncludablePage->Operations();
$layoutsSearch->Operation();
//End Execute Components

//Go to destination page @1-5EB89782
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($layouts);
    unset($layoutsSearch);
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

//Unload Page @1-199CBACE
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($MasterPage);
unset($layouts);
unset($layoutsSearch);
$MenuIncludablePage->Class_Terminate();
unset($MenuIncludablePage);
unset($Tpl);
//End Unload Page