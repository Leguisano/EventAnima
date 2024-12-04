<?php require_once 'menu.php' ?>

        

<div class="top-bar d-none d-md-block" style="height: 78px;">
  
</div>

<div class="container-fluid" id="trilha" >


<div class="section-header">
    <p>CADASTRO DE USUÁRIOS</p>
    <h2>Cadastre usuários informando os campos abaixo:</h2>
</div> 

<div class="container text-center" >

    <!-- <form class="row row-cols-lg-auto align-items-center" method="POST" action="controller/logar.php?<?php echo $action; ?>" > -->
    <form class="align-items-center" method="POST" action="controller/inserirUsuarios.php?<?php echo $action; ?>" >
 
        <div class="row">
            <div class="col-12">
                <!-- <label class="visually-hidden" for="inlineFormInputGroupUsername"></label> -->
                <!-- <div class="input-group">
                    <div class="input-group-text">CPF:</div>
                    <input type="text" class="form-control" name="cpf" id="cpf" placeholder="000.000.000-00" 
                    onkeypress="$(this).mask('000.000.000-00');" onblur="validarCPF(this)" >
                    <!-- onkeypress="mascara(this)" required> -->
                <!-- </div>
                
                <div class="">
                    <h3>OU</h3>
                </div> -->
                
                <!-- <div class=""> -->
                <!-- <label class="visually-hidden" for="inlineFormInputGroupUsername"></label> -->

                <div class="input-group">
                    <div class="input-group-text">Nome:</div>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nome do usuário" required >
                </div>

                        <input type="hidden" class="form-control" name="admin" id="admin" value="0" required >

                <br>

                <div class="input-group">
                    <div class="input-group-text">E-mail:</div>
                        <input type="email" class="form-control" name="email" id="email" placeholder="user@email.com" required >
                </div>

                <br>

                <div class="input-group">
                    <div class="input-group-text">Senha:</div>
                    <input type="password" class="form-control" name="pass" id="pass" placeholder=""  required>
                </div>
                <div class="">
                     <hr> 
                    <h1> </h1>
                </div> 
                <div class="">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
             
            </div>       
            
        </div>


 
        <div class="row">
            <div class="col-12">
                 <hr> 
                <h1> </h1>
            </div> 
        </div>

    </form>

    <div class="row" style="height: 100px;">
    
    </div>
</div>


</div>

 
        
       

      

<?php 
        
        require_once("rodape.php");

        if( isset($_REQUEST['emailJaCadastrado'])){
            echo "<script>alert('Este e-mail já foi cadastrado!');</script>";
        }
    
    ?> 