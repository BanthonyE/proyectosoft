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
            
            <h6 class="m-0 font-weight-bold text-primary">ESTADO FINANCIEROS</h6>
     </div>
    <div class="card-body">
        <div class="table-responsive" >
            <table class="table-bordered  text-center" id="testTable">
                
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

                        var sum10 = 0;
                        var sum12 = 0;
                        var sum16 = 0;
                        var sum20 = 0;
                        var sum33 = 0;
                        var sum40 = 0;
                        var sum42 = 0;
                        var sum46 = 0;
                        var sum50 = 0;
                        
                        for(var key in data['cuentas'] ){
                           
                            var debe1 = 0;
                            var haber1 = 0;
                            var deudor = 0;
                            var acreedor = 0;
                            
                            
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
                                    
                                        var codigoCta = data['cuentas'][key]['codigo'].substr(0,2); 
                                        if(codigoCta == 10){
                                            sum10 = sum10 + debe - haber;
                                        }
                                        if(codigoCta == 12){
                                            sum12 = sum12 + debe - haber;
                                        }
                                        if(codigoCta == 16){
                                            sum16 = sum16 + debe - haber;
                                        }
                                        if(codigoCta == 20){
                                            sum20 = sum20 + debe - haber;
                                        }
                                        if(codigoCta == 33){
                                            sum33 = sum33 + debe - haber;
                                        }
                                        if(codigoCta == 40){
                                            sum40 = sum40 + haber - debe;
                                        }
                                        if(codigoCta == 42){
                                            sum42 = sum42 + haber - debe;
                                        }
                                        if(codigoCta == 46){
                                            sum46 = sum46 + haber - debe;
                                        }
                                        if(codigoCta == 50){
                                            sum50 = sum50 + haber - debe;
                                        }
                                    

                                        
                                    
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
                                   
                                    if(debe1 != 0){
                                        
                                    }else{
                                        
                                    }

                                    if(haber1 != 0){
                                        
                                    }else{
                                      
                                    }

                                    if(deudor != 0){
                                       
                                    }else{
                                       
                                    }

                                    if(acreedor != 0){
                                       
                                    }else{
                                        
                                    }

                                    if(codigoCta == 79){
                                        
                                    }else{
                                        if(deudor != 0){
                                       
                                        suma_activo = suma_activo + deudor;
                                        }else{
                                          
                                        }

                                        if(acreedor != 0){
                                            
                                            suma_pasivo = suma_pasivo + acreedor;
                                        }else{ }
                               
                                    }


                                }else{
                                    var codigoCta = parseInt(data['cuentas'][key]['codigo'].substr(0,2));

                                    if( codigoCta> 59 && codigoCta < 69 || codigoCta > 69 && codigoCta < 78 ){
                                        
                                    if(debe != 0){
                                        
                                    }else{
                                        
                                    }
                                    if(haber != 0){
                                        
                                    }else{
                                       
                                    }
                                    if(deudor != 0){
                                       
                                    }else{
                                        
                                    }
                                    if(acreedor != 0){
                                        
                                    }else{
                                       
                                    }
                                    
                                    if(deudor != 0){
                                       
                                         suma_perdida = suma_perdida + deudor;
                                    }else{
                                       
                                    }

                                    if(acreedor != 0){
                                        
                                        suma_ganancia = suma_ganancia + acreedor;
                                    }else{
                                       
                                    }
                                

                                            if(codigoCta > 69 && codigoCta < 78 ){
                                                if(deudor != 0){
                                                    
                                                    suma_perdida1 = suma_perdida1 + deudor;
                                                }else{
                                                   
                                                }

                                                if(acreedor != 0){
                                                    
                                                    suma_ganancia1 = suma_ganancia1 + acreedor;
                                                }else{
                                                    
                                                }
                                            }else{
                                                
                                            }

                                   

                                    }else{

                                        var codigoCta = parseInt(data['cuentas'][key]['codigo'].substr(0,2));
                                        var codigoCta1 = parseInt(data['cuentas'][key]['codigo'].substr(0,1));
                                        if(codigoCta == 69 || codigoCta1 == 9){
                                           
                                            if(debe != 0){
                                               
                                            }else{
                                                
                                            }
                                            if(haber != 0){
                                               
                                            }else{
                                                
                                            }
                                            if(deudor != 0){
                                                
                                            }else{
                                                
                                            }
                                            if(acreedor != 0){
                                                
                                            }else{
                                                
                                            }
                                            
                                            if(deudor != 0){
                                                    
                                                    suma_perdida1 = suma_perdida1 + deudor;
                                                }else{
                                                   
                                                }

                                                if(acreedor != 0){
                                                   
                                                    suma_ganancia1 = suma_ganancia1 + acreedor;
                                                }else{
                                                    
                                                }
                                        }
                                    }
                                }
                            }
                        }

                                
                                   
                                    
                                    
                                    var xyz = {
                                        sum10: sum10,
                                        sum12: sum12,
                                        sum16: sum16,
                                        sum20: sum20,
                                        sum33: sum33,
                                        sum40: sum40,
                                        sum42: sum42
                                    };
                                        
                                    
                                    
                                    console.log(xyz);

                                    tbody += "<tr>";

                                    tbody += "<td> ACTIVO</td>";
                                    tbody += "<td> </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> PASIVO </td>";
                                    tbody += "<td></td>";

                                    tbody += "</tr>";
                                   
                                    $("#tbody").html(tbody); 

                                    tbody += "<tr>";

                                    tbody += "<td> ACTIVO CORRIENTE</td>";
                                    tbody += "<td> </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> PASIVO CORRIENTE</td>";
                                    tbody += "<td></td>";
                                    tbody += "</tr>";
                                    
                                    $("#tbody").html(tbody); 
                                    

                                    tbody += "<tr>";
                                    tbody += "<td> EFECTIVO Y EQUIVALENTE DE EFECTIVO</td>";
                                    tbody += "<td>S/ "+ Math.abs(sum10) +" </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> CTAS POR PAGAR COMER TERCEROS </td>";
                                    tbody += "<td>S/ "+ sum42 +"</td>";
                                    tbody += "</tr>";
                                    sum10 = Math.abs(sum10);
                                    sum42 = Math.abs(sum42);
                                    sum40 = Math.abs(sum40),
                                    tbody += "<tr>";
                                    tbody += "<td> CTAS POR COBRAR COMERCI TERCEROS</td>";
                                    tbody += "<td>S/ "+ sum12 +" </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> OTRAS CTAS POR PAGAR  </td>";
                                    tbody += "<td>S/ "+ Math.abs(sum46 - sum40) +"</td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 

                                    tbody += "<tr>";
                                    tbody += "<td> OTRAS CUENTAS POR COBRAR</td>";
                                    tbody += "<td>S/ "+ sum16 +" </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> TOTAL PASIVO CORRIENTE  </td>";
                                    tbody += "<td>S/ "+ Math.abs(sum42 + Math.abs(sum46 - sum40)) +"</td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 

                                    tbody += "<tr>";
                                    tbody += "<td> MERCADERIAS </td>";
                                    tbody += "<td>S/ "+ sum20 +" </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> </td>";
                                    tbody += "<td></td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 

                                    tbody += "<tr>";
                                    tbody += "<td> TOTAL ACTIVO CORRIENTE</td>";
                                    tbody += "<td>S/ "+ Math.abs(sum10 + sum12 + sum16 + sum20 ) +" </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> PASIVO NO CORRIENTE </td>";
                                    tbody += "<td></td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 

                                    tbody += "<tr>";
                                    tbody += "<td></td>";
                                    tbody += "<td> </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> CTAS POR PAGAR A LARGO PLAZO </td>";
                                    tbody += "<td> ---- </td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 

                                    tbody += "<tr>";
                                    tbody += "<td> ACTIVO NO CORRIENTE </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> TOTAL PASIVO NO CORRIENTE </td>";
                                    tbody += "<td> ---- </td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 

                                    tbody += "<tr>";
                                    tbody += "<td> CTAS POR COBRAR A LARGO PLAZO</td>";
                                    tbody += "<td> ---- </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> </td>";
                                    tbody += "<td></td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 
                                    
                                    tbody += "<tr>";
                                    tbody += "<td> INMUEBLES MAQUINARIAS Y EQUIPO</td>";
                                    tbody += "<td>S/ "+ sum33 +" </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> TOTAL PASIVO  </td>";
                                    tbody += "<td>S/ "+ Math.abs(sum42 + (sum46 - sum40)) +"</td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody); 

                                    tbody += "<tr>";
                                    tbody += "<td> TOTAL ACTIVO NO CORRIENTE </td>";
                                    tbody += "<td>S/ "+ sum33 +" </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td>  </td>";
                                    tbody += "<td></td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody);

                                    tbody += "<tr>";
                                    tbody += "<td> </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> PATRIMONIO </td>";
                                    tbody += "<td></td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody);

                                    tbody += "<tr>";
                                    tbody += "<td> </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> CAPITAL </td>";
                                    tbody += "<td>S/ "+ sum50 +"</td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody);

                                    tbody += "<tr>";
                                    tbody += "<td> </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> RESULTADO DEL PERIODO </td>";
                                    tbody += "<td>S/ "+ Math.abs(suma_activo - suma_pasivo) +"</td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody);

                                    tbody += "<tr>";
                                    tbody += "<td> </td>";
                                    tbody += "<td></td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> TOTAL PATRIMONIO </td>";
                                    tbody += "<td>S/ "+ Math.abs(sum50 - (suma_activo - suma_pasivo)) +"</td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody);

                                    tbody += "<tr>";
                                    tbody += "<td> TOTAL ACTIVO </td>";
                                    tbody += "<td>S/ " + Math.abs(sum10 + sum12 + sum16 + sum20 + sum33)+ "</td>";
                                    tbody += "<td></td>";
                                    tbody += "<td> TOTAL PASIVO Y PATRIMONIO </td>";
                                    tbody += "<td>S/ "+   Math.abs((sum50 - (suma_activo - suma_pasivo))+(sum42 + (sum46 - sum40))) +"</td>";
                                    tbody += "</tr>";
                                    $("#tbody").html(tbody);

                                    
                                   
                                    
                                   




                       
                      }

});

            }
            



   </script>
</div>