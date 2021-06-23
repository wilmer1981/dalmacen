      <ul class="nav nav-list">
          <li class="<?php if(isset($menuPanel)){echo 'active';};?>">
            <a href="<?php echo base_url()?>">
              <i class="menu-icon fa fa-tachometer"></i>
              <span class="menu-text"> Dashboard </span>
            </a>
            <b class="arrow"></b>
          </li>
          <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cSistema')  || 
            $this->permission->checkPermission($this->session->userdata('permiso'),'vSistema') || 
            $this->permission->checkPermission($this->session->userdata('permiso'),'vBackup')){ 
          ?>

          <li class="<?php if(isset($menuGenerales)){echo 'active open';};?>" >
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-desktop"></i>
              <span class="menu-text">Sistema</span>
              <b class="arrow fa fa-angle-down"></b>
            </a><b class="arrow"></b>
            <ul class="submenu">       
               <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cSistema')){ ?>
              <li class="<?php if(isset($menuConfiguraciones)){echo 'active';};?>">
                <a href="<?php echo base_url('configuraciones');?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Configuracion Global
                </a><b class="arrow"></b>
              </li>
               <?php } ?>
         

              <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vBackup')){ ?>
           
              <li class="">
                <a href="<?php echo base_url('configuraciones/backup')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Backup
                </a>
                <b class="arrow"></b>
              </li>
               <?php } ?>  

	<!--
          
              <li class="">
                <a href="#" class="dropdown-toggle">
                  <i class="menu-icon fa fa-caret-right"></i>

                  Three Level Menu
                  <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                  <li class="">
                    <a href="#">
                      <i class="menu-icon fa fa-leaf green"></i>
                      Item #1
                    </a>

                    <b class="arrow"></b>
                  </li>

                  <li class="">
                    <a href="#" class="dropdown-toggle">
                      <i class="menu-icon fa fa-pencil orange"></i>

                      4th level
                      <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                      <li class="">
                        <a href="#">
                          <i class="menu-icon fa fa-plus purple"></i>
                          Add Product
                        </a>

                        <b class="arrow"></b>
                      </li>

                      <li class="">
                        <a href="#">
                          <i class="menu-icon fa fa-eye pink"></i>
                          View Products
                        </a>

                        <b class="arrow"></b>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
			  -->
            </ul>
          </li>
        <?php } ?>

          <li class="<?php if(isset($menuUsuarios)){echo 'active open';};?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-list"></i>
              <span class="menu-text"> Usuarios </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
            <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vUsuario')){ ?>
              <li class="<?php if(isset($menuGestorUsuarios)){echo 'active';};?>">
                <a href="<?php echo base_url('usuarios')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Gestor de Usuarios
                </a>
                <b class="arrow"></b>
              </li>
            <?php } ?>  
			 <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vGrupo')){ ?>
              <li class="<?php if(isset($menuUsuariosTipo)){echo 'active';};?>">
                <a href="<?php echo base_url('usuarios/tipos')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Grupo de Usuarios
                </a>
                <b class="arrow"></b>
              </li>
			  <?php } ?>

				<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vPermiso')){ ?>
                <li class="<?php if(isset($menuPermisos)){echo 'active';};?>">
                <a href="<?php echo base_url('permisos')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
					Niveles de Acceso
                </a><b class="arrow"></b>
              </li>
               <?php } ?>
			   
            </ul>
          </li>
		
			<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cMenu')){ ?>         
			<li class="<?php if(isset($menuMenus)){echo 'active open';};?>" >
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-pencil-square-o"></i>
              <span class="menu-text"> Menus </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
				<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vMenu')){ ?>
                <li class="<?php if(isset($menuGestorMenus)){echo 'active';};?>">
                <a href="<?php echo base_url('menus')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Gestor de menu
                </a>

                <b class="arrow"></b>
              </li>
				<?php } ?>
				<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vMenu')){ ?>
                <li class="<?php if(isset($menuItems)){echo 'active';};?>">
                <a href="<?php echo base_url('menus/items')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Menu Items
                </a>

                <b class="arrow"></b>
              </li>
				<?php } ?>
			  <!--
              <li class="">
                <a href="wysiwyg.html">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Wysiwyg &amp; Markdown
                </a>
                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="dropzone.html">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Dropzone File Upload
                </a>
                <b class="arrow"></b>
              </li>
			  -->
            </ul>
          </li>
		  <?php } ?>
<!--
          <li class="">
            <a href="widgets.html">
              <i class="menu-icon fa fa-list-alt"></i>
              <span class="menu-text"> Widgets </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="calendar.html">
              <i class="menu-icon fa fa-calendar"></i>

              <span class="menu-text">
                Calendar

                <span class="badge badge-transparent tooltip-error" title="2 Important Events">
                  <i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
                </span>
              </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="gallery.html">
              <i class="menu-icon fa fa-picture-o"></i>
              <span class="menu-text"> Gallery </span>
            </a>

            <b class="arrow"></b>
          </li>
-->
		<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cContenido')){ ?>  
          <li class="<?php if(isset($menuContenido)){echo 'active open';};?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-tag"></i>
              <span class="menu-text"> Contenido </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
				<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vArticulo')){ ?> 
              <li class="">
                <a href="profile.html">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Gestor de Articulos
                </a>

                <b class="arrow"></b>
              </li>
			   <?php } ?>
			  
			  <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vArticulo')){ ?> 

              <li class="">
                <a href="inbox.html">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Articulos Destacados
                </a>

                <b class="arrow"></b>
              </li>
			   <?php } ?>
			   
				<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vCategoria')){ ?> 
              <li class="">
                <a href="pricing.html">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Gestor de Categorias
                </a>

                <b class="arrow"></b>
              </li>
			   <?php } ?>

             <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vBanner')){ ?> 
              <li class="<?php if(isset($menuBanners)){echo 'active';};?>">
                
                <a href="<?php echo base_url('banners')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Gestor de Banner
                </a>
                <b class="arrow"></b>
              </li>
			 <?php } ?>
            </ul>
          </li>
         <?php } ?>
		 
		 <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'cProducto')){ ?> 
          <li class="<?php if(isset($menuProductos)){echo 'active open';};?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-file-o"></i>
              <span class="menu-text">Productos</span>
              <b class="arrow fa fa-angle-down"></b>
            </a><b class="arrow"></b>

            <ul class="submenu">
              <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vProducto')){ ?>
              <li class="<?php if(isset($menuGestorProductos)){echo 'active';};?>">
                <a href="<?php echo base_url('productos')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Gestor de Productos
                </a>
                <b class="arrow"></b>
              </li>
            <?php } ?>  
			
			  
			<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vCatproducto')){ ?>

              <li class="<?php if(isset($menuCategoriasProducto)){echo 'active';};?>">
                <a href="<?php echo base_url('productos/categorias')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Categoria de Productos
                </a>

                <b class="arrow"></b>
              </li>
			   <?php } ?>  

			   <?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vMarca')){ ?>
              <li class="<?php if(isset($menuMarcasProducto)){echo 'active';};?>">
                <a href="<?php echo base_url('productos/marcas')?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Marca de Productos
                </a>

                <b class="arrow"></b>
              </li>
			   <?php } ?>  

            </ul>
          </li>
		<?php } ?>  
		
		<?php if($this->permission->checkPermission($this->session->userdata('permiso'),'vCotizacion')){ ?>		
           <li class="<?php if(isset($menuPedidos)){echo 'active';};?>">
            <a href="<?php echo base_url('pedidos')?>">

			  <i class="menu-icon fa fa-shopping-cart"></i>
              <span class="menu-text"> Pedidos <span class="badge badge-success cantpedidomenu"></span></span>
            </a>
            <b class="arrow"></b>
          </li>
		  <?php } ?> 
		  
        </ul>
		
		<!-- /.nav-list -->