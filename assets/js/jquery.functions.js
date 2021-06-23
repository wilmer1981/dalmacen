var xD={
	all:{
		vars:function(){
			xD.l1=['index','shopping','productos','registros','usuarios','login'];
			xD.l2='/api?callback=?';
			xD.l3='//d13xymm0hzzbsd.cloudfront.net/';
			xD.l4=true;
			xD.l5=0;
			xD.l6=$('body');
			xD.l7=['monoloco', 'monadas'];
		},	

	fn0:function(){		
			var currenturl =  window.location.pathname;			
		    var element    = currenturl.split('/');
			var url2       = element[3];	//3:
		    var url        = element[2];	//2:
		    var index      = element[1];    //1:pagina principal
			//alert(element[3]); 
		    //alert("url:"+url);

		    $(document).ready(function(){
 				var cambio = false;
				$('.nav li a').each(function(index) {
					if(this.href.trim() == window.location){
						//$(".nav li").removeClass("active");
						//$('.nav li.active').removeClass()
						$(this).parent().addClass("active");
						//$(this).closest('.dropdown').addClass("active");
						cambio = true;
					}
				});

				if(!cambio){ //si cambio==false
					$('.nav li:first').addClass("active"); //activamos el primer menu
				}
			});
			
			$(document).ready(function(){
				//var div   = document.getElementById("totalcart");
				//var total = div.textContent;
				var total1= totalcart;
				if(total1==0){
					$('.header-cart-count').hide();
				}else{
					$('.header-cart-count').show();
				}
				//alert(total1);	
				
			});	

			$('.cart_quantity_down').click(function(){
				//Solo si el valor del campo es diferente de 0
				if ($('#quantity').val() != 0)
					//Decrementamos su valor
					$('#quantity').val(parseInt($('#quantity').val()) - 1);
			});

			$('.cart_quantity_up').click(function(){
				//Aumentamos el valor del campo
				$('#quantity').val(parseInt($('#quantity').val()) + 1);
			});
	
			///////////------ SELECT DEPENDIENTE----///////// 
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();

			    $("#cboPais").change(function (){
					$("#cboPais option:selected").each(function () {
						var idpais=$('#cboPais').val();					
						$.post(BASE_URL +"Proveedores/getEstados",{ idpais: idpais}, 						
							function(data){
								$("#cboEstado").html(data);
						}); 						
					});
			   });

			    $("#cboDpto").change(function (){
					 //event.preventDefault();
					$('#cboProvincia').removeAttr("disabled");
					$("#cboDpto option:selected").each(function () {
						var iddpto=$('#cboDpto').val();					
						$.post(BASE_URL +"home/getProvincias",{ iddpto: iddpto}, 						
							function(data){
								$("#cboProvincia").html(data);
						}); 						
					});
			   });

			   $("#cboProvincia").change(function (){
					$('#cboDistrito').removeAttr("disabled");
					$("#cboProvincia option:selected").each(function () {
						var iddpto=$('#cboDpto').val();	
						var idprov=$('#cboProvincia').val();					
						$.post(BASE_URL +"home/getDistritos",{ iddpto: iddpto, idprov: idprov}, 	
							function(data){
								$("#cboDistrito").html(data);
						}); 						
					});
			   });

			    $("#cboDptos").change(function (){
					$("#cboDptos option:selected").each(function () {
						var iddpto=$('#cboDptos').val();					
						$.post(BASE_URL +"Clientes/getProvincias",{ iddpto: iddpto}, 						
							function(data){
								$("#cboProvs").html(data);
						}); 						
					});
			   });

			   $("#cboProvs").change(function () {
					$("#cboProvs option:selected").each(function () {
						var iddpto=$('#cboDptos').val();	
						var idprov=$('#cboProvs').val();					
						$.post(BASE_URL +"Clientes/getDistritos",{ iddpto: iddpto, idprov: idprov}, 	
							function(data){
								$("#cboDists").html(data);
						}); 						
					});
			    });

			    $("#cboArea").change(function () {
					$("#cboArea option:selected").each(function () {
						var idarea=$('#cboArea').val();					
						$.post(BASE_URL +"Departamentos/getDptoCargos",{ idarea: idarea}, 						
							function(data){
								$("#cboCargo").html(data);
						}); 						
					});
			    });								
				
				$("#formFile").on("submit", function(e){
				           var data;
						    data = new FormData(document.getElementById("formFile"));
						    //data.append('imagenProd', $('#imagenProd')[0].files[0]);
						    //data.append("imagenProd", "This is some extra data"); //extra
				            $.ajax({
				            	beforeSend: function(){
									//$('#campErrorC').show().html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
								 	//$('#mensaje').html('<img src="'+BASE_URL +'"assets/images/loading.gif"" alt="" />').fadeOut(1000);
								   $('#status').html('<img src="'+BASE_URL +'assets/images/loading.gif" alt="" /><small>Procesando...</small>');
								},
				                url: BASE_URL+'grifo/importarUpdateExcel',
				                data: data,
							    processData: false,
							    contentType: false,
							    type: 'POST',
								success: function(res){
								    //alert(data);
								    if(res.valid==true){
				                    	$("#status").html(res.message);
				                   

				                	}else{
				                		$("#status").html(res.message);				                	
				                	}
								}
							});

							e.preventDefault();
				               
				});
				
				//se ejcuta cada 0.5 segundo
				//1   segundo = 1000
				//0.5 segundo = 500	
				xD.all.notificaciones();
				//setInterval(xD.all.notificaciones, 500);	

			// EXPORTAR
			$("#btn_export_excel").click(function(){				
				var fechaini     = $('#txtFechaInicial').val();	
				var fechafin     = $('#txtFechaFinal').val();	
				var cboconsult   = $('#cboConsultor').val();
				var cbotipo      = $('#cboTipo').val();			
				var opcion       = $(this).data('opc');	

				var alerta = true;	
				if(opcion=="rc"){				
					var archivo ="reporteConsultores.xlsx";
					var accion  ='reportes/generarConsultoresExcel';
				}else if(opcion=="rap" && cbotipo=="3"){			
				  	var archivo ="reporteFaltas.xlsx";
				  	//var accion  ='reportes/generarAsistenciasExcel';			
				}else if(opcion=="rap" && cbotipo=="4" || cbotipo=="7" ){			
				  	var archivo ="reporteAsistencias.xlsx";
				  	//var accion  ='reportes/generarAsistenciasExcel';				
				}else if(opcion=="rap" && cbotipo=="5"){	
				  	var archivo ="reporteSunafil.xlsx";
				  	//var accion  ='reportes/generarAsistenciasExcel';
				}else if(opcion=="rap" && cbotipo=="6" && cboconsult!==""){		
					var archivo ="reporteInconsistencia.xlsx";
					//var accion  ='reportes/generarAsistenciasExcel';
				}else{
					alerta= false;	
					var message="Seleccione Consultor";
					xD.all.alertaReload(message,'error'); 
				}
				
				if(opcion=="rap"){			
				  	var accion  ='reportes/generarAsistenciasExcel';			
				}			

				if(alerta==true){
					swal({
					  title: "Desea seguir con la Descarga?",
					  text: "Click en CONTINUAR para generar el archivo!",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonClass: "btn-primary",
					  confirmButtonText: "Continuar!",
					  cancelButtonText: "Cancelar",
					  closeOnConfirm: false,
					  showLoaderOnConfirm: true
					},
					function(){
						setTimeout(function () {											
							    $.post(BASE_URL + accion, $('#formReporte').serialize(), function () { 						
									       		getLink=BASE_URL+archivo;
							            swal({
										  title: 'Informacion del Archivo!',
										//text: 'Ubicacion del archivo: (' + getLink + '). Click OK to continue to the content. <a href="'+ getLink +'" target="_blank">Descragar</a>',
										  text: 'Ubicacion del archivo: (' + getLink + '). Click en OK para descargar.',
										  html: true,
										  type: "success",
										  confirmButtonColor: '#2ecc71',
										  showCancelButton: false,
										},function(){
											window.open(getLink,'_blank');
											document.location.reload(); //redirige a la pagina donde se quedo
										});	
		    					}); 
    					 }, 2000);
					});	
   					return false;
				}								
			   });

			

			});

	
			$(document).ready(function () {
				var dateNow = new Date(); 
				
				//alert("Index:"+index);
		    
					if(index !=="registros"  && index !=="usuarios" && index !=="perfil" && index !=="archivos" && 
					   index !=="roles" && index !=="permisos" && index !=="motivos" && index !=="configuraciones" && 
					   index !=="departamentos" && index !=="cargos" && index !=="contratos" && index !=="estados" && url !=="tipo"){ //            
						/*$('#fecha_inicial').datetimepicker({
							 format: 'DD-MM-YYYY',
							 defaultDate:dateNow	
							 //defaultDate:'07-01-2019'
							 //defaultDate:fechaIni										 
							 //defaultDate:''
							//format: 'HH:mm:ss'
						});				
						$('#fecha_final').datetimepicker({
							 format: 'DD-MM-YYYY',									 
							 defaultDate:dateNow
							 //defaultDate:fechaFin	
							 //defaultDate:''
							//format: 'HH:mm:ss'
						});    */     


					}      
            });
		   
			$(document).ready(function(){	
			    if(url =="registrosss"  && url =="configuracionesss" && url =="productosss" && url =="tiposs"){
			/*
			   if(index =="registros"  && index =="usuarios" && index =="perfil" && index =="archivos" && 
							index =="roles" && index =="permisos" && index =="motivos" && index =="configuraciones" && 
							index =="departamentos" && index =="cargos" && index =="contratos" && index =="estados" && url =="tipo"){
			*/				
						
				$('#productoslista').DataTable({
					responsive: true,
					language: {
                		url: BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
            		},
					pageLength : 10,
					lengthMenu: [5, 10, 25, 50, 100],
					autoWidth:false,
					order: [2, "asc" ],
					//"columns": displayColumns,
					//"data": dataSet, // para que no salga popup advertencia
					//Set column definition initialisation properties.
					columnDefs: [{ 
								"targets": [ -1,0,1 ], //last column
								//"searchable": false,
								"orderable": false //set not orderable
							}]
				});	
				
				$('#userlista').DataTable({
					responsive: true,
					language: {
                		url: BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
            		},
					pageLength : 10,
					lengthMenu: [5, 10, 25, 50, 100],
					autoWidth:false,
					order: [2, "asc" ],
					//"columns": displayColumns,
					//"data": dataSet, // para que no salga popup advertencia
					//Set column definition initialisation properties.
					columnDefs: [{ 
								"targets": [ -1 ], //last column
								//"searchable": false,
								"orderable": false //set not orderable
							}]
				});	
				$('#fileslista').DataTable({
					responsive: true,
					language: {
                		url: BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
            		},
					pageLength : 10,
					lengthMenu: [5, 10, 25, 50, 100],
					autoWidth:false,
					order: [2, "asc" ],
					//"columns": displayColumns,
					//"data": dataSet, // para que no salga popup advertencia
					//Set column definition initialisation properties.
					columnDefs: [{ 
								"targets": [ -1 ], //last column
								//"searchable": false,
								"orderable": false //set not orderable
							}]
				});	


				$('#registrolista').DataTable({
					responsive: true,
					language: {
                		url: BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
            		},
					pageLength : 10,
					lengthMenu: [5, 10, 25, 50, 100],
					autoWidth:false,
					order: [0, "desc" ],
					//"columns": displayColumns,
					//"data": dataSet, // para que no salga popup advertencia
					//Set column definition initialisation properties.
					columnDefs: [{ 
								"targets": [ -1 ], //last column
								//"searchable": false,
								"orderable": false //set not orderable
							}]
				});	

				$('#asistencialista').DataTable({
					responsive: true,
					language: {
                		url: BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
            		},
					pageLength : 10, // cantidad de resgistros a mostrar por defecto
					lengthMenu: [5, 10, 25, 50, 100],
					autoWidth:false,
					//order: [3, "desc" ],
					//"columns": displayColumns,
					//"data": dataSet, // para que no salga popup advertencia
					//Set column definition initialisation properties.
					columnDefs: [{ 
								"targets": [ -1 ], //last column
								//"searchable": false,
								"orderable": false //set not orderable
							}]
				});	

				$('#asistenciahistorial').DataTable({
					responsive: true,
					language: {
                		url: BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
            		},
					pageLength : 10, // cantidad de resgistros a mostrar por defecto
					lengthMenu: [5, 10, 25, 50, 100],
					autoWidth:false,
					//order: [2, "asc" ],
					//order: [3, "desc" ],
					//"columns": displayColumns,
					//"data": dataSet, // para que no salga popup advertencia
					//Set column definition initialisation properties.
					columnDefs: [{ 
								"targets": [ -1 ], //last column
								//"searchable": false,
								"orderable": false //set not orderable
							}]
				});	
	
				}
			});			


			//Agregar usuario
			$(document).ready(function(){					
				 $(".btnAgregarCliente").click(function(){			 
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

				$('#txtNum_Documento').keypress(function (tecla){
					//this.value = (this.value + '').replace(/[^0-9]/g, '');
					if(tecla.charCode < 48 || tecla.charCode > 57) return false;
				});
			});

			//restringir el campo de texto que utilizamos para obtener el apellido del usuario, 
			//debemos permitir únicamente letras minúsuclas (códigos del 97 al 122), 
			//mayúsculas (códigos del 65 al 90) y quizás el guión (código 45)
			$(document).ready(function (){
				$('#txtLogin').keypress(function (tecla){		  
		   			if((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 45)) {
		   				$('#alerta').html('<div class="alert alert-danger" role="alert"><small>¡ Caracter no permitido !</small></div>');
            			setTimeout(xD.all.showTooltip,100);
            			return false;
		   			}
		   		
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

		//tooltip placement on right or left
	tooltip_placement: function(context, source){
		var $source = $(source);
		var $parent = $source.closest('table')
		var off1    = $parent.offset();
		var w1      = $parent.width();

		var off2 = $source.offset();
		//var w2 = $source.width();

		if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
		return 'left';
	},

  	notificaciones:function(){
  		   /*var currenturl =  window.location.pathname;			
		    var element = currenturl.split('/');
		    var url   = element[3];	//2:
		    var index = element[2]; //1:pagina principal

  		  	if(index !=="home"){
  		  		var tipouser=idtipo;
  			}*/
  			//var tipouser=idtipo;
  			var tipouser=0;

  			if(tipouser=='2'){
  				$('.aprobacion').hide();
  				$('.justificacion').show();
  			}
  			if(tipouser=='1' || tipouser=='3'){ 
  				$('.aprobacion').show();
  				$('.justificacion').hide();  		
  			}
  			if(tipouser=='4'){ 
  				$('.aprobacion').show();
  				$('.justificacion').show();  				
  			}
  			/*

			$.post(BASE_URL+"home/notificacionesJustificar", function(data){
					console.log(data);
					if(data.respuesta == "OK"){	   
						if(data.tipo=='2' || data.tipo=='4'){        
	                		$("#cantidadjustif").text(data.cantidad); 
	                		$(".cantidadjustif").text("Tienes "+data.cantidad+" notificaciones para justificar"); 
	                	}	              
	                }else{					
						$("#cantidadjustif").text(data.cantidad);	 
						$(".cantidadjustif").text("Tienes "+data.cantidad+" notificaciones para justificar");           						
					}			

			},"json");

			if(tipouser=='1'|| tipouser=='3' || tipouser=='4'){ 
				$.post(BASE_URL+"home/notificacionesAprobar", function(data){
						console.log(data);
						if(data.respuesta == "OK"){	   
						  	if(data.tipo=='1'|| data.tipo=='3' || data.tipo=='4'){ 
		                		$("#cantidad").text(data.cantidad); 
		                		$(".cantidad").text("Tienes "+data.cantidad+" notificaciones para aprobar");     
		                	}
		                }else{					
							$("#cantidad").text(data.cantidad);	 
							$(".cantidad").text("Tienes "+data.cantidad+" notificaciones para aprobar");           						
						}			

				},"json");
			}

			//alert(tipouser);	
			if(tipouser=='1' || tipouser=='3' || tipouser=='4'){ 	
			$.post(BASE_URL +"home/getNotificacionesListaAprobar",{ idcategoria: tipouser}, 						
					function(data){					
						$(".lista").html(data);					
			}); 
			}

			if(tipouser=='2' || tipouser=='4'){
			$.post(BASE_URL +"home/getNotificacionesListaJustificar",{ idcategoria: tipouser}, 						
					function(data){					
				$(".listajustif").html(data);	
					
			}); 
			}		*/
  	}, 	


	getErrorMessage: function(jqXHR, exception){
		var msg = '';
	    if (jqXHR.status === 0){
	        msg = 'Not connect.\n Verify Network.';
	    }else if (jqXHR.status == 404){
	        msg = 'Requested page not found. [404]';
	    }else if (jqXHR.status == 500) {
	        msg = 'Internal Server Error [500].';
	    }else if (exception === 'parsererror'){
	        msg = 'Requested JSON parse failed.';
	    }else if (exception === 'timeout'){
	        msg = 'Time out error.';
	    }else if (exception === 'abort'){
	        msg = 'Ajax request aborted.';
	    }else{
	        msg = 'Uncaught Error.\n' + jqXHR.responseText;
	    }
	    xD.all.alertaReload(msg,"error"); 
	},

	alertaReload:function(message,tipo){
		        if(tipo=='error'){
				    swal({
				      title: "Notificacion!",
					  text: message,
					  html: true,
					  type: "error",
					  confirmButtonColor: '#2ecc71',
					  showCancelButton: false
					   //type: "warning"
					  //imageUrl: 'thumbs-up.jpg'
					},function(){						
						document.location.reload(); //redirige a la pagina donde se quedo
					});	
				}
				if(tipo=='success'){
					swal({
					  title: 'Informacion!',
					  text: message,
					  html: true,
					  type: "success",
					  confirmButtonColor: '#2ecc71',
					  showCancelButton: false,
					},function(){
						//window.open(getLink,'_blank');
						document.location.reload(); //redirige a la pagina donde se quedo
					});
				}
				if(tipo=='warning'){
					swal({
					  title: 'Notificacion!',
					  text: message,
					  html: true,
					  type: "warning",
					  confirmButtonColor: '#2ecc71',
					  showCancelButton: false,
					},function(){
						//window.open(getLink,'_blank');
						document.location.reload(); //redirige a la pagina donde se quedo
					});
				}

				if(tipo=='info'){
						swal({
						title: "Procesando...",
						text: "Espere porfavor",
						imageUrl: BASE_URL+"assets/images/gif-load.gif",
						showConfirmButton: false,
						allowOutsideClick: false					
					});
				}

	},

	reload_table:function(){
      table.ajax.reload(null,false); //reload datatable ajax
    },

	limpiarForm:function(){	
		$("form")[0].reset();
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
	
	IsEmail:function(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
    },	

    validateEmail:function($email) {
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  return emailReg.test( $email );
	}, 

	limpiar_tilde: function(text){
      //var text = text.toLowerCase(); // a minusculas
      var text = text;
      text = text.replace(/[áàäâå]/, 'a');
      text = text.replace(/[éèëê]/, 'e');
      text = text.replace(/[íìïî]/, 'i');
      text = text.replace(/[óòöô]/, 'o');
      text = text.replace(/[úùüû]/, 'u');
      text = text.replace(/[ýÿ]/, 'y');
      text = text.replace(/[ñ]/, 'n');
      text = text.replace(/[ç]/, 'c');
      text = text.replace(/['"]/, '');
      text = text.replace(/[^a-zA-Z0-9-]/, ''); 
      text = text.replace(/\s+/, '-');
      text = text.replace(/' '/, '-');
      text = text.replace(/(_)$/, '');
      text = text.replace(/^(_)/, '');
      return text;
    },
	
	editEmpresa:function(){
			   $('.editar-config').click(function(event){		

					//var nodo     = $(this).attr("id");
					//var prod     = $(this).data("prod");
					//var idalert  = $(this).data("alerta");


					var dataString = $("#frmGlobal").serialize();

					alert("Hola");			
							
				
					$.ajax({	
						/*
						beforeSend: function(){
							$('#status').html("<div class='message'></div>");
							$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
						},

						*/	

						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "configuraciones/editar",					
						data: dataString,
						error: function (err) { console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
						success: function(response){
							console.log(response);											
							setTimeout( function() {  //redirige a la pagina padre
								//window.location = "index.php?index.php/user/get_users"; // redirige a la pagina USERS
								//window.location = "get_users"; 
								document.location.reload(); //redirige a la pagina donde se quedo
							//	$container.fadeIn(1000).html(response); //actualiza
							}, 500 );			
									
						}
					});
					//event.preventDefault();
					return false;  //stop the actual form post !important!

		
			    }); 
		},

		//DESACTIVAR/ACTIVAR estado de registros
		deactivate_activate: function(){
			$(".btn_delete").click(function () {				
					
	        		var id         = $(this).data('id');
	        		var status     = $(this).data('status');
	        		var modulo     = $(this).data('modulo');

	        		if(status==1){
	        			message="Estas seguro de Desactivar?";	        			
	        			//"No podras recuperar este registro!"
	        			messageconfirm="Se ha desactivado el registro";
	        			messageCancel="El registro sigue Activo!";
	        			confirmText="Si, desactivar!";
	        		}else{
	        			message="Estas seguro de Activar?";
	        			messageconfirm="Se ha activado el registro";
	        			messageCancel="El registro sigue Desactivado!";
	        			confirmText="Si, activar!";
	        		}
	        	    messageText="Seguir con el proceso!";  		
	        		swal({
						  title: message,
						  text: messageText,
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonClass: "btn-danger",
						  confirmButtonText: confirmText,
						  cancelButtonText: "No, cancelar!",
						  closeOnConfirm: false,
						  closeOnCancel: false
						}, function(isConfirm) {
						  if (isConfirm){
						    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
						    //setTimeout(function () {	
						            if(modulo=="usuario") tabla='usuarios';
						            if(modulo=="roles") tabla  ='usuarios_tipo';
						            if(modulo=="permisos") tabla  ='permisos';
						            if(modulo=="motivos") tabla='gl_justificante'; // es forekey
						            if(modulo=="proveedor") tabla='proveedores';
						            if(modulo=="empleado") tabla='empleados';
						            if(modulo=="descuento") tabla='descuentos';
						            if(modulo=="documento") tabla='documentos';						          
									if(modulo=="importacion") tabla='tbl_regasistencia';
									if(modulo=="menus") tabla='menus';	
									if(modulo=="tcontrato") tabla='contratos_tipo';								
						     
						            accion='configuraciones/activar_desactivar';
								
									$.post(BASE_URL+accion, { id: id, estado: status, tabla: tabla }, function (res) {	
										if(res.valid==true){				                    
					                    	xD.all.alertaReload(res.message,"success");	           	
					                	}else{   
					                		xD.all.alertaReload(res.message,"error");                 		  
										}
			    					}); 

	    					 //}, 2000);

						  } else {
						    //swal("Cancelado", "El registro sigue activo!", "error");
						    swal({
								  title: "Cancelado!",
								  text: messageCancel,
								   type: "error"
								  //imageUrl: 'thumbs-up.jpg'
								});
						  }
					});				
					
			});

		},	

		delete: function(){
			$(".btn_eliminar").click(function () {				
					
	        		var id         = $(this).data('id');
	        		var status     = $(this).data('status');
	        		var modulo     = $(this).data('modulo');
	        	
	        		if(status==1 || status==2 ){ //procesado
	        			message="Estas seguro de Eliminar?";	        			
	        			//"No podras recuperar este registro!"
	        			messageconfirm="Se ha eliminado el registro";
	        			messageCancel="El registro no se ha eliminado!";
	        			confirmText="Si, eliminar!";
	        		}   


	        		messageText="Seguir con el proceso!";
	        	        		
	        		swal({
						  title: message,
						  text: messageText,
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonClass: "btn-danger",
						  confirmButtonText: confirmText,
						  cancelButtonText: "No, cancelar!",
						  closeOnConfirm: false,
						  closeOnCancel: false
						}, function(isConfirm) {
						  if (isConfirm) {
						    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
						    //setTimeout(function () {	
						            if(modulo=="usuario") tabla='usuarios';
						            if(modulo=="roles") tabla='usuarios_tipo';
						            if(modulo=="proveedor") tabla='proveedores';
						            if(modulo=="empleado") tabla='empleados';
						            if(modulo=="descuento") tabla='descuentos';
						            if(modulo=="documento") tabla='documentos';						       
						            if(modulo=="archivo") tabla='archivos';
						            if(modulo=="unidad") tabla='unidades';
						            if(modulo=="cliente") tabla='clientes';
									if(modulo=="importacion") tabla='tbl_regasistencia';
									if(modulo=="menus") tabla='menus';								
									if(modulo=="banner") tabla='banners';
									if(modulo=="estado") tabla='gl_estado';
						     

						          
						            if(modulo=="archivo"){
  										accion='archivos/delete';
  									}else if(modulo=="estado"){
						                accion='estados/delete';	
						            }else if(modulo=="registro"){
						                accion='registros/delete';	
						            }else{ //importacion
						            	accion='registros/deletes';
						            }
									//$.post(BASE_URL+'usuarios/delete', { id: id, estado: status }, function () {
									$.post(BASE_URL+accion, { id: id, estado: status, tabla: tabla }, function (res) {		       
								    
										if(res.valid==true){				                    
					                    	xD.all.alertaReload(res.message,"success");	           	
					                	}else{   
					                		xD.all.alertaReload(res.message,"error");                 		  
					                	}
			    					}); 

	    					 //}, 2000);

						  }else{
						 		 xD.all.alertaReload(messageCancel,"error"); 						 
						  }
					});				
					
			});

		},	

		logout: function(){
			$(".btn_logout").click(function (){     	
	        		message="Realmente desea salir del sistema?";  		
	        	    messageText="Seguir con el proceso!";        	
	        		swal({
						  title: message,
						  //text: messageText,
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonClass: "btn-danger",
						  confirmButtonText: "Si, continuar",
						  cancelButtonText: "No, cancelar",
						  closeOnConfirm: false,
						  showLoaderOnConfirm: true, 
						  closeOnCancel: true
						}, function(isConfirm) {
							if (isConfirm){					     
					            accion='home/logout';
					            setTimeout(function(){ 								
									$.post(BASE_URL+accion, function (res) {
										document.location.reload(); 							
			    					}); 
		    					}, 2000);
						 	}
					});	
					return false;					
			});
		},	  		

		run:function(){
			xD.all.vars();	
			xD.all.fn0();			
			xD.all.editEmpresa();
			xD.all.deactivate_activate();
			xD.all.delete();
			xD.all.logout();
		}
	},

	login:{
		vars:function(){
			xD.login.l1=true;
		},

		fn0:function(){
			$(document).ready(function(){

				$('#ver-password').click(function(e){
					var cambio = document.getElementById("txtPassword");
					if(cambio.type == "password"){
						cambio.type = "text";
						$('.icons').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
					}else{
						cambio.type = "password";
						$('.icons').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
					}
				});

				$('#login-in').click(function(e){
					//e.preventDefault();					
					var remcondition = $('#remember').prop('checked');							
	                if (remcondition == true){
	                    var username = $('#txtEmail').val();
	                    var password = $('#txtPassword').val();	          
	                    // set cookies to expire in 14 days
	                    $.cookie('username', username, { expires: 14 });
	                    $.cookie('password', password, { expires: 14 });	           
	                    $.cookie('remember', true, { expires: 14 });
	                }else {
	                    // reset cookies
	                    $.cookie('username', null);
	                    $.cookie('password', null);
	                    $.cookie('remember', null);
	                }				
					
					if(xD.login.validaLogin()){	 
							str = $("#formLogin").serialize();	
							xD.login.confirm_login_in(str);						
					}

					e.preventDefault();
     			});			

				$("#txtPassword").keypress(function(e){
			       	if(e.which == 13) {
			       		var remcondition = $('#remember').prop('checked');
		                if (remcondition == true){
		                    var username = $('#txtEmail').val();
	                        var password = $('#txtPassword').val();		             
		                    // set cookies to expire in 14 days
		                    $.cookie('username', username, { expires: 14 });
		                    $.cookie('password', password, { expires: 14 });		                
		                    $.cookie('remember', true, { expires: 14 });
		                }else {
		                    // reset cookies
		                    $.cookie('username', null);
		                    $.cookie('password', null);
		                    $.cookie('remember', null);
		                }					
			          // Acciones a realizar, por ej: enviar formulario.
				        if(xD.login.validaLogin()){			
							str = $("#formLogin").serialize();	
							xD.login.confirm_login_in(str);						
						}
			       	}
			    });	
				
				//verificamos si existe cookie
				var remember = $.cookie('remember');
				if (remember == 'true') {
					var username = $.cookie('username');
					var password = $.cookie('password');
					// autofill the fields
					$('#txtEmail').attr("value", username);
					$('#txtPassword').attr("value", password);
					$("#remember").attr('checked', true);
				}			

	            $(document).on("input", "#txtEmail", function (){
	                var remember = $.cookie('remember');
	                if (remember == 'true'){
	                    var username = $.cookie('username');
	                    var uname    = $("#txtEmail").val();
	                    if (username == uname) {
	                        var password = $.cookie('password');	                   
	                        $('#txtPassword').val(password);	                   
	                    }
	                }
            	});
			
	        
			   	$(".forgot-password-link").click(function (){			
				   $("#login-box").each(function(){
				        displaying = $(this).css("display");
				        if(displaying == "block"){
				          $(this).fadeOut('slow',function(){
				           $(this).css("display","none");				           
				           $("#login-box").hide();
				           $("#forgot-box").show();		
				          });
				        }else{
				          $(this).fadeIn('slow',function(){
				            $(this).css("display","block");
				            $("#login-box").show();
				            $("#forgot-box").hide();	
				          });
				        }
				      });					
			   });	

			   	$(".back-to-login-link").click(function (){			
				   $("#forgot-box").each(function(){
				        displaying = $(this).css("display");
				        if(displaying == "block"){
				          $(this).fadeOut('slow',function(){
				           $(this).css("display","none");				           
				           $("#login-box").show();
				           $("#forgot-box").hide();		
				          });
				        }else{
				          $(this).fadeIn('slow',function(){
				            $(this).css("display","block");
				            $("#login-box").hide();
				            $("#forgot-box").show();	
				          });
				        }
				      });					
			   });
			   
			});	

			$(document).ready(function(){				
				$('#register').click(function(){	
					if(xD.login.validaRegister()){			
						str = $("#formRegister").serialize();	
						xD.login.confirm_user_register(str);				
					}			
				});
			});			
					
		},

		validaLogin:function(){		
			//var acepto = $('input:checkbox[name=acepto]:checked').length;							
			if( $("#txtEmail").val() == "" ){
				$("#txtEmail").focus();
				$('.viewport_progress').show();	
				$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese E-mail.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progress').hide();					
				}, 2000 );
				return false;
			}else if(!xD.all.validateEmail($("#txtEmail").val())){
				$("#txtEmail").focus();
				$('.viewport_progress').show();	
				$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese E-mail válido.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progress').hide();					
				}, 2000 );
				return false;
			}else if( $("#txtPassword").val() == "" ){
				$("#txtPassword").focus();
				$('.viewport_progress').show();	
				$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese Contraseña.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progress').hide();					
				}, 2000 );
				return false;
			}else{						
				return true
			}
		},
		confirm_login_in:function(str){
			$.ajax({
					beforeSend: function(){
						//$('.resultado').html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
						//$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Espere!</strong><small> Procesando datos de acceso...</small></div>');				
					},
					cache: false, // Indicamos que no se guarde en cache
					type: "POST", // Variables POST
					url : BASE_URL + "cuenta/verificarLogin",
					data: str, // paso de datos
					dataType: 'json',
					success: function(data){
						console.log();
						if(data.valid == true && data.cart > 0){
							$('.viewport_progress').show();	
							$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {  //redirige a la pagina padre
								window.location = BASE_URL + "shopping/checkout";
								//document.location.reload(); //redirige a la pagina donde se quedo
						    }, 1000 );
						}else if(data.valid == true && data.cart < 1){
							$('.viewport_progress').show();	
							$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function(){  //redirige a la pagina padre
								window.location = BASE_URL + "cuenta/mi-cuenta";
								//document.location.reload(); //redirige a la pagina donde se quedo
						    }, 1000);
						}else{
							$('.viewport_progress').show();	
							$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {				
								$('.viewport_progress').hide();					
							}, 2000);
						}	
					},
					error : function (xhr, textStatus, errorThrown) {
		                //other stuff
		            },
		            complete : function (){
		               // $.unblockUI();
		            }
			});	
		},
		
		forgot_password:function(){
			$('#forgot-in').click(function(){	
				if(xD.login.validaEmail()){							
						str = $("#formForgot").serialize();	
						xD.login.confirm_forgot_in(str);						
				}			
			});
		},

		confirm_forgot_in:function(str){
			$.ajax({
					beforeSend: function(){						
						//$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>Enviando</small></div>'); // Mostramos los valores devueltos por el php
					
					},
					cache: false, // Indicamos que no se guarde en cache
					type: "POST", // Variables POST
					url : BASE_URL + "cuenta/forgotPassword",
					data: str, // paso de datos
					dataType: 'json',
					success: function(data){
						console.log(data);
						
						if(data.valid == true){							
							$("#forgot-box").hide();
							$("#validate-box").show();
							$('.viewport_progress').show();
							$('.viewport_progress').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
					
							setTimeout( function() {  //redirige a la pagina padre
								$('.viewport_progress').hide();
							}, 2000 );
											
						}else if(data.valid == false){						
							$('.viewport_progress').show();
							$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {  //redirige a la pagina padre
								$('.viewport_progress').hide();
							}, 2000 );						
							
						}else{ //inactivo
							$('.viewport_progress').show();
						    $('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
						
							setTimeout( function() {  //redirige a la pagina padre
								$('.viewport_progress').hide();
							}, 2000 );	
													
						}
					},
					error : function (xhr, textStatus, errorThrown) {
		                //other stuff
		            },
		            complete : function (){
		               // $.unblockUI();
		            }
			});	
		},
		
		reset_password:function(){
			$('#reset-in').click(function(){	
					if(xD.login.validaReset()){					
							str = $("#formReset").serialize();	
							xD.login.confirm_reset_in(str);						
					}	
			
				});

		},
		validaReset:function(){		
					//$(".error").remove();
					//var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
					//var acepto = $('input:checkbox[name=acepto]:checked').length;							
					if( $("#txtCodigo").val() == "" ){
						$("#txtCodigo").focus();
						//$("#campError").show().append("<span class='error'>Porfavor, Ingrese su nombre.</span>");
						return false;
					}else if( $("#txtPassword1").val() == "" ){
						$("#txtPassword1").focus();
					//	$("#campError").show().append("<span class='error'>Porfavor, Ingrese un E-mail valido.</span>");
						return false;
					}else if( $("#txtPassword2").val() == "" ){
						$("#txtPassword2").focus();
					//	$("#campError").show().append("<span class='error'>Porfavor, Ingrese un E-mail valido.</span>");
						return false;
					}else{			
						return true
					}
		},

		confirm_reset_in:function(str){
			$.ajax({
					beforeSend: function(){						
						//$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>Enviando</small></div>'); // Mostramos los valores devueltos por el php
					
					},
					cache: false, // Indicamos que no se guarde en cache
					type: "POST", // Variables POST
					url : BASE_URL + "cuenta/resetPassword",
					data: str, // paso de datos
					dataType: 'json',
					success: function(data){
						console.log(data);
						
						if(data.valid == true){													
							//$("#validate-box").hide();
							//$("#login-box").show();
							$('.viewport_progress').show();							
							$('.viewport_progress').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {  //redirige a la pagina padre						
								$('.viewport_progress').hide();
								window.location = BASE_URL + "cuenta/login"; // redirige a la pagina Login								
							}, 3000 );
												
							
						}else if(data.valid == false){					

							$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
											
						}else{ //inactivo
							//$('.loader14').hide(); //muestro mediante clase
							//$('.loader14').show("fast",function() {						                //alert ('imagen mostrada!');
						       //	setTimeout( function() {  //redirige a la pagina padre
						    $('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
								//	$('.loader14').hide("fast");
							//	}, 2000 );
							//});	
									
						}
					},
					error : function (xhr, textStatus, errorThrown) {
		                //other stuff
		            },
		            complete : function (){
		               // $.unblockUI();
		            }
			});	
		},
		
		validaRegister:function(){	
			var chkterminos = $('#chk-terminos').prop('checked');

			if($("#formRegister #txtNombres").val() == "" ){
				$("#formRegister #txtNombres").focus();	
				$('.viewport_progresss').show();	
				$('.viewport_progresss').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese su nombre.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progresss').hide();					
				}, 2000 );
				return false;							
			}else if($("#formRegister #txtApellidos").val() == "" ){
				$("#formRegister #txtApellidos").focus();	
				$('.viewport_progresss').show();	
				$('.viewport_progresss').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese Apellidos.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progresss').hide();					
				}, 2000 );
				return false;							
			}else if($("#formRegister #txtEmail").val() == "" ){
				$("#formRegister #txtEmail").focus();	
				$('.viewport_progresss').show();	
				$('.viewport_progresss').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese E-mail.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progresss').hide();					
				}, 2000 );
				return false; //!validateEmail(emailaddress)	
			}else if(!xD.all.validateEmail($("#formRegister #txtEmail").val())){
				$("#formRegister #txtEmail").focus();	
				$('.viewport_progresss').show();	
				$('.viewport_progresss').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese E-mail válido.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progresss').hide();					
				}, 2000 );
				return false;							
			}else if($("#formRegister #txtPassword").val() == "" ){
				$("#formRegister #txtPassword").focus();
				$('.viewport_progresss').show();	
				$('.viewport_progresss').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese Contraseña.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progresss').hide();					
				}, 2000 );
				return false;										
	        }else if(chkterminos != true){
	        	$('.viewport_progresss').show();	
				$('.viewport_progresss').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Acepta los términos y condiciones.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progresss').hide();					
				}, 2000 );
				return false;
			}else{				
				return true
			}			
		},
		
		confirm_user_register:function(str){
			$.ajax({
					beforeSend: function(){
						//$('.resultado').html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
						//$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Espere!</strong><small> Procesando datos de acceso...</small></div>');				
					},
					cache: false, // Indicamos que no se guarde en cache
					type: "POST", // Variables POST
					url : BASE_URL + "cuenta/register",
					data: str, // paso de datos
					dataType: 'json',
					success: function(data){
						console.log();
						if(data.valid == true && data.cart > 0){
							$('.viewport_progresss').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {  //redirige a la pagina padre
								window.location = BASE_URL + "shopping/checkout";				
							}, 1000 );
						}else if(data.valid == true && data.cart < 1){
							$('.viewport_progresss').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {  //redirige a la pagina padre
								window.location = BASE_URL + "cuenta/mi-cuenta";					
							}, 1000 );
						}else if(data.valid == false){
							$('.viewport_progresss').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
						}
					},
					error : function (xhr, textStatus, errorThrown) {
		                //other stuff
		            },
		            complete : function (){
		               // $.unblockUI();
		            }
			});	
		},

		validaEmail:function(){		
			//$(".error").remove();
			//var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
			//var acepto = $('input:checkbox[name=acepto]:checked').length;							
			if( $("#txtEmail").val() == "" ){
				$("#txtEmail").focus();
				$('.viewport_progress').show();	
				$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese E-mail</small></div>'); // Mostramos los valores devueltos por el php
				
				setTimeout( function() {  //redirige a la pagina padre
					$('.viewport_progress').hide();
				}, 2000 );	
				return false;
			}else{
				return true
			}
		},
		
		run:function(){
			xD.login.vars();
			xD.login.fn0();
			xD.login.forgot_password();	
			xD.login.reset_password();	
		}
	},
	///////////////////// EMPLEADOS /////////////////////////
		
	usuarios:{
		vars:function(){
			xD.usuarios.l1=true;
		},
		
		fn0:function(){	
			var currenturl =  window.location.pathname;
			var element    = currenturl.split('/');
			var url2       = element[3];	//3:
		    var url1       = element[2];	//2:
		    var index      = element[1];    //1:pagina principal
			
		    $(document).ready(function(){
				$('body').on('click', '.defecto label', function(){
					var opcion  = $(this).attr('id');
					var array   = opcion.split("_");
					  parte1    = array[0]; //opcion
					  parte2    = array[1];
					// var data   = $("#formAddressProfile").serialize();
					$("#rdoOpcion_"+parte2).change(function (e){
						var val  =  $("#rdoOpcion_"+parte2).val();
						var id   =  $(this).data('id');
						var data = "id="+id+"&val="+val;
						//var data   = $("#formAddressProfile").serialize();
						xD.usuarios.register_address_default(data);
						//alert("id radio: "+parte2);
						//alert("id: "+id);
						e.preventDefault();
					});					
				});				
			
			});			
	
					
		},

		grabar: function(){
			//$("#form-usuario").on("submit", function(e){
			$('#form-usuariosss').click(function(){				
				accion = 'Usuarios/grabar';
	            data   = $("#form-usuario").serialize();	
			   				
	            $.ajax({
	            	beforeSend: function(){
	            		xD.all.alertaReload('Espere porfavor....',"info");	  
						//$('#mensaje').html('<img src="'+BASE_URL +'assets/images/loading.gif" alt="" /><small>Procesando...</small>');
					},	         
	                url: BASE_URL+accion,
	                data: data,
				    processData: false,
				    contentType: false,
				    type: 'POST',
					success: function(res){
						console.log(res);								 
					    if(res.valid==true){				                    
	                    	xD.all.alertaReload(res.message,"success");	           	
	                	}else if(res.valid=='error'){   
	                		xD.all.alertaReload(res.message,"error");                 		  
	                	}else if(res.valid=='existe'){   
	                		xD.all.alertaReload(res.message,"error");  
	                	}else{	
	                		xD.all.alertaReload(res.message,"error");     		 
	                	}								    
					},
					error:function(jqXHR, exception){
						xD.all.getErrorMessage(jqXHR, exception);
					}
				});
				e.preventDefault();				        
			});
		},

		
		update:function(){
			$("#btn-updateUser").click(function(e){	
				if(xD.usuarios.validarDatos()){
					str = $("#formProfile").serialize();	
					xD.usuarios.confirm_user_update(str);
				}       
			});	
		},
		
		validarDatos:function(){	
			if($("#txtNombres").val() == "" ){
				$("#txtNombres").focus();	
				$('.msg-response').show();	
				$('.msg-response').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese su nombre.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.msg-response').hide();					
				}, 2000 );
				return false;							
			}else if($("#txtEmail").val() == "" ){
				$("#txtEmail").focus();	
				$('.msg-response').show();	
				$('.msg-response').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese E-mail.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.msg-response').hide();					
				}, 2000 );
				return false;							
			}else if(xD.all.IsEmail($("#txtEmail").val())==false){
				$("#txtEmail").focus();	
				$('.msg-response').show();	
				$('.msg-response').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese E-mail valido.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.msg-response').hide();					
				}, 2000 );
				return false;
			}else{				
				return true
			}			
		},
		
		confirm_user_update:function(str){
			$.ajax({
					beforeSend: function(){
						//$('.resultado').html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
						//$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Espere!</strong><small> Procesando datos de acceso...</small></div>');				
					},
					cache: false, // Indicamos que no se guarde en cache
					type: "POST", // Variables POST
					url : BASE_URL + "cuenta/update",
					data: str, // paso de datos
					dataType: 'json',
					success: function(data){
						console.log();
						if(data.resultado == 'ok'){
								$('.msg-response').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
								setTimeout( function() {  //redirige a la pagina padre
									window.location = BASE_URL + "cuenta/mi-cuenta";				
							}, 1000 );
						}else if(data.resultado == 'error'){
							$('.msg-response').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
			
						}else{ //existe
							$('.msg-response').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
						}	
					},
					error : function (xhr, textStatus, errorThrown) {
		                //other stuff
		            },
		            complete : function (){
		               // $.unblockUI();
		            }
			});	
		},
				
		delete:function(){
				$('.btn_deleteuser').click(function(){
					var opcion = $(this).data("opcion");
			        var selected = ''; 		      
			        $('input[type=checkbox]').each(function(){
			            if (this.checked) {
			            //if($(this).is(':checked')) {
			                selected += $(this).val()+', ';
			            }
			        }); 

			        if(selected != ''){			      
							message="Estas seguro de Eliminar?";	        			
		        			//"No podras recuperar este registro!"
		        			messageconfirm="Se ha eliminado el registro";
		        			messageCancel="El registro no se ha eliminado!";
		        			confirmText="Si, eliminar!";

							messageText="Seguir con el proceso!";
	        	        		
		        		swal({
							  title: message,
							  text: messageText,
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-danger",
							  confirmButtonText: confirmText,
							  cancelButtonText: "No, cancelar!",
							  closeOnConfirm: false,
							  closeOnCancel: false
							}, function(isConfirm){
							  if (isConfirm){
							  	data = $("#form-users").serializeArray();
								xD.usuarios.confirm_user_delete(data);
							  }else{
							 		 xD.all.alertaReload(messageCancel,"error"); 						 
							  }
						});	

			        }else{			          
			            xD.all.alertaReload('Debes seleccionar al menos un registro.','error');
			        }

			        return false;
			    });
		},
		
		register_address:function(){			
			//$('.btn-regAddress').on({ click:function(){
			$('.btn-regAddress').click(function(){
				xD.usuarios.validarDatosAddress();
				//}
			});					
		},		
		
		validarDatosAddress:function(){		
			//$("#message-error").remove();
			$(".error").remove();
			//var iddpto = $('#cboDpto').val();	
			var selected_option = $("#cboDpto option:selected").val();			
			if(selected_option == "0"){
			//if($("#cboDpto").val() == "0"){
				$("#cboDpto").focus();
				$("#message-error").focus().after("<span class='error'>Seleccione Departamento</span>");
				return false;	
			}else if($("#txtDireccion").val() == ""){
				$("#txtDireccion").focus();
				$("#message-error").focus().after("<span class='error'>Porfavor, ingrese Direccion</span>");
				return false;						
			}else{
				str = $("#formAddress").serialize();
				xD.usuarios.confirm_address_register(str);
			}						
		},		
		confirm_address_register:function(str){			

					$.ajax({	
						beforeSend: function(){
							$('#message-error').html("<div class='message'></div>");
							$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				
						},				
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "cuenta/registerAddress",					
						data: str,
						error: function (err) { console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
						success: function(data){
							console.log(data);
							$('.message').hide(); // Ocultamos el mensaje anterior
							$('#message-error').html("<div class='respuesta'></div>");
							if (data.resultado == 'ok'){
								$('.respuesta').html(data.message); // Mostramos la respuesta devuelto por el php										
							}else{
								$('.respuesta').html(data.message); // Mostramos la respuesta devuelto por el php										
							}		
							setTimeout( function() {  //redirige a la pagina padre			
								document.location.reload(); //redirige a la pagina donde se quedo
							}, 2000 );
			
						}
					});

		},
		
		register_address_default:function(data){			

			$.ajax({	
				beforeSend: function(){
					$('#message-address').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
		
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "cuenta/registerAddressDefault",					
				data: data,
				error: function (err) { console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(data){
					console.log(data);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#message-address').html("<div class='respuesta'></div>");
					if (data.resultado == 'ok'){
						$('.respuesta').html(data.message); // Mostramos la respuesta devuelto por el php	
					}else{
						$('.respuesta').html(data.message); // Mostramos la respuesta devuelto por el php										
					}		
					setTimeout( function() {  //redirige a la pagina padre			
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000);
				}
			});

		},
			
	
	
		run:function(){
			xD.usuarios.vars();
			xD.usuarios.fn0();	
			xD.usuarios.update();
			xD.usuarios.register_address();
		}
	},	
	

	categorias:{
		vars:function(){
			xD.categorias.l1=true;
		},
		
		fn0:function(){	
				var currenturl =  window.location.pathname;			
				var element    = currenturl.split('/');
				var url2       = element[3];	//3:
				var url1       = element[2];	//2:
				var index      = element[1];    //1:pagina principal
			
			$(document).ready(function() {
			
				if(url1=="productos" && url2 === 'categorias'){	    	

				//initiate dataTables plugin			
				var myTable1 = 
					$('#categoryproducts').DataTable({
						"language": {
                		 "url": BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
						},
						"bAutoWidth": false,
						"aoColumns": [
						  { "bSortable": false },
						  null, null,null, null,
						  { "bSortable": false }
						],
						"aaSorting": [],				
						"bProcessing": true,
				        //"bServerSide": true,
				        //"sAjaxSource": "http://127.0.0.1/table.php",			
						//,
						//"sScrollY": "200px",
						//"bPaginate": false,
				
						//"sScrollX": "100%",
						//"sScrollXInner": "120%",
						//"bScrollCollapse": true,
						//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
						//you may want to wrap the table inside a "div.dataTables_borderWrap" element
				
						//"iDisplayLength": 50					
						select: {
							style: 'multi'
						}
				    });
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable1, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						"columns": ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Imprimir</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				});
				myTable1.buttons().container().appendTo( $('.tableCategoryTools-container') );
				
				///// style the message box  
				var defaultCopyAction = myTable1.button(1).action();
				myTable1.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});				
				
				var defaultColvisAction = myTable1.button(0).action();
				myTable1.button(0).action(function (e, dt, button, config) {					
					defaultColvisAction(e, dt, button, config);					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableCategoryTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);			
				
				
				myTable1.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable1.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable1.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable1.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );		
			
				///////////////////////////////////////////////////////////////////////////////////////
				////////// table checkboxes  ////
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#categoryproducts > thead > tr > th input[type=checkbox], #categoryproducts_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#categoryproducts').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#categoryproducts').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#categoryproducts .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
						
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: xD.all.tooltip_placement});
				
				/***************/
				$('.show-details-btn').on('click', function(e){
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
			}		
		
		    });				
	
			$(document).on('click','a[data-toggle=\'image\']',function(e){
				$('[data-toggle=popover]').each(function () {
					// hide any open popovers when the anywhere else in the body is clicked
					if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
						$(this).popover('hide');
					}
				});	
			});							
	
			$(document).ready(function(){		
				
				$("#cboCategoria").change(function () {
					$("#cboCategoria option:selected").each(function () {
						var idcategoria=$('#cboCategoria').val();					
						$.post(BASE_URL +"categorias/getCboSubcategorias",{ idcategoria: idcategoria}, 						
							function(data){
								$("#cboSubcategoria").html(data);
						}); 						
					});
			    });			
				
						
			});				
		},	
		
		delete:function(){
				$('.btn_deletecategory').click(function(){
					var opcion = $(this).data("opcion");
			        var selected = ''; 		      
			        $('input[type=checkbox]').each(function(){
			            if (this.checked) {
			            //if($(this).is(':checked')) {
			                selected += $(this).val()+', ';
			            }
			        }); 

			        if(selected != ''){			      
							message="Estas seguro de Eliminar?";	        			
		        			//"No podras recuperar este registro!"
		        			messageconfirm="Se ha eliminado el registro";
		        			messageCancel="El registro no se ha eliminado!";
		        			confirmText="Si, eliminar!";
							messageText="Seguir con el proceso!";
							
		        		swal({
							  title: message,
							  text: messageText,
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-danger",
							  confirmButtonText: confirmText,
							  cancelButtonText: "No, cancelar!",
							  closeOnConfirm: false,
							  closeOnCancel: false
							}, function(isConfirm){
							  if (isConfirm){
							  	data = $("#form-brands").serializeArray();
								xD.usuarios.confirm_categoria_delete(data);
							  }else{
							 		 xD.all.alertaReload(messageCancel,"error"); 						 
							  }
						});	

			        }else{			          
			            xD.all.alertaReload('Debes seleccionar al menos un registro.','error');
			        }

			        return false;
			    });
		},
		confirm_categoria_delete:function(data){		
			$.ajax({					
				beforeSend: function(){
					$('#message').html("<div class='respuesta'></div>");
					$('.respuesta').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},										
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "productos/deletes",					
				data: data,
				error: function (err) { console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(res){
					console.log(res);
					if(res.valid==true){				                    
							xD.all.alertaReload(res.message,"success");	           	
					}else if(res.valid=='false'){   
							xD.all.alertaReload(res.message,"error");                 		  
					}else{	
							xD.all.alertaReload(res.message,"error");     		 
					}	
	
				}
			});
		},			
		
		run:function(){
			xD.categorias.vars();
			xD.categorias.fn0();	
			xD.categorias.delete();		
		}
	},
	
	shopping:{
		vars:function(){
			xD.shopping.l1=true;
		},
		fn1:function(){
			$(document).ready(function(){
			 $('.btn-circle').on('click',function(){
			   $('.btn-circle.btn-warning').removeClass('btn-warning').addClass('btn-default');
			   $(this).addClass('btn-warning').removeClass('btn-default').blur();
			 });

			 $('.next-step, .prev-step').on('click', function (e){
			   var $activeTab = $('.tab-pane.active');

			   $('.btn-circle.btn-warning').removeClass('btn-warning').addClass('btn-default');

			   if ( $(e.target).hasClass('next-step') )
			   {
				  var nextTab = $activeTab.next('.tab-pane').attr('id');
				  $('[href="#'+ nextTab +'"]').addClass('btn-warning').removeClass('btn-default');
				  $('[href="#'+ nextTab +'"]').tab('show');
			   }
			   else
			   {
				  var prevTab = $activeTab.prev('.tab-pane').attr('id');
				  $('[href="#'+ prevTab +'"]').addClass('btn-warning').removeClass('btn-default');
				  $('[href="#'+ prevTab +'"]').tab('show');
			   }
			 });
			});		
		},
		
		delete:function(){
				$('.btn-sssave').click(function(){
					var opcion = $(this).data("opcion");
			        var selected = ''; 		      
			        $('input[type=checkbox]').each(function(){
			            if (this.checked) {
			            //if($(this).is(':checked')) {
			                selected += $(this).val()+', ';
			            }
			        }); 

			        if(selected != ''){			      
							message="Estas seguro de Eliminar?";	        			
		        			//"No podras recuperar este registro!"
		        			messageconfirm="Se ha eliminado el registro";
		        			messageCancel="El registro no se ha eliminado!";
		        			confirmText="Si, eliminar!";
							messageText="Seguir con el proceso!";
							
		        		swal({
							  title: message,
							  text: messageText,
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-danger",
							  confirmButtonText: confirmText,
							  cancelButtonText: "No, cancelar!",
							  closeOnConfirm: false,
							  closeOnCancel: false
							}, function(isConfirm){
							  if (isConfirm){
							  	data = $("#form-brands").serializeArray();
								xD.usuarios.confirm_categoria_delete(data);
							  }else{
							 		 xD.all.alertaReload(messageCancel,"error"); 						 
							  }
						});	

			        }else{			          
			            xD.all.alertaReload('Debes seleccionar al menos un registro.','error');
			        }

			        return false;
			    });
		},
		
		register:function(){
			$(document).ready(function(){
				$('#btn-saveorder').click(function(event){	
					//event.preventDefault();
						//alert("Entramos");	
						xD.shopping.validarDatosPedido();	
				
				});
			});
		},
		validarDatosPedido:function(){		
			$(".error").remove();			
			str = $("#form-shopping").serialize();
			if($("#form-shopping input[name='optPago']:radio").is(':checked')) {  
			 //$("#status").focus().after("<span class='error'>Porfavor, ingrese su Nombre</span>");	
				//alert("Bien!!!, la edad seleccionada es: " + $('input:radio[name=optPago]:checked').val());
				//$("#formulario").submit(); 
		        xD.shopping.confirm_shopping_register(str);						
			}else{  
				//alert("Seleccion Metodo de Pago!"); 
				$("#message-finalizar").html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Seleccione Metodo de Pago.</div>');
				//$("#message-finalizar").html('<div class="alert alert-error alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error! </strong><small>Seleccion Metodo de Pago</small></div>');
                     			
				//$("#message-finalizar").focus().after("<span class='error'>Seleccion Metodo de Pago</span>");
				return false;						
				 //$("#status").focus().after("<span class='error'>Porfavor, ingrese su Nombre</span>");	
			} 
					
				
		},
		confirm_shopping_register:function(str){
				$.ajax({
						beforeSend: function(){
							//$('.resultado').html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
							//$('.resultado').html('<small>Procesando Datos. . . .</small>');		
							$('#status').html("<div class='message'></div>");
							$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
						
						},
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST
						url : BASE_URL + "shopping/registerShopping",
						data: str, // paso de datos
						dataType: 'json',
						success: function(response){
								console.log(response);
							$('.message').hide(); // Ocultamos el mensaje anterior
							$('#status').html("<div class='respuestas'></div>");
							if(response.success == 0) {								
								$('.respuestas').html("<span class='message-error'>"+response.respuesta+"</span>"); // Mostramos la respuesta devuelto por el php	
							}else if(response.success == 1){	
								$('.respuestas').html("<span class='message-ok'>"+response.respuesta+"</span>"); // Mostramos la respuesta devuelto por el php	
											 
								setTimeout( function(){  //redirige a la pagina padre
									//window.location = BASE_URL + "shopping"; // redirige a la pagina USERS
									
									if(response.paymentype=='MP'){
										window.location = BASE_URL + "shopping/payment";
									}else{
										window.location = BASE_URL + "shopping/checkout-success";
									}
									//window.location = "get_users"; 
									//window.location = BASE_URL;
									//document.location.reload(); //redirige a la pagina donde se quedo

								}, 1000 );
							}else{
								$('.respuestas').html("<span class='message-error'>"+response.respuesta+"</span>"); // Mostramos la respuesta devuelto por el php	
							
							}

						}	
				});
		},			
		
		
		run:function(){
			xD.shopping.vars();
			xD.shopping.fn1();
			xD.shopping.register();
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
		
		},
		run:function(){
			xD.index.vars();
			xD.index.fn1();
		}
	}


};

//ejecutamos todas las funciones
$(function(){
	var currenturl =  window.location.pathname;			
	var element    = currenturl.split('/');
	var url1       = element[2]; //2:
	var index      = element[1]; //1:pagina principal
	//alert(element[3]); 
	//if(index =="cuenta"){
		/*
	if(url1 =="login" || url1 =="recover"){
	//if(typeof index === 'undefined'){
		xD.login.run();		
  	}else{
  		xD.all.run();
		//xD.index.run();
		xD.usuarios.run();	
		xD.productos.run();	
		xD.shopping.run();
		
  	}
	*/
		xD.login.run();	
		xD.all.run();
		//xD.index.run();
		xD.usuarios.run();	
		xD.shopping.run();
	
	
});

/*************************JQUERY*******************************************/