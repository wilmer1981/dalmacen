      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if(isset($menuPanel)){echo 'active';};?>">
          <a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>   

        <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')  || 
				 $this->permission->checkPermission($this->session->userdata('permiso'),'cEmpleado') || 
				 $this->permission->checkPermission($this->session->userdata('permiso'),'cBackup')){ 
		?>    
         <li class="treeview <?php if(isset($menuMantenimiento)){echo 'active open';};?>">
          <a href="#"><i class="fa fa-files-o"></i><span>Usuarios</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            
			<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){ ?>
               <li class="<?php if(isset($menuUsuarios)){echo 'active';};?>"><a href="<?php echo base_url('usuarios');?>"><i class="fa fa-circle-o"></i> Gestor Usuarios</a></li>
            <?php } ?>	
			<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){ ?>
               <li class="<?php if(isset($menuRoles)){echo 'active';};?>"><a href="<?php echo base_url('roles');?>"><i class="fa fa-circle-o"></i> Niveles de Acceso</a></li>
            <?php } ?>			
 
            <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cTipodoc')){ ?>
               <li class="<?php if(isset($menuTipodoc)){echo 'active';};?>"><a href="<?php echo base_url('documentos')?>"><i class="fa fa-circle-o"></i> Tipo Documentos</a></li>
            <?php } ?>       

          </ul>
        </li>
         <?php } ?>
		 
		<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){ ?>
            <li class="<?php if(isset($menuMenus)){echo 'active';};?>"><a href="<?php echo base_url('menu')?>"><i class="fa fa-pie-chart"></i> Menus</a></li>
        <?php } ?>
		
	
		 
		<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')  || 
				 $this->permission->checkPermission($this->session->userdata('permiso'),'cEmpleado') || 
				 $this->permission->checkPermission($this->session->userdata('permiso'),'mPex') || 
				 $this->permission->checkPermission($this->session->userdata('permiso'),'cBackup')){ 
		?>    
         <li class="treeview <?php if(isset($menuContenido)){echo 'active open';};?>">
          <a href="#"><i class="fa fa-files-o"></i><span>Contenido</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            
			<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario') ||
			         $this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){ 
			?>
                <li class="<?php if(isset($menuArticulos)){echo 'active';};?>"><a href="<?php echo base_url('articulos');?>"><i class="fa fa-circle-o"></i> Gestor de Articulos</a></li>
            <?php } ?>	
			
			<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')||
			         $this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){ 
			?>
                <li class="<?php if(isset($menuCategorias)){echo 'active';};?>"><a href="<?php echo base_url('categorias');?>"><i class="fa fa-circle-o"></i> Gestor de Categorias</a></li>
            <?php } ?>	
 
            <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cTipodoc')||
			         $this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){ 
			?>
                <li class="<?php if(isset($menuBanners)){echo 'active';};?>"><a href="<?php echo base_url('banners')?>"><i class="fa fa-circle-o"></i> Gestor de Banner</a></li>
            <?php } ?>       

          </ul>
        </li>
         <?php } ?>
		
		<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vProducto')  || 
          $this->permission->checkPermission($this->session->userdata('permiso'),'vCategoria')  || 
          $this->permission->checkPermission($this->session->userdata('permiso'),'vMarca')  || 
          $this->permission->checkPermission($this->session->userdata('permiso'),'vModelo')  || 
         $this->permission->checkPermission($this->session->userdata('permiso'),'vUnidad')){ 
         ?>  
        <?php } ?>
		<!--
		
        <li class="header">APLICACIONES</li>
 		<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){ ?>
           
            <li class="<?php if(isset($menuPex)){echo 'active';};?>"><a href="<?php echo base_url('pex')?>"><i class="fa fa-pie-chart"></i> Aplicacion PEX</a></li>
        <?php } ?>
		
		<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'mMolino')){ ?>
        
            <li class="<?php if(isset($menuMolino)){echo 'active';};?>"><a href="<?php echo base_url('molino')?>"><i class="fa fa-university" aria-hidden="true"></i> Aplicacion Molino</a></li>
		
        <?php } ?>
		<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'mGrifo')){ ?>
        
            <li class="<?php if(isset($menuGrifo)){echo 'active';};?>"><a href="<?php echo base_url('grifo')?>"><i class="fa fa-area-chart" aria-hidden="true"></i> Aplicacion Grifo</a></li>
		
        <?php } ?>
		-->
       
        <li class="header">CONFIGURACIONES</li>
        <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')  || 
         $this->permission->checkPermission($this->session->userdata('permiso'),'cEmpleado') || 
         $this->permission->checkPermission($this->session->userdata('permiso'),'cPermiso') || 
         $this->permission->checkPermission($this->session->userdata('permiso'),'cBackup')){ 
        ?>    
         <li class="treeview <?php if(isset($menuConfiguraciones)){echo 'active open';};?>">
          <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i><span>Configuraciones</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cEmpleado')){ ?>
               <li class="<?php if(isset($menuGenereales)){echo 'active';};?>"><a href="<?php echo base_url('configuraciones');?>"><i class="fa fa-circle-o text-red"></i> Configuracion General</a></li>
            <?php } ?>

            <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cPermiso')){ ?>
               <li class="<?php if(isset($menuPermisos)){echo 'active';};?>"><a href="<?php echo base_url('permisos')?>"><i class="fa fa-circle-o text-yellow"></i> Permisos</a></li>
            <?php } ?>
            <!--
             <li><a href="#"><i class="fa fa-circle-o text-olive"></i> <span>Almaneces/Sucurales</span></a></li>
      -->
              <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){ ?>
               <li><a href="<?php echo base_url('configuraciones/backup')?>"><i class="fa fa-circle-o text-aqua"></i> Backup</a></li>
            <?php } ?>    
 

          </ul>
        </li>
         <?php } ?>

      </ul>