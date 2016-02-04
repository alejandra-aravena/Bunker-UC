var idAgenda
var idDescripcion
var UrlBaseLimesurvey;
var IdiomaLimesurvey;

function unformatDate(date) {
	var todo = date.split(" ");
	var fechas = todo[0].split("/")
	var hora = todo[1] + ":00";
	
  return fechas[2] + "-" + fechas[1] + "-" + fechas[0] + " " + hora;
}

function cargarLista() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/casos/listarCasosFueraServicio.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			if (datos) {
				
				var dataSet = new Array()
				
				for(i=0; i< datos.length; i++) {
					
					var linkEncuesta = '<a target="-BLANC" href="'+UrlBaseLimesurvey+datos[i].limesurvey_encuesta+IdiomaLimesurvey+'">'+datos[i].encuesta+'</a>'
					
					var botonDetalleCaso = '<button type="button" class="btn btn-info btn-sm" aria-label="DetallesCaso" data-toggle="modal" data-target="#detalleCasoModal" data-id_caso="'+datos[i].id_caso+'" value="DetalleCaso-'+datos[i].id_caso+'"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button>'
					
					var botonDetalleHist = '<button type="button" class="btn btn-primary btn-sm" aria-label="DetalleHist" data-toggle="modal" data-target="#detalleHistModal" data-id_caso="'+datos[i].id_caso+'" value="DetalleHist-'+datos[i].id_caso+'"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>'
					
					dataSet.push([datos[i].id_caso, datos[i].telefono, datos[i].usrname, linkEncuesta, datos[i].estado, datos[i].fecha, datos[i].intentos_llamada, datos[i].intentos_fservicio, botonDetalleCaso+botonDetalleHist])
					
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
						"order": [[ 5, "desc" ]],
							"columns": [
							{ "title": "ID" },
							{ "title": "Telefono" },
							{ "title": "Estación" },
							{ "title": "Encuesta"},
							{ "title": "Estado"},
							{ "title": "Update"},
							{ "title": "ILL"},
							{ "title": "FS"},
							{ "title": "Administrar"}
						],
					  "destroy": true
					} );
				}
				else {
				
					$('#listarT').dataTable( {
						"lengthMenu": [ 100, 250, 500, 750 ],	
						"data": dataSet,
						"language": traduccion,
						"order": [[ 5, "desc" ]],
						"columns": [
							{ "title": "ID" },
							{ "title": "Telefono" },
							{ "title": "Estación" },
							{ "title": "Encuesta"},
							{ "title": "Estado"},
							{ "title": "Update"},
							{ "title": "ILL"},
							{ "title": "FS"},
							{ "title": "Administrar"}
						]
					});
				}
				
			}
				
				$('.cargando').fadeOut(); 
			
		}
	});
}

function listarEstados() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/estados/listarEstadosConActividad.php",
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
				
				var divAdd = $('#estadosPosibles');
			
				for(i=0; i< datos.length; i++) {
					
			
						var label = $('<label></label>').addClass('btn btn-default').addClass('btn-sm').text(datos[i].estado)
						
						label.append($('<input></input>').attr('type','radio').attr('name','editRadioOptions')
							.attr('id','editRadioOptions'+datos[i].id_estado).val(datos[i].id_estado).attr('data-accion', datos[i].id_accion)
							)
													
						divAdd.append(label)
			
	
				}
			}
			$('.cargando').fadeOut();
			
		}
	});
}
function cargarIDAgenda() {
	var stringDatos = 'general=Id accion con agenda';
	
	$.ajax({
		type: "POST",
		url: "../../../controladores/generales/obtenerGeneralPorNombre.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			idAgenda = data;	
		}
	});
}
function cargarIDDescripcion() {
	var stringDatos = 'general=Id accion con descripcion';
	
	$.ajax({
		type: "POST",
		url: "../../../controladores/generales/obtenerGeneralPorNombre.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			idDescripcion = data;	
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
$(document).on('change', '#estadosPosibles', function(){
	setTimeout(function(){
		
		var accion = $('#estadosPosibles label.btn.btn-default.btn-sm.active input').attr('data-accion')

		if (accion == idDescripcion) {
			//$('#valorInG').fadeIn();
			$('#agendaInG').fadeOut()
		}
		else if (accion == idAgenda) {
			//$('#valorInG').fadeOut();
			$('#agendaInG').fadeIn()
		}
		else {
			//$('#valorInG').fadeOut();
			$('#agendaInG').fadeOut();
		}
	},1)
});
$(document).ready(function() {
	
	//Activar Menu
	$('li#casosFueraServicio').addClass('active');
	
	cargarUrlBaseLimesurvey()
	cargarIdiomaLimesurvey()
	cargarIDAgenda()
	cargarIDDescripcion()
	cargarLista()
	listarEstados()
	
$(function () {
	$('#agendaInCont').datetimepicker({
		locale:				'es',
		sideBySide: 		true,
		showTodayButton:	true,
		showClear:			true
	});
});
	
//Modal detalleCasoModal
$('#detalleCasoModal').on('show.bs.modal', function (event) {
	
	var button = $(event.relatedTarget)
  	var idCaso = button.data('id_caso')
	
	var stringDatos = 'idCaso='+ idCaso;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/casos/detalleCaso.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(dataJson){
				var dato = $.parseJSON(unescape(dataJson))
				
				var table = $('#contenidoDetalleCaso tbody');
				table.html('');
				
				$.each( dato, function( key, value ) {
				  
				  if (key == "id_caso")
				  	key = "ID CASO"
				  if (key == "telefono")
				  	key = "Teléfono"
				  if (key == "intentos_llamada")
				  	key = "Intentos de Llamadas"
				  if (key == "intentos_fservicio")
				  	key = "Intentos Fuera de Servicio"
				  
				  var row = $('<tr></tr>');
			
					row.append($('<td></td>').text(key));
					row.append($('<td></td>').text(value));
					
				 table.append(row);
				});
				
			}
		});
})

//Modal detalleHistModal
$('#detalleHistModal').on('show.bs.modal', function (event) {
	
	$('#estError').fadeOut();
	$('#estOk').fadeOut();
	
	var button = $(event.relatedTarget)
  	var idCaso = button.data('id_caso')
	
	$('#idCasoDH').val(idCaso);
	$('#agendaIn').val('')
  	$('#valorIn').val('')
	$("input[type='radio'][name='editRadioOptions']:checked").parent('.btn').removeClass('active')
	$("input[type='radio'][name='editRadioOptions']:checked").attr('checked', false);
	
	$('#agendaInG').fadeOut();
	
	var stringDatos = 'idCaso='+ idCaso;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/casos/detalleHistorialCaso.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(dataJson){
				var datos = $.parseJSON(unescape(dataJson))
				
				var table = $('#contenidoDetalleHistorial tbody');
				table.html('');
				
				for(i=0; i< datos.length; i++) {
					var row = $('<tr></tr>');
					
					if ((!datos[i].agenda) || (datos[i].agenda == "0000-00-00 00:00:00") || (datos[i].agendaF == "00/00 00:00")) {
						datos[i].agendaF = ''
					} 
					
					if ((!datos[i].limesurvey_caso) ||  (datos[i].limesurvey_caso == 'null')) {
						datos[i].limesurvey_caso = ''
					}
					if ((!datos[i].cdr_caso) || (datos[i].cdr_caso == 'null')) {
						datos[i].cdr_caso = ''
					}
					
					$('#idCasoH strong').text(datos[i].id_caso);
					$('#telefonoH strong').text(datos[i].telefono);
					
					row.append($('<td></td>').text(datos[i].usrname));
					row.append($('<td></td>').text(datos[i].estado));
					row.append($('<td></td>').text(datos[i].valor));
					row.append($('<td></td>').text(datos[i].agendaF));
					row.append($('<td></td>').text(datos[i].fecha));
					row.append($('<td></td>').html($('<a></a>')
							.attr('target', '_BLANC')
							.attr('href',UrlBaseLimesurvey+datos[i].limesurvey_caso+IdiomaLimesurvey)
							.text(datos[i].limesurvey_caso)
					));
					
					table.append(row);
				}
				
			}
		});
})

//Boton guardar detalleHistModal
$('#guardarEstado').on('click', function () {
	
	$('.cargando').fadeIn();
	
   var idCaso = $('input#idCasoDH').val();
	var idEstado = $("input[type='radio'][name='editRadioOptions']:checked").val();
	var idUsuario = $('input#idUsuarioDH').val();
	var agenda =  unformatDate($('#agendaIn').val());
	var valor = $('#valorIn').val()
		
	var stringDatos = 'idCaso='+ idCaso+'&idEstado='+ idEstado+'&idUsuario='+ idUsuario+'&valor='+ valor+'&agenda='+ agenda;

		$.ajax({
			type: "POST",
			url: "../../../controladores/estados_casos/cambiarEstadoCaso.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				if(data == 'ok') {
					$('#estError').fadeOut();
					cargarLista();
					$('#estOk').text('Estado cambiado correctamente');
					$('#estOk').fadeIn('fast', function() {
						setTimeout(function(){$('#detalleHistModal').modal('hide')},1500)
					});
				}
				else if (data == 'error'){
					$('#estError').text('Ocurrio un error, intentelo nuevamente');
					$('#estError').fadeIn();
				}
				
				$('.cargando').fadeOut();
			}
		});
		
})

//Modal detalleCasoModal
$('#detalleCasoModal').on('show.bs.modal', function (event) {
  
})

//Boton descargar excel
$('#descargarExcel').on('click', function () {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/descargas_excel/descargaExcelCasosFueraServicio.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){ 
		
			$('#strDescarga').val(data)
			$('.cargando').fadeOut();
			$('#DescargarModal').modal('show')
			$('#strDescarga2').text(data)
			
		}
	});
});


//DESCARGA DEL LINK
$('#descargarExcelLink').on('click', function () {
	
	var linkstr = $('#strDescarga').val()
	document.location = '../'+linkstr
	$('#DescargarModal').modal('hide')

});

//boton eliminar excel
$('#Eliminar').on('click', function () {
	
	$('.cargando').fadeIn();
	
	var stringDatos = ''
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/descargas_excel/elimnarExcelFilesCasosFueraServicio.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				
				},
			success: function(data){
				$('.cargando').fadeOut();
				
				if (data == "NADA") {
					$('#resultadoEliminar').text("No hay archivos Excel a eliminar")
				} else {
					var datos = $.parseJSON(unescape(data))
					$('#resultadoEliminar').text("Se eliminaron "+datos.correctas+" archivos y "+datos.incorrectas+" no se pudieron eliminar")
				}
				
				$('#EliminarModal').modal('show')
			}
		});
	
});

});