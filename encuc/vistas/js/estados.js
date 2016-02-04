function cargarLista() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/estados/listarEstados.php",
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
				row.append($('<td></td>').text(datos[i].id_estado));
				row.append($('<td></td>').text(datos[i].estado));
				row.append($('<td></td>').text(datos[i].descripcion));
				
				//<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
				if (datos[i].visibilidad == 1) {
					row.append(
						$('<td></td>').addClass('visibilidad-1').append(
							$('<span></span>')
								.addClass('glyphicon')
								.addClass('glyphicon-ok-circle')
								.attr('aria-hidden', 'true')
						)
					);
				} else {
					row.append(
						$('<td></td>').addClass('visibilidad-0').append(
							$('<span></span>')
								.addClass('glyphicon')
								.addClass('glyphicon-remove-circle')
								.attr('aria-hidden', 'true')
						)
					);
				}
				
				row.append($('<td></td>')
							.append($('<button></button>')
								.attr('type', 'button')
								.attr('class', 'btn btn-primary btn-sm')
								.attr('aria-label', 'Editar')
								.attr('data-toggle', 'modal')
								.attr('data-target', '#editarModal')
								.attr('data-idvalue', datos[i].id_estado)
								.attr('data-input1value', datos[i].estado)
								.attr('data-input2value', datos[i].descripcion)
								.attr('data-radiooptions', datos[i].visibilidad)
								.val('Editar-'+datos[i].id_estado)
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
								.attr('data-idvalue', datos[i].id_estado)
								.attr('data-input1value', datos[i].estado)
								.val('Eliminar-'+datos[i].id_estado)
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
	$('li#estados').addClass('active');
	
	cargarLista()
	
//Modal Agregar
$('#agregarModal').on('show.bs.modal', function (event) {
  $('#addMalRelleno').fadeOut();
  $('#addError').fadeOut();
  $('#addOk').fadeOut();
  $('#addInput1').val('');
  $('#addInput2').val('');
  $('#addRadioOptions1').attr('checked', false);
  $('#addRadioOptions2').attr('checked', false);
  
  $('#agregarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Agregar Estado');
})

//Boton guardar agregar
$('#agregarBtn').on('click', function () {
    var btnVal = $('#addInput1').val();
	var btnVal2 = $('#addInput2').val();
	var radioOpt = $("input[type='radio'][name='addRadioOptions']:checked").val();
	
	if (!radioOpt) {
		$('#addMalRelleno').text('Debe indicar la visibilidad del estado');
		$('#addMalRelleno').fadeIn();
	}
	else if (btnVal != '') {
		
		$('#addMalRelleno').fadeOut();
		
		var stringDatos = 'estado='+ btnVal+'&desc='+ btnVal2+'&vis='+ radioOpt;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/estados/agregarEstado.php",
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
		$('#addMalRelleno').text('Debe indicar el nombre del estado');
		$('#addMalRelleno').fadeIn();
	}
})

//Modal Editar
$('#editarModal').on('show.bs.modal', function (event) {
  $('#editMalRelleno').fadeOut();
  $('#editError').fadeOut();
  $('#editOk').fadeOut();
  
  $('#editarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Editar Estado');
  
  var button = $(event.relatedTarget)
  var idValue = button.data('idvalue')
  var input1value = button.data('input1value')
  var input2value = button.data('input2value')
  var radioOptions = button.data('radiooptions')
 
  if (radioOptions == '1') {
	  $('#editRadioOptions1').attr('checked', 'checked');
	  $('#editRadioOptions1').parent('.btn').addClass('active')
  	  $('#editRadioOptions').attr('checked', false);
	  $('#editRadioOptions2').parent('.btn').removeClass('active')
  }
  else {
	  $('#editRadioOptions1').attr('checked', false);
	  $('#editRadioOptions1').parent('.btn').removeClass('active')
  	  $('#editRadioOptions').attr('checked', 'checked');
	  $('#editRadioOptions2').parent('.btn').addClass('active')
  }
  
  $('#editInput1').val(input1value);
  $('#editInput2').val(input2value);
  $('#idEdit').val(idValue);
  
  
})

//Boton guardar editar
$('#editarBtn').on('click', function () {
    var btnVal = $('#editInput1').val();
	var idVal = $('#idEdit').val();
	var btnVal2 = $('#editInput2').val();
	var radioOpt = $("input[type='radio'][name='editRadioOptions']:checked").val();
	
	if (btnVal != '') {
		
		$('#editMalRelleno').fadeOut();
		
		var stringDatos = 'estado='+ btnVal+'&id_estado='+ idVal+'&desc='+ btnVal2+'&vis='+ radioOpt;

		$.ajax({
			type: "POST",
			url: "../../../controladores/estados/editarEstado.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				if(data == 'ok') {
					$('#editError').fadeOut();
					
					$('#editOk').text('Estado editado correctamente');
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
		$('#editMalRelleno').text('Debe indicar el nombre del estado');
		$('#editMalRelleno').fadeIn();
	}
})

//Modal Eliminar
$('#eliminarModal').on('show.bs.modal', function (event) {
  $('#delError').fadeOut();
  $('#delOk').fadeOut();
  
  $('#eliminarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Eliminar Estado');
  
  var button = $(event.relatedTarget)
  var idValue = button.data('idvalue')
  var input1value = button.data('input1value')

  $('#delText').text(input1value)
  $('#idDel').val(idValue);
})

//Boton eliminar
$('#eliminarBtn').on('click', function () {
	var idVal = $('#idDel').val();
		
	var stringDatos = 'id_estado='+ idVal;
		
	$.ajax({
		type: "POST",
		url: "../../../controladores/estados/eliminarEstado.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			if(data == 'ok') {
				$('#delError').fadeOut();
					
				$('#delOk').text('Estado eliminado correctamente');
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