<div class="container-fluid">
 <div class="card shadow mb-4 col-md-12">
        
    <div class="card-body">
                <form ction="" method="post" id="form2">
                    <div class="row">
                            <div class="col-sm">
                              <div class="form-group">
                                <label for="">Seleccione Cuenta</label>
                                <select id="select1">
                                    
                                </select>
                              </div>
                            </div>
                            
                              
                    </div>
                    
                </form>
                        
    </div>
   </div>
   <div class="card shadow mb-4 col-md-12">
        <div class="card-body">
                <form action="" method="post" id="form1">
                    <div class="form-group">
                    <label for="">Codigo</label>
                    <input type="text" id="codigo" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="">Descripcion</label>
                    <input type="text" id="descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="select1">Tipo</label>
                        <select class="form-control form-control-md" name="tipo"  id="tipo">
                          <option value="Activo">Activo</option>
                          <option value="Pasivo">Pasivo</option>
                        </select>
                    </div>
                    
                   
              </form>
              <button class="btn btn-success btn-lg"  value="Registrar" id="registrarCuenta" >
                                Registrar
               </button>

        </div>
        
   </div>
   <script>  
      $(document).on("click","#registrarCuenta", function(e){

           var codigo = $("#codigo").val();
           var descripcion =  $("#descripcion").val();
           var tipo =  $("#tipo").val();

          $.ajax({
            url: "registrarCuenta",
            type: "post",
            dataType: "json",
            data: {
              codigo: codigo,
              descripcion: descripcion,
              tipo: tipo
            },
            success: function(data){
             
              if(data.responce == "success"){
                  
                  
                  Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: data.message,
                      showConfirmButton: false,
                      timer: 1500
                  })
                  $("#form1")[0].reset();
                  listarCTA();

                }else{

                  Swal.fire({
                      position: 'top-end',
                      icon: 'warning',
                      title: data.message,
                      showConfirmButton: true,
                      timer: 2500
                  })


                }

            }

          })

          

      });
            
            
            
            
            
            
            
            function listarCTA(){
                $.ajax({
                      url: "listarCTA",
                      type: "post",
                      dataType: "json",
                      
                      success: function(data){
                        console.log(data['cuentas']);

                        var select1 = "";
                        for(var key in data['cuentas'] ){
                          select1 += "<option value="+ data['cuentas'][key]['codigo'] + ">" + data['cuentas'][key]['codigo'] + "  " + data['cuentas'][key]['descripcion'] +"</option>" ;
                          
                        }
                        $("#select1").html(select1);
                       
                      }
                      
                      });

            }
            listarCTA();
   </script>
</div>