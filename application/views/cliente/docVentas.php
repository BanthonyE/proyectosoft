<div class="container-fluid">

    <div class="card shadow mb-4 col-md-12">
        
            
            <div class="card-body">
                <form action="subirVentas" method="POST" enctype="multipart/form-data" >  
                        
                        <div class="form-group">
                            
                            
                            <div class="row">
                            <label for="">Seleccione archivo</label>
                            <input  name="mi_archivo" type="file" class="form-control" accept="application/pdf" >
                            <input class="btn btn-primary" type="submit">

                            </div>
                            
                        </div>
                        
                </form>
            </div>
            
    </div>
    <?php 
        if(isset($error)){
            ?> <strong> <?= $error ?>  </strong> <?php
        }

        if(isset($mensaje)){
            ?> <strong> <?= $mensaje ?>  </strong> <?php
        }

    
    ?>
   

   

</div>