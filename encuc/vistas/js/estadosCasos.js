var UrlBaseLimesurvey;
var IdiomaLimesurvey;

function cargarLista() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/estados_casos/listarEstadosCasos.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			if (datos.length != 0) {
				
				var dataSet = new Array()
				
				$('#iniciar').attr('disabled','disabled');
				
				for(i=0; i< datos.length; i++) {
					
					if (!datos[i].valor) {
						datos[i].valor = ''
					}
					if ((!datos[i].agenda) || (datos[i].agenda == "0000-00-00 00:00:00") || (datos[i].agendaF == "00/00 00:00")) {
						datos[i].agendaF = ''
					}
					
					var limesurvey
					
					if (!datos[i].limesurvey_caso) {
						limesurvey = ''
					} else {
						limesurvey = '<a target="-BLANC" href="'+UrlBaseLimesurvey+datos[i].limesurvey_caso+IdiomaLimesurvey+'">'+datos[i].limesurvey_caso+'</a>'
					}
					
					dataSet.push([datos[i].id_caso, datos[i].telefono, datos[i].usrname, datos[i].estado, datos[i].valor, datos[i].agendaF, datos[i].fecha, limesurvey])
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
				
				$('#listarT').dataTable( {
					"lengthMenu": [ 100, 250, 500, 750 ],	
					"data": dataSet,
					"language": traduccion,
					"columns": [
						{ "title": "ID" },
						{ "title": "Telefono" },
						{ "title": "Usuario" },
						{ "title": "Estado"},
						{ "title": "Valor"},
						{ "title": "Agenda"},
						{ "title": "Update"},
						{ "title": "Limesurvey"}
					],
					"order": [[ 6, "desc" ]]
				});
				
				}
			$('.cargando').fadeOut();
		}
	});
}
function cargarUrlBaseLimesurvey() {
	var stringDatos = 'general=Url Base Limesurvey';
	
	$.ajax({
		type: "POST",
		url: "../../../controladores/generales/obtenerGeneralPorNombre.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			UrlBaseLimesurvey = data;	
		}
	});
}
function cargarIdiomaLimesurvey() {
	var stringDatos = 'general=Idioma Limesurvey';
	
	$.ajax({
		type: "POST",
		url: "../../../controladores/generales/obtenerGeneralPorNombre.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			IdiomaLimesurvey = data;	
		}
	});
}
$(document).ready(function() {
	
	//Activar Menu
	$('li#estadosCasos').addClass('active');
	
	cargarUrlBaseLimesurvey()
	cargarIdiomaLimesurvey()
	cargarLista()

$('#iniciar').click(function() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/estados_casos/agregarEstadoCasoInicial.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			$('.cargando').fadeOut();
			cargarLista()
		}
	});
	
});
	
});