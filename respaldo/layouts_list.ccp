<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\respaldo" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" masterPage="{CCS_PathToMasterPage}/MasterPage.ccp" useDesign="True" wizardTheme="None" needGeneration="0">
	<Components>
		<Panel id="41" visible="True" generateDiv="False" name="Head" contentPlaceholder="Head">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="42" visible="True" generateDiv="False" name="Content" contentPlaceholder="Content">
			<Components>
				<Grid id="9" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="layouts" connection="con_xls" pageSizeLimit="100" wizardCaption=" Layouts Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" wizardUseSearch="True" childId="2" dataSource="layouts">
					<Components>
						<Link id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="layouts_Insert" hrefSource="layouts_maint.ccp" removeParameters="id_layout" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" parentName="layouts" PathID="Contentlayoutslayouts_Insert">
							<Components/>
							<Events/>
							<LinkParameters/>
							<Attributes/>
							<Features/>
						</Link>
						<Sorter id="16" visible="True" name="Sorter_id_layout" column="id_layout" wizardCaption="Id Layout" wizardSortingType="SimpleDir" wizardControl="id_layout" wizardAddNbsp="False" PathID="ContentlayoutsSorter_id_layout">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="17" visible="True" name="Sorter_nombre_layout" column="nombre_layout" wizardCaption="Nombre Layout" wizardSortingType="SimpleDir" wizardControl="nombre_layout" wizardAddNbsp="False" PathID="ContentlayoutsSorter_nombre_layout">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="18" visible="True" name="Sorter_num_hojas" column="num_hojas" wizardCaption="Num Hojas" wizardSortingType="SimpleDir" wizardControl="num_hojas" wizardAddNbsp="False" PathID="ContentlayoutsSorter_num_hojas">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="19" visible="True" name="Sorter_posicionable" column="posicionable" wizardCaption="Posicionable" wizardSortingType="SimpleDir" wizardControl="posicionable" wizardAddNbsp="False" PathID="ContentlayoutsSorter_posicionable">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="20" visible="True" name="Sorter_nombre_tabla_destino" column="nombre_tabla_destino" wizardCaption="Nombre Tabla Destino" wizardSortingType="SimpleDir" wizardControl="nombre_tabla_destino" wizardAddNbsp="False" PathID="ContentlayoutsSorter_nombre_tabla_destino">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="21" visible="True" name="Sorter_tipo_arch" column="tipo_arch" wizardCaption="Tipo Arch" wizardSortingType="SimpleDir" wizardControl="tipo_arch" wizardAddNbsp="False" PathID="ContentlayoutsSorter_tipo_arch">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="22" visible="True" name="Sorter_num_cols_descartar" column="num_cols_descartar" wizardCaption="Num Cols Descartar" wizardSortingType="SimpleDir" wizardControl="num_cols_descartar" wizardAddNbsp="False" PathID="ContentlayoutsSorter_num_cols_descartar">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Link id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" preserveParameters="GET" name="id_layout" fieldSource="id_layout" wizardCaption="Id Layout" wizardIsPassword="False" parentName="layouts" rowNumber="1" wizardAlign="right" hrefSource="layouts_maint.ccp" PathID="Contentlayoutsid_layout" urlType="Relative">
							<Components/>
							<Events/>
							<LinkParameters>
								<LinkParameter id="25" sourceType="DataField" format="yyyy-mm-dd" name="id_layout" source="id_layout"/>
							</LinkParameters>
							<Attributes/>
							<Features/>
						</Link>
						<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="nombre_layout" fieldSource="nombre_layout" wizardCaption="Nombre Layout" wizardIsPassword="False" parentName="layouts" rowNumber="1" PathID="Contentlayoutsnombre_layout">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="29" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="num_hojas" fieldSource="num_hojas" wizardCaption="Num Hojas" wizardIsPassword="False" parentName="layouts" rowNumber="1" wizardAlign="right" PathID="Contentlayoutsnum_hojas">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="posicionable" fieldSource="posicionable" wizardCaption="Posicionable" wizardIsPassword="False" parentName="layouts" rowNumber="1" PathID="Contentlayoutsposicionable">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="nombre_tabla_destino" fieldSource="nombre_tabla_destino" wizardCaption="Nombre Tabla Destino" wizardIsPassword="False" parentName="layouts" rowNumber="1" PathID="Contentlayoutsnombre_tabla_destino">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="tipo_arch" fieldSource="tipo_arch" wizardCaption="Tipo Arch" wizardIsPassword="False" parentName="layouts" rowNumber="1" PathID="Contentlayoutstipo_arch">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="num_cols_descartar" fieldSource="num_cols_descartar" wizardCaption="Num Cols Descartar" wizardIsPassword="False" parentName="layouts" rowNumber="1" wizardAlign="right" PathID="Contentlayoutsnum_cols_descartar">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Navigator id="38" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="Apricot">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="39" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Navigator>
					</Components>
					<Events/>
					<TableParameters>
						<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="nombre_layout" parameterSource="s_nombre_layout" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
						<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="posicionable" parameterSource="s_posicionable" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
						<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="nombre_tabla_destino" parameterSource="s_nombre_tabla_destino" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
						<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="tipo_arch" parameterSource="s_tipo_arch" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
					</TableParameters>
					<JoinTables>
						<JoinTable id="10" tableName="layouts" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="23" tableName="layouts" fieldName="id_layout"/>
						<Field id="26" tableName="layouts" fieldName="nombre_layout"/>
						<Field id="28" tableName="layouts" fieldName="num_hojas"/>
						<Field id="30" tableName="layouts" fieldName="posicionable"/>
						<Field id="32" tableName="layouts" fieldName="nombre_tabla_destino"/>
						<Field id="34" tableName="layouts" fieldName="tipo_arch"/>
						<Field id="36" tableName="layouts" fieldName="num_cols_descartar"/>
					</Fields>
					<PKFields/>
					<SPParameters/>
					<SQLParameters/>
					<SecurityGroups/>
					<Attributes/>
					<Features/>
				</Grid>
				<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="layoutsSearch" returnPage="layouts_list.ccp" wizardCaption="  Buscar" wizardOrientation="Vertical" wizardFormMethod="post" wizardTypeComponent="Search" PathID="ContentlayoutsSearch" parentId="9">
					<Components>
						<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" parentName="layoutsSearch" PathID="ContentlayoutsSearchButton_DoSearch">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre_layout" wizardCaption="Nombre Layout" fieldSource="nombre_layout" wizardIsPassword="False" parentName="layoutsSearch" caption="Nombre Layout" required="False" unique="False" wizardSize="50" wizardMaxLength="80" PathID="ContentlayoutsSearchs_nombre_layout">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_posicionable" wizardCaption="Posicionable" fieldSource="posicionable" wizardIsPassword="False" parentName="layoutsSearch" caption="Posicionable" required="False" unique="False" wizardSize="2" wizardMaxLength="2" PathID="ContentlayoutsSearchs_posicionable">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="6" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre_tabla_destino" wizardCaption="Nombre Tabla Destino" fieldSource="nombre_tabla_destino" wizardIsPassword="False" parentName="layoutsSearch" caption="Nombre Tabla Destino" required="False" unique="False" wizardSize="50" wizardMaxLength="50" PathID="ContentlayoutsSearchs_nombre_tabla_destino">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_tipo_arch" wizardCaption="Tipo Arch" fieldSource="tipo_arch" wizardIsPassword="False" parentName="layoutsSearch" caption="Tipo Arch" required="False" unique="False" wizardSize="5" wizardMaxLength="5" PathID="ContentlayoutsSearchs_tipo_arch">
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
		<Panel id="43" visible="True" generateDiv="False" name="Menu" contentPlaceholder="Menu">
			<Components>
				<IncludePage id="46" name="MenuIncludablePage" PathID="MenuMenuIncludablePage" parentType="Page" page="MenuIncludablePage.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="44" visible="True" generateDiv="False" name="Sidebar1" contentPlaceholder="Sidebar1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="45" visible="True" generateDiv="False" name="HeaderSidebar" contentPlaceholder="HeaderSidebar">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="layouts_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="layouts_list.php" forShow="True" url="layouts_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="40" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
