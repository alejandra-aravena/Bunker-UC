
function cargarLista() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/casos/listarCasosRepetidos.php",
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
					
					if (!datos[i].telefono)  {
						datos[i].telefono = '';
					}
					if (!datos[i].folio)  {
						datos[i].folio = '';
					}
					if (!datos[i].FOLIO)  {
						datos[i].FOLIO = datos[i].folio;
					}
					
					var botonDetalleCaso = '<button type="button" class="btn btn-info btn-sm" aria-label="DetallesCaso" data-toggle="modal" data-target="#detalleCasoModal" data-id_caso="'+datos[i].id_caso_repetido+'" value="DetalleCaso-'+datos[i].id_caso_repetido+'"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button>'
					
					var botonBorrarCaso  = '<button type="button" class="btn btn-danger btn-sm" aria-label="Eliminar" data-toggle="modal" data-target="#eliminarModal" data-idvalue="'+datos[i].id_caso_repetido+'" value="DetalleCaso-'+datos[i].id_caso_repetido+'" data-input1value = "'+datos[i].telefono+'" data-input2value = "'+datos[i].FOLIO+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>'

					dataSet.push([datos[i].id_caso_repetido, datos[i].telefono, datos[i].FOLIO, botonDetalleCaso+botonBorrarCaso])
					
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
							{ "title": "ID" },
							{ "title": "Telefono" },
							{ "title": "FOLIO" },
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
						"columns": [
							{ "title": "ID" },
							{ "title": "Telefono" },
							{ "title": "FOLIO" },
							{ "title": "Administrar"}
						]
					});
				}
				
			}
				
				$('.cargando').fadeOut(); 
			
		}
	});
}

$(document).ready(function() {
	
	//Activar Menu
	$('li#casosRepetidos').addClass('active');
	cargarLista()
	
//Modal detalleCasoModal
$('#detalleCasoModal').on('show.bs.modal', function (event) {
	
	var button = $(event.relatedTarget)
  	var idCasoRepetido = button.data('id_caso')
	
	var stringDatos = 'idCasoRepetido='+ idCasoRepetido;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/casos/detalleCasoRepetido.php",
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
				  
				  var row = $('<tr></tr>');
			
					row.append($('<td></td>').text(key));
					row.append($('<td></td>').text(value));
					
				 table.append(row);
				});
				
			}
		});
})

//Modal Eliminar
$('#eliminarModal').on('show.bs.modal', function (event) {
  $('#delError').fadeOut();
  $('#delOk').fadeOut();
  
  $('#eliminarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Eliminar Caso Repetido');
  
  var button = $(event.relatedTarget)
  var idValue = button.data('idvalue')
  var input1value = button.data('input1value')
  var input2value = button.data('input2value')

  $('#delText').text(input1value)
  $('#delText2').text(input2value)
  $('#idDel').val(idValue);
})

//Boton eliminar
$('#eliminarBtn').on('click', function () {
	var idVal = $('#idDel').val();
		
	var stringDatos = 'idCasoRepetido='+ idVal;
		
	$.ajax({
		type: "POST",
		url: "../../../controladores/casos/eliminarCasoRepetido.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			if(data == 'ok') {
				$('#delError').fadeOut();
					
				$('#delOk').text('Caso repetido eliminado correctamente');
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