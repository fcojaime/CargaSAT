<?php

class clsHeader { //Header class @1-CC982CB1

//Variables @1-EEEBE252
    public $ComponentType = "IncludablePage";
    public $Connections = array();
    public $FileName = "";
    public $Redirect = "";
    public $Tpl = "";
    public $TemplateFileName = "";
    public $BlockToParse = "";
    public $ComponentName = "";
    public $Attributes = "";

    // Events;
    public $CCSEvents = "";
    public $CCSEventResult = "";
    public $RelativePath;
    public $Visible;
    public $Parent;
    public $TemplateSource;
//End Variables

//Class_Initialize Event @1-5C4FA0A2
    function clsHeader($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Header.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Header.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-32FD4740
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
    }
//End Class_Terminate Event

//BindEvents Method @1-979A3959
    function BindEvents()
    {
        $this->pnlMenu->CCSEvents["BeforeShow"] = "Header_pnlMenu_BeforeShow";
        $this->CCSEvents["BeforeShow"] = "Header_BeforeShow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-7E2A14CF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
    }
//End Operations Method

//Initialize Method @1-A1670252
    function Initialize($Path = "")
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        global $Scripts;
        $IncScripts = "|";
        $SList = explode("|", $IncScripts);
        foreach ($SList as $Script) {
            if ($Script != "" && strpos($Scripts, "|" . $Script . "|") === false)  $Scripts = $Scripts . $Script . "|";
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Page = "";
        $this->hdLogoPath = new clsControl(ccsHidden, "hdLogoPath", "hdLogoPath", ccsText, "", CCGetRequestParam("hdLogoPath", ccsGet, NULL), $this);
        $this->pnlMenu = new clsPanel("pnlMenu", $this);
        $this->Panel1 = new clsPanel("Panel1", $this);
        $this->lSesion = new clsControl(ccsLabel, "lSesion", "lSesion", ccsText, "", CCGetRequestParam("lSesion", ccsGet, NULL), $this);
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link1->Page = $this->RelativePath . "Logout.php";
        $this->Panel2 = new clsPanel("Panel2", $this);
        $this->BackTablero1 = new clsControl(ccsLink, "BackTablero1", "BackTablero1", ccsText, "", CCGetRequestParam("BackTablero1", ccsGet, NULL), $this);
        $this->BackTablero1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->BackTablero1->Page = "/mymsdma4/TableroSLAs.php";
        $this->Panel3 = new clsPanel("Panel3", $this);
        $this->Panel4 = new clsPanel("Panel4", $this);
        $this->Panel1->AddComponent("lSesion", $this->lSesion);
        $this->Panel1->AddComponent("Link1", $this->Link1);
        $this->Panel2->AddComponent("BackTablero1", $this->BackTablero1);
        $this->Panel3->Visible = false;
        $this->Panel4->Visible = false;
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-C4D4D2AC
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        if ($this->TemplateSource) {
            $Tpl->LoadTemplateFromStr($this->TemplateSource, $this->ComponentName, $this->TemplateEncoding);
        } else {
            $Tpl->LoadTemplate("/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        }
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->ImageLink1->Show();
        $this->hdLogoPath->Show();
        $this->pnlMenu->Show();
        $this->Panel1->Show();
        $this->Panel2->Show();
        $this->Panel3->Show();
        $this->Panel4->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
        $TplData = $Tpl->GetVar($this->ComponentName);
        $Tpl->SetVar($this->ComponentName, $TplData);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
    }
//End Show Method

} //End Header Class @1-FCB6E20C

//Include Event File @1-6613ADCA
include_once(RelativePath . "/Header_events.php");
//End Include Event File
?>
