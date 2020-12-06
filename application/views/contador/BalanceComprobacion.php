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
            
            <h6 class="m-0 font-weight-bold text-primary">Balance de Comprobacion</h6>
     </div>
    <div class="card-body">
        <div class="table-responsive" >
            <table class="table-bordered table-striped text-center" id="testTable">
                <thead>
                <tr>
                    <th  rowspan=2 scope="col">CUENTA</th>
                    <th  rowspan=2 scope="col">DESCRIPCION</th>
                    <th  colspan=2 scope="col">SUMA</th>
                    <th  colspan=2 scope="col">SALDOS</th>
                    <th   colspan=2 scope="col">INVENTARIO</th>
                    <th   colspan=2 scope="col">RESULTADO POR NATURALEZA</th>
                    <th   colspan=2 scope="col">RESULTADO POR FUNCION</th>
                </tr>
                <tr>
                    <th  scope="col">DEBE</th>
                    <th  scope="col">HABER</th>
                    <th  scope="col">DEUDOR</th>
                    <th  scope="col">ACREEDOR</th>
                    <th  scope="col">ACTIVO </th>
                    <th  scope="col">PASIVO</th>
                    <th  scope="col">PERDIDA</th>
                    <th  scope="col">GANANCIA</th>
                    <th  scope="col">PERDIDA</th>
                    <th  scope="col">GANANCIA</th>
                </tr>
                </thead>
                <tbody id="tbody">
                
                </tbody>
            </table>
            </div>
        </div>
   </div>
   <script>
       
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


          $(document).on("click", "#selectFecha", function(e){
                e.preventDefault();

                var fecha1 = parseInt($("#fecha1").val().substr(5,2));
                var fecha2 = parseInt($("#fecha2").val().substr(5,2));
                listarCTA(fecha1,fecha2);
          });






            function listarCTA(fecha1,fecha2){
                $.ajax({
                      url: "listarCTA",
                      type: "post",
                      dataType: "json",
                      
                      success: function(data){
                        console.log(data['asiento']);
                        var tbody ="";
                        var suma_debe = 0;
                        var suma_haber = 0;
                        var suma_deudor = 0;
                        var suma_acreedor = 0;
                        var suma_activo = 0;
                        var suma_pasivo = 0;
                        var suma_perdida = 0;
                        var suma_ganancia = 0;
                        var suma_perdida1 = 0;
                        var suma_ganancia1 = 0;
                        
                        for(var key in data['cuentas'] ){
                           
                            var debe1 = 0;
                            var haber1 = 0;
                            var deudor = 0;
                            var acreedor = 0;
                            var activo = 0;
                            var pasivo = 0;
                            var perdida = 0;
                            var ganancia = 0;
                            var perdida1 = 0;
                            var ganancia1 = 0;
                            
                            for( var key1 in data['asiento']){
                                var fecha = parseInt(data['asiento'][key1]['fecha'].substr(5,2));

                                if( fecha >= fecha1 && fecha <= fecha2 ){
                                    if( data['cuentas'][key]['codigo'] == data['asiento'][key1]['cuenta'] ){
                                    var debe = 0;
                                    var haber = 0;
                                    debe =  parseFloat(data['asiento'][key1]['debito'])  ;
                                    haber =  parseFloat(data['asiento'][key1]['credito']) ;

                                    debe1 = debe1 + debe;
                                    haber1 = haber1 + haber;

                                    suma_debe = suma_debe + debe;
                                    suma_haber = suma_haber + haber;
                                    }
                                }
                                
                                
                                    
                            }
                            if(debe1 > haber1  ){
                                deudor = debe1 - haber1; 
                                acreedor = 0; 
                                
                                }
                                if( debe1 < haber1){
                                    acreedor = haber1 - debe1;
                                    deudor = 0;
                                }
                                if(debe1 == haber1 ){
                                        acreedor = 0;
                                            deudor = 0;
                                }
                                suma_deudor = suma_deudor + deudor;
                                suma_acreedor = suma_acreedor + acreedor;

                            if( debe1 > 0 || haber1 > 0 ) {
                                console.log(data['cuentas'][key]['codigo'].substr(0,2));
                                var codigoCta = data['cuentas'][key]['codigo'].substr(0,2);
                                if(codigoCta < 60 || codigoCta == 79){
                                    tbody += "<tr>";
                                    tbody += "<td>" +  data['cuentas'][key]['codigo'] +"</td>";
                                    tbody += "<td>" + data['cuentas'][key]['descripcion'] +"</td>";
                                    if(debe1 != 0){
                                        tbody += "<td>" +    debe1   +"</td>";
                                    }else{
                                        tbody += "<td></td>";
                                    }

                                    if(haber1 != 0){
                                        tbody += "<td>" +    haber1   +"</td>";
                                    }else{
                                        tbody += "<td></td>";
                                    }

                                    if(deudor != 0){
                                        tbody += "<td>" +    deudor.toFixed(2)   +"</td>";
                                    }else{
                                        tbody += "<td></td>";
                                    }

                                    if(acreedor != 0){
                                        tbody += "<td>" +    acreedor.toFixed(2)   +"</td>";
                                    }else{
                                        tbody += "<td></td>";
                                    }

                                    if(codigoCta == 79){
                                        tbody += "<td></td>";
                                        tbody += "<td></td>";
                                        tbody += "<td></td>";
                                        tbody += "<td></td>";
                                        tbody += "<td></td>";
                                        tbody += "<td></td>";
                                        tbody += "</tr>";
                                         $("#tbody").html(tbody); 
                                    }else{
                                        if(deudor != 0){
                                        tbody += "<td>" +    deudor.toFixed(2)   +"</td>";
                                        suma_activo = suma_activo + deudor;
                                        }else{
                                            tbody += "<td></td>";
                                        }

                                        if(acreedor != 0){
                                            tbody += "<td>" +    acreedor.toFixed(2)   +"</td>";
                                            suma_pasivo = suma_pasivo + acreedor;
                                        }else{
                                            tbody += "<td></td>";
                                        }
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    
                                tbody += "</tr>";
                                $("#tbody").html(tbody); 
                                    }


                                }else{
                                    var codigoCta = parseInt(data['cuentas'][key]['codigo'].substr(0,2));

                                    if( codigoCta> 59 && codigoCta < 69 || codigoCta > 69 && codigoCta < 78 ){
                                        tbody += "<tr>";
                                    tbody += "<td>" +  data['cuentas'][key]['codigo'] +"</td>";
                                    tbody += "<td>" + data['cuentas'][key]['descripcion'] +"</td>";
                                    if(debe != 0){
                                        tbody += "<td>" +    debe   +"</td>";
                                    }else{
                                        tbody += "<td></td>";
                                    }
                                    if(haber != 0){
                                        tbody += "<td>" +    haber   +"</td>";
                                    }else{
                                        tbody += "<td></td>";
                                    }
                                    if(deudor != 0){
                                        tbody += "<td>" +    deudor.toFixed(2)   +"</td>";
                                    }else{
                                        tbody += "<td></td>";
                                    }
                                    if(acreedor != 0){
                                        tbody += "<td>" +    acreedor.toFixed(2)   +"</td>";
                                    }else{
                                        tbody += "<td></td>";
                                    }
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    if(deudor != 0){
                                        tbody += "<td>" +    deudor.toFixed(2)   +"</td>";
                                         suma_perdida = suma_perdida + deudor;
                                    }else{
                                        tbody += "<td></td>";
                                    }

                                    if(acreedor != 0){
                                        tbody += "<td>" +    acreedor.toFixed(2)   +"</td>";
                                        suma_ganancia = suma_ganancia + acreedor;
                                    }else{
                                        tbody += "<td></td>";
                                    }
                                

                                            if(codigoCta > 69 && codigoCta < 78 ){
                                                if(deudor != 0){
                                                    tbody += "<td>" +    deudor.toFixed(2)   +"</td>";
                                                    suma_perdida1 = suma_perdida1 + deudor;
                                                }else{
                                                    tbody += "<td></td>";
                                                }

                                                if(acreedor != 0){
                                                    tbody += "<td>" +    acreedor.toFixed(2)   +"</td>";
                                                    suma_ganancia1 = suma_ganancia1 + acreedor;
                                                }else{
                                                    tbody += "<td></td>";
                                                }
                                            }else{
                                                tbody += "<td></td>";
                                                tbody += "<td></td>";
                                            }

                                    tbody += "</tr>";
                                    $("#tbody").html(tbody);

                                    }else{

                                        var codigoCta = parseInt(data['cuentas'][key]['codigo'].substr(0,2));
                                        var codigoCta1 = parseInt(data['cuentas'][key]['codigo'].substr(0,1));
                                        if(codigoCta == 69 || codigoCta1 == 9){
                                            tbody += "<tr>";
                                            tbody += "<td>" +  data['cuentas'][key]['codigo'] +"</td>";
                                            tbody += "<td>" + data['cuentas'][key]['descripcion'] +"</td>";
                                            if(debe != 0){
                                                tbody += "<td>" +    debe   +"</td>";
                                            }else{
                                                tbody += "<td></td>";
                                            }
                                            if(haber != 0){
                                                tbody += "<td>" +    haber   +"</td>";
                                            }else{
                                                tbody += "<td></td>";
                                            }
                                            if(deudor != 0){
                                                tbody += "<td>" +    deudor.toFixed(2)   +"</td>";
                                            }else{
                                                tbody += "<td></td>";
                                            }
                                            if(acreedor != 0){
                                                tbody += "<td>" +    acreedor.toFixed(2)   +"</td>";
                                            }else{
                                                tbody += "<td></td>";
                                            }
                                            tbody += "<td></td>";
                                            tbody += "<td></td>";
                                            tbody += "<td></td>";
                                            tbody += "<td></td>";
                                            if(deudor != 0){
                                                    tbody += "<td>" +    deudor.toFixed(2)   +"</td>";
                                                    suma_perdida1 = suma_perdida1 + deudor;
                                                }else{
                                                    tbody += "<td></td>";
                                                }

                                                if(acreedor != 0){
                                                    tbody += "<td>" +    acreedor.toFixed(2)   +"</td>";
                                                    suma_ganancia1 = suma_ganancia1 + acreedor;
                                                }else{
                                                    tbody += "<td></td>";
                                                }
                                        }


                                        tbody += "</tr>";
                                        $("#tbody").html(tbody); 

                                    }





                                    
                                }











                                
                            }

                                 

                            
                        }



                                    tbody += "<tr>";
                                    tbody += "<td></td>";
                                    tbody += "<td> SUMAS</td>";
                                    tbody += "<td>" +  suma_debe.toFixed(2)   + "</td>";
                                    tbody += "<td>" +   suma_haber.toFixed(2)  + "</td>";
                                    tbody += "<td>" + suma_deudor.toFixed(2) + "</td>";
                                    tbody += "<td>" +   suma_acreedor.toFixed(2)  + "</td>";
                                    tbody += "<td>" +  suma_activo.toFixed(2)   + "</td>";
                                    tbody += "<td>" +   suma_pasivo.toFixed(2)  + "</td>";
                                    tbody += "<td>" +  suma_perdida.toFixed(2)   + "</td>";
                                    tbody += "<td>" +   suma_ganancia.toFixed(2)  + "</td>";
                                    tbody += "<td>" +  suma_perdida1.toFixed(2)  + "</td>";
                                    tbody += "<td>" +   suma_ganancia1.toFixed(2)  + "</td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 

                                    tbody += "<tr>";
                                    tbody += "<td></td>";
                                    tbody += "<td> RESULTADOS</td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    if(suma_activo > suma_pasivo){
                                        tbody += "<td></td>";
                                        tbody += "<td>" +  (suma_activo - suma_pasivo).toFixed(2) + "</td>";
                                    }
                                    else{
                                        tbody += "<td>" + ( suma_pasivo - suma_activo).toFixed(2) + "</td>";
                                        tbody += "<td></td>";
                                    }

                                    if(suma_perdida > suma_ganancia){
                                        tbody += "<td></td>";
                                        tbody += "<td>" +  (suma_perdida - suma_ganancia).toFixed(2) + "</td>";
                                    }
                                    else{
                                        tbody += "<td>" +  (suma_ganancia - suma_perdida).toFixed(2) + "</td>";
                                        tbody += "<td></td>";
                                    }

                                    if( suma_perdida1 > suma_ganancia1){
                                        tbody += "<td></td>";
                                        tbody += "<td>" +  (suma_perdida1 - suma_ganancia1).toFixed(2) + "</td>";
                                    }
                                    else{
                                        tbody += "<td>" +  (suma_ganancia1 - suma_perdida1).toFixed(2) + "</td>";
                                        tbody += "<td></td>";
                                    }
                                   
                                    
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 

                                    
                                    


                                    tbody += "<tr>";
                                    tbody += "<td></td>";
                                    tbody += "<td> TOTALES </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    if(suma_activo > suma_pasivo){
                                        tbody += "<td>" +  (suma_activo).toFixed(2) + "</td>";
                                        tbody += "<td>" +  (suma_activo).toFixed(2) + "</td>";
                                    }
                                    else{
                                        tbody += "<td>" + ( suma_pasivo).toFixed(2) + "</td>";
                                        tbody += "<td>" + ( suma_pasivo).toFixed(2) + "</td>";
                                    }

                                    if(suma_perdida > suma_ganancia){
                                        tbody += "<td>" +  (suma_perdida).toFixed(2) + "</td>";
                                        tbody += "<td>" +  (suma_perdida).toFixed(2) + "</td>";
                                    }
                                    else{
                                        tbody += "<td>" +  (suma_ganancia).toFixed(2) + "</td>";
                                        tbody += "<td>" +  (suma_ganancia).toFixed(2) + "</td>";
                                    }

                                    if( suma_perdida1 > suma_ganancia1){
                                        tbody += "<td>" +  (suma_perdida1).toFixed(2) + "</td>";
                                        tbody += "<td>" +  (suma_perdida1).toFixed(2) + "</td>";
                                    }
                                    else{
                                        tbody += "<td>" +  (suma_ganancia1).toFixed(2) + "</td>";
                                        tbody += "<td>" +  (suma_ganancia1).toFixed(2) + "</td>";
                                    }
                                   
                                    
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 





                       
                      }




                      
                      });

            }
            



   </script>
</div>