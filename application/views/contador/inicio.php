 <!-- Begin Page Content -->
 <div class="container-fluid">

 <div class="card shadow mb-4">
     <div class="card-header py-3">
            
            <h6 class="m-0 font-weight-bold text-primary">Seleccionar Cliente</h6>
     </div>
    <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">idcliente</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">RUC</th>
                <th scope="col">Razon Social</th>
                <th scope="col">Trabajar</th>
              </tr>
            </thead>
            <tbody id="tbody">
              
            </tbody>
          </table>
        </div>
    </div>
 </div>
 
 <script>
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
                 
                  tbody += `<td>

                              <a href="#" id="trabajo"  class="btn btn-sm btn-outline-info"  value="${data[key]['idCliente']}">
                                <i class="fab fa-creative-commons-by"></i>
                              </a> 

                            </td>`;
                 
                
                 
               }

               $("#tbody").html(tbody);


             }
           });
         }
         listar();

         $(document).on("click", "#trabajo",function(e){
           e.preventDefault();

            var id = $(this).attr("value");

            if(id ==""){ alert("EDIT ID REQUIRED"); }
            else{
              
              $.ajax({

                  url: "trabajo",
                  type: "post",
                  dataType: "json",
                  data: {
                    id: id
                  },
                  success: function(data){
                      cliente();
                    }
                  }); 



            }


         });



 </script>       


</div>

 <!-- /.container-fluid -->
