<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" useDesign="False" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="15" name="Grid1" connection="con_xls" dataSource="select  sc.descripcion,
	 count(herr_est_cost) totherr_est_cost, 
		sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end) cumplenherr_est_cost, 
		case when count(herr_est_cost)&gt;0 then 
			sum(case when isnumeric(herr_est_cost)=1 then cast(herr_est_cost as int) else 0 end)/count(herr_est_cost)*100 
		else 0 end herr_est_cost,
	 (select meta from mc_c_metrica where acronimo='herr_est_cost') as meta_herr_est_cost,
	 count(req_serv) totreq_serv, 
		sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end) cumplenreq_serv, 
		case when count(req_serv)&gt;0 then 
			sum(case when isnumeric(req_serv)=1 then cast(req_serv as int) else 0 end)/count(req_serv)*100 
		else 0 end req_serv,
	 (select meta from mc_c_metrica where acronimo='req_serv') as meta_req_serv,
	 count(cumpl_req_func) totcumpl_req_func, 
		sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end) cumplencumpl_req_func, 
		case when count(cumpl_req_func)&gt;0 then 
			sum(case when isnumeric(cumpl_req_func)=1 then cast(cumpl_req_func as int) else 0 end)/count(cumpl_req_func)*100 
		else 0 end cumpl_req_func ,
	 (select meta from mc_c_metrica where acronimo='cumpl_req_func') as meta_cumpl_req_func,
	 count(calidad_prod_term) totcalidad_prod_term, 
		sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end) cumplencalidad_prod_term, 
		case when count(calidad_prod_term)&gt;0 then 
			sum(case when isnumeric(calidad_prod_term)=1 then cast(calidad_prod_term as int) else 0 end)/count(calidad_prod_term)*100 
		else 0 end calidad_prod_term,
	 (select meta from mc_c_metrica where acronimo='calidad_prod_term') as meta_calidad_prod_term,
	 count(retr_entregable) totretr_entregable, 
		sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end) cumplenretr_entregable, 
		case when count(retr_entregable)&gt;0 then 
			sum(case when isnumeric(retr_entregable)=1 then cast(retr_entregable as int) else 0 end)/count(retr_entregable)*100 
		else 0 end retr_entregable,
	 (select meta from mc_c_metrica where acronimo='retr_entregable') as meta_retr_entregable,
	 count(calidad_codigo) totcal_cod, 
		sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end) cumplencal_cod, 
		case when count(calidad_codigo)&gt;0 then 
			sum(case when isnumeric(calidad_codigo)=1 then cast(calidad_codigo  as int) else 0 end)/count(calidad_codigo)*100 
		else 0 end cal_cod,
	 (select meta from mc_c_metrica where acronimo='cal_cod') as meta_cal_cod,
	 count(def_fug_amb_prod) totdef_fug_amb_prod, 
		sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end) cumplendef_fug_amb_prod, 
		case when count(def_fug_amb_prod)&gt;0 then 
			sum(case when isnumeric(def_fug_amb_prod)=1 then cast(def_fug_amb_prod as int) else 0 end)/count(def_fug_amb_prod)*100  
		else 0 end def_fug_amb_prod,
	 (select meta from mc_c_metrica where acronimo='def_fug_amb_prod') as meta_def_fug_amb_prod,
	 count(cumple_inc_tiempoasignacion) totinc_tiempoasignacion, 
		sum(cast(cumple_inc_tiempoasignacion as int)) cumpleninc_tiempoasignacion, 
		case when count(cumple_inc_tiempoasignacion)&gt;0 then 
			sum(cast(cumple_inc_tiempoasignacion as float))/count(cumple_inc_tiempoasignacion)*100 
		else 0 end inc_tiempoasignacion,
	 (select meta from mc_c_metrica where acronimo='inc_tiempoasignacion') as meta_inc_tiempoasignacion,
	 count(cumple_inc_tiemposolucion) totinc_tiemposolucion, 
		sum(cast(cumple_inc_tiemposolucion as int)) cumpleninc_tiemposolucion, 
		case when count(cumple_inc_tiemposolucion)&gt;0 then 
			sum(cast(cumple_inc_tiemposolucion as float))/count(cumple_inc_tiemposolucion)*100 
		else 0 end inc_tiemposolucion,
	 (select meta from mc_c_metrica where acronimo='inc_tiemposolucion') as meta_inc_tiemposolucion,
	 AVG(Cumple_EF) cumplen_efic_presup, AVG(total_ef) tot_efic_presup, avg(cast(Cumple_EF as float))/avg(total_ef)*100  efic_presup,
	 (Select Meta from mc_c_metrica where acronimo='EFIC_PRESUP') as meta_efic_presup
from mc_c_ServContractual sc 
left join (select * from l_calificacion_rs_aut m
	where m.id_periodo=5  and m.id_proveedor = 3 and m.tipo_nivel_servicio ='SLO' and m.estatus ='F' 
	and num_carga=(
       select max(b.num_carga)
       from l_calificacion_rs_aut  b
       where b.id_proveedor = {s_id_proveedor}
       and b.id_periodo = {s_id_periodo}
       and b.tipo_nivel_servicio = '{s_opt_slas}'
       and b.estatus='F'
       )) m on sc.Descripcion  = m.servicio_cont  
	 left join	(select cumple_inc_tiempoasignacion, cumple_inc_tiempoSolucion, 
				id_proveedor, 'Servicio de Soporte de Aplicaciones'  servicio_cont
				from l_calificacion_incidentes_AUT
				where (id_periodo={s_id_periodo}  and id_proveedor = {s_id_proveedor} and tipo_nivel_servicio ='{s_opt_slas}'  and estatus ='F'
				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b 
				where b.id_proveedor = {s_id_proveedor} and b.id_periodo =  {s_id_periodo} and b.tipo_nivel_servicio = '{s_opt_slas}' and b.estatus='F' ) 
				) )  mi on  mi.servicio_cont = sc.Descripcion 
	left join (select SUM(cast(efic_presupuestal as int)) Cumple_EF, COUNT(efic_presupuestal) Total_EF, Id_Proveedor,  2 IdServicioCont  
			from l_detalle_eficiencia_presupuestal 
			where (id_periodo= {s_id_periodo}  and id_proveedor = {s_id_proveedor} and tipo_nivel_servicio ='{s_opt_slas}'  and estatus ='F'
				and num_carga=(select max(b.num_carga) from l_calificacion_incidentes_aut b 
				where b.id_proveedor = {s_id_proveedor} and b.id_periodo = {s_id_periodo} and b.tipo_nivel_servicio = '{s_opt_slas}' and b.estatus='F' ) 
				) group by id_proveedor ) ef on ef.IdServicioCont = sc.id
where sc.Aplica ='CDS' and IdOld &lt;&gt;0
group by sc.Descripcion " pageSizeLimit="100" pageSize="True" wizardCaption="Resumen de Niveles de Servicio" wizardThemeApplyTo="Page" wizardGridType="Tabular" wizardSortingType="Simple" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" wizardGridPagingType="Simple" wizardUseSearch="False" wizardAddNbsp="True" gridTotalRecords="False" wizardAddPanels="False" wizardType="Grid" wizardUseInterVariables="False" addTemplatePanel="False" changedCaptionGrid="True" gridExtendedHTML="False" PathID="Grid1">
			<Components>
				<Sorter id="3" visible="True" name="Sorter_descripcion" column="descripcion" wizardCaption="Descripcion" wizardSortingType="Simple" wizardControl="descripcion" wizardAddNbsp="False" PathID="Grid1Sorter_descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="5" visible="True" name="Sorter_cumplenherr_est_cost" column="cumplenherr_est_cost" wizardCaption="Cumplenherr Est Cost" wizardSortingType="Simple" wizardControl="cumplenherr_est_cost" wizardAddNbsp="False" PathID="Grid1Sorter_cumplenherr_est_cost">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="9" visible="True" name="Sorter_cumplenreq_serv" column="cumplenreq_serv" wizardCaption="Cumplenreq Serv" wizardSortingType="Simple" wizardControl="cumplenreq_serv" wizardAddNbsp="False" PathID="Grid1Sorter_cumplenreq_serv">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_cumplencumpl_req_func" column="cumplencumpl_req_func" wizardCaption="Cumplencumpl Req Func" wizardSortingType="Simple" wizardControl="cumplencumpl_req_func" wizardAddNbsp="False" PathID="Grid1Sorter_cumplencumpl_req_func">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="17" visible="True" name="Sorter_cumplencalidad_prod_term" column="cumplencalidad_prod_term" wizardCaption="Cumplencalidad Prod Term" wizardSortingType="Simple" wizardControl="cumplencalidad_prod_term" wizardAddNbsp="False" PathID="Grid1Sorter_cumplencalidad_prod_term">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="21" visible="True" name="Sorter_cumplenretr_entregable" column="cumplenretr_entregable" wizardCaption="Cumplenretr Entregable" wizardSortingType="Simple" wizardControl="cumplenretr_entregable" wizardAddNbsp="False" PathID="Grid1Sorter_cumplenretr_entregable">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="25" visible="True" name="Sorter_cumplencal_cod" column="cumplencal_cod" wizardCaption="Cumplencal Cod" wizardSortingType="Simple" wizardControl="cumplencal_cod" wizardAddNbsp="False" PathID="Grid1Sorter_cumplencal_cod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="29" visible="True" name="Sorter_cumplendef_fug_amb_prod" column="cumplendef_fug_amb_prod" wizardCaption="Cumplendef Fug Amb Prod" wizardSortingType="Simple" wizardControl="cumplendef_fug_amb_prod" wizardAddNbsp="False" PathID="Grid1Sorter_cumplendef_fug_amb_prod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" generateSpan="False" name="descripcion" fieldSource="descripcion" wizardCaption="Descripcion" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="34" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumplenherr_est_cost" fieldSource="cumplenherr_est_cost" wizardCaption="Cumplenherr Est Cost" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1cumplenherr_est_cost">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumplenreq_serv" fieldSource="cumplenreq_serv" wizardCaption="Cumplenreq Serv" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1cumplenreq_serv">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="42" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumplencumpl_req_func" fieldSource="cumplencumpl_req_func" wizardCaption="Cumplencumpl Req Func" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1cumplencumpl_req_func">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="46" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumplencalidad_prod_term" fieldSource="cumplencalidad_prod_term" wizardCaption="Cumplencalidad Prod Term" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1cumplencalidad_prod_term">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="50" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumplenretr_entregable" fieldSource="cumplenretr_entregable" wizardCaption="Cumplenretr Entregable" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1cumplenretr_entregable">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="54" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumplencal_cod" fieldSource="cumplencal_cod" wizardCaption="Cumplencal Cod" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1cumplencal_cod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="58" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumplendef_fug_amb_prod" fieldSource="cumplendef_fug_amb_prod" wizardCaption="Cumplendef Fug Amb Prod" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1cumplendef_fug_amb_prod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="61" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="33" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totherr_est_cost" fieldSource="totherr_est_cost" wizardCaption="Totherr Est Cost" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1totherr_est_cost">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="herr_est_cost" fieldSource="herr_est_cost" wizardCaption="Herr Est Cost" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1herr_est_cost">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="36" fieldSourceType="DBColumn" dataType="Float" html="False" generateSpan="False" name="meta_herr_est_cost" fieldSource="meta_herr_est_cost" wizardCaption="Meta Herr Est Cost" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1meta_herr_est_cost">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totreq_serv" fieldSource="totreq_serv" wizardCaption="Totreq Serv" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1totreq_serv">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="req_serv" fieldSource="req_serv" wizardCaption="Req Serv" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1req_serv">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="40" fieldSourceType="DBColumn" dataType="Float" html="False" generateSpan="False" name="meta_req_serv" fieldSource="meta_req_serv" wizardCaption="Meta Req Serv" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1meta_req_serv">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="41" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totcumpl_req_func" fieldSource="totcumpl_req_func" wizardCaption="Totcumpl Req Func" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1totcumpl_req_func">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="43" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="cumpl_req_func" fieldSource="cumpl_req_func" wizardCaption="Cumpl Req Func" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1cumpl_req_func">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="44" fieldSourceType="DBColumn" dataType="Float" html="False" generateSpan="False" name="meta_cumpl_req_func" fieldSource="meta_cumpl_req_func" wizardCaption="Meta Cumpl Req Func" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1meta_cumpl_req_func">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="45" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totcalidad_prod_term" fieldSource="totcalidad_prod_term" wizardCaption="Totcalidad Prod Term" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1totcalidad_prod_term">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="47" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="calidad_prod_term" fieldSource="calidad_prod_term" wizardCaption="Calidad Prod Term" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1calidad_prod_term">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="48" fieldSourceType="DBColumn" dataType="Float" html="False" generateSpan="False" name="meta_calidad_prod_term" fieldSource="meta_calidad_prod_term" wizardCaption="Meta Calidad Prod Term" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1meta_calidad_prod_term">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="49" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totretr_entregable" fieldSource="totretr_entregable" wizardCaption="Totretr Entregable" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1totretr_entregable">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="51" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="retr_entregable" fieldSource="retr_entregable" wizardCaption="Retr Entregable" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1retr_entregable">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="52" fieldSourceType="DBColumn" dataType="Float" html="False" generateSpan="False" name="meta_retr_entregable" fieldSource="meta_retr_entregable" wizardCaption="Meta Retr Entregable" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1meta_retr_entregable">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="53" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totcal_cod" fieldSource="totcal_cod" wizardCaption="Totcal Cod" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1totcal_cod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="55" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="cal_cod" fieldSource="cal_cod" wizardCaption="Cal Cod" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1cal_cod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="56" fieldSourceType="DBColumn" dataType="Float" html="False" generateSpan="False" name="meta_cal_cod" fieldSource="meta_cal_cod" wizardCaption="Meta Cal Cod" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1meta_cal_cod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="57" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totdef_fug_amb_prod" fieldSource="totdef_fug_amb_prod" wizardCaption="Totdef Fug Amb Prod" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1totdef_fug_amb_prod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="59" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="def_fug_amb_prod" fieldSource="def_fug_amb_prod" wizardCaption="Def Fug Amb Prod" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1def_fug_amb_prod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="60" fieldSourceType="DBColumn" dataType="Float" html="False" generateSpan="False" name="meta_def_fug_amb_prod" fieldSource="meta_def_fug_amb_prod" wizardCaption="Meta Def Fug Amb Prod" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1meta_def_fug_amb_prod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Image id="62" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imgherr_est_cost" PathID="Grid1imgherr_est_cost">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Image id="63" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imgreq_serv" PathID="Grid1imgreq_serv">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Image id="64" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imgcumpl_req_func" PathID="Grid1imgcumpl_req_func">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Image id="65" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imgcalidad_prod_term" PathID="Grid1imgcalidad_prod_term">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Image id="66" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imgretr_entregable" PathID="Grid1imgretr_entregable">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Image id="67" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imgcal_cod" PathID="Grid1imgcal_cod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Image id="68" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imgdef_fug_amb_prod" PathID="Grid1imgdef_fug_amb_prod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Label id="70" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumpleninc_tiempoasignacion" PathID="Grid1cumpleninc_tiempoasignacion" fieldSource="cumpleninc_tiempoasignacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="71" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totinc_tiempoasignacion" PathID="Grid1totinc_tiempoasignacion" fieldSource="totinc_tiempoasignacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="72" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="inc_tiempoasignacion" PathID="Grid1inc_tiempoasignacion" fieldSource="inc_tiempoasignacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="73" fieldSourceType="DBColumn" dataType="Integer" name="meta_inc_tiempoasignacion" PathID="Grid1meta_inc_tiempoasignacion" fieldSource="meta_inc_tiempoasignacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="74" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumpleninc_tiemposolucion" PathID="Grid1cumpleninc_tiemposolucion" fieldSource="cumpleninc_tiemposolucion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="75" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totinc_tiemposolucion" PathID="Grid1totinc_tiemposolucion" fieldSource="totinc_tiemposolucion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="76" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="inc_tiemposolucion" PathID="Grid1inc_tiemposolucion" fieldSource="inc_tiemposolucion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="77" fieldSourceType="DBColumn" dataType="Integer" name="meta_inc_tiemposolucion" PathID="Grid1meta_inc_tiemposolucion" fieldSource="meta_inc_tiemposolucion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Image id="78" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imginc_tiempoasignacion" PathID="Grid1imginc_tiempoasignacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Image id="79" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imginc_tiemposolucion" PathID="Grid1imginc_tiemposolucion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Image id="80" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="imgefic_presup" PathID="Grid1imgefic_presup">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Label id="81" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="cumplenefic_presup" PathID="Grid1cumplenefic_presup" fieldSource="cumplen_efic_presup">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="82" fieldSourceType="DBColumn" dataType="Integer" html="False" generateSpan="False" name="totefic_presup" PathID="Grid1totefic_presup" fieldSource="tot_efic_presup">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="83" fieldSourceType="DBColumn" dataType="Text" html="True" generateSpan="False" name="efic_presup" PathID="Grid1efic_presup" fieldSource="efic_presup">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="84" fieldSourceType="DBColumn" dataType="Text" name="meta_efic_presup" PathID="Grid1meta_efic_presup" fieldSource="meta_efic_presup">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="69"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="85" dataType="Integer" defaultValue="0" designDefaultValue="0" parameterSource="s_id_proveedor" parameterType="URL" variable="s_id_proveedor"/>
				<SQLParameter id="86" dataType="Integer" defaultValue="0" designDefaultValue="0" parameterSource="s_id_periodo" parameterType="URL" variable="s_id_periodo"/>
				<SQLParameter id="87" dataType="Text" parameterSource="s_opt_slas" parameterType="URL" variable="s_opt_slas"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="TableroNiveles.php" forShow="True" url="TableroNiveles.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="TableroNiveles_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
