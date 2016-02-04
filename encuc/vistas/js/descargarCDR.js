$(document).ready(function() {
	
	$('.cargando').fadeOut();
	
	//Activar Menu
	$('li#descargarCDR').addClass('active');
	
$('#DescargaDia').click(function(){
	
	if ($('#ano1').val() == '') {
		alert("Debe indicarse año")
		return false
	}
	if ($('#mes1').val() == '') {
		alert("Debe indicarse mes")
		return false
	}
	
	$('.cargando').fadeIn();
	
	var dia = $('#dia1').val()
	var mes = $('#mes1').val()
	var ano = $('#ano1').val()
		
	var stringDatos = 'ano='+ ano+'&mes='+ mes+'&dia='+ dia;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/descargas_audio/descargaZipDia.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				
				},
			success: function(data){
				$('#strDescarga').val(data)
				$('.cargando').fadeOut();
				$('#DescargarModal').modal('show')
				$('#strDescarga2').text(data)
			}
		});
});

$('#DescargaEstacion').click(function(){
	
	if ($('#ano2').val() == '') {
		alert("Debe indicarse año")
		return false
	}
	if ($('#mes2').val() == '') {
		alert("Debe indicarse mes")
		return false
	}
	if ($('#estacion').val() == '') {
		alert("Debe indicarse estación")
		return false
	}
	
	$('.cargando').fadeIn();
	
	var dia = $('#dia2').val()
	var mes = $('#mes2').val()
	var ano = $('#ano2').val()
	var estacion = $('#estacion').val()
		
	var stringDatos = 'ano='+ ano+'&mes='+ mes+'&dia='+ dia+'&estacion='+ estacion;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/descargas_audio/descargaZipEstacion.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				
				},
			success: function(data){
				$('#strDescarga').val(data)
				$('.cargando').fadeOut();
				$('#DescargarModal').modal('show')
				$('#strDescarga2').text(data)
			}
		});
});

$('#DescargaTelefono').click(function(){
	
	if ($('#ano3').val() == '') {
		alert("Debe indicarse año")
		return false
	}
	if ($('#mes3').val() == '') {
		alert("Debe indicarse mes")
		return false
	}
	if ($('#telefono').val() == '') {
		alert("Debe indicarse telefono")
		return false
	}
	
	$('.cargando').fadeIn();
	
	var dia = $('#dia3').val()
	var mes = $('#mes3').val()
	var ano = $('#ano3').val()
	var telefono = $('#telefono').val()
		
	var stringDatos = 'ano='+ ano+'&mes='+ mes+'&dia='+ dia+'&telefono='+ telefono;
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/descargas_audio/descargaZipTelefono.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				
				},
			success: function(data){
				$('#strDescarga').val(data)
				$('.cargando').fadeOut();
				$('#DescargarModal').modal('show')
				$('#strDescarga2').text(data)
			}
		});
});


$('#descargarZIP').on('click', function () {
	
	var linkstr = $('#strDescarga').val()
	document.location = '../'+linkstr
	$('#DescargarModal').modal('hide')

});

$('#Eliminar').on('click', function () {
	
	$('.cargando').fadeIn();
	
	var stringDatos = ''
		
		$.ajax({
			type: "POST",
			url: "../../../controladores/descargas_audio/elimnarZipFiles.php",
			data: stringDatos,
			cache: false,
			beforeSend: function(){
				
				},
			success: function(data){
				$('.cargando').fadeOut();
				
				if (data == "NADA") {
					$('#resultadoEliminar').text("No hay archivos ZIP a eliminar")
				} else {
					var datos = $.parseJSON(unescape(data))
					$('#resultadoEliminar').text("Se eliminaron "+datos.correctas+" archivos y "+datos.incorrectas+" no se pudieron eliminar")
				}
				
				$('#EliminarModal').modal('show')
			}
		});
	
});

});