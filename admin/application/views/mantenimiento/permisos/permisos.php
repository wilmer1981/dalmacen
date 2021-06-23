<div class="page-content">
    <div class="page-header">
        <h1>Gestor
            <small><i class="ace-icon fa fa-angle-double-right"></i>
                Niveles de Acceso
            </small>
        </h1>
		<div class="botones pull-right">
		<button type="button" data-toggle="tooltip" title="" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg" data-original-title="Filter"><i class="fa fa-filter"></i></button>
		<a href="<?php echo base_url('permisos/adicionar');?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
		<button type="submit" form="form-product" formaction="https://demo.opencart.com/admin/index.php?route=catalog/product/copy&amp;user_token=lSMeimbudzc3yHGZRH9ly3QuX1MkKy35" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Copy"><i class="fa fa-copy"></i></button>
		<button type="button" data-toggle="tooltip" class="btn btn-danger btn_deleteuser" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
	
    <div class="row">
        <div class="col-md-12">
                    <div class="clearfix">
					<!--
                      <div class="pull-right tablePermisoTools-container"></div>
					  -->
                    </div>                 
                    <div>
                      <table id="permisos" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th class="center">
                              <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                              </label>
                            </th>
                            <th>Titulo</th>
                            <th>Fech.Creacion</th>
                            <th class="hidden-480">Clicks</th>

                            <th>
                              <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                              Update
                            </th>
                            <th class="hidden-480">Estado</th>
                            <th></th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach ($results as $r) {
                            if($r->estado == 1){$estado = 'Ativo';}else{$estado = 'Inativo';}
                            echo '<tr>';
                            echo '<td class="center">
                              <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                              </label>
                            </td>';

                            echo '<td><a href="#">'.$r->nombre.'</a></td>';
                            echo '<td>'.date('d/m/Y',strtotime($r->fech_reg)).'</td>';
                            echo '<td class="hidden-480">'.$estado.'</td>';
                            echo '<td>Feb 12</td>';

                            echo '<td class="hidden-480">
                              <span class="label label-sm label-warning">Expiring</span>
                            </td>';

                            echo '<td>';
                              echo '<div class="hidden-sm hidden-xs action-buttons">
                                <a class="blue" href="#">
                                  <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>

                                <a class="green" href="'.base_url('permisos/editar/'.$r->id).'">
                                  <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                                <a class="red" href="#">
                                  <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                              </div>

                              <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                  <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                  </button>

                                  <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                    <li>
                                      <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                        <span class="blue">
                                          <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                        </span>
                                      </a>
                                    </li>

                                    <li>
                                      <a href="'.base_url('permisos/editar').'" class="tooltip-success" data-rel="tooltip" title="Edit">
                                        <span class="green">
                                          <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        </span>
                                      </a>
                                    </li>

                                    <li>
                                      <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                        <span class="red">
                                          <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              </div>';
                            echo '</td>';
                          echo '</tr>';
                             }?>
                        </tbody>
                      </table>
                </div>
            </div>
    </div>
</div>