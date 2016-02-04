function cargarLista() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/columnas_visibilidad/listarColumnasVisibilidad.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			if (datos.length != 0) {
				
				$('#sincro').attr('disabled','disabled');
				
				var table = $('#listarT tbody');
				table.html('');
				
				for(i=0; i< datos.length; i++) {
					
					var row = $('<tr></tr>');
					row.append($('<td></td>').text(datos[i].nombre_columna));
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
					
					if ((datos[i].nombre_columna != 'id_caso') && (datos[i].nombre_columna != 'telefono')) {
					
						row.append($('<td></td>')
									.append($('<button></button>')
										.attr('type', 'button')
										.attr('class', 'btn btn-primary btn-sm')
										.attr('aria-label', 'Editar')
										.attr('data-toggle', 'modal')
										.attr('data-target', '#editarModal')
										.attr('data-idvalue', datos[i].nombre_columna)
										.attr('data-input1value', datos[i].visibilidad)
										.val('Editar-'+datos[i].nombre_columna)
										.append($('<span></span>')
											.attr('class','glyphicon glyphicon-pencil')
											.attr('aria-hidden','true')
										)
									)
							)
					} else {
						row.append($('<td></td>')
									.append($('<button></button>')
										.attr('type', 'button')
										.attr('class', 'btn btn-primary btn-sm')
										.attr('aria-label', 'Editar')
										.attr('disabled', 'disabled')
										.append($('<span></span>')
											.attr('class','glyphicon glyphicon-pencil')
											.attr('aria-hidden','true')
										)
									)
							)
					}
							
					table.append(row);
			   }
			}
			$('.cargando').fadeOut();
		}
	});
}

$(document).ready(function() {
	
	//Activar Menu
	$('li#visibilidadColumna').addClass('active');
	
	cargarLista()

$('#sincro').click(function() {
	$('.cargando').fadeIn();
	
	console.log("SINCRO")
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/columnas_visibilidad/sincronizarColumnasVisibilidad.php",
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
	

//Modal Editar
$('#editarModal').on('show.bs.modal', function (event) {
  $('#editMalRelleno').fadeOut();
  $('#editError').fadeOut();
  $('#editOk').fadeOut();
  
  $('#editarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Editar Visibilidad Columna');
  
  var button = $(event.relatedTarget)
  var idValue = button.data('idvalue')
  var radioOptions = button.data('input1value')
  
  $('#idEdit').val(idValue);
 
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
  
})

//Boton guardar editar
$('#editarBtn').on('click', function () {
    var idVal = $('#idEdit').val();
	var radioOpt = $("input[type='radio'][name='editRadioOptions']:checked").val();
		
		$('#editMalRelleno').fadeOut();
		
		var stringDatos = 'columna='+ idVal+'&visibilidad='+ radioOpt;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/columnas_visibilidad/editarVisibilidadColumna.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				if(data == 'ok') {
					$('#editError').fadeOut();
					
					$('#editOk').text('Visibilidad Columna editada correctamente');
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
})
	
});