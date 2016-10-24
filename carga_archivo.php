<?php
//Include Common Files @1-0F44BB65
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "carga_archivo.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordNewRecord1 { //NewRecord1 Class @2-D7EDAFB1

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

//Class_Initialize Event @2-4D072F35
    function clsRecordNewRecord1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record NewRecord1/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "NewRecord1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsSQL;
            $this->ListBox1->DataSource = new clsDBcon_xls();
            $this->ListBox1->ds = & $this->ListBox1->DataSource;
            list($this->ListBox1->BoundColumn, $this->ListBox1->TextColumn, $this->ListBox1->DBFormat) = array("id_periodo", "periodo", "");
            $this->ListBox1->DataSource->Parameters["sesid_proveedor"] = CCGetSession("id_proveedor", NULL);
            $this->ListBox1->DataSource->wp = new clsSQLParameters();
            $this->ListBox1->DataSource->wp->AddParameter("1", "sesid_proveedor", ccsInteger, "", "", $this->ListBox1->DataSource->Parameters["sesid_proveedor"], 0, false);
            $this->ListBox1->DataSource->SQL = "select id_periodo,  periodo+tipo_periodo as periodo\n" .
            "from periodos_validos\n" .
            "where (id_proveedor=0 or id_proveedor=" . $this->ListBox1->DataSource->SQLValue($this->ListBox1->DataSource->wp->GetDBValue("1"), ccsInteger) . " )";
            $this->ListBox1->DataSource->Order = "";
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            $this->archivo_excel = new clsFileUpload("archivo_excel", "archivo de excel", "./temp_xls/", "./", "*", "", 10000000, $this);
            $this->archivo_excel->Required = true;
            $this->ruta_archivo = new clsControl(ccsHidden, "ruta_archivo", "ruta_archivo", ccsText, "", CCGetRequestParam("ruta_archivo", $Method, NULL), $this);
            $this->Aplicar = new clsButton("Aplicar", $Method, $this);
            $this->Label3 = new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", CCGetRequestParam("Label3", $Method, NULL), $this);
            $this->id_reg_ok = new clsControl(ccsHidden, "id_reg_ok", "id_reg_ok", ccsText, "", CCGetRequestParam("id_reg_ok", $Method, NULL), $this);
            $this->lnom_cds = new clsControl(ccsLabel, "lnom_cds", "lnom_cds", ccsText, "", CCGetRequestParam("lnom_cds", $Method, NULL), $this);
            $this->lnom_cds->HTML = true;
            $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", $Method, NULL), $this);
            $this->Label1->HTML = true;
            $this->Label2 = new clsControl(ccsLabel, "Label2", "Label2", ccsText, "", CCGetRequestParam("Label2", $Method, NULL), $this);
            $this->Label2->HTML = true;
            $this->Label4 = new clsControl(ccsLabel, "Label4", "Label4", ccsText, "", CCGetRequestParam("Label4", $Method, NULL), $this);
            $this->optsla = new clsControl(ccsRadioButton, "optsla", "optsla", ccsText, "", CCGetRequestParam("optsla", $Method, NULL), $this);
            $this->optsla->DSType = dsListOfValues;
            $this->optsla->Values = array(array("SLA", "SLA"), array("SLO", "SLO"));
            $this->optsla->HTML = true;
            $this->img_cargando = new clsControl(ccsImage, "img_cargando", "img_cargando", ccsText, "", CCGetRequestParam("img_cargando", $Method, NULL), $this);
            $this->img_cargando->Visible = false;
        }
    }
//End Class_Initialize Event

//Validate Method @2-06B71CA7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->archivo_excel->Validate() && $Validation);
        $Validation = ($this->ruta_archivo->Validate() && $Validation);
        $Validation = ($this->id_reg_ok->Validate() && $Validation);
        $Validation = ($this->optsla->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->archivo_excel->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ruta_archivo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->id_reg_ok->Errors->Count() == 0);
        $Validation =  $Validation && ($this->optsla->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-C57EB426
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->archivo_excel->Errors->Count());
        $errors = ($errors || $this->ruta_archivo->Errors->Count());
        $errors = ($errors || $this->Label3->Errors->Count());
        $errors = ($errors || $this->id_reg_ok->Errors->Count());
        $errors = ($errors || $this->lnom_cds->Errors->Count());
        $errors = ($errors || $this->Label1->Errors->Count());
        $errors = ($errors || $this->Label2->Errors->Count());
        $errors = ($errors || $this->Label4->Errors->Count());
        $errors = ($errors || $this->optsla->Errors->Count());
        $errors = ($errors || $this->img_cargando->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-DEDB875B
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        $this->archivo_excel->Upload();

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            } else if($this->Aplicar->Pressed) {
                $this->PressedButton = "Aplicar";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Aplicar") {
                $Redirect = "carga_archivo.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ccsForm"));
                if(!CCGetEvent($this->Aplicar->CCSEvents, "OnClick", $this->Aplicar)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-9EDAE46C
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

        $this->ListBox1->Prepare();
        $this->optsla->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->archivo_excel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ruta_archivo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->id_reg_ok->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lnom_cds->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->optsla->Errors->ToString());
            $Error = ComposeStrings($Error, $this->img_cargando->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
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
        $this->ListBox1->Show();
        $this->Button_Cancel->Show();
        $this->archivo_excel->Show();
        $this->ruta_archivo->Show();
        $this->Aplicar->Show();
        $this->Label3->Show();
        $this->id_reg_ok->Show();
        $this->lnom_cds->Show();
        $this->Label1->Show();
        $this->Label2->Show();
        $this->Label4->Show();
        $this->optsla->Show();
        $this->img_cargando->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End NewRecord1 Class @2-FCB6E20C

//Include Page implementation @32-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Initialize Page @1-3B9A203D
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
$TemplateFileName = "carga_archivo.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-02580CDE
include_once("./carga_archivo_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-941E6B6B
$DBcon_xls = new clsDBcon_xls();
$MainPage->Connections["con_xls"] = & $DBcon_xls;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$NewRecord1 = new clsRecordNewRecord1("", $MainPage);
$Header = new clsHeader("", "Header", $MainPage);
$Header->Initialize();
$MainPage->NewRecord1 = & $NewRecord1;
$MainPage->Header = & $Header;
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

//Execute Components @1-0E1A8725
$Header->Operations();
$NewRecord1->Operation();
//End Execute Components

//Go to destination page @1-A991F59E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($NewRecord1);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-EFA7E4D8
$NewRecord1->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $TemplateEncoding);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F1DBF258
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($NewRecord1);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
