<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\respaldo" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" masterPage="{CCS_PathToMasterPage}/MasterPage.ccp" useDesign="True" wizardTheme="None" needGeneration="0">
	<Components>
		<Panel id="50" visible="True" generateDiv="False" name="Head" contentPlaceholder="Head">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="51" visible="True" generateDiv="False" name="Content" contentPlaceholder="Content">
			<Components>
				<Grid id="11" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="detalle_layout" connection="con_xls" pageSizeLimit="100" wizardCaption=" Detalle Layout Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" wizardUseSearch="True" childId="2" dataSource="detalle_layout, layouts ">
					<Components>
						<Link id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="detalle_layout_Insert" hrefSource="detalle_layout_maint.ccp" removeParameters="id_detalle" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" parentName="detalle_layout" PathID="Contentdetalle_layoutdetalle_layout_Insert">
							<Components/>
							<Events/>
							<LinkParameters/>
							<Attributes/>
							<Features/>
						</Link>
						<Sorter id="22" visible="True" name="Sorter_id_detalle" column="id_detalle" wizardCaption="Id Detalle" wizardSortingType="SimpleDir" wizardControl="id_detalle" wizardAddNbsp="False" PathID="Contentdetalle_layoutSorter_id_detalle">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="23" visible="True" name="Sorter_nombre_layout" column="nombre_layout" wizardCaption="Nombre Layout" wizardSortingType="SimpleDir" wizardControl="nombre_layout" wizardAddNbsp="False" PathID="Contentdetalle_layoutSorter_nombre_layout">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="24" visible="True" name="Sorter_nombre_columna" column="nombre_columna" wizardCaption="Nombre Columna" wizardSortingType="SimpleDir" wizardControl="nombre_columna" wizardAddNbsp="False" PathID="Contentdetalle_layoutSorter_nombre_columna">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="25" visible="True" name="Sorter_posicion" column="posicion" wizardCaption="Posicion" wizardSortingType="SimpleDir" wizardControl="posicion" wizardAddNbsp="False" PathID="Contentdetalle_layoutSorter_posicion">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="26" visible="True" name="Sorter_tipo_col" column="tipo_col" wizardCaption="Tipo Col" wizardSortingType="SimpleDir" wizardControl="tipo_col" wizardAddNbsp="False" PathID="Contentdetalle_layoutSorter_tipo_col">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="27" visible="True" name="Sorter_condicion1" column="condicion1" wizardCaption="Condicion1" wizardSortingType="SimpleDir" wizardControl="condicion1" wizardAddNbsp="False" PathID="Contentdetalle_layoutSorter_condicion1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="28" visible="True" name="Sorter_condicion2" column="condicion2" wizardCaption="Condicion2" wizardSortingType="SimpleDir" wizardControl="condicion2" wizardAddNbsp="False" PathID="Contentdetalle_layoutSorter_condicion2">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="29" visible="True" name="Sorter_acepta_nulos" column="acepta_nulos" wizardCaption="Acepta Nulos" wizardSortingType="SimpleDir" wizardControl="acepta_nulos" wizardAddNbsp="False" PathID="Contentdetalle_layoutSorter_acepta_nulos">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Link id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" preserveParameters="GET" name="id_detalle" fieldSource="id_detalle" wizardCaption="Id Detalle" wizardIsPassword="False" parentName="detalle_layout" rowNumber="1" wizardAlign="right" hrefSource="detalle_layout_maint.ccp" PathID="Contentdetalle_layoutid_detalle" urlType="Relative">
							<Components/>
							<Events/>
							<LinkParameters>
								<LinkParameter id="32" sourceType="DataField" format="yyyy-mm-dd" name="id_detalle" source="id_detalle"/>
							</LinkParameters>
							<Attributes/>
							<Features/>
						</Link>
						<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="nombre_layout" fieldSource="nombre_layout" wizardCaption="Nombre Layout" wizardIsPassword="False" parentName="detalle_layout" rowNumber="1" PathID="Contentdetalle_layoutnombre_layout">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="nombre_columna" fieldSource="nombre_columna" wizardCaption="Nombre Columna" wizardIsPassword="False" parentName="detalle_layout" rowNumber="1" PathID="Contentdetalle_layoutnombre_columna">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="38" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="posicion" fieldSource="posicion" wizardCaption="Posicion" wizardIsPassword="False" parentName="detalle_layout" rowNumber="1" wizardAlign="right" PathID="Contentdetalle_layoutposicion">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="tipo_col" fieldSource="tipo_col" wizardCaption="Tipo Col" wizardIsPassword="False" parentName="detalle_layout" rowNumber="1" PathID="Contentdetalle_layouttipo_col">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="42" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="condicion1" fieldSource="condicion1" wizardCaption="Condicion1" wizardIsPassword="False" parentName="detalle_layout" rowNumber="1" PathID="Contentdetalle_layoutcondicion1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="44" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="condicion2" fieldSource="condicion2" wizardCaption="Condicion2" wizardIsPassword="False" parentName="detalle_layout" rowNumber="1" PathID="Contentdetalle_layoutcondicion2">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="acepta_nulos" fieldSource="acepta_nulos" wizardCaption="Acepta Nulos" wizardIsPassword="False" parentName="detalle_layout" rowNumber="1" PathID="Contentdetalle_layoutacepta_nulos">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Navigator id="47" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="Apricot">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="48" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Navigator>
					</Components>
					<Events/>
					<TableParameters>
						<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="detalle_layout.id_layout" parameterSource="s_id_layout" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
						<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="detalle_layout.nombre_columna" parameterSource="s_nombre_columna" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
						<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="detalle_layout.tipo_col" parameterSource="s_tipo_col" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
						<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="detalle_layout.condicion1" parameterSource="s_condicion1" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
						<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="detalle_layout.condicion2" parameterSource="s_condicion2" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
						<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="detalle_layout.acepta_nulos" parameterSource="s_acepta_nulos" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="5"/>
					</TableParameters>
					<JoinTables>
						<JoinTable id="12" tableName="detalle_layout" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
						<JoinTable id="13" tableName="layouts" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="14" tableLeft="detalle_layout" fieldLeft="detalle_layout.id_layout" tableRight="layouts" fieldRight="layouts.id_layout" conditionType="Equal" joinType="left"/>
					</JoinLinks>
					<Fields>
						<Field id="30" tableName="detalle_layout" fieldName="id_detalle"/>
						<Field id="33" tableName="layouts" fieldName="nombre_layout"/>
						<Field id="35" tableName="detalle_layout" fieldName="nombre_columna"/>
						<Field id="37" tableName="detalle_layout" fieldName="posicion"/>
						<Field id="39" tableName="detalle_layout" fieldName="tipo_col"/>
						<Field id="41" tableName="detalle_layout" fieldName="condicion1"/>
						<Field id="43" tableName="detalle_layout" fieldName="condicion2"/>
						<Field id="45" tableName="detalle_layout" fieldName="acepta_nulos"/>
					</Fields>
					<PKFields/>
					<SPParameters/>
					<SQLParameters/>
					<SecurityGroups/>
					<Attributes/>
					<Features/>
				</Grid>
				<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="detalle_layoutSearch" returnPage="detalle_layout_list.ccp" wizardCaption="  Buscar" wizardOrientation="Vertical" wizardFormMethod="post" wizardTypeComponent="Search" PathID="Contentdetalle_layoutSearch" parentId="11">
					<Components>
						<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" parentName="detalle_layoutSearch" PathID="Contentdetalle_layoutSearchButton_DoSearch">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<ListBox id="4" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="s_id_layout" wizardCaption="Id Layout" fieldSource="id_layout" wizardIsPassword="False" parentName="detalle_layoutSearch" caption="Id Layout" required="False" wizardEmptyCaption="Seleccionar Valor" unique="False" connection="con_xls" dataSource="layouts" boundColumn="id_layout" textColumn="nombre_layout" PathID="Contentdetalle_layoutSearchs_id_layout">
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
						<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre_columna" wizardCaption="Nombre Columna" fieldSource="nombre_columna" wizardIsPassword="False" parentName="detalle_layoutSearch" caption="Nombre Columna" required="False" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentdetalle_layoutSearchs_nombre_columna">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="6" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_tipo_col" wizardCaption="Tipo Col" fieldSource="tipo_col" wizardIsPassword="False" parentName="detalle_layoutSearch" caption="Tipo Col" required="False" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentdetalle_layoutSearchs_tipo_col">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_condicion1" wizardCaption="Condicion1" fieldSource="condicion1" wizardIsPassword="False" parentName="detalle_layoutSearch" caption="Condicion1" required="False" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentdetalle_layoutSearchs_condicion1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_condicion2" wizardCaption="Condicion2" fieldSource="condicion2" wizardIsPassword="False" parentName="detalle_layoutSearch" caption="Condicion2" required="False" unique="False" wizardSize="50" wizardMaxLength="50" PathID="Contentdetalle_layoutSearchs_condicion2">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_acepta_nulos" wizardCaption="Acepta Nulos" fieldSource="acepta_nulos" wizardIsPassword="False" parentName="detalle_layoutSearch" caption="Acepta Nulos" required="False" unique="False" wizardSize="2" wizardMaxLength="2" PathID="Contentdetalle_layoutSearchs_acepta_nulos">
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
		<Panel id="52" visible="True" generateDiv="False" name="Menu" contentPlaceholder="Menu">
			<Components>
				<IncludePage id="55" name="MenuIncludablePage" PathID="MenuMenuIncludablePage" parentType="Page" page="MenuIncludablePage.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="53" visible="True" generateDiv="False" name="Sidebar1" contentPlaceholder="Sidebar1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="54" visible="True" generateDiv="False" name="HeaderSidebar" contentPlaceholder="HeaderSidebar">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="detalle_layout_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="detalle_layout_list.php" forShow="True" url="detalle_layout_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="49" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
