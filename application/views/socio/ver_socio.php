<link href="<?php echo base_url(); ?>assets/bower_components/datatable/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/bower_components/datatable/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">

    table.dataTable thead th, table.dataTable thead td{
      border-bottom:none;
    }

    table.dataTable.no-footer{
      border-bottom:none;
    }
</style>


<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Socios
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Socio</a></li>
 
      </ol>
    </section> 

    <section class="content">

      <div class="row">

      <? mensaje_resultado($mensaje); ?>

      <!-- DATOS SOCIO --> 
      <div class="col-md-4" style="padding-left: 0px; padding-right: 0px">

      	<div class="panel panel-default">
       
      	  <div class="panel-heading"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Modificar Socio</div>
      	      <div class="panel-body">
      	    	
                  <form class="form-horizontal" name="form_modifica_socio" id="form_modifica_socio"  method="POST" action="<?=base_url()?>index.php/socio/modifica_socio/"  enctype="multipart/form-data"  >

                            <input type="hidden" readonly="readonly"  class="form-control" id="id_socio" name="id_socio" value="<?=$datos_socio->id_socio?>">

      	                    <div class="form-group col-sm-12 ">
      	                      <label for="apellido" class="col-sm-3 control-label">Apellido</label>
      	                      <div class="col-sm-9">
      	                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?=$datos_socio->apellido?>" placeholder="Apellido">
      	                      </div>
      	                    </div>
      	                    <div class="form-group col-sm-12 ">
      		                      <label for="nombre" class="col-sm-3 control-label">Nombre</label>
      		                      <div class="col-sm-9">
      		                        <input type="text" class="form-control" id="nombre"  name="nombre" value="<?=$datos_socio->nombre?>" placeholder="Nombre">
      		                      </div>
      		                  </div>
       
                           	<div class="form-group col-sm-12 ">
                            	<label for="foto" class="col-sm-3 control-label">Foto</label>
                            	<div class="col-sm-9">
                              	<input type="file" class="form-control" id="foto" name="foto" >
                                <input type="hidden" class="form-control" id="foto_anterior" name="foto_anterior" value="<?=$datos_socio->foto?>">
                                <img style="width: 40%" src="<?=base_url()?>/assets/images/fotos_socios/<?=$datos_socio->foto?>">
                           		</div>
                          	</div>

                          	<div class="form-group col-sm-12 ">
                            	<label for="fecha_nacimiento" class="col-sm-3 control-label">Fecha Nacimiento</label>
                            	<div class="col-sm-9">
                              	<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?=$datos_socio->fecha_nacimiento?>" placeholder="Fecha Nacimiento">
                           		</div>
                          	</div>



                         	<div class="row">

                         	 	<div class=" col-sm-12 ">
                         			<input type="submit" class="btn btn-primary btn-block" id="submit" name="submit" value="Modificar"  >
                         		</div>

                         	</div>
          			   </form>
                          

            </div>
      	</div>

      </div>

      <!-- EMAILS --> 
      <div class="col-md-4" style="padding-right: 0px">
       	
       	<div class="panel panel-default"> 
      	  <div class="panel-heading"><i class="fa fa-at" aria-hidden="true"></i> Email</div>
      	  <div class="panel-body">
       

                  <? if(count($emails_socio) > 0): ?>

                          <table  class="table table-striped table-bordered" id="tabla_usuarios" cellspacing="0" width="100%">
                            <thead>
                                <tr >
                                    <th>Email</th>
                                    <th>Responsable</th>
                                    <th></th>
                            </thead>
                            <tbody> 

                        <? foreach ($emails_socio as $row): ?>

                                <tr>
                                    <td><?=$row['email']?></td>
                                    <td><?=$row['responsable']?></td>
                                    <td> 
                                          <a href="#" onclick="eliminar_email(<?=$row['id_email']?>)"><i class="fa fa-trash" aria-hidden="true"></i>   </a>
                                    </td>
                                </tr>
                      
                        <? endforeach;  ?>

                            </tbody>
                          </table>
                      
                      <?  else: ?>
                            <div class="alert alert-warning alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              Aún no hay emails cargados. 
                            </div>

                            

                      <? endif;  ?>
       


              <label  class="col-sm-12 control-label"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Email</label>
              <div class="form-group col-sm-12 " style="background-color: #e0dddd; padding-top: 20px">

                  <form class="form-horizontal" name="form_agregar_email" id="form_agregar_email"  method="POST"  action="<?=base_url()?>index.php/socio/alta_email_socio/"   >
                      <input type="hidden" class="form-control" id="id_socio" name="id_socio" value="<?=$datos_socio->id_socio?>">

                      <div class="form-group   ">
                          <label for="email" class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                          </div>
                      </div>
                      <div class="form-group   ">
                            <label for="responsable" class="col-sm-3 control-label">Responsable</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="responsable"  name="responsable" placeholder="Responsable">
                            </div>
                      </div>

                      <div class="row">

                        <div class=" col-sm-12 ">
                          <input type="submit" class="btn btn-primary btn-block" id="submit" name="submit" value="Modificar"  >
                        </div>

                      </div>
                  </form>
              </div>
      	  </div>
       
      	</div>

      </div>

      <!-- TELEFONOS --> 
      <div class="col-md-4" style="padding-right: 0px">
        
        <div class="panel panel-default"> 
          <div class="panel-heading"><i class="fa fa-phone-square" aria-hidden="true"></i> Telefono</div>
          <div class="panel-body">
           
                      <? if(count($telefonos_socio) > 0): ?>

                          <table  class="table table-striped table-bordered" id="tabla_usuarios" cellspacing="0" width="100%">
                            <thead>
                                <tr >
                                    <th>Telefono</th>
                                    <th>Responsable</th>
                                    <th></th>
                            </thead>
                            <tbody> 

                        <? foreach ($telefonos_socio as $row): ?>

                                <tr>
                                    <td><?=$row['telefono']?></td>
                                    <td><?=$row['responsable']?></td>
                                    <td> 
                                        <a href="#" onclick="eliminar_telefono(<?=$row['id_telefono']?>)"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>
                      
                        <? endforeach;  ?>

                            </tbody>
                          </table>
                      
                      <?  else: ?>
                             <div class="alert alert-warning alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              Aún no hay telefonos cargados.
                            </div> 

                      <? endif;  ?>
             

               <label  class="col-sm-12 control-label"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Telefono</label>
              <div class="form-group col-sm-12 " style="background-color: #e0dddd; padding-top: 20px">

                  <form class="form-horizontal" name="form_agregar_telefono" id="form_agregar_telefono"  method="POST"  action="<?=base_url()?>index.php/socio/alta_telefono_socio/"   >
                          
                          <input type="hidden" class="form-control" id="id_socio" name="id_socio" value="<?=$datos_socio->id_socio?>">

                          <div class="form-group   ">
                              <label for="telefono" class="col-sm-3 control-label">Telefono</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                              </div>
                          </div>
                          <div class="form-group   ">
                                <label for="responsable" class="col-sm-3 control-label">Responsable</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="responsable"  name="responsable" placeholder="Responsable">
                                </div>
                          </div>

                          <div class="row">

                            <div class=" col-sm-12 ">
                              <input type="submit" class="btn btn-primary btn-block" id="submit" name="submit" value="Modificar"  >
                            </div>

                          </div>
                  </form>
              </div>
          </div>
       
        </div>

      </div>


      <!-- CUOTAS Y ACTIVIDADES--> 
      <div class="col-md-12" style="padding-right: 0px; padding-left: 0px">
        <div class="panel panel-default">
       
          <div class="panel-heading">
              <i class="fa fa-futbol-o" aria-hidden="true"></i> Actividades del Socio
          </div>
          <div class="panel-body">

            <div class="col-md-4">

                <div class="panel panel-default">
       
                  <div class="panel-heading">
                      <i class="fa fa-handshake-o" aria-hidden="true"></i> Actividades que realiza el socio
                  </div>
                  <div class="panel-body">

                        <ul class="nav nav-pills nav-stacked  ">
   
                          <? $i = 0; ?>

                          <? foreach($actividades_socio as $row): ?>

                              <? if($i==0) $clase ='class="active"'; else  $clase =''; ?>

                              <li <?=$clase?> ><a href="#tab_<?=$row['actividades_socio']['id_socio_actividad']?>" data-toggle="pill"> <?=$row['actividades_socio']['descripcion_actividad']?> </a></li>

                              <? $i++; ?>

                          <? endforeach; ?>

                       
                       </ul>
                       


                  </div>
                </div>


                <div class="panel panel-default">
       
                  <div class="panel-heading">
                      <i class="fa fa-plus" aria-hidden="true"></i> Agregar Actividad al socio
                  </div>
                  <div class="panel-body" >

                      <form class="form-horizontal" name="form_agregar_telefono" id="form_agregar_telefono"  method="POST"  action="<?=base_url()?>index.php/socio/alta_actividad_socio/"   >
                          
                          <input type="hidden" class="form-control" id="id_socio" name="id_socio" value="<?=$datos_socio->id_socio?>">
 
                          <div class="   "> 
                            <label for="id_actividad" >Actividad</label><br>
                            <div >
                                

                              <?  $actividad = array(); ?>
                              
                              <?  foreach ($actividades as $row):  

                                      $actividad[$row['id_actividad']] = $row['descripcion'];

                                  endforeach; 

                                echo form_dropdown('id_actividad', $actividad, '' ,'class="form-control" id="id_actividad" name="id_actividad"  ' ); 

                              ?>
   

                            </div>
                          </div>

                          <div class="row">

                            <div class=" col-sm-12 ">
                              <input type="submit" class="btn btn-primary btn-block" id="submit" name="submit" value="Agregar"  >
                            </div>

                          </div>
                      </form>


                  </div>

                </div>

            </div>


            <div class="col-md-8">
 
                  <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Historial de cuotas</h3>
                      </div>
 
                        <div class="box-body">
                            
                                 <div class="tab-content ">


                        <? $i = 0; ?>

                        <? foreach($actividades_socio as $row): ?>

                            <? if($i==0) $clase ='active"'; else  $clase =''; ?>


                              <div class="tab-pane <?=$clase?>" id="tab_<?=$row['actividades_socio']['id_socio_actividad']?>">
                                  <h4 style="font-weight: bold"><?=$row['actividades_socio']['descripcion_actividad']?></h4>
                                  
                                  <table  class="table table-striped table-bordered" id="tabla_cuotas" cellspacing="0" width="100%">
                                    <thead>
                                        <tr >
                                            <th>ID</th>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Pago</th>
                                            <th>Importe</th>
                                    </thead>
                                    <tbody> 
                                          <tr>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                          </tr>
                                          <tr>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                          </tr>
                                          <tr>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                            <td>aaa</td>
                                          </tr>
                                    </tbody>
                                  </table>


                              </div>
                            
                             <? $i++; ?>

                          <? endforeach; ?>
 
                  </div>
                          
                        </div>
 
                    </div>


               
 
            </div>


          
          
          </div>
        </div>
      </div>

 

    </section>
 
</div>


<script type="text/javascript">
  
   function eliminar_email(id_email)
  {
    if (confirm('Seguro queres eliminar el email ?')) 
    {     
          $.ajax({
                  url: CI_ROOT+'index.php/socio/baja_email_socio',
                  data: { id_email: id_email },
                  async: true,
                  type: 'POST',
                  dataType: 'JSON',
                  success: function(data)
                  {
                    if(data.error == false)
                    {
                      //alert("Se ha eliminado el area exitosamente");
                      location.reload();
                      //window.location = CI_ROOT+'index.php/socio/ver_socio/<?=$datos_socio->id_socio?>'
                    }
                    else
                    {
                      //alert("No se ha eliminado el area");
                      location.reload();
                    }
                  },
                  error: function(x, status, error){
                    alert(error);
                  }
            });   
       
    }
  }
</script>

<script type="text/javascript">
  
   function eliminar_telefono(id_telefono)
  {
    if (confirm('Seguro queres eliminar el telefono ?')) 
    {     
          $.ajax({
                  url: CI_ROOT+'index.php/socio/baja_telefono_socio',
                  data: { id_telefono: id_telefono },
                  async: true,
                  type: 'POST',
                  dataType: 'JSON',
                  success: function(data)
                  {
                    if(data.error == false)
                    {
                      //alert("Se ha eliminado el area exitosamente");
                      location.reload();
                      //window.location = CI_ROOT+'index.php/socio/ver_socio/<?=$datos_socio->id_socio?>'
                    }
                    else
                    {
                      //alert("No se ha eliminado el area");
                      location.reload();
                    }
                  },
                  error: function(x, status, error){
                    alert(error);
                  }
            });   
       
    }
  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" ></script>
<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.js" ></script> 

<script>
	var jq_va = jQuery.noConflict();
</script>


<script type="text/javascript">
 

	 jq_va(function(){

            jq_va('#form_modifica_socio').validate({

                rules :{

                        nombre : {
                            required : true
                        },
                        apellido : {
                            required : true
                        },
                        foto : {
                             extension: "jpg|jpeg|png"
                        }  
                },
                messages : {

                        nombre : {
                            required : "Debe ingresa el nombre para el nombre"
                        },
                        apellido : {
 							              required : "Debe ingresa el asunto para el apellido"
                        },
                        foto : {
                             extension: "La foto debe ser formato jpg o png."
                        }      
                },
                invalidHandler: function(form, validator) {

                    jq_va('#form_modifica_socio').find(":submit").removeAttr('disabled');
                }

            });    
    }); 

   jq_va(function(){

            jq_va('#form_agregar_email').validate({

                rules :{

                        email : {
                            required : true
                        } 
                },
                messages : {

                        email : {
                            required : "Debe ingresar el email"
                        }    
                },
                invalidHandler: function(form, validator) {

                    jq_va('#form_agregar_email').find(":submit").removeAttr('disabled');
                }

            });    
    }); 

   jq_va(function(){

            jq_va('#form_agregar_telefono').validate({

                rules :{

                        telefono : {
                            required : true
                        } 
                },
                messages : {

                        telefono : {
                            required : "Debe ingresar el telefono"
                        }    
                },
                invalidHandler: function(form, validator) {

                    jq_va('#form_agregar_email').find(":submit").removeAttr('disabled');
                }

            });    
    });

 

</script>


<script src="<?php echo base_url(); ?>assets/bower_components/datatable/js/jquery-1.12.4.js " type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatable/js/dataTables.buttons.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatable/js/buttons.flash.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatable/js/jszip.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatable/js/pdfmake.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatable/js/vfs_fonts.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatable/js/buttons.html5.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatable/js/buttons.print.min.js" type="text/javascript" ></script> 
 
<script>
     var jq_dt = jQuery.noConflict();
</script>

 
<script type="text/javascript">
  
jq_dt(document).ready(function() {
 
 

    var table = jq_dt('#tabla_cuotas').DataTable({
                dom: 'Bfrtip',
                buttons: [
                      'excel', 'pdf', 'print'
                  ],
                "paging":   true,
                "ordering": true,
                "info":     true,
                "bFilter": true,
                "language": {
                    "lengthMenu": "Mostrando _MENU_ pedido por pagina.",
                    "zeroRecords": "Ningun pedido fue encontrado.",
                    "info": "<b> Mostrando pagina _PAGE_ de _PAGES_ </b>",
                    "infoEmpty": "Ningun pedid disponible",
                    "infoFiltered": "(Filtrado de _MAX_ pedido  totales)",
                    "sSearch": " Buscar    ",
                    "oPaginate": {
                                    "sNext": "Pag. sig.",
                                    "sPrevious": "Pag. ant."
                                  }
                },
                "lengthMenu": [[-1, 10, 25, 50], ["All", 10, 25, 50]] 

            });
 

} );

</script>
  