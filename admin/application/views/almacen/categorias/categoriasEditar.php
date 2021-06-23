<!--
<script src="<?php echo base_url();?>assets/js/jquery.functions.popup.js"></script>
-->
<div class="modal-dialog">
  <div class="modal-content">
		  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Registro de Categoria</span>
		  </div> 
      <form id="formCategoria" name="formCategoria" method="post" >
          <div class="modal-body">
          <div class="row">
                <div class="col-lg-12 left">
                  <div class="row">
                    <div class="col-xs-12">

                      <div class="form-group has-success">
                          <label for="inputMarca">Categoria:</label>
                          <input class="form-control" name="id" id="id" type="hidden" >
                          <input class="form-control" name="name" id="name" type="text" placeholder="Enter Skill" required value="<?php echo $name ?>">
                      </div>
                    </div>
                </div>
                </div>
              </div>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
              <button type="button" class="btn btn-success" id="btnEditar"><i class="fa fa-floppy-o"></i> Modificar</button>
          </div>
      </form> 
	   
    </div>
</div>
 



