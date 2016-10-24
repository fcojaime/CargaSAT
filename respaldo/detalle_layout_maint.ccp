<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\respaldo" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" masterPage="{CCS_PathToMasterPage}/MasterPage.ccp" useDesign="True" wizardTheme="None" needGeneration="0">
	<Components>
		<Panel id="15" visible="True" generateDiv="False" name="Head" contentPlaceholder="Head">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="16" visible="True" generateDiv="False" name="Content" contentPlaceholder="Content">
			<Components>
				<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="con_xls" name="detalle_layout" dataSource="detalle_layout" errorSummator="Error" buttonsType="button" wizardRecordKey="id_detalle" wizardCaption="Agregar/Editar Detalle Layout " wizardFormMethod="post" wizardThemeApplyTo="Page" returnPage="detalle_layout_list.ccp" PathID="Contentdetalle_layout">
					<Components>
						<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" parentName="detalle_layout" PathID="Contentdetalle_layoutButton_Insert">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" parentName="detalle_layout" PathID="Contentdetalle_layoutButton_Update">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" parentName="detalle_layout" PathID="Contentdetalle_layoutButton_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<ListBox id="7" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="id_layout" fieldSource="id_layout" required="True" wizardIsPassword="False" parentName="detalle_layout" wizardCaption="Id Layout" caption="Id Layout" wizardEmptyCaption="Seleccionar Valor" unique="False" connection="con_xls" dataSource="layouts" boundColumn="id_layout" textColumn="nombre_layout" PathID="Contentdetalle_layoutid_layout">
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
						<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre_columna" fieldSource="nombre_columna" required="True" wizardIsPassword="False" parentName="detalle_layout" wizardCaption="Nombre Columna" caption="Nombre Columna" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentdetalle_layoutnombre_columna">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="posicion" fieldSource="posicion" required="True" wizardIsPassword="False" parentName="detalle_layout" wizardCaption="Posicion" caption="Posicion" unique="False" wizardSize="5" wizardMaxLength="5" PathID="Contentdetalle_layoutposicion">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tipo_col" fieldSource="tipo_col" required="True" wizardIsPassword="False" parentName="detalle_layout" wizardCaption="Tipo Col" caption="Tipo Col" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentdetalle_layouttipo_col">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="condicion1" fieldSource="condicion1" required="False" wizardIsPassword="False" parentName="detalle_layout" wizardCaption="Condicion1" caption="Condicion1" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentdetalle_layoutcondicion1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="condicion2" fieldSource="condicion2" required="False" wizardIsPassword="False" parentName="detalle_layout" wizardCaption="Condicion2" caption="Condicion2" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentdetalle_layoutcondicion2">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="acepta_nulos" fieldSource="acepta_nulos" required="False" wizardIsPassword="False" parentName="detalle_layout" wizardCaption="Acepta Nulos" caption="Acepta Nulos" unique="False" wizardSize="2" wizardMaxLength="2" PathID="Contentdetalle_layoutacepta_nulos">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
					</Components>
					<Events/>
					<TableParameters>
						<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="id_detalle" parameterSource="id_detalle" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
					</TableParameters>
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
		<Panel id="17" visible="True" generateDiv="False" name="Menu" contentPlaceholder="Menu">
			<Components>
				<IncludePage id="20" name="MenuIncludablePage" PathID="MenuMenuIncludablePage" parentType="Page" page="MenuIncludablePage.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="18" visible="True" generateDiv="False" name="Sidebar1" contentPlaceholder="Sidebar1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="19" visible="True" generateDiv="False" name="HeaderSidebar" contentPlaceholder="HeaderSidebar">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="detalle_layout_maint.php" forShow="True" url="detalle_layout_maint.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="14" groupID="2"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
