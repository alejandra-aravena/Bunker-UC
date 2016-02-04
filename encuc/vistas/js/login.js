$(document).ready(function() {
	
	$('#username').keypress(function() {
		if ($('#username').val() == 0)
			$('#error').fadeOut();
	});
	
	$('#password').keypress(function() {
		if ($('#password').val() == 0)
			$('#error').fadeOut();
	});

	$('#formulario').submit(function(event) {
		event.preventDefault();
		
		$('#error').fadeOut();
	
		var username=$("#username").val();
		var password=$("#password").val();
		
		var stringDatos = 'username='+username+'&password='+password;
	
		$.ajax({
			type: "POST",
			url: "../../controladores/usuarios/checkUserPass.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){ $("#login").val('Conectando...');},
			success: function(data){
				
				if(data == 'admin') {
					window.location.href = "../home.php";
				}
				else if(data == 'estacion') {
					window.location.href = "../estacion/estacion/verEstacion.php";
				}
				else if (data == 'error'){
					$('#error').text("Contraseña incorrecta");
					$('#error').fadeIn();
					$('#password').val('')
					$('#password').focus();
				}
				else {
					$('#error').text("Usuario no existe");
					$('#error').fadeIn();
					$('#username').val('')
					$('#password').val('')
					$('#username').focus();
				}
			}
		});
		return false;
	});

});