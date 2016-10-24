<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\respaldo" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" masterPage="{CCS_PathToMasterPage}/MasterPage.ccp" useDesign="True" wizardTheme="None" needGeneration="0">
	<Components>
		<Panel id="14" visible="True" generateDiv="False" name="Head" contentPlaceholder="Head">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="15" visible="True" generateDiv="False" name="Content" contentPlaceholder="Content">
			<Components>
				<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="con_xls" name="layouts" dataSource="layouts" errorSummator="Error" buttonsType="button" wizardRecordKey="id_layout" wizardCaption="Agregar/Editar Layouts " wizardFormMethod="post" wizardThemeApplyTo="Page" returnPage="layouts_list.ccp" PathID="Contentlayouts">
					<Components>
						<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" parentName="layouts" PathID="ContentlayoutsButton_Insert">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" parentName="layouts" PathID="ContentlayoutsButton_Update">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" parentName="layouts" PathID="ContentlayoutsButton_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre_layout" fieldSource="nombre_layout" required="True" wizardIsPassword="False" parentName="layouts" wizardCaption="Nombre Layout" caption="Nombre Layout" unique="False" wizardSize="50" wizardMaxLength="80" PathID="Contentlayoutsnombre_layout">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="num_hojas" fieldSource="num_hojas" required="True" wizardIsPassword="False" parentName="layouts" wizardCaption="Num Hojas" caption="Num Hojas" unique="False" wizardSize="5" wizardMaxLength="5" PathID="Contentlayoutsnum_hojas">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="posicionable" fieldSource="posicionable" required="True" wizardIsPassword="False" parentName="layouts" wizardCaption="Posicionable" caption="Posicionable" unique="False" wizardSize="2" wizardMaxLength="2" PathID="Contentlayoutsposicionable">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre_tabla_destino" fieldSource="nombre_tabla_destino" required="True" wizardIsPassword="False" parentName="layouts" wizardCaption="Nombre Tabla Destino" caption="Nombre Tabla Destino" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentlayoutsnombre_tabla_destino">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tipo_arch" fieldSource="tipo_arch" required="False" wizardIsPassword="False" parentName="layouts" wizardCaption="Tipo Arch" caption="Tipo Arch" unique="False" wizardSize="5" wizardMaxLength="5" PathID="Contentlayoutstipo_arch">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="num_cols_descartar" fieldSource="num_cols_descartar" required="False" wizardIsPassword="False" parentName="layouts" wizardCaption="Num Cols Descartar" caption="Num Cols Descartar" unique="False" wizardSize="5" wizardMaxLength="5" PathID="Contentlayoutsnum_cols_descartar">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
					</Components>
					<Events/>
					<TableParameters>
						<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="id_layout" parameterSource="id_layout" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<Panel id="16" visible="True" generateDiv="False" name="Menu" contentPlaceholder="Menu">
			<Components>
				<IncludePage id="19" name="MenuIncludablePage" PathID="MenuMenuIncludablePage" parentType="Page" page="MenuIncludablePage.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="17" visible="True" generateDiv="False" name="Sidebar1" contentPlaceholder="Sidebar1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="18" visible="True" generateDiv="False" name="HeaderSidebar" contentPlaceholder="HeaderSidebar">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="layouts_maint.php" forShow="True" url="layouts_maint.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="13" groupID="2"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
