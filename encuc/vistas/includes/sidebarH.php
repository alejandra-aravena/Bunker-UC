
<div class="container-fluid">
	<div class="row">

    	<div class="col-sm-3 col-md-2 sidebar">
        	<h4 class="sub-header">Panel de Control</h4>
            
            <ul class="nav nav-sidebar">
            	<li><a href="estacion/simular/simularEstacion.php">Simular Estación</a></li>
            </ul>
            
            <?php if (in_array(6, $_SESSION['roles']) ) { ?>
            <hr />
            <ul class="nav nav-sidebar">
            	<li><a href="casos/casos/casos.php">Casos</a></li>
                <li><a href="casos/casosEstadoOtro/casosEstadoOtro.php">Casos Estado Otro</a></li>
                <li><a href="casos/casosAgendados/casosAgendados.php">Casos Agendados</a></li>
                <li><a href="casos/casosFueraServicio/casosFueraServicio.php">Casos Fuera de Servicio</a></li>
                <li><a href="casos/casosIntentoLlamada/casosIntentoLlamada.php">Casos Intentos Llamada</a></li>
          	</ul>
            <?php } ?>
            
            <hr />
            <ul class="nav nav-sidebar">
            	<li><a href="descargas/audios/descargarCDR.php">Descargar Audio</a></li>
            </ul>
            
            <?php if (in_array(5, $_SESSION['roles']) ) { ?>
          	<hr />
          	<ul class="nav nav-sidebar">
                <li><a href="estados/estados_casos/estadosCasos.php">Historial de Estados</a></li>
                <li><a href="estados/cambio_estado/cambioEstado.php">Cambiar Estado Masivo</a></li>
                <li><a href="estados/estados/estados.php">Estados</a></li>
                <li><a href="estados/acciones/acciones.php">Acciones</a></li>
                <li><a href="estados/estados_acciones/estadosAcciones.php">Prioridades</a></li>
          	</ul>
            <?php } ?>
          
            <?php if (in_array(4, $_SESSION['roles']) ) { ?>
          	<hr />
          	<ul class="nav nav-sidebar">
            	<li><a href="encuestas/encuestas/encuestas.php">Encuestas</a></li>
            	<li><a href="encuestas/encuestas_casos/encuestasCasos.php">Asignación de encuestas</a></li>
                <li><a href="encuestas/estaciones_casos/estacionesCasos.php">Asignación de estaciones</a></li>
          	</ul>
            <?php } ?>
            
            <?php if (in_array(3, $_SESSION['roles']) ) { ?>
          	<hr />
          	<ul class="nav nav-sidebar">
            	<li><a href="generales/generales/generales.php">Datos generales</a></li>
            	<li><a href="subidas/casos/subidaCasos.php">Subida de casos</a></li>
                <li><a href="casos/casosRepetidos/casosRepetidos.php">Casos Repetidos</a></li>
          	</ul>
            <?php } ?>
            
            <?php if (in_array(2, $_SESSION['roles']) ) { ?>
          	<hr />
          	<ul class="nav nav-sidebar">
            	<li><a href="columnas/base/columnasBase.php">Columnas Base</a></li>
                <li><a href="columnas/visibilidad/visibilidadColumna.php">Visibilidad Columnas</a></li>
            	<!-- <li><a href="columnas/extra/columnasExtra.php">Columnas Extras</a></li> -->
          	</ul>
            <?php } ?>
          
            <?php if (in_array(1, $_SESSION['roles']) ) { ?>
          	<hr />
          	<ul class="nav nav-sidebar">
            	<li><a href="usuarios/usuarios/usuarios.php">Usuarios</a></li>
            	<li><a href="usuarios/roles/roles.php">Roles</a></li>
                <li><a href="usuarios/roles_usuarios/rolesUsuarios.php">Roles de Usuarios</a></li>
          	</ul>
            <?php } ?>
          
        </div>