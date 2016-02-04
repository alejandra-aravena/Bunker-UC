<form class="form-horizontal" onsubmit="return false">
  <div class="form-group">
    <label for="addInput1" class="col-sm-2 control-label">Estado:</label>
    <div class="col-sm-10">
      <input type="input" class="form-control" id="addInput1" placeholder="Nombre de la descripción" required="required" />
    </div>
  </div>
  <div class="form-group">
    <label for="addInput2" class="col-sm-2 control-label">Descripción:</label>
    <div class="col-sm-10">
      <input type="input" class="form-control" id="addInput2" placeholder="Nombre de la descripción" required="required" />
    </div>
  </div>
  
<div class="form-group">
		<label for="addRadioOptions" class="col-sm-2 control-label">Visibilidad:</label>
    <div class="col-sm-10">
      <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-default btn-sm">
          <input type="radio" name="addRadioOptions" id="addRadioOptions1" value="1"> Visible
        </label>
        <label class="btn btn-default btn-sm">
          <input type="radio" name="addRadioOptions" id="addRadioOptions2" value="0"> NO visible
        </label>
      </div>
    </div>
  </div>
 
</form>