<?php
//Include Common Files @1-3E2092A7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "layouts_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Master Page implementation @1-ECD4BC60
include_once(RelativePath . "/Designs/Apricot/MasterPage.php");
//End Master Page implementation

class clsRecordlayouts { //layouts Class @2-77F6EC5B

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

//Class_Initialize Event @2-80097D48
    function clsRecordlayouts($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record layouts/Error";
        $this->DataSource = new clslayoutsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "layouts";
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
            $this->nombre_layout = new clsControl(ccsTextBox, "nombre_layout", "Nombre Layout", ccsText, "", CCGetRequestParam("nombre_layout", $Method, NULL), $this);
            $this->nombre_layout->Required = true;
            $this->num_hojas = new clsControl(ccsTextBox, "num_hojas", "Num Hojas", ccsInteger, "", CCGetRequestParam("num_hojas", $Method, NULL), $this);
            $this->num_hojas->Required = true;
            $this->posicionable = new clsControl(ccsTextBox, "posicionable", "Posicionable", ccsText, "", CCGetRequestParam("posicionable", $Method, NULL), $this);
            $this->posicionable->Required = true;
            $this->nombre_tabla_destino = new clsControl(ccsTextBox, "nombre_tabla_destino", "Nombre Tabla Destino", ccsText, "", CCGetRequestParam("nombre_tabla_destino", $Method, NULL), $this);
            $this->nombre_tabla_destino->Required = true;
            $this->tipo_arch = new clsControl(ccsTextBox, "tipo_arch", "Tipo Arch", ccsText, "", CCGetRequestParam("tipo_arch", $Method, NULL), $this);
            $this->num_cols_descartar = new clsControl(ccsTextBox, "num_cols_descartar", "Num Cols Descartar", ccsInteger, "", CCGetRequestParam("num_cols_descartar", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-44C1DC4A
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid_layout"] = CCGetFromGet("id_layout", NULL);
    }
//End Initialize Method

//Validate Method @2-1EC954B9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->nombre_layout->Validate() && $Validation);
        $Validation = ($this->num_hojas->Validate() && $Validation);
        $Validation = ($this->posicionable->Validate() && $Validation);
        $Validation = ($this->nombre_tabla_destino->Validate() && $Validation);
        $Validation = ($this->tipo_arch->Validate() && $Validation);
        $Validation = ($this->num_cols_descartar->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->nombre_layout->Errors->Count() == 0);
        $Validation =  $Validation && ($this->num_hojas->Errors->Count() == 0);
        $Validation =  $Validation && ($this->posicionable->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nombre_tabla_destino->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tipo_arch->Errors->Count() == 0);
        $Validation =  $Validation && ($this->num_cols_descartar->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-51CF4F0E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nombre_layout->Errors->Count());
        $errors = ($errors || $this->num_hojas->Errors->Count());
        $errors = ($errors || $this->posicionable->Errors->Count());
        $errors = ($errors || $this->nombre_tabla_destino->Errors->Count());
        $errors = ($errors || $this->tipo_arch->Errors->Count());
        $errors = ($errors || $this->num_cols_descartar->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-4CF7D0F4
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
            }
        }
        $Redirect = "layouts_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
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

//InsertRow Method @2-9D54C7D9
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->nombre_layout->SetValue($this->nombre_layout->GetValue(true));
        $this->DataSource->num_hojas->SetValue($this->num_hojas->GetValue(true));
        $this->DataSource->posicionable->SetValue($this->posicionable->GetValue(true));
        $this->DataSource->nombre_tabla_destino->SetValue($this->nombre_tabla_destino->GetValue(true));
        $this->DataSource->tipo_arch->SetValue($this->tipo_arch->GetValue(true));
        $this->DataSource->num_cols_descartar->SetValue($this->num_cols_descartar->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-909AC870
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->nombre_layout->SetValue($this->nombre_layout->GetValue(true));
        $this->DataSource->num_hojas->SetValue($this->num_hojas->GetValue(true));
        $this->DataSource->posicionable->SetValue($this->posicionable->GetValue(true));
        $this->DataSource->nombre_tabla_destino->SetValue($this->nombre_tabla_destino->GetValue(true));
        $this->DataSource->tipo_arch->SetValue($this->tipo_arch->GetValue(true));
        $this->DataSource->num_cols_descartar->SetValue($this->num_cols_descartar->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-7D23DC63
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
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->nombre_layout->SetValue($this->DataSource->nombre_layout->GetValue());
                    $this->num_hojas->SetValue($this->DataSource->num_hojas->GetValue());
                    $this->posicionable->SetValue($this->DataSource->posicionable->GetValue());
                    $this->nombre_tabla_destino->SetValue($this->DataSource->nombre_tabla_destino->GetValue());
                    $this->tipo_arch->SetValue($this->DataSource->tipo_arch->GetValue());
                    $this->num_cols_descartar->SetValue($this->DataSource->num_cols_descartar->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nombre_layout->Errors->ToString());
            $Error = ComposeStrings($Error, $this->num_hojas->Errors->ToString());
            $Error = ComposeStrings($Error, $this->posicionable->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nombre_tabla_destino->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tipo_arch->Errors->ToString());
            $Error = ComposeStrings($Error, $this->num_cols_descartar->Errors->ToString());
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
        $this->nombre_layout->Show();
        $this->num_hojas->Show();
        $this->posicionable->Show();
        $this->nombre_tabla_destino->Show();
        $this->tipo_arch->Show();
        $this->num_cols_descartar->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End layouts Class @2-FCB6E20C

class clslayoutsDataSource extends clsDBcon_xls {  //layoutsDataSource Class @2-B4A1AEBA

//DataSource Variables @2-4161C2EB
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
    public $nombre_layout;
    public $num_hojas;
    public $posicionable;
    public $nombre_tabla_destino;
    public $tipo_arch;
    public $num_cols_descartar;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4823E70C
    function clslayoutsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record layouts/Error";
        $this->Initialize();
        $this->nombre_layout = new clsField("nombre_layout", ccsText, "");
        
        $this->num_hojas = new clsField("num_hojas", ccsInteger, "");
        
        $this->posicionable = new clsField("posicionable", ccsText, "");
        
        $this->nombre_tabla_destino = new clsField("nombre_tabla_destino", ccsText, "");
        
        $this->tipo_arch = new clsField("tipo_arch", ccsText, "");
        
        $this->num_cols_descartar = new clsField("num_cols_descartar", ccsInteger, "");
        

        $this->InsertFields["nombre_layout"] = array("Name" => "nombre_layout", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["num_hojas"] = array("Name" => "num_hojas", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["posicionable"] = array("Name" => "posicionable", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nombre_tabla_destino"] = array("Name" => "nombre_tabla_destino", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tipo_arch"] = array("Name" => "tipo_arch", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["num_cols_descartar"] = array("Name" => "num_cols_descartar", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nombre_layout"] = array("Name" => "nombre_layout", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["num_hojas"] = array("Name" => "num_hojas", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["posicionable"] = array("Name" => "posicionable", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nombre_tabla_destino"] = array("Name" => "nombre_tabla_destino", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipo_arch"] = array("Name" => "tipo_arch", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["num_cols_descartar"] = array("Name" => "num_cols_descartar", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-0B81ECC9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid_layout", ccsInteger, "", "", $this->Parameters["urlid_layout"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id_layout", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-878900D5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM layouts {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-26C49A96
    function SetValues()
    {
        $this->nombre_layout->SetDBValue($this->f("nombre_layout"));
        $this->num_hojas->SetDBValue(trim($this->f("num_hojas")));
        $this->posicionable->SetDBValue($this->f("posicionable"));
        $this->nombre_tabla_destino->SetDBValue($this->f("nombre_tabla_destino"));
        $this->tipo_arch->SetDBValue($this->f("tipo_arch"));
        $this->num_cols_descartar->SetDBValue(trim($this->f("num_cols_descartar")));
    }
//End SetValues Method

//Insert Method @2-4A1D5AA0
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["nombre_layout"]["Value"] = $this->nombre_layout->GetDBValue(true);
        $this->InsertFields["num_hojas"]["Value"] = $this->num_hojas->GetDBValue(true);
        $this->InsertFields["posicionable"]["Value"] = $this->posicionable->GetDBValue(true);
        $this->InsertFields["nombre_tabla_destino"]["Value"] = $this->nombre_tabla_destino->GetDBValue(true);
        $this->InsertFields["tipo_arch"]["Value"] = $this->tipo_arch->GetDBValue(true);
        $this->InsertFields["num_cols_descartar"]["Value"] = $this->num_cols_descartar->GetDBValue(true);
        $this->SQL = CCBuildInsert("layouts", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-AFA017B1
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["nombre_layout"]["Value"] = $this->nombre_layout->GetDBValue(true);
        $this->UpdateFields["num_hojas"]["Value"] = $this->num_hojas->GetDBValue(true);
        $this->UpdateFields["posicionable"]["Value"] = $this->posicionable->GetDBValue(true);
        $this->UpdateFields["nombre_tabla_destino"]["Value"] = $this->nombre_tabla_destino->GetDBValue(true);
        $this->UpdateFields["tipo_arch"]["Value"] = $this->tipo_arch->GetDBValue(true);
        $this->UpdateFields["num_cols_descartar"]["Value"] = $this->num_cols_descartar->GetDBValue(true);
        $this->SQL = CCBuildUpdate("layouts", $this->UpdateFields, $this);
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

//Delete Method @2-0242565C
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM layouts";
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

} //End layoutsDataSource Class @2-FCB6E20C

//Include Page implementation @19-07AA2166
include_once(RelativePath . "/MenuIncludablePage.php");
//End Include Page implementation

//Initialize Page @1-21C8C175
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
$TemplateFileName = "layouts_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-ED7CB2E0
CCSecurityRedirect("2", "");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-18328504
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
$layouts = new clsRecordlayouts("", $MainPage);
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
$MainPage->Menu = & $Menu;
$MainPage->MenuIncludablePage = & $MenuIncludablePage;
$MainPage->Sidebar1 = & $Sidebar1;
$MainPage->HeaderSidebar = & $HeaderSidebar;
$Content->AddComponent("layouts", $layouts);
$Menu->AddComponent("MenuIncludablePage", $MenuIncludablePage);
$layouts->Initialize();

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

//Execute Components @1-13E74F9A
$MasterPage->Operations();
$MenuIncludablePage->Operations();
$layouts->Operation();
//End Execute Components

//Go to destination page @1-2C50F56E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($layouts);
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

//Unload Page @1-B25D946F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($MasterPage);
unset($layouts);
$MenuIncludablePage->Class_Terminate();
unset($MenuIncludablePage);
unset($Tpl);
//End Unload Page


?>
