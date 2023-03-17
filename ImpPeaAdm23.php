<?php

include('clases/2089.oxd');
error_reporting(E_ALL);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
ini_set('date.timezone','America/Guayaquil'); 


$IdPea=$_REQUEST['IdPea'];
$unidadesTxt = $_REQUEST["unidadesTxt"];
$Apertura = $_REQUEST["Apertura"];
$cabccera = $_REQUEST["cab"];
$bbiblioteca = $_REQUEST["bbiblioteca"];
$unidadCurr = $_REQUEST["unidadCurr"];
$Metodologgia = $_REQUEST["Metodologgia"];
$prac = $_REQUEST["prac"];


		if($Apertura!='')
		{

			$consulta3 = " select * from aperturas where Id= '".$Apertura."'  ";
			$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 0");
			while ($row2 = mysqli_fetch_array( $resultado3 ))		
			{
				$carrape=$row2['Carrera'];
				$periape=$row2['Periodo'];
				$Mallaape=$row2['Malla'];
				$Asignaturaape=$row2['Asignatura'];
				$Profesorape=$row2['Profesor'];				
			}	



			$IdPea=0;
			$consulta3 = " select IdPea from peacabecera where Carrera= '".$carrape."' and Periodo= '".$periape."' and 
			Asignatura= '".$Asignaturaape."' and Docente= '".$Profesorape."' and Malla='".$Mallaape."' ";
			$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 1");
			while ($row2 = mysqli_fetch_array( $resultado3 ))		
			{
				$IdPea=$row2['IdPea'];
			}


			if($IdPea==0)
			{
				$consulta3 = " select * from aperturas where Carrera= '".$carrape."' and Periodo= '".$periape."' and 
			Asignatura= '".$Asignaturaape."' and Profesor= '".$Profesorape."' and Malla='".$Mallaape."'  ";
				$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 2");
				while ($row2 = mysqli_fetch_array( $resultado3 ))		
				{
					$carrape=$row2['Carrera'];
					$periape=$row2['Periodo'];
					$Mallaape=$row2['Malla'];
					$Asignaturaape=$row2['Asignatura'];
					$Profesorape=$row2['Profesor'];				
				}	
				
				$fdateh=date("Y-m-d");			
				
				$que = "INSERT INTO peacabecera (IdPea, Carrera, Periodo, Apertura, Malla, Asignatura, Docente, 
				Fecha, Descripcion, Objetivo, Competencia, MetodologiasAprendizaje, RecursosDidacticos, BibliografiaBasica,
				BibliografiaComplementaria, Webgrafia, Observacion) ";
				$que.= "VALUES ('0','".$carrape."','".$periape."','".$Apertura."','".$Mallaape."','".$Asignaturaape."','".$Profesorape."'
				,'".$fdateh."','','','','','','','','','' )";
				if (mysqli_query($conexion, $que))
				{
				} else {
					  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
				}	


				$IdPea=0;
				$consulta3 = " select IdPea from peacabecera where Carrera= '".$carrape."' and Periodo= '".$periape."' and 
			Asignatura= '".$Asignaturaape."' and Docente= '".$Profesorape."' and Malla='".$Mallaape."'   ";
				$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 8");
				while ($row2 = mysqli_fetch_array( $resultado3 ))		
				{
					$IdPea=$row2['IdPea'];
				}

				$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm2323&IdPea=".$IdPea;
				echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
						
				
				
			}

		}



		$consulta3 = " select * from peaunidadcurricular where IdPea= '".$IdPea."' order by Orden  ";
		$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 8");
		while ($row2 = mysqli_fetch_array( $resultado3 ))		
		{
			$IdUnidadCurricular=$row2['IdUnidadCurricular'];
			echo '<script>


			function myFunction'.$IdUnidadCurricular.'() {
				var x = document.getElementById("myDIV'.$IdUnidadCurricular.'");
				if (x.style.display === "none") {
					x.style.display = "block";
				} else {
					x.style.display = "none";
				}
			}


			</script>';
		}




			echo '<script>
			function myFunctionCabezera() {
				var x = document.getElementById("myDIVCabezera");
				if (x.style.display === "none") {
					x.style.display = "block";
				} else {
					x.style.display = "none";
				}
			}
			</script>';
			
			echo '<script>
			function myFunctionMetodologia() {
				var x = document.getElementById("myDIVMetodologia");
				if (x.style.display === "none") {
					x.style.display = "block";
				} else {
					x.style.display = "none";
				}
			}
			</script>';	


			echo '<script>
			function myFunctionPRAC() {
				var x = document.getElementById("myDIVPRAC");
				if (x.style.display === "none") {
					x.style.display = "block";
				} else {
					x.style.display = "none";
				}
			}
			</script>';				
			
			
			
			echo '<script>
			function myFunctionNuevaUnidad() {
				var x = document.getElementById("myDIVNuevaUnidad");
				if (x.style.display === "none") {
					x.style.display = "block";
				} else {
					x.style.display = "none";
				}
			}
			</script>';	


			echo '<script>
			function myFunctionBiblioteca() {
				var x = document.getElementById("myDIVBiblioteca");
				if (x.style.display === "none") {
					x.style.display = "block";
				} else {
					x.style.display = "none";
				}
			}
			</script>';				



	if(isset($_POST['enviarDES']))
	{
		$DescrpicionTxt = $_POST["DescrpicionTxt"];		
	
	
			$que = "UPDATE peacabecera SET Descripcion='".$DescrpicionTxt."' WHERE IdPea='".$IdPea."' ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}
	
	
	
	

	if(isset($_POST['enviarSISEVA']))
	{
		$DescrpicionTxt = $_POST["DescrpicionTxt"];		
	
	
			$que = "UPDATE peacabecera SET SistemaEvaluacion='".$DescrpicionTxt."' WHERE IdPea='".$IdPea."' ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}



	if(isset($_POST['enviarEVAAPRE']))
	{
		$EvidenciasAprendizajeTxt = $_POST["EvidenciasAprendizajeTxt"];		
	
	
			$que = "UPDATE peacabecera SET EvidenciasAprendizaje='".$EvidenciasAprendizajeTxt."' WHERE IdPea='".$IdPea."' ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}	
	
	
	
	
	
	
	
	
	
	
	
	if(isset($_POST['enviarOBJ']))
	{
		$ObjetivoTxt = $_POST["ObjetivoTxt"];		
	
	
			$que = "UPDATE peacabecera SET Objetivo='".$ObjetivoTxt."' WHERE IdPea='".$IdPea."' ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}




	
	if(isset($_POST['enviarTIPOPRAC']))
	{
		$TipoPracticaIndividualTxt = $_POST["TipoPracticaIndividualTxt"];	
		$TipoPracticaGrupalTxt = $_POST["TipoPracticaGrupalTxt"];			
		$TipoPracticaColectivaTxt = $_POST["TipoPracticaColectivaTxt"];		
	
			$que = "UPDATE peacabecera SET TipoPracticaIndividual='".$TipoPracticaIndividualTxt."', TipoPracticaGrupal='".$TipoPracticaGrupalTxt."', TipoPracticaColectiva='".$TipoPracticaColectivaTxt."' WHERE IdPea='".$IdPea."' ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}






	if(isset($_POST['enviarFUNASIG']))
	{
		$FuncionAsignatura1Txt = $_POST["FuncionAsignatura1Txt"];	
		$FuncionAsignatura2Txt = $_POST["FuncionAsignatura2Txt"];			
		$FuncionAsignatura3Txt = $_POST["FuncionAsignatura3Txt"];		
		$FuncionAsignatura4Txt = $_POST["FuncionAsignatura4Txt"];
		
			$que = "UPDATE peacabecera SET FuncionAsignatura1='".$FuncionAsignatura1Txt."', FuncionAsignatura2='".$FuncionAsignatura2Txt."', 
			FuncionAsignatura3='".$FuncionAsignatura3Txt."', FuncionAsignatura4='".$FuncionAsignatura4Txt."' WHERE IdPea='".$IdPea."' ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}





	if(isset($_POST['enviarAMBITO']))
	{
		$AmbitoCognitivoTxt = $_POST["AmbitoCognitivoTxt"];	
		$AmbitoProcedimentalTxt = $_POST["AmbitoProcedimentalTxt"];			
		$AmbitoActitudinalTxt = $_POST["AmbitoActitudinalTxt"];		
		
			$que = "UPDATE peacabecera SET AmbitoCognitivo='".$AmbitoCognitivoTxt."', AmbitoProcedimental='".$AmbitoProcedimentalTxt."', 
			AmbitoActitudinal='".$AmbitoActitudinalTxt."' WHERE IdPea='".$IdPea."' ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}	
	
	
	
	
	
	
	if(isset($_POST['enviarUnidadOrden']))
	{
		$TxtUnidadOrden = $_POST["TxtUnidadOrden"];		
		$IdUnidadCurricular = $_POST["IdUnidadCurricular"];			
		if($TxtUnidadOrden!='')
		{
			$que = "UPDATE peaunidadcurricular SET Orden='".$TxtUnidadOrden."' WHERE IdUnidadCurricular='".$IdUnidadCurricular."' ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
		}
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea."&unidadCurr=".$IdUnidadCurricular;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}
	

	
	
	
	
	if(isset($_POST['enviarMETAPRE']))
	{
		$DescrpicionMETAPRETxt = $_POST["DescrpicionMETAPRETxt"];		
	
		if($DescrpicionMETAPRETxt!="")
		{
			$que = "UPDATE peacabecera SET MetodologiasAprendizaje='".$DescrpicionMETAPRETxt."' WHERE IdPea='".$IdPea."'  ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
		}	
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&Metodologgia=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";							
	}		
	
	
	
	






	if(isset($_POST['enviarRECDID']))
	{
		$DescrpicionRECDIDTxt = $_POST["DescrpicionRECDIDTxt"];		
	
		if($DescrpicionRECDIDTxt!="")
		{
			$que = "UPDATE peacabecera SET RecursosDidacticos='".$DescrpicionRECDIDTxt."' WHERE IdPea='".$IdPea."'  ";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error desc : " . $que . "<br>" . mysqli_error($conexion);
			}		
		}	
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&Metodologgia=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";							
	}










	if(isset($_POST['enviarUnidad']))
	{
		$NueUnidadTxt = $_POST["NueUnidadTxt"];
		$ResultadosUnidadTxt = $_POST["ResultadosUnidadTxt"];		
		$OrdenUnidad = $_POST["OrdenUnidad"];	
	
		if($NueUnidadTxt!="" && $ResultadosUnidadTxt!="")
		{

			$que = "INSERT INTO peaunidadcurricular (IdUnidadCurricular, IdPea, NombreUnidad, ResultadoAprendizaje, Observacion, MetodologiasAprendizaje, RecursosDidacticos, Orden) ";
			$que.= "VALUES ('0','".$IdPea."','".$NueUnidadTxt."','".$ResultadosUnidadTxt."','','','','".$OrdenUnidad."' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
			
			$IdUnidadCurricular=0;
			$consulta3 = " select IdUnidadCurricular from peaunidadcurricular where IdPea= '".$IdPea."' ";
			$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 1");
			while ($row2 = mysqli_fetch_array( $resultado3 ))		
			{
				$IdUnidadCurricular=$row2['IdUnidadCurricular'];
			}			
			
			
		}	
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&IdPea=".$IdPea."&unidadCurr=".$IdUnidadCurricular." ";
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}






	if(isset($_POST['enviarPRAC']))
	{
		$ActividadPraTxt = $_POST["ActividadPraTxt"];
		$DescripcionPraTxt = $_POST["DescripcionPraTxt"];				
	
		if($ActividadPraTxt!="" && $DescripcionPraTxt!="")
		{

			$que = "INSERT INTO PEAActividadesPracticas (`IdActividadesPracticas`, `IdPea`, `Actividad`, `Descripcion`) ";
			$que.= "VALUES ('0','".$IdPea."','".$ActividadPraTxt."','".$DescripcionPraTxt."' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
		}	
		

			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&prac=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}







	if(isset($_POST['enviarRES']))
	{
		$ResultadoTxt = $_POST["ResultadoTxt"];
		$ActividadEvTxt = $_POST["ActividadEvTxt"];	
		$EvidenciaTxt = $_POST["EvidenciaTxt"];			
	
		if($ResultadoTxt!="" && $EvidenciaTxt!="")
		{

			$que = "INSERT INTO pearesultados (`IdResultado`, `IdPea`, `Resultado`, `Evidencia`, `Actividad`, `Observacion`) ";
			$que.= "VALUES ('0','".$IdPea."','".$ResultadoTxt."','".$EvidenciaTxt."','".$ActividadEvTxt."','' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
		}	
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}
	
	
	
	
	

	if(isset($_POST['enviarBIBBAS']))
	{
		$DescripcionTxt = $_POST["DescripcionTxt"];
		$CodigoTxt = $_POST["CodigoTxt"];		
	
		if($DescripcionTxt!="" && $CodigoTxt!="")
		{

			$que = "INSERT INTO peabiblioteca (`IdPeaBiblioteca`, `IdPea`, `Descripcion`, `CodigoSanIsidro`, `Tipo`) ";
			$que.= "VALUES ('0','".$IdPea."','".$DescripcionTxt."','".$CodigoTxt."','ba' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
		}	
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&IdPea=".$IdPea."&bbiblioteca=c";
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}
		



	if(isset($_POST['enviarBIBCOM']))
	{
		$DescripcionTxt = $_POST["DescripcionTxt"];
		$CodigoTxt = $_POST["CodigoTxt"];		
	
		if($DescripcionTxt!="")
		{

			$que = "INSERT INTO peabiblioteca (`IdPeaBiblioteca`, `IdPea`, `Descripcion`, `CodigoSanIsidro`, `Tipo`) ";
			$que.= "VALUES ('0','".$IdPea."','".$DescripcionTxt."','".$CodigoTxt."','com' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
		}	
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&IdPea=".$IdPea."&bbiblioteca=c";
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}	
	
	
	
	
	if(isset($_POST['enviarBIBWEB']))
	{
		$DescripcionTxt = $_POST["DescripcionTxt"];		
	
		if($DescripcionTxt!="" )
		{

			$que = "INSERT INTO peabiblioteca (`IdPeaBiblioteca`, `IdPea`, `Descripcion`, `CodigoSanIsidro`, `Tipo`) ";
			$que.= "VALUES ('0','".$IdPea."','".$DescripcionTxt."','','web' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
		}	
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&IdPea=".$IdPea."&bbiblioteca=c";
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}		
	
	
	
	
	
	
	
	
	
	if(isset($_POST['enviarCOMP']))
	{
		$competenciaTxt = $_POST["competenciaTxt"];		
	
		if($competenciaTxt!="")
		{

			$que = "INSERT INTO peacompetencia (`Id`, `IdPea`, `Competencia`) ";
			$que.= "VALUES ('0','".$IdPea."','".$competenciaTxt."' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
		}	
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['elimCONTEN']))
	{
		$idCONTEN = $_REQUEST["idCONTEN"];			
	


			$que = " DELETE FROM peaactividades WHERE IdPeaContenido='".$idCONTEN."'";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}


			$que = " DELETE FROM peacontenido WHERE IdPeaContenido='".$idCONTEN."'";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}	
	
	
	
	
	
	
	if(isset($_REQUEST['elimUnidad']))
	{
		$idUnidad = $_REQUEST["idUnidad"];			
	


			$que = " DELETE FROM peaactividades WHERE IdUnidadCurricular='".$idUnidad."'";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}


			$que = " DELETE FROM peacontenido WHERE  IdUnidadCurricular='".$idUnidad."'";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
			
			$que = " DELETE FROM peaunidadcurricular WHERE IdUnidadCurricular='".$idUnidad."'";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}			
			
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&IdPea=".$IdPea."&unidadCurr=".$idUnidad." ";
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}		
	
	
	
	
	
	
	
	if(isset($_REQUEST['elimPRAC']))
	{
		$idactpra = $_REQUEST["idactpra"];			
	


			$que = " DELETE FROM PEAActividadesPracticas WHERE IdActividadesPracticas='".$idactpra."'";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&prac=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}	
	
	
	
	
	
	
	
	



	if(isset($_REQUEST['elimCom']))
	{
		$idcome = $_REQUEST["idcome"];			
	
		echo $idcome;
	


			$que = " DELETE FROM peacompetencia WHERE Id='".$idcome."'";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";		
					
	}
	
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['elimRES']))
	{
		$idres = $_REQUEST["idres"];			

			$que = " DELETE FROM pearesultados WHERE IdResultado='".$idres."'";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}

			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&cab=c&IdPea=".$IdPea;
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";					
	}
	
	
	
	
	if(isset($_REQUEST['elimBIBBAS']))
	{
		$idBIBBAS = $_REQUEST["idBIBBAS"];			

		$que = " DELETE FROM peabiblioteca WHERE IdPeaBiblioteca='".$idBIBBAS."'";
		if (mysqli_query($conexion, $que))
		{
		} else {
			  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
		}

		$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&IdPea=".$IdPea."&bbiblioteca=c";
		echo "<script type='text/javascript'>window.location='$redirect_url';</script>";					
	}	
	
	
	
	
	
	
	



	if(isset($_POST['enviar']))
	{
		
		$TituloTxt = $_POST["TituloTxt"];		
		$ContenidoTxt = $_POST["ContenidoTxt"];
		$HorasAsistenciajeTxt = $_POST["HorasAsistenciajeTxt"];
		$HorasPracticoTxt = $_POST["HorasPracticoTxt"];
		$HorasExperimentacionTxt = $_POST["HorasExperimentacionTxt"];
		$HorasAprendizajeAutonomoTxt = $_POST["HorasAprendizajeAutonomoTxt"];
		
		$AsistenciaDocenteTxt = $_POST["AsistenciaDocenteTxt"];
		$AplicacionExperimentacionTxt = $_POST["AplicacionExperimentacionTxt"];
		$AprendizajeAutonomoTxt = $_POST["AprendizajeAutonomoTxt"];
		
		$AsistenciaDocenteEvaluacionTxt = $_POST["AsistenciaDocenteEvaluacionTxt"];
		$AplicacionExperimentacionEvaluacionTxt = $_POST["AplicacionExperimentacionEvaluacionTxt"];
		$AprendizajeAutonomoEvaluacionTxt = $_POST["AprendizajeAutonomoEvaluacionTxt"];		
	
		
		$que = "INSERT INTO peacontenido (`IdPeaContenido`, `IdUnidadCurricular`, `IdPea`, `Contenido`, `HoraAsistencia`, `HoraPractica`, `HoraExperimentacion`, 
		`HoraAutonoma`, `Observacion`, `Titulo` ) ";
		$que.= "VALUES ('0','".$unidadesTxt."','".$IdPea."','".$ContenidoTxt."','".$HorasAsistenciajeTxt."','".$HorasPracticoTxt."','".$HorasExperimentacionTxt."',
		'".$HorasAprendizajeAutonomoTxt."','','".$TituloTxt."' )";
		if (mysqli_query($conexion, $que))
		{
		} else {
			  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
		}

		echo $que."<br><br>";


		$IdPeaContenido=0;
		$consulta3 = " select IdPeaContenido from peacontenido where IdPea= '".$IdPea."' order by IdPeaContenido desc limit 1  ";
		$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
		while ($row2 = mysqli_fetch_array( $resultado3 ))		
		{
			$IdPeaContenido=$row2['IdPeaContenido'];
		}
		

		
			$que = "INSERT INTO peaactividades (`IdPeaActividad`, `IdPeaContenido`, `IdUnidadCurricular`, `IdPea`, `Actividad`, `Evaluacion`, `Observacion`, `Tipo`) ";
			$que.= "VALUES ('0','".$IdPeaContenido."','".$unidadesTxt."','".$IdPea."'
			,'".$AsistenciaDocenteTxt."','".$AsistenciaDocenteEvaluacionTxt."','','cla' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}
			
			
		echo $que."<br><br>";
		

			$que = "INSERT INTO peaactividades (`IdPeaActividad`, `IdPeaContenido`, `IdUnidadCurricular`, `IdPea`, `Actividad`, `Evaluacion`, `Observacion`, `Tipo`) ";
			$que.= "VALUES ('0','".$IdPeaContenido."','".$unidadesTxt."','".$IdPea."',
			'".$AplicacionExperimentacionTxt."','".$AplicacionExperimentacionEvaluacionTxt."','','exp' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}


			$que = "INSERT INTO peaactividades (`IdPeaActividad`, `IdPeaContenido`, `IdUnidadCurricular`, `IdPea`, `Actividad`, `Evaluacion`, `Observacion`, `Tipo`) ";
			$que.= "VALUES ('0','".$IdPeaContenido."','".$unidadesTxt."','".$IdPea."',
			'".$AprendizajeAutonomoTxt."','".$AprendizajeAutonomoEvaluacionTxt."','','aut' )";
			if (mysqli_query($conexion, $que))
			{
			} else {
				  echo "Error 1 : " . $que . "<br>" . mysqli_error($conexion);
			}

			
			$redirect_url = "https://doc.sanisidro.edu.ec/imprimir.php?tip=iPeaAdm23&IdPea=".$IdPea."&unidadCurr=".$unidadesTxt." ";
			echo "<script type='text/javascript'>window.location='$redirect_url';</script>";			
			
			
			
			

	}
















$consulta3 = " select * from peacabecera where IdPea= '".$IdPea."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$asig=$row2['Asignatura'];
	$peri=$row2['Periodo'];
	$Docente=$row2['Docente'];
	$Carrera=$row2['Carrera'];	
	$Malla=$row2['Malla'];
	$ObservacionCabecera=$row2['Observacion'];	
	$BibliografiaBasica=$row2['BibliografiaBasica'];	
	$BibliografiaComplementaria=$row2['BibliografiaComplementaria'];	
	$Webgrafia=$row2['Webgrafia'];
	$Apertura=$row2['Apertura'];
	$Fecha=$row2['Fecha'];
	
	$TipoPracticaIndividual=$row2['TipoPracticaIndividual'];	
	$TipoPracticaGrupal=$row2['TipoPracticaGrupal'];	
	$TipoPracticaColectiva=$row2['TipoPracticaColectiva'];	
	$FuncionAsignatura1=$row2['FuncionAsignatura1'];
	$FuncionAsignatura2=$row2['FuncionAsignatura2'];
	$FuncionAsignatura3=$row2['FuncionAsignatura3'];	
	$FuncionAsignatura4=$row2['FuncionAsignatura4'];	
	$AmbitoCognitivo=$row2['AmbitoCognitivo'];
	$AmbitoProcedimental=$row2['AmbitoProcedimental'];	
	$AmbitoActitudinal=$row2['AmbitoActitudinal'];
	$EvidenciasAprendizaje=$row2['EvidenciasAprendizaje'];
	$SistemaEvaluacion=$row2['SistemaEvaluacion'];	
	$MetodologiasAprendizaje=$row2['MetodologiasAprendizaje'];	
	$RecursosDidacticos=$row2['RecursosDidacticos'];
	
}

$id_docente_jefe_area="";
$consulta3 = " select  	id_docente_jefe_area from aperturas where Id= '".$Apertura."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$id_docente_jefe_area=$row2['id_docente_jefe_area'];		
}


$dirdocnom="";
$consulta3 = " select Nombre from docente where Id= '".$id_docente_jefe_area."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$dirdocnom=$row2['Nombre'];		
}






$asignom="";
$consulta3 = " select Nombre from asignaturas where Id= '".$asig."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$asignom=$row2['Nombre'];		
}


$docnom="";
$consulta3 = " select Nombre from docente where Id= '".$Docente."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$docnom=$row2['Nombre'];		
}


$carrnom="";
$dircarr="";
$consulta3 = " select Nombre, DirectorCarrera from carreras where Id= '".$Carrera."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$carrnom=$row2['Nombre'];
	$dircarr=$row2['DirectorCarrera'];	
}



$dircarnom="";
$consulta3 = " select Nombre from docente where Id= '".$dircarr."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$dircarnom=$row2['Nombre'];		
}


$Pernom="";
$Semanas=0;
$consulta3 = " select Nombre, Semanas from periodoslectivos where Id= '".$peri."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$Pernom=$row2['Nombre'];	
	$Semanas=$row2['Semanas'];		
}




$asigCodigo="";
$Eje="";
$Creditos="";
$Nivel="";
$Prerequisito1="";
$Prerequisito2="";
$Prerequisito3="";
$Prerequisito4="";
$Corequisito1="";
$Corequisito2="";

$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$asig."' and IdMalla= '".$Malla."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$asigCodigo=$row2['Codigo'];
	$Eje=$row2['Eje'];
	$Creditos=$row2['Creditos'];
	$Nivel=$row2['Nivel'];
	
	$Prerequisito1=$row2['Prerequisito1'];
	$Prerequisito2=$row2['Prerequisito2'];
	$Prerequisito3=$row2['Prerequisito3'];
	$Prerequisito4=$row2['Prerequisito4'];
	
	$Prerequisito5=$row2['Prerequisito5'];
	$Prerequisito6=$row2['Prerequisito6'];
	$Prerequisito7=$row2['Prerequisito7'];

	
	
	
	$Corequisito1=$row2['Corequisito1'];
	$Corequisito2=$row2['Corequisito2'];

}

$asigCodigop1="";
$asignom1="";
if($Prerequisito1!="")
{
	$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$Prerequisito1."' and IdMalla= '".$Malla."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asigCodigop1=$row2['Codigo'];
	}
	
	$consulta3 = " select Nombre from asignaturas where Id= '".$Prerequisito1."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asignom1=$row2['Nombre'];		
	}
}

$asigCodigop2="";
$asignom2="";
if($Prerequisito2!="")
{
	$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$Prerequisito2."' and IdMalla= '".$Malla."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asigCodigop2=$row2['Codigo'];
	}
	
	$consulta3 = " select Nombre from asignaturas where Id= '".$Prerequisito2."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asignom2=$row2['Nombre'];		
	}
}


$asigCodigop3="";
$asignom3="";
if($Prerequisito3!="")
{
	$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$Prerequisito3."' and IdMalla= '".$Malla."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asigCodigop3=$row2['Codigo'];
	}
	
	$consulta3 = " select Nombre from asignaturas where Id= '".$Prerequisito3."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asignom3=$row2['Nombre'];		
	}
}




$asigCodigop4="";
$asignom4="";
if($Prerequisito4!="")
{
	$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$Prerequisito4."' and IdMalla= '".$Malla."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asigCodigop4=$row2['Codigo'];
	}
	
	$consulta3 = " select Nombre from asignaturas where Id= '".$Prerequisito4."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asignom4=$row2['Nombre'];		
	}
}


$asigCodigop5="";
$asignom5="";
if($Prerequisito5!="")
{
	$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$Prerequisito5."' and IdMalla= '".$Malla."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asigCodigop5=$row2['Codigo'];
	}
	
	$consulta3 = " select Nombre from asignaturas where Id= '".$Prerequisito5."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asignom5=$row2['Nombre'];		
	}
}





$asigCodigop6="";
$asignom6="";
if($Prerequisito6!="")
{
	$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$Prerequisito6."' and IdMalla= '".$Malla."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asigCodigop6=$row2['Codigo'];
	}
	
	$consulta3 = " select Nombre from asignaturas where Id= '".$Prerequisito6."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asignom6=$row2['Nombre'];		
	}
}




$asigCodigop7="";
$asignom7="";
if($Prerequisito7!="")
{
	$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$Prerequisito7."' and IdMalla= '".$Malla."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asigCodigop7=$row2['Codigo'];
	}
	
	$consulta3 = " select Nombre from asignaturas where Id= '".$Prerequisito7."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asignom7=$row2['Nombre'];		
	}
}










///

$asigCodigoco1="";
$asignomco1="";
if($Corequisito1!="")
{
	$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$Corequisito1."' and IdMalla= '".$Malla."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asigCodigoco1=$row2['Codigo'];
	}
	
	$consulta3 = " select Nombre from asignaturas where Id= '".$Corequisito1."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asignomco1=$row2['Nombre'];		
	}
}



$asigCodigoco2="";
$asignomco2="";
if($Corequisito2!="")
{
	$consulta3 = " select * from mallasasignaturas where IdAsignatura= '".$Corequisito2."' and IdMalla= '".$Malla."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asigCodigoco2=$row2['Codigo'];
	}
	
	$consulta3 = " select Nombre from asignaturas where Id= '".$Corequisito2."'  ";
	$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row2 = mysqli_fetch_array( $resultado3 ))		
	{
		$asignomco2=$row2['Nombre'];		
	}
}






$Ejenom="";
$consulta3 = " select Nombre from eje where Id= '".$Eje."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$Ejenom=$row2['Nombre'];	
}

$nivelnom="";
if($Nivel=='1')
{
	$nivelnom="Primero";
}
if($Nivel=='2')
{
	$nivelnom="Segundo";
}
if($Nivel=='3')
{
	$nivelnom="Tercero";
}
if($Nivel=='4')
{
	$nivelnom="Cuarto";
}
if($Nivel=='5')
{
	$nivelnom="Quinto";
}
if($Nivel=='6')
{
	$nivelnom="Sexto";
}
if($Nivel=='7')
{
	$nivelnom="Septimo";
}





$HoraAprendizaje=$Creditos*$Semanas;
$HoraExperimental=$HoraAprendizaje/2;
$HoraAutonoma=$HoraAprendizaje;
$HoraAutonomafinal=$HoraAutonoma;
$totalHoras=$HoraAprendizaje+$HoraExperimental+$HoraAutonoma;

$muestracabecera="display:none;";
if($cabccera=="c")
{
	$muestracabecera="";
}

echo '<center>

<div style="width:80%;" >




		
		<table border="1" width="100%" style=" border: 2px solid #000; text-align:center;  " >
			
			<TR>
				<TD ALIGN=center ROWSPAN=2 COLSPAN=2><img src="https://doc.sanisidro.edu.ec/images/logoblanco2.png" width="120px"  /></TD>
				<TD><b>INSTITUTO SUPERIOR UNIVERSITARIO SAN SIDRO</b></TD>
				<TD>CODIGO DEL DOCUMENTO</TD>
			</TR>
			
			<TR>
				<TD>PROGRAMA DE ESTUDIO DE ASIGNATURA (PEA)</TD>
				<TD>'.$Fecha.'</TD>
			</TR>			
			
		</table>
	
	

	<br>
	
	<button onclick="myFunctionCabezera()">Cabecera</button>

	<div id="myDIVCabezera" style="border:0px solid black; '.$muestracabecera.' ">	
	
	

	<table border="2" style=" width:100%; margin-top:1%; border-collapse: collapse;   "  >

		<tr bgcolor="#2f5496" >
			<td colspan="4" style="border: 2px solid;  " >
				<b><font color="#ffffff">1. Información General</font></b> 
			</td>
		</tr>
		
		<tr >
			<td colspan="2" width="50%" style="border: 2px solid;  " >
				<b>A. Código de la Asignatura:</b>  '.$asigCodigo.'
			</td>
			<td colspan="2" style="border: 2px solid;  ">
				<b>B. Asignatura:</b> '.$asignom.'
			</td>		
		</tr>


		<tr>
			<td colspan="2" width="50%" style="border: 2px solid;  ">
				<b>C. Carrera:</b> '.$carrnom.'
			</td>
			<td colspan="2" style="border: 2px solid;  ">
				<b>D. Unidad de organización curricular:</b> '.$Ejenom.'
			</td>		
		</tr>

		<tr>
			<td colspan="2" width="50%" style="border: 2px solid;  ">
				<b>E. Período Académico:</b>  '.$Pernom.'
			</td>
			<td  colspan="2" style="border: 2px solid;  ">
				<b>F. Nivel:</b> '.$nivelnom.'
			</td>
	
		</tr>
		

		<tr>
			<td colspan="2" style="border: 2px solid;  ">
				 <b>G. Docente Responsable:</b>  '.$docnom.'
			</td>			
			<td colspan="2" style="border: 2px solid;  ">
				<b> H. Créditos:</b>    '.$Creditos.' 
			</td>		

		</tr>	
		
		
		<tr>
			<td style="border: 2px solid;  ">
				<b>I. Total Horas:</b> '.$totalHoras.'
			</td>
			<td style="border: 2px solid;  ">
				<b>Horas de aprendizaje en contacto con docente:</b> '.$HoraAprendizaje.'
			</td>		
			<td style="border: 2px solid;  ">
				<b>Horas de aprendizaje práctico experimental:</b> '.$HoraExperimental.'
			</td>
			<td style="border: 2px solid;  " >
				<b>Horas de aprendizaje autónomo:</b> '.$HoraAutonoma.'
			</td>
		</tr>


		<tr>
			<td colspan="2" style="border: 2px solid;  ">
				<center><b>J. Prerrequisitos</b></center>
			</td>
			<td colspan="2" style="border: 2px solid;  ">
				<center><b>K. Correquisitos</b></center>
			</td>		
		</tr>
		
		
		<tr>
			<td style="border: 2px solid;  ">
				<center><b>Asignatura</b></center>
			</td>
			<td style="border: 2px solid;  ">
				<center><b>Còdigo</b></center>
			</td>		
			<td style="border: 2px solid;  ">
				<center><b>Asignatura</b></center>
			</td>
			<td style="border: 2px solid;  " >
				<center><b>Còdigo</b></center>
			</td>
		</tr>';		
		
		if($asigCodigop1!="" || $asigCodigoco1!="")
		{
			echo '<tr>
				<td style="border: 2px solid;  ">
					<center>'.$asigCodigop1.'</center>
				</td>
				<td style="border: 2px solid;  ">
					<center>'.$asignom1.'</center>
				</td>		
				<td style="border: 2px solid;  ">
					<center>'.$asigCodigoco1.'</center>
				</td>
				<td style="border: 2px solid;  " >
					<center>'.$asignomco1.'</center>
				</td>
			</tr>';				
		}
		
		if($asigCodigop2!="" || $asigCodigoco2!="")
		{
			echo '<tr>
				<td style="border: 2px solid;  ">
					<center>'.$asigCodigop2.'</center>
				</td>
				<td style="border: 2px solid;  ">
					<center>'.$asignom2.'</center>
				</td>		
				<td style="border: 2px solid;  ">
					<center>'.$asigCodigoco2.'</center>
				</td>
				<td style="border: 2px solid;  " >
					<center>'.$asignomco2.'</center>
				</td>
			</tr>';				
		}	


		if($asigCodigop3!="" )
		{
			echo '<tr>
				<td style="border: 2px solid;  ">
					<center>'.$asigCodigop3.'</center>
				</td>
				<td style="border: 2px solid;  ">
					<center>'.$asignom3.'</center>
				</td>		
				<td style="border: 2px solid;  ">
				</td>
				<td style="border: 2px solid;  " >
				</td>
			</tr>';				
		}

		if($asigCodigop4!="" )
		{
			echo '<tr>
				<td style="border: 2px solid;  ">
					<center>'.$asigCodigop4.'</center>
				</td>
				<td style="border: 2px solid;  ">
					<center>'.$asignom4.'</center>
				</td>		
				<td style="border: 2px solid;  ">
				</td>
				<td style="border: 2px solid;  " >
				</td>
			</tr>';				
		}

		if($asigCodigop5!="" )
		{
			echo '<tr>
				<td style="border: 2px solid;  ">
					<center>'.$asigCodigop5.'</center>
				</td>
				<td style="border: 2px solid;  ">
					<center>'.$asignom5.'</center>
				</td>		
				<td style="border: 2px solid;  ">
				</td>
				<td style="border: 2px solid;  " >
				</td>
			</tr>';				
		}		
		
		if($asigCodigop6!="" )
		{
			echo '<tr>
				<td style="border: 2px solid;  ">
					<center>'.$asigCodigop6.'</center>
				</td>
				<td style="border: 2px solid;  ">
					<center>'.$asignom6.'</center>
				</td>		
				<td style="border: 2px solid;  ">
				</td>
				<td style="border: 2px solid;  " >
				</td>
			</tr>';				
		}


		if($asigCodigop7!="" )
		{
			echo '<tr>
				<td style="border: 2px solid;  ">
					<center>'.$asigCodigop7.'</center>
				</td>
				<td style="border: 2px solid;  ">
					<center>'.$asignom7.'</center>
				</td>		
				<td style="border: 2px solid;  ">
				</td>
				<td style="border: 2px solid;  " >
				</td>
			</tr>';				
		}

		
		
	echo '
	</table>
	
	
	
		<form class="form-row mt-4"  id="formTIPOPRAC" name="formDES" method="post" action="" enctype="multipart/form-data"  >	
			<table border="1" style=" width:100%; margin-top:0%; border-collapse: collapse;   "  >
				<tr>
					<td bgcolor="#acb9ca"  colspan="7" style="border: 2px solid;  ">
						Tipo de práctica: (marque con una x)
					</td>
				</tr>		
			
				<tr>
					<th style="border: 2px solid;  ">
						Individual
					</th>
					<th style="border: 2px solid;  ">
						<input type="checkbox" name="TipoPracticaIndividualTxt" value="1" '; if($TipoPracticaIndividual==1) {echo 'checked="checked"';}  echo ' >
					</th>			
					<th  style="border: 2px solid;  ">
						Grupal
					</th>
					<th style="border: 2px solid;  ">
						<input type="checkbox" name="TipoPracticaGrupalTxt" value="1" '; if($TipoPracticaGrupal==1) {echo 'checked="checked"';}  echo ' >
					</th>			
					<th style="border: 2px solid;  " >
						Colectiva
					</th>
					<th style="border: 2px solid;  ">
						<input type="checkbox" name="TipoPracticaColectivaTxt" value="1" '; if($TipoPracticaColectiva==1) {echo 'checked="checked"';}  echo ' >
					</th>
				</tr>
				<tr>
					<td   colspan="7" style="border: 2px solid;  ">
						<center>
							<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
							<input type="hidden" id="enviarTIPOPRAC"  name="enviarTIPOPRAC"  value="enviarTIPOPRAC" >					
							<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
						</center>	
					</td>
				</tr>					
			</table>
		</form>	
	
	
				

					
			
	
			
		<form class="form-row mt-4"  id="formFUNASIG" name="formFUNASIG" method="post" action="" enctype="multipart/form-data"  >		
			<table border="2" style=" width:100%; margin-top:1%; border-collapse: collapse;   "  >

				<tr bgcolor="#2f5496" >
					<td colspan="4" style="border: 2px solid;  " >
						<font color="#ffffff"><b>2. Función de la Asignatura en la formación profesional</b>  (señalar la función /es que cumple la asignatura)</font>
					</td>
				</tr>
				
				<tr >
					<td colspan="2" width="70%" style="border: 2px solid;  " >
						<b>1. Contribuir directamente a la consecución del perfil de egreso</b>
					</td>
					<td colspan="2" style="border: 2px solid;  ">
						<input type="checkbox" name="FuncionAsignatura1Txt" value="1" '; if($FuncionAsignatura1==1) {echo 'checked="checked"';}  echo ' >
					</td>		
				</tr>	
				
				<tr >
					<td colspan="2" width="50%" style="border: 2px solid;  " >
						<b>2. Aportar a las bases cognitivas requeridas para el aprendizaje en otras asignaturas</b>
					</td>
					<td colspan="2" style="border: 2px solid;  ">
						<input type="checkbox" name="FuncionAsignatura2Txt" value="1" '; if($FuncionAsignatura2==1) {echo 'checked="checked"';}  echo ' >
					</td>		
				</tr>	

				<tr >
					<td colspan="2" width="50%" style="border: 2px solid;  " >
						<b>3. Desarrollar capacidades generales para el aprendizaje</b>
					</td>
					<td colspan="2" style="border: 2px solid;  ">
						<input type="checkbox" name="FuncionAsignatura3Txt" value="1" '; if($FuncionAsignatura3==1) {echo 'checked="checked"';}  echo ' >
					</td>		
				</tr>	

				<tr >
					<td colspan="2" width="50%" style="border: 2px solid;  " >
						<b>4. Contribuir a la formación cultural general de los estudiantes</b>
					</td>
					<td colspan="2" style="border: 2px solid;  ">
						<input type="checkbox" name="FuncionAsignatura4Txt" value="1" '; if($FuncionAsignatura4==1) {echo 'checked="checked"';}  echo ' >
					</td>		
				</tr>

				<tr >
					<td colspan="4" style="border: 2px solid;  ">
						<center>
							<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
							<input type="hidden" id="enviarFUNASIG"  name="enviarFUNASIG"  value="enviarFUNASIG" >					
							<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >	
						</center>			
					</td>		
				</tr>				
				
			</table>
		</form>		
			
		
						


			
	
	
	
	
	
	
	
	
	
	
		<form class="form-row mt-4"  id="formAMBITO" name="formAMBITO" method="post" action="" enctype="multipart/form-data"  >	
			<table border="2" style=" width:100%; margin-top:1%; border-collapse: collapse;   "  >

				<tr bgcolor="#2f5496" >
					<td colspan="4" style="border: 2px solid;  " >
						<font color="#ffffff"><b>3. Resultados de Aprendizaje de la Asignatura </b> (Objetivos que aportan a la consecución del perfil de egreso)</font>
					</td>
				</tr>
				
				<tr >
					<td colspan="2" width="70%" style="border: 2px solid;  " >
						<b>Ámbito Cognitivo</b>
					</td>
					<td colspan="2" style="border: 2px solid;  ">
						<textarea name="AmbitoCognitivoTxt" rows="5" style="width:100%">'.$AmbitoCognitivo.'</textarea>
					</td>		
				</tr>	
				
				<tr >
					<td colspan="2" width="50%" style="border: 2px solid;  " >
						<b>Ámbito Procedimental</b>
					</td>
					<td colspan="2" style="border: 2px solid;  ">
						<textarea name="AmbitoProcedimentalTxt" rows="5" style="width:100%">'.$AmbitoProcedimental.'</textarea>
					</td>		
				</tr>	

				<tr >
					<td colspan="2" width="50%" style="border: 2px solid;  " >
						<b>Ámbito Actitudinal</b>
					</td>
					<td colspan="2" style="border: 2px solid;  ">
						<textarea name="AmbitoActitudinalTxt" rows="5" style="width:100%">'.$AmbitoActitudinal.'</textarea>
					</td>		
				</tr>	
					
				<tr >
					<td colspan="4" style="border: 2px solid;  ">
						<center>
							<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
							<input type="hidden" id="enviarAMBITO"  name="enviarAMBITO"  value="enviarAMBITO" >					
							<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >	
						</center>		
					</td>		
				</tr>					
					
				
			</table>
		
		</form>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	';


		
		
		$consulta3 = " select * from peacabecera where IdPea= '".$IdPea."'  ";
		$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
		while ($row2 = mysqli_fetch_array( $resultado3 ))		
		{
			$Descripcion=$row2['Descripcion'];
			$Objetivo=$row2['Objetivo'];
			$Competencia=$row2['Competencia'];
		}
		
		
		
		
	echo '	
	





	<table border="2" style=" width:100%; margin-top:1%; border-collapse: collapse;  "  >

				<tr bgcolor="#2f5496" >
					<td colspan="4" style="border: 2px solid;  " >
						<font color="#ffffff"><b>4.  Sistema de Evaluación  </b> (Evidencias del logro de los objetivos)</font>
					</td>
				</tr>
		
		<tr  >
			<td style="border: 2px solid;  ">
			<form class="form-row mt-4"  id="formSISEVA" name="formSISEVA" method="post" action="" enctype="multipart/form-data"  >
					<textarea name="DescrpicionTxt" rows="5" style="width:100%">'.$SistemaEvaluacion.'</textarea>
					<br>
					<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
					<input type="hidden" id="enviarSISEVA"  name="enviarSISEVA"  value="enviarSISEVA" >
					<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
			</form>
			
			
				 
			</td>
		</tr>
		
	</table>


	<table border="2" style=" width:100%; margin-top:1%; border-collapse: collapse;  "  >

				<tr bgcolor="#2f5496" >
					<td colspan="4" style="border: 2px solid;  " >
						<font color="#ffffff"><b>4.1. Evidencias de Aprendizaje de la Asignatura   </b>( componentes cognitivo, procedimental y actitudinal)</font>
					</td>
				</tr>
		<tr  >
			<td style="border: 2px solid;  " >
			<form class="form-row mt-4"  id="formEVAAPRE" name="formEVAAPRE" method="post" action="" enctype="multipart/form-data"  >
					<textarea name="EvidenciasAprendizajeTxt" rows="5" style="width:100%">'.$EvidenciasAprendizaje.'</textarea>
					<br>
					<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
					<input type="hidden" id="enviarEVAAPRE"  name="enviarEVAAPRE"  value="enviarEVAAPRE" >
					<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
			</form>			

			</td>
		</tr>
		
	</table>





	
';
if($ObservacionCabecera!="")
{
	echo '<div>
		<font color="#ff0000" size="5%">
			 '.$ObservacionCabecera.'
		</font>		
	</div>';	
}
	

echo '	
	
	


	<table border="1" style=" width:100%; margin-top:1%; border-collapse: collapse;  "  >

		<tr  bgcolor="#2f5496"  >
			<td colspan="3" style="border: 2px solid;  ">
				<font color="#ffffff"><b>4.2.  Evaluación de los Resultados de Aprendizaje</b></font>
			</td>
		</tr>
		
		<tr  align="center">
			<td width="50%" style="border: 2px solid;  ">
				<b>Resultados de Aprendizaje de la Unidad</b> (enunciar los resultados de aprendizaje)
			</td>
			<td style="border: 2px solid;  ">
				<b>Actividad práctica a desarrollar</b> (describe la acción que realiza el estudiante)
			</td>	
			<td style="border: 2px solid;  ">
				<b>Evidencia / producto</b> (describe la evidencia como producto y la acción asociada a él)
			</td>				
		</tr>
		
		';	
			
		
		$consulta3 = " select * from pearesultados where IdPea= '".$IdPea."'  ";
		$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
		while ($row2 = mysqli_fetch_array( $resultado3 ))		
		{
			$IdResultado=$row2['IdResultado'];			
			$Resultado=$row2['Resultado'];
			$Evidencia=$row2['Evidencia'];
			$Actividad=$row2['Actividad'];
			
			echo '
			<tr >
				<td style="border: 2px solid;  ">
					'.$Resultado.'
				</td>
				<td style="border: 2px solid;  ">
					'.$Actividad.'

				</td>					
				<td style="border: 2px solid;  ">
					'.$Evidencia.'
					
					<a href="imprimir.php?tip=iPeaAdm23&IdPea='.$IdPea.'&idres='.$IdResultado.'&elimRES=xxx"><font color="#ff0000">X Emilinar</font></a><br>
					
				</td>		
			</tr>			
			';
			
		}	
		
	echo '		
	
	
	
	<form class="form-row mt-4"  id="formRES" name="formRES" method="post" action="" enctype="multipart/form-data"  >
					

					
					
			<tr >
				<td style="border: 2px solid;  ">
					<textarea name="ResultadoTxt" rows="5" style="width:100%"></textarea>
				</td>
				<td style="border: 2px solid;  ">
					<textarea name="ActividadEvTxt" rows="5" style="width:100%"></textarea>
				</td>	
				<td style="border: 2px solid;  ">
					<textarea name="EvidenciaTxt" rows="5" style="width:100%"></textarea>
				</td>					
			</tr>


			<tr >
				<td colspan="3" style="border: 2px solid;  ">
					<center>
						<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
						<input type="hidden" id="enviarRES"  name="enviarRES"  value="enviarRES" >
						<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
					</center>	
				</td>		
			</tr>

			
	</form>	
	
						
	
	</table>
	
	
	</div>
	
	
	
	
	
';
if($ObservacionResultados!="")
{
	echo '<div>
		<font color="#ff0000" size="5%">
			 '.$ObservacionResultados.'
		</font>		
	</div>';	
}
	

	$OrdenUnidad=0;
	$consulta311 = " select Orden from peaunidadcurricular where IdPea= '".$IdPea."'   ";
	$resultado311 = mysqli_query( $conexion, $consulta311 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
	while ($row211 = mysqli_fetch_array( $resultado311 ))		
	{
		$OrdenUnidad=$row211['Orden'];
	}
	$OrdenUnidad=$OrdenUnidad+1;

echo '		
	
	 
<br><br>

<button onclick="myFunctionNuevaUnidad()">Crear Nueva Unidad</button>

<br>
<div id="myDIVNuevaUnidad" style="border:1px solid black; display:none;">

	<form class="form-row mt-4"  id="formUnidad" name="formUnidad" method="post" action="" enctype="multipart/form-data"  >
			
			<table border="2" style=" width:100%; margin-top:1%; border-collapse: collapse;  "  >
				<tr bgcolor="#acb9ca" >
					<td style="border: 2px solid;  " >
						<b>Nueva Unidad Curricular:</b> 
					</td>
					<td style="border: 2px solid;  " >
						<textarea name="NueUnidadTxt" rows="4" style="width:100%"></textarea>
					</td>	
				</tr>

				<tr bgcolor="#acb9ca" >
					<td style="border: 2px solid;  " >
						<b>Resultados:</b> 
					</td>
					<td style="border: 2px solid;  " >
						<select style="width:80%;" name="ResultadosUnidadTxt" id="ResultadosUnidadTxt" >';

							$Competencianom="";
							$consulta311 = " select  IdResultado, Resultado from pearesultados where IdPea= '".$IdPea."'   ";
							$resultado311 = mysqli_query( $conexion, $consulta311 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
							while ($row211 = mysqli_fetch_array( $resultado311 ))		
							{
								$Competencianom2=$row211['Resultado'];
								$IdCompetencia2=$row211['IdResultado'];	

								echo '<option value="'.$IdCompetencia2.'">'.$Competencianom2.'</option>';
								
							}
							

							echo '
						</select>							

					</td>			
				</tr>	
							
				<input type="hidden" id="OrdenUnidad"  name="OrdenUnidad"  value="'.$OrdenUnidad.'" >
						


					<tr >
						<td colspan="2" style="border: 2px solid;  ">
							<center>
								<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
								<input type="hidden" id="enviarUnidad"  name="enviarUnidad"  value="enviarUnidad" >
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Nueva Unidad" >
							</center>	
						</td>		
					</tr>
			</table>
	
	</form>	

</div>
	<br>	
		
	

	
	
		';	
			
		$NombreUnidad="";
		$ResultadoAprendizaje="";
		$Contunidad=0;
		
		$sumHoraAsistenciaTot=0;
		$sumHoraPracticaTot=0;
		$sumHoraExperimentacionTot=0;
		$sumHoraAutonomaTot=0;			
		
		
		
		$consulta3 = " select * from peaunidadcurricular where IdPea= '".$IdPea."' order by Orden  ";
		$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 8");
		while ($row2 = mysqli_fetch_array( $resultado3 ))		
		{
			$IdUnidadCurricular=$row2['IdUnidadCurricular'];
			$NombreUnidad=$row2['NombreUnidad'];
			$ResultadoAprendizaje=$row2['ResultadoAprendizaje'];
			$ObservacionReApr=$row2['Observacion'];	
			$UnidadCurricularOrden=$row2['Orden'];
			
			$Contunidad=$Contunidad+1;

			$consulta32 = " select Resultado from pearesultados where IdResultado= '".$ResultadoAprendizaje."'   ";		
			$resultado32 = mysqli_query( $conexion, $consulta32 ) or die ( "Algo ha ido mal en la consulta a la base de datos 8");
			while ($row22 = mysqli_fetch_array( $resultado32 ))		
			{

				$ResultadoAprendizajedes=$row22['Resultado'];
			}


			$mostrarunidad="display:none;";
			if($IdUnidadCurricular==$unidadCurr)
			{
				$mostrarunidad="";
			}			
			
			
			echo '
			
			<button onclick="myFunction'.$IdUnidadCurricular.'()">Ver Unidad: '.$NombreUnidad.'</button>
			

			
			<div id="myDIV'.$IdUnidadCurricular.'" style="border:1px solid black; '.$mostrarunidad.' ">
			<table border="2" style=" width:100%; margin-top:1%; border-collapse: collapse;  "  >
			
				<tr  bgcolor="#2f5496" >
					<td colspan="7" style="border: 2px solid;  " >
						<b><font color="#ffffff">5.  Contenidos de Enseñanza / Unidades Curriculares</font></b><br>
						
						<form class="form-row mt-4"  id="formUnidadOrden" name="formUnidadOrden" method="post" action="" enctype="multipart/form-data"  >
							<font color="#ffffff">Cambiar Orden</font>
							<input type="number" id="TxtUnidadOrden"  name="TxtUnidadOrden"  value="'.$UnidadCurricularOrden.'" >
							<input type="hidden" id="IdUnidadCurricular"  name="IdUnidadCurricular"  value="'.$IdUnidadCurricular.'" >
							<input type="hidden" id="enviarUnidadOrden"  name="enviarUnidadOrden"  value="enviarUnidadOrden" >
							<input type="submit" class="btn btn-primary btn-lg btn-block" value="Cambiar Orden" >
						</form>							
						
						
					</td>
				</tr>	
				
				<tr  >
					<td rowspan="2" bgcolor="#cac9c9" style="border: 2px solid;  ">
						<b>U.'.$Contunidad.'.</b> 
					</td>
					<td colspan="6" style="border: 2px solid;  ">
						<b>NOMBRE DE LA UNIDAD:</b> '.$NombreUnidad.'
						
						<a href="imprimir.php?tip=iPeaAdm23&IdPea='.$IdPea.'&idUnidad='.$IdUnidadCurricular.'&elimUnidad=xxx"><font color="#ff0000">X Emilinar</font></a><br>
			
						
					</td>
				</tr>
				
				<tr>
					<td colspan="6" style="border: 2px solid;  ">
						<b>RESULTADO DE APRENDIZAJE DE LA UNIDAD:</b> '.$ResultadoAprendizajedes.'
						
	
						';
						if($ObservacionReApr!="")
						{
							echo '<div>
								<font color="#ff0000" size="5%">
									 '.$ObservacionReApr.'
								</font>		
							</div>';	
						}
							

						echo '	
						
					</td>
				</tr>			
						
				<tr  >
					<td rowspan="2" style="border: 2px solid;  ">Contenidos</td>
					<td colspan="2" style="border: 2px solid;  ">Horas de Aprendizaje en clase</td>
					<td rowspan="2" style="border: 2px solid;  ">Horas de aplicación y experimentación de aprendizajes</td>
					<td rowspan="2" style="border: 2px solid;  ">Horas de Aprendizaje Autónomo</td>
					<td rowspan="2" style="border: 2px solid;  ">Actividades de Trabajo, asistencia docente, practico, colaborativo, aplicación y experimentación, Autónomo</td>
					<td rowspan="2" style="border: 2px solid;  ">Mecanismos de Evaluación</td>
				</tr>

				<tr  >
					<td style="border: 2px solid;  ">Asistencia Docente</td>
					<td style="border: 2px solid;  ">Práctico, colaborativo</td>	
				</tr>

				';
				
				$sumHoraAsistencia=0;
				$sumHoraPractica=0;
				$sumHoraExperimentacion=0;
				$sumHoraAutonoma=0;
				
			
				
				
				$consulta31 = " select * from peacontenido where IdPea='".$IdPea."' and IdUnidadCurricular='".$IdUnidadCurricular."' ";
				$resultado31 = mysqli_query( $conexion, $consulta31 ) or die ( "Algo ha ido mal en la consulta a la base de datos 8");
				while ($row31 = mysqli_fetch_array( $resultado31 ))		
				{
					$Contenido=$row31['Contenido'];
					$HoraAsistencia=$row31['HoraAsistencia'];	
					$HoraPractica=$row31['HoraPractica'];
					$HoraExperimentacion=$row31['HoraExperimentacion'];						
					$HoraAutonoma=$row31['HoraAutonoma'];
					$IdPeaContenido=$row31['IdPeaContenido'];
					$ObservacionContenido=$row31['Observacion'];
					$TituloContenido=$row31['Titulo'];				
					
					$sumHoraAsistencia=$sumHoraAsistencia+$HoraAsistencia;
					$sumHoraPractica=$sumHoraPractica+$HoraPractica;
					$sumHoraExperimentacion=$sumHoraExperimentacion+$HoraExperimentacion;
					$sumHoraAutonoma=$sumHoraAutonoma+$HoraAutonoma;					
					
					$filas=1;
					$consulta41 = " select  COUNT(IdPeaActividad) as conta from peaactividades where IdPea='".$IdPea."' and IdUnidadCurricular='".$IdUnidadCurricular."' and IdPeaContenido='".$IdPeaContenido."' ";
					$resultado41 = mysqli_query( $conexion, $consulta41 ) or die ( "Algo ha ido mal en la consulta a la base de datos 8");
					while ($row41 = mysqli_fetch_array( $resultado41 ))		
					{
						$filas=$row41['conta'];
					}					
		
					$filas=$filas+1;
		
		
					echo '
					<tr >
						<td rowspan="'.$filas.'" style="border: 2px solid;  "><b>'.$TituloContenido.'</b><div style=" margin-left:15px; ">'.$Contenido.'</div>      
						
										
						<a href="imprimir.php?tip=iPeaAdm23&IdPea='.$IdPea.'&idCONTEN='.$IdPeaContenido.'&elimCONTEN=xxx"><font color="#ff0000">X Emilinar</font></a>
						
						';
						if($ObservacionContenido!="")
						{
							echo '<div>
								<font color="#ff0000" size="5%">
									 '.$ObservacionContenido.'
								</font>		
							</div>';	
						}
							

						echo '						
						
						
						
						</td>
						<td rowspan="'.$filas.'" style="border: 2px solid;  ">'.$HoraAsistencia.'</td>
						<td rowspan="'.$filas.'" style="border: 2px solid;  ">'.$HoraPractica.'</td>
						<td rowspan="'.$filas.'" style="border: 2px solid;  ">'.$HoraExperimentacion.'</td>
						<td rowspan="'.$filas.'" style="border: 2px solid;  ">'.$HoraAutonoma.'</td>
						<td ></td>
						<td ></td>
					</tr>			
					';
		
						$consulta41 = " select * from peaactividades where IdPea='".$IdPea."' and IdUnidadCurricular='".$IdUnidadCurricular."' and IdPeaContenido='".$IdPeaContenido."' and Tipo='cla'  ";
						$resultado41 = mysqli_query( $conexion, $consulta41 ) or die ( "Algo ha ido mal en la consulta a la base de datos 8");
						while ($row41 = mysqli_fetch_array( $resultado41 ))		
						{
							$Actividad=$row41['Actividad'];
							$Evaluacion=$row41['Evaluacion'];
							$ObservacionActividades=$row41['Observacion'];								
							echo '
							
							<tr>	
								<td style="border: 2px solid;  "><b>Tarea de asistencia docente en clase / aprendizaje colaborativo:</b><br>'.$Actividad.'
								
									';
									if($ObservacionActividades!="")
									{
										echo '<div>
											<font color="#ff0000" size="5%">
												 '.$ObservacionActividades.'
											</font>		
										</div>';	
									}
										

									echo '									
								
								
								</td>
								<td valign="top" style="border: 2px solid;  ">'.$Evaluacion.'</td>
							</tr>					
							';
						}
						
						
						
						$consulta41 = " select * from peaactividades where IdPea='".$IdPea."' and IdUnidadCurricular='".$IdUnidadCurricular."' and IdPeaContenido='".$IdPeaContenido."' and Tipo='exp'  ";
						$resultado41 = mysqli_query( $conexion, $consulta41 ) or die ( "Algo ha ido mal en la consulta a la base de datos 8");
						while ($row41 = mysqli_fetch_array( $resultado41 ))		
						{
							$Actividad=$row41['Actividad'];
							$Evaluacion=$row41['Evaluacion'];
							$ObservacionActividades=$row41['Observacion'];								
							echo '
							
							<tr>	
								<td style="border: 2px solid;  "><b>Prácticas de aplicación y experimentación de aprendizaje:</b><br>'.$Actividad.'
								
									';
									if($ObservacionActividades!="")
									{
										echo '<div>
											<font color="#ff0000" size="5%">
												 '.$ObservacionActividades.'
											</font>		
										</div>';	
									}
										

									echo '									
								
								
								</td>
								<td valign="top" style="border: 2px solid;  ">'.$Evaluacion.'</td>
							</tr>					
							';
						}	





						$consulta41 = " select * from peaactividades where IdPea='".$IdPea."' and IdUnidadCurricular='".$IdUnidadCurricular."' and IdPeaContenido='".$IdPeaContenido."' and Tipo='aut'  ";
						$resultado41 = mysqli_query( $conexion, $consulta41 ) or die ( "Algo ha ido mal en la consulta a la base de datos 8");
						while ($row41 = mysqli_fetch_array( $resultado41 ))		
						{
							$Actividad=$row41['Actividad'];
							$Evaluacion=$row41['Evaluacion'];
							$ObservacionActividades=$row41['Observacion'];								
							echo '
							
							<tr>	
								<td style="border: 2px solid;  "><b>Aprendizaje autónomo:</b><br>'.$Actividad.'
								
									';
									if($ObservacionActividades!="")
									{
										echo '<div>
											<font color="#ff0000" size="5%">
												 '.$ObservacionActividades.'
											</font>		
										</div>';	
									}
										

									echo '									
								
								
								</td>
								<td valign="top" style="border: 2px solid;  ">'.$Evaluacion.'</td>
							</tr>					
							';
						}						





						


				
		
				}
				
				
				
				
				
				
				
				
				
				
				
				
				
				
echo '				
				
				
				
<form class="form-row mt-4"  id="form1" name="form1" method="post" action="" enctype="multipart/form-data"  >



				
				<tr  >
					<td  style="border: 2px solid; background-color:#000000; color:#ffffff;  ">
						<b>Titulo</b>
						<textarea name="TituloTxt" rows="8" cols="30"></textarea>
						<br>
						<b>Contenido</b>
						<textarea name="ContenidoTxt" rows="20" cols="30"></textarea>
						
				
				
						
						
						
					</td>
					<td  style="border: 2px solid; background-color:#000000; color:#ffffff; ">
						<input type="number" size="5" name="HorasAsistenciajeTxt" value="0"   >
					</td>
					<td style="border: 2px solid; background-color:#000000; color:#ffffff;  ">
						<input type="number" size="5" name="HorasPracticoTxt" value="0"   >
					</td>
					<td  style="border: 2px solid; background-color:#000000; color:#ffffff; ">
						<input type="number" size="5" name="HorasExperimentacionTxt" value="0"   >
					</td>
					<td  style="border: 2px solid; background-color:#000000; color:#ffffff;  ">
						<input type="number" size="5" name="HorasAprendizajeAutonomoTxt" value="0"   >
					</td>
					<td style="border: 2px solid; background-color:#000000; color:#ffffff; ">
						<b>Tarea de asistencia docente en clase / aprendizaje colaborativo:</b><br>
							<textarea name="AsistenciaDocenteTxt" rows="10" cols="25"></textarea>						
						<b>Prácticas de aplicación y experimentación de aprendizaje:</b><br>
							<textarea name="AplicacionExperimentacionTxt" rows="10" cols="25"></textarea>
						<b>Aprendizaje autónomo:</b><br>
							<textarea name="AprendizajeAutonomoTxt" rows="10" cols="25"></textarea>
					</td>
					<td style="border: 2px solid; background-color:#000000; color:#ffffff; ">
						<br><br>
							<textarea name="AsistenciaDocenteEvaluacionTxt" rows="10" cols="25"></textarea><br><br><br>					
							<textarea name="AplicacionExperimentacionEvaluacionTxt" rows="10" cols="25"></textarea><br>	<br><br>
							<textarea name="AprendizajeAutonomoEvaluacionTxt" rows="10" cols="25"></textarea>	
					</td>
				</tr>				
				
				<tr  >
					<td Colspan="7" style="border: 2px solid; background-color:#000000; color:#ffffff;  ">
						<center>
							<input type="hidden" id="unidadesTxt"  name="unidadesTxt"  value="'.$IdUnidadCurricular.'" >
							<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
							<input type="hidden" id="enviar"  name="enviar"  value="enviar" >
							<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
						</center>	
					</td>
				</tr>				
									
				




</form>';				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				echo '
					<tr >
						<td style="border: 2px solid;  "></td>
						<td style="border: 2px solid;  ">'.$sumHoraAsistencia.'</td>
						<td style="border: 2px solid;  ">'.$sumHoraPractica.'</td>
						<td style="border: 2px solid;  ">'.$sumHoraExperimentacion.'</td>
						<td style="border: 2px solid;  ">'.$sumHoraAutonoma.'</td>
						<td colspan="2" style="border: 2px solid;  "></td>
						
					</tr>
					
					
				';
				
					$sumHoraAsistenciaTot=$sumHoraAsistenciaTot+$sumHoraAsistencia;
					$sumHoraPracticaTot=$sumHoraPracticaTot+$sumHoraPractica;
					$sumHoraExperimentacionTot=$sumHoraExperimentacionTot+$sumHoraExperimentacion;
					$sumHoraAutonomaTot=$sumHoraAutonomaTot+$sumHoraAutonoma;	
			

				
				echo '
					
					
						

				</table>
				</div>
					<br><br>
				';
				
				
				
				
			
		}
		
		$sumhorasAprendizaje=0;
		$sumhorasAprendizaje=$sumHoraAsistenciaTot+$sumHoraPracticaTot;
		

		$TotoSum=$sumhorasAprendizaje+	$sumHoraExperimentacionTot+$sumHoraAutonomaTot;
		
		
$mostrarMetodologia="display:none;";
if($Metodologgia=="c")
{
	$mostrarMetodologia="";
}		
		
		
		echo '
		
		
		
		
		
		
		
			<button onclick="myFunctionMetodologia()">Ver Metodología </button>
			

	
			<div id="myDIVMetodologia" style="border:1px solid black; '.$mostrarMetodologia.' ">
			<table border="2" style=" width:100%; margin-top:1%; border-collapse: collapse;  "  >	


				<tr  bgcolor="#2f5496" >
					<td  style="border: 2px solid;  " >
						<b><font color="#ffffff">6.  Metodología de Aprendizaje</font></b><br>
						
					</td>
				</tr>

			
					
					<tr >
						<td  style="border: 2px solid;  ">
						<form class="form-row mt-4"  id="formMetodologia" name="formMetodologia" method="post" action="" enctype="multipart/form-data"  >
							<textarea name="DescrpicionMETAPRETxt" rows="5" style="width:100%">'.$MetodologiasAprendizaje.'</textarea>
							<br>
							<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
							<input type="hidden" id="enviarMETAPRE"  name="enviarMETAPRE"  value="enviarMETAPRE" >
							<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
						</form>
	
						</td>
					</tr>	




				<tr  bgcolor="#2f5496" >
					<td  style="border: 2px solid;  " >
						<b><font color="#ffffff">6.1. Recursos didácticos</font></b><br>
						
					</td>
				</tr>


					<tr >
						<td  style="border: 2px solid;  ">
						
							<form class="form-row mt-4"  id="formRECDID" name="formRECDID" method="post" action="" enctype="multipart/form-data"  >
								<textarea name="DescrpicionRECDIDTxt" rows="5" style="width:100%">'.$RecursosDidacticos.'</textarea>
								<br>
								<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
								<input type="hidden" id="enviarRECDID"  name="enviarRECDID"  value="enviarRECDID" >
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
							</form>				

						</td>
					</tr>	
					
					
					
					
					<tr >
						<td  style="border: 2px solid;  "><br></td>
					</tr>		
		
		
		
		
		
				</table>
				</div>		
				
		
		
		
		
		
		
		
		<br><br>

';
		
$muestraPRAC="display:none;";
if($prac=="c")
{
	$muestraPRAC="";
}

echo '

	<button onclick="myFunctionPRAC()">Muestra Actividades Prácticas </button>

	<div id="myDIVPRAC" style="border:0px solid black; '.$muestraPRAC.' ">	



		<table border="1" style=" width:100%; margin-top:1%; border-collapse: collapse;  "  >

				<tr  bgcolor="#2f5496"  >
					<td colspan="2" style="border: 2px solid;  ">
						<font color="#ffffff"><b>7.  Actividades Prácticas</b> (en concordancia con la Guía de Prácticas de la Asignatura) </font>
					</td>
				</tr>
			
				
				';	
					
				
				$consulta3 = " select * from PEAActividadesPracticas where IdPea= '".$IdPea."'  ";
				$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
				while ($row2 = mysqli_fetch_array( $resultado3 ))		
				{
					$IdActividadesPracticas=$row2['IdActividadesPracticas'];			
					$Actividad=$row2['Actividad'];
					$Descripcion=$row2['Descripcion'];
					
					echo '
					<tr >
						<td width="50%" style="border: 2px solid;  ">
							Nombre de la Actividad Práctica: '.$Actividad.'
						</td>					
						<td style="border: 2px solid;  ">
							Descripción: '.$Descripcion.'
							
							<a href="imprimir.php?tip=iPeaAdm23&IdPea='.$IdPea.'&idactpra='.$IdActividadesPracticas.'&elimPRAC=xxx"><font color="#ff0000">X Emilinar</font></a><br>
							
						</td>		
					</tr>			
					';
					
				}	
				
			echo '		
			
			
			
			<form class="form-row mt-4"  id="formPRAC" name="formPRAC" method="post" action="" enctype="multipart/form-data"  >
			
					<tr >
						<td style="border: 2px solid;  ">
							<textarea name="ActividadPraTxt" rows="5" style="width:100%"></textarea>
						</td>
						<td style="border: 2px solid;  ">
							<textarea name="DescripcionPraTxt" rows="5" style="width:100%"></textarea>
						</td>	
							
					</tr>


					<tr >
						<td colspan="2" style="border: 2px solid;  ">
							<center>
								<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
								<input type="hidden" id="enviarPRAC"  name="enviarPRAC"  value="enviarPRAC" >
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
							</center>	
						</td>		
					</tr>

					
			</form>	
			
							
		
		</table>
				
		</div>
		
		
		
		
		
		
		
		
		
		<br><br>
		
		
		<table border="2" style=" width:100%;  "  >
			
		
		<tr >
			<td align="center" style="border: 2px solid;  "></td>
			
			<td colspan="2" style="border: 2px solid;  ">'.$sumHoraAsistenciaTot.'+'.$sumHoraPracticaTot.'=<b>'.$sumhorasAprendizaje.'</b>';
			
				if($HoraAprendizaje!=$sumhorasAprendizaje)
				{
					//echo "<b><font color='#ff0000'> Error son ".$HoraAprendizaje." horas</font>";
				}
						
			echo '</td>
			
			<td style="border: 2px solid;  "><b>'.$sumHoraExperimentacionTot.'</b>';
			
				if($HoraExperimental!=$sumHoraExperimentacionTot)
				{
					//echo "<b><font color='#ff0000'> Error son ".$HoraExperimental." horas</font>";
				}			
			
			echo '</td>
			
			
			<td style="border: 2px solid;  "><b>'.$sumHoraAutonomaTot.'</b>';
			
				if($HoraAutonomafinal!=$sumHoraAutonomaTot)
				{
					//echo "<b><font color='#ff0000'> Error son  ".$HoraAutonomafinal."  horas</font>";
				}			
			
			echo '</td>
			
			
			<td colspan="2" style="border: 2px solid;  "><b> Totales: '.$TotoSum.'</b></td>
		</tr>		

	</table>
	
	
				
				














';

	$muestrabiblioteca="display:none;";
	if($bbiblioteca=="c")
	{
		$muestrabiblioteca="";
	}


echo '					

	
	
	
<br>	
<button onclick="myFunctionBiblioteca()">Bibliografía</button>
<br>
<div id="myDIVBiblioteca" style="border:1px solid black; '.$muestrabiblioteca.' ">	
	
	
	<table border="2" style=" width:100%; margin-top:1%; border-collapse: collapse;  "  >
		<tr bgcolor="#2f5496" >
			<td colspan="2" style="border: 2px solid;  ">
				<font color="#ffffff"><b>8. Bibliografía: </b></font>				
			</td>			
		</tr>	
		<tr bgcolor="#ffffff" >
			<td style="border: 2px solid;  ">
				
			</td>
		</tr>

		<tr bgcolor="#2f5496" >
			<td  style="border: 2px solid;  ">
				<font color="#ffffff"><b>8.1. Básica</b></font>					
			</td>
			<td style="border: 2px solid;  ">
				<font color="#ffffff"><b>Existencia en biblioteca Institucional (código)</b></font>	
			</td>			
			
		</tr>
';

		$consulta3 = " select * from peabiblioteca where IdPea = '".$IdPea."' and Tipo='ba'  ";
		$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
		while ($row2 = mysqli_fetch_array( $resultado3 ))		
		{
			$IdPeaBiblioteca=$row2['IdPeaBiblioteca'];
			$Descripcion=$row2['Descripcion'];
			$CodigoSanIsidro=$row2['CodigoSanIsidro'];			
			
			echo '<tr  >
				<td style="border: 2px solid;  ">'.$Descripcion.'</td>
				<td style="border: 2px solid;  ">'.$CodigoSanIsidro.' 
				
				<a href="imprimir.php?tip=iPeaAdm23&IdPea='.$IdPea.'&idBIBBAS='.$IdPeaBiblioteca.'&elimBIBBAS=xxx"><font color="#ff0000">X Emilinar</font></a><br>
				
				
				</td>				
			</tr>';			
			
			
		}	
		
		
		
	echo '	
		
	<form class="form-row mt-4"  id="formBIBBAS" name="formBIBBAS" method="post" action="" enctype="multipart/form-data"  >
					

					
					
			<tr >
				<td style="border: 2px solid;  ">
					<textarea name="DescripcionTxt" rows="5" style="width:100%"></textarea>
				</td>
				<td style="border: 2px solid;  ">
					<textarea name="CodigoTxt" rows="5" style="width:100%"></textarea>
				</td>		
			</tr>


			<tr >
				<td colspan="2" style="border: 2px solid;  ">
					<center>
						<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
						<input type="hidden" id="enviarBIBBAS"  name="enviarBIBBAS"  value="enviarBIBBAS" >
						<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
					</center>	
				</td>		
			</tr>

			
	</form>			
		
		
';


echo '	
		
		
		<tr bgcolor="#2f5496" >
			<td  style="border: 2px solid;  ">
				<font color="#ffffff"><b>8.2. De Consulta</b></font>					
			</td>
			<td   bgcolor="#2f5496" style="border: 2px solid;  ">
				<font color="#ffffff"><b>Existencia en biblioteca Institucional (código)</b></font>	
			</td>			
			
		</tr>


';

		$consulta3 = " select * from peabiblioteca where IdPea = '".$IdPea."' and Tipo='com'  ";
		$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
		while ($row2 = mysqli_fetch_array( $resultado3 ))		
		{
			$IdPeaBiblioteca=$row2['IdPeaBiblioteca'];
			$Descripcion=$row2['Descripcion'];
			$CodigoSanIsidro=$row2['CodigoSanIsidro'];
			
			echo '<tr  >
				<td style="border: 2px solid;  ">'.$Descripcion.'</td>
				<td style="border: 2px solid;  ">'.$CodigoSanIsidro.'
				
								
				<a href="imprimir.php?tip=iPeaAdm23&IdPea='.$IdPea.'&idBIBBAS='.$IdPeaBiblioteca.'&elimBIBBAS=xxx"><font color="#ff0000">X Emilinar</font></a><br>
				
				
				
				</td>				
			</tr>';			
			
			
		}	
		
		
		
		
		
		
	echo '	
		
	<form class="form-row mt-4"  id="formBIBCOM" name="formBIBCOM" method="post" action="" enctype="multipart/form-data"  >
					

					
					
			<tr >
				<td style="border: 2px solid;  ">
					<textarea name="DescripcionTxt" rows="5" style="width:100%"></textarea>
				</td>
				<td style="border: 2px solid;  ">
					<textarea name="CodigoTxt" rows="5" style="width:100%"></textarea>
				</td>		
			</tr>


			<tr >
				<td colspan="2" style="border: 2px solid;  ">
					<center>
						<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
						<input type="hidden" id="enviarBIBCOM"  name="enviarBIBCOM"  value="enviarBIBCOM" >
						<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
					</center>	
				</td>		
			</tr>

			
	</form>			
		
		
';		
		
		
		
		



echo '


		
		
		<tr bgcolor="#2f5496" >
			<td  colspan="2" style="border: 2px solid;  ">
				<font color="#ffffff"><b>8.3. Webgrafía:)</b></font>	
			</td>			
			
		</tr>
		

';

		$consulta3 = " select * from peabiblioteca where IdPea = '".$IdPea."' and Tipo='web'  ";
		$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
		while ($row2 = mysqli_fetch_array( $resultado3 ))		
		{
			$Descripcion=$row2['Descripcion'];
			$IdPeaBiblioteca=$row2['IdPeaBiblioteca'];
			
			echo '<tr  >
				<td colspan="2" style="border: 2px solid;  ">'.$Descripcion.'
				
				<a href="imprimir.php?tip=iPeaAdm23&IdPea='.$IdPea.'&idBIBBAS='.$IdPeaBiblioteca.'&elimBIBBAS=xxx"><font color="#ff0000">X Emilinar</font></a><br>
				
				
				</td>			
			</tr>';			
			
			
		}	


	echo '	
		
	<form class="form-row mt-4"  id="formBIBWEB" name="formBIBWEB" method="post" action="" enctype="multipart/form-data"  >
		
					
			<tr >
				<td style="border: 2px solid;  " colspan="2" >
					<textarea name="DescripcionTxt" rows="5" style="width:100%"></textarea>
				</td>
					<input type="hidden" id="CodigoTxt"  name="CodigoTxt"  value="" >
			</tr>


			<tr >
				<td  style="border: 2px solid;  " colspan="2" >
					<center>
						<input type="hidden" id="IdPea"  name="IdPea"  value="'.$IdPea.'" >
						<input type="hidden" id="enviarBIBWEB"  name="enviarBIBWEB"  value="enviarBIBWEB" >
						<input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar Registro" >
					</center>	
				</td>		
			</tr>

			
	</form>			
		
		
';			
		
		
$NombreDoc="";		
$consulta3 = " select Nombre from docente where Id= '".$Docente."'  ";
$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos 5");
while ($row2 = mysqli_fetch_array( $resultado3 ))		
{
	$NombreDoc=$row2['Nombre'];	
}		
	

$fini=date("Y-m-d");
	
$diai=substr( $fini, 8, 2 );  
$mes=substr( $fini, 5, 2 ); 
$anioi=substr( $fini, 0, 4 ); 
$horai=substr( $fini, 10, 8 ); 


if($mes=='01')
{
  $mesnomi='Enero';
}
if($mes=='02')
{
  $mesnomi='Febrero';
}
if($mes=='03')
{
  $mesnomi='Marzo';
}
if($mes=='04')
{
  $mesnomi='Abril';
}
if($mes=='05')
{
  $mesnomi='Mayo';
}
if($mes=='06')
{
  $mesnomi='Junio';
}
if($mes=='07')
{
  $mesnomi='Julio';
}
if($mes=='08')
{
  $mesnomi='Agosto';
}
if($mes=='09')
{
  $mesnomi='Septiembre';
}
if($mes=='10')
{
  $mesnomi='Octubre';
}
if($mes=='11')
{
  $mesnomi='Noviembre';
}
if($mes=='12')
{
  $mesnomi='Diciembre';
}

		

echo '


		
		
	</table>
	
</div>	
	
	
	

	
</div>
</center>
<br><br><br>
';