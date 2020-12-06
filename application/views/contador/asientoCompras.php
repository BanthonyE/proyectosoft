<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
            <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">idDoc</th>
                    <th scope="col">Nombre</th>
                </tr>
                </thead>
                <tbody id="tbody">
                
                </tbody>
            </table>
            </div>
        </div>

        


      <div class="modal  bd-example-modal-lg" id="modalform" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registro de Compras___</h5>
              <button class="btn btn-primary" type="button"  id="pdf1" value="">
                      VER 
              </button>
                  
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  
                   
                   
                    <form action="" method="post" id="formulario">
                      
                          <div class="row">
                              <div class="col-8">
                                  <div class="form-group">
                                      <label for="select1">CTA</label>
                                      <select class="form-control form-control-md" name="select1"  id="select1">
                                      </select>
                                  </div>
                                 
                              </div>
                              
                              
                          
                         </div>
                         <div class="row">
                         <div class="col">
                                  <div class="form-group">
                                  <label for="fechaComprobante">Fecha </label>
                                  <input type="date" id="fechaComprobante" 
                                        value="2020-11-25"
                                        min="2020-01-01" max="2020-12-31">
                                  </div>
                              </div>
                         </div>
                          <div class="row">
                                <div class="form-group">
                                    <label for="RUCProveedor">Proveedor</label>
                                    <select id="RUCProveedor">
                                    </select>
                                    
                                </div>
                          </div>
                        <div class="row">
                            <div class="col-sm">
                              <div class="form-group">
                                <label for="">Comprobante</label>
                                <select id="selectTipoCompr">
                                    <option value="FACTURA">FACTURA</option>
                                    <option value="BOLETA">BOLETA</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm">
                              <div class="form-group">
                                <label for="">Numero</label>
                                <input type="text"  id="numeroComprobante" />

                              </div>
                            </div>
                              
                        </div>
                        <div class="row">
                          <div class="col-sm">
                            <div class="form-group">
                              <label for="">Emision </label>
                              <input type="date" id="fechaEmision" 
                                    value="2020-11-25"
                                    min="2020-01-01" max="2020-12-31" />
                            </div>
                          </div>
                          <div class="col-sm">
                            <div class="form-group">
                              <label for="">Vence </label>
                              <input type="date" id="fechaVencimiento" 
                                    value="2020-11-25"
                                    min="2020-01-01" max="2020-12-31" />
                            </div>
                          </div>
                            
                        </div>    
                        <div class="row">
                            <div class="col-6">
                                  <div class="form-group">
                                <label for="">IMPORTE </label>
                                <input type="number" step="0.01" name="importe" id="importe"/>
                                </div>
                            </div>

                            <div class="col-4">
                              <div class="form-group">
                                  <select name="" id="tipoMoneda">
                                        <option value="SOLES">SOLES</option>
                                        <option value="DOLARES">DOLARES</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-2">
                              <div class="form-group">
                                <label for="IGV"> IGV </label>
                                <input type="checkbox" name="IGV"  id="IGV" checked/>
                              </div>
                            </div>

                        </div>    
                        <div class="row">
                          <div class="col-12 col-md-8">
                              <div class="form-group">
                              <label for="">GLOSA </label>
                              <input type="text"  name="" id="glosaM">
                            </div>
                          </div>
                        </div>
                       <div class="row">
                         <div class="col-8">
                            <div class="form-group">
                              <label for="">CTA nuteo</label>
                              <select class="form-control form-control-md"  id="select2">
                              </select>
                            </div>
                         </div>
                         
                       </div>
                       <div class="row">
                         <div class="col">
                            <input type="button" class="btn btn-primary"  value="Registrar" id="registrarAsiento">   
                         </div>
                       </div>
                      
                         
                       
                     </form>
                 </div>
             </div>
            <div class="modal-footer">
               
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Close</button>
              
            </div>
          </div>
        </div>




        <div class="modal fade bd-example-modal-lg" id="modalform2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registro de Compras Destino</h5>
              <button class="btn btn-primary" type="button"  id="pdf12" value="">
                      VER 
              </button>
                  
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  
                   
                   
                    <form action="" method="post" id="formulario2">
                      
                          <div class="row">
                              <div class="col-8">
                                  <div class="form-group">
                                      <label for="select1">CTA</label>
                                      <select class="form-control form-control-md" name="select1"  id="select12">
                                      </select>
                                  </div>
                                 
                              </div>
                              
                              
                          
                         </div>
                         <div class="row">
                         <div class="col">
                                  <div class="form-group">
                                  <label for="fechaComprobante">Fecha </label>
                                  <input type="date" id="fechaComprobante2" 
                                        value="2020-11-25"
                                        min="2020-01-01" max="2020-12-31">
                                  </div>
                              </div>
                         </div>
                          <div class="row">
                                <div class="form-group">
                                    <label for="RUCProveedor">Proveedor</label>
                                    <select id="RUCProveedor2">
                                    </select>
                                    
                                </div>
                          </div>
                        <div class="row">
                            <div class="col-sm">
                              <div class="form-group">
                                <label for="">Comprobante</label>
                                <select id="selectTipoCompr2">
                                    <option value="FACTURA">FACTURA</option>
                                    <option value="BOLETA">BOLETA</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm">
                              <div class="form-group">
                                <label for="">Numero</label>
                                <input type="text"  id="numeroComprobante2" />

                              </div>
                            </div>
                              
                        </div>
                        <div class="row">
                          <div class="col-sm">
                            <div class="form-group">
                              <label for="">Emision </label>
                              <input type="date" id="fechaEmision2" 
                                    value="2020-11-25"
                                    min="2020-01-01" max="2020-12-31" />
                            </div>
                          </div>
                          <div class="col-sm">
                            <div class="form-group">
                              <label for="">Vence </label>
                              <input type="date" id="fechaVencimiento2" 
                                    value="2020-11-25"
                                    min="2020-01-01" max="2020-12-31" />
                            </div>
                          </div>
                            
                        </div>    
                        <div class="row">
                            <div class="col-6">
                                  <div class="form-group">
                                <label for="">IMPORTE </label>
                                <input type="number" step="0.01" name="importe" id="importe2"/>
                                </div>
                            </div>

                            <div class="col-4">
                              <div class="form-group">
                                  <select name="" id="tipoMoneda2">
                                        <option value="SOLES">SOLES</option>
                                        <option value="DOLARES">DOLARES</option>
                                </select>
                              </div>
                            </div>


                        </div>    
                        <div class="row">
                          <div class="col-12 col-md-8">
                              <div class="form-group">
                              <label for="">GLOSA </label>
                              <input type="text"  name="" id="glosaM2">
                            </div>
                          </div>
                        </div>
                       <div class="row">
                         <div class="col-8">
                            <div class="form-group">
                              <label for="">CTA nuteo</label>
                              <select class="form-control form-control-md"  id="select22">
                              </select>
                            </div>
                         </div>
                         
                       </div>
                       <div class="row">
                         <div class="col">
                            <input type="button" class="btn btn-primary"  value="Registrar" id="registrarAsiento2">   
                         </div>
                       </div>
                      
                         
                       
                     </form>
                 </div>
             </div>
            <div class="modal-footer">
               
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar1">Close</button>
              
            </div>
          </div>
        </div>



<script>
            function CierraModal() {
                $('#cerrar').click(); //Esto simula un click sobre el botón close de la modal, por lo que no se debe preocupar por qué clases agregar o qué clases sacar.
                $('.modal-backdrop').remove();//eliminamos el backdrop del modal
            }
            function CierraModal1() {
                $('#cerrar1').click(); //Esto simula un click sobre el botón close de la modal, por lo que no se debe preocupar por qué clases agregar o qué clases sacar.
                $('.modal-backdrop').remove();//eliminamos el backdrop del modal
            }
           
            document.getElementById("registrarAsiento").onclick = function (){
              console.log("ingresa al boton registrar");
              var ruta = $("#pdf1").val();
              var select1 = $("#select1").val();
              var fechaComprobante =  $("#fechaComprobante").val();
              var RUCProveedor =  $("#RUCProveedor").val();
              var selectTipoCompr =  $("#selectTipoCompr").val();
              var numeroComprobante =  $("#numeroComprobante").val();
              var fechaEmision =  $("#fechaEmision").val();
              var fechaVencimiento =  $("#fechaVencimiento").val();
              var importe =  $("#importe").val();
              var tipoMoneda =  $("#tipoMoneda").val();
              var IGV =  document.getElementById("IGV").checked;
              var glosaM =  $("#glosaM").val();
              var select2 =  $("#select2").val();

              $.ajax({
              url: "registrarAsiento",
              type: "post",
              dataType: "json",
              data: {
                ruta: ruta,
                select1: select1,
                fechaComprobante: fechaComprobante,
                RUCProveedor: RUCProveedor,
                selectTipoCompr: selectTipoCompr,
                numeroComprobante: numeroComprobante,
                fechaEmision: fechaEmision,
                fechaVencimiento: fechaVencimiento,
                importe: importe,
                tipoMoneda: tipoMoneda,
                IGV: IGV,
                glosaM: glosaM,
                select2: select2
             },
              success: function(data){
                console.log(data);
                if(data.responce == "success"){
                  listarDocCompras();

                  Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: data.message,
                      showConfirmButton: false,
                      timer: 1500
                  });
                  CierraModal();
                  $("#formulario")[0].reset();
                  crearFormulario2(ruta,fechaComprobante,RUCProveedor,numeroComprobante,fechaEmision,fechaVencimiento,data.importe,glosaM);

                }else{

                  Swal.fire({
                      position: 'top-end',
                      icon: 'warning',
                      title: data.message,
                      showConfirmButton: true,
                      timer: 2500
                  });


                }


                
                

              }
           });
            }


            function crearFormulario2(ruta,fechaComprobante,RUCProveedor,numeroComprobante,fechaEmision,fechaVencimiento,importe,glosaM){
              $('#modalform2').modal('show');
              $('#pdf12').val(ruta);
              $.ajax({
                      url: "crearFormulario",
                      type: "post",
                      dataType: "json",
                      
                      success: function(data){
                        console.log(data['cuentas']);

                        var select1 = "";
                        var select2 = "";
                        var RUCProveedor = "";

                        for(var key in data['cuentas'] ){
                          select1 += "<option value="+ data['cuentas'][key]['codigo'] + ">" + data['cuentas'][key]['codigo'] + "  " + data['cuentas'][key]['descripcion'] +"</option>" ;
                          select2 += "<option value="+ data['cuentas'][key]['codigo'] + ">" + data['cuentas'][key]['codigo'] + "  " + data['cuentas'][key]['descripcion'] +"</option>" ;
                        }
                        
                        for(var key in data['proveedor'] ){
                          RUCProveedor += "<option value="+ data['proveedor'][key]['RUC'] + ">" + data['proveedor'][key]['RUC'] + "  " + data['proveedor'][key]['razon_social'] +"</option>" ;
                        }
                        
                           
                        $("#select12").html(select1);
                        $("#select22").html(select2);
                        $("#fechaComprobante2").val(fechaComprobante);
                        $("#RUCProveedor2").val(RUCProveedor);
                        $("#numeroComprobante2").val(numeroComprobante);
                        $("#fechaEmision2").val(fechaEmision);
                        $("#fechaVencimiento2").val(fechaVencimiento);
                        $("#importe2").val(importe.toFixed(2));
                        $("#glosaM2").val(glosaM);
                        $("#RUCProveedor2").html(RUCProveedor);
                      }
                      
                      });

            }

            document.getElementById("registrarAsiento2").onclick = function (){
              console.log("ingresa al boton registrar");
              var ruta = $("#pdf12").val();
              var select1 = $("#select12").val();
              var fechaComprobante =  $("#fechaComprobante2").val();
              var RUCProveedor =  $("#RUCProveedor2").val();
              var selectTipoCompr =  $("#selectTipoCompr2").val();
              var numeroComprobante =  $("#numeroComprobante2").val();
              var fechaEmision =  $("#fechaEmision2").val();
              var fechaVencimiento =  $("#fechaVencimiento2").val();
              var importe =  $("#importe2").val();
              var tipoMoneda =  $("#tipoMoneda2").val();
              var glosaM =  $("#glosaM2").val();
              var select2 =  $("#select22").val();

              $.ajax({
              url: "registrarAsiento2",
              type: "post",
              dataType: "json",
              data: {
                ruta: ruta,
                select1: select1,
                fechaComprobante: fechaComprobante,
                RUCProveedor: RUCProveedor,
                selectTipoCompr: selectTipoCompr,
                numeroComprobante: numeroComprobante,
                fechaEmision: fechaEmision,
                fechaVencimiento: fechaVencimiento,
                importe: importe,
                tipoMoneda: tipoMoneda,
                glosaM: glosaM,
                select2: select2
             },
              success: function(data){
                console.log(data);
                if(data.responce == "success"){
                  listarDocCompras();

                  Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: data.message,
                      showConfirmButton: false,
                      timer: 1500
                  });
                  CierraModal1();
                  $("#formulario2")[0].reset();

                }else{

                  Swal.fire({
                      position: 'top-end',
                      icon: 'warning',
                      title: data.message,
                      showConfirmButton: true,
                      timer: 2500
                  });


                }


                
                

              }
           });
            }



            $(document).on("click","#form1" , function(e){
                e.preventDefault();
                console.log("ingreso al dar click form1");
                $('#pdf1').val($(this).attr("value"));

                $.ajax({
                      url: "crearFormulario",
                      type: "post",
                      dataType: "json",
                      
                      success: function(data){
                        console.log(data['cuentas']);

                        var select1 = "";
                        var select2 = "";
                        var RUCProveedor = "";

                        for(var key in data['cuentas'] ){
                          select1 += "<option value="+ data['cuentas'][key]['codigo'] + ">" + data['cuentas'][key]['codigo'] + "  " + data['cuentas'][key]['descripcion'] +"</option>" ;
                          select2 += "<option value="+ data['cuentas'][key]['codigo'] + ">" + data['cuentas'][key]['codigo'] + "  " + data['cuentas'][key]['descripcion'] +"</option>" ;
                        }
                        
                        for(var key in data['proveedor'] ){
                          RUCProveedor += "<option value="+ data['proveedor'][key]['RUC'] + ">" + data['proveedor'][key]['RUC'] + "  " + data['proveedor'][key]['razon_social'] +"</option>" ;
                        }
                        $('#modalform').modal('show');
                        
                        $("#select1").html(select1);
                        $("#select2").html(select2);
                        $("#RUCProveedor").html(RUCProveedor);
                      }
                      
                      });




                
            });
            
           
           
           
           //sirve para poder abrir el visualizador del pdf 
            $(document).on("click","#pdf1" , function(e){
                e.preventDefault();
                ruta = '<?php base_url()?>assets/documentos/compras/'+$(this).attr("value");

                Swal.fire({
                    title: 'Comprobante Contable',
                    html: `<iframe width="100%" height="300" src="`+ ruta +`" frameborder="0"></iframe>`
                });


            });

            $(document).on("click","#pdf12" , function(e){
                e.preventDefault();
                ruta = '<?php base_url()?>assets/documentos/compras/'+$(this).attr("value");

                Swal.fire({
                    title: 'Comprobante Contable',
                    html: `<iframe width="100%" height="300" src="`+ ruta +`" frameborder="0"></iframe>`
                });


            });

            
                
            



    function listarDocCompras(){
           $.ajax({
             url: "listarDocCompras",
             type: "post",
             dataType: "json",
             success: function(data){
               var tbody = "";
               var i = "1";

               for(var key in data){
                 tbody += "<tr>";
                 tbody += "<td>" + i++ +"</td>";
                 tbody += "<td>" + data[key]['ruta'] +"</td>";
                tbody += `<td>

                              <a href="#"  id="form1" class="btn btn-sm btn-outline-info"  value="${data[key]['ruta']}">
                                <i class="fab fa-creative-commons-by"></i>
                              </a> 
                              

                            </td>`;
                 
                 //tbody += "<td>" + data[key]['activo'] +"</td>";
                

                 tbody += "</tr>";
               }

               $("#tbody").html(tbody);


             }
           });
         }
         
         listarDocCompras();

        

</script>


</div>
 <!-- /.container-fluid -->