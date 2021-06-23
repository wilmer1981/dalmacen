    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
              <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="<?php echo base_url()?>">Home</a>
              </li>
              <?php if($this->uri->segment(1) == null){?>
              <li class="active">Dashboard</li>
              <?php }?>
              <?php if($this->uri->segment(1) != null){?>
              <li><a href="<?php echo base_url().$this->uri->segment(1)?>"><?php echo ucfirst($this->uri->segment(1));?></a>
              </li>
              <?php }?>

              <?php if($this->uri->segment(2) != null){?>
              <li class="active"> <?php echo ucfirst($this->uri->segment(2)); ?></li>
              <?php }?>
            </ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
              <form class="form-search">
                <span class="input-icon">
                  <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                  <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span>
              </form>
            </div><!-- /.nav-search -->
          </div>
