function cargarLista() {
	$('.cargando').fadeIn();
	
	var stringDatos = '';
	
	$.ajax({
		type: "POST",
		url: "../../../controladores/roles_usuarios/listarRolesUsuarios.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			
			var datos = $.parseJSON(unescape(data))
			
			var table = $('#listarT tbody');
			table.html('');
			
			var usuario;
			var countRows;
			var roles ='';
				
			for(i=0; i< datos.length; i++) {
	
				var row = $('<tr></tr>');
				
				if (usuario == datos[i].usrname) {
					countRows++;
				}
				else {
					$('td#id-'+usuario).attr('rowspan',countRows);
					$('td#usr-'+usuario).attr('rowspan',countRows);
					$('td#plus-'+usuario).attr('rowspan',countRows);
					
					roles = '';
					
					row.append($('<td></td>').text(datos[i].id_usuario).attr('id','id-'+datos[i].usrname));
					row.append($('<td></td>').text(datos[i].usrname).attr('id','usr-'+datos[i].usrname));
					row.append($('<td></td>').attr('id','plus-'+datos[i].usrname).append($('<button></button>')
								.attr('type', 'button')
								.attr('class', 'btn btn-success btn-sm')
								.attr('id', 'agregar-'+datos[i].usrname)
								.attr('aria-label', 'Agregar')
								.attr('data-toggle', 'modal')
								.attr('data-target', '#agregarModal')
								.attr('data-idusr', datos[i].id_usuario)
								.attr('data-usr', datos[i].usrname)
								.append($('<span></span>')
									.attr('class','glyphicon glyphicon-plus')
									.attr('aria-hidden','true')
								)
							));
							
					countRows = 1;
				}
				usuario = datos[i].usrname
	
				if (datos[i].rol) {
					
					roles = datos[i].id_rol+'-'+roles;
					
					row.append($('<td></td>').text(datos[i].rol));
				
					row.append($('<td></td>')
								.append($('<button></button>')
									.attr('type', 'button')
									.attr('class', 'btn btn-danger btn-sm')
									.attr('aria-label', 'Eliminar')
									.attr('data-toggle', 'modal')
									.attr('data-target', '#eliminarModal')
									.attr('data-idusr', datos[i].id_usuario)
									.attr('data-usr', datos[i].usrname)
									.attr('data-idrol', datos[i].id_rol)
									.attr('data-roln', datos[i].rol)
									.val('Eliminar-'+datos[i].id_rol)
									.append($('<span></span>')
										.attr('class','glyphicon glyphicon-remove')
										.attr('aria-hidden','true')
									)
								)
						)
				}
				else {
					
					roles = '';
					
					row.append($('<td></td>'));
					row.append($('<td></td>'));
				}
				
				table.append(row);	
				$('#agregar-'+datos[i].usrname).attr('data-roles', roles)
			}
			
			$('td#id-'+usuario).attr('rowspan',countRows);
			$('td#usr-'+usuario).attr('rowspan',countRows);
			$('td#plus-'+usuario).attr('rowspan',countRows);
			
			$('.cargando').fadeOut();
		}
	});
}

$(document).ready(function() {
	
	$('li#rolesUsuarios').addClass('active');
	
	cargarLista();

var rolesA
//Modal Agregar
$('#agregarModal').on('show.bs.modal', function (event) {
  $('#addMalRelleno').fadeOut();
  $('#addError').fadeOut();
  $('#addOk').fadeOut();
  $('#addInput1').val('');
  $('#addInput2').val('');
  
  $('#agregarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Agregar roles al usuario');
  
  var button = $(event.relatedTarget)
  
  var idusr = button.data('idusr')
  var usr = button.data('usr')
  var roles = button.data('roles')
  rolesA = roles.split("-");
  rolesA.splice(-1,1)
  
  $('h5#addText strong').text(usr)
  $('#addRolesList').html('');
  $('#idUsrAdd').val(idusr);
  
  $.ajax({
			type: "POST",
			url: "../../../controladores/roles/listarRoles.php",
			data: '',
			cache: false,
			beforeSend: function(){
				//$("#login").val('Conectando...');
				},
			success: function(data){
				var datos = $.parseJSON(unescape(data))
			
				if(datos) {
					$('#addError').fadeOut();
					
					for(i=0; i< datos.length; i++) {
						if (rolesA.indexOf(datos[i].id_rol) != -1) {
							$('#addRolesList').append(
								$('<option></option>').text(datos[i].rol).attr('value',datos[i].id_rol).attr('selected', 'selected')
							);
						}
						else {
							$('#addRolesList').append(
								$('<option></option>').text(datos[i].rol).attr('value',datos[i].id_rol)
							);
						}
						
					}
				}
				else {
					$('#addMalRelleno').text('Ocurrio un error, intentelo nuevamente');
					$('#addMalRelleno').fadeIn();
				}
			}
		});
})
function arr_diff(a1, a2)
{
  var a=[], diff=[];
  for(var i=0;i<a1.length;i++)
    a[a1[i]]=true;
  for(var i=0;i<a2.length;i++)
    if(a[a2[i]]) delete a[a2[i]];
    else a[a2[i]]=true;
  for(var k in a)
    diff.push(k);
  return diff;
}
//Boton guardar agregar
$('#agregarBtn').on('click', function () {
	$('#addMalRelleno').fadeOut();

	var idUsr = $('#idUsrAdd').val();
	
	var diff = arr_diff(rolesA,$('#addRolesList').val());
	
	var stringDatos = JSON.stringify(diff);
	
	$.ajax({
	type: "POST",
	url: "../../../controladores/roles_usuarios/agregarRolesUsuario.php",
	data: {roles : stringDatos, id_usr: idUsr},
	cache: false,
	beforeSend: function(){
		//$("#login").val('Conectando...');
		},
	success: function(data){

		if(data != 'error') {
			$('#addError').fadeOut();
			
			$('#addOk').text('Roles agregados correctamente al usuario');
				$('#addOk').fadeIn('fast', function() {
					$('#agregarBtn').attr('disabled','disabled');
					cargarLista()
					setTimeout(function(){$('#agregarModal').modal('hide')},1500)
				});
		}
		else {
			$('#addError').text('Ocurrio un error, intentelo nuevamente');
			$('#addError').fadeIn('fast', function() {
					cargarLista()
					setTimeout(function(){$('#agregarModal').modal('hide')},1500)
				});
		}
		}
	});	
})
//mantener seleccion
$('#addRolesList').change(function() {
	var selected = rolesA.concat($('#addRolesList').val());
	var uniqueSelected = [];
	$.each(selected, function(i, el){
    	if($.inArray(el, uniqueSelected) === -1) uniqueSelected.push(el);
	});
	$('#addRolesList').val(uniqueSelected)
});

//Modal Eliminar
$('#eliminarModal').on('show.bs.modal', function (event) {
  $('#delError').fadeOut();
  $('#delOk').fadeOut();
  
  $('#eliminarBtn').removeAttr('disabled');
  
  $(this).find('.modal-title').text('Eliminar Usuario');
  
  var button = $(event.relatedTarget)
  
  var idusr = button.data('idusr')
  var usr = button.data('usr')
  var idrol = button.data('idrol')
  var roln = button.data('roln')
  
  $('#delText').text(roln)
  $('#delText2').text(usr)
  $('#idUsrDel').val(idusr)
  $('#idRolDel').val(idrol)

})

//Boton eliminar
$('#eliminarBtn').on('click', function () {
	var idValUsr = $('#idUsrDel').val();
	var idValRol = $('#idRolDel').val();
		
	var stringDatos = 'id_usuario='+ idValUsr +'&id_rol='+idValRol;
		
	$.ajax({
		type: "POST",
		url: "../../../controladores/roles_usuarios/eliminarRolUsuario.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			if(data == 'ok') {
				$('#delError').fadeOut();
					
				$('#delOk').text('Rol de usuario eliminado correctamente');
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