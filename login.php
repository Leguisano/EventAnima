<?php require_once 'menu.php' ?>

        

<div class="top-bar d-none d-md-block" style="height: 78px;">
  
</div>

<div class="container-fluid" id="trilha" >


<div class="section-header">
    <p>LOGIN</p>
    <h2>Faça seu login, informando seu E-mail e Senha</h2>
</div> 

<div class="container text-center" >

    <!-- <form class="row row-cols-lg-auto align-items-center" method="POST" action="controller/logar.php?<?php //echo $action; ?>" > -->
    <form class="align-items-center" method="POST" action="controller/logar.php" >
 
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
                    <div class="input-group-text">E-mail:</div>
                        <input type="email" class="form-control" name="email" id="email" placeholder="user@email.com"  >
                </div>

                <br>

                <div class="input-group">
                    <div class="input-group-text">Senha:</div>
                    <input type="password" class="form-control" name="pass" id="pass" placeholder=""  required>
                </div>
                <div class="input-group">
                     <hr> 
                    <h1> </h1>
                </div> 
                <div class="input-group">
                    
                    <input type="submit" class="btn btn-primary" value="Acessar"/>
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

        // if( isset($_REQUEST['cpfNaoEncontrado'])){
        //     echo "<script>alert('Este cpf não foi encontrado!');</script>";
        // }

        if( isset($_REQUEST['cpfJaCadastrado'])){
            echo "<script>alert('Este cpf já foi cadastrado!');</script>";
        }

        if( isset($_REQUEST['emailJaCadastrado'])){
            echo "<script>alert('Este e-mail já foi cadastrado!');</script>";
        }

        if( isset($_REQUEST['userNaoEncontrado'])){
            echo "<script>alert('Usuário não foi encontrado! Verifique seu cpf/email e senha. ');</script>";
        }
    
    ?> 