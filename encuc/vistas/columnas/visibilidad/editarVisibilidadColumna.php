<form class="form-horizontal" onsubmit="return false">
  <div class="form-group">
    <label for="editInput1" class="col-sm-2 control-label">Columna:</label>
    <div class="col-sm-10">
      <input type="input" class="form-control" id="idEdit" placeholder="Nombre de la columna" value="" required="required" disabled="disabled" />
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