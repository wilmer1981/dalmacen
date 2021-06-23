<?php  

$url_img = $this->session->userdata('imagen');
  if($url_img){
      $imagen='uploads/'.$url_img;
      $image=base_url($imagen);
  }else{
      $imagen='assets/dist/img/user2-160x160.jpg';
      $image=base_url($imagen);
  }

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - Ace Admin</title>
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css')?>" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fonts.googleapis.com.css')?>" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ace.min.css')?>" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/ace-part2.min.css')?>" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ace-skins.min.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ace-rtl.min.css')?>" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/ace-ie.min.css')?>" />
    <![endif]-->
	 <link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert2/sweetalert.css');?>">
	 <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css');?>">
	 <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>" />

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?php echo base_url('assets/js/ace-extra.min.js')?>"></script>

    <!-- HTML5shiv and Respond.js')?> for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?php echo base_url('assets/js/html5shiv.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/respond.min.js')?>"></script>
    <![endif]-->

    <script type="text/javascript">
        // get the base url of the project
        var BASE_URL = "<?php echo base_url(); ?>";
    </script>
</head>
  <body class="no-skin">
   <?php if(isset($header)){ $this->load->view($header); } ?>

    <div class="main-container ace-save-state" id="main-container">
      <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
      </script>

      <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
          try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
              <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
              <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
              <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
              <i class="ace-icon fa fa-cogs"></i>
            </button>
          </div>

          <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
          </div>
        </div><!-- /.sidebar-shortcuts -->

        <?php if(isset($menu)){ $this->load->view($menu); } ?> 

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
      </div>

      <div class="main-content">
        <div class="main-content-inner">
			<?php if(isset($breadcrumbs)){ $this->load->view($breadcrumbs); } ?>
		    <section class="content spacing-top">    
            <?php if($this->session->flashdata('error') != null){?>
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <?php echo $this->session->flashdata('error');?>
               </div>
            <?php }?>
            <?php if($this->session->flashdata('success') != null){?>
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <?php echo $this->session->flashdata('success');?>
               </div>
            <?php }?>
			</section>
			<?php if(isset($view)){ $this->load->view($view); } ?>
        </div>

      </div><!-- /.main-content -->

      <div class="footer">
         <?php if(isset($footer)){ $this->load->view($footer); } ?>
      </div>

      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
      </a>

    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js')?>"></script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
    </script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
      <script src="<?php echo base_url('assets/js/excanvas.min.js')?>"></script>
    <![endif]-->
    <script src="<?php echo base_url('assets/js/jquery-ui.custom.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.ui.touch-punch.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.easypiechart.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.sparkline.index.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.flot.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.flot.pie.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.flot.resize.min.js')?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap-filestyle/bootstrap-filestyle.min.js');?>"></script>

    <!-- page specific plugin scripts -->
    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/buttons.flash.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/buttons.html5.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/buttons.print.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/buttons.colVis.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/dataTables.select.min.js')?>"></script>

    <script src="<?php echo base_url('assets/js/moment.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js')?>"></script>

    <!-- ace scripts -->
    <script src="<?php echo base_url('assets/js/ace-elements.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/ace.min.js')?>"></script>
	
    <script src="<?php echo base_url('assets/js/tinymce.min.js');?>"></script>
	<!--
	<script src="<?php echo base_url('assets/plugins/tiny_mce/tiny_mce.js');?>"></script>
	<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js');?>"></script>
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	-->
	
	<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert.min.js');?>"></script>

    <script src="<?php echo base_url('assets/js/jquery.functions.js')?>"></script>

  
</body>
</html>
