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

      <? mensaje_resultado($mensaje); ?>

      <div class="row">

        <div class="col-md-4" style="padding-left: 0px">

          <div class="panel panel-default">
         
        	  <div class="panel-heading"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Agregar Socio</div>
        	      <div class="panel-body">
        	    	
                    <form class="form-horizontal" name="form_alta_socio" id="form_alta_socio"  method="POST"  action="<?=base_url()?>index.php/socio/alta_socio/" enctype="multipart/form-data"  >
              
        	                    <div class="form-group col-sm-12 ">
        	                      <label for="apellido" class="col-sm-3 control-label">Apellido</label>
        	                      <div class="col-sm-9">
        	                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
        	                      </div>
        	                    </div>
        	                    <div class="form-group col-sm-12 ">
        		                      <label for="nombre" class="col-sm-3 control-label">Nombre</label>
        		                      <div class="col-sm-9">
        		                        <input type="text" class="form-control" id="nombre"  name="nombre" placeholder="Nombre">
        		                      </div>
        		                 </div>


                               	<div class="form-group col-sm-12 ">
                                	<label for="foto" class="col-sm-3 control-label">Foto</label>
                                	<div class="col-sm-9">
                                  	<input type="file" class="form-control" id="foto" name="foto" placeholder="Telefono">
                               		</div>
                              	</div>

                              	<div class="form-group col-sm-12 ">
                                	<label for="fecha_nacimiento" class="col-sm-3 control-label">Fecha Nacimiento</label>
                                	<div class="col-sm-9">
                                  	<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha Nacimiento">
                               		</div>
                              	</div>

                                <div class="form-group col-sm-12 ">
                                  <label for="fecha_nacimiento" class="col-sm-3 control-label">Actividad</label>
                                  <div class="col-sm-9">
                                      

                                    <?  $actividad = array(); ?>
                                    
                                    <?  foreach ($tipo_actividad as $row):  

                                            $actividad[$row['id_actividad']] = $row['descripcion'];

                                        endforeach; 

                                      echo form_dropdown('id_actividad', $actividad, '' ,'class="form-control" id="id_actividad" name="id_actividad"  ' ); 

                                    ?>
         

                                  </div>
                                </div>
         

                           	<div class="row">

                           	 	<div class=" col-sm-12 ">
                           			<input type="submit" class="btn btn-primary btn-block" id="submit" name="submit" value="+ Agregar"  >
                           		</div>

                           	</div>
            			   </form>
                            

              </div>
          </div>

        </div>

        <div class="col-md-8" style="padding-right: 0px">
         	
         	<div class="panel panel-default"> 
        	  <div class="panel-heading"><i class="fa fa-users" aria-hidden="true"></i> Socios</div>
        	  <div class="panel-body">
        	    
                      <? if(count($socios) > 0): ?>

                           <table  class="table table-striped table-bordered" id="tabla_usuarios" cellspacing="0" width="100%">
                              <thead>
                                  <tr >
                                      <th>Nombre</th>
                                      <th>Apellido</th>
                                      <th style="width:100px">Foto</th>
                                      <th>F. Nac</th> 
                                      <th>Emails</th>
                                      <th>Telefonos</th>
                                      <th> </th>
                                  </tr>
                              </thead>
                              <tbody> 

                          <?  foreach ($socios as $row):  ?>
         
                                  <tr>
                                      <td><?=$row['nombre']?></td>
                                      <td><?=$row['apellido']?></td>
                                      <td style="width:100px; text-align: center;"><img style="width: 40%" src="<?=base_url()?>/assets/images/fotos_socios/<?=$row['foto']?>"></td>
                                      <td><?=$row['fecha_nacimiento']?></td>
                                      <td><?=$row['nombre']?></td>
                                      <td><?=$row['nombre']?></td> 
                                      <td> 
                                          <i class="fa fa-trash" aria-hidden="true"></i>  
                                           <a href="<?=base_url()?>index.php/socio/ver_socio/<?=$row['id_socio']?>"> <i class="fa fa-binoculars" aria-hidden="true"></i> </a>
                                      </td>
                                  </tr> 

                           <?  endforeach; ?>

                              </tbody>
                            </table>

                      <?  else: ?>      

                            <div class="alert alert-danger"> Aún no hay socios cargados </div>

                      <?  endif; ?>
         
              
        	  </div>
         
        	</div>

        </div>

      </div>

    </section>

</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" ></script>
<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.js" ></script> 

<script>
	var jq_va = jQuery.noConflict();
</script>


<script type="text/javascript">
 

	 jq_va(function(){

            jq_va('#form_alta_socio').validate({

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
                            required : "Debe ingresa el nombre."
                        },
                        apellido : {
 							              required : "Debe ingresa el apellido"
                        },
                        foto : {
                             extension: "La foto debe ser formato jpg o png."
                        }     
                },
                invalidHandler: function(form, validator) {

                    jq_va('#form_alta_socio').find(":submit").removeAttr('disabled');
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
 
 

    var table = jq_dt('#tabla_usuarios').DataTable({
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
 