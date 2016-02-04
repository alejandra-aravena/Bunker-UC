<form class="form-horizontal" onsubmit="return false">
  <div class="form-group">
    <label for="editInput1" class="col-sm-2 control-label">Estado</label>
    <div class="col-sm-10">
      <input type="input" class="form-control" id="editInput1" placeholder="Nombre del rol" value="" required="required" />
      <input type="hidden" id="idEdit" value="" />
    </div>
  </div>
  
  <div class="form-group">
    <label for="editInput2" class="col-sm-2 control-label">Descripción:</label>
    <div class="col-sm-10">
      <input type="input" class="form-control" id="editInput2" placeholder="Nombre de la descripción" required="required" />
    </div>
  </div>
  
<div class="form-group">
		<label for="addRadioOptions" class="col-sm-2 control-label">Visibilidad:</label>
    <div class="col-sm-10">
      <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-default btn-sm">
          <input type="radio" name="editRadioOptions" id="editRadioOptions1" value="1"> Visible
        </label>
        <label class="btn btn-default btn-sm">
          <input type="radio" name="editRadioOptions" id="editRadioOptions2" value="0"> NO visible
        </label>
      </div>
    </div>
  </div>
</form>