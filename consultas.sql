select COUNT(*) from l_calificacion_incidentes_AUT_SAT
  select COUNT(*) from l_calificacion_rs_AUT_SAT  
  select COUNT(*) from l_detalle_eficiencia_presupuestal_SAT
  select COUNT(*) from l_detalle_medicion_apertura_SAT
  select COUNT(*) from l_detalle_medicion_cierre_SAT  
  select COUNT(*) from l_detalle_medicion_inc_SAT
  
    
   select * from l_calificacion_incidentes_AUT_SAT
  select * from l_calificacion_rs_AUT_SAT  
  select * from l_detalle_eficiencia_presupuestal_SAT
  select * from l_detalle_medicion_apertura_SAT
  select * from l_detalle_medicion_cierre_SAT  
  select * from l_detalle_medicion_inc_SAT
  
  /*
  /****** Script for SelectTopNRows command from SSMS  *****/
  select COUNT(*) from l_calificacion_incidentes_AUT
  select COUNT(*) from l_calificacion_rs_AUT  
  select COUNT(*) from l_detalle_eficiencia_presupuestal
  select COUNT(*) from l_detalle_medicion_apertura
  select COUNT(*) from l_detalle_medicion_cierre  
  select COUNT(*) from l_detalle_medicion_inc
  
   select * from l_calificacion_incidentes_AUT where id_periodo=30 --6 and id_periodo>29
  select max(fecha_registro) from l_calificacion_rs_AUT  where id_periodo=30 
  select max(fecha_registro) from l_detalle_eficiencia_presupuestal where id_periodo=30 
  select * from l_detalle_medicion_apertura where id_periodo=29 and id_proveedor=1
  select * from l_detalle_medicion_cierre  
  select * from l_detalle_medicion_inc
  
  */