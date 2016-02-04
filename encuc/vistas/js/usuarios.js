function cargarLista() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	
	$.ajax({
		type: "POST",
		url: "../../../controladores/usuarios/listarUsuarios.php",
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
				row.append($('<td></td>').text(datos[i].id_usuario));
				row.append($('<td></td>').text(datos[i].usrname));
				
				if (datos[i].ip_estacion) {
					row.append($('<td></td>').text(datos[i].ip_estacion));
				}else{
					row.append($('<td></td>').text(''));
				}
				
				if (datos[i].num_cdr) {
					row.append($('<td></td>').text(datos[i].num_cdr));
				}else{
					row.append($('<td></td>').text(''));
				}
				
				
				row.append($('<td></td>')
							.append($('<button></button>')
								.attr('type', 'button')
								.attr('class', 'btn btn-warning btn-sm')
								.attr('aria-label', 'Password')
								.attr('data-toggle', 'modal')
								.attr('data-target', '#editPassModal')
								.attr('data-idvalue', datos[i].id_usuario)
								.attr('data-input1value', datos[i].usrname)
								.attr('data-input2value', datos[i].password)
								.val('Cambiar-'+datos[i].id_usuario)
								.append($('<span></span>')
									.attr('class','glyphicon glyphicon-cog')
									.attr('aria-hidden','true')
								)
							)
							.append($('<button></button>')
								.attr('type', 'button')
								.attr('class', 'btn btn-primary btn-sm')
								.attr('aria-label', 'Editar')
								.attr('data-toggle', 'modal')
								.attr('data-target', '#editarModal')
								.attr('data-idvalue', datos[i].id_usuario)
								.attr('data-input1value', datos[i].usrname)
								.attr('data-ip_estacion', datos[i].ip_estacion)
								.attr('data-num_cdr', datos[i].num_cdr)
								.val('Editar-'+datos[i].id_usuario)
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
								.attr('data-idvalue', datos[i].id_usuario)
								.attr('data-input1value', datos[i].usrname)
								.val('Eliminar-'+datos[i].id_usuario)
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
	
	$('li#usuarios').addClass('active');
	
	cargarLista();

//Modal Agregar
$('#agregarModal').on('show.bs.modal', function (event) {
  $('#addMalRelleno').fadeOut();
  $('#addError').fadeOut();
  $('#addOk').fadeOut();
  $('#addInput1').val('');
  $('#addInput2').val('');
  
  $('#agregarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Agregar Usuario');
})

//Boton guardar agregar
$('#agregarBtn').on('click', function () {
    var btnVal = $('#addInput1').val();
	var btnVal2 = $('#addInput2').val();
	
	var ipEstacion = $('#addInput3').val();
  	var numCdr = $('#addInput4').val();
	
	if ((btnVal != '') && (btnVal != '')) {
		
		$('#addMalRelleno').fadeOut();
		
		var stringDatos = 'usuario='+ btnVal+'&password='+btnVal2+'&ipEstacion='+ipEstacion+'&numCdr='+numCdr;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/usuarios/agregarUsuario.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				if(data == 'ok') {
					$('#addError').fadeOut();
					
					$('#addOk').text('Usuario agregado correctamente');
					$('#addOk').fadeIn('fast', function() {
						$('#agregarBtn').attr('disabled','disabled');
						cargarLista()
						setTimeout(function(){$('#agregarModal').modal('hide')},1500)
					});
				}
				else {
					$('#addError').text('Ocurrio un error, intentelo nuevamente');
					$('#addError').fadeIn();
				}
			}
		});
	}
	else {
		$('#addMalRelleno').text('Debe indicar el nombre y contraseña del usuario');
		$('#addMalRelleno').fadeIn();
	}
})

//Modal Editar Contraseña
$('#editPassModal').on('show.bs.modal', function (event) {
  $('#editPassMalRelleno').fadeOut();
  $('#editPassError').fadeOut();
  $('#editPassOk').fadeOut();
  
  $('#editPassBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Cambiar contraseña de Usuario');
  
  var button = $(event.relatedTarget)
  var idvalue = button.data('idvalue')
  var input1value = button.data('input1value')
  
  $('#editPassInput1').val(input1value);
  $('#editPassText').text(input1value);
  $('#editPassInput2').val('');
  $('#idEditPass').val(idvalue);
})

//Boton guardar editar Contraseña
$('#editPassBtn').on('click', function () {
    var btnVal = $('#editPassInput1').val();
	var btnVal2 = $('#editPassInput2').val();
	var idVal = $('#idEditPass').val();
	
	if (btnVal2 != '') {
		
		$('#editPassMalRelleno').fadeOut();
		
		var stringDatos = 'usuario='+ btnVal+'&id_usuario='+ idVal+'&password='+btnVal2;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/usuarios/cambiarPassword.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				if(data == 'ok') {
					$('#editPassError').fadeOut();
					
					$('#editPassOk').text('Contraseña de Usuario cambiada correctamente');
					$('#editPassOk').fadeIn('fast', function() {
						$('#editPassBtn').attr('disabled','disabled');
						setTimeout(function(){$('#editPassModal').modal('hide')},1500)
					});
				}
				else {
					$('#editPassError').text('Ocurrio un error, intentelo nuevamente');
					$('#editPassError').fadeIn();
				}
			}
		});
	}
	else {
		$('#editPassMalRelleno').text('Debe indicar el nombre del Usuario');
		$('#editPassMalRelleno').fadeIn();
	}
})

//Modal Editar
$('#editarModal').on('show.bs.modal', function (event) {
  $('#editMalRelleno').fadeOut();
  $('#editError').fadeOut();
  $('#editOk').fadeOut();
  
  $('#editarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Editar Usuario');
  
  var button = $(event.relatedTarget)
  var idvalue = button.data('idvalue')
  var input1value = button.data('input1value')
  var ipEstacion = button.data('ip_estacion')
  var numCdr = button.data('num_cdr')
  
  $('#editInput1').val(input1value);
  $('#editInput3').val(ipEstacion);
  $('#editInput4').val(numCdr);
  $('#idEdit').val(idvalue);
})

//Boton guardar editar
$('#editarBtn').on('click', function () {
    var btnVal = $('#editInput1').val();
	var btnVal2 = $('#editInput2').val();
	var idVal = $('#idEdit').val();
	
	var ipEstacion = $('#editInput3').val();
  	var numCdr = $('#editInput4').val();
	
	if (btnVal != '') {
		
		$('#editMalRelleno').fadeOut();
		
		var stringDatos = 'usuario='+ btnVal+'&id_usuario='+ idVal+'&password='+btnVal2+'&ipEstacion='+ipEstacion+'&numCdr='+numCdr;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/usuarios/editarUsuario.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				if(data == 'ok') {
					$('#editError').fadeOut();
					
					$('#editOk').text('Usuario editado correctamente');
					$('#editOk').fadeIn('fast', function() {
						$('#editarBtn').attr('disabled','disabled');
						cargarLista()
						setTimeout(function(){$('#editarModal').modal('hide')},1500)
					});
				}
				else {
					$('#editError').text('Ocurrio un error, intentelo nuevamente');
					$('#editError').fadeIn();
				}
			}
		});
	}
	else {
		$('#editMalRelleno').text('Debe indicar el nombre del Usuario');
		$('#editMalRelleno').fadeIn();
	}
})

//Modal Eliminar
$('#eliminarModal').on('show.bs.modal', function (event) {
  $('#delError').fadeOut();
  $('#delOk').fadeOut();
  
  $('#eliminarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Eliminar Usuario');
  
  var button = $(event.relatedTarget)
  var idvalue = button.data('idvalue')
  var input1value = button.data('input1value')
  
  $('#delText').text(input1value)
  $('#idDel').val(idvalue);
})

//Boton eliminar
$('#eliminarBtn').on('click', function () {
	var idVal = $('#idDel').val();
		
	var stringDatos = 'id_usuario='+ idVal;
		
	$.ajax({
		type: "POST",
		url: "../../../controladores/usuarios/eliminarUsuario.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			if(data == 'ok') {
				$('#delError').fadeOut();
					
				$('#delOk').text('Usuario eliminado correctamente');
				$('#delOk').fadeIn('fast', function() {
					$('#eliminarBtn').attr('disabled','disabled');
					cargarLista()
					setTimeout(function(){$('#eliminarModal').modal('hide')},1500)
				});
			}
			else {
				$('#delError').text('Ocurrio un error, intentelo nuevamente (verifique que no tenga roles asignados');
				$('#delError').fadeIn();
			}
			}
		});
})
	
});