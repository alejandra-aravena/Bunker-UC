	</div>
</div>

<script src="../../../librerias/jquery.min.js"></script>
<script src="../../../librerias/bootstrap//js/bootstrap.min.js"></script>

<script language="javascript">
function cargarNombreProyecto() {
	var stringDatos = 'general=Nombre Proyecto';
	
	$.ajax({
		type: "POST",
		url: "../../../controladores/generales/obtenerGeneralPorNombre.php",
		data: stringDatos,
		cache: false,
		beforeSend: function(){
			//$("#login").val('Conectando...');
			},
		success: function(data){
			$('#NombreProyecto').text(data);	
		}
	});
}

$(document).ready(function() {
	cargarNombreProyecto()
});
</script>