function cargarLista(idEncuesta) {
	$('.cargando').fadeIn();
	
	var stringDatos = 'idEncuesta='+idEncuesta;
	$.ajax({
		type: "POST",
		url: "../../../controladores/encuestas_casos/listarXidEncuestasCasos.php",
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
					
					dataSet.push([datos[i].id_caso, datos[i].telefono, datos[i].encuesta])
					
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
							{ "title": "Encuesta" }
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
							{ "title": "Encuesta" }
						]
					});
				}
			}
			$('.cargando').fadeOut();
			
		}
	});
}

function listarEncuestas() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/encuestas/listarEncuestas.php",
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
				
				var divAdd = $('#encuestasPosibles');
				var divAdd2 = $('#encuestasPosibles2');
				var divAddVer = $('#encuestasPosiblesVer');
			
				for(i=0; i< datos.length; i++) {
					
						var option = $('<option></option>').text(datos[i].encuesta).attr('value',datos[i].id_encuesta)
						var option2 = $('<option></option>').text(datos[i].encuesta).attr('value',datos[i].id_encuesta)
						var optionVer = $('<option></option>').text(datos[i].encuesta).attr('value',datos[i].id_encuesta)
				
						divAdd.append(option)
						divAdd2.append(option2)
						divAddVer.append(optionVer)
				}
			}
			$('.cargando').fadeOut();
			
		}
	});
}

function cargarCasosSinEncuesta() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/encuestas_casos/listarEncuestasSinCasos.php",
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
						datos[i].encuesta = '--'
					}
					
					dataSet.push([datos[i].id_caso, datos[i].telefono, datos[i].encuesta])
					
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
							{ "title": "Encuesta" }
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
							{ "title": "Encuesta" }
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
	$('li#encuestasCasos').addClass('active');
	
	listarEncuestas()
	
$('#agregarEC').click(function(){
	
	$('.cargando').fadeIn();
	
	var idInicial = $('#inicio').val()
	var idFinal = $('#final').val()
	var idEncuesta = $('#encuestasPosibles').val()
		
		var stringDatos = 'idCasoInicial='+ idInicial+'&idCasoFinal='+ idFinal+'&idEncuesta='+ idEncuesta;
	
		$('.cargando').fadeIn();
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/encuestas_casos/agregarEncuestasCasos.php",
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
				
				cargarLista(idEncuesta)
				$('.cargando').fadeOut();
			}
		});
	
});

$('#agregar1EC').click(function(){
	
	$('.cargando').fadeIn();
	
	var idCaso = $('#idCaso').val()
	var idEncuesta = $('#encuestasPosibles2').val()
		
		var stringDatos = 'idCaso='+ idCaso+'&idEncuesta='+ idEncuesta;
	
		$('.cargando').fadeIn();
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/encuestas_casos/agregarEncuestaCasoIndividual.php",
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
				
				cargarLista(idEncuesta)
				$('.cargando').fadeOut();
			}
		});
});


$('#verEC').click(function(){
	
	var idEncuesta = $('#encuestasPosiblesVer').val()
	cargarLista(idEncuesta)
});

$('#CasosSinEncuesta').click(function(){
	cargarCasosSinEncuesta()
});
	

});