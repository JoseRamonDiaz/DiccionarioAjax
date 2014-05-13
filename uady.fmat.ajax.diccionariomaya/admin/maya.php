<?php
	//Con esto se valida que se haya iniciado sesion
	include_once "../daos/daoAdministrador.php";
	validarSesion();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administraci&oacute;n Diccionario Maya</title>

    <!-- Core CSS - Include with every page -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="../js/peticiones-admin.js"></script>
    
    <!-- Gesti�n de categor�as -->

    <!-- Admin - Include with every page -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <script type="text/javascript">

        function crearFormulario() {
            
            $(".add").hide();

            //var formulario=document.createElement("form");

            //formulario.action = "agregarCategoria.php";
            //formulario.method = "POST";
            //formulario.enctype="application/x-www-form-urlencoded";
            //formulario.onsubmit="guardarCategoria(); return false;";
            //formulario.id = "datos";
           
            var formulario = "<form action='agregarCategoria.php' method='POST' enctype='application/x-www-form-urlencoded' onsubmit='guardarCategoria(); return false;' id='datos'></form>";
            //formulario.innerHTML="<input class='form-control'><p class='help-block'>Example block-level help text here.</p></div> <br/> Abreviatura <input type='text' name='abreviatura' value=''/> <br/> <button type='submit' class='btn btn-default'>Submit Button</button>";  

            $('#addCategory').append(formulario);

            $('#addCategory form').append("<div id='nombre' class='input-group'></div><br>");

            //$("#addCategory form #nombre").append("<span class='input-group-addon'>Nombre</span>");
            $("#addCategory form #nombre").append("<input type='text' name='nombre' class='input-xlarge' placeholder='Nombre' size='30'>");
            
            $('#addCategory form').append("<div id='abrev' class='input-group'></div>");

            //$("#addCategory form #abrev").append("<span class='input-group-addon'>Abreviatura</span>");
            $("#addCategory form #abrev").append("<input type='text' name='abreviatura' class='input-xlarge' placeholder='Abreviatura' size='30'>");
            
            $("#addCategory form").append('<br><input type="submit" id="btnGuardar" value="A&ntilde;adir categor&iacute;a" class="btn btn-primary"/>');
            
            $("#addCategory form").append('<a href="javascript:cancelar();" class="add"><i class="fa fa-minus fa-fw"></i>Cancelar</a>');
        }

        function cancelar(){

            $('form').remove();
            $(".add").show();
        }
        
        function guardarCategoria(){
            
            var envio = $.post("agregarCategoria.php", $("#datos").serialize());
            envio.done(function(data){
                alert(data);
                location.href="categoria.php";
            }).fail(function() {
                alert("Ocurri� un error.");
            });
            
            
        }


    </script>

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                
                <a class="navbar-brand" href="../index.html">Diccionario Maya</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuraci�n</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="index.html"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
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
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
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
                    <h1 class="page-header">Palabras en maya</h1>

					<input type="text" size="50" maxlength="50" class="inputText ui-autocomplete-input" height="40" width="60" name="word" id="word" autocomplete="off">
	
					<input id="buscar" name="Buscar" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="../style/search.png" alt="Search" title="Search">
					
					<table id="tablaDiccionario" class="table"></table>
					
					<script>setIdioma("ma"); consultarPalabras(0);</script>
					
					<div id="nav_bar"></div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>