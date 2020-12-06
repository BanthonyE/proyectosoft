 <!-- Begin Page Content -->
 <div class="container-fluid">
 <div class="card shadow mb-4 col-md-12">
        
    <div class="card-body">
        <!-- Button to trigger modal -->
          <button class="btn btn-success btn-lg"   data-toggle="modal" data-target="#modalForm">
            INSERTAR NUEVO CLIENTE
          </button>
    </div>
   </div>
   
   <div class="row">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">idcliente</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">RUC</th>
                <th scope="col">Razon Social</th>
                <th scope="col">Activo</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody id="tbody">
              
            </tbody>
          </table>
        </div>


     
     <div class="modal" id="modalForm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post" id="form1">
                <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                <label for="">apellido</label>
                <input type="text" id="apellido" class="form-control">
                </div>
                <div class="form-group">
                <label for="">RUC</label>
                <input type="text" id="ruc" class="form-control">
                </div>
                <div class="form-group">
                <label for="">Razon Social</label>
                <input type="text" id="razon_social" class="form-control">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="add">Agregar</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">EDITAR CLIENTE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post" id="editForm">
                <input type="hidden" id="edit_modal_id" value="" >
                <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" id="edit_nombre" class="form-control">
                </div>
                <div class="form-group">
                <label for="">apellido</label>
                <input type="text" id="edit_apellido" class="form-control">
                </div>
                <div class="form-group">
                <label for="">RUC</label>
                <input type="text" id="edit_RUC" class="form-control">
                </div>
                <div class="form-group">
                <label for="">Razon Social</label>
                <input type="text" id="edit_razon_social" class="form-control">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="editar">ACTUALIZAR</button>
            </div>
          </div>
        </div>
      </div>

    
</div>

   <script>
      
         document.getElementById("add").onclick = function (){
           
           var nombre = $("#nombre").val();
           var apellido =  $("#apellido").val();
           var RUC =  $("#ruc").val();
           var razon_social =  $("#razon_social").val();

           $.ajax({
              url: "insert",
              type: "post",
              dataType: "json",
              data: {
                nombre: nombre,
                apellido: apellido,
                RUC: RUC,
                razon_social: razon_social
              },
              success: function(data){
                console.log(data);
                

                if(data.responce == "success"){
                  listar();
                  
                  Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: data.message,
                      showConfirmButton: false,
                      timer: 1500
                  })
                $('#modalForm').modal('hide');

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
           });

            $("#form1")[0].reset();
         }

         function listar(){
           console.log("ingreso a listar");
           $.ajax({
             url: "listar",
             type: "post",
             dataType: "json",
             success: function(data){
               console.log("ingresa al success");
               var tbody = "";
               var i = "1";

               for(var key in data){
                 tbody += "<tr>";
                 tbody += "<td>" + i++ +"</td>";
                 tbody += "<td>" + data[key]['nombre'] +"</td>";
                 tbody += "<td>" + data[key]['apellido'] +"</td>";
                 tbody += "<td>" + data[key]['RUC'] +"</td>";
                 tbody += "<td>" + data[key]['razon_social'] +"</td>";
                 if (data[key]['activo']== "Y") {
                  tbody += `<td>

                              <a href="#" id="act"  class="btn btn-sm btn-outline-info"  value="${data[key]['idCliente']}">
                                <i class="fab fa-creative-commons-by"></i>
                              </a> 

                            </td>`;
                 }else{
                  tbody += `<td>

                              <a href="#" id="act"  class="btn btn-sm btn-outline-danger"  value="${data[key]['idCliente']}">
                                <i class="fab fa-creative-commons-by"></i>
                              </a> 

                           </td>`;
                 }
                 //tbody += "<td>" + data[key]['activo'] +"</td>";
                 
                tbody += `<td> 
                              <a href="#" id="del"  class="btn btn-sm btn-outline-danger"  value="${data[key]['idCliente']}">
                                <i class="fas fa-trash-alt"></i>
                              </a> 


                              <a href="#" id="edit" class="btn btn-sm btn-outline-info" value="${data[key]['idCliente']}">
                              <i class="fas fa-edit"></i>
                              </a> 

                        </td>`;


                 tbody += "</tr>";
               }

               $("#tbody").html(tbody);


             }
           });
         }
         listar();
         

         $(document).on("click","#del" , function(e){
            e.preventDefault();
            var del_id = $(this).attr("value");

            if(del_id ==""){
              alert("delete id required");
            }else{
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                      confirmButton: 'btn btn-success',
                      cancelButton: 'btn btn-danger mr-2'
                    },
                    buttonsStyling: false
                  })

                  swalWithBootstrapButtons.fire({
                    title: 'Esta seguro?',
                    text: "No podra revertirlo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Borrar!',
                    cancelButtonText: 'No, cancelar!',
                    reverseButtons: true
                  }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({

                          url: "eliminar",
                          type: "post",
                          dataType: "json",
                          data: {
                            del_id: del_id
                          },
                          success: function(data){
                            listar();
                            if(data.responce == "success") {
                              swalWithBootstrapButtons.fire(
                                  'Borrado!',
                                  'Tu Cliente a sido Eliminado.',
                                  'success'
                                )
                            }
                          }

                        });                        

                      
                    } else if (
                      /* Read more about handling dismissals below */
                      result.dismiss === Swal.DismissReason.cancel
                    ) {
                      swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'Tu Cliente esta a salvo :)',
                        'error'
                      )
                    }
                  })
            }

         });


         
         $(document).on("click", "#edit",function(e){
           e.preventDefault();

            var edit_id = $(this).attr("value");

            if(edit_id ==""){ alert("EDIT ID REQUIRED"); }
            else{
              
              $.ajax({

                  url: "seleccionar",
                  type: "post",
                  dataType: "json",
                  data: {
                    edit_id: edit_id
                  },
                  success: function(data){
                      if(data.responce == "success"){
                          $('#editModal').modal('show');
                          $('#edit_modal_id').val(data.post.idCliente);
                          $('#edit_nombre').val(data.post.nombre);
                          $('#edit_apellido').val(data.post.apellido);
                          $('#edit_RUC').val(data.post.RUC);
                          $('#edit_razon_social').val(data.post.razon_social);
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
                  }); 



            }


         });


         $(document).on("click", "#act",function(e){
           e.preventDefault();

            var act_id = $(this).attr("value");

            if(act ==""){ alert("EDIT ID REQUIRED"); }
            else{
              
              $.ajax({

                  url: "activo",
                  type: "post",
                  dataType: "json",
                  data: {
                    act_id: act_id
                  },
                  success: function(data){
                      listar();
                    }
                  }); 



            }


         });

         $(document).on("click", "#editar", function(e){
          e.preventDefault();

            var edit_id = $("#edit_modal_id").val();
            var edit_nombre = $("#edit_nombre").val();
            var edit_apellido = $("#edit_apellido").val();
            var edit_RUC = $("#edit_RUC").val();
            var edit_razon_social = $("#edit_razon_social").val();

              if(edit_id == "" || edit_nombre == "" || edit_apellido == "" || edit_RUC == ""|| edit_razon_social == ""){
                alert("all field is required");
              }else{
                $.ajax({

                  url: "editar",
                  type: "post",
                  dataType: "json",
                  data: {
                    edit_id: edit_id,
                    edit_nombre: edit_nombre,
                    edit_apellido: edit_apellido,
                    edit_RUC: edit_RUC,
                    edit_razon_social: edit_razon_social
                  },
                  success: function(data){
                    listar();
                    if(data.responce == "success"){
                        
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: data.message,
                          showConfirmButton: false,
                          timer: 1500
                      })
                      $('#editModal').modal('hide');
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

                });

              }


         });



  </script>

 </div>
 <!-- /.container-fluid -->

 