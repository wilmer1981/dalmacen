	
	<div class="container">
		<div class="content-oferta">
			<?php 
				//$this->load->view($menusup);
				if(isset($ofertas)){ $this->load->view($ofertas);} 
			?>		
	    </div>

		<div class="content-top">
			<div class="section-header"><h3>ULTIMOS PRODUCTOS</h3></div>
			<div class="divider"></div>	
			<div class="grid-in">
				<div class="col-md-4 grid-top">
					<a href="<?php echo base_url('productos/catalogo/ropa'); ?>" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/pi01.jpg'); ?>" alt="">
							<div class="b-wrapper">
										<h3 class="b-animate b-from-left    b-delay03 ">
											<span>Ver productos</span>	
										</h3>
							</div>
					</a>
				<p><a href="<?php echo base_url('productos/catalogo/ropa'); ?>">Ropa</a></p>
				</div>
				<div class="col-md-4 grid-top">
						<a href="<?php echo base_url('productos/catalogo/calzados'); ?>" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/pi02.jpg') ?>" alt="">
							<div class="b-wrapper">
											<h3 class="b-animate b-from-left    b-delay03 ">
												<span>Ver productos</span>	
											</h3>
										</div>
						</a>
					<p><a href="<?php echo base_url('productos/catalogo/calzados'); ?>">Zapatillas</a></p>
				</div>
				<div class="col-md-4 grid-top">
						<a href="<?php echo base_url('productos/tecnologia-celulares-y-tablets'); ?>" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/pi03.jpg') ?>" alt="">
							<div class="b-wrapper">
											<h3 class="b-animate b-from-left    b-delay03 ">
												<span>Ver productos</span>	
											</h3>
										</div>
						</a>
					<p><a href="<?php echo base_url('productos/catalogo/tecnologia-celulares-y-tablets'); ?>">Celulares y Tablets</a></p>
				</div>
						<div class="clearfix"> </div>
			</div>
		</div>
		<!--
		<div class="content-top">
			<div class="section-header"><h3>OFERTAS DE LA SEMANA</h3></div>
			<div class="grid-in">
				<div class="col-md-4 grid-top">
					<a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/pi3.jpg') ?>" alt="">
						<div class="b-wrapper">
										<h3 class="b-animate b-from-left    b-delay03 ">
											<span>Shirt</span>	
										</h3>
									</div>
					</a>
				<p><a href="single.html">suffered alteration</a></p>
				</div>
				<div class="col-md-4 grid-top">
					<a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/pi4.jpg') ?>" alt="">
						<div class="b-wrapper">
										<h3 class="b-animate b-from-left    b-delay03 ">
											<span>Bag</span>	
										</h3>
									</div>
					</a>
				<p><a href="single.html">Content here</a></p>
				</div>
				<div class="col-md-4 grid-top">
					<a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/pi5.jpg') ?>" alt="">
						<div class="b-wrapper">
										<h3 class="b-animate b-from-left    b-delay03 ">
											<span>Shoe</span>	
										</h3>
									</div>
					</a>
				<p><a href="single.html">readable content</a></p>
				</div>
						<div class="clearfix"> </div>
			</div>	
		</div>
	-->
		<div class="content-top-bottom">
    		<div class="section-header"><h3>COLECCIONES DESTACADAS</h3></div>
			<div class="collection">
				<div class="col-md-6 men">
					<a href="<?php base_url('productos/catalogo/tecnologia-computacion-laptops'); ?>" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/t1.jpg') ?>" alt="">
						<div class="b-wrapper">
											<h3 class="b-animate b-from-top top-in   b-delay03 ">
												<span>Lorem</span>	
											</h3>
										</div>
					</a>
					
					
				</div>
				<div class="col-md-6">
					<div class="col-md1 ">
						<a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/t2.jpg') ?>" alt="">
							<div class="b-wrapper">
											<h3 class="b-animate b-from-top top-in1   b-delay03 ">
												<span>Lorem</span>	
											</h3>
										</div>
						</a>
						
					</div>
					<div class="col-md2">
						<div class="col-md-6 men1">
							<a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/t3.jpg') ?>" alt="">
									<div class="b-wrapper">
											<h3 class="b-animate b-from-top top-in2   b-delay03 ">
												<span>Lorem</span>	
											</h3>
										</div>
							</a>
							
						</div>
						<div class="col-md-6 men2">
							<a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo base_url('assets/images/t4.jpg') ?>" alt="">
									<div class="b-wrapper">
											<h3 class="b-animate b-from-top top-in2   b-delay03 ">
												<span>Lorem</span>	
											</h3>
										</div>
							</a>
							
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
		    </div>
			<div class="clearfix"> </div>
		</div>
    </div>
	
	<div class="content-bottom">
		<ul>
			<li><a href="#"><img class="img-responsive" src="<?php echo base_url('assets/images/lo.png') ?>" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="<?php echo base_url('assets/images/lo1.png') ?>" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="<?php echo base_url('assets/images/lo2.png') ?>" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="<?php echo base_url('assets/images/lo3.png') ?>" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="<?php echo base_url('assets/images/lo4.png') ?>" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="<?php echo base_url('assets/images/lo5.png') ?>" alt=""></a></li>
		<div class="clearfix"> </div>
		</ul>
	</div>