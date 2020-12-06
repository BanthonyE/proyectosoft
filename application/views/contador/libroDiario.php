 <!-- Begin Page Content -->
 <div class="container-fluid">
 <div class="card shadow mb-4 col-md-12">
    <div class="card-header py-3">
    </div>
    <div class="card-body py-3">
            <label> Seleccionar un Periodo </label>
            <input type="month" name="fecha" id="fecha1"  value="2020-01"
            min="2010-01" max="2020-12" required >


            <input id="fecha2" type="month" name="month" value="2020-12"
            min="2010-01" max="2020-12" required>

            <input type="button" class="btn btn-outline-primary" id="selectFecha"   value="Seleccionar">
    </div>
    <div class="card-footer py-3">
        <input type="button" class="btn btn-success" onclick="tableToExcel('testTable', 'Estado Financiero')" value="Export to Excel">
      
</input>
                        
                        
                        
                        
                    

    </div>
 </div>



 <div class="card shadow mb-4">
     <div class="card-header py-3">
            
            <h6 class="m-0 font-weight-bold text-primary">Libro Diario</h6>
     </div>
    <div class="card-body">
        <div class="table-responsive">
          <table class="table-bordered text-center " id="testTable">
            <thead>
              <tr>
                <th scope="col">C</th>
                <th scope="col">Origen</th>
                <th scope="col">CTa</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Debe</th>
                <th scope="col">Haber</th>
                <th scope="col">M</th>
                <th scope="col">T/C</th>
                <th scope="col">fecha</th>
                <th scope="col">Glosa</th>
                <th scope="col">codigo</th>
                <th scope="col">Razon Social</th>
                <th scope="col">Tipo Doc</th>
                <th scope="col">Numero</th>
                <th scope="col">emision</th>
                <th scope="col">vencimiento</th>
              </tr>
            </thead>
            <tbody id="tbody">
              
            </tbody>
          </table>
        </div>
    </div>
 </div>


<script> 

$(document).on("click", "#selectFecha", function(e){
  e.preventDefault();

  var fecha1 = parseInt($("#fecha1").val().substr(5,2));
  var fecha2 = parseInt($("#fecha2").val().substr(5,2));
  
  
  
  $.ajax({
    url:"listarAsiento",
    type: "post",
    dataType: "json",
    
    success: function(data){
      console.log("ingresa al success");
               var tbody = "";
               var x = "1";
               var debe = 0;
               var haber = 0 ;

               for(var key in data){
                
                 var fecha = parseInt(data[key]['fecha'].substr(5,2));

                if( fecha >= fecha1 && fecha <= fecha2 ){

                
                      if(x == data[key]['correlativo']) {
                        tbody += `<tr>`;
                      }else{
                        tbody += `<tr class="table-primary">
                            <td> - </td>
                            <td> - </td>
                            <td> -</td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            </tr>`; 
                        tbody += "<tr>";
                        x = data[key]['correlativo'];
                      }
                      
                      tbody += "<td>" + data[key]['correlativo'] +"</td>";
                      tbody += "<td>" + data[key]['origen'] +"</td>";
                      tbody += "<td>" + data[key]['cuenta'] +"</td>";
                      tbody += "<td>" + data[key]['descripcion'] +"</td>";
                      tbody += "<td>" + parseFloat(data[key]['debito']) +"</td>";
                      tbody += "<td>" + parseFloat(data[key]['credito']) +"</td>";
                      tbody += "<td>" + data[key]['moneda'] +"</td>";
                      tbody += "<td>" + data[key]['tipoCambio'] +"</td>";
                      tbody += "<td>" + data[key]['fecha'] +"</td>";
                      tbody += "<td>" + data[key]['concepto'] +"</td>";
                      tbody += "<td>" + data[key]['codigo'] +"</td>";
                      tbody += "<td>" + data[key]['razon_social'] +"</td>";
                      tbody += "<td>" + data[key]['tipoDocumento'] +"</td>";
                      tbody += "<td>" + data[key]['numero'] +"</td>";
                      tbody += "<td>" + data[key]['fechaEmision'] +"</td>";
                      tbody += "<td>" + data[key]['fechaVencimiento'] +"</td>";
                      tbody += "</tr>";
                      debe = debe + parseFloat(data[key]['debito']);
                      haber = haber + parseFloat(data[key]['credito']);

                 }
                }  


                 
               $("#tbody").html(tbody);
                 tbody += "<tr>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += `<td class="table-info"> TOTALES</td>`;
                 tbody += `<td class="table-info">` +debe +"</td>";
                 tbody +=  `<td class="table-info"> ` + haber +"</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "</tr>";
                 $("#tbody").html(tbody);  
    }


  });
  
});



            function listarAsiento(fecha){
           console.log("ingreso a listar");
           $.ajax({
             url: "listarAsiento",
             type: "post",
             dataType: "json",
             data:{

             },
             success: function(data){
               console.log("ingresa al success");
               var tbody = "";
               var x = "1";
               var debe = 0;
               var haber = 0 ;

               for(var key in data){
                 if(x == data[key]['correlativo']) {
                   tbody += `<tr>`;
                 }else{
                  tbody += `<tr class="table-primary">
                       <td> - </td>
                       <td> - </td>
                       <td> -</td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                       <td> - </td>
                      </tr>`; 
                  tbody += "<tr>";
                  x = data[key]['correlativo'];
                 }
                 
                 tbody += "<td>" + data[key]['correlativo'] +"</td>";
                 tbody += "<td>" + data[key]['origen'] +"</td>";
                 tbody += "<td>" + data[key]['cuenta'] +"</td>";
                 tbody += "<td>" + data[key]['descripcion'] +"</td>";
                 tbody += "<td>" + parseFloat(data[key]['debito']) +"</td>";
                 tbody += "<td>" + parseFloat(data[key]['credito']) +"</td>";
                 tbody += "<td>" + data[key]['moneda'] +"</td>";
                 tbody += "<td>" + data[key]['tipoCambio'] +"</td>";
                 tbody += "<td>" + data[key]['fecha'] +"</td>";
                 tbody += "<td>" + data[key]['concepto'] +"</td>";
                 tbody += "<td>" + data[key]['codigo'] +"</td>";
                 tbody += "<td>" + data[key]['razon_social'] +"</td>";
                 tbody += "<td>" + data[key]['tipoDocumento'] +"</td>";
                 tbody += "<td>" + data[key]['numero'] +"</td>";
                 tbody += "<td>" + data[key]['fechaEmision'] +"</td>";
                 tbody += "<td>" + data[key]['fechaVencimiento'] +"</td>";
                 tbody += "</tr>";
                 debe = debe + parseFloat(data[key]['debito']);
                 haber = haber + parseFloat(data[key]['credito']);
                 }  
                 
               $("#tbody").html(tbody);
                 tbody += "<tr>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += `<td class="table-info"> TOTALES</td>`;
                 tbody += `<td class="table-info">` +debe +"</td>";
                 tbody +=  `<td class="table-info"> ` + haber +"</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "<td>-</td>";
                 tbody += "</tr>";
                 $("#tbody").html(tbody);   
             }
           });
         }
         

         var tableToExcel = (function() {
            var uri = 'data:application/vnd.ms-excel;base64,'
              , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
              , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
              , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
            return function(table, name) {
              if (!table.nodeType) table = document.getElementById(table)
              var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
              window.location.href = uri + base64(format(template, ctx))
            }
          })()




</script>

</div>