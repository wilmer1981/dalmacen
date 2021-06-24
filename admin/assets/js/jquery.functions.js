var xD={
	all:{
		vars:function(){
			xD.l1=['index','estados','departamentos','cargos','reportes','productos','registros','archivos','contratos','empleados','usuarios','login','banners','marcas','menus','pedidos'];
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
			var url2       = element[5];	//3:
		    var url        = element[4];	//2:
		    var index      = element[3];    //1:pagina principal
			//alert(element[3]); 
		    //alert("url:"+url);	
		   
			///////////------ SELECT DEPENDIENTE----///////// 
				
			$(document).ready(function () {
				
				
				
			var dateNow = new Date(); 
				
			//alert("Index:"+index);
		    
            if(index =="registros"  && index =="usuarios" && index =="perfil" && index =="archivos" && 
               index =="roles" && index =="permisos" && index !=="motivos" && index =="configuraciones" && 
               index =="departamentos" && index =="cargos" && index =="contratos" && index =="estados" &&
			   url =="tipo"){ //   
			   
		       //$('[data-toggle="tooltip"]').tooltip();

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
					$("#cboDpto option:selected").each(function () {
						var iddpto=$('#cboDpto').val();					
						$.post(BASE_URL +"Clientes/getProvincias",{ iddpto: iddpto}, 						
							function(data){
								$("#cboProv").html(data);
						}); 						
					});
			   });

			   $("#cboProv").change(function (){
					$("#cboProv option:selected").each(function () {
						var idprov=$('#cboProv').val();					
						$.post(BASE_URL +"Directorios/getDistritos",{idprov: idprov}, 	
							function(data){
								$("#cboDist").html(data);
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
			}

			
			//var row    =  $('.date').attr('id'); 
			//alert(row);
			$('#fech_ini').datetimepicker({
				 format: 'DD-MM-YYYY',
				 defaultDate:dateNow	
				 //defaultDate:'07-01-2019'
				 //defaultDate:fechaIni										 
				 //defaultDate:''
				//format: 'HH:mm:ss'
			});	
			$('#fech_fin').datetimepicker({
				 format: 'DD-MM-YYYY',
				 defaultDate:dateNow	
				 //defaultDate:'07-01-2019'
				 //defaultDate:fechaIni										 
				 //defaultDate:''
				//format: 'HH:mm:ss'
			});	



				/*
			
				$('#fecha_creacion').datetimepicker({
                     format: 'DD-MM-YYYY',
                     defaultDate:dateNow								 
					 //defaultDate:''
					//format: 'HH:mm:ss'
                }); 


                $('#datetimepicker').datetimepicker({
                    format: 'DD/MM/YYYY',
                    //language: 'pt-BR'
                    defaultDate: dateNow
                });  
                 $('#datetimepicker1').datetimepicker({
                    format: 'DD/MM/YYYY',
                    //language: 'pt-BR'
                    defaultDate: dateNow
                }); */
                         

            
            });
		   
			$(document).ready(function(){
				
			 if(url =="registros"  && url =="configuraciones" && url =="productos" && 
			 url =="tipos"){
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
	
	IsEmail:function(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
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
  		
  		

			$.post(BASE_URL+"pedidos/notificacionesPedido", function(data){
					console.log(data);
					if(data.respuesta == "OK"){       
	                	$("#cantpedido").text(data.cantidad); 
	                	$(".cantpedido").text( data.cantidad +" pedidos"); 
						$(".cantpedidomenu").text(data.cantidad); 						
	                }else{					
						$("#cantpedido").text(data.cantidad); 
	                	$(".cantpedido").text( data.cantidad +" pedidos");           						
					}			

			},"json");
			/*

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

*/
			//alert(tipouser);	
			
			$.post(BASE_URL +"pedidos/notificacionesPedidoLista", function(data){	
				console.log(data);
				
				$(".lista").html(data);					
			}); 
		
		/*
			if(tipouser=='2' || tipouser=='4'){
				$.post(BASE_URL +"home/getNotificacionesListaJustificar",{ idcategoria: tipouser}, 						
						function(data){					
					$(".listajustif").html(data);	
						
				}); 
			}	*/	
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

					//alert("Hola");			
							
				
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
				$('#login-in').click(function(){
					var remcondition = $('#remember').prop('checked');							
	                if (remcondition == true){
	                    var username = $('#username').val();
	                    var password = $('#password').val();	          
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
				});

				$("#password").keypress(function(e){
			       	if(e.which == 13) {
						var remcondition = $('#remember').prop('checked');
		                if (remcondition == true){
		                    var username = $('#username').val();
		                    var password = $('#password').val();		             
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
					$('#username').attr("value", username);
					$('#password').attr("value", password);
					$("#remember").attr('checked', true);
				}			

	            $(document).on("input", "#username", function (){
	                var remember = $.cookie('remember');
	                if (remember == 'true'){
	                    var username = $.cookie('username');
	                    var uname    = $("#username").val();
	                    if (username == uname) {
	                        var password = $.cookie('password');	                   
	                        $('#password').val(password);	                   
	                    }
	                }
            	});
				
				
				

			});			
					
		},
		validaLogin:function(){		
			//var acepto = $('input:checkbox[name=acepto]:checked').length;							
			if( $("#username").val() == "" ){
				$("#username").focus();
				return false;
			}else if( $("#password").val() == "" ){
				$("#password").focus();
				return false;
			}else{
				return true
			}
		},
		confirm_login_in:function(str){
			$.ajax({
					beforeSend: function(){
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
								
							//window.location = BASE_URL;
							
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
					},
					error : function (xhr, textStatus, errorThrown) {
		                //other stuff
		            },
		            complete : function (){
		               // $.unblockUI();
		               //window.location = BASE_URL;
		            }
			});	
		},
		
		forgot_password:function(){
			$('#forgot-in').click(function(){	
				if(xD.login.validaEmail()){		
				//if(xD.login.validaUserName()){	
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
					url : BASE_URL + "home/forgotPassword",
					data: str, // paso de datos
					dataType: 'json',
					success: function(data){
						console.log();
						
						if(data.valid == true){							
							//$("#forgot-box").hide();
							//$("#reset-box").show();
							//$('#forgot-box').css("visibility","hidden");
							//$('#reset-box').css("visibility","visible");
																	
							$('.viewport_progres_forgot').show();
							$('.viewport_progres_forgot').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
					
							//$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {  //redirige a la pagina padre
							
								$('.widget-box.visible').removeClass('visible');//hide others
								$('#reset-box').addClass('visible');			//show target								
								$('.viewport_progres_forgot').hide();
							}, 2000 );							
							
						}else if(data.valid == false){						
							$('.viewport_progres_forgot').show();
							$('.viewport_progres_forgot').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {  //redirige a la pagina padre
								//window.location = "index.php?index.php/user/get_users"; // redirige a la pagina USERS
								$('.viewport_progres_forgot').hide();
								//document.location.reload(); //redirige a la pagina donde se quedo
							}, 2000 );				
						}else{ //inactivo
							$('.viewport_progres_forgot').show();
						    $('.viewport_progres_forgot').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {  //redirige a la pagina padre
								//window.location = "index.php?index.php/user/get_users"; // redirige a la pagina USERS
								$('.viewport_progres_forgot').hide();
								//document.location.reload(); //redirige a la pagina donde se quedo
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
					if( $("#verifycode").val() == "" ){
						$("#verifycode").focus();
						$('.viewport_progres_reset').show();	
						$('.viewport_progres_reset').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese Codigo</small></div>'); // Mostramos los valores devueltos por el php
						setTimeout( function() {				
								$('.viewport_progres_reset').hide();					
						}, 2000 );
						return false;
					}else if( $("#password1").val() == "" ){
						$("#password1").focus();
						$('.viewport_progres_reset').show();	
						$('.viewport_progres_reset').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese nueva contraseña.</small></div>'); // Mostramos los valores devueltos por el php
						setTimeout( function() {				
								$('.viewport_progres_reset').hide();					
						}, 2000 );
						return false;
					}else if( $("#password2").val() == "" ){
						$("#password2").focus();
						$('.viewport_progres_reset').show();	
						$('.viewport_progres_reset').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Repite contraseña.</small></div>'); // Mostramos los valores devueltos por el php
						setTimeout( function() {				
								$('.viewport_progres_reset').hide();					
						}, 2000 );						
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
					url : BASE_URL + "home/resetPassword",
					data: str, // paso de datos
					dataType: 'json',
					success: function(data){
						console.log();
						
						if(data.valid == true){													
							//$("#validate-box").hide();
							//$("#login-box").show();						
							$('.viewport_progres_reset').show();							
							$('.viewport_progres_reset').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							//$('.viewport_progress').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Importante!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
							setTimeout( function() {  //redirige a la pagina padre
							
								$('.viewport_progres_reset').hide();								
								$('.widget-box.visible').removeClass('visible');//hide others
								$('#login-box').addClass('visible');//show target
							}, 3000 );
							
							
						}else if(data.valid == false){						

							$('.viewport_progres_reset').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
											
						}else{ //inactivo
							//$('.loader14').hide(); //muestro mediante clase
							//$('.loader14').show("fast",function() {						                //alert ('imagen mostrada!');
						       //	setTimeout( function() {  //redirige a la pagina padre
						    $('.viewport_progres_reset').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small>'+ data.message +'</small></div>'); // Mostramos los valores devueltos por el php
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
		
		validaEmail:function(){				
			if( $("#email").val() == "" ){
				$("#email").focus();	
				$('.viewport_progress').show();	
				$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese E-mail</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
						$('.viewport_progress').hide();					
				}, 2000 );
				return false;							
			}else if(xD.all.IsEmail($("#email").val())==false){
				$("#email").focus();	
				$('.viewport_progress').show();	
				$('.viewport_progress').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error!</strong><small> Ingrese E-mail valido.</small></div>'); // Mostramos los valores devueltos por el php
				setTimeout( function() {				
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

	registros:{

		vars:function(){
			xD.registros.l1=true;
		},
		
		fn0:function(){	

			$(document).ready(function(){ 
				$("#frmFile").on("submit", function(e){
						var radio=$('input:radio[name=rdoTipoCarga]:checked').val();
						//alert(radio);
						if(radio==1){
							accion = 'Registros/importRegistroCabExcel';
						}else{
							accion = 'Registros/importRegistroDetExcel';							
						}

			            var data;
					    data = new FormData(document.getElementById("frmFile"));					
			            $.ajax({
			            	beforeSend: function(){
			            		xD.all.alertaReload('Procesando...',"info");	  
								//$('#mensaje').html('<img src="'+BASE_URL +'assets/images/loading.gif" alt="" /><small>Procesando...</small>');
							},
			                //url: BASE_URL+'productos/importarUpdateExcel',
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

				/*
				$('#txtCodigo').blur(function(){					

					        if($('#txtCodigo').val()!= ""){

					        	

					        var codigo = $(this).val();        
					        var dataString = 'txtcodigo='+codigo;

					        $.ajax({
					        	 beforeSend: function(){
									//$('#campErrorC').show().html('<img id="loader" src="images/ajax-loader.gif"/><small>Procesando Datos. . . .</small>');
								 	$('#resultado').html('<img src="'+BASE_URL +'"assets/images/loading.gif"" alt="" />').fadeOut(1000);

								},
				                cache: false, // Indicamos que no se guarde en cache
					            type: "POST",
					             url: BASE_URL + "Productos/comprobarExistencia",
					            data: dataString,
					            success: function(data) {
					            	//$('#resultado').fadeIn(1000).html(data);
					            	if(data == 'true')
					                	$('#resultado').fadeIn(1000).html("<div id='Error'><strong></strong> Codigo Existente</div>");
					               		//$('#resultado').fadeIn(1000).html("<div class='label label-danger'><strong></strong> Codigo Existente</div>");
					               
					                 else
					                 	$('#resultado').fadeIn(1000).html("<div id='Success'><strong></strong>Codigo Disponible</div>");
					            	   //$('#resultado').fadeIn(1000).html("<div class='label label-success'><strong></strong>Codigo Disponible</div>");
					
					            }
					        });

					          } 

					    }); */
                          
			});


			$(document).ready(function() {
				/*

				//Buscamos Producto para agregar al pedido
				$("#BuscaProducto").autocomplete({	
				            source: BASE_URL + "Pedidos/autoCompleteProducto",
				             select: function(event, ui) {  
							    $('#idproducto').val(ui.item.id);	
								$('#descripcion').val(ui.item.nombre);
								$('#codigoproducto').val(ui.item.codigoproducto);	
								$('#stockactual').val(ui.item.stock);							
								$('#txtCantidad').val(1);
								$('#txtPrecioCompra').val(ui.item.precio_compra);
								$('#txtPrecioVenta').val(ui.item.precio_venta);
								$('#txtDscto').val(0);
								//$("#Proveedor").val(ui.item.nombre_proveedor);
								//$("#idProveedor").val(ui.item.id);

				           }  
				});
				*/

				 $('#see').click(function(){
			        var element = $("#fecha").text().split(' ');
			        var fecha = element[0].split('-');
			        alert('Fecha formateada: '+fecha[2]+'/'+fecha[1]+'/'+fecha[0]);
			        var tiempo = element[1].split(':');
			        alert('Tiempo formateado: '+tiempo[0]+'h '+tiempo[1]+'min '+tiempo[2]+' seg');
			        return false;
			    });


			
		    });			
					
		},

		//registrar fustficacion
		registrarJustificacion:function(){

			//Guardar Estado de Justificacion
			var opcion = "registrar";

			$(document).ready(function(){
				$(".cboEstadoJusti").change(function(){
					var Justi = $(this).attr('id');					
					var idJusti = Justi.split('-'); 
					var idusu    = idJusti[1];
					var idreg    = idJusti[2];
					var numfec   = idJusti[3];
					//alert("id:"+idJusti[3]);

					var valor    = $("#txtJusti-"+idusu+"-"+idreg+"-"+numfec).val();
					//alert("id:"+valor);

					$("#"+Justi+" option:selected").each(function (){							
							var idEstado=$('#'+Justi).val();
							//alert("Opcion:"+idEstado);
							swal({
							  title: "Estas seguro de Cambiar de estado?",
							  text: "Click en CONTINUAR para grabar cambio!",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "Continuar",
							  cancelButtonText: "Cancelar",
							  closeOnConfirm: false,
							  showLoaderOnConfirm: true
							},
							function(){
								setTimeout(function (){						
									xD.registros.updateJustificacion(idusu,idreg,numfec,idEstado,valor,opcion);	

		    					 }, 2000);

							});
							return false;									
					});
				});


				$(".txtJusti").keypress(function(e) {
					var txtJusti = $(this).attr('id');
					var txtJust  = txtJusti.split('-'); 
					var idusu    = txtJust[1];
					var idreg    = txtJust[2];
					var numfec   = txtJust[3];

					var valor    = $("#txtJusti-"+idusu+"-"+idreg+"-"+numfec).val();
					var idEstado   = $("#cboEstadoJusti-"+idusu+"-"+idreg+"-"+numfec+" option:selected").val();

					//alert(idJusti);				
			       	if(e.which == 13) {
			          // Acciones a realizar, por ej: enviar formulario.
			          	//alert("id:"+txtJust[3]);
			          	//alert("id:"+valor);
			          	swal({
							  title: "Estas seguro de Guardar los cambios?",
							  text: "Click en CONTINUAR para grabar cambio!",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "Continuar",
							  cancelButtonText: "Cancelar",
							  closeOnConfirm: false,
							  showLoaderOnConfirm: true
							},
							function(){
								setTimeout(function (){						
									xD.registros.updateJustificacion(idusu,idreg,numfec,idEstado,valor,opcion);	

		    					 }, 2000);
						});

						return false;				    
			       	}
			    });


				//justificar FALTA
				$(".txtJustificaFalta").keypress(function(e) {					
					
					var cadena   = $("#txtRegistros").val();
				    separador    = "-";
				    cadenas      = cadena.split(separador);
				    var idusu    = cadenas[0];				    
					var idsup    = cadenas[1];
					var idreg    = cadenas[2];
					var accio    = cadenas[3];
					var opcio    = cadenas[4];
					//alert(reg);				
					var valor  = $("#txtJusti").val();

				 	var data;
					data = new FormData(document.getElementById("frmJustificacion"));			          		
					
						
			       	if(e.which == 13) {
			          // Acciones a realizar, por ej: enviar formulario.
			          	//alert(dataString);
			          	swal({
							  title: "Estas seguro de Guardar los cambios?",
							  text: "Click en CONTINUAR para grabar cambio!",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "Continuar",
							  cancelButtonText: "Cancelar",
							  closeOnConfirm: false,
							  showLoaderOnConfirm: true
							},
							function(){
								setTimeout(function (){						
									//xD.registros.updateJustificacionFalta(idusu,idreg,idsup,'0','0',valor, accio,opcio);	
									xD.registros.registrarJustificacionFaltaAdjunto(data);	

		    					}, 2000);
						});

						return false;				    
			       	}
			    });

				$(".txtJustiFalta").keypress(function(e){				
					var idusu  = $(this).data("id");
					var idreg  = $(this).data("reg");
					var idsup  = $(this).data("idsup");
					var accio  = $(this).data("act");
					var opcio  = $(this).data("opc");
					var valor  = $("#txtJusti").val();

					var dataString = "idusu="+idusu+"&idreg="+idreg+"&justi="+valor+"&act="+accio+"&opc="+opcio;					
						
			       	if(e.which == 13) {
			          // Acciones a realizar, por ej: enviar formulario.
			          	//alert(dataString);
			          	swal({
							  title: "Estas seguro de Guardar los cambios?",
							  text: "Click en CONTINUAR para grabar cambio!",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "Continuar",
							  cancelButtonText: "Cancelar",
							  closeOnConfirm: false,
							  showLoaderOnConfirm: true
							},
							function(){
								setTimeout(function (){						
									xD.registros.updateJustificacionFalta(idusu,idreg,idsup,'0','0',valor, accio,opcio);	

		    					 }, 2000);
						});

						return false;				    
			       	}
			    });


			});
		},

		aprobarJustificacion:function(){
			//Guardar aprobacion de Justificacion
			var opcion = "aprobar";
			$(document).ready(function(){
				$(".cboEstadoAprobacion").change(function(){
					var Justi    = $(this).attr('id');					
					var idJusti  = Justi.split('-'); 
					var idusu    = idJusti[1];
					var idreg    = idJusti[2];
					var numfec   = idJusti[3];

					alert("id:"+idJusti[3]);

					var valor    = $("#txtObs-"+idusu+"-"+idreg+"-"+numfec).val();
					//alert("id:"+valor);

					$("#"+Justi+" option:selected").each(function (){							
							var idEstado=$('#'+Justi).val();
							alert("Opcion:"+idEstado);
							swal({
							  title: "Estas seguro de Cambiar de estado?",
							  text: "Click en CONTINUAR para grabar cambio!",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "Continuar",
							  cancelButtonText: "Cancelar",
							  closeOnConfirm: false,
							  showLoaderOnConfirm: true
							},
							function(){
								setTimeout(function (){						
									xD.registros.updateJustificacion(idusu,idreg,numfec,idEstado,valor,opcion);	
		    					 }, 2000);
							});
							return false;									
					});
				});


				$(".txtObs").keypress(function(e){
					var txtObser = $(this).attr('id');
					var txtJust  = txtObser.split('-'); 
					var idusu    = txtJust[1];
					var idreg    = txtJust[2];
					var numfec   = txtJust[3];

					var valor      = $("#txtObs-"+idusu+"-"+idreg+"-"+numfec).val();
					var idEstado   = $("#cboEstadoAprobacion-"+idusu+"-"+idreg+"-"+numfec+" option:selected").val();

					//alert(idJusti);				
			       	if(e.which == 13) {
			          // Acciones a realizar, por ej: enviar formulario.
			          	//alert("id:"+txtJust[3]);
			          	//alert("id:"+valor);
			          	swal({
							  title: "Estas seguro de Guardar los cambios?",
							  text: "Click en CONTINUAR para grabar cambio!",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "Continuar",
							  cancelButtonText: "Cancelar",
							  closeOnConfirm: false,
							  showLoaderOnConfirm: true
							},
							function(){
								setTimeout(function (){						
									xD.registros.updateJustificacion(idusu,idreg,numfec,idEstado,valor,opcion);	
		    					 }, 2000);
						});
						return false;				    
			       	}
			    });

				///////////////////////  aprobar falta  ///////////////////////////////////
				$(".txtObserva").keypress(function(e){
					var txtObser = $(this).attr('id');
					var txtJust  = txtObser.split('-'); 
					var idusu    = txtJust[1];
					var idreg    = txtJust[2];	

					var numfec    = '0';
					var idsup     = '0';
					var valor     = $("#txtObserva-"+idusu+"-"+idreg).val();
					var idEstado  = $("#cboAprobacion-"+idusu+"-"+idreg+" option:selected").val();


					var accion  = $(this).data("act"); //acccion
					var opcion  = $(this).data("opc"); //opcion
				

					//var dataString = "idusu="+idusu+"&idreg="+idreg+"&act="+accio+"&opc="+opcio;

					//alert(idJusti);				
			       	if(e.which == 13) {
			          // Acciones a realizar, por ej: enviar formulario.
			          	//alert("id:"+txtJust[3]);
			          	//alert("id:"+valor);
			          	swal({
							  title: "Estas seguro de Guardar los cambios?",
							  text: "Click en CONTINUAR para grabar cambio!",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "Continuar",
							  cancelButtonText: "Cancelar",
							  closeOnConfirm: false,
							  showLoaderOnConfirm: true
							},
							function(){
								setTimeout(function (){						
									xD.registros.updateJustificacionFalta(idusu,idreg,idsup,numfec,idEstado,valor,accion,opcion);	
		    					 }, 2000);
						});
						return false;				    
			       	}
			    });

			    $(".cboAprobacion").change(function(){
					var Justi    = $(this).attr('id');					
					var idJusti  = Justi.split('-'); 
					var idusu    = idJusti[1];
					var idreg    = idJusti[2];
					var numfec   = '0';
					var idsup    = '0';

					var valor    = $("#txtObserva-"+idusu+"-"+idreg).val();

					var accion  = $(this).data("act"); //acccion
					var opcion  = $(this).data("opc"); //opcion

					$("#"+Justi+" option:selected").each(function (){							
							var idEstado=$('#'+Justi).val();
							//alert("Opcion:"+idEstado);
							swal({
							  title: "Estas seguro de Cambiar de estado?",
							  text: "Click en CONTINUAR para grabar cambio!",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "Continuar",
							  cancelButtonText: "Cancelar",
							  closeOnConfirm: false,
							  showLoaderOnConfirm: true
							},
							function(){
								setTimeout(function (){						
									xD.registros.updateJustificacionFalta(idusu,idreg,idsup,numfec,idEstado,valor,accion,opcion);	
		    					 }, 2000);
							});
							return false;									
					});
				});


			});
		},


		updateJustificacion:function(idusu,idreg,numfec,idEstado,valor,opcion){

			if(opcion == "registrar"){ accion='asistencias/registrarJustificacion';}
			if(opcion == "aprobar"){ accion='asistencias/aprobarJustificacion';}

			$.post(BASE_URL+accion, { idusu: idusu, idreg: idreg, numfec: numfec, cboEstado: idEstado, valor: valor }, function (result){
					//console.log(result);
					//if(result.valid==true){
	                if(result.valid==1){	           
	                   setTimeout(function (){						
							xD.all.alertaReload(result.message,"success");	
					 	}, 2000);		                       	 
			   		}else{					
						setTimeout(function (){	
							xD.all.alertaReload(result.message,"error");
						}, 2000);
					}
			});
		},

		updateJustificacionFalta:function(idusu,idreg,idsup,numfec,idEstado,valor,accion,opcion){

			if(opcion == "justifica"){ action='asistencias/registrarJustificacionFalta';}
			if(opcion == "aprobar"){ action='asistencias/aprobarJustificacionFalta';}
			if(opcion == "observar"){ action='asistencias/aprobarJustificacionFalta';}

			$.post(BASE_URL+action, { idusu: idusu, idreg: idreg, idsup: idsup,  numfec: numfec,  idestado: idEstado, valor: valor, accion: accion, opcion: opcion }, function (result){
					//console.log(result);
					//if(result.valid==true){
	                if(result.valid==1){	           
	                   setTimeout(function (){						
							xD.all.alertaReload(result.message,"success");	
					 	}, 2000);		                       	 
			   		}else{					
						setTimeout(function (){	
							xD.all.alertaReload(result.message,"error");
						}, 2000);
					}
			});
		},

		registrarJustificacionFaltaAdjunto:function(data){
			action='asistencias/registrarJustificacionFaltaAdjunto';
            $.ajax({
            	/*
            	beforeSend: function(){
            		xD.all.alertaReload('Procesando...',"info");	  
					//$('#mensaje').html('<img src="'+BASE_URL +'assets/images/loading.gif" alt="" /><small>Procesando...</small>');
				},	*/		         
                url: BASE_URL+action,
                data: data,
			    processData: false,
			    contentType: false,
			    type: 'POST',
				success: function(result){
					console.log(res);								 
				    if(result.valid==true){	           
	                   setTimeout(function (){						
							xD.all.alertaReload(result.message,"success");	
					 	}, 2000);		                       	 
			   		}else{					
						setTimeout(function (){	
							xD.all.alertaReload(result.message,"error");
						}, 2000);
					}						    
				},
				error:function(jqXHR, exception){
					xD.all.getErrorMessage(jqXHR, exception);
				}
			});
			//data.preventDefault();	
		},
		
		importar: function(){
			$(".btn_importar").click(function () {				
				   $(".formulario").each(function() {
				        displaying = $(this).css("display");
				        if(displaying == "block"){
				          $(this).fadeOut('slow',function(){
				           $(this).css("display","none");
				          // $("#VerListado").show();	
				          });
				        }else{
				          $(this).fadeIn('slow',function(){
				            $(this).css("display","block");
				           // $("#VerListado").hide();	
				          });
				        }
				      });
					
			});	

	
		   $(".btn_importar_inventario").click(function(){
		      $(".formulario").each(function() {
		        displaying = $(this).css("display");
		        if(displaying == "block"){
		          $(this).fadeOut('slow',function(){
		           $(this).css("display","none");
		          // $("#VerListado").show();	
		          });
		        }else{
		          $(this).fadeIn('slow',function(){
		            $(this).css("display","block");
		            //$("#VerListado").hide();	
		          });
		        }
		      });
		    });

		},


		visualizarItems:function(){
			   $('.btn_items').click(function(event){		

				
					var idusu  = $(this).data("idusu");
					var idreg  = $(this).data("idreg");

					var dataString = "idusu="+idusu+"&idreg="+idreg;
					//var dataString = { "idusu" : idusu , "idreg" : idreg};
					//var dataString = 'token='+token+'&ruc='+ruc;

					$.post(BASE_URL + 'asistencias/items',{idusu: idusu, idreg: idreg},function(data){
					 												
					});        
         

							/*	
				
					$.ajax({					
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "asistencias/items",					
						data: dataString,
						error: function (err) { console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
						
						success: function(response){
							console.log(response);
							window.location = "asistencias/items"											
								
									
						}
					});

					*/
					//event.preventDefault();
					return false;  //stop the actual form post !important!

		
			    }); 
		},


		run:function(){
			xD.registros.vars();
			xD.registros.fn0();
			xD.registros.visualizarItems();
			xD.registros.registrarJustificacion();
			xD.registros.aprobarJustificacion();
			xD.registros.importar();
		}
	},

	///////////////////// EMPLEADOS /////////////////////////
	empleados:{
		vars:function(){
			xD.empleados.l1=true;
		},
		
		fn0:function(){		
			$(document).ready(function() {		    
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
	
		
			$(document).ready(function(){
				$('.btn-nuevo').click(function(){							
					$("#VerForm").show();
					$("#VerListado").hide();	
					$(".botones").hide();				
					  //e.preventDefault();
				});
			});
			
					
		},


		searchEmpleados:function(){
				$("#btnBuscarEmpleado").click(function(e){				
					e.preventDefault();			
					$('#modal_form_isearch').modal('show'); // show bootstrap modal
					$('.modal-title').text('Buscar Contacto Inicial'); // Set Title to Bootstrap modal title
					
					$.post(BASE_URL + 'empleados/listas/',function(data){
					 				$("#modal_form_isearch").html(data);  											
								});         
					});							
		},	

		run:function(){
			xD.empleados.vars();
			xD.empleados.fn0();		
			xD.empleados.searchEmpleados();
			//xD.empleados.delete();
		}
	},	
	//////////////FIN EMPLEADOS ///////////////////////////////

	
	///////////////////// REPORTES /////////////////////////
	reportes:{
		vars:function(){
			xD.reportes.l1=true;
		},
		
		fn0:function(){		
			$(document).ready(function() {

				$('.btn_update').click(function(event){
					var id    = $(this).data("id");
					var titu  = $(this).data("titulo");
					var desc  = $(this).data("descrip");
					$('#formTipoUpd #txtId').val(id);
					$('#formTipoUpd #txtTitulo').val(titu);
					$('#formTipoUpd #txtDescripcion').val(desc);		
			    }); 


				$("#btn_export").click(function () {				
				var fechaini = $('#txtFechaInicial').val();	
				var fechafin = $('#txtFechaFinal').val();	
				var cbopedido = $('#cboTipoPedidos').val();
					//str = $("#formReporte").serialize();

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
								$.post(BASE_URL+'reportes/exportarVentasFpdf', $('#formReporte').serialize(), function () { 						
							       		getLink=BASE_URL+"reporteVentas.pdf";
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

					/*$.post(BASE_URL+'reportes/exportarVentasFpdf', $('#formReporte').serialize(), function () { 
					        $('div#resultado').fadeOut( function () { 
					            $(this).empty().html("<h2>Thank you!</h2><p>Thank you for your order. Please <a href='"+BASE_URL+"reporteVentas.pdf' target='_blank'>download your reciept</a>. </p>").fadeIn(); 
					        }); 
    				}); 
   			 		return false;
   			 		 */
   					return false;			
					
			   });

				$("#btn_export_kardex").click(function () {				
				var cbomes    = $('#cboMes').val();		
				var cboanio   = $('#cboAnio').val();
					//str = $("#formReporte").serialize();

					swal({
					  title: "Desea seguir con la Descarga del Kardex?",
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
								$.post(BASE_URL+'reportes/exportarKardexFpdf', $('#formReporte').serialize(), function () { 						
							       		getLink=BASE_URL+"reporteKardex.pdf";
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

					/*$.post(BASE_URL+'reportes/exportarVentasFpdf', $('#formReporte').serialize(), function () { 
					        $('div#resultado').fadeOut( function () { 
					            $(this).empty().html("<h2>Thank you!</h2><p>Thank you for your order. Please <a href='"+BASE_URL+"reporteVentas.pdf' target='_blank'>download your reciept</a>. </p>").fadeIn(); 
					        }); 
    				}); 
   			 		return false;
   			 		 */
   					return false;			
					
			   });

				$("#btn_export_stock").click(function () {				
				var cbocategoria    = $('#cboCategoria').val();		
				
					swal({
					  title: "Desea seguir con la Descarga del Stock?",
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
								$.post(BASE_URL+'reportes/exportarStockFpdf', $('#formReporte').serialize(), function () { 						
							       		getLink=BASE_URL+"reporteStock.pdf";
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
					
			   });

		    });		

				
		},
	
		
		register:function(){
			$("#btn-registerTipo").click(function(e){				
					xD.reportes.validarDatos();       
			});	
		},
		validarDatos:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#formTipoAdd #txtTitulo").val() == ""){
						$("#formTipoAdd #txtTitulo").focus();
						$("#formTipoAdd #status").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formTipoAdd").serialize();	
						xD.reportes.confirm_tipo_register(str);
					}
		},
		confirm_tipo_register:function(str){
			$.ajax({	
				beforeSend: function(){
					$("#formTipoAdd #status").html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "reportes/register",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$("#formTipoAdd #status").html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Registro grabado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}

					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},

		update:function(){
			$("#btn-updateTipo").click(function(e){				
					xD.reportes.validarDatosUpd();       
			});	
		},
		validarDatosUpd:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#formTipoUpd #txtTitulo").val() == ""){
						$("#formTipoUpd #txtTitulo").focus();
						$("#formTipoUpd #status").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formTipoUpd").serialize();	
						xD.reportes.confirm_tipo_update(str);
					}	
		},
		confirm_tipo_update:function(str){
			$.ajax({	
				beforeSend: function(){
					$("#formTipoUpd #status").html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "reportes/update",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$("#formTipoUpd #status").html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Registro actualizado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}
					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},	
			
		run:function(){
			xD.reportes.vars();
			xD.reportes.fn0();
			xD.reportes.register();		
			xD.reportes.update();
		}
	},
	
	productos:{
		vars:function(){
			xD.productos.l1=true;
		},
		
		fn0:function(){	
				var currenturl =  window.location.pathname;			
				var element    = currenturl.split('/');
				var url2       = element[4];	//3:
				var url1       = element[3];	//2:
				var index      = element[2];    //1:pagina principal
			
				$(document).ready(function(){					
					var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;				
					tinymce.init({
					     selector: 'textarea#txtDescripcion1',	
						  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
						  imagetools_cors_hosts: ['picsum.photos'],
						  menubar: 'file edit view insert format tools table help',
						  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
						  toolbar_sticky: true,
						  autosave_ask_before_unload: true,
						  autosave_interval: '30s',
						  autosave_prefix: '{path}{query}-{id}-',
						  autosave_restore_when_empty: false,
						  autosave_retention: '2m',
						  image_advtab: true,
						  link_list: [
						    { title: 'My page 1', value: 'https://www.tiny.cloud' },
						    { title: 'My page 2', value: 'http://www.moxiecode.com' }
						  ],
						  image_list: [
						    { title: 'My page 1', value: 'https://www.tiny.cloud' },
						    { title: 'My page 2', value: 'http://www.moxiecode.com' }
						  ],
						  image_class_list: [
						    { title: 'None', value: '' },
						    { title: 'Some class', value: 'class-name' }
						  ],
						  importcss_append: true,
						  file_picker_callback: function (callback, value, meta) {
						    /* Provide file and text for the link dialog */
						    if (meta.filetype === 'file') {
						      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
						    }

						    /* Provide image and alt text for the image dialog */
						    if (meta.filetype === 'image') {
						      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
						    }

						    /* Provide alternative source and posted for the media dialog */
						    if (meta.filetype === 'media') {
						      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
						    }
						  },
						  templates: [
						        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
						    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
						    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
						  ],
						  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
						  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
						  height: 600,
						  image_caption: true,
						  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
						  noneditable_noneditable_class: 'mceNonEditable',
						  toolbar_mode: 'sliding',
						  contextmenu: 'link image imagetools table',
						  skin: useDarkMode ? 'oxide-dark' : 'oxide',
						  content_css: useDarkMode ? 'dark' : 'default',
						  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'	
				   });
			   });
			
			$(document).ready(function() {
				  if(url1=="productos"  && typeof url2 === 'undefined'){	    	
								//initiate dataTables plugin
								var myTable1 = 
										$('#productos').DataTable({
										"language": {
										 "url": BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
										},
										"bAutoWidth": false,
										"aoColumns": [
											{ "bSortable": false },
											{ "bSortable": false },
											null,null, null, null,null,null,
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
							
							
								////				
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
								$('#productos > thead > tr > th input[type=checkbox], #productos_wrapper input[type=checkbox]').eq(0).on('click', function(){
									var th_checked = this.checked;//checkbox inside "TH" table header
									
									$('#productos').find('tbody > tr').each(function(){
										var row = this;
										if(th_checked) myTable1.row(row).select();
										else  myTable1.row(row).deselect();
									});
								});
								
								//select/deselect a row when the checkbox is checked/unchecked
								$('#productos').on('click', 'td input[type=checkbox]' , function(){
									var row = $(this).closest('tr').get(0);
									if(this.checked) 
										myTable1.row(row).deselect();
									else 
										myTable1.row(row).select();
								});
								
											
								$(document).on('click', '#productos .dropdown-toggle', function(e) {
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
		
				if(url1 =="productos" ){ // 
					/*$('.date').datetimepicker({
						pickTime: false
					});	
					*/					
								
					$('#fecha_final').datetimepicker({
						 format: 'DD-MM-YYYY'								 
						 //defaultDate:dateNow
						 //defaultDate:fechaFin	
						 //defaultDate:''
						//format: 'HH:mm:ss'
					});    
				}
				
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
	
			$(document).on('click','a[data-toggle=\'image\']',function(e){
				$('[data-toggle=popover]').each(function () {
					// hide any open popovers when the anywhere else in the body is clicked
					if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
						$(this).popover('hide');
					}
				});	
			});							
	
			$(document).ready(function(){
				//cargar imagenes adjunto al producto
				$('body').on('click', '.images-upload label', function(){
					var id = $(this).attr('id');
					var array = id.split("_");
					  parte1 = array[0];
					  parte2 = array[1];
					$("#images-input"+parte2).change(function (e){	
						xD.productos.upload_images(parte2);
						e.preventDefault();
					});					
				});
				//cargar imagen principal		
				$("#image-input").change(function (e){					
					xD.productos.upload_image();
					e.preventDefault();				               
				});
				
				$("#cboCategorias").change(function () {
					$("#cboCategorias option:selected").each(function () {
						var idcategoria=$('#cboCategorias').val();					
						$.post(BASE_URL +"categorias/getCboSubcategorias",{ idcategoria: idcategoria}, 						
							function(data){
								$("#cboSubcategoria").html(data);
						}); 						
					});
			    });	

			    $("#cboSubcategoria").change(function () {
					$("#cboSubcategoria option:selected").each(function () {
						var idcategoria=$('#cboSubcategoria').val();					
						$.post(BASE_URL +"categorias/getCboSubcategorias",{ idcategoria: idcategoria}, 						
							function(data){
								$("#cboSubcategoria1").html(data);
						}); 						
					});
			    });			
				
				$('.btn-nuevo').click(function(){							
					$("#VerForm").show();
					$("#VerListado").hide();	
					$(".botones").hide();				
					  //e.preventDefault();
				});
				
				$('.btn_update').click(function(event){
					var id    = $(this).data("id");
					var titu  = $(this).data("titulo");
					var desc  = $(this).data("descrip");
					$('#formNivelUpd #txtId').val(id);
					$('#formNivelUpd #txtTitulo').val(titu);
					$('#formNivelUpd #txtDescripcion').val(desc);		
			    });				
			});				
		},	

		upload_image: function(){//Funcion encargada de enviar el archivo via AJAX
				//$(".upload-msg").text('Cargando...');
				var inputFileImage = document.getElementById("image-input");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('image-input',file);
				
				/*jQuery.each($('#fileToUpload')[0].files, function(i, file) {
					d
					ata.append('file'+i, file);
				});*/
							
				$.ajax({
					url: BASE_URL+'productos/uploadImage',
					//url: "upload.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(res)   // A function to be called if request succeeds
					{
						if(res.valid==true){				                    
	                       	var url = BASE_URL+res.urlimage;
							//$(".avatar img").attr('src',url);
	                    	$(".image-preview").attr("src", url);
	                    	$('#input-image').val(res.urlimage);
	                    	$(".upload-msg").html(res.message);           	
	                	}else if(res.valid=='error'){   	                		
	                		$(".upload-msg").html(res.message);                 		  
	                	}else if(res.valid=='existe'){   	                		
	                		$(".upload-msg").html(res.message);  
	                	}else{	                	
	                		$(".upload-msg").html(res.message);     		 
	                	}						
						/*window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);*/
					}
				});				
		},	

		upload_images: function(l1){//Funcion encargada de enviar el archivo via AJAX
				var inputFileImage = document.getElementById("images-input"+l1);
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('images-input',file);
				data.append('id',l1);
				//alert("File: "+file);
				
				/*jQuery.each($('#fileToUpload')[0].files, function(i, file) {
					d
					ata.append('file'+i, file);
				});*/
									
				$.ajax({
					url: BASE_URL+'productos/uploadImages',
					//url: "upload.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					//data: datos, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					data: data,
					//data:{ archivos:data, parametro:l1 },
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(res)   // A function to be called if request succeeds
					{

						if(res.valid==true){
	                       	var url = BASE_URL+res.urlimage;
							//$(".avatar img").attr('src',url);
	                    	$(".image-preview"+l1).attr("src", url);
	                    	$('#input-image'+l1).val(res.urlimage);
	                    	//$(".upload-msg").html(res.message);           	
	                	}else if(res.valid=='error'){   
	                		//xD.all.alertaReload(res.message,"error"); 
	                		$(".upload-msg").html(res.message);                 		  
	                	}else if(res.valid=='existe'){   
	                		//xD.all.alertaReload(res.message,"error"); 
	                		$(".upload-msg").html(res.message);  
	                	}else{	
	                		//xD.all.alertaReload(res.message,"error"); 
	                		$(".upload-msg").html(res.message);     		 
	                	}	

						
						/*window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);*/
					}
				});
				
		},	

		addDiscount : function(){
				
				$('.btn-addDiscount').click(function(){				
					if ($('#discount >tbody >tr').length == 0){					
						//alert ( "No hay filas en la tabla!!" );				
						discount_row = 0;				
					}else{					
						//Obtenemos la ultima fila						
						var trid    =  $('#discount >tbody >tr:last').attr('id'); 												
						var cadenas = trid.match(/.{1,12}/g); 									
						cont        = cadenas[1];										
						discount_row = parseInt(cont, 10) + parseInt(1, 10);						
					}
					//alert(discount_row);					
					xD.productos.addDiscountFill(discount_row);
					
				});
		},
		
		addDiscountFill : function(discount_row){				
			html  = '<tr id="discount-row' + discount_row + '">';
			html += '  <td class="text-left"><select name="product_discount[' + discount_row + '][customer_group_id]" class="form-control">';
			html += '    <option value="1">Default</option>';
			html += '  </select></td>';
			html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][quantity]" value="" placeholder="Quantity" class="form-control" /></td>';
			html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][priority]" value="" placeholder="Priority" class="form-control" /></td>';
			html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][price]" value="" placeholder="Price" class="form-control" /></td>';
			html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
			html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
			html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';
			
			$('#discount tbody').append(html);
			//discount_row++;
		},
		
		addSpecial : function(){				
				$('.btn-addSpecial').click(function(){					
					//var special_row = 2;					
					if ($('#special >tbody >tr').length == 0){					
						//alert ( "No hay filas en la tabla!!" );				
						special_row = 0;					
					}else{					
						//Obtenemos la ultima fila						
						var trid    =  $('#special >tbody >tr:last').attr('id'); 												
						var cadenas = trid.match(/.{1,11}/g); 									
						cont        = cadenas[1];										
						special_row = parseInt(cont, 10) + parseInt(1, 10);						
					}
					//alert(special_row);					
					xD.productos.addSpecialFill(special_row);		
					
				});
		},
		addSpecialFill : function(special_row) {
			html  = '<tr id="special-row' + special_row + '">';
			html += '  <td class="text-left"><select name="product_special[' + special_row + '][customer_group_id]" class="form-control">';
			html += '      <option value="1">Default</option>';
			html += '  </select></td>';
			html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][priority]" value="" placeholder="Priority" class="form-control" /></td>';
			html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][price]" value="" placeholder="Price" class="form-control" /></td>';
			html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_start]" value="" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
			html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_end]" value="" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
			html += '  <td class="text-left"><button type="button" onclick="$(\'#special-row' + special_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';
			$('#special tbody').append(html);
			//special_row++;
		},
		
		addImage : function(){				
				$('.btn-addImage').click(function(){					
					//var special_row = 2;					
					if ($('#images >tbody >tr').length == 0){					
						image_row = 0;					
					}else{					
						//Obtenemos la ultima fila						
						var trid    =  $('#images >tbody >tr:last').attr('id'); 												
						var cadenas = trid.match(/.{1,9}/g); 									
						cont        = cadenas[1];										
						image_row = parseInt(cont, 10) + parseInt(1, 10);						
					}
					//alert(image_row);					
					xD.productos.addImageFill(image_row);					
				});
		},		
		
		addImageFill:function(image_row) {
			html  = '<tr id="image-row' + image_row + '">';
			html += '  <td class="text-left"><div class="images-upload"><label for="images-input' + image_row + '" id="images-input_' + image_row + '"><img src="'+ BASE_URL +'assets/images/no_image.png" class="img-thumbnail image-preview'+image_row+'" alt="" title="" data-placeholder="https://demo.opencart.com/image/cache/no_image-100x100.png" /></label></div><input id="images-input' + image_row + '" type="file" name="images-input" class="hidden"/><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
			html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></td>';
			html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';
			$('#images tbody').append(html);
			//image_row++;
		},

		register:function(){
			$("#btn-registerNivel").click(function(e){				
					xD.usuarios.validarDatos();       
			});	
		},
		validarDatos:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#txtTitulo").val() == ""){
						$("#txtTitulo").focus();
						$("#status").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelAdd").serialize();	
						xD.usuarios.confirm_nivel_register(str);
					}
		},
		confirm_nivel_register:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#status').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/register",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#status').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Cliente registrado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}

					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},

		update:function(){
			$("#btn-updateNivel").click(function(e){				
					xD.usuarios.validarDatosUpd();       
			});	
		},
		validarDatosUpd:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#formNivelUpd #txtTitulo").val() == ""){
						$("#formNivelUpd #txtTitulo").focus();
						$("#statusUpd").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelUpd").serialize();	
						xD.usuarios.confirm_nivel_update(str);
					}	
		},
		confirm_nivel_update:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#statusUpd').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/update",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#statusUpd').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Nivel de Acceso Actualizado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}
					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},
			
		
		delete:function(){
				$('.btn_deleteproduct').click(function(){
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
							  	data = $("#form-products").serializeArray();
								xD.usuarios.confirm_product_delete(data);
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
		confirm_product_delete:function(data){
					
					//var dataString = 'data='+data+'&opcion='+opcion;

					$.ajax({					
						beforeSend: function(){
							$('#message').html("<div class='respuesta'></div>");
							$('.respuesta').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
						},										
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "usuarios/deletes",					
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
			xD.productos.vars();
			xD.productos.fn0();	
			xD.productos.delete();
			//xD.usuarios.update();
			xD.productos.addDiscount();
			xD.productos.addSpecial();
			xD.productos.addImage();
			
		}
	},	
	

	usuarios:{
		vars:function(){
			xD.usuarios.l1=true;
		},
		
		fn0:function(){	
			var currenturl =  window.location.pathname;
			var element    = currenturl.split('/');
			var url2       = element[4];	//3:
		    var url1       = element[3];	//2:
		    var index      = element[2];    //1:pagina principal
			$(document).ready(function() {	

			if(url1=="usuarios" && typeof url2 === 'undefined'){	    	

				//initiate dataTables plugin			
				var myTable1 = 
					$('#users').DataTable({
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
				myTable1.buttons().container().appendTo( $('.tableUserTools-container') );
				
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
					$($('.tableUserTools-container')).find('a.dt-button').each(function() {
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
				$('#users > thead > tr > th input[type=checkbox], #users_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#users').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#users').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#users .dropdown-toggle', function(e) {
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
			
			if(url1=="usuarios" && url2 === 'tipos'){	    	

				//initiate dataTables plugin			
				var myTable1 = 
					$('#tipousers').DataTable({
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
				myTable1.buttons().container().appendTo( $('.tableUserTools-container') );
				
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
					$($('.tableUserTools-container')).find('a.dt-button').each(function() {
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
				$('#users > thead > tr > th input[type=checkbox], #users_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#users').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#users').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#users .dropdown-toggle', function(e) {
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

			if(url1=="permisos" && typeof url2 === 'undefined'){
				//initiate dataTables plugin			
				var myTable1 = 
				$('#permisos').DataTable({
						"language": {
                		 "url": BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
						},
						"bAutoWidth": false,
						"aoColumns": [
						  { "bSortable": false },
						  null, null,null, null, null,
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
						columns: ':not(:first):not(:last)'
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
				
				myTable1.buttons().container().appendTo( $('.tablePermisoTools-container') );
				
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
					$('.dt-button-collection').appendTo('.tablePermisoTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tablePermisoTools-container')).find('a.dt-button').each(function() {
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
				$('#permisos > thead > tr > th input[type=checkbox], #permisos_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#permisos').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#permisos').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#permisos .dropdown-toggle', function(e) {
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
				/*

		        $("#txtApellidos").keyup(function(e){		        	    
		        	var nombre   = $('#txtNombre').val();
					var fstChar  = nombre.charAt(0).toLowerCase();					
		        	var apellido = $("#txtApellidos").val();		        
    				separador    = " ";
    				cadenas      = apellido.split(separador);
    				    			    				
    				apaterno  = cadenas[0].toLowerCase(); // de         // maggiolo
    				//amaterno  = cadenas[1].toLowerCase(); // rodriguez  // del
    				//ayaterno  = cadenas[2].toLowerCase(); // ocampo     // carpio

    				if (typeof cadenas[1] == "undefined"){
    					amaterno  = null;
    				}else{    				
    					if(cadenas[1].length >3){
    						amaterno  = cadenas[1].toLowerCase();
    					}else{
    						amaterno  = null;
    					}
    				}

    				if (typeof cadenas[2] == "undefined"){
    					ayaterno  = null;
    				}else{
    					ayaterno  = cadenas[2].toLowerCase();
    				}
    	    				
    				if (ayaterno == null){
    					var login =   fstChar+xD.all.limpiar_tilde(apaterno);	
    				}else{
    					var login =   fstChar+xD.all.limpiar_tilde(apaterno)+xD.all.limpiar_tilde(amaterno);
    				}

    				var email = login+"@sapimsa.com";
    				
		        	$("#txtLogin").val(login);
		        	$("#txtPassword").val("Acceso01");
		        	$("#txtEmail").val(email);

		        	                                                                           
		        });		
				*/



				
		    });				
	
		
			$(document).ready(function(){
				
				$("#file-input").change(function (e){
					//filePreview(this);				    
					
					var inputFileImage = document.getElementById("file-input");
					var file = inputFileImage.files[0];
					var data = new FormData();
					data.append('file-input',file);				
  								
					$.ajax({				           
						url: BASE_URL+'usuarios/uploadImage',
						data: data,
						processData: false,
						contentType: false,
						type: 'POST',
						success: function(res){								
							if(res.valid==true){
								var url = BASE_URL + res.urlimage;
								$(".image-upload img").attr("src", url); 
								$("#input-image").val(res.urlimage); 

							}else{
								$("#status").html(res.message);				                	
							}
						}
					});

					e.preventDefault();
				               
				});
				
				$('.btn-nuevo').click(function(){							
					$("#VerForm").show();
					$("#VerListado").hide();	
					$(".botones").hide();				
					  //e.preventDefault();
				});
				
				$('.btn_update').click(function(event){
					var id    = $(this).data("id");
					var titu  = $(this).data("titulo");
					var desc  = $(this).data("descrip");
					$('#formNivelUpd #txtId').val(id);
					$('#formNivelUpd #txtTitulo').val(titu);
					$('#formNivelUpd #txtDescripcion').val(desc);
		
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
		
		
		register:function(){
			$("#btn-registerNivel").click(function(e){				
					xD.usuarios.validarDatos();       
			});	
		},
		validarDatos:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#txtTitulo").val() == ""){
						$("#txtTitulo").focus();
						$("#status").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelAdd").serialize();	
						xD.usuarios.confirm_nivel_register(str);
					}
		},
		confirm_nivel_register:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#status').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/register",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#status').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Cliente registrado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}

					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},

		update:function(){
			$("#btn-updateNivel").click(function(e){				
					xD.usuarios.validarDatosUpd();       
			});	
		},
		validarDatosUpd:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#formNivelUpd #txtTitulo").val() == ""){
						$("#formNivelUpd #txtTitulo").focus();
						$("#statusUpd").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelUpd").serialize();	
						xD.usuarios.confirm_nivel_update(str);
					}	
		},
		confirm_nivel_update:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#statusUpd').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/update",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#statusUpd').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Nivel de Acceso Actualizado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}
					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
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
		confirm_user_delete:function(data){
					
					//var dataString = 'data='+data+'&opcion='+opcion;

					$.ajax({					
						beforeSend: function(){
							$('#message').html("<div class='respuesta'></div>");
							$('.respuesta').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
						},										
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "usuarios/deletes",					
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
			xD.usuarios.vars();
			xD.usuarios.fn0();	
			xD.usuarios.register();
			xD.usuarios.update();
			xD.usuarios.delete();
		}
	},	
	
	banners:{
		vars:function(){
			xD.banners.l1=true;
		},
		
		fn0:function(){	
			var currenturl =  window.location.pathname;
			var element    = currenturl.split('/');
			var url2       = element[4];	//3:
		    var url1       = element[3];	//2:
		    var index      = element[2];    //1:pagina principal
			$(document).ready(function() {	

			if(url1=="banners" && typeof url2 === 'undefined'){	    	

				//initiate dataTables plugin			
				var myTable1 = 
					$('#banners').DataTable({
						"language": {
                		 "url": BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
						},
						"bAutoWidth": false,
						"aoColumns": [
						  { "bSortable": false },
						  null, null,null,
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
				myTable1.buttons().container().appendTo( $('.tableBannersTools-container') );
				
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
					$('.dt-button-collection').appendTo('.tableBannersTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableBannersTools-container')).find('a.dt-button').each(function() {
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
				$('#banners > thead > tr > th input[type=checkbox], #banners_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#banners').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#banners').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#banners .dropdown-toggle', function(e) {
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
	
		
			$(document).ready(function(){				
				$("#file-input").change(function (e){
					//filePreview(this);				    
					
					var inputFileImage = document.getElementById("file-input");
					var file = inputFileImage.files[0];
					var data = new FormData();
					data.append('file-input',file);				
  								
					$.ajax({				           
						url: BASE_URL+'usuarios/uploadImage',
						data: data,
						processData: false,
						contentType: false,
						type: 'POST',
						success: function(res){								
							if(res.valid==true){
								var url = BASE_URL + res.urlimage;
								$(".image-upload img").attr("src", url); 
								$("#input-image").val(res.urlimage); 

							}else{
								$("#status").html(res.message);				                	
							}
						}
					});

					e.preventDefault();
				               
				});
				
				$('.btn-nuevo').click(function(){							
					$("#VerForm").show();
					$("#VerListado").hide();	
					$(".botones").hide();				
					  //e.preventDefault();
				});
				
				$('.btn_update').click(function(event){
					var id    = $(this).data("id");
					var titu  = $(this).data("titulo");
					var desc  = $(this).data("descrip");
					$('#formNivelUpd #txtId').val(id);
					$('#formNivelUpd #txtTitulo').val(titu);
					$('#formNivelUpd #txtDescripcion').val(desc);
		
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
		
		
		register:function(){
			$("#btn-registerNivel").click(function(e){				
					xD.usuarios.validarDatos();       
			});	
		},
		validarDatos:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#txtTitulo").val() == ""){
						$("#txtTitulo").focus();
						$("#status").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelAdd").serialize();	
						xD.usuarios.confirm_nivel_register(str);
					}
		},
		confirm_nivel_register:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#status').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/register",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#status').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Cliente registrado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}

					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},

		update:function(){
			$("#btn-updateNivel").click(function(e){				
					xD.usuarios.validarDatosUpd();       
			});	
		},
		validarDatosUpd:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#formNivelUpd #txtTitulo").val() == ""){
						$("#formNivelUpd #txtTitulo").focus();
						$("#statusUpd").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelUpd").serialize();	
						xD.usuarios.confirm_nivel_update(str);
					}	
		},
		confirm_nivel_update:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#statusUpd').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/update",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#statusUpd').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Nivel de Acceso Actualizado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}
					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
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
		confirm_user_delete:function(data){
					
					//var dataString = 'data='+data+'&opcion='+opcion;

					$.ajax({					
						beforeSend: function(){
							$('#message').html("<div class='respuesta'></div>");
							$('.respuesta').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
						},										
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "usuarios/deletes",					
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
			xD.banners.vars();
			xD.banners.fn0();	
			xD.banners.register();
			xD.banners.update();
			xD.banners.delete();
		}
	},	

	
	menus:{
		vars:function(){
			xD.menus.l1=true;
		},
		
		fn0:function(){	
			var currenturl =  window.location.pathname;
			var element    = currenturl.split('/');
			var url2       = element[4];	//3:
		    var url1       = element[3];	//2:
		    var index      = element[2];    //1:pagina principal
			$(document).ready(function() {	
			
				$("#cboMenu").change(function (){
					$("#cboMenu option:selected").each(function () {
						var idmenu = $('#cboMenu').val();					
						$.post(BASE_URL +"menus/getMenuItems",{ idmenu: idmenu}, 						
							function(data){
									$("#cboMenuItemPadre").html(data);
						}); 						
					});
			   });

			if(url1=="menus" && typeof url2 === 'undefined'){	    	

				//initiate dataTables plugin			
				var myTable1 = 
					$('#menus').DataTable({
						"language": {
                		 "url": BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
						},
						"bAutoWidth": false,
						"aoColumns": [
						  { "bSortable": false },
						  null, null,null,null,
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
				$('#menus > thead > tr > th input[type=checkbox], #menus_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#menus').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#menus').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#menus .dropdown-toggle', function(e) {
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

			if(url1=="menus" && url2 == 'items'){	    	

				//initiate dataTables plugin			
				var myTable1 = 
					$('#menuitems').DataTable({
						"language": {
                		 "url": BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
						},
						"bAutoWidth": false,
						"aoColumns": [
						  { "bSortable": false },
						  null, null,null,
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
				$('#menuitems > thead > tr > th input[type=checkbox], #menuitems_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#menuitems').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#menuitems').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#menuitems .dropdown-toggle', function(e) {
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
	
		
			$(document).ready(function(){				
				$("#file-input").change(function (e){
					//filePreview(this);				    
					
					var inputFileImage = document.getElementById("file-input");
					var file = inputFileImage.files[0];
					var data = new FormData();
					data.append('file-input',file);				
  								
					$.ajax({				           
						url: BASE_URL+'usuarios/uploadImage',
						data: data,
						processData: false,
						contentType: false,
						type: 'POST',
						success: function(res){								
							if(res.valid==true){
								var url = BASE_URL + res.urlimage;
								$(".image-upload img").attr("src", url); 
								$("#input-image").val(res.urlimage); 

							}else{
								$("#status").html(res.message);				                	
							}
						}
					});

					e.preventDefault();
				               
				});
				
				$('.btn-nuevo').click(function(){							
					$("#VerForm").show();
					$("#VerListado").hide();	
					$(".botones").hide();				
					  //e.preventDefault();
				});
				
				$('.btn_update').click(function(event){
					var id    = $(this).data("id");
					var titu  = $(this).data("titulo");
					var desc  = $(this).data("descrip");
					$('#formNivelUpd #txtId').val(id);
					$('#formNivelUpd #txtTitulo').val(titu);
					$('#formNivelUpd #txtDescripcion').val(desc);
		
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
		
		
		register:function(){
			$("#btn-registerNivel").click(function(e){				
					xD.usuarios.validarDatos();       
			});	
		},
		validarDatos:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#txtTitulo").val() == ""){
						$("#txtTitulo").focus();
						$("#status").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelAdd").serialize();	
						xD.usuarios.confirm_nivel_register(str);
					}
		},
		confirm_nivel_register:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#status').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/register",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#status').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Cliente registrado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}

					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},

		update:function(){
			$("#btn-updateNivel").click(function(e){				
					xD.usuarios.validarDatosUpd();       
			});	
		},
		validarDatosUpd:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#formNivelUpd #txtTitulo").val() == ""){
						$("#formNivelUpd #txtTitulo").focus();
						$("#statusUpd").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelUpd").serialize();	
						xD.usuarios.confirm_nivel_update(str);
					}	
		},
		confirm_nivel_update:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#statusUpd').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/update",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#statusUpd').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Nivel de Acceso Actualizado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}
					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
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
		confirm_user_delete:function(data){
					
					//var dataString = 'data='+data+'&opcion='+opcion;

					$.ajax({					
						beforeSend: function(){
							$('#message').html("<div class='respuesta'></div>");
							$('.respuesta').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
						},										
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "usuarios/deletes",					
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
			xD.menus.vars();
			xD.menus.fn0();	
			xD.menus.register();
			xD.menus.update();
			xD.menus.delete();
		}
	},	

	pedidos:{
		vars:function(){
			xD.pedidos.l1=true;
		},
		
		fn0:function(){	
			var currenturl =  window.location.pathname;
			var element    = currenturl.split('/');
			var url2       = element[4];	//3:
		    var url1       = element[3];	//2:
		    var index      = element[2];    //1:pagina principal
			$(document).ready(function() {	
			
				$("#cboMenu").change(function (){
					$("#cboMenu option:selected").each(function () {
						var idmenu = $('#cboMenu').val();					
						$.post(BASE_URL +"menus/getMenuItems",{ idmenu: idmenu}, 						
							function(data){
									$("#cboMenuItemPadre").html(data);
						}); 						
					});
			   });

			if(url1=="pedidos" && typeof url2 === 'undefined'){	    	

				//initiate dataTables plugin			
				var myTable1 = 
					$('#pedidos').DataTable({
						"language": {
                		 "url": BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
						},
						"bAutoWidth": false,
						"aoColumns": [
						  { "bSortable": false },
						  null, null,null,null,null,
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
				$('#pedidos > thead > tr > th input[type=checkbox], #menus_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#pedidos').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#pedidos').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#pedidos .dropdown-toggle', function(e) {
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

			if(url1=="menuss" && url2 == 'items'){	    	

				//initiate dataTables plugin			
				var myTable1 = 
					$('#menuitems').DataTable({
						"language": {
                		 "url": BASE_URL+'assets/plugins/datatables/Spanish.json' //Ubicacion del archivo con el json del idioma.
						},
						"bAutoWidth": false,
						"aoColumns": [
						  { "bSortable": false },
						  null, null,null,
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
				$('#menuitems > thead > tr > th input[type=checkbox], #menuitems_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#menuitems').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#menuitems').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#menuitems .dropdown-toggle', function(e) {
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
	
		
			$(document).ready(function(){				
				$("#file-input").change(function (e){
					//filePreview(this);				    
					
					var inputFileImage = document.getElementById("file-input");
					var file = inputFileImage.files[0];
					var data = new FormData();
					data.append('file-input',file);				
  								
					$.ajax({				           
						url: BASE_URL+'usuarios/uploadImage',
						data: data,
						processData: false,
						contentType: false,
						type: 'POST',
						success: function(res){								
							if(res.valid==true){
								var url = BASE_URL + res.urlimage;
								$(".image-upload img").attr("src", url); 
								$("#input-image").val(res.urlimage); 

							}else{
								$("#status").html(res.message);				                	
							}
						}
					});

					e.preventDefault();
				               
				});
				
				$('.btn-nuevo').click(function(){							
					$("#VerForm").show();
					$("#VerListado").hide();	
					$(".botones").hide();				
					  //e.preventDefault();
				});
				
				$('.btn_update').click(function(event){
					var id    = $(this).data("id");
					var titu  = $(this).data("titulo");
					var desc  = $(this).data("descrip");
					$('#formNivelUpd #txtId').val(id);
					$('#formNivelUpd #txtTitulo').val(titu);
					$('#formNivelUpd #txtDescripcion').val(desc);
		
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
		
		
		register:function(){
			$("#btn-registerNivel").click(function(e){				
					xD.usuarios.validarDatos();       
			});	
		},
		validarDatos:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#txtTitulo").val() == ""){
						$("#txtTitulo").focus();
						$("#status").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelAdd").serialize();	
						xD.usuarios.confirm_nivel_register(str);
					}
		},
		confirm_nivel_register:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#status').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/register",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#status').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Cliente registrado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}

					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},

		update:function(){
			$("#btn-updateNivel").click(function(e){				
					xD.usuarios.validarDatosUpd();       
			});	
		},
		validarDatosUpd:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#formNivelUpd #txtTitulo").val() == ""){
						$("#formNivelUpd #txtTitulo").focus();
						$("#statusUpd").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formNivelUpd").serialize();	
						xD.usuarios.confirm_nivel_update(str);
					}	
		},
		confirm_nivel_update:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#statusUpd').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "roles/update",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#statusUpd').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Nivel de Acceso Actualizado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}
					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
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
		confirm_user_delete:function(data){
					
					//var dataString = 'data='+data+'&opcion='+opcion;

					$.ajax({					
						beforeSend: function(){
							$('#message').html("<div class='respuesta'></div>");
							$('.respuesta').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
						},										
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "usuarios/deletes",					
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
			xD.pedidos.vars();
			xD.pedidos.fn0();
		
		}
	},	


	estados:{
		vars:function(){
			xD.estados.l1=true;
		},
		
		fn0:function(){		
			$(document).ready(function(){			
				$('.btn_update').click(function(event){
					var id    = $(this).data("id");
					var titu  = $(this).data("titulo");
					var desc  = $(this).data("descrip");
					$('#formEstadoUpd #txtId').val(id);
					$('#formEstadoUpd #txtTitulo').val(titu);
					$('#formEstadoUpd #txtDescripcion').val(desc);
		
			    }); 
				
			});
			
					
		},	
	

		register:function(){
			$("#btn-registerEstado").click(function(e){				
					xD.estados.validarDatos();       
			});	
		},
		validarDatos:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#txtTitulo").val() == ""){
						$("#txtTitulo").focus();
						$("#status").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formEstadoAdd").serialize();	
						xD.estados.confirm_estado_register(str);
					}
		},
		confirm_estado_register:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#status').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "estados/register",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#status').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Registro grabado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}

					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},

		update:function(){
			$("#btn-updateEstado").click(function(e){				
					xD.estados.validarDatosUpd();       
			});	
		},
		validarDatosUpd:function(){
					$(".error").remove();
					var opcion = $('#txtOpcion').val();
					//var acepto = $('input:checkbox[name=acepto]:checked').length;
					if( $("#formEstadoUpd #txtTitulo").val() == ""){
						$("#formEstadoUpd #txtTitulo").focus();
						$("#formEstadoUpd #status").focus().after("<span class='error'>Porfavor, Ingrese Titulo</span>");
						return false;
					}else{
						str = $("#formEstadoUpd").serialize();	
						xD.estados.confirm_estado_update(str);
					}	
		},
		confirm_estado_update:function(str){
			$.ajax({	
				beforeSend: function(){
					$('#formEstadoUpd #status').html("<div class='message'></div>");
					$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				},				
				cache: false, // Indicamos que no se guarde en cache
				type: "POST", // Variables POST						
				url: BASE_URL + "estados/update",					
				data: str,
				error: function(err){ console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
				success: function(response){
					console.log(response);
					$('.message').hide(); // Ocultamos el mensaje anterior
					$('#formEstadoUpd #status').html("<div class='respuesta'></div>");
					if (response == 'Ok'){
						$('.respuesta').html('Registro Actualizado con exito.'); // Mostramos la respuesta devuelto por el php										
					}else{
						$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
					}
					setTimeout( function() { 
						document.location.reload(); //redirige a la pagina donde se quedo
					}, 1000 );	
				}
			});
		},	
		
		run:function(){
			xD.estados.vars();
			xD.estados.fn0();	
			xD.estados.register();
			xD.estados.update();
			//xD.usuarios.delete();
		}
	},
	

	archivos:{
		vars:function(){
			xD.archivos.l1=true;
		},	

		fn0:function(){		
					
			$(document).ready(function() {
				$(".btn_newfile").click(function () {	
			
				   $(".formulario_file").each(function() {
				        displaying = $(this).css("display");
				        if(displaying == "block"){
				          $(this).fadeOut('slow',function(){
				           $(this).css("display","none");
				          // $("#VerListado").show();	

				          $(".formulario_folder").hide();	
				          });
				        }else{
				          $(this).fadeIn('slow',function(){
				            $(this).css("display","block");
				           // $("#VerListado").hide();	
				           $(".formulario_folder").hide();	
				          });
				        }
				      });					
				});

				$(".btn_newfolder").click(function () {	
			
				   $(".formulario_folder").each(function() {
				        displaying = $(this).css("display");
				        if(displaying == "block"){
				          $(this).fadeOut('slow',function(){
				           $(this).css("display","none");
				          // $("#VerListado").show();
				           $(".formulario_file").hide();		
				          });
				        }else{
				          $(this).fadeIn('slow',function(){
				            $(this).css("display","block");
				            // $("#VerListado").hide();	
				            $(".formulario_file").hide();	
				          });
				        }
				      });
					
			   });	

				/*

			   	$(".btn_deletefile").click(function (){
				   	$("input:checkbox:checked").each(function(){
					        
				        // Hacer algo si el checkbox ha sido seleccionado
							        alert("El checkbox con valor " + $(this).val() + " está seleccionado");
							  

					    }
					);			
					
			   });	
			   */	
	

		

			});					
		},

		folder: function(){
			$("#frmFolder").on("submit", function(e){						
						accion = 'Archivos/registrarFolder';
						var data;
					    data = new FormData(document.getElementById("frmFolder"));					
			            $.ajax({
			            	beforeSend: function(){
								$('#mensaje').html('<img src="'+BASE_URL +'assets/images/loading.gif" alt="" /><small>Procesando...</small>');
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
			                	}else{	
			                		xD.all.alertaReload(res.message,"error");     		 
			                	}								    
							}
						});
						e.preventDefault();				        
			});

	
		},	

		file: function(){
			
			$("#frmFiles").on("submit", function(e){						
						accion = 'Archivos/registrarFiles';
						var data;
					    data = new FormData(document.getElementById("frmFiles"));					
			            $.ajax({
			            	beforeSend: function(){
			            		xD.all.alertaReload('Procesando...',"info");	
								//$('#mensaje').html('<img src="'+BASE_URL +'assets/images/loading.gif" alt="" /><small>Procesando...</small>');
							},
			                //url: BASE_URL+'productos/importarUpdateExcel',
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
		
		register:function(){
			$('#id-menu-register').on({
				click:function(){
					xD.menu.validarDatosMenu();
				}
			});
			
			$("#btn-registerMenu").click(function(e){				
					xD.menu.validarDatos();       
			});	
			$("#btn-updateMenu").click(function(e){				
					xD.menu.validarDatosUpd();       
			});				
		},

		validarDatos:function(){
					$(".error").remove();
					if( $("#txtTitulo").val() == ""){
						$("#txtTitulo").focus();
						$("#status").focus().after("<span class='error'>Porfavor, ingrese Titulo</span>");
						return false;						
					}else{
						str = $("#formMenu").serialize();
						xD.menu.confirm_menu_register(str);
					}						
		},		
		confirm_menu_register:function(str){			

					$.ajax({	
						beforeSend: function(){
							$('#status').html("<div class='message'></div>");
							$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				
						},				
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "menu/register",					
						data: str,
						error: function (err) { console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
						success: function(response){
							console.log(response);
							$('.message').hide(); // Ocultamos el mensaje anterior
							$('#status').html("<div class='respuesta'></div>");
							if (response == 'Ok'){
								$('.respuesta').html('Categoria registrada con exito.'); // Mostramos la respuesta devuelto por el php										
							}else{
								$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
							}		
							setTimeout( function() {  //redirige a la pagina padre			
								document.location.reload(); //redirige a la pagina donde se quedo
							}, 2000 );
			
						}
					});

		},
			
		validarDatosUpd:function(){
					$(".error").remove();
					if( $("#formMenuUpd #txtTitulo").val() == ""){
						$("#formMenuUpd #txtTitulo").focus();
						$("#statusUpd").focus().after("<span class='error'>Porfavor, ingrese Titulo</span>");
						return false;						
					}else{
						str = $("#formMenuUpd").serialize();
						xD.menu.confirm_menu_update(str);
					}						
		},		
		confirm_menu_update:function(str){			

					$.ajax({	
						beforeSend: function(){
							$('#statusUpd').html("<div class='message'></div>");
							$('.message').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
				
						},				
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "menu/update",					
						data: str,
						error: function (err) { console.log("AJAX error in request: " + JSON.stringify(err, null, 2)); }, 
						success: function(response){
							console.log(response);
							$('.message').hide(); // Ocultamos el mensaje anterior
							$('#statusUpd').html("<div class='respuesta'></div>");
							if (response == 'Ok'){
								$('.respuesta').html('Categoria registrada con exito.'); // Mostramos la respuesta devuelto por el php										
							}else{
								$('.respuesta').html(response); // Mostramos la respuesta devuelto por el php										
							}		
							setTimeout( function() {  //redirige a la pagina padre			
								document.location.reload(); //redirige a la pagina donde se quedo
							}, 2000 );
			
						}
					});

		},		
		
		delete:function(){
				$('.btn_deletefile').click(function(){
			        var selected = ''; 		      
			        $('input[type=checkbox]').each(function(){
			            if (this.checked) {
			            //if($(this).is(':checked')) {
			                selected += $(this).val()+', ';
			            }
			        }); 

			        if(selected != ''){
			           // alert('Has seleccionado: '+selected); 
			            //var newStr = selected.substring(0, selected.length-1);
						//alert('Has seleccionado: '+newStr);   
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
							  	data = $("#frmRegistros").serializeArray();
								xD.archivos.confirm_files_delete(data);
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
		confirm_files_delete:function(data){			

					$.ajax({	
						
						beforeSend: function(){
							$('#message').html("<div class='respuesta'></div>");
							$('.respuesta').html('<p><img id="loader" src="'+BASE_URL+'assets/images/loading.gif"/><small>Procesando datos...</small></p>');
						},										
						cache: false, // Indicamos que no se guarde en cache
						type: "POST", // Variables POST						
						url: BASE_URL + "archivos/deletes",					
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
			xD.archivos.vars();
			xD.archivos.fn0();
			xD.archivos.folder();
			xD.archivos.file();
			xD.archivos.register();		
			xD.archivos.delete();
		}
	},
	
	marcas:{
		vars:function(){
			xD.marcas.l1=true;
		},
		
		fn0:function(){	
				var currenturl =  window.location.pathname;			
				var element    = currenturl.split('/');
				var url2       = element[4];	//3:
				var url1       = element[3];	//2:
				var index      = element[2];    //1:pagina principal
			
					
			$(document).ready(function() {
			
				if(url1=="productos" && url2 === 'marcas'){	    	

				//initiate dataTables plugin			
				var myTable1 = 
					$('#brandproducts').DataTable({
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
				myTable1.buttons().container().appendTo( $('.tableBrandProducts-container') );
				
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
					$('.dt-button-collection').appendTo('.tableBrandProducts-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableBrandProducts-container')).find('a.dt-button').each(function() {
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
				$('#brandproducts > thead > tr > th input[type=checkbox], #brandproducts_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#brandproducts').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable1.row(row).select();
						else  myTable1.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#brandproducts').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) 
						myTable1.row(row).deselect();
					else 
						myTable1.row(row).select();
				});
			
						
				$(document).on('click', '#brandproducts .dropdown-toggle', function(e) {
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
				$('.btn_deletemarca').click(function(){
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
								xD.usuarios.confirm_marca_delete(data);
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
		confirm_marca_delete:function(data){		
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
			xD.marcas.vars();
			xD.marcas.fn0();	
			xD.marcas.delete();		
		}
	},	
	
	
	
	categorias:{
		vars:function(){
			xD.categorias.l1=true;
		},
		
		fn0:function(){	
				var currenturl =  window.location.pathname;			
				var element    = currenturl.split('/');
				var url2       = element[4];	//3:
				var url1       = element[3];	//2:
				var index      = element[2];    //1:pagina principal
			
				$(document).ready(function(){
					
					var config = {
						selector: "#txtDescripcion",
						plugins: "jsplusInclude,jsplusBootstrapTools,link,lists,image",
						toolbar: [
							"cut copy | undo redo | bold italic underline | numlist bullist | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect | link unlink | image table",
							"jsplusShowBlocks | jsplusBootstrapToolsContainerEdit jsplusBootstrapToolsContainerAdd jsplusBootstrapToolsContainerAddBefore jsplusBootstrapToolsContainerAddAfter jsplusBootstrapToolsContainerDelete jsplusBootstrapToolsContainerMoveUp jsplusBootstrapToolsContainerMoveDown | jsplusBootstrapToolsRowEdit jsplusBootstrapToolsRowAdd jsplusBootstrapToolsRowAddBefore jsplusBootstrapToolsRowAddAfter jsplusBootstrapToolsRowDelete jsplusBootstrapToolsRowMoveUp jsplusBootstrapToolsRowMoveDown | jsplusBootstrapToolsColEdit jsplusBootstrapToolsColAdd jsplusBootstrapToolsColAddBefore jsplusBootstrapToolsColAddAfter jsplusBootstrapToolsColDelete jsplusBootstrapToolsColMoveLeft jsplusBootstrapToolsColMoveRight"
						],
						lang: "en",
						skin: "be",
						extended_valid_elements: "span[*]",
						paste_data_images: true,
						height: 700,
						jsplusInclude: {
							framework: "b3",
							includeCssToGlobalDoc: false
						}
					};
									
					tinymce.init({
						selector: 'textarea#txtDescripcion'					
				    });
			    });
			
			
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
						  null, null,null, null,null,
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
	
	
		
	index:{
		vars:function(){
			xD.index.l1=true;
		},
		fn1:function(){
			$(document).ready(function() {
				$('#ver-password').click(function(e){
					var cambio = document.getElementById("txtPasswordSMTP");
					if(cambio.type == "password"){
						cambio.type = "text";
						$('.icons').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
					}else{
						cambio.type = "password";
						$('.icons').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
					}
				});
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
	var url        = element[4]; //2:
	var index      = element[3]; //1:pagina principal
	//alert(element[3]); 
	//alert("index:"+index);
	if(index!=="home"){
		xD.all.run();
		xD.index.run();
		xD.empleados.run();
		xD.usuarios.run();	
		xD.reportes.run();
		xD.registros.run();
		xD.archivos.run();		
		xD.estados.run();
		xD.productos.run();	
		xD.banners.run();
		xD.marcas.run();
		xD.categorias.run();
		xD.menus.run();	
		xD.pedidos.run();			
  	}else{
  		xD.login.run();		
  	}
	
	
});

/*************************JQUERY*******************************************/