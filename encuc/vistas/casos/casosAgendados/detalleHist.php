<form class="form-horizontal" onsubmit="return false">
  <div class="form-group">
		<label for="cambiarEstado" class="col-sm-2 control-label">Estado:</label>
    <div class="col-sm-10">
      <div class="btn-group" data-toggle="buttons" id="estadosPosibles" data-toggle="buttons">
        
      </div>
    </div>
  </div>
    <div class="form-group" id="valorInG">
    <label for="valorIn" class="col-sm-2 control-label">Descripción:</label>
    <div class="col-sm-10">
      <input type="input" class="form-control" id="valorIn" placeholder="descripción breve" />
    </div>
  </div>
  
  <div class="form-group" id="agendaInG">
    <label for="agendaIn" class="col-sm-4 control-label">Agendar:</label>
    <div class="col-sm-5 input-group date" id="agendaInCont">
    	<input type="text" class="form-control" id="agendaIn">
        	<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
             </span>	
    </div>
  </div>
  
  <input type="hidden" id="idCasoDH" value="" />
  <input type="hidden" id="idUsuarioDH" value="<?php echo $_SESSION['idUsr']; ?>" />
</form>

<h5 id="idCasoH">Id: <strong></strong></h5>
<h5 id="telefonoH">Telefono: <strong></strong></h5>
<div class="table-responsive">
	<table class="table table-striped" id="contenidoDetalleHistorial">
        <thead>	
            <th>Usuario</th>
            <th>Estado</th>
            <th>Valor</th>
            <th>Agenda</th>
            <th>Update</th>
            <th>LimeSurvey</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>