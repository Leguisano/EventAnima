

<?php require_once 'menu.php' ?>


       

    <div class="top-bar d-none d-md-block" style="height: 78px;">

    </div>
        
    <div class="container-fluid">

        <div class="container">

            <div class="row">
                <div class="col">
                    <h1></h1>
                    <h1 class="h3 mb-3 fw-normal">FADERGS - Certificados</h3>
                    <!-- <h3 class="h1 mb-3 fw-normal"><b></b></h1> -->
      
             
                    <form action="eventos.php" method="POST" id="formulario">
      
                        <div class="mb-3">
                            <!-- <input type="text" class="form-control" name="nome" id="inlineFormInputGroupName" required> -->
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="text" class="form-control" id="email" name="email" required placeholder="seuemail@exemplo.com" >
                        </div>

                        <button class="w-100 btn btn-lg btn-primary" type="submit" >Buscar certificado</button>
                        <!-- <p class="mt-5 mb-3 text-muted">&copy; 2022</p> -->
                    </form>
                  <!-- </main> -->
                </div>
              
            </div>
      
        
        </div>

    </div>
       
        
        
       



<?php require_once("rodape.php"); ?>


