function cargarLista() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/acciones/listarAcciones.php",
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
				row.append($('<td></td>').text(datos[i].id_accion));
				row.append($('<td></td>').text(datos[i].accion));
				
				row.append($('<td></td>')
							.append($('<button></button>')
								.attr('type', 'button')
								.attr('class', 'btn btn-primary btn-sm')
								.attr('aria-label', 'Editar')
								.attr('data-toggle', 'modal')
								.attr('data-target', '#editarModal')
								.attr('data-idvalue', datos[i].id_accion)
								.attr('data-input1value', datos[i].accion)
								.val('Editar-'+datos[i].id_accion)
								.append($('<span></span>')
									.attr('class','glyphicon glyphicon-pencil')
									.attr('aria-hidden','true')
								)
							)
							.append($('<button></button>')
								.attr('type', 'button')
								.attr('class', 'btn btn-danger btn-sm')
								.attr('aria-label', 'Eliminar')
								.attr('data-toggle', 'modal')
								.attr('data-target', '#eliminarModal')
								.attr('data-idvalue', datos[i].id_accion)
								.attr('data-input1value', datos[i].accion)
								.val('Eliminar-'+datos[i].id_accion)
								.append($('<span></span>')
									.attr('class','glyphicon glyphicon-remove')
									.attr('aria-hidden','true')
								)
							)
					)
						
				table.append(row);
				
				$('.cargando').fadeOut();
			}
			
		}
	});
}

$(document).ready(function() {
	
	//Activar Menu
	$('li#acciones').addClass('active');
	
	cargarLista()
	
//Modal Agregar
$('#agregarModal').on('show.bs.modal', function (event) {
  $('#addMalRelleno').fadeOut();
  $('#addError').fadeOut();
  $('#addOk').fadeOut();
  $('#addInput1').val('');
  
  $('#agregarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Agregar Accion');
})

//Boton guardar agregar
$('#agregarBtn').on('click', function () {
    var btnVal = $('#addInput1').val();
	
	if (btnVal != '') {
		
		$('#addMalRelleno').fadeOut();
		
		var stringDatos = 'accion='+ btnVal;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/acciones/agregarAccion.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				if(data == 'ok') {
					$('#addError').fadeOut();
					
					$('#addOk').text('Accion agregada correctamente');
					$('#addOk').fadeIn('fast', function() {
						$('#agregarBtn').attr('disabled','disabled');
						cargarLista()
						setTimeout(function(){$('#agregarModal').modal('hide')},1500)
					});
				}
				else if (data == 'error'){
					$('#addError').text('Ocurrio un error, intentelo nuevamente');
					$('#addError').fadeIn();
				}
			}
		});
	}
	else {
		$('#addMalRelleno').text('Debe indicar el nombre de la accion (descripción)');
		$('#addMalRelleno').fadeIn();
	}
})

//Modal Editar
$('#editarModal').on('show.bs.modal', function (event) {
  $('#editMalRelleno').fadeOut();
  $('#editError').fadeOut();
  $('#editOk').fadeOut();
  
  $('#editarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Editar Accion');
  
  var button = $(event.relatedTarget)
  var idValue = button.data('idvalue')
  var input1value = button.data('input1value')
  
  $('#editInput1').val(input1value);
  $('#idEdit').val(idValue);
  
  
})

//Boton guardar editar
$('#editarBtn').on('click', function () {
    var btnVal = $('#editInput1').val();
	var idVal = $('#idEdit').val();
	
	if (btnVal != '') {
		
		$('#editMalRelleno').fadeOut();
		
		var stringDatos = 'accion='+ btnVal+'&id_accion='+ idVal;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/acciones/editarAccion.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				if(data == 'ok') {
					$('#editError').fadeOut();
					
					$('#editOk').text('Accion editada correctamente');
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
		$('#editMalRelleno').text('Debe indicar el nombre de la accion');
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

  $('#delText').text(input1value)
  $('#idDel').val(idValue);
})

//Boton eliminar
$('#eliminarBtn').on('click', function () {
	var idVal = $('#idDel').val();
		
	var stringDatos = 'id_accion='+ idVal;
		
	$.ajax({
		type: "POST",
		url: "../../../controladores/acciones/eliminarAccion.php",
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