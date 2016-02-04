function cargarLista() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/estados_acciones/listarEstadoAccion.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			var table = $('#listarT tbody');
			table.html('');
			
			for(i=0; i< datos.length; i++) {
				
				var row = $('<tr></tr>');
				row.append($('<td></td>').text(datos[i].estado));
				
				if (!datos[i].accion) {
					row.append($('<td></td>').text(''));
				} else {
					row.append($('<td></td>').text(datos[i].accion));
				}
				
				if (datos[i].prioridad) {
					row.append($('<td></td>').text(datos[i].prioridad));
					
					row.append($('<td></td>')
							.append($('<button></button>')
								.attr('type', 'button')
								.attr('class', 'btn btn-danger btn-sm')
								.attr('aria-label', 'Eliminar')
								.attr('data-toggle', 'modal')
								.attr('data-target', '#eliminarModal')
								.attr('data-idvalue', datos[i].id_accion)
								.attr('data-idvalue2', datos[i].id_estado)
								.attr('data-input1value', datos[i].accion)
								.attr('data-input2value', datos[i].estado)
								.attr('data-input3value', datos[i].prioridad)
								.val('Eliminar-'+datos[i].id_accion)
								.append($('<span></span>')
									.attr('class','glyphicon glyphicon-remove')
									.attr('aria-hidden','true')
								)
							)
					)
				}
				else {
					row.append($('<td></td>').text('**'));
					
					row.append($('<td></td>')
							.append($('<button></button>')
								.attr('type', 'button')
								.attr('class', 'btn btn-success btn-sm')
								.attr('aria-label', 'Editar')
								.attr('data-toggle', 'modal')
								.attr('data-target', '#editarModal')
								.attr('data-idvalue', datos[i].id_accion)
								.attr('data-input1value', datos[i].accion)
								.attr('data-idvalue2', datos[i].id_estado)
								.attr('data-input2value', datos[i].estado)
								.attr('data-input3value', datos[i].prioridad)
								.attr('data-tipo', 'Agregar')
								.val('Editar-'+datos[i].id_estado)
								.append($('<span></span>')
									.attr('class','glyphicon glyphicon-plus')
									.attr('aria-hidden','true')
								)
							)
					)
				}
						
				table.append(row);
				
				$('.cargando').fadeOut();
			}
			
		}
	});
}

$(document).ready(function() {
	
	//Activar Menu
	$('li#estadosAcciones').addClass('active');
	
	cargarLista()

//Modal Agregar
$('#editarModal').on('show.bs.modal', function (event) {
  $('#editMalRelleno').fadeOut();
  $('#editError').fadeOut();
  $('#editOk').fadeOut();
  $('#addInput3').val('')
  
  $('#editarBtn').removeAttr('disabled');
  
  var button = $(event.relatedTarget)
  var idValue = button.data('idvalue')
  var input1value = button.data('input1value')
  var idValue2 = button.data('idvalue2')
  var input2value = button.data('input2value')
  var input3value = button.data('input3value')
  var tipo = button.data('tipo')
  
  if (tipo == 'Agregar') {
	  $(this).find('.modal-title').text('Agregar Estado - Accion');
  } else {
  	$(this).find('.modal-title').text('Editar Estado - Accion');
  }
  
  $('h5#addText strong').text(input2value)
  $('#addAccionesList').html('');
  $('#idEstadoAdd').val(idValue2); 
  $('#addEditInput3').val(input3value)
  
  $.ajax({
			type: "POST",
			url: "../../../controladores/acciones/listarAcciones.php",
			data: '',
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				var datos = $.parseJSON(unescape(data))
			
				if(datos) {
					$('#editError').fadeOut();
					
					if (tipo == 'Agregar') {
							  $('#addAccionesList').append(
								$('<option></option>').text('Seleccione...')
							);
						  }
					
					for(i=0; i< datos.length; i++) {
						if (idValue == datos[i].id_accion) {
							$('#addAccionesList').append(
								$('<option></option>').text(datos[i].accion).attr('value',datos[i].id_accion).attr('selected', 'selected')
							);
						}
						else {
							$('#addAccionesList').append(
								$('<option></option>').text(datos[i].accion).attr('value',datos[i].id_accion)
							);
						}
						
					}
				}
				else {
					$('#editMalRelleno').text('Ocurrio un error, intentelo nuevamente');
					$('#editMalRelleno').fadeIn();
				}
			}
		});
  
})

//Boton guardar agregar editar
$('#editarBtn').on('click', function () {
    var btnVal = $('#addInput3').val();
	var idVal = $('#idEstadoAdd').val();
	var selVal = $('#addAccionesList').val();
	
	if (btnVal != '') {
		
		$('#editMalRelleno').fadeOut();
		
		var stringDatos = 'id_estado='+ idVal+'&id_accion='+ selVal+'&prioridad='+ btnVal;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/estados_acciones/agregarEstadoAccion.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				if(data == 'ok') {
					$('#editError').fadeOut();
					
					$('#editOk').text('Estado - Accion agregada correctamente');
					$('#editOk').fadeIn('fast', function() {
						$('#editarBtn').attr('disabled','disabled');
						cargarLista()
						setTimeout(function(){$('#editarModal').modal('hide')},1500)
					});
				}
				else if (data == 'error'){
					$('#editError').text('Ocurrio un error, intentelo nuevamente');
					$('#editError').fadeIn();
				}
			}
		});
	}
	else {
		$('#editMalRelleno').text('Debe indicar la prioridad');
		$('#editMalRelleno').fadeIn();
	}
})

//Modal Eliminar
$('#eliminarModal').on('show.bs.modal', function (event) {
  $('#delError').fadeOut();
  $('#delOk').fadeOut();
  
  $('#eliminarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Eliminar Accion');
  
  var button = $(event.relatedTarget)
  var idValue = button.data('idvalue')
  var input1value = button.data('input1value')
  var idValue2 = button.data('idvalue2')
  var input2value = button.data('input2value')

  $('#delText').text(input1value)
  $('#idAccDel').val(idValue);
  $('#delText2').text(input2value)
  $('#idEstDel').val(idValue2);
})

//Boton eliminar
$('#eliminarBtn').on('click', function () {
	var idVal = $('#idEstDel').val();
	var idVal2 = $('#idAccDel').val();
		
	var stringDatos = 'id_estado='+ idVal+'&id_accion='+ idVal2;
		
	$.ajax({
		type: "POST",
		url: "../../../controladores/estados_acciones/eliminarEstadoAccion.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			if(data == 'ok') {
				$('#delError').fadeOut();
					
				$('#delOk').text('Accion eliminada correctamente');
				$('#delOk').fadeIn('fast', function() {
					$('#eliminarBtn').attr('disabled','disabled');
					cargarLista()
					setTimeout(function(){$('#eliminarModal').modal('hide')},1500)
				});
			}
			else {
				$('#delError').text('Ocurrio un error, intentelo nuevamente');
				$('#delError').fadeIn();
			}
			}
		});
})
	
});