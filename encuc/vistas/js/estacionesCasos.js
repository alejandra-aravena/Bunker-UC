function cargarLista(idUsuario) {
	$('.cargando').fadeIn();
	
	var stringDatos = 'idUsuario='+idUsuario;
	$.ajax({
		type: "POST",
		url: "../../../controladores/usuarios_casos/listarXidUsuariosCasos.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			if (datos.length != 0) {
				
				var dataSet = new Array()
			
				for(i=0; i< datos.length; i++) {
			  
					if (!datos[i].encuesta) {
						datos[i].encuesta = ''
					}
					if (!datos[i].usrname) {
						datos[i].usrname = ''
					}
					
					dataSet.push([datos[i].id_caso, datos[i].telefono, datos[i].usrname])
					
				}
				
				var traduccion = {
						"emptyTable":     "No hay datos disponibles en la tabla",
						"info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
						"infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
						"infoFiltered":   "(filtrado de _MAX_ entradas totales)",
						"infoPostFix":    "",
						"thousands":      ",",
						"lengthMenu":     "Mostrando _MENU_ entradas",
						"loadingRecords": "Cargando...",
						"processing":     "Procesando...",
						"search":         "Busqueda:",
						"zeroRecords":    "sin coincidencias encontradas",
						"paginate": {
							"first":      "Primera",
							"last":       "Ultima",
							"next":       "Siguiente",
							"previous":   "Anterior"
						},
						"aria": {
							"sortAscending":  ": activar para ordenar columna ascendente",
							"sortDescending": ": activar para ordenar columna descendente"
						}
					}
				
				
				
				if ($('#listarT_length').is(":visible")) {
					
					var table = $('#listarT').dataTable( {
					  "lengthMenu": [ 100, 250, 500, 750 ],	
						"data": dataSet,
						"language": traduccion,
						"columns": [
							{ "title": "ID caso" },
							{ "title": "Caso" },
							{ "title": "Estacion"}
						],
					  "destroy": true
					} );
				}
				else {
				  
				
					$('#listarT').dataTable( {
						"lengthMenu": [ 100, 250, 500, 750 ],	
						"data": dataSet,
						"language": traduccion,
						"columns": [
							{ "title": "ID caso" },
							{ "title": "Caso" },
							{ "title": "Estacion"}
						]
					});
				}
				
			}

			$('.cargando').fadeOut();
			
		}
	});
}
function listarEstaciones() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/estaciones/listarEstaciones.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			if (datos.length == 0) {
				$('.cargando').fadeOut();
			}
			else {
				
				var divAdd = $('#estacionesPosibles');
				var divAdd2 = $('#estacionesPosibles2');
				var divAddVer = $('#estacionesPosiblesVer');
			
				for(i=0; i< datos.length; i++) {
					
						var option = $('<option></option>').text(datos[i].usrname).attr('value',datos[i].id_usuario)
						var option2 = $('<option></option>').text(datos[i].usrname).attr('value',datos[i].id_usuario)
						var optionVer = $('<option></option>').text(datos[i].usrname).attr('value',datos[i].id_usuario)
				
						divAdd.append(option)
						divAdd2.append(option2)
						divAddVer.append(optionVer)
				}
			}
			$('.cargando').fadeOut();
			
		}
	});
}

function cargarCasosSinEstacion() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/usuarios_casos/listarEstacionesSincaso.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			if (datos.length != 0) {
				
				var dataSet = new Array()
			
				for(i=0; i< datos.length; i++) {
			
					if (!datos[i].usrname) {
						datos[i].usrname = '---'
					}
					
					dataSet.push([datos[i].id_caso, datos[i].telefono, datos[i].usrname])
					
				}
				
				var traduccion = {
						"emptyTable":     "No hay datos disponibles en la tabla",
						"info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
						"infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
						"infoFiltered":   "(filtrado de _MAX_ entradas totales)",
						"infoPostFix":    "",
						"thousands":      ",",
						"lengthMenu":     "Mostrando _MENU_ entradas",
						"loadingRecords": "Cargando...",
						"processing":     "Procesando...",
						"search":         "Busqueda:",
						"zeroRecords":    "sin coincidencias encontradas",
						"paginate": {
							"first":      "Primera",
							"last":       "Ultima",
							"next":       "Siguiente",
							"previous":   "Anterior"
						},
						"aria": {
							"sortAscending":  ": activar para ordenar columna ascendente",
							"sortDescending": ": activar para ordenar columna descendente"
						}
					}
				
				
				
				if ($('#listarT_length').is(":visible")) {
					
					var table = $('#listarT').dataTable( {
					  "lengthMenu": [ 100, 250, 500, 750 ],	
						"data": dataSet,
						"language": traduccion,
						"columns": [
							{ "title": "ID caso" },
							{ "title": "Caso" },
							{ "title": "Estacion"}
						],
					  "destroy": true
					} );
				}
				else {
				  
				
					$('#listarT').dataTable( {
						"lengthMenu": [ 100, 250, 500, 750 ],	
						"data": dataSet,
						"language": traduccion,
						"columns": [
							{ "title": "ID caso" },
							{ "title": "Caso" },
							{ "title": "Estacion"}
						]
					});
				}
				
			}

			$('.cargando').fadeOut();
			
		}
	});
}

$(document).ready(function() {
	
	$('.cargando').fadeOut();
	
	//Activar Menu
	$('li#estacionesCasos').addClass('active');
	
	listarEstaciones()
	
$('#agregarEC').click(function(){
	
	$('.cargando').fadeIn();
	
	var idInicial = $('#inicio').val()
	var idFinal = $('#final').val()
	var idUsuario = $('#estacionesPosibles').val()
		
		var stringDatos = 'idCasoInicial='+ idInicial+'&idCasoFinal='+ idFinal+'&idUsuario='+ idUsuario;
	
		$('.cargando').fadeIn();
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/usuarios_casos/agregarEditarUsuariosCasos.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				
				},
			success: function(data){
				var datos = $.parseJSON(unescape(data))
				
				$('h6#agregadas strong').text(datos.agregadas)
				$('h6#editadas strong').text(datos.editadas)
				$('h6#errores strong').text(datos.errores)
				
				$('#ResultadoModal').modal('show')
				
				cargarLista(idUsuario)
				$('.cargando').fadeOut();
			}
		});

	
	
});

$('#agregar1EC').click(function(){
	
	$('.cargando').fadeIn();
	
	var idCaso = $('#idCaso').val()
	var idUsuario = $('#estacionesPosibles2').val()
		
		var stringDatos = 'idCaso='+ idCaso+'&idUsuario='+ idUsuario;
	
		$('.cargando').fadeIn();
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/usuarios_casos/agregarEditarUsuarioCasoIndividual.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				
				},
			success: function(data){
				if(data == 'ok') {
					$('#ResultadoSoloModal h5').text("Asignación realizada correctamente")
				}
				else if (data == 'error'){
					$('#ResultadoSoloModal h5').text("Hubo problemas al asignar, inténtelo nuevamente")
				}
				$('#ResultadoSoloModal').modal('show')
				
				cargarLista(idUsuario)
				$('.cargando').fadeOut();
			}
		});

});

$('#verEC').click(function(){
	
	var idUsuario = $('#estacionesPosiblesVer').val()
	cargarLista(idUsuario)
});

$('#CasosSinEstacion').click(function(){
	cargarCasosSinEstacion()
});

});