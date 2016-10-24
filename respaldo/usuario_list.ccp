<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\respaldo" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" masterPage="{CCS_PathToMasterPage}/MasterPage.ccp" useDesign="True" wizardTheme="None" needGeneration="0">
	<Components>
		<Panel id="28" visible="True" generateDiv="False" name="Head" contentPlaceholder="Head">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="29" visible="True" generateDiv="False" name="Content" contentPlaceholder="Content">
			<Components>
				<Grid id="7" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="usuario" connection="con_xls" pageSizeLimit="100" wizardCaption=" Usuario Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" wizardUseSearch="True" childId="2" dataSource="usuario">
					<Components>
						<Link id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="usuario_Insert" hrefSource="usuario_maint.ccp" removeParameters="id_usuario" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" parentName="usuario" PathID="Contentusuariousuario_Insert">
							<Components/>
							<Events/>
							<LinkParameters/>
							<Attributes/>
							<Features/>
						</Link>
						<Sorter id="12" visible="True" name="Sorter_id_usuario" column="id_usuario" wizardCaption="Id Usuario" wizardSortingType="SimpleDir" wizardControl="id_usuario" wizardAddNbsp="False" PathID="ContentusuarioSorter_id_usuario">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="13" visible="True" name="Sorter_nombre_usuario" column="nombre_usuario" wizardCaption="Nombre Usuario" wizardSortingType="SimpleDir" wizardControl="nombre_usuario" wizardAddNbsp="False" PathID="ContentusuarioSorter_nombre_usuario">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="14" visible="True" name="Sorter_usuario" column="usuario" wizardCaption="Usuario" wizardSortingType="SimpleDir" wizardControl="usuario" wizardAddNbsp="False" PathID="ContentusuarioSorter_usuario">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="15" visible="True" name="Sorter_nivel" column="nivel" wizardCaption="Nivel" wizardSortingType="SimpleDir" wizardControl="nivel" wizardAddNbsp="False" PathID="ContentusuarioSorter_nivel">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Link id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" preserveParameters="GET" name="id_usuario" fieldSource="id_usuario" wizardCaption="Id Usuario" wizardIsPassword="False" parentName="usuario" rowNumber="1" wizardAlign="right" hrefSource="usuario_maint.ccp" PathID="Contentusuarioid_usuario" urlType="Relative">
							<Components/>
							<Events/>
							<LinkParameters>
								<LinkParameter id="18" sourceType="DataField" format="yyyy-mm-dd" name="id_usuario" source="id_usuario"/>
							</LinkParameters>
							<Attributes/>
							<Features/>
						</Link>
						<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="nombre_usuario" fieldSource="nombre_usuario" wizardCaption="Nombre Usuario" wizardIsPassword="False" parentName="usuario" rowNumber="1" PathID="Contentusuarionombre_usuario">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="usuario1" fieldSource="usuario" wizardCaption="Usuario" wizardIsPassword="False" parentName="usuario" rowNumber="1" PathID="Contentusuariousuario1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="24" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="nivel" fieldSource="nivel" wizardCaption="Nivel" wizardIsPassword="False" parentName="usuario" rowNumber="1" wizardAlign="right" PathID="Contentusuarionivel">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Navigator id="25" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="Apricot">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="26" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Navigator>
					</Components>
					<Events/>
					<TableParameters>
						<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="nombre_usuario" parameterSource="s_nombre_usuario" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
						<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="usuario" parameterSource="s_usuario" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
					</TableParameters>
					<JoinTables>
						<JoinTable id="8" tableName="usuario" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="16" tableName="usuario" fieldName="id_usuario"/>
						<Field id="19" tableName="usuario" fieldName="nombre_usuario"/>
						<Field id="21" tableName="usuario" fieldName="usuario"/>
						<Field id="23" tableName="usuario" fieldName="nivel"/>
					</Fields>
					<PKFields/>
					<SPParameters/>
					<SQLParameters/>
					<SecurityGroups/>
					<Attributes/>
					<Features/>
				</Grid>
				<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="usuarioSearch" returnPage="usuario_list.ccp" wizardCaption="  Buscar" wizardOrientation="Vertical" wizardFormMethod="post" wizardTypeComponent="Search" PathID="ContentusuarioSearch" parentId="7">
					<Components>
						<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" parentName="usuarioSearch" PathID="ContentusuarioSearchButton_DoSearch">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre_usuario" wizardCaption="Nombre Usuario" fieldSource="nombre_usuario" wizardIsPassword="False" parentName="usuarioSearch" caption="Nombre Usuario" required="False" unique="False" wizardSize="50" wizardMaxLength="50" PathID="ContentusuarioSearchs_nombre_usuario">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_usuario" wizardCaption="Usuario" fieldSource="usuario" wizardIsPassword="False" parentName="usuarioSearch" caption="Usuario" required="False" unique="False" wizardSize="50" wizardMaxLength="50" PathID="ContentusuarioSearchs_usuario">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
					</Components>
					<Events/>
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
		<Panel id="30" visible="True" generateDiv="False" name="Menu" contentPlaceholder="Menu">
			<Components>
				<IncludePage id="33" name="MenuIncludablePage" PathID="MenuMenuIncludablePage" parentType="Page" page="MenuIncludablePage.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="31" visible="True" generateDiv="False" name="Sidebar1" contentPlaceholder="Sidebar1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="32" visible="True" generateDiv="False" name="HeaderSidebar" contentPlaceholder="HeaderSidebar">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="usuario_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="usuario_list.php" forShow="True" url="usuario_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="27" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
