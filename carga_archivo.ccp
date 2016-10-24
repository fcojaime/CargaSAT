<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" useDesign="False" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="NewRecord1" actionPage="carga_archivo" errorSummator="Error" wizardFormMethod="post" PathID="NewRecord1">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="NewRecord1Button_Insert">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="33"/>
							</Actions>
						</Event>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="34"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="NewRecord1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="6" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="NewRecord1Button_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="3" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" returnValueType="Number" name="ListBox1" PathID="NewRecord1ListBox1" connection="con_xls" dataSource="select id_periodo,  periodo+tipo_periodo as periodo
from periodos_validos
where (id_proveedor=0 or id_proveedor={id_proveedor} )" boundColumn="id_periodo" textColumn="periodo">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters>
						<SQLParameter id="36" dataType="Integer" defaultValue="0" parameterSource="id_proveedor" parameterType="Session" variable="id_proveedor"/>
					</SQLParameters>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<PKFields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" PathID="NewRecord1Button_Cancel" operation="Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<FileUpload id="14" fieldSourceType="CodeExpression" allowedFileMasks="*" fileSizeLimit="10000000" dataType="Text" tempFileFolder=".\temp_xls" name="archivo_excel" PathID="NewRecord1archivo_excel" required="True" caption="archivo de excel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Hidden id="17" fieldSourceType="DBColumn" dataType="Text" name="ruta_archivo" PathID="NewRecord1ruta_archivo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="20" urlType="Relative" enableValidation="True" isDefault="False" name="Aplicar" PathID="NewRecord1Aplicar" operation="Cancel" returnPage="carga_archivo.ccp" removeParameters="ccsForm">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="24"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="Label3" PathID="NewRecord1Label3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="27" fieldSourceType="DBColumn" dataType="Text" name="id_reg_ok" PathID="NewRecord1id_reg_ok">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="29" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="lnom_cds" PathID="NewRecord1lnom_cds">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="Label1" PathID="NewRecord1Label1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="Label2" PathID="NewRecord1Label2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="Label4" PathID="NewRecord1Label4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<RadioButton id="31" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" html="True" returnValueType="Number" name="optsla" PathID="NewRecord1optsla" dataSource="SLA;SLA;SLO;SLO">
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
				</RadioButton>
				<Image id="35" visible="No" fieldSourceType="DBColumn" dataType="Text" name="img_cargando" PathID="NewRecord1img_cargando">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
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
		<IncludePage id="32" name="Header" PathID="Header" page="Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="carga_archivo.php" forShow="True" url="carga_archivo.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="carga_archivo_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="15"/>
			</Actions>
		</Event>
		<Event name="BeforeUnload" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="16"/>
			</Actions>
		</Event>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="21"/>
			</Actions>
		</Event>
		<Event name="BeforeInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="26"/>
			</Actions>
		</Event>
	</Events>
</Page>
