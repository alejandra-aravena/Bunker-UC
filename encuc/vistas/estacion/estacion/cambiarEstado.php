<form class="form-horizontal" onsubmit="return false">
  <div class="form-group">
		<label for="cambiarEstado" class="col-sm-2 control-label">Estado:</label>
    <div class="col-sm-10">
      <div class="btn-group" data-toggle="buttons" id="estadosPosibles" data-toggle="buttons">
        
      </div>
    </div>
  </div>
  
  <small>&nbsp;</small>
  <div class="form-group" id="valorInG">
    <label for="valorIn" class="col-sm-2 control-label">Descripción:</label>
    <div class="col-sm-10">
      <input type="input" class="form-control" id="valorIn" placeholder="descripción breve" />
    </div>
  </div>
  
  <small>&nbsp;</small>
  <div class="form-group" id="agendaInG">
    <label for="agendaIn" class="col-sm-2 col-sm-offset-3 control-label">Agendar:</label>
    <div class="col-sm-5 input-group date" id="agendaInCont">
    	<input type="text" class="form-control" id="agendaIn">
        	<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
             </span>	
    </div>
  </div>
  
  <input type="hidden" id="idCaso" value="" />
  <input type="hidden" id="idUsuario" value="" />
  <input type="hidden" id="ipEstacion" value="" />

</form>
<div class="clearfix"></div>