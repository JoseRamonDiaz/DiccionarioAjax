<?php

    //Con esto se valida que se haya iniciado sesion
    include_once "../daos/daoAdministrador.php";
    validarSesion();
?>
<!DOCTYPE HTML>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shorcut icon"  href="../style/diccionario.png" type="image/png">

    <title>Administraci&oacute;n Diccionario Maya</title>

    <!-- Core CSS - Include with every page -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    
	<link rel="stylesheet" type="text/css" href="../js/jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css">
	
    <script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/peticiones-admin.js"></script>
	<script src="../js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
	

	<script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../js/sb-admin.js"></script>
    
    <!-- Gestión de palabras en español-->

    <!-- Admin - Include with every page -->
    <link href="../css/sb-admin.css" rel="stylesheet">
	
	<script>setIdioma("es");</script>
        <script src="../js/validaciones.js"></script>
        <script src="../js/validarPalabra.js"></script>
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
                            <a href="estadisticaadmin.php"><i class="fa fa-wrench fa-fw"></i> Estad&iacute;sticas</a>
                        </li>
                        <li>
                            <a href="categoria.php"><i class="fa fa-wrench fa-fw"></i> Categor&iacute;a</a>
                        </li>
                        <li>
                            <a href="maya.php"><i class="fa fa-wrench fa-fw"></i> Palabra Maya</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Palabra Espa&ntilde;ol</a>
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
                    <h1 class="page-header">Palabras en espa&ntilde;ol</h1>	
					
					<div id="admin_palabras">
						<ul>
							<li><a href="#mostrar_palabras"><i class="fa fa-list fa-fw"></i>Palabras</a></li>
							<li><a href="#agregar_palabra"><i class="fa fa-plus fa-fw"></i>AÃ±adir palabra</a></li>
							<li><a href="#editar_palabra"><i class="fa fa-plus fa-fw"></i>Editar palabra</a></li>
						</ul>
						
						<div id="mostrar_palabras">
							<div id="busqueda">
								<input type="text" size="50" maxlength="50" class="inputText ui-autocomplete-input" height="40" width="60" name="word" id="word" autocomplete="off">
				
								<input id="buscar" name="Buscar" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="../style/search.png" alt="Search" title="Search" onClick="consultarPalabra();">
							</div>
							</br>
							
							<table id="tablaDiccionario" class="table"></table>
							
							<div id="nav_bar"></div>
						</div>
						
						<div id="agregar_palabra">
							<form id="form_agregar">
                                                            <div id="errorDiv"></div>
							<div style="margin:10px">
								<select id="cmb_categoria" name="cmb_categoria">
									<option value="-1" selected>Categor&iacute;a</option>
									<?php
										require_once '../daos/daoCategoria.php';

										//listar todas las categorÃ­as
										$lista_categorias = obtenerTodasCategorias();
									
										foreach ($lista_categorias as $record) {	
											echo "<option value=\"". $record->categoria_id ."\">". $record->nombre ."</option>";
										}                  
									?>
								</select>
							</div>
							
							<div style="margin:10px"><input type="text" name="palabraes" class="input-xlarge" placeholder="Palabra espa&ntilde;ol" size="30" id="palabra1"> <span id="palabra1Error" class="errorFeedback errorSpan">La palabra es incorrecta</span></div>
							
							<input type="button" name="btn_guardar" id="btn_guardar" value="Guardar" style="margin:10px; padding:5px; position:relative; left:50px">
							
							<input type="hidden" name="txt_idioma" id="txt_idioma" value="es">
							</form>
						</div>
						
						<div id="editar_palabra">
							<form id="form_editar">
                                                            <div id="errorDiv"></div>
							<div style="margin:10px">
								<select id="cmb_categoria" name="cmb_categoria">
									<option value="-1" selected>Categor&iacute;a</option>
									<?php
										require_once '../daos/daoCategoria.php';

										//listar todas las categorias
										$lista_categorias = obtenerTodasCategorias();
									
										foreach ($lista_categorias as $record) {	
											echo "<option value=\"". $record->categoria_id ."\">". $record->nombre ."</option>";
										}                  
									?>
								</select>
							</div>
							
							<div style="margin:10px"><input type="text" name="palabra" id="palabra" class="input-xlarge" placeholder="Palabra espa&ntilde;ol" size="30"> <span id="palabraError" class="errorFeedback errorSpan">La palabra es incorrecta</span></div>
							
							<input type="button" name="btn_guardarEdicion" id="btn_guardarEdicion" value="Guardar" style="margin:10px; padding:5px; position:relative; left:50px">
							<input type="button" name="btn_cancelarEdicion" id="btn_cancelarEdicion" value="Cancelar" style="margin:10px; padding:5px; position:relative; left:50px">
							
							<input type="hidden" name="txt_idioma" id="txt_idioma" value="es">
							<input type="hidden" name="id_palabra" id="id_palabra" value="0">
							
							</form>
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

    <!-- Core Scripts - Include with every page -->


    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>