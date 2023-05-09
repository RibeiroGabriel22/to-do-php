<?php
//session_destroy();
session_start();
  

if(isset($_POST['username'])){
    
    $username = addslashes($_POST['username']); 
    $password = addslashes($_POST['password']); 

    $curl = curl_init();
    $postData = ['username'=>$username,'password'=> $password,];
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/to-do/api/user/login/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array('Content-Type: application/json',),));
        $response = curl_exec($curl);
        $js = json_decode($response, true);
        // var_dump($js);
        // die();
        if(isset($js['id'])>0){
             $_SESSION['loggedin'] = true;
             $_SESSION['username'] = $username;
              $_SESSION['token'] = $js['token'];
              $_SESSION['name'] = $js['name'];
              $_SESSION['id'] = $js['id'];
              header("Location: profile.php");
     
        }else{
            echo 'usuario não existe';
        }
        
    





}




?>
    <link rel="stylesheet" type="text/css" href="assets/css/cssLogin.css">

    
    <form method="POST">
    <div style="margin-top: 10px;">
    <div class="wrapper fadeInDown" style="height: 50%;">
     <div id="formContent">
     <div class="fadeIn first" align="center">
        <img src="assets/img/logo.png">
    </div>

    <!-- Login Form -->
    <form>
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="Login">
      <input type="text" id="password" class="fadeIn third" name="password" placeholder="Senha">
      
      <input type="submit" id="btn" class="fadeIn fourth" value="Login">
     
      <br>
    <a href="add.php">Adicionar usuário</a>

  </div>
</div>

</form>



<!-- 
<form method="POST">
    Login:<input type="text" name="username">

    Senha:<input type="text" name="password">

    <input type="submit" name="btn" value="Entrar">
</form>
<a href="add.php">Adicionar usuário</a>
 -->