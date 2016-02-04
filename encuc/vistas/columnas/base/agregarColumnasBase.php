<form class="form-horizontal" onsubmit="return false">
  <div class="form-group">
    <label for="addInput1" class="col-sm-2 control-label">Columna:</label>
    <div class="col-sm-10">
      <input type="input" class="form-control" id="addInput1" placeholder="Nombre de la columna" required="required" />
    </div>
    </div>
    <div class="form-group">
    <label for="addInput2" class="col-sm-2 control-label">Tipo:</label>
    <div class="col-sm-10">
      <select id="addInput2" class="form-control">
      	<option value="VARCHAR(255)" selected="selected">VARCHAR(255)</option>
        <option value="VARCHAR(45)">VARCHAR(45)</option>
        <option value="INT">INT(2)</option>
        <option value="INT">INT(11)</option>
        <option value="INT">DATETIME</option>
        <option value="INT">DATE</option>
        <option value="INT">TEXT</option>
      </select>
    </div>
  </div>
</form>