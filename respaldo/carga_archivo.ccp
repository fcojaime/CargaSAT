<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\respaldo" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" useDesign="True" oldWizardTheme="None" masterPage="{CCS_PathToMasterPage}/MasterPage.ccp" needGeneration="0">
	<Components>
		<Panel id="9" visible="True" generateDiv="False" name="Head" contentPlaceholder="Head">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="10" visible="True" generateDiv="False" name="Content" contentPlaceholder="Content">
			<Components>
				<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="NewRecord1" actionPage="carga_archivo" errorSummator="Error" wizardFormMethod="post" PathID="ContentNewRecord1">
					<Components>
						<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="ContentNewRecord1Button_Insert">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="5" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="ContentNewRecord1Button_Update">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="6" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="ContentNewRecord1Button_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<ListBox id="3" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" returnValueType="Number" name="ListBox1" PathID="ContentNewRecord1ListBox1" connection="con_xls" dataSource="SELECT id_layout, nombre_layout+' ('+tipo_arch+')' as nom_layout, tipo_arch
FROM layouts  " boundColumn="id_layout" textColumn="nom_layout">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<PKFields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" PathID="ContentNewRecord1Button_Cancel" operation="Cancel">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<FileUpload id="14" fieldSourceType="CodeExpression" allowedFileMasks="xls" fileSizeLimit="100000" dataType="Text" tempFileFolder=".\temp_xls" name="archivo_excel" PathID="ContentNewRecord1archivo_excel" required="True">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</FileUpload>
					</Components>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="8"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<PKFields/>
					<ISPParameters/>
					<ISQLParameters/>
					<IFormElements/>
					<USPParameters/>
					<USQLParameters/>
					<UConditions/>
					<UFormElements/>
					<DSPParameters/>
					<DSQLParameters/>
					<DConditions/>
					<SecurityGroups/>
					<Attributes/>
					<Features/>
				</Record>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="11" visible="True" generateDiv="False" name="Menu" contentPlaceholder="Menu">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="12" visible="True" generateDiv="False" name="Sidebar1" contentPlaceholder="Sidebar1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="13" visible="True" generateDiv="False" name="HeaderSidebar" contentPlaceholder="HeaderSidebar">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="carga_archivo.php" forShow="True" url="carga_archivo.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="carga_archivo_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
