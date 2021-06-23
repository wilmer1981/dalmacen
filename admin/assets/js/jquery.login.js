var xD={
	all:{
		vars:function(){
			xD.l1=['index','catalogos','producto','comprar','logins','menu','comentariotienda','mibolsa','micuenta','clientes','llamadas','visitas','iclientes', 'nuestrastiendas'];
			xD.l2='/api?callback=?';
			xD.l3='//d13xymm0hzzbsd.cloudfront.net/';
			xD.l4=true;
			xD.l5=0;
			xD.l6=$('body');
			xD.l7=['monoloco', 'monadas'];
		},	
		   

		
		fn0:function(){
			//var l1=location.pathname!=='/'?(location.pathname).substr(1):'index';
			//var l2=l1.split('/');
			/*
			var l1 = window.location.search;
			var l2 = l1.split('=');
			var l3 = l2[0];
			var l4 = l2[1];	
			alert("hola: "+l4);
			*/
		
			/*
			$.each(xD.l1,function(pppp1,pppp2){
				if(pppp2===l2[0].replace('-','')) {
					xD[pppp2].run();
					return false;
				}else if(xD.l7.indexOf(l2[0].replace('-','')) >= 0) {
					xD['promocatalog'].run();
					return false;
				}
			});
			*/

			/*
		  	$(window).scroll(function () {
		     	if ($(this).scrollTop() <= 123) {
		       		$('.scroll_option_off').css('margin-top', '0px');
		     	} else {
		     		$('.scroll_option_off').css('margin-top', '-48px');
		     	}
		   	});*/
			
			/*
			$(document).ready(function() {
		       $('#table-ilista').DataTable({
		            responsive: true,
					lengthMenu: [5, 10, 25, 50, 100],
					//Set column definition initialisation properties.
				"columnDefs": [
				{ 
					"targets": [ -1 ], //last column
					"orderable": false, //set not orderable
				},
				],
		        });
				
		    });*/
			
	
	/*
		$(document).ready(function() {					
		       $('#table-example').DataTable({
		            responsive: true,
					lengthMenu: [5, 10, 25, 50, 100],
					//Set column definition initialisation properties.
				"columnDefs": [
				{ 
					"targets": [ -1 ], //last column
					"orderable": false, //set not orderable
				},
				],
		        });				
		});
		*/
		/*
		//table llamadas
		$(document).ready(function(){
		
		    //datatables
			var table = $('#table').DataTable({ 
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
				// Load data for the table's content from an Ajax source
				"ajax": {
					//"url": "<?php echo site_url('person/ajax_list')?>",
					"url": "",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [
				{ 
					"targets": [ -1 ], //last column
					"orderable": false, //set not orderable
				},
				],

			});
		
		}); 
		*/

		//Agregar usuario
		$(document).ready(function(){					
			 $(".btnAgregarCliente").click(function(){	
			 /*
			 if ($('input[name="categoria"]').is(':checked')) {
				alert('Campo correcto');
			} else {
				alert('Se debe seleccionar un idioma');
			}*/
			//var val= $('input:radio[name=categoria]:checked').val(); //ok
			// var val = $("input[name='categoria']:checked").val(); 
			 //var val =  $("[name='type'][checked]").attr("value");

		
			//alert('Campo correcto');
			//var valor= $("input[name=radiosfelices]:checked").prop("value"); 
			//alert(valor);
			
		
			//var categoria=$('input:radio[name=categoria]:checked').val();
				//alert(categoria);
			 
					xD.all.validarCliente();
			});
			

			
	    });
		
		//editar usuario
		$(document).ready(function(){					
			 $(".btnEditar").click(function(){			
				xD.all.validarUsuarioEdit();
			});
	    });

	

				//acepta solo numeros	
			$(document).ready(function (){
				$('#txtTelefono').keypress(function (tecla){
					//this.value = (this.value + '').replace(/[^0-9]/g, '');
					if(tecla.charCode < 48 || tecla.charCode > 57) return false;
				});
			});
			
	
	$(document).ready(function(){
		   $(document).on('click', 'a', function(event) {				
				var cliente = $(this).attr('cliente');
				$('#idCliente').val(cliente);

			});

		});
		
	
	  
		  $("#modalCadastrar").on('shown.bs.modal', function (e) {
			  var element = $(e.relatedTarget);
			  var type = element.data('alert');
			});
					
		
		////////////////////permisos//////////////////
	$(document).ready(function(){
        $(document).on('click', '#marcarTodos', function(event) {
            if($(this).prop('checked')){
              $('.marcar').each(
                 function(){
                    $(this).attr("checked", true);
                 }
              );
           }else{
              $('.marcar').each(
                 function(){
                    $(this).attr("checked", false);
                 }
              );
           }
        }); 
	
		});
	////////////////////////////////////////////////////////////////
	},
		
	reload_table:function(){
      table.ajax.reload(null,false); //reload datatable ajax
    },
		
		
		
		
		validarUsuarioEdit:function(){
            $('#formUsuario').validate({
            rules : {
                  nombres:{ required: true},
                  //apellidos:{ required: true},
                  direccion:{ required: true},
                  //telefonos:{ required: true},
                  usuario_tipo:{ required: true},
				  id_permiso:{ required: true},
				  usuario:{ required: true},
                 // contrasena:{ required: true},
                  email:{ required: true},
                 // email_contrasena:{ required: true},
                  email_nombre:{ required: true}
            },
            messages: {
                  nombres :{ required: 'Campo Requerido.'},
                  //apellidos:{ required: 'Campo Requerido.'},
                  direccion:{ required: 'Campo Requerido.'},
                  //telefono:{ required: 'Campo Requerido.'},
                  usuario_tipo:{ required: 'Campo Requerido.'},
                  id_permiso:{ required: 'Campo Requerido.'},
                  //estado:{ required: 'Campo Requerido.'},
				  usuario:{ required: 'Campo Requerido.'},
                //  contrasena:{ required: 'Campo Requerido.'},
                  email:{ required: 'Campo Requerido.'},
                 // email_contrasena:{ required: 'Campo Requerido.'},
                  email_nombre:{ required: 'Campo Requerido.'}        
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });	   

		},
		
		validarCliente:function(){
			
           $('#formCliente').validate({
            rules :{
                  //cliente:{ required: true},
			     // direccion:{ required: true},
				  //distrito:{ required: true},
                 // tipo:{ required: true},
				 nombre:{ required: true}
                 // apellido:{ required: true},
                  //telefono:{ required: true},
                 // email:{ required: true},
                  //contrasena:{ required: true}
            },
            messages:{
                 // cliente :{ required: 'Campo Requerido.'},
                  //direccion :{ required: 'Campo Requerido.'},
				//  distrito:{ required: 'Campo Requerido.'},
                 // tipo:{ required: 'Campo Requerido.'},
				  nombre:{ required: 'Campo Requeridos.'}
                  //apellido:{ required: 'Campo Requerido.'},
                 // telefono:{ required: 'Campo Requerido.'},
                 // email:{ required: 'Campo Requerido.'},
                 // contrasena:{ required: 'Campo Requerido.'}
            },	
            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }		
           });			   

		},
		ModalAddUser:function(){
				$("#btn-adduser").click(function(ev){	
								
					//$('#form')[0].reset(); // reset form on modals
					//$('.form-group').removeClass('has-error'); // clear error class
					//$('.help-block').empty(); // clear error string
					$('#modal_form_add').modal('show'); // show bootstrap modal
					$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
					
					$.post(BASE_URL + 'clientes/adicionarpopup/',function(data){
					 				$("#modal_form_add").html(data);  					 
									//$("#dialog_mi_popup").dialog( "open" ); 
									//$('#modal_form_search').modal('show'); // show bootstrap modal									
								});        
         
					});							
						
		},
		
		
		/*
		closeModalX:function(){
			$('.close-modal').click(function(){
				var Id        = $(this).data('id');
				var idusu     = $('#idcliente'+Id).val();
				var nombres   = $('#cliente'+Id).val();
				//var imagenUrl = $('#imag'+Id).val();
				xD.all.closemodal(idusu,nombres);	
				$('#modal_form_search').modal('hide');	
				//$('#modal_form_search').removeClass('show');					
			});	
		},
		closemodal:function(idusu,nombres) {		
				var parametros = {
				"idusu" : idusu,
				"nombres" : nombres
				//"imagenUrl" : imagenUrl				
				};	
				//alert('id: '+idusu+'nombres: '+nombres+'foto: '+imagenUrl);
				$('#idccliente').attr('value', idusu); 
				$('#ccliente').attr('value', nombres); 
				//$('#imagen').attr('src',imagenUrl);
				//$('#modal_form_search').modal('hide');				
		},	*/

		
		contacto:function(){
				$("#btn_enviar").click(function(){		
					if(xD.all.validaForm()){			
						//var id_items_containers = $(this).data('id_items_containers');
						if(confirm('?Seguro de Enviar?')){
							str = $("#frm_contacto_add").serialize();	
							xD.all.confirm_add_contacto(str);						
								//$(".container-orden").load(location.href+" .container-orden>*","");
						}
					}					
				});
				$("#txtNombres, #txtEmail, #txtTelefono, #txtComments, #txtCaptcha").keyup(function(){
					if( $(this).val() != "" ){
						$("#campError").fadeOut();			
						return false;
					}		
				});					
		},
		confirm_add_contacto:function(str) {
              $.ajax({
                beforeSend: function(){
					$('#campError').show().html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
				},
                cache: false, // Indicamos que no se guarde en cache
                type: "POST", // Variables POST
                url:"controller/ContenidoController.php", // srcript a ejecutar
 				data: str + "&accion=message", // paso de datos
               // cuando es exitoso el llamado
                success: function(response){
					if(response=="success"){
						$('#campError').show().html('<span class="response">Tu mensaje a sido enviado con exito.</span>'); // Mostramos los valores devueltos por el php
						xD.all.limpiarForm();		
						setTimeout(function() {
							$("#campError").fadeOut(1500);
						},3000);
					}else{
						$('#campError').show().html('<span class="error">Texto de verificacion incorrecto.</span>'); // Mostramos los valores devueltos por el php
					}
                }
				/*
				success: function(response){
                    $('#campError').html('<span class="response">'+response+'</span>'); // Mostramos los valores devueltos por el php
					xD.all.limpiarForm();		
					setTimeout(function() {
						$("#campError").fadeOut(1500);
					},3000);
                }
				*/
            });
		},
		
		cotizacion:function(){
				$("#btnEnviar").click(function(){		
					if(xD.all.validaFormC()){					
						if(confirm('?Seguro de Enviar?')){
							str = $("#frm_cotizacion_add").serialize();	
							xD.all.confirm_add_cotizacion(str);						
								//$(".container-orden").load(location.href+" .container-orden>*","");
						}
					}					
				});
				$("#txtNombres, #txtEmail, #txtTelefono, #txtComments, #txtCaptcha").keyup(function(){
					if( $(this).val() != "" ){
						$("#campErrorC").fadeOut();			
						return false;
					}		
				});	
				$("#txtServicio").change(function() {
					if( $(this).val() != "0" ){
						$("#campErrorC").fadeOut();			
						return false;
					}		
				});
		},
		confirm_add_cotizacion:function(str) {
              $.ajax({
                beforeSend: function(){
					$('#campErrorC').show().html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
				},
                cache: false, // Indicamos que no se guarde en cache
                type: "POST", // Variables POST
                url:"controller/ContenidoController.php", // srcript a ejecutar
 				data: str + "&accion=cotizacion", // paso de datos
               // cuando es exitoso el llamado
                success: function(response){
					if(response=="success"){
						$('#campErrorC').show().html('<span class="response">Tu mensaje a sido enviado con exito.</span>'); // Mostramos los valores devueltos por el php
						xD.all.limpiarForm();		
						setTimeout(function() {
							$("#campErrorC").fadeOut(1500);
						},3000);
					}else{
						$('#campErrorC').show().html('<span class="error">Texto de verificacion incorrecto.</span>'); // Mostramos los valores devueltos por el php
					}
                }
				/*
				success: function(response){
                    $('#campError').html('<span class="response">'+response+'</span>'); // Mostramos los valores devueltos por el php
					xD.all.limpiarForm();		
					setTimeout(function() {
						$("#campError").fadeOut(1500);
					},3000);
                }
				*/
            });
		},
		
		validaForm:function(){		
					$(".error").remove();
					var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
					//var acepto = $('input:checkbox[name=acepto]:checked').length;							
					if( $("#txtNombres").val() == "" ){
						$("#txtNombres").focus();
						$("#campError").show().append("<span class='error'>Porfavor, Ingrese su nombre.</span>");
						return false;
					}else if( $("#txtEmail").val() == "" || !emailreg.test($("#txtEmail").val())){
						$("#txtEmail").focus();
						$("#campError").show().append("<span class='error'>Porfavor, Ingrese un E-mail valido.</span>");
						return false;
					}else if( $("#txtTelefono").val() == ""){
						$("#txtTelefono").focus();
						$("#campError").show().append("<span class='error'>Porfavor, Ingrese su Telefono.</span>");
						return false;
					}else if( $("#txtComments").val() == ""){
						$("#txtComments").focus();
						$("#campError").show().append("<span class='error'>Porfavor, Ingrese su comentario.</span>");
						return false;
					}else if( $("#txtCaptcha").val() == ""){
						$("#txtCaptcha").focus();
						$("#campError").show().append("<span class='error'>Porfavor, Ingrese la clave</span>");
						return false;
					/*}
					else if( acepto == ""){
						$("#error").focus().after("<span class='error'>Porfavor, Seleccione Acuerdo</span>");
						return false;	*/
					}else{
						//str = $("#frm_contacto_add").serialize();	
						//confirm_add_contacto(str);
						return true
					}
		},	
		validaFormC:function(){		
					$(".error").remove();
					var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
					//var acepto = $('input:checkbox[name=acepto]:checked').length;							
					if( $("#txtNombres").val() == "" ){
						$("#txtNombres").focus();
						$("#campErrorC").show().append("<span class='error'>Porfavor, Ingrese su nombre.</span>");
						return false;
					}else if( $("#txtEmail").val() == "" || !emailreg.test($("#txtEmail").val())){
						$("#txtEmail").focus();
						$("#campErrorC").show().append("<span class='error'>Porfavor, Ingrese un E-mail valido.</span>");
						return false;
					}else if( $("#txtTelefono").val() == ""){
						$("#txtTelefono").focus();
						$("#campErrorC").show().append("<span class='error'>Porfavor, Ingrese su Telefono.</span>");
						return false;
					}else if( $("#txtServicio option:selected").val() == "0"){
						$("#txtServicio").focus();
						$("#campErrorC").show().append("<span class='error'>Porfavor, Seleccione servicio.</span>");
						return false;
					}else if( $("#txtComments").val() == ""){
						$("#txtComments").focus();
						$("#campErrorC").show().append("<span class='error'>Porfavor, Ingrese su mensaje.</span>");
						return false;
					}else if( $("#txtCaptcha").val() == ""){
						$("#txtCaptcha").focus();
						$("#campErrorC").show().append("<span class='error'>Porfavor, Ingrese la clave</span>");
						return false;
					/*}
					else if( acepto == ""){
						$("#error").focus().after("<span class='error'>Porfavor, Seleccione Acuerdo</span>");
						return false;	*/
					}else{
						//str = $("#frm_contacto_add").serialize();	
						//confirm_add_contacto(str);
						return true
					}
		},
		limpiarForm:function(){	
			$("form")[0].reset();
		},		

		dropdown:function(){
			$('#menu-1 > ul > li').on({
				mouseenter:function(){
					$(this).addClass('active').find(' > ul').show();
					if($(this).find(' > ul > li > ul:first').length > 0) $(this).find(' > ul > li').addClass('haschild');
				},
				mouseleave:function(){
					$(this).removeClass('active').find(' > ul').hide();
				}
			});
		},
		mibolsamini:function(){
			$('#maintools-box3').on({
				mouseenter:function(){
					$('#maintools-box3-box2').show();
					$('#maintools-box3-box1').addClass('maintools-box3-box1-over');
					clearTimeout(xD.l5);
					if(xD.l4===true){
						xD.l4=false;
						$('#maintools-box3-box2-box1').show();
						$('#maintools-box3-box2-box2').hide();
						xD.all.mibolsaminidraw();
					}
				},
				mouseleave:function(){
					$('#maintools-box3-box2').hide();
					$('#maintools-box3-box1').removeClass('maintools-box3-box1-over');
					xD.l5=setTimeout(function(){xD.l4=true;},5000);
				}
			});
			$(document).on({
				click:function(){
					var ll1=$(this).data('id');
					$('#maintools-box3-box2-box1').show();
					$('#maintools-box3-box2-box2').hide();
					$.getJSON(xD.l2,{action:'set_carts',id_items:ll1,quantity:0},function(pppp1){
						xD.all.mibolsaminidraw();
					});
				},
				mouseenter:function(){
					$(this).css({'color':'red'});
				},
				mouseleave:function(){
					$(this).css({'color':'#B5B5B5'});
				}
			},'.mibolsamini-box2-box1-boxes4-boxes1');
		},
		mibolsaminidraw:function(){
			$.getJSON(xD.l2,{action:'get_carts_html_2'},function(pppp1){
				$('#maintools-box3-box2-box2').html(pppp1['html']).show();
				$('#maintools-box3-box1-box1').html(pppp1['summary']['quantity']);
				$('#maintools-box4').html(pppp1['summary']['quantity']);
				$('#maintools-box3-box1-box2').html(pppp1['total']);
				$('#maintools-box3-box2-box1').hide();
			});
		},
		rating:function(){
			$('.rating span .star').on({
				mouseenter:function(){
					$(this).closest('span').find('.star').prop('src', xD.l3+'1/20131227/13855799847980.png');
					$(this).prop('src', xD.l3+'1/20131227/13855799851455.png').prevAll().prop('src', xD.l3+'1/20131227/13855799851455.png');
				},
				mouseleave:function(){
					var span = $(this).closest('span');
					span.find('.star').prop('src', xD.l3+'1/20131227/13855799847980.png');
					span.find('.star:lt('+$($(this).data('input')).val()+')').prop('src', xD.l3+'1/20131227/13855799851455.png');
				},
				click:function(){
					$($(this).data('input')).val($(this).data('score'));
				}
			});
		},
		lightbox:function(position, content){
			$('#lightbox_box, #lightbox_background, #lightbox_close').remove();
			var ll1=$('<div/>',{id:'lightbox_background'});
			var ll2=$('<img/>',{id:'lightbox_close',src:xD.l3+'1/20131227/13856721477088.png'});
			var ll3=$('<div/>',{id:'lightbox_box'}).html($(content).html()).append(ll2);
			xD.l6.append(ll1, ll3);
			ll1.show();
			ll3.css({'position' : position, 'margin':'-'+Math.round(ll3.outerHeight()/2)+'px 0 0 -'+Math.round(ll3.outerWidth()/2)+'px'}).show();
			ll1.click(function(){ ll1.hide();ll3.hide();});
			ll2.click(function(){ ll1.hide();ll3.hide();});
		},
		lightboxclear:function(){
			$('#lightbox_box, #lightbox_background, #lightbox_close').remove();
		},
		lightboxresize:function(){
			var ll1=$('#lightbox_box');
			ll1.css({'margin':'-'+Math.round(ll1.outerHeight()/2)+'px 0 0 -'+Math.round(ll1.outerWidth()/2)+'px'});
		},
		ubigeos:function(){
			$('.ubigeos').on({
				change:function(){
					var t=$(this);
					var e=$(t.data('el-id')).prop('disabled',true);
					var v=t.val();
					if(v!==''&&v!=null){
						$.getJSON(xD.l2,{action:'get_ubigeos_2',id_ubigeos:v,option:t.data('option')},function(pppp1){
							var llll1='';
							llll1+='<option value="">POR FAVOR SELECCIONE</option>';
						    $.each(pppp1,function(ppppp1,ppppp2){
						        llll1+='<option value="'+ppppp2['id_ubigeos']+'" data-id_ubigeos="'+ppppp2['id_ubigeos']+'" data-store="0">'+ppppp2['description']+'</option>';
						    });
						    e.html(llll1).prop('disabled',false).change();
					    });
					}else{
						e.html('').change();
					}
				}
			});
		},
		cross_required:function(){
			$(document).on({
				submit:function(){
					var l1=true;
					$($(this).find(':input:visible[required]')).each(function(){
					    if($.trim($(this).val())===''||($(this).attr('name')!=='id_addresses'&&$(this).val()==='0')){
					        l1=false;
					    }
					});
					if(l1===false){
						alert('Un campo est� vac�o, vuelva a intentarlo.');
					}
					return l1;
				}

			},'form');
		},
		minizoom:function(){
			$(document).on({
				mouseenter:function(){
					$('.producto-box1-box4-box3-mini-zoom').remove();
					$(this).parent().append('<div class="producto-box1-box4-box3-mini-zoom"></div>');
					var posicion=$(this).position();
					var imagen=$(this).data('mini-zoom');
					$('.producto-box1-box4-box3-mini-zoom').html('<img src="'+imagen+'" height="140px">').css({'left':posicion.left-60,'top':posicion.top-170}).show();
				},
				mouseleave:function(){
					$('.producto-box1-box4-box3-mini-zoom').hide();
				}
			}, '.minizoom');
		},
		fblogin:function(){
			$('.fb-login').on({
				click:function(){
					FB.login(function(response){
						if(response.authResponse){
							$.getJSON(xD.l2,{action:'set_login_with_facebook', id_sites:'2'},function(pppp1){
								location.href = '/mi-cuenta';
							});
						}
					},{scope:'email,user_birthday'});
				}
			});
		},

		showTooltip:function(){
			//$("#alerta").show("slow"); 
			$("#alerta").show("slow"); 
       		setTimeout(xD.all.hideTooltip, 4000); 
		},

		hideTooltip:function(){
			$("#alerta").hide("slow"); 
			//$("#alerta").hide(); 
		},



		login:function(){
			$('#id-login').on({
				click:function(){
					var login = $('#logi').val();
					var passw = $('#passwd').val();
					var datos = $('#frm_login').serialize();
					var acc = 'autenticar';
					var opc = 'login';
					if(login!='' && passw!=''){
							$('#alerta').html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><img id="loader" src="images/ajax-loader.gif"/><small> Procesando, espere porfavor...</small></div>');
            				setTimeout(xD.all.showTooltip,100);
							var url="controller/UsuarioController.php?jsoncallback=?";
							$.getJSON(url, {logi:login,passwd:passw,accion:acc,opcion:opc})
							.done(function(data){
								if(data['validacion'] == "ok"){
									$('#alerta').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong></strong><small>'+data['respuesta'] +'</small></div>');
                       				setTimeout(xD.all.showTooltip, 100);
                       				window.location.href = 'index.php';
								}else {
									$('#alerta').html('<div class="alert alert-error alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error! </strong><small>'+data['respuesta'] +'</small></div>');
                     				setTimeout(xD.all.showTooltip, 100);
                     			}
							});
					
					}else if(login=='' ||  passw==''){
						$('#alerta').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong></strong><small> Porfavor, complete sus datos de acceso...</small></div>');
            			 setTimeout(xD.all.showTooltip, 100) 
					}
				}
			});

		},
		
		salir:function() {
			$('#id-form-salir').on({
				click:function(){
				/*
				autoOpen: false,
				modal: true,
				resizable: false,
				title: "Cerrar Sesi&oacute;n",
				show: "slide",
	            hide: "explode"
	            */

				$('#form-user-salir').dialog('option', 'buttons', { 
						"Ok": function() { 
								window.location.href="logout.php";
						},
						"Cancelar": function() { 					//cerrar ventana popup
							$(this).dialog("close");
						}
					});
					$('#form-user-salir').dialog('open');			 //abrimos el dialog
				}

			});
		},
		
registerContacto:function(){
		$('.btnRegister').click(function(){
				var cliente_id 	= 	$('#cliente_id').val();
				var category 	= 	$('#category').val();
				var nombre 		= 	$('#nombre').val();
				var apellido 	= 	$('#apellido').val();
				var email 		= 	$('#email').val();
				var telefono 	= 	$('#telefono').val();
				//alert("Los datos fueron agregados con exito"+nombre);

				$.ajax({
						type:"POST",
						url: BASE_URL + "clientes/adicionarcontacto",
						data:{
							'cliente_id':  cliente_id ,
							'category': 	category,
							'nombre': 		nombre,
							'apellido': 	apellido,
							'telefono': 	telefono,
							'email': 		email
						},
						success:function (data) {
							alert("Los datos fueron agregados con exito");
							$('#nombre').val(" ");
							$('#apellidos').val(" ");
							$('#email').val(" ");
							$('#telefono').val(" ");

						},error:function(jqXHR, textStatus, errorThrown){
							console.log('error:: '+ errorThrown);
						}

					});
			});
		},

		run:function(){
			xD.all.vars();	
			xD.all.fn0();
			xD.all.cross_required();
			xD.all.dropdown();
			xD.all.mibolsamini();
			xD.all.fblogin();
			xD.all.login();
			xD.all.salir();
			xD.all.contacto();
			xD.all.ModalAddUser();
			//xD.all.searchUser();
			xD.all.cotizacion();
			xD.all.registerContacto();
		}
	},
		///////////////////// CATALOGOS /////////////////////////
	catalogos:{
		vars:function(){
			xD.catalogos.l1=true;
		},
		
		fn0:function(){		
			$(document).ready(function() {

		     /*  $('#table-catalogos').DataTable({
				    "responsive": true,
					"lengthMenu": [5, 10, 25, 50, 100],
					"order": [0, "desc" ],
					//"columns": displayColumns,
					//"data": dataSet, // para que no salga popup advertencia
					//Set column definition initialisation properties.
					"columnDefs": [{ 
							"targets": [ -1 ], //last column
							//"searchable": false,
							"orderable": false //set not orderable
						}]		
					
		        });*/

		       	//al hacer submit al formulario comprobamos que
				//los 3 campos no vengan vacíos
				$(".formulario").submit(function(){		
					//var poblacion = $(".poblacion").val();
					var categoria = $(".categoria").val();
					var descripcion = $(".product_name").val();		
					if(categoria == '' && descripcion == ''){			
						alert('Escoge algún filtro para tu búsqueda');
						return false;			
					}
				});


				
		    });				
	
			/*
			$(document).ready(function(){
				$('input[type="radio"]').click(function(){				 
					if($(this).attr("value")=="CI"){			
						$(".form-cinicial").show();
						$(".form-ccliente").hide();
					
					}
					if($(this).attr("value")=="CC"){  
								   
						$(".form-cinicial").hide();
						$(".form-ccliente").show();											
					}		
					
					  //e.preventDefault();
				});
			});*/
			
					
		},
	
		search:function(){
				$("#btnBuscar").click(function(e){	
				//Cancel the link behavior  
					//e.preventDefault();		
					//alert("HolA");					
					
					$.post(BASE_URL + 'clientes/lista/',function(data){
					 				$("#resultado").html(data);  											
								});        
         
					});					
		},		

		
		run:function(){
			xD.catalogos.vars();
			xD.catalogos.fn0();
			xD.catalogos.search();
		}
	},	
	//////////////FIN CATALOGOS ///////////////////////////////

	/////////////LOGIN ////////////////
	logins:{
		vars:function(){
			xD.logins.l1=true;
		},
		
		fn0:function(){
			$(document).ready(function(){
				$('#login-in').click(function(){	
					if(xD.logins.validaLogin()){			
						//var id_items_containers = $(this).data('id_items_containers');
						//alert("hola");
						//if(confirm('?Seguro de Enviar?')){
							str = $("#formLogin").serialize();	
							xD.logins.confirm_login_in(str);						
								//$(".container-orden").load(location.href+" .container-orden>*","");
						//}
					}
					//xD.login.validaLogin();				
				});

				$("#password").keypress(function(e){
			       	if(e.which == 13) {
			          // Acciones a realizar, por ej: enviar formulario.
				        if(xD.logins.validaLogin()){			
							//var id_items_containers = $(this).data('id_items_containers');
							//alert("hola");
							//if(confirm('?Seguro de Enviar?')){
								str = $("#formLogin").serialize();	
								xD.logins.confirm_login_in(str);						
									//$(".container-orden").load(location.href+" .container-orden>*","");
							//}
						}
			       	}
			    });






			});			
					
		},
		validaLogin:function(){		
					//$(".error").remove();
					//var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
					//var acepto = $('input:checkbox[name=acepto]:checked').length;							
					if( $("#username").val() == "" ){
						$("#username").focus();
						//$("#campError").show().append("<span class='error'>Porfavor, Ingrese su nombre.</span>");
						return false;
					}else if( $("#password").val() == "" ){
						$("#password").focus();
					//	$("#campError").show().append("<span class='error'>Porfavor, Ingrese un E-mail valido.</span>");
						return false;
					}else{
						//str = $("#frm_contacto_add").serialize();	
						//confirm_add_contacto(str);
						return true
					}
		},
		confirm_login_in:function(str){
				$.ajax({
					beforeSend: function(){
						//$('.resultado').html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
						$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Espere!</strong><small> Procesando datos de acceso...</small></div>');				
					},
					cache: false, // Indicamos que no se guarde en cache
					type: "POST", // Variables POST
					url : BASE_URL + "home/verificarLogin",
					data: str, // paso de datos
					dataType: 'json',
					success: function(data){
						console.log();
						if(data.resultado == 'ok'){
							$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small>'+ data.resultado +'</small></div>'); // Mostramos los valores devueltos por el php
								setTimeout( function() {  //redirige a la pagina padre
								//window.location = "index.php?index.php/user/get_users"; // redirige a la pagina USERS
								window.location = BASE_URL;
								//document.location.reload(); //redirige a la pagina donde se quedo
							}, 1000 );
						}else if(data.resultado == 'error'){
							$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Usuario o password incorrecto.</small></div>'); // Mostramos los valores devueltos por el php
			
						}else{ //inactivo
							$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small> Ud. no tiene permiso, comunicate con el administrador. </small></div>'); // Mostramos los valores devueltos por el php
						}				
					}
				});	
		},	
		
		run:function(){
			xD.logins.vars();
			xD.logins.fn0();
		}
	},	

	
	///////////////////// LLAMADAS /////////////////////////
	llamadas:{
		vars:function(){
			xD.llamadas.l1=true;
		},
		
		fn0:function(){			
	
			$(document).ready(function(){
				$('input[type="radio"]').click(function(){				 
					if($(this).attr("value")=="CI"){
					//	$("#formLlamada")[0].reset();
					   // $('#cidcliente').val(''); //txtID is textbox ID	
					  //  $('#ccategory').val(''); //txtID is textbox ID	
						//$('#ccliente').val('') ;					
						$(".form-cinicial").show();
						$(".form-ccliente").hide();
					
					}
					if($(this).attr("value")=="CC"){   
					   // $("#formLlamada")[0].reset();
					   // $('#iidcliente').val(''); //txtID is textbox ID	
						//$('#icategory').val(''); //txtID is textbox ID	
						//$('#icliente').val(''); //txtID is textbox ID					   
						$(".form-cinicial").hide();
						$(".form-ccliente").show();	
						//$('input').val('');
						//$('form : input[type="text"]').attr('value','');
					  //  $("#formLlamada").reset();							
					}		
					
					  //e.preventDefault();
				});
			});
			
					
		},
		reset:function () {
				//$(this).each (function() { this.reset(); });
				//this[0].reset();
		},
		ModalAddContact:function(){
			//$(document).ready(function() { 
				$(".btn-addContact").click(function(e){
					e.preventDefault();
					var idcliente  = $('#cidcliente').val();	
					var category   = $('#ccategory').val();	
					//var idcliente   = '100';	
					$('#modal_form_addContact').modal('show'); // show bootstrap modal
					$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
					console.log("id:"+ idcliente);
					$.post(BASE_URL + 'clientes/adicionarcontacto/',{idcliente:idcliente,category:category},function(data){
					 				$("#modal_form_addContact").html(data);  					 
									//$("#dialog_mi_popup").dialog( "open" ); 
									//$('#modal_form_search').modal('show'); // show bootstrap modal									
								});        
         
					});	
			//});	
						
		},

		searchUser:function(){
				$("#btn-searchuser").click(function(e){	
				//Cancel the link behavior  
					e.preventDefault();								
					//$('#form')[0].reset(); // reset form on modals
					//$('.form-group').removeClass('has-error'); // clear error class
					//$('.help-block').empty(); // clear error string
					$('#modal_form_search').modal('show'); // show bootstrap modal
					//$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
					
					$.post(BASE_URL + 'clientes/lista/',function(data){
					 				$("#modal_form_search").html(data);  											
								});        
         
					});							
		},		
		searchIUser:function(){
				$("#btn-searchiuser").click(function(e){	
					//Cancel the link behavior  
					e.preventDefault();			
					//$('#form')[0].reset(); // reset form on modals
					//$('.form-group').removeClass('has-error'); // clear error class
					//$('.help-block').empty(); // clear error string
					$('#modal_form_isearch').modal('show'); // show bootstrap modal
					$('.modal-title').text('Buscar Contacto Inicial'); // Set Title to Bootstrap modal title
					
					$.post(BASE_URL + 'clientes/ilista/',function(data){
					 				$("#modal_form_isearch").html(data);  											
								});        
         
					});							
		},		
		
		run:function(){
			xD.llamadas.vars();
			xD.llamadas.fn0();
			xD.llamadas.searchUser();
			xD.llamadas.searchIUser();
			xD.llamadas.ModalAddContact();
		}
	},	
	//////////////FIN LLAMADAS ///////////////////////////////


	visitas:{
		vars:function(){
			xD.visitas.l1=true;
		},
		
		fn0:function(){		
			/*$(document).ready(function() {
		       $('#table-visitas').DataTable({						   

				    "responsive": true,
					"lengthMenu": [5, 10, 25, 50, 100],
					"order": [[ 0, "desc" ]],
					//"columns": displayColumns,
					//"data": dataSet, // para que no salga popup advertencia
					//Set column definition initialisation properties.
					"columnDefs": [{ 
							"targets": [ -1 ], //last column
							//"searchable": false,
							"orderable": false //set not orderable
						}]					
					
		        });
				
		    });	*/		
					
		},
/*
		ModalAddContact:function(){
			//$(document).ready(function() { 
				$(".btn-addContact").click(function(e){
					e.preventDefault();
					var idcliente  = $('#cidcliente').val();	
					var category   = $('#ccategory').val();	
					//var idcliente   = '100';	
					$('#modal_form_addContact').modal('show'); // show bootstrap modal
					$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
					console.log("id:"+ idcliente);
					$.post(BASE_URL + 'clientes/adicionarcontacto/',{idcliente:idcliente,category:category},function(data){
					 				$("#modal_form_addContact").html(data);  					 
									//$("#dialog_mi_popup").dialog( "open" ); 
									//$('#modal_form_search').modal('show'); // show bootstrap modal									
								});        
         
					});	
			//});	
						
		},

		searchUser:function(){
				$("#btn-searchuser").click(function(e){	
				//Cancel the link behavior  
					e.preventDefault();
								
					//$('#form')[0].reset(); // reset form on modals
					//$('.form-group').removeClass('has-error'); // clear error class
					//$('.help-block').empty(); // clear error string
					$('#modal_form_search').modal('show'); // show bootstrap modal
					//$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
					
					$.post(BASE_URL + 'clientes/lista/',function(data){
					 				$("#modal_form_search").html(data);  											
								});        
         
					});							
		},		
		searchIUser:function(){
				$("#btn-searchiuser").click(function(e){	
					//Cancel the link behavior  
					e.preventDefault();			
					//$('#form')[0].reset(); // reset form on modals
					//$('.form-group').removeClass('has-error'); // clear error class
					//$('.help-block').empty(); // clear error string
					$('#modal_form_isearch').modal('show'); // show bootstrap modal
					$('.modal-title').text('Buscar Contacto Inicial'); // Set Title to Bootstrap modal title
					
					$.post(BASE_URL + 'clientes/ilista/',function(data){
					 				$("#modal_form_isearch").html(data);  											
								});        
         
					});							
		},		
		*/
		run:function(){
			xD.visitas.vars();
			xD.visitas.fn0();
			//xD.visitas.searchUser();
			//xD.visitas.searchIUser();
			//xD.visitas.ModalAddContact();
		}
	},	
	
	///////////////////// CLIENTES /////////////////////////
	clientes:{
		vars:function(){
			xD.clientes.l1=true;
		},
		
		fn0:function(){		
	
			$(document).ready(function(){
				$('input[type="radio"]').click(function(){
					if($(this).attr("value")=="MAY"){				
						$(".form-mayorista").show();
						$(".form-minorista").hide();
					}
					if($(this).attr("value")=="MIN"){	
						$(".form-mayorista").hide();
						$(".form-minorista").show();				
					}		
				});
			}); 
					
		},		
		
		run:function(){
			xD.clientes.vars();
			xD.clientes.fn0();
		}
	},	
	//////////////FIN CLIENTES ///////////////////////////////
	
	iclientes:{
		vars:function(){
			xD.iclientes.l1=true;
		},
		
		fn0:function(){		
			/*$(document).ready(function() {
		       $('#table-ilista').DataTable({
		            responsive: true,
					lengthMenu: [5, 10, 25, 50, 100],
					//Set column definition initialisation properties.
				"order": [0, "desc" ],
				"columnDefs": [
				{ 
					"targets": [ -1 ], //last column
					"orderable": false, //set not orderable
				},
				],
		        });
				
		    });*/
			
			$(document).ready(function() {
				$('#btn-addclientess').click(function(){
					var Id        = $(this).data('id');				
					
					//$.post(BASE_URL + 'clientes/adcionar/',parametros);  
				$.post(BASE_URL + 'clientes/adicionar/',function(data){
					 				//$("#modal_form_search").html(data);  											
								});        
         
					});						
								
				});	
			
					
		},
		
		run:function(){
			xD.iclientes.vars();
			xD.iclientes.fn0();
		}
	},	
	////////////////////////FIN ICLIENTES////////////////////////////////

	menu:{
		vars:function(){
			xD.menu.l1=true;
		},
		validarDatosMenu:function(){
					$(".error").remove();
					var opcion = $('#opcion').val();
					var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#titulo").val() == ""){
						$("#titulo").focus();
						$("#error").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else if(opcion=="register"){ 
						str = $("#frm_menu_register").serialize();	
						xD.menu.confirm_menu_register(str);
					}else{
						str = $("#frm_menu_update").serialize();	
						xD.menu.confirm_menu_update(str);
					}	
		},

		confirm_menu_register:function(str){
				$.ajax({
					beforeSend: function(){
						$('#resultado').html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
					},
					cache: false, // Indicamos que no se guarde en cache
					type: "POST", // Variables POST
					url:"controller/MenuController.php", // srcript a ejecutar
					data: str + "&accion=register&opcion=menu", // paso de datos
					success: function(response){
						$('#resultado').html(response); // Mostramos los valores devueltos por el php
						//limpiaFormu2($("#frm_contacto_add"));
					}
				});
		},

		confirm_menu_update:function(str){
				$.ajax({
					beforeSend: function(){
						$('#resultado').html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
					},
					cache: false, // Indicamos que no se guarde en cache
					type: "POST", // Variables POST
					url:"controller/MenuController.php", // srcript a ejecutar
					data: str + "&accion=update&opcion=menu", // paso de datos
					success: function(response){
						$('#resultado').html(response); // Mostramos los valores devueltos por el php
						//limpiaFormu2($("#frm_contacto_add"));
					}
				});
		},


		confirm_menu_delete:function(id){

	 			var dataString = "id="+ id;

				$.ajax({
					beforeSend: function(){
						$('#resultado').html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando ...</small>');
					},
					cache: false, // Indicamos que no se guarde en cache
		            type: "POST",
		           	url:"controller/MenuController.php", // srcript a ejecutar
					data: dataString + "&accion=delete&opcion=menu", // paso de datos
		            success: function(response) {		
		            	$('#resultado').html(response); // Mostramos los valores devueltos por el php
		            	setTimeout( function() {
							 document.location.reload(); //redirige a la pagina donde se quedo
						}, 1000 );
								
						//$('#delete-ok').empty();
						//$('#delete-ok').append('<div class="correcto">Se ha eliminado correctamente el servicio con id='+service+'.</div>').fadeIn("slow");
						//$('#'+parent).fadeOut("slow");
						//$('#'+parent).remove();
		            }
		        });

/*
			$.ajax({
				beforeSend: function(){ // Mostramos el pre-loader
					$('#form-delete-menu').html("<div id='message'></div>");
					$('#message').html('<img id="loader" src="images/ajax-loader.gif"/><p><small>Eliminando Registro. . .</small></p>');
				},
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST
				url:"controller/MenuController.php", // srcript a ejecutar
				data: str + "&accion=delete&opcion=menu", // paso de datos
				success: function(response){ // cuando es exitoso el llamado
				    $('#message').hide(); // Ocultamos el mensaje anterior
					$('#form-delete-client').html("<div id='respuesta'></div>");
					$('#respuesta').html(response); // Mostramos la respuesta devuelto por el php
				   	setTimeout( function() {  //redirige a la pagina padre
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );
				}
			});*/
		},
	
		
		register:function(){
		$('#id-menu-register').on({
				click:function(){
					xD.menu.validarDatosMenu();
				}
			});
		},
		
		delete:function(){
			$('.delete').click(function(){
				var id = $(this).data('id');
				xD.menu.confirm_menu_delete(id);
			}); 
		},
		delete222:function(){
			$('#id-menu-delete').on({
				click:function(id, nombre){
					var str = "id="+ id;
					$('#form-delete-menu').html("Estas seguro de Eliminar al Cliente: '" + nombre + "'");
		  			$('#form-delete-menu').dialog('option', 'buttons', { 
						"No": function() { 
							$(this).dialog("close");
						},
						"Si": function() { 
							$(":button:contains('Si')").hide(); 
							$(":button:contains('No')").hide(); 
							xD.menu.confirm_delete_menu(str);
						}
					});
					$('#form-delete-menu').dialog('open');
				}
			});
		},

		
		run:function(){
			xD.menu.vars();
			xD.menu.register();
			xD.menu.delete();
		}
	},
	
	index:{
		vars:function(){
			xD.index.l1=true;
		},
		fn1:function(){
			$('#index-box-box1-box2 > ul > li:gt(0)').hide();
			setInterval(function(){
			 $('#index-box-box1-box2 > ul > li:first-child').fadeOut(800).next("li").fadeIn(100).end().appendTo('#index-box-box1-box2 > ul');}, 5500);
			$("#index-box-box2 > #index-prev").click(function(){
				if (xD.index.l1 === true && parseInt($("#index-box-box2 > #index-box-box2-box1 > ul").css("margin-left")) < 0) {
					xD.index.l1 = false;
					$("#index-box-box2 > #index-box-box2-box1 > ul").animate({
						"margin-left": "+=100px"
					},{
						complete: function() {
					      xD.index.l1 = true;
					    }
					},
					"slow");
				}
			});
			$("#index-box-box2 > #index-next").click(function(){
				if (xD.index.l1 === true && parseInt($("#index-box-box2 > #index-box-box2-box1 > ul").css("margin-left")) - 160 > -($("#index-box-box2 > #index-box-box2-box1 > ul").width() - $("#index-box-box2-box1").width())) {
					xD.index.l1 = false;
					$("#index-box-box2 > #index-box-box2-box1 > ul").animate({
						"margin-left": "-=100px"
					},{
						complete: function() {
					      xD.index.l1 = true;
					    }
					},
					"slow");
				}							
			});
		},
		run:function(){
			xD.index.vars();
			xD.index.fn1();
		}
	}


};

//ejecutamos todas las funciones
$(function(){
	xD.all.run();
	xD.menu.run();
	xD.logins.run();
	xD.llamadas.run();
	xD.visitas.run();
	xD.clientes.run();
	xD.catalogos.run();
	xD.iclientes.run();
	
});

/*************************JQUERY*******************************************/

	
