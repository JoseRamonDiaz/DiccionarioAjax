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
    
    <!-- Gestión de categorías -->

    <!-- Admin - Include with every page -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <script type="text/javascript">

        function crearFormEdicionNombre(id) {
           
            $('a').bind('click', false);
            var celda = $('#name').text(); 
            var formulario = "<form action='editarNombre.php' method='POST' enctype='application/x-www-form-urlencoded' id='datos'></form>"; 

            $('#f').append(formulario);

            $('#f form').append("<div id='nombre' class='input-group'></div><br>");

            $('#f form #nombre').append("<label>Ingresa el nuevo nombre de usuario</label><br>");
            $('#f form #nombre').append("<input type='text' name='nombre' class='input-xlarge' value='"+celda+"' size='30'>");
            
            $('#f form').append('<input type="submit" id="btnGuardar" value="Guardar" class="btn btn-primary"/>');
            
            $('#f form').append('<a href="javascript:cancelar();" class="add"><i class="fa fa-minus fa-fw"></i>Cancelar</a>');
            
            $('a').unbind('click', false);
            
        }
        
        function crearFormEdicionPassword(id) {
           
            $('a').bind('click', false);
            
            var formulario = "<form action='editarPassword.php' method='POST' enctype='application/x-www-form-urlencoded' id='datos'></form>"; 

            $('#f').append(formulario);

            $('#f form').append("<div id='password' class='input-group'></div><br>");

            $('#f form #password').append("<label>Ingresa el nuevo password</label><br>");
            $('#f form #password').append("<input type='password' name='password' class='input-xlarge' value='' size='30'><br>");
            
            $('#f form #password').append("<label>Escribe el password otra vez</label><br>");
            $('#f form #password').append("<input type='password' name='rpassword' class='input-xlarge' value='' size='30'>");
            
            $('#f form').append('<input type="submit" id="btnGuardar" value="Guardar" class="btn btn-primary"/>');
            
            $('#f form').append('<a href="javascript:cancelar();" class="add"><i class="fa fa-minus fa-fw"></i>Cancelar</a>');
            
            $('a').unbind('click', false);
            
        }
        
        function crearFormEdicionEmail(id) {
           
            $('a').bind('click', false);
            var celda = $('#email').text(); 
            var formulario = "<form action='editarEmail.php' method='POST' enctype='application/x-www-form-urlencoded' id='datos'></form>"; 

            $('#f').append(formulario);

            $('#f form').append("<div id='email' class='input-group'></div><br>");

            $('#f form #email').append("<label>Ingresa el nuevo email</label><br>");
            $('#f form #email').append("<input type='text' name='email' class='input-xlarge' value='"+celda+"' size='30'>");
            
            $('#f form').append('<input type="submit" id="btnGuardar" value="Guardar" class="btn btn-primary"/>');
            
            $('#f form').append('<a href="javascript:cancelar();" class="add"><i class="fa fa-minus fa-fw"></i>Cancelar</a>');
            
            $('a').unbind('click', false);
            
        }

        function cancelar(){

            $('form').remove();
            
        }
        
        function editarCategoria(id){
            
            $('#btnEditar').attr('disabled', 'true');
            var envio = $.post("editarCategoria.php", $("#datos").serialize());
            envio.done(function(data){

                $('#tdedit').remove();

                var obj = jQuery.parseJSON( data );
                
                 //alert(obj.nombre);
                 //$( "tbody" ).append("<tr id="+ obj.id+"></tr>");
                 $( "#"+obj.id ).append("<td>"+ obj.nombre+"</td>");
                 $( "#"+obj.id ).append("<td>"+ obj.abreviatura+"</td>");
                 $( "#"+obj.id ).append("<td><a href='javascript:crearFormEdicionCategoria("+ obj.id+");' class='edit'><i class='fa fa-pencil fa-fw'></i></a></td>");
                 $( "#"+obj.id ).append("<td><a href='javascript:eliminarCategoria("+ obj.id+")' class='remove'><i class='fa fa-times fa-fw'></i></a></td>");
            

            },"json").fail(function() {
                alert("Ocurrió un error.");
            });
            
            $('a').unbind('click', false);
            
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
                        <!--li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuraci&oacute;n</a>
                        </li-->
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
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Categor&iacute;a</a>
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
                    <h1 class="page-header">Perfil de usuario</h1>
                    
                    <div class="panel-body">
                        
                    <?php
                    
                        require_once '../daos/daoCategoria.php';
                        
                        if(isset($_SESSION["usuario"])){
                            $username = $_SESSION["usuario"];
                            
                            $id = findByUsername($username);
                            
                            $administrador = findById($id);
                            
                            
                            echo "<div class='row'>";
                            echo "<div class='col-md-3'><strong>Nombre de usuario</strong></div>";
                            echo "<div class='col-md-3' id='name'>".$administrador->username."</div>";
                            echo "<div class='col-md-1'><a href='javascript:crearFormEdicionNombre(".$id.");' class='edit'><i class='fa fa-pencil fa-fw'></i></a></div>";
                            echo "</div>";
                            echo "<div class='row'>";
                            echo "<div class='col-md-3'><strong>Password</strong></div>";
                            echo "<div class='col-md-3'>*******</div>";
                            echo "<div class='col-md-1'><a href='javascript:crearFormEdicionPassword(".$id.");' class='edit'><i class='fa fa-pencil fa-fw'></i></a></div>";
                            echo "</div>";
                            echo "<div class='row'>";
                            echo "<div class='col-md-3'><strong>Correo electr&oacute;nico</strong></div>";
                            echo "<div class='col-md-3' id='email'>".$administrador->email."</div>";
                            echo "<div class='col-md-1'><a href='javascript:crearFormEdicionEmail(".$id.");' class='edit'><i class='fa fa-pencil fa-fw'></i></a></div>";
                            echo "</div>";
                                  
                       }                  

                    ?>
                        <br>
                        <div id="f"></div>
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
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>

