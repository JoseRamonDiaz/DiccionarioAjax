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
    <script src="../js/validaciones.js"></script>
    <script src="../js/validarCategoria.js"></script>
    
    <!-- Gesti�n de categor�as -->

    <!-- Admin - Include with every page -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <script type="text/javascript">

        function crearFormulario() {
            
            $('.add').hide();

            //var formulario=document.createElement("form");

            //formulario.action = "agregarCategoria.php";
            //formulario.method = "POST";
            //formulario.enctype="application/x-www-form-urlencoded";
            //formulario.onsubmit="guardarCategoria(); return false;";
            //formulario.id = "datos";
           
            var formulario = "<form action='agregarCategoria.php' method='POST' enctype='application/x-www-form-urlencoded' onsubmit='guardarCategoria(); return false;' id='datos'></form> <div id='errorDiv'></div>";
            //formulario.innerHTML="<input class='form-control'><p class='help-block'>Example block-level help text here.</p></div> <br/> Abreviatura <input type='text' name='abreviatura' value=''/> <br/> <button type='submit' class='btn btn-default'>Submit Button</button>";  

            $('#addCategory').append(formulario);

            $('#addCategory form').append("<div id='nombre' class='input-group'></div><br>");

            //$("#addCategory form #nombre").append("<span class='input-group-addon'>Nombre</span>");
            $('#addCategory form #nombre').append("<input type='text' name='nombre' class='input-xlarge' placeholder='Nombre' size='30' id='nombre_input'>"+'<span id="nombre_inputError" class="errorFeedback errorSpan">El nombre es incorrecto</span>');
            
            $('#addCategory form').append("<div id='abrev' class='input-group'></div>");

            //$("#addCategory form #abrev").append("<span class='input-group-addon'>Abreviatura</span>");
            $('#addCategory form #abrev').append("<input type='text' name='abreviatura' class='input-xlarge' placeholder='Abreviatura' size='30' id='abreviatura'>"+'<span id="abreviaturaError" class="errorFeedback errorSpan">La abreviatura es incorrecta</span>');
            
            $('#addCategory form').append('<br><input type="submit" id="btnGuardar" value="A&ntilde;adir categor&iacute;a" class="btn btn-primary"/>');
            
            $('#addCategory form').append('<a href="javascript:cancelar();" class="add"><i class="fa fa-minus fa-fw"></i>Cancelar</a>');
        }

        function cancelar(){

            $('form').remove();
            $(".add").show();
        }
        
        function guardarCategoria(){
            
            if(validarForm()){
            $('#btnGuardar').attr('disabled', 'true');
            
            var envio = $.post("agregarCategoria.php", $("#datos").serialize());
            envio.done(function(data){

                $('form').remove();
                $(".add").show();
         
                var obj = jQuery.parseJSON( data );
  
                 $( "tbody" ).append("<tr id="+ obj.id+"></tr>");
                 $( "#"+obj.id ).append("<td>"+ obj.nombre+"</td>");
                 $( "#"+obj.id ).append("<td>"+ obj.abreviatura+"</td>");
                 $( "#"+obj.id ).append("<td><a href='javascript:crearFormEdicionCategoria("+ obj.id+");' class='edit'><i class='fa fa-pencil fa-fw'></i></a></td>");
                 $( "#"+obj.id ).append("<td><a href='javascript:eliminarCategoria("+ obj.id+");' class='remove'><i class='fa fa-times fa-fw'></i></a></td>");
            

            },"json").fail(function() {
                alert("Ocurri� un error.");
            });
            
            }
        }

        
          function eliminarCategoria(id){
            
            $('a').bind('click', false);
            
            var envio = $.get("eliminarCategoria.php?id=" + id);
            envio.done(function(data){
                
                if (data){
                    alert("Se ha eliminado la categoria.");
                    $('#'+id).remove();
                    $('a').unbind('click', false);
                } else {
                    alert("No se pudo eliminar la categoria.");
                    $('a').unbind('click', false);
                }
  
            }).fail(function(){
                alert("Ocurri� un error.");
                $('a').unbind('click', false);
            });
            

        }
        
        function crearFormEdicionCategoria(id){
            
            $('a').bind('click', false);
            var celda1 = $('#' + id).find('td:eq(0)').html();   
            var celda2 = $('#' + id).find('td:eq(1)').html(); 
        
            $('#' + id).empty();
            $('#' + id).append("<td id='tdedit'></td>");
      
            var formulario = "<form action='editarCategoria.php' method='POST' enctype='application/x-www-form-urlencoded' onsubmit='editarCategoria("+id+"); return false;' id='datos'></form>" + "<div id='errorDiv'></div>";
            //formulario.innerHTML="<input class='form-control'><p class='help-block'>Example block-level help text here.</p></div> <br/> Abreviatura <input type='text' name='abreviatura' value=''/> <br/> <button type='submit' class='btn btn-default'>Submit Button</button>";  

            $('#tdedit').append(formulario);

            $('#tdedit form').append("<div id='nombre' class='input-group'></div><br>");
            
            
            $('#tdedit form').append("<input type='hidden' name='id' value='"+id+"'>");
            //$("#addCategory form #nombre").append("<span class='input-group-addon'>Nombre</span>");
            $('#tdedit form #nombre').append("<input type='text' name='nombre' class='input-xlarge' value='"+celda1+"' size='30' id='nombre_input'>"+'<span id="nombre_inputError" class="errorFeedback errorSpan">El nombre es incorrecto</span>');
            
            $('#tdedit form').append("<div id='abrev' class='input-group'></div>");

            //$("#addCategory form #abrev").append("<span class='input-group-addon'>Abreviatura</span>");
            $('#tdedit form #abrev').append("<input type='text' name='abreviatura' class='input-xlarge' value='"+celda2+"' size='30' id='abreviatura'>"+'<span id="abreviaturaError" class="errorFeedback errorSpan">La abreviatura es incorrecta</span>');
            
            $('#tdedit form').append('<br><input type="submit" id="btnEditar" value="Guardar categor&iacute;a" class="btn btn-primary"/>');
            
            //$('#tdedit form').append('<a href="javascript:cancelar();" class="add"><i class="fa fa-minus fa-fw"></i>Cancelar</a>');
            
            
        }
        
        function editarCategoria(id){
            
            if(validarForm()){
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
                alert("Ocurri� un error.");
            });
            
            $('a').unbind('click', false);
            }
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
                        <li><a href="perfil.php"><i class="fa fa-user fa-fw"></i> Perfil</a>
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
						<li>
                            <a href="estadisticaadmin.php"><i class="fa fa-wrench fa-fw"></i> Estadísticas</a>
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
                    <h1 class="page-header">Categor&iacute;a</h1>
                    
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Abreviatura</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                    <?php
                    
                        require_once '../daos/daoCategoria.php';

                        //listar todas las categor�as
                        $lista_categorias = obtenerTodasCategorias();
                                     
                        foreach ($lista_categorias as $record) {
                            $id = $record->categoria_id;
                            $nombre = $record->nombre;
                            $abreviatura = $record->abreviatura;
                            echo "<tr id=".$id.">";
                            echo "<td>".$nombre."</td>";
                            echo "<td>".$abreviatura."</td>";
                            echo "<td><a href='javascript:crearFormEdicionCategoria(".$id.");' class='edit'><i class='fa fa-pencil fa-fw'></i></a></td>";
                            echo "<td><a href='javascript:eliminarCategoria(".$id.");' class='remove'><i class='fa fa-times fa-fw'></i></a></td>";
                            echo "</tr>";
                        }                  

                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>    

                    <div id="addCategory"></div>
                    <br>
                    <a href='javascript:crearFormulario();' class="add"><i class="fa fa-plus fa-fw"></i>A&ntilde;adir Categor&iacute;a</a>
                         
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
