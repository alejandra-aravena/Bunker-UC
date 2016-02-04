function agregarColumnas(nombreArchivo) {
	$('.cargando').fadeIn();
	
	var stringDatos = 'nombreArchivo='+nombreArchivo;
	$.ajax({
		type: "POST",
		url: "../../../controladores/subida_casos/agregarColumnas.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			var table = $('#listarC tbody');
			table.html('');
			
			for(i=0; i< datos.length; i++) {
				
				var row = $('<tr></tr>');
				row.append($('<td></td>').text(datos[i].columna));
				row.append($('<td></td>').text(datos[i].resultado));
						
				table.append(row);
				
				$('#listarC').fadeIn();
				$('.cargando').fadeOut();
			}
			
		}
	});
}
function agregarFilas(nombreArchivo, nombreTelefono) {
	
	$('.cargando2').fadeIn();
	$('#listarF tbody').html('');
	
	var stringDatos = 'nombreArchivo='+nombreArchivo+'&nombreTelefono='+nombreTelefono;
	$.ajax({
		type: "POST",
		url: "../../../controladores/subida_casos/agregarFilas.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$('.cargando').fadeIn();
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			$('#correctas').text('Subidas Correctamente: '+datos.correctas)
			$('#incorrectas').text('No fueron subidas: '+datos.incorrectas)
			
			if (datos.incorrectas != 0) {
				$('#listarF').fadeIn();
				
				var table = $('#listarF tbody');
				table.html('');
				
				for(i=0; i< datos.incorrectas; i++) {
					
					$('.cargando2').fadeIn();
					
					var row = $('<tr></tr>');
					row.append($('<td></td>').text('Fila nº '+datos.filasIncorrectas[i]));
					row.append($('<td></td>').text('No fue agregada'));
							
					table.append(row);
				}
			}
			
			$('.cargando2').fadeOut()
			
		}
	});
}
function cargarListaArchivos() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	$.ajax({
		type: "POST",
		url: "../../../controladores/subida_casos/listarArchivos.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$('.cargando').fadeIn();
			},
		success: function(dataResult){
			
			if (dataResult == 'null') {
				$('.cargando').fadeOut()
				return false 
			}
			
			var datos = $.parseJSON(unescape(dataResult))
			
			var files = new Array();
			
			if (!datos) {
				return false 
			}
			
			for(i=0; i< datos.length; i++) {
				
				files.push({id: datos[i],name: datos[i]})
			}
			
			var tree = $('#archivosSubidas').fileTree({
				data: files,
				sortable: false,
				selectable: true
			});
			
			tree.bind('itemSelected', function(e, el){
				var id = $(el).data('id');
				var name = $(el).data('name');
				
				$('#UseFile').val(id);
			});

			
			$('.cargando').fadeOut()
			
		}
	});
}
$(document).on("ready", function() {
    $("#subirArchivo").fileinput({
		showCaption: false,
		browseLabel: "Buscar...",
		removeLabel: "Borrar",
		uploadLabel: "Subir",
		previewSettings: {
			object: {width: "160px", height: "0px"},
			other: {width: "160px", height: "0px"}
		},
		uploadAsync: false,
		uploadUrl: "../../../controladores/subida_casos/guardarArchivo.php",
		uploadExtraData: function() {
            return {
                userid: 'ides',
                username: 'usrns'
            };
        },
		dropZoneEnabled: false
	});
	
	$('#subirArchivo').on('fileuploaded', function(event, data, previewId, index) {
    	var extra = data.extra, response = data.response
		if (response == 'OK') {
			$('#respUp').text('Archivo Subido Correctamente').addClass('alert-success').fadeIn();
			$('#subirArchivo').fileinput('clear');
			$('#archivosSubidas').html('')
			cargarListaArchivos()
		} else if (response == 'ERROR') {
			$('#respUp').text('Error Al subir archivo').addClass('alert-danger').fadeIn();
		} else if (response == 'NO') {
			$('#respUp').text('No hay archivo subido').addClass('alert-warning').fadeIn();
		} else {
			$('#respUp').text('Error desconocido').addClass('alert-info').fadeIn();
		}
		setTimeout(function(){
			$('#respUp').fadeOut();
		},1500) 
	});
});

$(document).ready(function() {
	
	$('.cargando').fadeOut();
	$('.cargando2').fadeOut();
	
	cargarListaArchivos();
	
	$('#agregarColumnas').click(function(){
		
		if ($('#nombreArchivo').val() == '') {
			alert("Debe indicar el archivo a utilizar")
			return false
		}
		
		var nombreArchivo = $('#nombreArchivo').val()
		agregarColumnas(nombreArchivo)
	});
	
	$('#agregarFilas').click(function(){
		
		if ($('#columnaTel').val() == '') {
			alert("Debe indicar columna de teléfono")
			return false
		}
		if ($('#nombreArchivo').val() == '') {
			alert("Debe indicar el archivo a utilizar")
			return false
		}
		
		var nombreArchivo = $('#nombreArchivo').val();
		var nombreTelefono = $('#columnaTel').val();
		agregarFilas(nombreArchivo, nombreTelefono)
	});
	
	$('#utilizarFile').click(function(){
		$('#nombreArchivo').val($('#UseFile').val())
	})
	
	$('#borrarFile').click(function(){
		
		var stringDatos = 'fileName='+$('#UseFile').val()
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/subida_casos/eliminarArchivo.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$('.cargando').fadeIn();
				},
			success: function(resp) {
				if (resp == 'OK') {
					$('#respDel').text('Archivo Eliminado Correctamente').addClass('alert-info').fadeIn();
					$('#archivosSubidas').html('')
					cargarListaArchivos()
					$('#UseFile').val('')
				} else if (resp == 'ERROR') {
					$('#respDel').text('Error Al borrar archivo').addClass('alert-danger').fadeIn();
				} else if (resp == 'NO') {
					$('#respDel').text('No hay archivo a borrar').addClass('alert-warning').fadeIn();
				} else {
					$('#respDel').text('Error desconocido').addClass('alert-warning').fadeIn();
				}
				setTimeout(function(){
					$('#respDel').fadeOut();
				},1500) 
			}
		})
	})
	

});