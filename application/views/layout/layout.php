<?php defined('BASEPATH') OR exit('No direct script access allowed');

$url       =  $this->uri->segment(1);  
//echo $url;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>D'ALMACEN.COM</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Zapatillas, Accesorios, Ropas, Laptop, PC, Smartphone, Samsung, LG, SonyErricsson, Motorola" />	
	<meta name="google-site-verification" content="aqFSrGw-x-e2E1NbVpDF81wx7Vvwzr0N3KBqFTdOquY" />
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" />

	<!-- Custom Theme files -->
	<!--theme-style-->
	<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo base_url('assets/css/fasthover.css'); ?>" rel="stylesheet" type="text/css" media="all" />	
	<!--//theme-style-->
	
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!--fonts-->
	<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'><!--//fonts-->

	<!-- start menu -->
	<link href="<?php echo base_url('assets/css/memenu.css'); ?>" rel="stylesheet" type="text/css" media="all" />		
	<link href="<?php echo base_url('assets/css/flexslider.css'); ?>" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript">
        var BASE_URL = "<?php echo base_url(); ?>";
    </script>
 </head>
<body>

<?php if(isset($header)){ $this->load->view($header); } ?>
<div class="banner">
	<?php 
	if(empty($url)){
		if(isset($slider)){ 
			$this->load->view($slider);
		} 
	}else{
		if(isset($breadcrumbs)){ 
			$this->load->view($breadcrumbs);
		} 
	}	
   ?>
</div>

<div class="content">
	<?php if(isset($view)){ $this->load->view($view);}   ?>
</div>
<div class="footer">
<?php if(isset($footer)){ $this->load->view($footer);	 } ?>
</div>



<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!--
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
-->


<script src="<?php echo base_url('assets/js/memenu.js'); ?>" type="text/javascript"></script>
	<script>
	$(document).ready(function(){
		$(".memenu").memenu();
	});
</script>


  <script src="<?php echo base_url('assets/js/responsiveslides.min.js') ?>"></script>

  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.flexisel.js'); ?>"></script>

<!--
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.scrollUp.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/simpleCart.min.js'); ?>"> </script>
-->
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

<script src="<?php echo base_url('assets/js/jquery.flexslider.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.cookie.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.functions.js') ?>"></script>
   <script type="text/javascript">
        $(window).load(function () {
            $("#slider").responsiveSlides({
              auto: true,
              nav: true,
              speed: 500,
              namespace: "callbacks",
              pager: true,
              prevText: "Previous",   // String: Text for the "previous" button
              nextText: "Next",       // String: Text for the "next" button
            });
          });
    </script>

	<script type="text/javascript">
		$(window).load(function() {
			$("#flexiselOferta").flexisel({
				visibleItems:4,
				animationSpeed: 1000,
				autoPlay: false,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:480,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:640,
						visibleItems:2
					},
					tablet: { 
						changePoint:768,
						visibleItems: 3
					}
				}
			});
			
		});
	</script>
	<script type="text/javascript">
					// Can also be used with $(document).ready()
				
		$(window).load(function() {
		  $('.flexslider').flexslider({
		    animation: "slide",
		    controlNav: "thumbnails"
		 
		  });
		});
	</script>

		<!--initiate accordion-->
	<script type="text/javascript">
		$(window).load(function() {
			    var menu_ul = $('.menu > li > ul'),
			           menu_a  = $('.menu > li > a');
			    menu_ul.hide();
			    menu_a.click(function(e) {
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
			
			});
	</script>
<!---->

</body>
</html>
