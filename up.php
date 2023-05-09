<?php
   include 'header.php';
    session_start();
     
     if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
       header("Location: index.php");
       exit;
     }
     $tok = $_SESSION['token'];
     $id = $_GET['id'];
     $realized = $_GET['realized'];
     $name = $_GET['input'];
     $curl = curl_init();
   
     if(isset($_POST['salvar'])){
           $name = addslashes($_POST['name']);
               if(@$_POST['realized'] == 'on'){
                 $realized = '1';
               }else{
                 $realized = '0';
               }
           curl_setopt_array($curl, array(
           CURLOPT_URL => 'http://localhost/to-do/api/task/update/',
           CURLOPT_CUSTOMREQUEST => 'PUT',
           CURLOPT_POSTFIELDS => json_encode(['id'=>$id,'name'=>$name,'realized'=>$realized]),
           CURLOPT_HTTPHEADER => array("Content-Type: application/json","Authorization:$tok"),));
           curl_exec($curl);
           header('location:profile.php');
   
     }
   
   
     if(isset($_POST['Excluir'])){
           
           curl_setopt_array($curl, array(
           CURLOPT_URL => 'http://localhost/to-do/api/task/delete/',
           CURLOPT_CUSTOMREQUEST => 'DELETE',
           CURLOPT_POSTFIELDS => json_encode(['id'=>$id]),
           CURLOPT_HTTPHEADER => array("Content-Type: application/json","Authorization:$tok"),));
           $response = curl_exec($curl);
           header('location:profile.php');
     }
     
   
   
   ?>
<link rel="stylesheet" type="text/css" href="assets/css/cssUp.css">
<form method="POST">
   <h4>Editar tarefa</h4>
   <p style="font-size: 10px;">Titulo:</p>
   <input type="text" id="txt" name="name" value="<?php echo $name; ?>">
   <br>Status: &nbsp&nbsp <?php if($realized == '0'){?>
   <input type="checkbox" name="realized">
   <?php 
      }else{?>
   <input type="checkbox" name="realized" checked='true'>
   <?php
      }
      ?>
   <br>
   <input type="submit" name="salvar" class="salvar" value="Salvar">&nbsp&nbsp<input type="submit" class="ex" name="Excluir" value="Excluir">
</form>