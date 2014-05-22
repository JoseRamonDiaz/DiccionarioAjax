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
    <script src="../js/admin-diccionario.js"></script>
    <script src="../js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
	

    <script src="../js/bootstrap.min.js"></script>
     
    <!-- Gestión de diccionario-->

    <!-- Admin - Include with every page -->
    <link href="../css/sb-admin.css" rel="stylesheet">
	
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
                        <li><a href="perfil.php"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="cerrarSesion.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            
                        </li-->
                        
                        <li>
                            <a href="estadisticaadmin.php"><i class="fa fa-wrench fa-fw"></i> Estad&iacute;ticas</a>
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
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Diccionario</a>
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
                    <h1 class="page-header">Diccionario</h1>	
					
					<div id="admin_palabras">
						<ul>
							<li><a href="#mostrar_diccionario"><i class="fa fa-list fa-fw"></i>Diccionario</a></li>
							<li><a href="#agregar_entrada"><i class="fa fa-plus fa-fw"></i>A&ntilde;adir entrada</a></li>
						</ul>
						
						<div id="mostrar_diccionario">
							<div id="busqueda">
								<input type="text" size="50" maxlength="50" class="inputText ui-autocomplete-input" height="40" width="60" name="word" id="word" autocomplete="off">
				
								<input id="buscar" name="Buscar" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="../style/search.png" alt="Search" title="Search" onClick="consultarEntrada();">
							</div>
							</br>
							
							<select id="cmb_idioma" name="cmb_idioma" style="margin:15px">
								<option value="es" selected>Espa&ntilde;ol - Maya</option>
								<option value="ma" >Maya - Espa&ntilde;ol</option>
							</select>
							
							</br>
							
							<table id="tablaDiccionario" class="table"></table>
							
							<div id="nav_bar"></div>
						</div>
						
						<div id="agregar_entrada">
							<form id="form_agregar">
							
								<select id="sel_palabraes" style="margin:10px;">
									<option value="-1" selected>Palabra espa&ntilde;ol</option>
								</select>
								
								</br>
								<select id="sel_palabrama" style="margin:10px;">
									<option value="-1" selected>Palabra maya</option>
								</select>
								</br>
								<input type="button" name="btn_guardar" id="btn_guardar" value="Guardar" style="margin:10px; padding:5px; position:relative; left:50px">
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
