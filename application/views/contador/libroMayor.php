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
    </div>
 </div>
   <div class="card shadow mb-4 col-md-12">
   <div class="card-header py-3">
            
            <h6 class="m-0 font-weight-bold text-primary">Libro Mayor</h6>
     </div>
    <div class="card-body">
        <div class="table-responsive" >
            <table class="table-bordered text-center" id="testTable">
                <thead>
                <tr>
                    <th  rowspan=2 scope="col">FECHA</th>
                    <th  rowspan=2 scope="col">Co</th>
                    <th  rowspan=2 scope="col">GLOSA</th>
                    <th  rowspan=2 scope="col">CUENTA</th>
                    <th   rowspan=2 scope="col">DESCRIPCION</th>
                    <th   colspan=2 scope="col">SALDOS</th>
                </tr>
                <tr>
                    
                    <th  scope="col">DEUDOR</th>
                    <th  scope="col">ACREEDOR</th>
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
  console.log(fecha2);
  $.ajax({
                      url: "listarCTA",
                      type: "post",
                      dataType: "json",
                      
                      success: function(data){
                        console.log(data['asiento']);
                        var tbody ="";
                        var debe = 0;
                            var haber = 0;
                        
                        for(var key in data['cuentas'] ){
                            var deudor = 0;
                            var acreedor = 0;
                            
                            for( var key1 in data['asiento']){
                                var fecha = parseInt(data['asiento'][key1]['fecha'].substr(5,2));

                                if( fecha >= fecha1 && fecha <= fecha2 ){
                                    if(data['cuentas'][key]['codigo'] == data['asiento'][key1]['cuenta']){

                                                                        tbody += "<tr>";
                                                                        tbody += "<td>" +  data['asiento'][key1]['fecha'] +"</td>";
                                                                        tbody += "<td>" + data['asiento'][key1]['correlativo'] +"</td>";
                                                                        tbody += "<td>" + data['asiento'][key1]['concepto'] +"</td>";
                                                                        tbody += "<td>" + data['asiento'][key1]['cuenta'] +"</td>";
                                                                        tbody += "<td>" + data['asiento'][key1]['descripcion'] +"</td>";
                                                                        tbody += "<td>" + parseFloat(data['asiento'][key1]['debito'])  +"</td>";
                                                                        tbody += "<td>" + parseFloat(data['asiento'][key1]['credito']) +"</td>";
                                                                        tbody += "</tr>";
                                                                        deudor = deudor + parseFloat(data['asiento'][key1]['debito'])  ;
                                                                        debe = debe + parseFloat(data['asiento'][key1]['debito'])  ;
                                                                        acreedor = acreedor + parseFloat(data['asiento'][key1]['credito']) ;
                                                                        haber = haber + parseFloat(data['asiento'][key1]['credito']) ;
                                                                            $("#tbody").html(tbody);

                                                                    }
                                }

                                

                                    
                            }
                                if(deudor > acreedor  || deudor < acreedor){
                                        
                                        tbody += `<tr>`;
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += `<td class="table-info"> TOTAL  </td>`;
                                        tbody += `<td class="table-info">` + deudor +"</td>";
                                        tbody += `<td class="table-info">` + acreedor +"</td>";
                                        tbody += "</tr>";
                                        $("#tbody").html(tbody);
                                        tbody += `<tr class="table-active">`;
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> -  </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "</tr>";
                                        $("#tbody").html(tbody);

                            }else{
                            if(deudor > 0 && acreedor > 0){
                                         tbody += `<tr>`;
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += `<td class="table-info"> TOTAL  </td>`;
                                        tbody += `<td class="table-info">` + deudor +"</td>";
                                        tbody += `<td class="table-info">` + acreedor +"</td>";
                                        tbody += "</tr>";
                                        $("#tbody").html(tbody);
                                        tbody += `<tr class="table-active">`;
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> -  </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "</tr>";
                                        $("#tbody").html(tbody);

                            }
                            }
                        }

                        tbody += `<tr>`;
                        tbody += "<td> - </td>";
                        tbody += "<td> - </td>";
                        tbody += "<td> - </td>";
                        tbody += "<td> - </td>";
                        tbody += `<td class="table-primary"> TOTALES  </td>`;
                        tbody += `<td class="table-primary">` + debe +"</td>";
                        tbody += `<td class="table-primary">` + haber +"</td>";
                        tbody += "</tr>";

                        $("#tbody").html(tbody);
                       
                      }
                      
                      });





});    
            function listarCTA(){
                $.ajax({
                      url: "listarCTA",
                      type: "post",
                      dataType: "json",
                      
                      success: function(data){
                        console.log(data['asiento']);
                        var tbody ="";
                        var debe = 0;
                            var haber = 0;
                        
                        for(var key in data['cuentas'] ){
                            var deudor = 0;
                            var acreedor = 0;
                            
                            for( var key1 in data['asiento']){
                                
                                if(data['cuentas'][key]['codigo'] == data['asiento'][key1]['cuenta']){

                                    tbody += "<tr>";
                                    tbody += "<td>" +  data['asiento'][key1]['fecha'] +"</td>";
                                    tbody += "<td>" + data['asiento'][key1]['correlativo'] +"</td>";
                                    tbody += "<td>" + data['asiento'][key1]['concepto'] +"</td>";
                                    tbody += "<td>" + data['asiento'][key1]['cuenta'] +"</td>";
                                    tbody += "<td>" + data['asiento'][key1]['descripcion'] +"</td>";
                                    tbody += "<td>" + parseFloat(data['asiento'][key1]['debito'])  +"</td>";
                                    tbody += "<td>" + parseFloat(data['asiento'][key1]['credito']) +"</td>";
                                    tbody += "</tr>";
                                    deudor = deudor + parseFloat(data['asiento'][key1]['debito'])  ;
                                    debe = debe + parseFloat(data['asiento'][key1]['debito'])  ;
                                    acreedor = acreedor + parseFloat(data['asiento'][key1]['credito']) ;
                                    haber = haber + parseFloat(data['asiento'][key1]['credito']) ;
                                        $("#tbody").html(tbody);

                                }

                                    
                                }
                                if(deudor > acreedor  || deudor < acreedor){
                                        
                                        tbody += `<tr>`;
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += `<td class="table-info"> TOTAL  </td>`;
                                        tbody += `<td class="table-info">` + deudor +"</td>";
                                        tbody += `<td class="table-info">` + acreedor +"</td>";
                                        tbody += "</tr>";
                                        $("#tbody").html(tbody);
                                        tbody += `<tr class="table-active">`;
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> -  </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "</tr>";
                                        $("#tbody").html(tbody);

                            }else{
                            if(deudor > 0 && acreedor > 0){
                                         tbody += `<tr>`;
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += `<td class="table-info"> TOTAL  </td>`;
                                        tbody += `<td class="table-info">` + deudor +"</td>";
                                        tbody += `<td class="table-info">` + acreedor +"</td>";
                                        tbody += "</tr>";
                                        $("#tbody").html(tbody);
                                        tbody += `<tr class="table-active">`;
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> -  </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "<td> - </td>";
                                        tbody += "</tr>";
                                        $("#tbody").html(tbody);

                            }
                            }
                        }

                        tbody += `<tr>`;
                        tbody += "<td> - </td>";
                        tbody += "<td> - </td>";
                        tbody += "<td> - </td>";
                        tbody += "<td> - </td>";
                        tbody += `<td class="table-primary"> TOTALES  </td>`;
                        tbody += `<td class="table-primary">` + debe +"</td>";
                        tbody += `<td class="table-primary">` + haber +"</td>";
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