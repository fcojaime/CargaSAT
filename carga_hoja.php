	<?php
  
  //*****empieza la validación del contenido del archivo

    $datosLayout=obtenDatosLayout($id_layout);           
    $definicion_campos=ObtenDefinicion_campos($id_layout,$datosLayout[4]);
    $num_columnas_layout=count($definicion_campos);
    // datos de usuario y transaccion
    $nom_tabla =$datosLayout[5]; //"tabla_layout1";
    $num_rows_descartar=$datosLayout[6]; 
    $num_hoja=$datosLayout[3]; 
    $leyenda=$datosLayout[7]; 
   
    //construyo un arreglo vacio con el num de campos del detalle
    //for($n=0; $n< $num_columnas_layout; $n++)
    //	$validaciones[$n]="";
      
      $validaciones[0]="";
        $validaciones[1]=null; 
	            		       	
			if ( $num_hoja<$sheetCount)
			{
			$sheet = $objPHPExcel->getSheet( $num_hoja);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
		  //$cadenaLabel= "<div id=$nlayout class='tabbertab' >  <h2>$leyenda </h2> <table border=1 width='90%'>";
      $cadenaLabel= "<table border=1 width='90%'>";
			$cadena_divpanel="<div id=$nlayout class='tabbertab' >  <h2>$leyenda </h2>";
      $max_columnas=0;
			$columna=0; 		
			 
			$cadiniSQL="insert into $nom_tabla  values ($id_registro,$id_usuario, $id_proveedor, $fecha_registro,'P',$id_periodo, '$tipo_carga', $num_carga, '$opt_slas' ";
			$cadValores=""; 
			$errores="NO"; 
			$num_vacios=1; 	//se inicializa la variable
				
			for ($row =$num_rows_descartar; $row <= $highestRow; $row++) {
			     //if( $num_vacios==0) break;
			    //  Read a row of data into an array
			    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
			    NULL, TRUE, FALSE);
			     $cadenaLabel.= "<tr>" ;
			    $cols=0;
			    $errores_datos="NO";   
			    
			    if ($row <= $num_rows_descartar) {  //num_cols_descartar 		    
			       $cadenaLabel.= "<td> $contador</td>" ;
			       foreach($rowData[0] as $k=>$v) {                     
			          $v=utf8_decode($v);
                $cadenaLabel.= "<td><strong>$v</strong></td>" ;
			          $cols++;             
			       }			       
			      //echo"</tr>" ;
			    }
			    else {
            //valida que el archivo tengas las columnas necesarias
           echo "<br> num_columnas_layout  $num_columnas_layout, num cols excel ". count($rowData[0]);
           if($num_columnas_layout > count($rowData[0]) ) //ojo 
            {
                $errores_datos="SI"; 
                $NewRecord1->Errors->addError($cadFormatoRedini."El número de columnas de la hoja de $leyenda no coincide con el layout.".$cadFormatofin);
			          $erroresGeneral="SI";	 
                break;
            }
          
          
			    	if ( $contador=="")  $contador=1;
			      $num_de_columna=0;
			      $columna=0; 
			      $cadValores="";    
			       //echo"<tr>" ;   
			       ///
			       
			      $arr_tempo=array_chunk( $rowData[0], $num_columnas_layout);
			     
             $resultado_int = array_intersect($arr_tempo[0],$validaciones);
             //var_dump($resultado_int);
            $num_vacios=count($resultado_int );
            
			      if( $num_vacios==$num_columnas_layout)	{
			          	
				     		 break;
			          }
			          //
			        $cadenaLabel.= "<td> $contador</td>" ;
			      foreach($rowData[0] as $k=>$v) { 
			             // var_dump($v);
			          if ($cols<$num_columnas_layout)   {  
                  //$NewRecord1->Errors->addError("antes de entrar a valida campo ");  
                  //echo "a ntes de valida <br>";   
			            $validacionCelda=validaCampo($v,$columna+1,$definicion_campos);
                  //if ($contador<2)
                    //var_dump($validacionCelda);
                    //$NewRecord1->Errors->addError("valor orig $v , valida cero ".$validacionCelda[0].", valida dos ".$validacionCelda[2]);
                  
			            if ($validacionCelda[0]==1) {
			              if ($validacionCelda[1]==" null ") $validacionCelda[1]="&nbsp;0";
			              if (strlen($validacionCelda[1])>150) $cad_ancho_col=" whidth='40%'' "; else $cad_ancho_col=" "; 
                    $cadenaLabel.= "<td  $cad_ancho_col>".$validacionCelda[1]."  </td>" ;
			              $cadValores=$cadValores.",".$validacionCelda[2]  ;
			            }
			            else {
			              $cadenaLabel.= "<td><strong><font color='red'>$validacionCelda[1]</font</strong></td>" ;
			              $errores_datos="SI"; 
			              $errores="SI";	
                    $erroresGeneral="SI";	             		              
			            }
			           
			            $columna++; 
			            $cols++; 
			            $cad_sql=""; 
			        }
			      } //foreach
			    }//else row <= $num_rows_descartar
		
			   $cadenaLabel.="</tr>" ;   //$cadSQLcompleta
          $contador++; 
			    if( $errores_datos=="NO" && $row > $num_rows_descartar)  { //$datosLayout[6]				   
             $cadSQLcompleta= $cadiniSQL." , ".($contador-1)." ".$cadValores.")";
			   		  // if ($contador<=2)
			          // $NewRecord1->Errors->addError($cadSQLcompleta);
              
					   $conx_xls->query($cadSQLcompleta);
             //var_dump($conx_xls);
					   if($conx_xls->Errors->Count()!=0)
						    $cadenaLabel.= "No se pudieron guardar los datos en la base";
			    }
			    
			    if ($max_columnas<$cols)   $max_columnas=$cols ;
			}
			 $cadenaLabel.= "</table>";
			 $cadenaLabel=$cadena_divpanel."<br><strong>El resultado de la validacion de ".($contador-1)." registros en el archivo es la siguiente : </strong> ".$cadenaLabel."</div>";
			  if( $errores=="SI" )
			  {   
            $erroresGeneral="SI";              
			      $NewRecord1->id_reg_ok->SetValue(0);
			      $cadSQLcompleta ="delete from  $nom_tabla where id_registro=$id_registro and id_usuario=$id_usuario";
			      $conx_xls->query($cadSQLcompleta);
			      $num_erro=$conx_xls->Errors->Count();
			     	if ( $num_erro>1){
			     		$cadenaLabel.= "<br>No se pudieron eliminar los datos temporales";
			    	}
			     	else  {
             $contenido_label2_ant= $NewRecord1->Label2->GetValue();
             $NewRecord1->Label2->SetValue( $contenido_label2_ant."<br> <strong>Los valores marcados en rojo indican que hubo errores en la informacion de $leyenda</strong> ");
			       $NewRecord1->Errors->addError($cadFormatoRedini ."Los valores marcados en rojo indican que hubo errores en la información de $leyenda".$cadFormatofin);
				 	
			     	 	//$NewRecord1->Label2->SetValue( );
                //$cadenaLabel.= //"<br> <strong>Los valores marcados en rojo indican que hubo errores en la informacion<br>Por favor corrija los datos y vuelva a cargar el archivo</strong> ";
			      }
			     $NewRecord1->Aplicar->Visible=false;
			    
			  }
			  else {
			  	 $contador--;
			     // ojo$NewRecord1->Label2->SetValue("<br><strong>Se validaron $contador registros de la tabla $nom_tabla <br>Oprima el boton de Aplicar para guardar la informacion en la base de datos </strong> ");
			  	  $NewRecord1->id_reg_ok->SetValue($id_registro);
			  
			  
			  }
			  $contenido_label_ant= $NewRecord1->Label1->GetValue();
        $NewRecord1->Label1->SetValue( $contenido_label_ant.$cadenaLabel);
			 

		     	//***********termina la validación	 
			}
			else 
			{
				 $NewRecord1->Errors->addError($cadFormatoRedini."El archivo seleccionado no contiene las hojas que requiere el Layout. <br>Seleccione un archivo que contenga la hoja ".$num_hoja.$cadFormatofin);
			}		
	   
     ?>