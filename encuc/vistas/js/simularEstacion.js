var idsEstados = new Array()
var idAgenda
var idDescripcion
var idEstacionSel
var UrlBaseLimesurvey;
var IdiomaLimesurvey;
var columnasVisibles = new Array();
var NOM = 0;
var PAT = 0;
var MAt = 0;

function unformatDate(date) {
	var todo = date.split(" ");
	var fechas = todo[0].split("/")
	var hora = todo[1] + ":00";
	
  return fechas[2] + "-" + fechas[1] + "-" + fechas[0] + " " + hora;
}

function cargarListaAgenda(idUsuario) {
	$('.cargando').fadeIn();
	
	var stringDatos = 'idUsuario='+idUsuario;
	$.ajax({
		type: "POST",
		url: "../../../controladores/estaciones/listarXidUsuariosCasosAgenda.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			if (data == "NADA") {
				$('.cargando').fadeOut();
				$('#listarAgenda').fadeOut();
				$('#agendaRes').fadeIn();
				return false;
			}
			
			var datos = $.parseJSON(unescape(data))
			
			var table = $('#listarAgenda tbody');
			table.html('');
			
			if (datos.length == 0) {
				$('.cargando').fadeOut();
				$('#listarAgenda').fadeOut();
				$('#agendaRes').fadeIn();
			}
			else {
			
				for(i=0; i< datos.length; i++) {
		
					var row = $('<tr></tr>');
					row.append($('<td></td>').text(datos[i].id_caso));
					row.append($('<td></td>').text(datos[i].telefono));
					
					row.append($('<td></td>').text(datos[i].NOMBRE+" "+datos[i].PATERNO+" "+datos[i].MATERNO));
					row.append($('<td></td>').text(datos[i].COMUNA));
					
					row.append($('<td></td>').html($('<a></a>')
							.attr('target', '_BLANC')
							.attr('href',UrlBaseLimesurvey+datos[i].limesurvey_encuesta+IdiomaLimesurvey)
							.text(datos[i].encuesta)
					
					));
					row.append($('<td></td>').text(datos[i].estado));
					row.append($('<td></td>').text(datos[i].valor));
					row.append($('<td></td>').text(datos[i].agendaF));
					
					
					var idUsuario = $("input[type='radio'][name='estRadioOptions']:checked").val();
					
					row.append($('<td></td>')
								.append($('<button></button>')
									.attr('type', 'button')
									.attr('class', 'btn btn-primary btn-sm')
									.attr('aria-label', 'Editar')
									.attr('data-toggle', 'modal')
									.attr('data-target', '#editarModal')
									.attr('data-id_caso', datos[i].id_caso)
									.attr('data-id_usuario', idUsuario)
									.attr('data-id_estado', datos[i].id_estado)
									.attr('data-ip_estacion', datos[i].ip_estacion)
									.attr('data-valor', datos[i].valor)
									.attr('data-agenda', datos[i].agendaF)
									.val('Editar-'+datos[i].id_caso)
									.append($('<span></span>')
										.attr('class','glyphicon glyphicon-pencil')
										.attr('aria-hidden','true')
									)
								)
						)
							
					table.append(row);
				}
				$('#agendaRes').fadeOut();
				$('#listarAgenda').fadeIn();
			}
			$('.cargando').fadeOut();
			
		}
	});
}
function cargarListaNormal(idUsuario) {
	$('.cargando').fadeIn();
	
	var stringDatos = 'idUsuario='+idUsuario;
	$.ajax({
		type: "POST",
		url: "../../../controladores/estaciones/listarXidUsuariosCasosNormal.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			if (data == "NADA") {
				$('.cargando').fadeOut();
				$('#listarNormal').fadeOut();
				$('#normalRes').fadeIn();
				return false;
			}
			
			var datos = $.parseJSON(unescape(data))
			
			var table = $('#listarNormal tbody');
			table.html('');
			
			if (datos.length == 0) {
				$('.cargando').fadeOut();
				$('#listarNormal').fadeOut();
				$('#normalRes').fadeIn();
			}
			else {
			
				for(i=0; i< datos.length; i++) {
					
					console.log(datos[i])
					
					if (!datos[i].encuesta) {
						datos[i].encuesta = ''
					}
					
					var row = $('<tr></tr>');
					row.append($('<td></td>').text(datos[i].id_caso));
					row.append($('<td></td>').text(datos[i].telefono));
					
					for (j=0; j< columnasVisibles.length; j++) {
						
						if ((columnasVisibles[j] == 'NOMBRE') || (columnasVisibles[j] == 'PATERNO') || (columnasVisibles[j] == 'MATERNO')) {
							
						}
						else {
							row.append($('<td></td>').text(datos[i][columnasVisibles[j]]));
						}
					}
					
					var nombreCompleto = '';
					if ((NOM == 1) && (PAT == 1) && (MAT == 1)) {
						nombreCompleto = datos[i].NOMBRE+" "+datos[i].PATERNO+" "+datos[i].MATERNO
					}
					else if ((NOM == 1) && (PAT == 1) && (MAT == 0)) {
						nombreCompleto = datos[i].NOMBRE+" "+datos[i].PATERNO
					}
					else if ((NOM == 1) && (PAT == 0) && (MAT == 1)) {
						nombreCompleto = datos[i].NOMBRE+" "+datos[i].MATERNO
					}
					else if ((NOM == 0) && (PAT == 1) && (MAT == 1)) {
						nombreCompleto = datos[i].PATERNO+" "+datos[i].MATERNO
					}
					
					row.append($('<td></td>').text(nombreCompleto));
					
					row.append($('<td></td>').html($('<a></a>')
							.attr('target', '_BLANC')
							.attr('href',UrlBaseLimesurvey+datos[i].limesurvey_encuesta+IdiomaLimesurvey)
							.text(datos[i].encuesta)
					
					));
					row.append($('<td></td>').text(datos[i].estado));
					row.append($('<td></td>').text(datos[i].valor));
					
					var idUsuario = $("input[type='radio'][name='estRadioOptions']:checked").val();
					
					row.append($('<td></td>')
								.append($('<button></button>')
									.attr('type', 'button')
									.attr('class', 'btn btn-primary btn-sm')
									.attr('aria-label', 'Editar')
									.attr('data-toggle', 'modal')
									.attr('data-target', '#editarModal')
									.attr('data-id_caso', datos[i].id_caso)
									.attr('data-id_usuario', idUsuario)
									.attr('data-id_estado', datos[i].id_estado)
									.attr('data-ip_estacion', datos[i].ip_estacion)
									.attr('data-valor', datos[i].valor)
									.attr('data-agenda', datos[i].agendaF)
									.val('Editar-'+datos[i].id_caso)
									.append($('<span></span>')
										.attr('class','glyphicon glyphicon-pencil')
										.attr('aria-hidden','true')
									)
								)
						)
							
					table.append(row);
				}
				$('#normalRes').fadeOut();
				$('#listarNormal').fadeIn();
				
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
					
					if (datos[i].visibilidad == 1) {
						var label = $('<label></label>').addClass('btn btn-default').addClass('btn-sm').text(datos[i].estado)
						
						label.append($('<input></input>').attr('type','radio').attr('name','editRadioOptions')
							.attr('id','editRadioOptions'+datos[i].id_estado).val(datos[i].id_estado).attr('data-accion', datos[i].id_accion)
							)
							
							idsEstados.push(datos[i].id_estado)
							
						divAdd.append(label)
					}
	
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
			
				for(i=0; i< datos.length; i++) {
					
						var label = $('<label></label>').addClass('btn btn-default').addClass('btn-sm').text(datos[i].usrname)
						
						label.append($('<input></input>').attr('type','radio').attr('name','estRadioOptions')
							.attr('id','estRadioOptions'+datos[i].id_usuario).val(datos[i].id_usuario)
							)
							
							
						divAdd.append(label)
				}
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

function cargarColumnasVisibles() {
	var stringDatos = '';
	
	$.ajax({
		type: "POST",
		url: "../../../controladores/columnas_visibilidad/listarSoloColumnasVisibles.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			var datos = $.parseJSON(unescape(data))	
			
			if (datos.length != 0) {
					
				var tableA = $('#listarAgenda thead');
				tableA.html('');
				var tableN = $('#listarNormal thead');
				tableN.html('');
				
				var row = $('<tr></tr>');
				row.append($('<th></th>').text('ID'));
				row.append($('<th></th>').text('TELÉFONO'));
				
				var row2 = $('<tr></tr>');
				row2.append($('<th></th>').text('ID'));
				row2.append($('<th></th>').text('TELÉFONO'));
				
				for(i=0; i< datos.length; i++) {
					if ((datos[i].nombre_columna != 'id_caso') && (datos[i].nombre_columna != 'telefono')) {
						
						columnasVisibles.push(datos[i].nombre_columna);
						
						if (datos[i].nombre_columna == 'NOMBRE') {
							NOM = 1;
						}
						else if (datos[i].nombre_columna == 'PATERNO') {
							PAT = 1;
						}
						else if (datos[i].nombre_columna == 'MATERNO') {
							MAT = 1;
						}
						else {
							row.append($('<th></th>').text(datos[i].nombre_columna));
							row2.append($('<th></th>').text(datos[i].nombre_columna));
						}
						
					}
			    }
				
				if ((NOM == 1) || (PAT == 1) || (MAT == 1)) {
					row.append($('<th></th>').text('NOMBRE COMP'));
					row2.append($('<th></th>').text('NOMBRE COMP'));
				}
				
				row.append($('<th></th>').text('Encuesta'));
				row.append($('<th></th>').text('Estado'));
				row.append($('<th></th>').text('Desc'));
				row.append($('<th></th>').text('Agenda'));
				row.append($('<th></th>').text('Cambiar Estado'));
				
				row2.append($('<th></th>').text('Encuesta'));
				row2.append($('<th></th>').text('Estado'));
				row2.append($('<th></th>').text('Desc'));
				row2.append($('<th></th>').text('Cambiar Estado'));
				
				tableA.append(row);
				tableN.append(row2);
			}
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
	
	$('.cargando').fadeOut();
	$('#listarT').fadeOut();
	
	//Activar Menu
	$('li#simularEstacion').addClass('active');
	
	cargarColumnasVisibles();
	
	cargarUrlBaseLimesurvey()
	cargarIdiomaLimesurvey()
	cargarIDAgenda()
	cargarIDDescripcion()
	listarEstados()
	listarEstaciones()

$('#verEst').click(function(){
	
	//var idUsuario = $('#usuarioVer').val()
	var idUsuario = $("input[type='radio'][name='estRadioOptions']:checked").val();
	
	if (!idUsuario) {
		return false;
	}
	
	cargarListaNormal(idUsuario)
	cargarListaAgenda(idUsuario)
});

$(function () {
	$('#agendaInCont').datetimepicker({
		locale:				'es',
		sideBySide: 		true,
		showTodayButton:	true,
		showClear:			true
	});
});
        
//Modal Editar
$('#editarModal').on('show.bs.modal', function (event) {
  $('#editMalRelleno').fadeOut();
  $('#editError').fadeOut();
  $('#editOk').fadeOut();
  
  $('#editarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Cambiar Estado');
  
  $.each(idsEstados, function(i, val) {
	if (idEstado == val) {
		$('#editRadioOptions'+val).attr('checked', 'checked');
	    $('#editRadioOptions'+val).parent('.btn').addClass('active')
	} else {
		$('#editRadioOptions'+val).attr('checked', false);
	  	$('#editRadioOptions'+val).parent('.btn').removeClass('active')
	}
	  
	})
	
	$('input#idCaso').val('');
  	$('input#idUsuario').val('');
 	$('#agendaIn').val('')
  	$('#valorIn').val('')
	$('#ipEstacion').val('')

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
		
	var button = $(event.relatedTarget)
  	var idCaso = button.data('id_caso')
  	var idEstado = button.data('id_estado')
  	var idUsuario = button.data('id_usuario')
	var ipEstacion = button.data('ip_estacion')
  
	$('input#idUsuario').val(idUsuario);
	$('input#idCaso').val(idCaso);
	$('input#ipEstacion').val(ipEstacion);
})

//Boton guardar editar
$('#editarBtn').on('click', function () {
    var idCaso = $('input#idCaso').val();
	var idEstado = $("input[type='radio'][name='editRadioOptions']:checked").val();
	var idUsuario = $('input#idUsuario').val();
	var agenda =  unformatDate($('#agendaIn').val());
	var valor = $('#valorIn').val()
	var ipEstacion = $('input#ipEstacion').val();
		
	var stringDatos = 'idCaso='+ idCaso+'&idEstado='+ idEstado+'&idUsuario='+ idUsuario+'&valor='+ valor+'&agenda='+ agenda+'&ipEstacion='+ ipEstacion;

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
					$('#editError').fadeOut();
					
					$('#editOk').text('Estado cambiado correctamente');
					$('#editOk').fadeIn('fast', function() {
						$('#editarBtn').attr('disabled','disabled');
						cargarListaAgenda(idUsuario)
						cargarListaNormal(idUsuario)
						setTimeout(function(){$('#editarModal').modal('hide')},1500)
					});
				}
				else if (data == 'error'){
					$('#editError').text('Ocurrio un error, intentelo nuevamente');
					$('#editError').fadeIn();
				}
			}
		});
		
	})
});