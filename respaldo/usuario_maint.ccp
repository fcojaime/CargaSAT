<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\respaldo" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" masterPage="{CCS_PathToMasterPage}/MasterPage.ccp" useDesign="True" wizardTheme="None" needGeneration="0">
	<Components>
		<Panel id="12" visible="True" generateDiv="False" name="Head" contentPlaceholder="Head">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="13" visible="True" generateDiv="False" name="Content" contentPlaceholder="Content">
			<Components>
				<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="con_xls" name="usuario" dataSource="usuario" errorSummator="Error" buttonsType="button" wizardRecordKey="id_usuario" wizardCaption="Agregar/Editar Usuario " wizardFormMethod="post" wizardThemeApplyTo="Page" returnPage="usuario_list.ccp" PathID="Contentusuario">
					<Components>
						<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" parentName="usuario" PathID="ContentusuarioButton_Insert">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" parentName="usuario" PathID="ContentusuarioButton_Update">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" parentName="usuario" PathID="ContentusuarioButton_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre_usuario" fieldSource="nombre_usuario" required="True" wizardIsPassword="False" parentName="usuario" wizardCaption="Nombre Usuario" caption="Nombre Usuario" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentusuarionombre_usuario">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usuario1" fieldSource="usuario" required="True" wizardIsPassword="False" parentName="usuario" wizardCaption="Usuario" caption="Usuario" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentusuariousuario1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="password" fieldSource="password" required="True" wizardIsPassword="False" parentName="usuario" wizardCaption="Password" caption="Password" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentusuariopassword">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="nivel" fieldSource="nivel" required="True" wizardIsPassword="False" parentName="usuario" wizardCaption="Nivel" caption="Nivel" unique="False" wizardSize="5" wizardMaxLength="5" PathID="Contentusuarionivel">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
					</Components>
					<Events/>
					<TableParameters>
						<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="id_usuario" parameterSource="id_usuario" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<Panel id="14" visible="True" generateDiv="False" name="Menu" contentPlaceholder="Menu">
			<Components>
				<IncludePage id="17" name="MenuIncludablePage" PathID="MenuMenuIncludablePage" parentType="Page" page="MenuIncludablePage.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="15" visible="True" generateDiv="False" name="Sidebar1" contentPlaceholder="Sidebar1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="16" visible="True" generateDiv="False" name="HeaderSidebar" contentPlaceholder="HeaderSidebar">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="usuario_maint.php" forShow="True" url="usuario_maint.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="11" groupID="2"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
