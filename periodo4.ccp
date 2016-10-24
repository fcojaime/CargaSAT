<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" useDesign="False" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" name="periodos_carga" connection="con_xls" dataSource="SELECT distinct id_periodo, anio, nombre_mes, mes, fecha_limite, num_intentos_permitidos, tipo_periodo, periodos_carga.id_proveedor AS periodos_carga_id_proveedor,
nom_proveedor 
FROM periodos_carga,
usuario
WHERE usuario.id_proveedor=periodos_carga.id_proveedor
and 	periodos_carga.id_proveedor = {s_id_proveedor}
AND periodos_carga.anio = {s_anio}
AND periodos_carga.nombre_mes LIKE '%{s_nombre_mes}%' " pageSizeLimit="100" pageSize="True" wizardCaption="Lista de Periodos de Carga " wizardThemeApplyTo="Page" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" wizardGridPagingType="Centered" wizardUseSearch="True" wizardAddNbsp="True" gridTotalRecords="False" wizardAddPanels="False" wizardType="GridRecord" wizardGridRecordLinkFieldType="field" wizardGridRecordLinkField="id_periodo" wizardUseInterVariables="False" addTemplatePanel="False" changedCaptionGrid="True" gridExtendedHTML="False" PathID="periodos_carga" composition="8" isParent="True">
			<Components>
				<Link id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="periodos_carga_Insert" hrefSource="periodo4.ccp" removeParameters="id_periodo" wizardThemeItem="FooterA" wizardDefaultValue="Agregar Nuevo" wizardUseTemplateBlock="False" PathID="periodos_cargaperiodos_carga_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="9" visible="True" name="Sorter_id_periodo" column="id_periodo" wizardCaption="Id Periodo" wizardSortingType="SimpleDir" wizardControl="id_periodo" wizardAddNbsp="False" PathID="periodos_cargaSorter_id_periodo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="10" visible="True" name="Sorter_anio" column="anio" wizardCaption="Anio" wizardSortingType="SimpleDir" wizardControl="anio" wizardAddNbsp="False" PathID="periodos_cargaSorter_anio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_nombre_mes" column="nombre_mes" wizardCaption="Nombre Mes" wizardSortingType="SimpleDir" wizardControl="nombre_mes" wizardAddNbsp="False" PathID="periodos_cargaSorter_nombre_mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_fecha_limite" column="fecha_limite" wizardCaption="Fecha Limite" wizardSortingType="SimpleDir" wizardControl="fecha_limite" wizardAddNbsp="False" PathID="periodos_cargaSorter_fecha_limite">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_num_intentos_permitidos" column="num_intentos_permitidos" wizardCaption="Num Intentos Permitidos" wizardSortingType="SimpleDir" wizardControl="num_intentos_permitidos" wizardAddNbsp="False" PathID="periodos_cargaSorter_num_intentos_permitidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_tipo_periodo" column="tipo_periodo" wizardCaption="Tipo Periodo" wizardSortingType="SimpleDir" wizardControl="tipo_periodo" wizardAddNbsp="False" PathID="periodos_cargaSorter_tipo_periodo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_id_proveedor" column="id_proveedor" wizardCaption="Id Proveedor" wizardSortingType="SimpleDir" wizardControl="id_proveedor" wizardAddNbsp="False" PathID="periodos_cargaSorter_id_proveedor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" preserveParameters="GET" name="id_periodo" fieldSource="id_periodo" wizardCaption="Id Periodo" wizardIsPassword="False" wizardUseTemplateBlock="False" linkProperties="''" wizardAlign="right" wizardAddNbsp="True" wizardThemeItem="GridA" PathID="periodos_cargaid_periodo" urlType="Relative">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="17" sourceType="DataField" format="yyyy-mm-dd" name="id_periodo" source="id_periodo"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="anio" fieldSource="anio" wizardCaption="Anio" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="periodos_cargaanio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="nombre_mes" fieldSource="nombre_mes" wizardCaption="Nombre Mes" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="periodos_carganombre_mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Date" html="False" generateSpan="False" name="fecha_limite" fieldSource="fecha_limite" wizardCaption="Fecha Limite" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="periodos_cargafecha_limite" format="dd/mm/yyyy hh:nn" DBFormat="yyyy-mm-dd HH:nn:ss.S">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="num_intentos_permitidos" fieldSource="num_intentos_permitidos" wizardCaption="Num Intentos Permitidos" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="periodos_carganum_intentos_permitidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="tipo_periodo" fieldSource="tipo_periodo" wizardCaption="Tipo Periodo" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="periodos_cargatipo_periodo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="id_proveedor" fieldSource="nom_proveedor" wizardCaption="Id Proveedor" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="periodos_cargaid_proveedor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="30" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="51" dataType="Integer" defaultValue="0" parameterSource="s_id_proveedor" parameterType="URL" variable="s_id_proveedor"/>
				<SQLParameter id="52" dataType="Integer" defaultValue="0" parameterSource="s_anio" parameterType="URL" variable="s_anio"/>
				<SQLParameter id="53" dataType="Text" parameterSource="s_nombre_mes" parameterType="URL" variable="s_nombre_mes"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="31" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="periodos_cargaSearch" searchIds="31" fictitiousConnection="con_xls" wizardCaption="  Buscar" wizardOrientation="Vertical" wizardFormMethod="post" gridSearchClearLink="False" wizardTypeComponent="Search" gridSearchType="And" wizardInteractiveSearch="False" gridSearchRecPerPage="False" wizardTypeButtons="button" wizardDefaultButton="False" gridSearchSortField="False" wizardUseInterVariables="False" wizardThemeApplyTo="Page" addTemplatePanel="False" wizardType="GridRecord" returnPage="periodo4.ccp" PathID="periodos_cargaSearch" composition="8" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
			<Components>
				<Button id="32" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="periodos_cargaSearchButton_DoSearch" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_id_proveedor" fieldSource="id_proveedor" wizardIsPassword="False" wizardCaption="Id Proveedor" caption="Id Proveedor" required="False" unique="False" wizardSize="10" wizardMaxLength="10" PathID="periodos_cargaSearchs_id_proveedor" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" sourceType="SQL" connection="con_xls" dataSource="SELECT distinct id_proveedor, nom_proveedor 
FROM usuario 
where capc_cds&lt;&gt;'CAPC'
	union select  0, 'TODOS'"><Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<PKFields/>
				</ListBox>
				<TextBox id="34" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_anio" fieldSource="anio" wizardIsPassword="False" wizardCaption="Anio" caption="Anio" required="False" unique="False" wizardSize="5" wizardMaxLength="5" PathID="periodos_cargaSearchs_anio" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre_mes" fieldSource="nombre_mes" wizardIsPassword="False" wizardCaption="Nombre Mes" caption="Nombre Mes" required="False" unique="False" wizardSize="50" wizardMaxLength="50" PathID="periodos_cargaSearchs_nombre_mes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" sourceType="ListOfValues" dataSource="Enero;Enero;Febrero;Febrero;Marzo;Marzo;Abril;Abril;Mayo;Mayo;Junio;Junio;Julio;Julio;Agosto;Agosto;Septiembre;Septiembre;Octubre;Octubre;Noviembre;Noviembre;Diciembre;Diciembre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<PKFields/>
				</ListBox>
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
		<Record id="36" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="periodos_carga1" connection="con_xls" dataSource="periodos_carga" errorSummator="Error" allowCancel="True" recordDeleteConfirmation="False" buttonsType="button" wizardRecordKey="id_periodo" encryptPasswordField="False" wizardUseInterVariables="False" pkIsAutoincrement="True" wizardCaption="Agregar/Editar Periodos Carga " wizardThemeApplyTo="Page" wizardFormMethod="post" wizardType="GridRecord" changedCaptionRecord="False" recordDirection="Vertical" templatePageRecord="C:/Program Files (x86)/CodeChargeStudio5/Templates/Record/Dialog.ccp|ccsTemplate" recordAddTemplatePanel="False" PathID="periodos_carga1" composition="8">
			<Components>
				<Button id="38" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="periodos_carga1Button_Insert">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="55"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="39" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="periodos_carga1Button_Update">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="56"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="40" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="periodos_carga1Button_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="41" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancelar" PathID="periodos_carga1Button_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="anio" fieldSource="anio" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardCaption="Anio" caption="Anio" required="True" unique="False" wizardSize="5" wizardMaxLength="5" PathID="periodos_carga1anio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre_mes" fieldSource="nombre_mes" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardCaption="Nombre Mes" caption="Nombre Mes" required="False" unique="False" wizardSize="50" wizardMaxLength="50" PathID="periodos_carga1nombre_mes" sourceType="ListOfValues" dataSource="Enero;Enero;Febrero;Febrero;Marzo;Marzo;Abril;Abril;Mayo;Mayo;Junio;Junio;Julio;Julio;Agosto;Agosto;Septiembre;Septiembre;Octubre;Octubre;Noviembre;Noviembre;Diciembre;Diciembre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<PKFields/>
				</ListBox>
				<TextBox id="45" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fecha_limite" fieldSource="fecha_limite" wizardIsPassword="False" wizardUseTemplateBlock="False" features="(assigned)" wizardCaption="Fecha Limite" caption="Fecha Limite" required="True" format="dd/mm/yyyy hh:nn" unique="False" wizardSize="8" wizardMaxLength="100" PathID="periodos_carga1fecha_limite" DBFormat="yyyy-mm-dd HH:nn:ss.S">
					<Components/>
					<Events/>
					<Attributes/>
					<Features>
						<JDateTimePicker id="46" show_weekend="True" name="InlineDatePicker1" category="jQuery" enabled="True">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Features/>
						</JDateTimePicker>
					</Features>
				</TextBox>
				<TextBox id="47" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="num_intentos_permitidos" fieldSource="num_intentos_permitidos" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardCaption="Num Intentos Permitidos" caption="Num Intentos Permitidos" required="True" unique="False" wizardSize="5" wizardMaxLength="5" PathID="periodos_carga1num_intentos_permitidos" validationRule="num_intentos_permitidos&lt;4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="48" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tipo_periodo" fieldSource="tipo_periodo" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardCaption="Tipo Periodo" caption="Tipo Periodo" required="True" unique="False" wizardSize="50" wizardMaxLength="50" PathID="periodos_carga1tipo_periodo" sourceType="ListOfValues" dataSource="Normal;Normal;Extraordinario;Extraordinario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<PKFields/>
				</ListBox>
				<ListBox id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="id_proveedor" fieldSource="id_proveedor" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardCaption="Id Proveedor" caption="Id Proveedor" required="True" unique="False" wizardSize="10" wizardMaxLength="10" PathID="periodos_carga1id_proveedor" sourceType="SQL" connection="con_xls" dataSource="SELECT distinct id_proveedor, nom_proveedor 
FROM usuario 
	where capc_cds='CDS'
	union select 0,'Todos'"><Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<PKFields/>
				</ListBox>
				<Hidden id="54" fieldSourceType="DBColumn" dataType="Integer" name="mes" PathID="periodos_carga1mes" fieldSource="mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="57"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="42" conditionType="Parameter" useIsNull="False" field="id_periodo" parameterSource="id_periodo" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="37" tableName="periodos_carga"/>
			</JoinTables>
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
		<IncludePage id="50" name="Header" PathID="Header" page="Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="periodo4.php" forShow="True" url="periodo4.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="periodo4_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
