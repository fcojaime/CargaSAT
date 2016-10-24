<?php
//Include Common Files @1-D2C172CA
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "usuario_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Master Page implementation @1-ECD4BC60
include_once(RelativePath . "/Designs/Apricot/MasterPage.php");
//End Master Page implementation

class clsGridusuario { //usuario class @7-94B6FB8E

//Variables @7-420711F7

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
    public $Sorter_id_usuario;
    public $Sorter_nombre_usuario;
    public $Sorter_usuario;
    public $Sorter_nivel;
//End Variables

//Class_Initialize Event @7-7E182732
    function clsGridusuario($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "usuario";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid usuario";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsusuarioDataSource($this);
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
        $this->SorterName = CCGetParam("usuarioOrder", "");
        $this->SorterDirection = CCGetParam("usuarioDir", "");

        $this->id_usuario = new clsControl(ccsLink, "id_usuario", "id_usuario", ccsInteger, "", CCGetRequestParam("id_usuario", ccsGet, NULL), $this);
        $this->id_usuario->Page = "usuario_maint.php";
        $this->nombre_usuario = new clsControl(ccsLabel, "nombre_usuario", "nombre_usuario", ccsText, "", CCGetRequestParam("nombre_usuario", ccsGet, NULL), $this);
        $this->usuario1 = new clsControl(ccsLabel, "usuario1", "usuario1", ccsText, "", CCGetRequestParam("usuario1", ccsGet, NULL), $this);
        $this->nivel = new clsControl(ccsLabel, "nivel", "nivel", ccsInteger, "", CCGetRequestParam("nivel", ccsGet, NULL), $this);
        $this->usuario_Insert = new clsControl(ccsLink, "usuario_Insert", "usuario_Insert", ccsText, "", CCGetRequestParam("usuario_Insert", ccsGet, NULL), $this);
        $this->usuario_Insert->Parameters = CCGetQueryString("QueryString", array("id_usuario", "ccsForm"));
        $this->usuario_Insert->Page = "usuario_maint.php";
        $this->Sorter_id_usuario = new clsSorter($this->ComponentName, "Sorter_id_usuario", $FileName, $this);
        $this->Sorter_nombre_usuario = new clsSorter($this->ComponentName, "Sorter_nombre_usuario", $FileName, $this);
        $this->Sorter_usuario = new clsSorter($this->ComponentName, "Sorter_usuario", $FileName, $this);
        $this->Sorter_nivel = new clsSorter($this->ComponentName, "Sorter_nivel", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @7-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @7-D43C67CB
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nombre_usuario"] = CCGetFromGet("s_nombre_usuario", NULL);
        $this->DataSource->Parameters["urls_usuario"] = CCGetFromGet("s_usuario", NULL);

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
            $this->ControlsVisible["id_usuario"] = $this->id_usuario->Visible;
            $this->ControlsVisible["nombre_usuario"] = $this->nombre_usuario->Visible;
            $this->ControlsVisible["usuario1"] = $this->usuario1->Visible;
            $this->ControlsVisible["nivel"] = $this->nivel->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id_usuario->SetValue($this->DataSource->id_usuario->GetValue());
                $this->id_usuario->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->id_usuario->Parameters = CCAddParam($this->id_usuario->Parameters, "id_usuario", $this->DataSource->f("id_usuario"));
                $this->nombre_usuario->SetValue($this->DataSource->nombre_usuario->GetValue());
                $this->usuario1->SetValue($this->DataSource->usuario1->GetValue());
                $this->nivel->SetValue($this->DataSource->nivel->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id_usuario->Show();
                $this->nombre_usuario->Show();
                $this->usuario1->Show();
                $this->nivel->Show();
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
        $this->usuario_Insert->Show();
        $this->Sorter_id_usuario->Show();
        $this->Sorter_nombre_usuario->Show();
        $this->Sorter_usuario->Show();
        $this->Sorter_nivel->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @7-DD0DD11E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->usuario1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nivel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End usuario Class @7-FCB6E20C

class clsusuarioDataSource extends clsDBcon_xls {  //usuarioDataSource Class @7-A0B5C18B

//DataSource Variables @7-4AF335CF
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $id_usuario;
    public $nombre_usuario;
    public $usuario1;
    public $nivel;
//End DataSource Variables

//DataSourceClass_Initialize Event @7-D2EBCFBD
    function clsusuarioDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid usuario";
        $this->Initialize();
        $this->id_usuario = new clsField("id_usuario", ccsInteger, "");
        
        $this->nombre_usuario = new clsField("nombre_usuario", ccsText, "");
        
        $this->usuario1 = new clsField("usuario1", ccsText, "");
        
        $this->nivel = new clsField("nivel", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @7-766A80CC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id_usuario" => array("id_usuario", ""), 
            "Sorter_nombre_usuario" => array("nombre_usuario", ""), 
            "Sorter_usuario" => array("usuario", ""), 
            "Sorter_nivel" => array("nivel", "")));
    }
//End SetOrder Method

//Prepare Method @7-C7F6CC40
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nombre_usuario", ccsText, "", "", $this->Parameters["urls_nombre_usuario"], "", false);
        $this->wp->AddParameter("2", "urls_usuario", ccsText, "", "", $this->Parameters["urls_usuario"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nombre_usuario", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "usuario", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @7-6A71C499
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM usuario";
        $this->SQL = "SELECT id_usuario, nombre_usuario, usuario, nivel \n\n" .
        "FROM usuario {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @7-CB4CE349
    function SetValues()
    {
        $this->id_usuario->SetDBValue(trim($this->f("id_usuario")));
        $this->nombre_usuario->SetDBValue($this->f("nombre_usuario"));
        $this->usuario1->SetDBValue($this->f("usuario"));
        $this->nivel->SetDBValue(trim($this->f("nivel")));
    }
//End SetValues Method

} //End usuarioDataSource Class @7-FCB6E20C

class clsRecordusuarioSearch { //usuarioSearch Class @2-F6F58B7C

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

//Class_Initialize Event @2-5A2B5542
    function clsRecordusuarioSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record usuarioSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "usuarioSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_nombre_usuario = new clsControl(ccsTextBox, "s_nombre_usuario", "Nombre Usuario", ccsText, "", CCGetRequestParam("s_nombre_usuario", $Method, NULL), $this);
            $this->s_usuario = new clsControl(ccsTextBox, "s_usuario", "Usuario", ccsText, "", CCGetRequestParam("s_usuario", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-FC7A4C0D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_nombre_usuario->Validate() && $Validation);
        $Validation = ($this->s_usuario->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_nombre_usuario->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_usuario->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-0CC2F2C1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_nombre_usuario->Errors->Count());
        $errors = ($errors || $this->s_usuario->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-95FF4DC0
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
        $Redirect = "usuario_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "usuario_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-5C58CF6F
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
            $Error = ComposeStrings($Error, $this->s_nombre_usuario->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_usuario->Errors->ToString());
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
        $this->s_nombre_usuario->Show();
        $this->s_usuario->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End usuarioSearch Class @2-FCB6E20C

//Include Page implementation @33-07AA2166
include_once(RelativePath . "/MenuIncludablePage.php");
//End Include Page implementation

//Initialize Page @1-81D2D191
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
$TemplateFileName = "usuario_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-1DBF3C7A
include_once("./usuario_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-694F9673
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
$usuario = new clsGridusuario("", $MainPage);
$usuarioSearch = new clsRecordusuarioSearch("", $MainPage);
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
$MainPage->usuario = & $usuario;
$MainPage->usuarioSearch = & $usuarioSearch;
$MainPage->Menu = & $Menu;
$MainPage->MenuIncludablePage = & $MenuIncludablePage;
$MainPage->Sidebar1 = & $Sidebar1;
$MainPage->HeaderSidebar = & $HeaderSidebar;
$Content->AddComponent("usuario", $usuario);
$Content->AddComponent("usuarioSearch", $usuarioSearch);
$Menu->AddComponent("MenuIncludablePage", $MenuIncludablePage);
$usuario->Initialize();
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

//Initialize HTML Template @1-380C9A2B
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
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-B4BF633B
$MasterPage->Operations();
$MenuIncludablePage->Operations();
$usuarioSearch->Operation();
//End Execute Components

//Go to destination page @1-060C11D5
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($usuario);
    unset($usuarioSearch);
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

//Unload Page @1-88B80A5D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($MasterPage);
unset($usuario);
unset($usuarioSearch);
$MenuIncludablePage->Class_Terminate();
unset($MenuIncludablePage);
unset($Tpl);
//End Unload Page


?>


//Include Common Files @1-D2C172CA
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "usuario_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Master Page implementation @1-ECD4BC60
include_once(RelativePath . "/Designs/Apricot/MasterPage.php");
//End Master Page implementation

class clsGridusuario { //usuario class @7-94B6FB8E

//Variables @7-420711F7

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
    public $Sorter_id_usuario;
    public $Sorter_nombre_usuario;
    public $Sorter_usuario;
    public $Sorter_nivel;
//End Variables

//Class_Initialize Event @7-7E182732
    function clsGridusuario($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "usuario";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid usuario";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsusuarioDataSource($this);
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
        $this->SorterName = CCGetParam("usuarioOrder", "");
        $this->SorterDirection = CCGetParam("usuarioDir", "");

        $this->id_usuario = new clsControl(ccsLink, "id_usuario", "id_usuario", ccsInteger, "", CCGetRequestParam("id_usuario", ccsGet, NULL), $this);
        $this->id_usuario->Page = "usuario_maint.php";
        $this->nombre_usuario = new clsControl(ccsLabel, "nombre_usuario", "nombre_usuario", ccsText, "", CCGetRequestParam("nombre_usuario", ccsGet, NULL), $this);
        $this->usuario1 = new clsControl(ccsLabel, "usuario1", "usuario1", ccsText, "", CCGetRequestParam("usuario1", ccsGet, NULL), $this);
        $this->nivel = new clsControl(ccsLabel, "nivel", "nivel", ccsInteger, "", CCGetRequestParam("nivel", ccsGet, NULL), $this);
        $this->usuario_Insert = new clsControl(ccsLink, "usuario_Insert", "usuario_Insert", ccsText, "", CCGetRequestParam("usuario_Insert", ccsGet, NULL), $this);
        $this->usuario_Insert->Parameters = CCGetQueryString("QueryString", array("id_usuario", "ccsForm"));
        $this->usuario_Insert->Page = "usuario_maint.php";
        $this->Sorter_id_usuario = new clsSorter($this->ComponentName, "Sorter_id_usuario", $FileName, $this);
        $this->Sorter_nombre_usuario = new clsSorter($this->ComponentName, "Sorter_nombre_usuario", $FileName, $this);
        $this->Sorter_usuario = new clsSorter($this->ComponentName, "Sorter_usuario", $FileName, $this);
        $this->Sorter_nivel = new clsSorter($this->ComponentName, "Sorter_nivel", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @7-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @7-6F7F2030
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nombre_usuario"] = CCGetFromGet("s_nombre_usuario", NULL);
        $this->DataSource->Parameters["urls_usuario"] = CCGetFromGet("s_usuario", NULL);

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
            $this->ControlsVisible["id_usuario"] = $this->id_usuario->Visible;
            $this->ControlsVisible["nombre_usuario"] = $this->nombre_usuario->Visible;
            $this->ControlsVisible["usuario1"] = $this->usuario1->Visible;
            $this->ControlsVisible["nivel"] = $this->nivel->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id_usuario->SetValue($this->DataSource->id_usuario->GetValue());
                $this->id_usuario->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->id_usuario->Parameters = CCAddParam($this->id_usuario->Parameters, "id_usuario", $this->DataSource->f("id_usuario"));
                $this->nombre_usuario->SetValue($this->DataSource->nombre_usuario->GetValue());
                $this->usuario1->SetValue($this->DataSource->usuario1->GetValue());
                $this->nivel->SetValue($this->DataSource->nivel->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id_usuario->Show();
                $this->nombre_usuario->Show();
                $this->usuario1->Show();
                $this->nivel->Show();
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
        $this->usuario_Insert->Show();
        $this->Sorter_id_usuario->Show();
        $this->Sorter_nombre_usuario->Show();
        $this->Sorter_usuario->Show();
        $this->Sorter_nivel->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @7-DD0DD11E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->usuario1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nivel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End usuario Class @7-FCB6E20C

class clsusuarioDataSource extends clsDBcon_xls {  //usuarioDataSource Class @7-A0B5C18B

//DataSource Variables @7-4AF335CF
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $id_usuario;
    public $nombre_usuario;
    public $usuario1;
    public $nivel;
//End DataSource Variables

//DataSourceClass_Initialize Event @7-D2EBCFBD
    function clsusuarioDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid usuario";
        $this->Initialize();
        $this->id_usuario = new clsField("id_usuario", ccsInteger, "");
        
        $this->nombre_usuario = new clsField("nombre_usuario", ccsText, "");
        
        $this->usuario1 = new clsField("usuario1", ccsText, "");
        
        $this->nivel = new clsField("nivel", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @7-766A80CC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id_usuario" => array("id_usuario", ""), 
            "Sorter_nombre_usuario" => array("nombre_usuario", ""), 
            "Sorter_usuario" => array("usuario", ""), 
            "Sorter_nivel" => array("nivel", "")));
    }
//End SetOrder Method

//Prepare Method @7-C7F6CC40
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nombre_usuario", ccsText, "", "", $this->Parameters["urls_nombre_usuario"], "", false);
        $this->wp->AddParameter("2", "urls_usuario", ccsText, "", "", $this->Parameters["urls_usuario"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nombre_usuario", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "usuario", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @7-7B4D46CF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM usuario";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} id_usuario, nombre_usuario, usuario, nivel \n\n" .
        "FROM usuario {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @7-CB4CE349
    function SetValues()
    {
        $this->id_usuario->SetDBValue(trim($this->f("id_usuario")));
        $this->nombre_usuario->SetDBValue($this->f("nombre_usuario"));
        $this->usuario1->SetDBValue($this->f("usuario"));
        $this->nivel->SetDBValue(trim($this->f("nivel")));
    }
//End SetValues Method

} //End usuarioDataSource Class @7-FCB6E20C

class clsRecordusuarioSearch { //usuarioSearch Class @2-F6F58B7C

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

//Class_Initialize Event @2-5A2B5542
    function clsRecordusuarioSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record usuarioSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "usuarioSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_nombre_usuario = new clsControl(ccsTextBox, "s_nombre_usuario", "Nombre Usuario", ccsText, "", CCGetRequestParam("s_nombre_usuario", $Method, NULL), $this);
            $this->s_usuario = new clsControl(ccsTextBox, "s_usuario", "Usuario", ccsText, "", CCGetRequestParam("s_usuario", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-FC7A4C0D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_nombre_usuario->Validate() && $Validation);
        $Validation = ($this->s_usuario->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_nombre_usuario->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_usuario->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-0CC2F2C1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_nombre_usuario->Errors->Count());
        $errors = ($errors || $this->s_usuario->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-95FF4DC0
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
        $Redirect = "usuario_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "usuario_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-946E3681
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
            $Error = ComposeStrings($Error, $this->s_nombre_usuario->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_usuario->Errors->ToString());
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
        $this->s_nombre_usuario->Show();
        $this->s_usuario->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End usuarioSearch Class @2-FCB6E20C

//Include Page implementation @33-07AA2166
include_once(RelativePath . "/MenuIncludablePage.php");
//End Include Page implementation

//Initialize Page @1-3C05456E
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
$TemplateFileName = "usuario_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-1DBF3C7A
include_once("./usuario_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A0741E98
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
$usuario = new clsGridusuario("", $MainPage);
$usuarioSearch = new clsRecordusuarioSearch("", $MainPage);
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
$MainPage->usuario = & $usuario;
$MainPage->usuarioSearch = & $usuarioSearch;
$MainPage->Menu = & $Menu;
$MainPage->MenuIncludablePage = & $MenuIncludablePage;
$MainPage->Sidebar1 = & $Sidebar1;
$MainPage->HeaderSidebar = & $HeaderSidebar;
$Content->AddComponent("usuario", $usuario);
$Content->AddComponent("usuarioSearch", $usuarioSearch);
$Menu->AddComponent("MenuIncludablePage", $MenuIncludablePage);
$usuario->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-380C9A2B
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
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-B4BF633B
$MasterPage->Operations();
$MenuIncludablePage->Operations();
$usuarioSearch->Operation();
//End Execute Components

//Go to destination page @1-060C11D5
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($usuario);
    unset($usuarioSearch);
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

//Unload Page @1-88B80A5D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($MasterPage);
unset($usuario);
unset($usuarioSearch);
$MenuIncludablePage->Class_Terminate();
unset($MenuIncludablePage);
unset($Tpl);
//End Unload Page