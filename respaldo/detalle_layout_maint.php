<?php
//Include Common Files @1-DDF76C0E
define("RelativePath", "..");
define("PathToCurrentPage", "/respaldo/");
define("FileName", "detalle_layout_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Master Page implementation @1-ECD4BC60
include_once(RelativePath . "/Designs/Apricot/MasterPage.php");
//End Master Page implementation

class clsRecorddetalle_layout { //detalle_layout Class @2-113F3993

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

//Class_Initialize Event @2-FEFF8969
    function clsRecorddetalle_layout($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record detalle_layout/Error";
        $this->DataSource = new clsdetalle_layoutDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "detalle_layout";
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
            $this->id_layout = new clsControl(ccsListBox, "id_layout", "Id Layout", ccsInteger, "", CCGetRequestParam("id_layout", $Method, NULL), $this);
            $this->id_layout->DSType = dsTable;
            $this->id_layout->DataSource = new clsDBcon_xls();
            $this->id_layout->ds = & $this->id_layout->DataSource;
            $this->id_layout->DataSource->SQL = "SELECT * \n" .
"FROM layouts {SQL_Where} {SQL_OrderBy}";
            list($this->id_layout->BoundColumn, $this->id_layout->TextColumn, $this->id_layout->DBFormat) = array("id_layout", "nombre_layout", "");
            $this->id_layout->Required = true;
            $this->nombre_columna = new clsControl(ccsTextBox, "nombre_columna", "Nombre Columna", ccsText, "", CCGetRequestParam("nombre_columna", $Method, NULL), $this);
            $this->nombre_columna->Required = true;
            $this->posicion = new clsControl(ccsTextBox, "posicion", "Posicion", ccsInteger, "", CCGetRequestParam("posicion", $Method, NULL), $this);
            $this->posicion->Required = true;
            $this->tipo_col = new clsControl(ccsTextBox, "tipo_col", "Tipo Col", ccsText, "", CCGetRequestParam("tipo_col", $Method, NULL), $this);
            $this->tipo_col->Required = true;
            $this->condicion1 = new clsControl(ccsTextBox, "condicion1", "Condicion1", ccsText, "", CCGetRequestParam("condicion1", $Method, NULL), $this);
            $this->condicion2 = new clsControl(ccsTextBox, "condicion2", "Condicion2", ccsText, "", CCGetRequestParam("condicion2", $Method, NULL), $this);
            $this->acepta_nulos = new clsControl(ccsTextBox, "acepta_nulos", "Acepta Nulos", ccsText, "", CCGetRequestParam("acepta_nulos", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-55AFCE52
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid_detalle"] = CCGetFromGet("id_detalle", NULL);
    }
//End Initialize Method

//Validate Method @2-FA1163A3
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->id_layout->Validate() && $Validation);
        $Validation = ($this->nombre_columna->Validate() && $Validation);
        $Validation = ($this->posicion->Validate() && $Validation);
        $Validation = ($this->tipo_col->Validate() && $Validation);
        $Validation = ($this->condicion1->Validate() && $Validation);
        $Validation = ($this->condicion2->Validate() && $Validation);
        $Validation = ($this->acepta_nulos->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->id_layout->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nombre_columna->Errors->Count() == 0);
        $Validation =  $Validation && ($this->posicion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tipo_col->Errors->Count() == 0);
        $Validation =  $Validation && ($this->condicion1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->condicion2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->acepta_nulos->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-8B5315F9
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->id_layout->Errors->Count());
        $errors = ($errors || $this->nombre_columna->Errors->Count());
        $errors = ($errors || $this->posicion->Errors->Count());
        $errors = ($errors || $this->tipo_col->Errors->Count());
        $errors = ($errors || $this->condicion1->Errors->Count());
        $errors = ($errors || $this->condicion2->Errors->Count());
        $errors = ($errors || $this->acepta_nulos->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-EC70FD1E
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
        $Redirect = "detalle_layout_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-01935252
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->id_layout->SetValue($this->id_layout->GetValue(true));
        $this->DataSource->nombre_columna->SetValue($this->nombre_columna->GetValue(true));
        $this->DataSource->posicion->SetValue($this->posicion->GetValue(true));
        $this->DataSource->tipo_col->SetValue($this->tipo_col->GetValue(true));
        $this->DataSource->condicion1->SetValue($this->condicion1->GetValue(true));
        $this->DataSource->condicion2->SetValue($this->condicion2->GetValue(true));
        $this->DataSource->acepta_nulos->SetValue($this->acepta_nulos->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-F723EB6A
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->id_layout->SetValue($this->id_layout->GetValue(true));
        $this->DataSource->nombre_columna->SetValue($this->nombre_columna->GetValue(true));
        $this->DataSource->posicion->SetValue($this->posicion->GetValue(true));
        $this->DataSource->tipo_col->SetValue($this->tipo_col->GetValue(true));
        $this->DataSource->condicion1->SetValue($this->condicion1->GetValue(true));
        $this->DataSource->condicion2->SetValue($this->condicion2->GetValue(true));
        $this->DataSource->acepta_nulos->SetValue($this->acepta_nulos->GetValue(true));
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

//Show Method @2-E3E05327
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

        $this->id_layout->Prepare();

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
                    $this->id_layout->SetValue($this->DataSource->id_layout->GetValue());
                    $this->nombre_columna->SetValue($this->DataSource->nombre_columna->GetValue());
                    $this->posicion->SetValue($this->DataSource->posicion->GetValue());
                    $this->tipo_col->SetValue($this->DataSource->tipo_col->GetValue());
                    $this->condicion1->SetValue($this->DataSource->condicion1->GetValue());
                    $this->condicion2->SetValue($this->DataSource->condicion2->GetValue());
                    $this->acepta_nulos->SetValue($this->DataSource->acepta_nulos->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->id_layout->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nombre_columna->Errors->ToString());
            $Error = ComposeStrings($Error, $this->posicion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tipo_col->Errors->ToString());
            $Error = ComposeStrings($Error, $this->condicion1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->condicion2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->acepta_nulos->Errors->ToString());
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
        $this->id_layout->Show();
        $this->nombre_columna->Show();
        $this->posicion->Show();
        $this->tipo_col->Show();
        $this->condicion1->Show();
        $this->condicion2->Show();
        $this->acepta_nulos->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End detalle_layout Class @2-FCB6E20C

class clsdetalle_layoutDataSource extends clsDBcon_xls {  //detalle_layoutDataSource Class @2-F661F00B

//DataSource Variables @2-362BB70A
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
    public $id_layout;
    public $nombre_columna;
    public $posicion;
    public $tipo_col;
    public $condicion1;
    public $condicion2;
    public $acepta_nulos;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-139F7CDD
    function clsdetalle_layoutDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record detalle_layout/Error";
        $this->Initialize();
        $this->id_layout = new clsField("id_layout", ccsInteger, "");
        
        $this->nombre_columna = new clsField("nombre_columna", ccsText, "");
        
        $this->posicion = new clsField("posicion", ccsInteger, "");
        
        $this->tipo_col = new clsField("tipo_col", ccsText, "");
        
        $this->condicion1 = new clsField("condicion1", ccsText, "");
        
        $this->condicion2 = new clsField("condicion2", ccsText, "");
        
        $this->acepta_nulos = new clsField("acepta_nulos", ccsText, "");
        

        $this->InsertFields["id_layout"] = array("Name" => "id_layout", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nombre_columna"] = array("Name" => "nombre_columna", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["posicion"] = array("Name" => "posicion", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["tipo_col"] = array("Name" => "tipo_col", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["condicion1"] = array("Name" => "condicion1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["condicion2"] = array("Name" => "condicion2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["acepta_nulos"] = array("Name" => "acepta_nulos", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["id_layout"] = array("Name" => "id_layout", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nombre_columna"] = array("Name" => "nombre_columna", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["posicion"] = array("Name" => "posicion", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipo_col"] = array("Name" => "tipo_col", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["condicion1"] = array("Name" => "condicion1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["condicion2"] = array("Name" => "condicion2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["acepta_nulos"] = array("Name" => "acepta_nulos", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-7F685D8C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid_detalle", ccsInteger, "", "", $this->Parameters["urlid_detalle"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id_detalle", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-2534263A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM detalle_layout {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E91A284A
    function SetValues()
    {
        $this->id_layout->SetDBValue(trim($this->f("id_layout")));
        $this->nombre_columna->SetDBValue($this->f("nombre_columna"));
        $this->posicion->SetDBValue(trim($this->f("posicion")));
        $this->tipo_col->SetDBValue($this->f("tipo_col"));
        $this->condicion1->SetDBValue($this->f("condicion1"));
        $this->condicion2->SetDBValue($this->f("condicion2"));
        $this->acepta_nulos->SetDBValue($this->f("acepta_nulos"));
    }
//End SetValues Method

//Insert Method @2-0BEDCCBF
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["id_layout"]["Value"] = $this->id_layout->GetDBValue(true);
        $this->InsertFields["nombre_columna"]["Value"] = $this->nombre_columna->GetDBValue(true);
        $this->InsertFields["posicion"]["Value"] = $this->posicion->GetDBValue(true);
        $this->InsertFields["tipo_col"]["Value"] = $this->tipo_col->GetDBValue(true);
        $this->InsertFields["condicion1"]["Value"] = $this->condicion1->GetDBValue(true);
        $this->InsertFields["condicion2"]["Value"] = $this->condicion2->GetDBValue(true);
        $this->InsertFields["acepta_nulos"]["Value"] = $this->acepta_nulos->GetDBValue(true);
        $this->SQL = CCBuildInsert("detalle_layout", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-659570ED
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["id_layout"]["Value"] = $this->id_layout->GetDBValue(true);
        $this->UpdateFields["nombre_columna"]["Value"] = $this->nombre_columna->GetDBValue(true);
        $this->UpdateFields["posicion"]["Value"] = $this->posicion->GetDBValue(true);
        $this->UpdateFields["tipo_col"]["Value"] = $this->tipo_col->GetDBValue(true);
        $this->UpdateFields["condicion1"]["Value"] = $this->condicion1->GetDBValue(true);
        $this->UpdateFields["condicion2"]["Value"] = $this->condicion2->GetDBValue(true);
        $this->UpdateFields["acepta_nulos"]["Value"] = $this->acepta_nulos->GetDBValue(true);
        $this->SQL = CCBuildUpdate("detalle_layout", $this->UpdateFields, $this);
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

//Delete Method @2-66A9426D
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM detalle_layout";
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

} //End detalle_layoutDataSource Class @2-FCB6E20C

//Include Page implementation @20-A738AFAB
include_once(RelativePath . "/respaldo/MenuIncludablePage.php");
//End Include Page implementation

//Initialize Page @1-D0CCF28A
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
$TemplateFileName = "detalle_layout_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$PathToRootOpt = "../";
$Scripts = "|";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-ED7CB2E0
CCSecurityRedirect("2", "");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A98CE5D8
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
$detalle_layout = new clsRecorddetalle_layout("", $MainPage);
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
$MainPage->Menu = & $Menu;
$MainPage->MenuIncludablePage = & $MenuIncludablePage;
$MainPage->Sidebar1 = & $Sidebar1;
$MainPage->HeaderSidebar = & $HeaderSidebar;
$Content->AddComponent("detalle_layout", $detalle_layout);
$Menu->AddComponent("MenuIncludablePage", $MenuIncludablePage);
$detalle_layout->Initialize();
$ScriptIncludes = "";
$SList = explode("|", $Scripts);
foreach ($SList as $Script) {
    if ($Script != "") $ScriptIncludes = $ScriptIncludes . "<script src=\"" . $PathToRoot . $Script . "\" type=\"text/javascript\"></script>\n";
}
$Attributes->SetValue("scriptIncludes", $ScriptIncludes);

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

//Execute Components @1-E6456128
$MasterPage->Operations();
$MenuIncludablePage->Operations();
$detalle_layout->Operation();
//End Execute Components

//Go to destination page @1-A1B65ACC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($detalle_layout);
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

//Unload Page @1-B3819A92
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($MasterPage);
unset($detalle_layout);
$MenuIncludablePage->Class_Terminate();
unset($MenuIncludablePage);
unset($Tpl);
//End Unload Page


?>


//Include Common Files @1-DDF76C0E
define("RelativePath", "..");
define("PathToCurrentPage", "/respaldo/");
define("FileName", "detalle_layout_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Master Page implementation @1-ECD4BC60
include_once(RelativePath . "/Designs/Apricot/MasterPage.php");
//End Master Page implementation

class clsRecorddetalle_layout { //detalle_layout Class @2-113F3993

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

//Class_Initialize Event @2-FEFF8969
    function clsRecorddetalle_layout($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record detalle_layout/Error";
        $this->DataSource = new clsdetalle_layoutDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "detalle_layout";
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
            $this->id_layout = new clsControl(ccsListBox, "id_layout", "Id Layout", ccsInteger, "", CCGetRequestParam("id_layout", $Method, NULL), $this);
            $this->id_layout->DSType = dsTable;
            $this->id_layout->DataSource = new clsDBcon_xls();
            $this->id_layout->ds = & $this->id_layout->DataSource;
            $this->id_layout->DataSource->SQL = "SELECT * \n" .
"FROM layouts {SQL_Where} {SQL_OrderBy}";
            list($this->id_layout->BoundColumn, $this->id_layout->TextColumn, $this->id_layout->DBFormat) = array("id_layout", "nombre_layout", "");
            $this->id_layout->Required = true;
            $this->nombre_columna = new clsControl(ccsTextBox, "nombre_columna", "Nombre Columna", ccsText, "", CCGetRequestParam("nombre_columna", $Method, NULL), $this);
            $this->nombre_columna->Required = true;
            $this->posicion = new clsControl(ccsTextBox, "posicion", "Posicion", ccsInteger, "", CCGetRequestParam("posicion", $Method, NULL), $this);
            $this->posicion->Required = true;
            $this->tipo_col = new clsControl(ccsTextBox, "tipo_col", "Tipo Col", ccsText, "", CCGetRequestParam("tipo_col", $Method, NULL), $this);
            $this->tipo_col->Required = true;
            $this->condicion1 = new clsControl(ccsTextBox, "condicion1", "Condicion1", ccsText, "", CCGetRequestParam("condicion1", $Method, NULL), $this);
            $this->condicion2 = new clsControl(ccsTextBox, "condicion2", "Condicion2", ccsText, "", CCGetRequestParam("condicion2", $Method, NULL), $this);
            $this->acepta_nulos = new clsControl(ccsTextBox, "acepta_nulos", "Acepta Nulos", ccsText, "", CCGetRequestParam("acepta_nulos", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-55AFCE52
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid_detalle"] = CCGetFromGet("id_detalle", NULL);
    }
//End Initialize Method

//Validate Method @2-FA1163A3
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->id_layout->Validate() && $Validation);
        $Validation = ($this->nombre_columna->Validate() && $Validation);
        $Validation = ($this->posicion->Validate() && $Validation);
        $Validation = ($this->tipo_col->Validate() && $Validation);
        $Validation = ($this->condicion1->Validate() && $Validation);
        $Validation = ($this->condicion2->Validate() && $Validation);
        $Validation = ($this->acepta_nulos->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->id_layout->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nombre_columna->Errors->Count() == 0);
        $Validation =  $Validation && ($this->posicion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tipo_col->Errors->Count() == 0);
        $Validation =  $Validation && ($this->condicion1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->condicion2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->acepta_nulos->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-8B5315F9
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->id_layout->Errors->Count());
        $errors = ($errors || $this->nombre_columna->Errors->Count());
        $errors = ($errors || $this->posicion->Errors->Count());
        $errors = ($errors || $this->tipo_col->Errors->Count());
        $errors = ($errors || $this->condicion1->Errors->Count());
        $errors = ($errors || $this->condicion2->Errors->Count());
        $errors = ($errors || $this->acepta_nulos->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-EC70FD1E
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
        $Redirect = "detalle_layout_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-01935252
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->id_layout->SetValue($this->id_layout->GetValue(true));
        $this->DataSource->nombre_columna->SetValue($this->nombre_columna->GetValue(true));
        $this->DataSource->posicion->SetValue($this->posicion->GetValue(true));
        $this->DataSource->tipo_col->SetValue($this->tipo_col->GetValue(true));
        $this->DataSource->condicion1->SetValue($this->condicion1->GetValue(true));
        $this->DataSource->condicion2->SetValue($this->condicion2->GetValue(true));
        $this->DataSource->acepta_nulos->SetValue($this->acepta_nulos->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-F723EB6A
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->id_layout->SetValue($this->id_layout->GetValue(true));
        $this->DataSource->nombre_columna->SetValue($this->nombre_columna->GetValue(true));
        $this->DataSource->posicion->SetValue($this->posicion->GetValue(true));
        $this->DataSource->tipo_col->SetValue($this->tipo_col->GetValue(true));
        $this->DataSource->condicion1->SetValue($this->condicion1->GetValue(true));
        $this->DataSource->condicion2->SetValue($this->condicion2->GetValue(true));
        $this->DataSource->acepta_nulos->SetValue($this->acepta_nulos->GetValue(true));
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

//Show Method @2-C1D6385C
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

        $this->id_layout->Prepare();

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
                    $this->id_layout->SetValue($this->DataSource->id_layout->GetValue());
                    $this->nombre_columna->SetValue($this->DataSource->nombre_columna->GetValue());
                    $this->posicion->SetValue($this->DataSource->posicion->GetValue());
                    $this->tipo_col->SetValue($this->DataSource->tipo_col->GetValue());
                    $this->condicion1->SetValue($this->DataSource->condicion1->GetValue());
                    $this->condicion2->SetValue($this->DataSource->condicion2->GetValue());
                    $this->acepta_nulos->SetValue($this->DataSource->acepta_nulos->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->id_layout->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nombre_columna->Errors->ToString());
            $Error = ComposeStrings($Error, $this->posicion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tipo_col->Errors->ToString());
            $Error = ComposeStrings($Error, $this->condicion1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->condicion2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->acepta_nulos->Errors->ToString());
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
        $this->id_layout->Show();
        $this->nombre_columna->Show();
        $this->posicion->Show();
        $this->tipo_col->Show();
        $this->condicion1->Show();
        $this->condicion2->Show();
        $this->acepta_nulos->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End detalle_layout Class @2-FCB6E20C

class clsdetalle_layoutDataSource extends clsDBcon_xls {  //detalle_layoutDataSource Class @2-F661F00B

//DataSource Variables @2-362BB70A
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
    public $id_layout;
    public $nombre_columna;
    public $posicion;
    public $tipo_col;
    public $condicion1;
    public $condicion2;
    public $acepta_nulos;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-139F7CDD
    function clsdetalle_layoutDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record detalle_layout/Error";
        $this->Initialize();
        $this->id_layout = new clsField("id_layout", ccsInteger, "");
        
        $this->nombre_columna = new clsField("nombre_columna", ccsText, "");
        
        $this->posicion = new clsField("posicion", ccsInteger, "");
        
        $this->tipo_col = new clsField("tipo_col", ccsText, "");
        
        $this->condicion1 = new clsField("condicion1", ccsText, "");
        
        $this->condicion2 = new clsField("condicion2", ccsText, "");
        
        $this->acepta_nulos = new clsField("acepta_nulos", ccsText, "");
        

        $this->InsertFields["id_layout"] = array("Name" => "id_layout", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nombre_columna"] = array("Name" => "nombre_columna", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["posicion"] = array("Name" => "posicion", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["tipo_col"] = array("Name" => "tipo_col", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["condicion1"] = array("Name" => "condicion1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["condicion2"] = array("Name" => "condicion2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["acepta_nulos"] = array("Name" => "acepta_nulos", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["id_layout"] = array("Name" => "id_layout", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nombre_columna"] = array("Name" => "nombre_columna", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["posicion"] = array("Name" => "posicion", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipo_col"] = array("Name" => "tipo_col", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["condicion1"] = array("Name" => "condicion1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["condicion2"] = array("Name" => "condicion2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["acepta_nulos"] = array("Name" => "acepta_nulos", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-7F685D8C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid_detalle", ccsInteger, "", "", $this->Parameters["urlid_detalle"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id_detalle", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-2534263A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM detalle_layout {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E91A284A
    function SetValues()
    {
        $this->id_layout->SetDBValue(trim($this->f("id_layout")));
        $this->nombre_columna->SetDBValue($this->f("nombre_columna"));
        $this->posicion->SetDBValue(trim($this->f("posicion")));
        $this->tipo_col->SetDBValue($this->f("tipo_col"));
        $this->condicion1->SetDBValue($this->f("condicion1"));
        $this->condicion2->SetDBValue($this->f("condicion2"));
        $this->acepta_nulos->SetDBValue($this->f("acepta_nulos"));
    }
//End SetValues Method

//Insert Method @2-0BEDCCBF
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["id_layout"]["Value"] = $this->id_layout->GetDBValue(true);
        $this->InsertFields["nombre_columna"]["Value"] = $this->nombre_columna->GetDBValue(true);
        $this->InsertFields["posicion"]["Value"] = $this->posicion->GetDBValue(true);
        $this->InsertFields["tipo_col"]["Value"] = $this->tipo_col->GetDBValue(true);
        $this->InsertFields["condicion1"]["Value"] = $this->condicion1->GetDBValue(true);
        $this->InsertFields["condicion2"]["Value"] = $this->condicion2->GetDBValue(true);
        $this->InsertFields["acepta_nulos"]["Value"] = $this->acepta_nulos->GetDBValue(true);
        $this->SQL = CCBuildInsert("detalle_layout", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-659570ED
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["id_layout"]["Value"] = $this->id_layout->GetDBValue(true);
        $this->UpdateFields["nombre_columna"]["Value"] = $this->nombre_columna->GetDBValue(true);
        $this->UpdateFields["posicion"]["Value"] = $this->posicion->GetDBValue(true);
        $this->UpdateFields["tipo_col"]["Value"] = $this->tipo_col->GetDBValue(true);
        $this->UpdateFields["condicion1"]["Value"] = $this->condicion1->GetDBValue(true);
        $this->UpdateFields["condicion2"]["Value"] = $this->condicion2->GetDBValue(true);
        $this->UpdateFields["acepta_nulos"]["Value"] = $this->acepta_nulos->GetDBValue(true);
        $this->SQL = CCBuildUpdate("detalle_layout", $this->UpdateFields, $this);
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

//Delete Method @2-66A9426D
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM detalle_layout";
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

} //End detalle_layoutDataSource Class @2-FCB6E20C

//Include Page implementation @20-A738AFAB
include_once(RelativePath . "/respaldo/MenuIncludablePage.php");
//End Include Page implementation

//Initialize Page @1-4905E49C
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
$TemplateFileName = "detalle_layout_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-ED7CB2E0
CCSecurityRedirect("2", "");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-91D9EB08
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
$detalle_layout = new clsRecorddetalle_layout("", $MainPage);
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
$MainPage->Menu = & $Menu;
$MainPage->MenuIncludablePage = & $MenuIncludablePage;
$MainPage->Sidebar1 = & $Sidebar1;
$MainPage->HeaderSidebar = & $HeaderSidebar;
$Content->AddComponent("detalle_layout", $detalle_layout);
$Menu->AddComponent("MenuIncludablePage", $MenuIncludablePage);
$detalle_layout->Initialize();

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

//Execute Components @1-E6456128
$MasterPage->Operations();
$MenuIncludablePage->Operations();
$detalle_layout->Operation();
//End Execute Components

//Go to destination page @1-A1B65ACC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcon_xls->close();
    header("Location: " . $Redirect);
    unset($detalle_layout);
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

//Unload Page @1-B3819A92
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcon_xls->close();
unset($MasterPage);
unset($detalle_layout);
$MenuIncludablePage->Class_Terminate();
unset($MenuIncludablePage);
unset($Tpl);
//End Unload Page