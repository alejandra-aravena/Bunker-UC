var idsEstados = new Array()

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
				
				var divAdd = $('#estadoOriginal');
				var divAdd2 = $('#estadoNuevo')
			
				for(i=0; i< datos.length; i++) {
					
					if (datos[i].visibilidad == 1) {
						var label = $('<label></label>').addClass('btn btn-default').addClass('btn-sm').text(datos[i].estado)
						var label2 = $('<label></label').addClass('btn btn-default').addClass('btn-sm').text(datos[i].estado)
												
						label.append($('<input></input>').attr('type','radio').attr('name','estOriginalRadioOptions')
							.attr('id','estOriginalRadioOptions'+datos[i].id_estado).val(datos[i].id_estado).attr('data-accion', datos[i].id_accion)
							)
							
						label2.append($('<input></input>').attr('type','radio').attr('name','estNuevoRadioOptions')
							.attr('id','estNuevoRadioOptions'+datos[i].id_estado).val(datos[i].id_estado).attr('data-accion', datos[i].id_accion)
							)
						
							
						divAdd.append(label)
						divAdd2.append(label2)
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
						
						label.append($('<input></input>').attr('type','radio').attr('name','estacionRadioOptions')
							.attr('id','estacionRadioOptions'+datos[i].id_usuario).val(datos[i].id_usuario)
							)
							
							
						divAdd.append(label)
				}
			}
			$('.cargando').fadeOut();
			
		}
	});
}





$(document).ready(function() {
	
	$('.cargando').fadeOut();
	
	//Activar Menu
	$('li#cambioEstado').addClass('active');
	
	listarEstados()
	listarEstaciones()

$('#verEst').click(function(){
	
	//var idUsuario = $('#usuarioVer').val()
	
	
});

$('#editEstado').click(function() {
	
	$('.cargando').fadeIn();
	
	var idUsuario = $("input[type='radio'][name='estacionRadioOptions']:checked").val();
	var idEstadoAnterior = $("input[type='radio'][name='estOriginalRadioOptions']:checked").val();
	var idEstadoNuevo = $("input[type='radio'][name='estNuevoRadioOptions']:checked").val();
	
	if (!idUsuario) {
		alert('Seleccione Estación')
		return false;
	}
	if (!idEstadoAnterior) {
		alert('Seleccione Estado a Corregir')
		return false;
	}
	if (!idEstadoNuevo) {
		alert('Seleccione Nuevo Estado')
		return false;
	}
	
	var stringDatos = 'idUsuario='+ idUsuario+'&idEstadoAnterior='+ idEstadoAnterior+'&idEstadoNuevo='+ idEstadoNuevo;
		
	$.ajax({
		type: "POST",
		url: "../../../controladores/estados_casos/agregarEstadoCasoMasivo.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		error: function() {
			$('.cargando').fadeOut();
			$('#operacionError').fadeIn();
			setTimeout(function(){$('#operacionError').fadeOut()},1500)
		},
		success: function(dataJson){
			
			var datos = $.parseJSON(unescape(dataJson))
				
			if (datos.length == 0) {
				$('.cargando').fadeOut();
				$('#listadoRes').fadeIn();
			}
				
			var table = $('#listarCambiados tbody');
			table.html('');
				
			for(i=0; i< datos.length; i++) {
				  
				var row = $('<tr></tr>');
			
				row.append($('<td></td>').text(datos[i].caso));
				row.append($('<td></td>').text('Editar Estado'));
				row.append($('<td></td>').text(datos[i].resultado));
					
				table.append(row);
			}
	
			$('.table-responsive').fadeIn();
			$('.cargando').fadeOut();
				
		}
	});
});

$('#addEstado').click(function() {
	
	$('.cargando').fadeIn();
	
	var idUsuario = $("input[type='radio'][name='estacionRadioOptions']:checked").val();
	var idEstadoAnterior = $("input[type='radio'][name='estOriginalRadioOptions']:checked").val();
	var idEstadoNuevo = $("input[type='radio'][name='estNuevoRadioOptions']:checked").val();
	
	if (!idUsuario) {
		alert('Seleccione Estación')
		return false;
	}
	if (!idEstadoAnterior) {
		alert('Seleccione Estado a Corregir')
		return false;
	}
	if (!idEstadoNuevo) {
		alert('Seleccione Nuevo Estado')
		return false;
	}
	
	var stringDatos = 'idUsuario='+ idUsuario+'&idEstadoAnterior='+ idEstadoAnterior+'&idEstadoNuevo='+ idEstadoNuevo;
		
	$.ajax({
		type: "POST",
		url: "../../../controladores/estados_casos/agregarEstadoCasoMasivo.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		error: function() {
			$('.cargando').fadeOut();
			$('#operacionError').fadeIn();
			setTimeout(function(){$('#operacionError').fadeOut()},1500)
		},
		success: function(dataJson){
			
			var datos = $.parseJSON(unescape(dataJson))
			
			if (datos.length == 0) {
				$('.cargando').fadeOut();
				$('#listadoRes').fadeIn();
			}
				
			var table = $('#listarCambiados tbody');
			table.html('');
				
			for(i=0; i< datos.length; i++) {
				  
				var row = $('<tr></tr>');
			
				row.append($('<td></td>').text(datos[i].caso));
				row.append($('<td></td>').text('Agregar Estado'));
				row.append($('<td></td>').text(datos[i].resultado));
					
				table.append(row);
			}
	
			$('.table-responsive').fadeIn();
			$('.cargando').fadeOut();
				
		}
	});
});

});