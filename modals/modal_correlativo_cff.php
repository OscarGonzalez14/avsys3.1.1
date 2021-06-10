<!-- IMPRIMIR FACTURA-->
<div class="modal fade" id="print_cff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body" style="color: #ff6500;display: block;margin-left: auto;margin-right: auto;">
        <div>
          <i class="fas fa-exclamation-triangle fa-2x" style="color: #ff6500;text-align: center;"></i> <span style="font-size: 30px;color: #404040;font-family: font-family: Helvetica, Arial, sans-serif;"><b>Correlativo</span> <span style="font-size: 30px;color: red;font-family: font-family: Helvetica, Arial, sans-serif;"><span style="color: red" id="correlativo_cff"></span></span></b><br>
        </div>
      </div>
      <input type="hidden" name="" id="n_venta_cff">
      <input type="hidden" name="" id="id_paciente_venta_cff">
      <input type="hidden" name="" id="tipo_comprobantee" value="Credito Fiscal">

      <form  style="margin-left:30px; margin-right:30px">
        <div class="col-sm-3">
            <label for="ex3">Cliente&nbsp;&nbsp;&nbsp;<input class="col-sm-2 col-form-label"  id="edit_cliente_cff" onClick="habilita_edit_cliente_cff"></label>
            <input class="form-control" id="cliente_edit" type="text" name="cliente_edit" onkeyup="mayus(this);">
        </div>
      </form>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="link_print_cff" target="_blank" href=""><button type="button" class="btn btn-primary" onClick="registrar_impresionn();">Imprimir</button></a>
      </div>
    </div>
  </div>
</div>