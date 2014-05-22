<?php

    //Con esto se valida que se haya iniciado sesion
    include_once "../daos/daoAdministrador.php";
    validarSesion();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Diccionario Maya</title>
        <meta name="keywords" content="diccionario maya, traductor, traductor maya a español traductor español a maya" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		
        <link rel="shorcut icon"  href="../style/diccionario.png" type="image/png">
		<link rel="stylesheet" type="text/css" href="../js/dist/jquery.jqplot.min.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css">
		
		<link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/sb-admin.css" rel="stylesheet">
		
        <script src="../js/jquery-1.10.2.js"></script>
        <script src="../js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="../js/dist/jquery.jqplot.min.js"></script>
		<script src="../js/dist/plugins/jqplot.categoryAxisRenderer.min.js"></script>
		<script src="../js/dist/plugins/jqplot.barRenderer.min.js"></script>
				
		<script src="../js/bootstrap.min.js"></script>
		
		
		<script>
			$(function(){
				$.jqplot.config.enablePlugins = true;
				$.get("../daos/palabras/consultarEstadisticas.php", {idioma:'es'}, graficaEspaniol);
				$.get("../daos/palabras/consultarEstadisticas.php", {idioma:'ma'}, graficaMaya);
			});
			
			function graficaEspaniol(respuesta){
				aRespuesta = eval(respuesta);
				
				if(aRespuesta[0]){
					aPalabras = aRespuesta[1];
					palabras=[];
					nBusquedas=[];
					
					if(aPalabras.length > 0){
						for(i=0; i<aPalabras.length; i++){
							palabras.push(aPalabras[i]['texto_espaniol']);
							nBusquedas.push(aPalabras[i]['num_consultas']);
						}
						
						graficar(nBusquedas, palabras, 'Palabras espa&ntilde;ol', 'graficaEspaniol');
					}
					else{
						$('#graficaEspaniol').html("No se han consultado palabras en espa&ntilde;ol.");
					}
				}
				else if(aRespuesta[0]==false){
					alert(aRespuesta[1]);
				}
			}
			
			function graficaMaya(respuesta){
				aRespuesta = eval(respuesta);
				
				if(aRespuesta[0]){
					aPalabras = aRespuesta[1];
					palabras=[];
					nBusquedas=[];
					
					if(aPalabras.length > 0){
						for(i=0; i<aPalabras.length; i++){
							palabras.push(aPalabras[i]['texto_maya']);
							nBusquedas.push(aPalabras[i]['num_consultas']);
						}
						
						graficar(nBusquedas, palabras, 'Palabras maya', 'graficaMaya');
					}
					else{
						$('#graficaMaya').html("No se han consultado palabras en maya.");
					}
				}
				else if(aRespuesta[0]==false){
					alert(aRespuesta[1]);
				}
			}
			
			function graficar(nBusquedas, palabras, idioma, nombre_div){
				//var nBusquedas = [2,4,4,8,3,7,6];
				//var palabras = ['2008','2009','2010','2011','2012','2013','2014'];
				
				var plot1 = $.jqplot(nombre_div,[nBusquedas],{
					//title:"Palabras mÃ¡s consultadas",
					seriesDefaults:{
						renderer:$.jqplot.BarRenderer,
						 rendererOptions: {
							barPadding: 1,
							barMargin: 15,
							barDirection: 'vertical',
							barWidth: 30
						}, 
						pointLabels: { show: true }
					},
					series:[{
						color: 'red',
						//renderer:$.jqplot.BarRenderer
					}],
					axes:{
						xaxis:{
							label: idioma,
							renderer: $.jqplot.CategoryAxisRenderer,
							ticks: palabras
						},
						yaxis: {              
							min: 0,
							max: nBusquedas[0],
							tickOptions: {
								formatString: '%d'
							}
						}
					}
					
				});
				console.log(nBusquedas[0]);
			}
		</script>
		
    </head>

    <body>
	<div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                
                <a class="navbar-brand" target="_blank" href="../index.html">Diccionario Maya</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="perfil.php"><i class="fa fa-user fa-fw"></i> Perfil</a></li>
                        
                        <li class="divider"></li>
                        <li><a href="cerrarSesion.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Estad&iacute;ticas</a>
                        </li>
                        <li>
                            <a href="categoria.php"><i class="fa fa-wrench fa-fw"></i> Categor&iacute;a</a>
                        </li>
                        <li>
                            <a href="maya.php"><i class="fa fa-wrench fa-fw"></i> Palabra Maya</a>
                        </li>
                        <li>
                            <a href="espaniol.php"><i class="fa fa-wrench fa-fw"></i> Palabra Espa&ntilde;ol</a>
                        </li>			
                        <li>
                            <a href="diccionario.php"><i class="fa fa-wrench fa-fw"></i> Diccionario</a>
                        </li>
			
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<h1 class="page-header">Estad&iacute;sticas</h1>
					<div id="Content" style="text-align:center; width:700px">
						<div id="GraficaEsContainer" style="margin:100px;">
                                                    <h1>Palabras m&aacute;s consultadas en espa&ntilde;ol</h1>
							<div id="graficaEspaniol" style="height:400px; width:600px; text-align:center; font-size:150%"></div>
						</div>
						<div id="GraficaMaContainer" style="margin:100px;">
                                                    <h1>Palabras m&aacute;s consultadas en maya</h1>
							<div id="graficaMaya" style="height:400px;width:600px; text-align:center; font-size:150%"></div>
						</div>
					</div>
		        </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	</body>
</html>
