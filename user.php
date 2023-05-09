<?php
   include 'header.php';
    session_start();
     
     if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
       header("Location: index.php");
       exit;
     }
     $tok = $_SESSION['token'];
     $id = $_SESSION['id'];


     $curl = curl_init();

 

    
   
   ?>
<link rel="stylesheet" type="text/css" href="assets/css/cssUser.css">

    <div class="container_form">

            <h1>Configuração de usuário</h1>
            <?php 
              if(isset($_POST['salvar'])){
        
                $name = addslashes($_POST['name']);
                $username = addslashes($_POST['username']);
                $password = addslashes($_POST['password']);

                $new_username = addslashes($_POST['new_username']);
                $new_password = addslashes($_POST['new_password']);

                
                $postData = ['username'=>$username,'password'=>$password,'new_username'=>$new_username,'new_password'=>$new_password];

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/to-do/api/user/updateuserpass/',
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_POSTFIELDS => json_encode($postData),
                CURLOPT_HTTPHEADER => array("Content-Type: application/json","Authorization:$tok"),));
                //$response = curl_exec($curl);
                $js = json_decode(curl_exec($curl), true);

                if($js['message'] == 'Incorrect username and/or password'){
                    echo '<u>Senha incorreta para auteração</u><br><br>';
                }else{
                    echo 'Perfil auterado com sucesso<br>';
                    session_destroy();
                    header('location:index.php');
                }
                

        //header('location:profile.php');

      }
      ?>
            <form class="form" method="post">
                
                <div class="form_grupo">
                    <label for="nome" class="form_label">Nome</label>
                    <input type="text" name="name" class="form_input" id="nome" value="<?php echo $_SESSION['name']; ?>">
                </div>
                
                <div class="form_grupo">
                    <label for="e-mail" class="form_label">Usuario</label>
                    
                    <input type="text" name="username" class="form_input" id="email" value="<?php echo $_SESSION['username']; ?>">
                </div>



              <!--   <div class="form_grupo">
                    <label for="e-mail" class="form_label">E-mail</label>
                    
                    <input type="text" name="email" class="form_input" id="email" value="">
                </div> -->

                <div class="form_grupo">
                    <label for="e-mail" class="form_label">Senha</label>
                    
                    <input type="text" name="password" class="form_input" id="password" value="">
                </div>


                <div class="form_grupo">
                    <label for="e-mail" class="form_label">Novo Usuario</label>
                    
                    <input type="text" name="new_username" class="form_input" id="new_username" value="">
                </div>

                  <div class="form_grupo">
                    <label for="e-mail" class="form_label">Nova Senha</label>
                    
                    <input type="text" name="new_password" class="form_input" id="new_password" value="">
                </div>
        
                        
                 <input type="submit" name="salvar" class="salvar" value="Atualizar">


            </form>

    </div><!--container_form-->

