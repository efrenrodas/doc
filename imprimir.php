<?php

  	ini_set('date.timezone','America/Guayaquil'); 
	
	
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);	
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);

?>
<!-- saved from url=(0062)http://www.jose-aguilar.com/scripts/jquery/imprimir/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



<script type="text/javascript" src="archivos/jquery.js"></script>
<script type="text/javascript" src="archivos/jquery.PrintArea.js"></script>
        <link href="archivos/cssadmin.css" rel="stylesheet" type="text/css" />
   
        
</head>




<body style=" overflow:scroll; ">
<?php
include 'clases/2089.oxd';
?>



<?php 
$tip=$_GET['tip'];


if($tip=='repdia')
{
include('imprimir/reportediario.php');
}   



if($tip=="imprimirasistencia")
{

	include( 'imprimir/imprimirasistencia.php' ); 
}	


 if($tip=="cargarobservaciones")
 {
	include( 'imprimir/cargarparcial1.php' ); 
 }

 if($tip=="cargarobservaciones2")
 {
	include( 'imprimir/cargarparcial2.php' ); 
 } 

 if($tip=="silabo")
 {
	include( 'silabo/silabo.php' ); 
 }	
 
 
 if($tip=="silaboeva")
 {
	include( 'silabo/silaboeva.php' ); 
 }	 
 

 if($tip=='requisicionimp')
 {
	include('imprimir/requisicionimp.php'); 
 }
 
 if($tip=='iPea')
 {

	include('imprimir/ImpPea.php'); 
 }

 if($tip=='iPeaAdm')
 {

	include('imprimir/ImpPeaAdm.php'); 
 } 
 
  if($tip=='iPeaAdm23')
 {

	include('imprimir/ImpPeaAdm23.php'); 
 } 
 

?>

<script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>




</body></html>